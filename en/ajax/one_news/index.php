<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? $APPLICATION->IncludeComponent("bitrix:news.detail","news_pp",Array(
	                    	"DISPLAY_DATE" => "N",
	                    	"DISPLAY_NAME" => "N",
	                    	"DISPLAY_PICTURE" => "N",
	                    	"DISPLAY_PREVIEW_TEXT" => "N",
	                    	"AJAX_MODE" => "N",
	                    	"IBLOCK_TYPE" => "news",
	                    	"IBLOCK_ID" => "",
	                    	"ELEMENT_ID" => $_REQUEST['ID'],
	                    	"ELEMENT_CODE" => "",
	                    	"CHECK_DATES" => "Y",
		                    "FIELD_CODE" => "",
		                    "PROPERTY_CODE" => "",
		                    "IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",
		                    "META_KEYWORDS" => "KEYWORDS",
		                    "META_DESCRIPTION" => "DESCRIPTION",
		                    "BROWSER_TITLE" => "BROWSER_TITLE",
	                    	"DISPLAY_PANEL" => "N",
	                    	"SET_TITLE" => "N",
	                    	"SET_STATUS_404" => "N",
	                    	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	                    	"ADD_SECTIONS_CHAIN" => "N",
	                    	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	                    	"USE_PERMISSIONS" => "N",
	                    	"GROUP_PERMISSIONS" => Array("1"),
	                    	"CACHE_TYPE" => "A",
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
                    );?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>