<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords", "создать видео из фото, слайдшоу, слайд шоу из фотографий, слайд шоу с музыкой онлайн, видео подарки, фромфото, fromfoto, слайд шоу онлайн, видео из фотографий и музыки");
$APPLICATION->SetPageProperty("description", "На нашем сайте вы можете бесплатно создать видео из фотографий  и музыки в виде уникального слайд-шоу. Также в вашем распоряжении большое количество дополнительных шаблонов и...");

$APPLICATION->SetPageProperty("title", "Создавай свое видео из фото на Fromfoto.com");

$APPLICATION->SetTitle("Создавай своё видео");

?> 
<? 
if(!$_REQUEST['PRODUCT_ID']):?>
<?
$_REQUEST['PRODUCT_ID'] = 999999999999;
?>
<? endif; ?>
<? 
if($_REQUEST['PRODUCT_ID']){
	$GLOBALS['arrFilter'] = array('ID' => $_REQUEST['PRODUCT_ID']); 
}else{
	$GLOBALS['arrFilter'] = array('ID' => explode(",", $_COOKIE['ORDERS_ID'])); 
}

?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"wait_clips_2015",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "33",
		"NEWS_COUNT" => "3000",
		"SORT_BY1" => "timestamp_x",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array("DATE_CREATE"),
		"PROPERTY_CODE" => array("USER_NAME","USER_EMAIL","VIDEO","PAID","TYPE_CLIP", "FILE_LINK", "NO_LOGO", "VIDEO_COUNT", "TELL_FRIENDS", "USER"),
		"CHECK_DATES" => "N",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d-m-Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "Y",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "N"
	)
);?>

 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>