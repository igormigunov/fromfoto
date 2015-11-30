<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $USER; ?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>



<?
set_time_limit(0);

if(isset($_SESSION['user_clip_data']) && $USER->IsAuthorized()){
	$_POST = $_SESSION['user_clip_data'];
	unset($_SESSION['user_clip_data']);
}

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
	if(isset($_POST['email_vk']) && !check_post_email($_POST['email_vk'])){
		$errors[] = "Введите корректный e-mail!";
	}
	
	if(sizeof($_POST['coords']) > sizeof($_POST['imgs'])){

		$errors[] = "Количество картинок, необходимое для данного клипа, должно быть ".sizeof($_POST['coords']);

	}

	if(is_array($_POST['imgs']))

	foreach($_POST['imgs'] as $k=>$v){
		
	if(isset($_POST['coords'][$k])){
		$img_size = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);

		//echo $v,'<br>';

		//var_dump($img_size);echo '<br/><br/>';

		if(!$img_size && !preg_match("/\.mp4$|\.avi$|\.mov$/i",$v)){

			$errors[] = "Картинка за номером ".($k+1)." имеет неправильный формат названия!";

			continue;

		}

		if($img_size[0]<$_POST['coords'][$k][6] || $img_size[1]<$_POST['coords'][$k][7]){

			//$errors[] = "Картинка за номером ".($k+1)." имеет неправильный размер! Минимально допустимый размер данного изображения - ".$_POST['coords'][$k][6]."X".$_POST['coords'][$k][7];

		}
	}

	}

	foreach($_POST['texts'] as $k=>$v){

		if(!trim($v)){

			//$errors[] = "Заполните текст за номером ".($k+1)."!";

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
		
		$dir = '/'.$_SESSION['PRODUCT_ID'].'_33/';

		$YaDisk = new YaDisk(	1,//$YaAuth->getToken(),
								$conf,
								$logger,
								$dir
							);


		$YaDisk->mkdir($dir);

		

		$path_to_resize = '/upload/tmp/'.$tmp.'resize';

		if (!file_exists($_SERVER['DOCUMENT_ROOT'].$path_to_resize)) {

    		mkdir($_SERVER['DOCUMENT_ROOT'].$path_to_resize, 0755, true);

		}

		$check_list;
		
		if(isset($_POST['simple']) && $_POST['simple']=='simple'){
			$YaDisk->mkdir($dir.'img_from_simple/');
			foreach($_POST['imgs'] as $k=>$v){
				if(isset($_POST['coords'][$k])){
				$ext = '.jpg';
				if(preg_match("/\.mp4$|\.avi$|\.mov$|\.png$/i",$v, $ext_pt)){
					$ext = $ext_pt[0];
				}
					
				$try = 0;
				$upload = $YaDisk->upload(urldecode($v),$dir.'img_from_simple/'.($k+1).$ext);
				while( !$upload && $try<4){
					$upload = $YaDisk->upload(urldecode($v),$dir.'img_from_simple/'.($k+1).$ext);
					$try++;
				}
				$check_list = $check_list.($k+1).$ext.'
				';
				}
			}
			if(!$USER->IsAuthorized()){
				$arFields = array(	'LINK'=>'https://disk.yandex.ru/client/disk'.$dir,
								'EMAIL'=>$_POST['email'],
								'NAME'=>$_POST['name']);
				CEvent::SendImmediate("CREATE_SIMPLE_VIDEO", "s1", $arFields);
			}
		}else{
		foreach($_POST['imgs'] as $k=>$v){
			
			$img_size = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);

			if(isset($_POST['coords'][$k])){
				
				if(preg_match("/\.mp4$|\.avi$|\.mov$/i",$v, $ext)){
					$try = 0;
					$upload = $YaDisk->upload(urldecode($v),$dir.($k+1).$ext[0]);
					while( !$upload && $try<4){
						$upload = $YaDisk->upload(urldecode($v),$dir.($k+1).$ext[0]);
						$try++;
					}
					$check_list = $check_list.($k+1).$ext[0].'
					';
					continue;
				}
				
				$ext = '.jpg';
				if(preg_match("/\.png$/i",$v)){
					$ext = '.png';
				}
				

				

				preg_match('/\.(\w)+$/',$v,$patt);

				$path_pieces = explode("/",$v);

				$new_path = $path_to_resize.'/'.($k+1).$ext;


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
			

				//if($new_width < $img_size[0] || $new_height < $img_size[1] || $_POST['coords'][$k][8] < 1){
					$k_9 = (isset($_POST['coords'][$k][9]) && $_POST['coords'][$k][9])? $_POST['coords'][$k][9]:1;
					
					if(isset($_POST['coords'][$k][9]) && $_POST['coords'][$k][9]){
						$x1 = round($_POST['coords'][$k][0] * $k_9);
						$y1 = round($_POST['coords'][$k][2] * $k_9);
					}else{
						//$x1 = ($new_width>$_POST['coords'][$k][6])? round(($new_width-$_POST['coords'][$k][6])/2):0;
						//$y1 = ($new_height>$_POST['coords'][$k][7])? round(($new_height-$_POST['coords'][$k][7])/2):0;
						$x1 = 0;
						$y1 = 0;
					}

					$x2 = $x1 + $_POST['coords'][$k][6];

					$y2 = $y1 + $_POST['coords'][$k][7];
				//}
			
				
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
				//imagejpeg ($dst, $new_path,$dir.($k+1).$ext, 100);
				//imagedestroy($src);

			
				$try = 0;
				$upload = $YaDisk->upload($new_path,$dir.($k+1).$ext);
				while( !$upload && $try<4){
					$upload = $YaDisk->upload($new_path,$dir.($k+1).$ext);
					$try++;
				}
				$check_list = $check_list.($k+1).$ext.'
				';

			}

		}
		}
		
		if(isset($_POST['user_logo']) && $_POST['user_logo']){
			$path_to_resize = '/upload/tmp/'.$tmp.'resize';
			$ext = '.jpg';
			if(preg_match("/\.gif$|\.png$/i",$_POST['user_logo_src'], $ext_pt)){
				$ext = $ext_pt[0];
			}
			$logo_path = $path_to_resize.'/user_logo'.$ext;
			
			
			$img_size = getimagesize('http://'.$_SERVER['HTTP_HOST'].$_POST['user_logo_src']);

			$new_width = $img_size[0];
			$new_height = $img_size[1];
			
			$del = $_POST['user_width']/$new_width;
			$new_width = $_POST['user_width'];
			$new_height = floor($new_height*$del);
			

			
			
			
			resizePropImage($_SERVER['DOCUMENT_ROOT'].urldecode($_POST['user_logo_src']), $_SERVER['DOCUMENT_ROOT'].$logo_path, $new_width, $new_height);
			
			crop($_SERVER['DOCUMENT_ROOT'].$logo_path, $_SERVER['DOCUMENT_ROOT'].$logo_path, array(0, 0, $_POST['user_width'], $new_height));
			
			$try = 0;
			$upload = $YaDisk->upload($logo_path,$dir.'user_logo'.$ext);
			while( !$upload && $try<4){
				$upload = $YaDisk->upload($logo_path,$dir.'user_logo'.$ext);
				$try++;
			}
			$check_list = $check_list.'user_logo'.$ext.'
			';
		}
		
		
		
		
		if(isset($_POST['ph_user_logo']) && $_POST['ph_user_logo']){
			$path_to_resize = '/upload/tmp/'.$tmp.'resize';
			$ext = '.jpg';
			if(preg_match("/\.gif$|\.png$/i",$_POST['ph_user_logo_src'], $ext_pt)){
				$ext = $ext_pt[0];
			}
			$logo_path = $path_to_resize.'/photographer_logo'.$ext;
			
			
			$img_size = getimagesize('http://'.$_SERVER['HTTP_HOST'].$_POST['ph_user_logo_src']);

			$new_width = $img_size[0];
			$new_height = $img_size[1];
			
			$del = $_POST['ph_user_width']/$new_width;
			$new_width = $_POST['ph_user_width'];
			$new_height = floor($new_height*$del);
			

			
			
			
			resizePropImage($_SERVER['DOCUMENT_ROOT'].urldecode($_POST['ph_user_logo_src']), $_SERVER['DOCUMENT_ROOT'].$logo_path, $new_width, $new_height);
			
			crop($_SERVER['DOCUMENT_ROOT'].$logo_path, $_SERVER['DOCUMENT_ROOT'].$logo_path, array(0, 0, $_POST['ph_user_width'], $new_height));
			
			$try = 0;
			$upload = $YaDisk->upload($logo_path,$dir.'photographer_logo'.$ext);
			while( !$upload && $try<4){
				$upload = $YaDisk->upload($logo_path,$dir.'photographer_logo'.$ext);
				$try++;
			}
			$check_list = $check_list.'photographer_logo'.$ext.'
			';
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
			

			fwrite($fp, trim($v));

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
		
		
		$fp = fopen($uploaddir_texts.'wait_24.txt', 'w');
		if(isset($_REQUEST['vk'])){
			fwrite($fp, "1");
		}else{
			fwrite($fp, "0");
		}
		fclose($fp);
		
		$try = 0;
		$upload = $YaDisk->upload($path_to_texts.'/wait_24.txt', $dir.'wait_24.txt');
		while( !$upload && $try<4){
			$upload = $YaDisk->upload($path_to_texts.'/wait_24.txt', $dir.'wait_24.txt');
			$try++;
		}

		
		$check_list = $check_list.'wait_24.txt
		';
		
		
		if(isset($_POST['free_period']) && !$_POST['free_period']){
			$fp = fopen($uploaddir_texts.'paid.txt', 'w');

			fwrite($fp, "1");

			fclose($fp);
		
		
			$try = 0;
			$upload = $YaDisk->upload($path_to_texts.'/paid.txt', $dir.'paid.txt');
			while( !$upload && $try<4){
				$upload = $YaDisk->upload($path_to_texts.'/paid.txt', $dir.'paid.txt');
				$try++;
			}

		
			$check_list = $check_list.'paid.txt
			';
		}
		
		
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
		
		if(isset($_REQUEST['clear_dir'])){
			clear_dir($_SERVER['DOCUMENT_ROOT'].$_REQUEST['clear_dir']);
		}

		

		

	

}else{

	echo "<div class=\"errors\">".implode("<br />",$errors)."</div>";

}

?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>