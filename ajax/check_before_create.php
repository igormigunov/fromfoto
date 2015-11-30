<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? global $USER; ?>
<?
if($_POST['no_athorize']){
	$_SESSION['user_clip_data'] = $_POST;
}
?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/common_data.php");?>
<?
if($errors){
	echo "<div class=\"errors\">".implode("<br />",$errors)."</div>";
}else{
	echo '1';	
}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>