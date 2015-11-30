<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>

<?
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

if($_POST){
	if(!(trim($_POST['name']))){
		$errors[] = "Please enter your name!";
	}
	if(!check_post_email($_POST['email'])){
		$errors[] = "Please enter a valid e-mail!";
	}
	if(sizeof($_POST['coords']) > sizeof($_POST['imgs'])){
		$errors[] = "The number of images required for this clip must be ".sizeof($_POST['coords']);
	}
	if(is_array($_POST['imgs']))
	foreach($_POST['imgs'] as $k=>$v){
		$img_size = getimagesize('http://'.$_SERVER['HTTP_HOST'].$v);
		//echo $v,'<br>';
		//var_dump($img_size);echo '<br/><br/>';
		if(!$img_size){
			$errors[] = "Picture for the number ".($k+1)." has invalid format name!";
			continue;
		}
		if($img_size[0]<$_POST['coords'][$k][4] || $img_size[1]<$_POST['coords'][$k][5]){
			$errors[] = "Picture number ".($k+1)." for the wrong size! The minimum allowable size of the image - ".$_POST['coords'][$k][4]."X".$_POST['coords'][$k][5];
		}
	}
	foreach($_POST['texts'] as $k=>$v){
		if(!trim($v)){
			$errors[] = "Fill out the text for the number ".($k+1)."!";
		}
	}	
	if(!trim($_POST['mp3']) || !preg_match("/\.mp3$/",$_POST['mp3'])){
		$errors[] = "Add music (mp3) clip for your future!";
	}
	if(!$_POST['video_id'] || !$_POST['maket']){
		$errors[] = "Unknown error. Repeat later.";
	}
}
if(!$errors){
	CModule::IncludeModule("iblock");
	$el = new CIBlockElement;

	$PROP = array();
	$PROP[110] = $_POST['video_id'];
	$PROP[106] = $_POST['name'];
	$PROP[107] = $_POST['email'];
	$PROP[177] = $_POST['no_logo'] ? 37:0;
	
	$arLoadProductArray = Array(
 	 "MODIFIED_BY"    => 1,
 	 "IBLOCK_SECTION_ID" => false,
 	 "IBLOCK_ID"      => 33,
 	 "PROPERTY_VALUES"=> $PROP,
 	 "NAME"           => $_POST['email'].date("d-m-Y"),
 	 "ACTIVE"         => "Y"
 	 );

	if($PRODUCT_ID = $el->Add($arLoadProductArray)){
		$_SESSION['PRODUCT_ID'] = $PRODUCT_ID;
		
		$arFields = array(
			"NAME" => $_POST['name'],
  			"EMAIL" => $_POST['email'],
			"LINK" => 'http://'.$_SERVER['HTTP_HOST'].'/clip/?num='.$PRODUCT_ID,
		);
		CEvent::SendImmediate("ORDER_CLIP", "en", $arFields);
		
		echo "1";
	}
	else{
		echo "<div class=\"errors\">Unknown error. Repeat later.</div>";
	}
}else{
	echo "<div class=\"errors\">".implode("<br />",$errors)."</div>";
}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>