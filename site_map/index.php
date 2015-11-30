<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?>
<table class="map-columns">
<tbody>
<tr>
	<td>
		<?$APPLICATION->IncludeComponent("bitrix:menu", "site_map", array(

	                            	"ROOT_MENU_TYPE" => "top",

	                            	"MENU_CACHE_TYPE" => "A",

	                            	"MENU_CACHE_TIME" => "3600",

	                            	"MENU_CACHE_USE_GROUPS" => "N",

	                            	"MENU_CACHE_GET_VARS" => array(

	                            	),

	                            	"MAX_LEVEL" => "2",

	                            	"CHILD_MENU_TYPE" => "left",

                            		"USE_EXT" => "Y",

	                            	"DELAY" => "N",

	                            	"ALLOW_MULTI_SELECT" => "N"

	                            	),

	                            	false

                            	);?>
	</td>
    <td>
		<?$APPLICATION->IncludeComponent("bitrix:menu", "site_map", array(

	                            	"ROOT_MENU_TYPE" => "bottom1",

	                            	"MENU_CACHE_TYPE" => "A",

	                            	"MENU_CACHE_TIME" => "3600",

	                            	"MENU_CACHE_USE_GROUPS" => "N",

	                            	"MENU_CACHE_GET_VARS" => array(

	                            	),

	                            	"MAX_LEVEL" => "2",

	                            	"CHILD_MENU_TYPE" => "left",

                            		"USE_EXT" => "Y",

	                            	"DELAY" => "N",

	                            	"ALLOW_MULTI_SELECT" => "N"

	                            	),

	                            	false

                            	);?>
	</td>
    
    <td>
		<?$APPLICATION->IncludeComponent("bitrix:menu", "site_map", array(

	                            	"ROOT_MENU_TYPE" => "bottom2",

	                            	"MENU_CACHE_TYPE" => "A",

	                            	"MENU_CACHE_TIME" => "3600",

	                            	"MENU_CACHE_USE_GROUPS" => "N",

	                            	"MENU_CACHE_GET_VARS" => array(

	                            	),

	                            	"MAX_LEVEL" => "2",

	                            	"CHILD_MENU_TYPE" => "left",

                            		"USE_EXT" => "Y",

	                            	"DELAY" => "N",

	                            	"ALLOW_MULTI_SELECT" => "N"

	                            	),

	                            	false

                            	);?>
	</td>
    
    <td>
		<?$APPLICATION->IncludeComponent("bitrix:menu", "site_map", array(

	                            	"ROOT_MENU_TYPE" => "bottom3",

	                            	"MENU_CACHE_TYPE" => "A",

	                            	"MENU_CACHE_TIME" => "3600",

	                            	"MENU_CACHE_USE_GROUPS" => "N",

	                            	"MENU_CACHE_GET_VARS" => array(

	                            	),

	                            	"MAX_LEVEL" => "2",

	                            	"CHILD_MENU_TYPE" => "left",

                            		"USE_EXT" => "Y",

	                            	"DELAY" => "N",

	                            	"ALLOW_MULTI_SELECT" => "N"

	                            	),

	                            	false

                            	);?>
	</td>
    <td>
    	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"list_clips",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "clips",
		"IBLOCK_ID" => "30",
		"NEWS_COUNT" => "3000",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => "",
		"PROPERTY_CODE" => "",
		"CHECK_DATES" => "Y",
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
		"CACHE_TYPE" => "A",
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
    </td>
</tr>
</tbody>

</table>


<style>
	.map-columns td{
		vertical-align:top;
	}
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>