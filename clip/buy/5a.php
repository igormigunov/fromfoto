<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Мой клип");
$APPLICATION->SetPageProperty("keywords", "fromfoto.com - создание клипов!");
$APPLICATION->SetPageProperty("description", "fromfoto.com - создание клипов!");
$APPLICATION->SetTitle(""); ?> <? $APPLICATION->SetTitle("Мой клип");?> <? $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"vk_my_clip",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "clips",
		"IBLOCK_ID" => "",
		"ELEMENT_ID" => $_REQUEST['num'],
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array("ACTIVE_TO"),
		"PROPERTY_CODE" => array("USER_NAME","USER_EMAIL","VIDEO","PAID","TYPE_CLIP", "FILE_LINK", "NO_LOGO", "VIDEO_COUNT"),
		"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
		"META_KEYWORDS" => "KEYWORDS",
		"META_DESCRIPTION" => "DESCRIPTION",
		"BROWSER_TITLE" => "BROWSER_TITLE",
		"DISPLAY_PANEL" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => Array("1"),
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "Y",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Страница",
		"PAGER_TEMPLATE" => "",
		"PAGER_SHOW_ALL" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?> <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>