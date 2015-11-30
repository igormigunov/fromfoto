<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>

<?
set_time_limit(0);

function resizePropImage($input, $output, $width = 0, $height = 0){
	$size=getimagesize ($input);
	$imgFormat=basename($size['mime']);
	$createImg='imagecreatefrom'.strtolower($imgFormat);
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
	imagecopyresampled ($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $iw, $ih);
	imagejpeg ($dst, $output, 100);
	imagedestroy($src);
}

function crop($file_input, $file_output, $crop = 'square',$percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo 'Unable to get the length and width of the image';
		return;
    }
    $types = array('','gif','jpeg','png');
    $ext = $types[$type];
    if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
    } else {
    	echo 'Invalid file format';
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
	imagecopy($img_o, $img, 0, 0, $x_o, $y_o, $w_o, $h_o);
	if ($type == 2) {
		imagejpeg($img_o,$file_output,100);
		
	} else {
		$func = 'image'.$ext;
		$func($img_o,$file_output);
	}
	imagedestroy($img_o);
}

function myscandir($dir)
{
    $list = scandir($dir);
    unset($list[0],$list[1]);
    return array_values($list);
}

function clear_dir($dir)
{
    $list = myscandir($dir);
    
    foreach ($list as $file)
    {
        if (is_dir($dir.$file))
        {
            clear_dir($dir.$file.'/');
            rmdir($dir.$file);
        }
        else
        {
            unlink($dir.$file);
        }
    }
}

?>

<?

$errors = array();



$tmp = "";

if($_COOKIE['UPLOAD_FILES']){

	$tmp = $_COOKIE['UPLOAD_FILES']."/";

}



$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp;
$uploaddir_texts = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'/texts/';



if($_POST){

	if(!(trim($_POST['name']))){

		$errors[] = "Введите Ваше имя!";

	}

	if(!check_post_email($_POST['email'])){

		$errors[] = "Введите корректный e-mail!";

	}

	if(sizeof($_POST['coords']) > sizeof($_POST['imgs'])){

		$errors[] = "Количество картинок, необходимое для данного клипа, должно быть ".sizeof($_POST['coords']);

	}

	if(is_array($_POST['imgs']))

	foreach($_POST['imgs'] as $k=>$v){

		$img_size = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);

		//echo $v,'<br>';

		//var_dump($img_size);echo '<br/><br/>';

		if(!$img_size){

			$errors[] = "Картинка за номером ".($k+1)." имеет неправильный формат названия!";

			continue;

		}

		if($img_size[0]<$_POST['coords'][$k][6] || $img_size[1]<$_POST['coords'][$k][7]){

			$errors[] = "Картинка за номером ".($k+1)." имеет неправильный размер! Минимально допустимый размер данного изображения - ".$_POST['coords'][$k][6]."X".$_POST['coords'][$k][7];

		}

	}

	foreach($_POST['texts'] as $k=>$v){

		if(!trim($v)){

			$errors[] = "Заполните текст за номером ".($k+1)."!";

		}

	}	

	if(!trim($_POST['mp3'])){

		$errors[] = "Добавьте музыку(mp3) для Вашего будущего клипа!";

	}

	if(!$_POST['video_id'] || !$_POST['maket']){

		$errors[] = "Неизвестная ошибка. Повторите позже.";

	}

}

if(!$errors){
	
		$path_to_texts = '/upload/tmp/'.$tmp.'texts';

		if (!file_exists($_SERVER['DOCUMENT_ROOT'].$path_to_texts)) {

    		mkdir($_SERVER['DOCUMENT_ROOT'].$path_to_texts, 0755, true);

		}

	

		$conf = new Config();

		$logger = new Logger();

		$YaAuth = new YaAuth($conf,$logger);

		$YaDisk = new YaDisk($YaAuth->getToken(),$conf,$logger);

		$dir = '/'.$_SESSION['PRODUCT_ID'].'_33/';

		$YaDisk->mkdir($dir);

		

		$path_to_resize = '/upload/tmp/'.$tmp.'resize';

		if (!file_exists($_SERVER['DOCUMENT_ROOT'].$path_to_resize)) {

    		mkdir($_SERVER['DOCUMENT_ROOT'].$path_to_resize, 0755, true);

		}

		$check_list;

		foreach($_POST['imgs'] as $k=>$v){
			
			$img_size = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);

			if(isset($_POST['coords'][$k])){

				preg_match('/\.(\w)+$/',$v,$patt);

				$path_pieces = explode("/",$v);

				$new_path = $path_to_resize.'/'.($k+1).'.jpg';


				$x1 = round($_POST['coords'][$k][0] * $_POST['coords'][$k][8]);

				$y1 = round($_POST['coords'][$k][2] * $_POST['coords'][$k][8]);

				$x2 = $x1 + $_POST['coords'][$k][6];

				$y2 = $y1 + $_POST['coords'][$k][7];
				
				
				
				$work_area_whidth = $_POST['coords'][$k][6];
				$work_area_height = $_POST['coords'][$k][7];
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
			
			
			
				if($new_width < $img_size[0] || $new_height < $img_size[1] || $_POST['coords'][$k][8] < 1){
					$x1 = round($_POST['coords'][$k][0] * $_POST['coords'][$k][9]);

					$y1 = round($_POST['coords'][$k][2] * $_POST['coords'][$k][9]);

					$x2 = $x1 + $_POST['coords'][$k][6];

					$y2 = $y1 + $_POST['coords'][$k][7];
				}
			
				
				if($new_width<$x2){

					$x2 = $new_width;
					$x1 = $x2-$_POST['coords'][$k][6];

				}
				
				if($new_height<$y2){
					$y2 = $new_height;
					$y1 = $y2-$_POST['coords'][$k][7];
				}
			
			
				
				
				resizePropImage($_SERVER['DOCUMENT_ROOT'].urldecode($v), $_SERVER['DOCUMENT_ROOT'].$new_path, $new_width, $new_height);
				
				//echo $new_width.'--'.$new_height;
				//exit();
				
				
				
				
				while($new_width<$x2 && $x1>=0){
					$x2--;
					$x1--;
				}
				
				while($new_height<$y2 && $y1>=0){
					$y2--;
					$y1--;
				}
				


			

				crop($_SERVER['DOCUMENT_ROOT'].$new_path, $_SERVER['DOCUMENT_ROOT'].$new_path, array($x1, $y1, $x2, $y2));	
				
				
				//$size=getimagesize ($_SERVER['DOCUMENT_ROOT'].$new_path);
				//$src=imagecreatefromjpeg ($_SERVER['DOCUMENT_ROOT'].$new_path);
				//$iw=$size[0];
				//$ih=$size[1];
				//$koe=$iw/$_POST['coords'][$k][6];
				//$new_h=ceil ($ih/$koe);
				//$dst=imagecreatetruecolor ($_POST['coords'][$k][6], $new_h);
				//imagecopyresampled ($dst, $src, 0, 0, 0, 0, $_POST['coords'][$k][6], $new_h, $iw, $ih);
				//imagejpeg ($dst, $new_path,$dir.($k+1).'.jpg', 100);
				//imagedestroy($src);

			
				$try = 0;
				$upload = $YaDisk->upload($new_path,$dir.($k+1).'.jpg');
				while( !$upload && $try<4){
					$upload = $YaDisk->upload($new_path,$dir.($k+1).'.jpg');
					$try++;
				}
				$check_list = $check_list.($k+1).'.jpg
				';

			}

		}
		$try = 0;
		$upload = $YaDisk->upload($_POST['mp3'],$dir.'audio.mp3');
		while( !$upload && $try<4){
			$upload = $YaDisk->upload($_POST['mp3'],$dir.'audio.mp3');
			$try++;
		}
		$check_list = $check_list.'audio.mp3
		';
		

		foreach($_POST['texts'] as $k=>$v){

			$fp = fopen($uploaddir_texts.'text'.($k+1).'.txt', 'w');
			

			fwrite($fp, $v);

			fclose($fp);
			
			$try = 0;
			$upload = $YaDisk->upload($path_to_texts.'/text'.($k+1).'.txt', $dir.'text'.($k+1).'.txt');
			while( !$upload && $try<4){
				$upload = $YaDisk->upload($path_to_texts.'/text'.($k+1).'.txt', $dir.'text'.($k+1).'.txt');
				$try++;
			}

			
			$check_list = $check_list.'text'.($k+1).'.txt
			';

		}
		
		
		$fp = fopen($uploaddir_texts.'no_logo.txt', 'w');

		fwrite($fp, $_POST['no_logo'] ? "1":"0");

		fclose($fp);
		
		$try = 0;
		$upload = $YaDisk->upload($path_to_texts.'/no_logo.txt', $dir.'no_logo.txt');
		while( !$upload && $try<4){
			$upload = $YaDisk->upload($path_to_texts.'/no_logo.txt', $dir.'no_logo.txt');
			$try++;
		}

		
		$check_list = $check_list.'no_logo.txt
		';
		
		
		$fp = fopen($uploaddir_texts.'maket.txt', 'w');

		fwrite($fp, $_POST['maket']);

		fclose($fp);
		
		$try = 0;
		$upload = $YaDisk->upload($path_to_texts.'/maket.txt', $dir.'maket.txt');
		while( !$upload && $try<4){
			$upload = $YaDisk->upload($path_to_texts.'/maket.txt', $dir.'maket.txt');
			$try++;
		}

		
		$check_list = $check_list.'maket.txt
		';
				
				
		$fp = fopen($uploaddir_texts.'check_list.txt', 'w');

		fwrite($fp, $check_list);

		fclose($fp);
		
		$try = 0;
		$upload = $YaDisk->upload($path_to_texts.'/check_list.txt', $dir.'check_list.txt');
		while( !$upload && $try<4){
			$upload = $YaDisk->upload($path_to_texts.'/check_list.txt', $dir.'check_list.txt');
			$try++;
		}

		
		
		

		clear_dir($_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'/resize/');

		clear_dir($_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'/texts/');

		

		

	

}else{

	echo "<div class=\"errors\">".implode("<br />",$errors)."</div>";

}

?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>