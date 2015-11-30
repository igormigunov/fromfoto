<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $APPLICATION; ?>
<?php

if($_COOKIE['UPLOAD_FILES']){
	$tmp = $_COOKIE['UPLOAD_FILES']."/";
}
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'data.txt';

$arImages = array();

foreach($_POST['coords'] as $k=>$v){
	$arImages[$k] = array(
		'x1'=>$_POST['coords'][$k][0],
		'x2'=>$_POST['coords'][$k][1],
		'y1'=>$_POST['coords'][$k][2],
		'y2'=>$_POST['coords'][$k][3],
		'width'=>$_POST['coords'][$k][6],
		'height'=>$_POST['coords'][$k][7],
		'file'=>intval($_POST['coords'][$k][10]),
	);
}

$APPLICATION->SaveFileContent($uploaddir, serialize($arImages));

echo("ok");
?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>