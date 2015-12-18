<? require($_SERVER["DOCUMENT_ROOT"]."/fd_images/fd.php");?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $USER; ?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>
<?
set_time_limit(0);

function myscandir($dir){
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
			if(!$img_size && !preg_match("/\.mp4$|\.avi$|\.mov$/i",$v)){
				$errors[] = "Картинка за номером ".($k+1)." имеет неправильный формат названия!";
				continue;
			}
		}
	}

	if(!trim($_POST['mp3'])){

		$errors[] = "Добавьте музыку(mp3) для Вашего будущего клипа!";

	}

	if(!$_POST['video_id'] || !$_POST['maket']){

		$errors[] = "Неизвестная ошибка. Повторите позже.";

	}

}else{
	$errors[] = "Неизвестная ошибка. Повторите позже.";
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
		
		foreach($_POST['imgs'] as $k=>$v){

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
				$try = 0;
				$upload = $YaDisk->upload(urldecode($v), $dir.($k+1).$ext);
				while( !$upload && $try<4){
					$upload = $YaDisk->upload(urldecode($v), $dir.($k+1).$ext);
					$try++;
				}
				$check_list = $check_list.($k+1).$ext.'
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
		
		$fp = fopen($uploaddir_texts.'sizes_photo.txt', 'w');
		$sizes_photo = '';
		foreach($_POST['coords'] as $k=>$coord){
			$sizes_photo = $sizes_photo.($k+1).' '.$coord.'
			';
		}
		fwrite($fp, $sizes_photo);
		fclose($fp);
		$try = 0;
		$upload = $YaDisk->upload($path_to_texts.'/sizes_photo.txt', $dir.'sizes_photo.txt');
		while( !$upload && $try<4){
			$upload = $YaDisk->upload($path_to_texts.'/sizes_photo.txt', $dir.'sizes_photo.txt');
			$try++;
		}
		$check_list = $check_list.'sizes_photo.txt'.'
		';
		
		
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
		//if(isset($_REQUEST['vk'])){
			fwrite($fp, "1");
		//}else{
			//fwrite($fp, "0");
		//}
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

		
			/*$check_list = $check_list.'paid.txt
			';*/
		}
		
		
		//if(!isset($_POST["add_misst"])){
			$fp = fopen($uploaddir_texts.'temp_mk_001.txt', 'w');

			fwrite($fp, $_POST['maket']);

			fclose($fp);
			
			$try = 0;
			$upload = $YaDisk->upload($path_to_texts.'/temp_mk_001.txt', $dir.'temp_mk_001.txt');
			while( !$upload && $try<4){
				$upload = $YaDisk->upload($path_to_texts.'/temp_mk_001.txt', $dir.'temp_mk_001.txt');
				$try++;
			}
		//}

		
		$check_list = $check_list.'maket.txt
		';
				
		
		$check_list_name = 'check_list.txt';
		$fp = fopen($uploaddir_texts.$check_list_name, 'w');

		fwrite($fp, $check_list);

		fclose($fp);
		
		$try = 0;
		$upload = $YaDisk->upload($path_to_texts.'/'.$check_list_name, $dir.$check_list_name);
		while( !$upload && $try<4){
			$upload = $YaDisk->upload($path_to_texts.'/'.$check_list_name, $dir.$check_list_name);
			$try++;
		}



		fd_images($_SESSION['PRODUCT_ID'].'_33');
		//$content = file_get_contents('http://fromfoto.com/face_detected/?zakaz1=' . $_SESSION['PRODUCT_ID'].'_33', 'r');

		//$fp = fopen($uploaddir_texts.'fd_send.txt', 'w');
			//fwrite($fp, $content);
		//fclose($fp);

		//$try = 0;
		//$upload = $YaDisk->upload($path_to_texts.'/fd_send.txt', $dir.'fd_send.txt');
		//while( !$upload && $try<4){
		//	$upload = $YaDisk->upload($path_to_texts.'/fd_send.txt', $dir.'fd_send.txt');
		//	$try++;
		//}
	$arFields = array(

		"NAME" => $_POST['email_vk'],

		"LINK_TO" => 'http://'.$_SERVER['HTTP_HOST'].'/step_three/?PRODUCT_ID='.$_SESSION['PRODUCT_ID'],

		"EMAIL" => $_POST['email_vk']

	);
	CEvent::SendImmediate("ORDER_CLIP", "s1", $arFields);

		clear_dir($_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'/resize/');
		clear_dir($_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'/texts/');
		
}else{

	echo "<div class=\"errors\">".implode("<br />",$errors)."</div>";

}
?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>