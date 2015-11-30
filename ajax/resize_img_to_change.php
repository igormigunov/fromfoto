<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $USER; ?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>
<?
$conf = new Config();

		$logger = new Logger();

		$YaAuth = new YaAuth($conf,$logger);
		
		$dir = '/'.$_SESSION['PRODUCT_ID'].'_33/';

		$YaDisk = new YaDisk(	1,//$YaAuth->getToken(),
								$conf,
								$logger,
								$dir
							);

function resizePropImage($input, $output, $width = 0, $height = 0){
	$size=getimagesize ($input);
	$imgFormat=basename($size['mime']);
	$createImg='imagecreatefrom'.strtolower($imgFormat);
	imagealphablending($createImg, true);
	$src=$createImg($input);
	
	$new_w = $width;
	$new_h = $height;
	$iw=$size[0];
	$ih=$size[1];
	//if($width<$height){
		//$new_h	= $height;
		//$koe	= $ih/$height;
		//$new_w	= ceil($iw/$koe);
	//}else{
	//	$new_w	= $width;
		//$koe	= $iw/$width;
		//$new_h	= ceil($ih/$koe);
	//}

	$dst=imagecreatetruecolor ($new_w, $new_h);
	imagealphablending($dst, false);
	imagesavealpha($dst, true);  
	imagecopyresampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);
	
	
	if (strtolower($imgFormat) == 'jpeg') {

		imagejpeg($dst, $output, 100);

		

	} else {

		$imageformat='image'.strtolower($imgFormat);
		$imageformat($dst, $output);

	}
	
	
	imagedestroy($src);
}

function crop($file_input, $file_output, $crop = 'square',$percent = false) {

	list($w_i, $h_i, $type) = getimagesize($file_input);

	if (!$w_i || !$h_i) {

		echo 'Невозможно получить длину и ширину изображения';

		return;

    }

    $types = array('','gif','jpeg','png');

    $ext = $types[$type];

    if ($ext) {

    	$func = 'imagecreatefrom'.$ext;

    	$img = $func($file_input);
		
		imagealphablending($img, true);

    } else {

    	echo 'Некорректный формат файла';

		return;

    }

	if ($crop == 'square') {

		$min = $w_i;

		if ($w_i > $h_i) $min = $h_i;

		$w_o = $h_o = $min;

	} else {

		list($x_o, $y_o, $w_o, $h_o) = $crop;

		if ($percent) {

			$w_o *= $w_i / 100;

			$h_o *= $h_i / 100;

			$x_o *= $w_i / 100;

			$y_o *= $h_i / 100;

		}

    	if ($w_o < 0) $w_o += $w_i;

	    $w_o -= $x_o;

	   	if ($h_o < 0) $h_o += $h_i;

		$h_o -= $y_o;

	}

	$img_o = imagecreatetruecolor($w_o, $h_o);
	
	imagealphablending($img_o, false);
	imagesavealpha($img_o, true);  

	imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);

	if ($type == 2) {

		imagejpeg($img_o,$file_output,100);

		

	} else {

		$func = 'image'.$ext;

		$func($img_o,$file_output);

	}

	imagedestroy($img_o);

}

$tmp = "";
if($_COOKIE['UPLOAD_FILES']){
	$tmp = $_COOKIE['UPLOAD_FILES']."/";
}

$path_to_resize = '/upload/tmp/'.$tmp.'resize_to_show';
if (!file_exists($_SERVER['DOCUMENT_ROOT'].$path_to_resize)) {
	mkdir($_SERVER['DOCUMENT_ROOT'].$path_to_resize, 0755, true);
}


$ext = '.jpg';
if(preg_match("/\.png$/i",$_POST['imgs'])){
	$ext = '.png';
}

preg_match('/\.(\w)+$/',$_POST['imgs'],$patt);

$path_pieces = explode("/",$_POST['imgs']);

$new_path = $path_to_resize.'/'.($k+1).$ext;


$x1 = round($_POST['coords'][$_POST['num_img']][0] * $_POST['coords'][$_POST['num_img']][8]);
$y1 = round($_POST['coords'][$_POST['num_img']][2] * $_POST['coords'][$_POST['num_img']][8]);
$x2 = $x1 + $_POST['coords'][$_POST['num_img']][6];
$y2 = $y1 + $_POST['coords'][$_POST['num_img']][7];



$work_area_whidth = $_POST['coords'][$_POST['num_img']][6];
$work_area_height = $_POST['coords'][$_POST['num_img']][7];
$new_width = $img_size[0];
$new_height = $img_size[1];

if(!($work_area_height/$new_height < $work_area_whidth/$new_width)){
	while($new_height>$work_area_height || $new_height<$work_area_height){
		$del = $work_area_height/$new_height;
		$new_height = $work_area_height;
		$new_width = floor($new_width*$del);	
	}
}else{
	while($new_width>$work_area_whidth || $new_width<$work_area_whidth){
		$del = $work_area_whidth/$new_width;
		$new_width = $work_area_whidth;
		$new_height = floor($new_height*$del);	
	}
}
			

$k_9 = (isset($_POST['coords'][$_POST['num_img']][9]) && $_POST['coords'][$_POST['num_img']][9])? $_POST['coords'][$_POST['num_img']][9]:1;

if(isset($_POST['coords'][$_POST['num_img']][9]) && $_POST['coords'][9]){
	$x1 = round($_POST['coords'][$_POST['num_img']][0] * $k_9);
	$y1 = round($_POST['coords'][$_POST['num_img']][2] * $k_9);
}else{
	$x1 = 0;
	$y1 = 0;
}

$x2 = $x1 + $_POST['coords'][$_POST['num_img']][6];
$y2 = $y1 + $_POST['coords'][$_POST['num_img']][7];
			

if($new_width<$x2){
	$x2 = $new_width;
	$x1 = $x2-$_POST['coords'][$_POST['num_img']][6];
}

if($new_height<$y2){
	$y2 = $new_height;
	$y1 = $y2-$_POST['coords'][$_POST['num_img']][7];
}
resizePropImage($_SERVER['DOCUMENT_ROOT'].urldecode($_POST['imgs']), $_SERVER['DOCUMENT_ROOT'].$new_path, $new_width, $new_height);

while($new_width<$x2 && $x1>=0){
	$x2--;
	$x1--;
}

while($new_height<$y2 && $y1>=0){
	$y2--;
	$y1--;
}	

crop($_SERVER['DOCUMENT_ROOT'].$new_path, $_SERVER['DOCUMENT_ROOT'].$new_path, array($x1, $y1, $x2, $y2));	
		
$try = 0;
$upload = $YaDisk->upload($new_path,$dir.($k+1).$ext);
while( !$upload && $try<4){
	$upload = $YaDisk->upload($new_path,$dir.($k+1).$ext);
	$try++;
}

echo $_SERVER['DOCUMENT_ROOT'].$new_path;
?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>