<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?
$mrh_pass1 = "7Qq9hoK9WU";
$out_summ = $_REQUEST["OutSum"];
$inv_id = preg_replace("/0959$/", '', $_REQUEST["InvId"]);
$shp_item = $_REQUEST["shpItem"];
$crc = $_REQUEST["SignatureValue"];

$crc = strtoupper($crc);

$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:shpItem=$shp_item"));

$_REQUEST["InvId"] = preg_replace("/0959$/", '', $_REQUEST["InvId"]);

if ($my_crc != $crc) { echo "bad sign\n"; exit(); } 


CModule::IncludeModule("iblock");






if(isset($_REQUEST['lang']) && $_REQUEST['lang'] == 'en'){
	LocalRedirect('/en/payeer/success.php');
}
?>
<? $APPLICATION->SetTitle("Успешная операция");?>
<h1 style="padding:10px;">Операция по оплате проведена успешно! Теперь Вы можете скачать свой клип у Вас на странице(когда он будет готов) и мы никогда его не удалим! </h1>
<h1 style="padding:10px;">Если клип еще не готов, информацию о его готовности и страница с его наличием будет выслана Вам по электронной почте.</h1>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>