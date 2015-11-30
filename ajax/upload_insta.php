<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?php
if(!$_POST['files']){
	exit('<br />Вы не выбрали ни одной фотографии!<br />');
}
$tmp = "";
if($_COOKIE['UPLOAD_FILES']){
	$tmp = $_COOKIE['UPLOAD_FILES']."/";
}
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp;
if (!file_exists($uploaddir)) {
	mkdir($uploaddir, 0755, true);
	mkdir($uploaddir.'thumbnail/', 0755, true);
}
foreach($_POST['files'] as $file){
	if(	
		$file[1] 
		&& $file[0] 
		&& preg_match('/\.jpg$|\.jpeg$|\.bmp$|\.png$|\.gif$/', $file[1]) 
		&& preg_match('/\.jpg$|\.jpeg$|\.bmp$|\.png$|\.gif$/', $file[0]) 
	){
		$content = file_get_contents($file[1]);
		$content_thmb = file_get_contents($file[0]);
		$ext = '.jpg';
		if(preg_match("/\..{2,6}$/", $file[1], $ext_pt)){
			$ext = $ext_pt[0];
		}
		
		$file_name = date('Ymdhis').rand(999999,9999999);
		$fp = fopen($uploaddir.$file_name.$ext, "w");
		fwrite($fp, $content);
		fclose($fp);
		
		$fp = fopen($uploaddir.'thumbnail/'.$file_name.$ext, "w");
		fwrite($fp, $content_thmb);
		fclose($fp);
	}
}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>