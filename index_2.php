<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords", "создать видео из фото, слайдшоу, слайд шоу из фотографий, слайд шоу с музыкой онлайн, видео подарки, фромфото, fromfoto, слайд шоу онлайн, видео из фотографий и музыки");
$APPLICATION->SetPageProperty("description", "На нашем сайте вы можете бесплатно создать видео из фотографий  и музыки в виде уникального слайд-шоу. Также в вашем распоряжении большое количество дополнительных шаблонов и...");

$APPLICATION->SetPageProperty("title", "Создавай свое видео из фото на Fromfoto.com");

$APPLICATION->SetTitle("Создавай своё видео");

if($_SESSION['sess_vk'] && $USER->IsAuthorized()){
	unset($_SESSION['sess_vk']);
	LocalRedirect('/fljvrFG/');
}

?> <? if(!$USER->IsAuthorized() || (!$_SESSION['sess_vk'] && !$_REQUEST['check'])):?> 	 
<div id="main_background"> 	 		 
  <div id="main_h"> 			 
    <h1 id="main_h_big" class="big_slog"><font size="5">подари радость себе и любимым</font></h1>
   			 
    <p><font size="2">создавай стильные клипы и слайд-шоу бесплатно</font></p>
   			 
    <div id="button_resp"> 				<a href="/clips/" class="button-slide" >создать клип бесплатно</a> 			</div>
   		</div>
 		 		 
  <div class="main_wrapper" style="width: 100%;"> 			<img src="/images/index2.png" alt="Выбери дизайн, загрузи фото, получи клип!"  /> 		</div>
 		 		 
 		 	</div>
 		 	 	 
<div id="main_button_wrapper"> 		 
  <div id="button_norm"> 			<a href="/clips/" class="button-slide" >создать клип бесплатно</a> 		</div>
 	</div>
 	<? /*
  <iframe frameborder="0" src="//www.youtube.com/embed/jYhJdrPILng?rel=0&amp;autoplay=0&amp;fs=1&amp;loop=0&amp;modestbranding=1&amp;showinfo=0&amp;loop=1&amp;hd=1&amp;controls=1&amp;" allowfullscreen="" style="width: 77%; height: 100%;"></iframe>
  */?> 

 </div>
 
 <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"vk_mobile_fromfoto_no_email",
	Array(
		"REGISTER_URL" => "register.php",
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "profile.php",
		"CHEKCODE" => $_REQUEST["chekcode"],
		"SHOW_ERRORS" => "Y"
	)
);?> 	<? else: ?> <? 
$user_id = intval($USER->GetID());
$GLOBALS['arrFilter'] = array('PROPERTY_USER' => ($user_id)?$user_id:"-1"); 
?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"vk_mobile_my_clips_no_email",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => "33",
		"NEWS_COUNT" => "15",
		"SORT_BY1" => "timestamp_x",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arrFilter",
		"FIELD_CODE" => array("DATE_CREATE"),
		"PROPERTY_CODE" => array("USER_NAME","USER_EMAIL","VIDEO","PAID","TYPE_CLIP","FILE_LINK","NO_LOGO","VIDEO_COUNT","TELL_FRIENDS"),
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
);?> <? endif; ?> <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>