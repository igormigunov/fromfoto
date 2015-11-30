<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Создайте клип");
?> 
<div align="center"> 
  <br />
 </div>
 
<div align="center"> 	 
  <br />
 	<span style="font-size: 17px; color: rgb(93, 115, 149); text-transform: uppercase;"><font face="Arial">Выберите шаблон для своего клипа</font></span> 
  <br />
 </div>
 
<div align="center"><span style="font-family: tahoma, arial, verdana, sans-serif, 'Lucida Sans'; line-height: 15px; text-align: left; background-color: rgb(255, 255, 255);"><font color="#2f3192">в подарок, на память, детский, романтичный, свадебный и др.:</font></span></div>
 
<div align="center"> 
  <br />
 </div>
 <?
$_REQUEST['section'] = ($_REQUEST['section'])?$_REQUEST['section']:94;
if(isset($_REQUEST['section'])){?> 
<div style="display: none;" class="trigger_selector">a#clip_ch_<?=$_REQUEST['section'];?></div>
 <? }

?> 
<div class="block-content works-wrapper" id="menu-choose"> 
  <div class="works block-padding fullwidth"> <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"clips",
	Array(
		"ROOT_MENU_TYPE" => "clips",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => "",
		"MAX_LEVEL" => "10",
		"CHILD_MENU_TYPE" => "clips",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	)
);?> 							<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"vk_main_clips",
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
		"PROPERTY_CODE" => array("FREE_PERIOD","WE_DO","PREV_VIMEO","INFO_ABOUT","COST","CURRENCY"),
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
<!-- /.works-items -->
 </div>
 
<!-- /.works -->
 </div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>