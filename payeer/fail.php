<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?
if(isset($_REQUEST['lang']) && $_REQUEST['lang'] == 'en'){
	LocalRedirect('/en/payeer/fail.php');
}

?>

<? $APPLICATION->SetTitle("Отмена операции");?>
<h1>Операция по оплате не была проведена</h1>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>