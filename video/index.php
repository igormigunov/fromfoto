<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?

function file_force_download($file) {
	print_r( $_SERVER );
}


if($_REQUEST['video_id']){
	file_force_download($_SERVER['DOCUMENT_ROOT'].CFile::GetPath($_REQUEST['video_id']));
}


?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>