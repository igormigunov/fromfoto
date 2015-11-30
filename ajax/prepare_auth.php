<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $USER; ?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>

<?

if(!$USER->IsAuthorized()){
	$_SESSION['user_clip_data'] = $_POST;
}elseif(isset($_SESSION['user_clip_data'])){
	unset($_SESSION['user_clip_data']);	
}

CModule::IncludeModule("iblock");
$arFilter = Array(
   "IBLOCK_ID"=>"31", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>($_POST['SECTION_ID'])? $_POST['SECTION_ID']:-1
   );
$arSelect = array("PROPERTY_SIZE","PROPERTY_SECOND","PROPERTY_NO_VIDEO","ID","NAME");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$photo = array();
while($ar_fields = $res->GetNext())
{
  $photo[] = $ar_fields;
}

set_time_limit(0);
function crop($file_input, $file_output, $crop = 'square',$percent = false) {

	list($w_i, $h_i, $type) = getimagesize($file_input);

	if (!$w_i || !$h_i) {

		echo 'Невозможно получить длину и ширину изображения';

		return;

    }

    $types = array('','gif','jpeg','png','mp4','mov','flv','avi');

    $ext = $types[$type];

    if ($ext) {

    	$func = 'imagecreatefrom'.$ext;

    	$img = $func($file_input);

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

//выбор текстов для данного клипа
$arFilter = Array(
   "IBLOCK_ID"=>"32", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>($_POST['section_text_id'])? $_POST['section_text_id']:-1
   );
$arSelect = array("PROPERTY_S_REQ","ID","NAME");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$texts = array();
while($ar_fields = $res->GetNext())
{
  $texts[] = $ar_fields;
}

print_r();

$errors = array();



$tmp = "";

if($_COOKIE['UPLOAD_FILES']){

	$tmp = $_COOKIE['UPLOAD_FILES']."/";

}



$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp;



if($_POST){

	if(sizeof($_POST['coords']) > sizeof($_POST['imgs'])){

		$errors[] = "Количество картинок, необходимое для данного клипа, должно быть ".sizeof($_POST['coords']);

	}
	
	$count_video = 0;
	$wrang_picture = array();

	if(is_array($_POST['imgs']))

	foreach($_POST['imgs'] as $k=>$v){
		
		if(isset($_POST['coords'][$k])){
			if(preg_match("/\.mp4$|\.avi$|\.mov$/i",$v)){
				$count_video++;
			}

			$img_size = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);

			//echo $v,'<br>';

			//var_dump($img_size);echo '<br/><br/>';

			if((!$img_size && !preg_match("/\.mp4$|\.avi$|\.mov$/i",$v)) || preg_match("/\.gif$/i",$v)){

				$errors[] = "Картинка за номером ".($k+1)." имеет неправильный формат названия!";

				continue;

			}
			
			if($photo[$k]['PROPERTY_NO_VIDEO_VALUE'] && preg_match("/\.mp4$|\.avi$|\.mov$/i",$v)){

				$errors[] = "Поменяйте видео за номером ".($k+1)." на картинку!";

				continue;

			}
			
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
			
			if(($new_height/$work_area_height) > 1.4 && !isset($_POST['coords'][$k][9])){
				
				$wrang_picture[] = ($k+1);

				//$errors[] = "Картинка за номером ".($k+1)." имеет неправильный размер! Минимально допустимый размер данного изображения - ".$_POST['coords'][$k][6]."X".$_POST['coords'][$k][7];

			}
			
			
			
			

			if($img_size[0]<$_POST['coords'][$k][6] || $img_size[1]<$_POST['coords'][$k][7]){

				//$errors[] = "Картинка за номером ".($k+1)." имеет неправильный размер! Минимально допустимый размер данного изображения - ".$_POST['coords'][$k][6]."X".$_POST['coords'][$k][7];

			}
		}

	}
	
	if($wrang_picture && !(isset($_POST['simple']) && $_POST['simple']=='simple')){
		$errors[] = "<span class='error_vertical_aj'>Поправьте фото ".implode(",",$wrang_picture)." и Ваше видео станет гораздо лучше</span>";
	}

	foreach($_POST['texts'] as $k=>$v){

		if(!trim($v) && $texts[$k]['PROPERTY_S_REQ_VALUE']){

			$errors[] = "К сожалению, текст №".($k+1)." обязательно должен быть заполнен.";

		}

	}	

	if(!trim($_POST['mp3']) || !preg_match("/\.mp3$/i",$_POST['mp3'])){

		$errors[] = "Добавьте музыку(mp3) для Вашего будущего клипа!";

	}

	if(!$_POST['video_id'] || !$_POST['maket']){

		$errors[] = "Неизвестная ошибка. Повторите позже.";

	}

}

if(!$errors){
	echo "1";
}else{
	echo "<div class=\"errors\">".implode("<br />",$errors)."</div>";
}

?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>