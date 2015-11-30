<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $APPLICATION; ?>
<?php
$_SESSION['texts_user'] = $_POST['texts'];
exit();
if($_COOKIE['UPLOAD_FILES']){
	$tmp = $_COOKIE['UPLOAD_FILES']."/";
}
$uploaddir = $_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$tmp.'texts.txt';

$arTexts = array();

foreach($_POST['texts'] as $k=>$v){
	$arTexts[$k] = $v;
}

$APPLICATION->SaveFileContent($uploaddir, serialize($arTexts));

echo("ok");
?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>