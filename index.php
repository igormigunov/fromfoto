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
   			 
    <p><font size="2" color="#111111">создавай самые стильные клипы и слайд-шоу за 5 минут!</font></p>
   			 
    <div id="button_resp"> 				<a href="/clips/" class="button-slide" >создать клип бесплатно</a> 			</div>
   		</div>
 		 		 
  <div class="main_wrapper"> 			<img src="/images/Infograf PNG2.png" alt="Выбери дизайн, загрузи фото, получи клип!"  /> 		</div>
 		 		 
  <div class="main_wrapper"> 			<iframe src="//www.youtube.com/embed/beTu5telWXk?rel=0&amp;autoplay=1&amp;fs=1&amp;loop=0&amp;modestbranding=1&amp;showinfo=0&amp;loop=1&amp;hd=1&amp;controls=0&amp;"></iframe> 		</div>
 		 	</div>
 		 	 	 
<div id="main_button_wrapper"> 		 
  <div id="button_norm"> 			<a href="/clips/" class="button-slide" >создать клип бесплатно</a> 		</div>
 	</div>
 	<? /*
  <iframe frameborder="0" src="//www.youtube.com/embed/jYhJdrPILng?rel=0&amp;autoplay=0&amp;fs=1&amp;loop=0&amp;modestbranding=1&amp;showinfo=0&amp;loop=1&amp;hd=1&amp;controls=1&amp;" allowfullscreen="" style="width: 77%; height: 100%;"></iframe>
  */?> 
<div id="vk_like"><font face="Arial" size="1.5" color="#555555"><b>КЛИПЫ НАШИХ ПОЛЬЗОВАТЕЛЕЙ:</b></font> 
  <p> </p>
 </div>
 
<div id="videoslider"> 		 
  <div id="vs_moveleft" class="vs_button"> 
    <div class="vs_button_image"></div>
   </div>
 		 
  <div id="vs_moveright" class="vs_button"> 
    <div class="vs_button_image"></div>
   </div>
 		 		 
  <div id="vs_wrapper"> 			 			 
    <div id="vs_panel"> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/1.jpg" alt="video1" class="vs_thumbimage" video="https://www.youtube.com/embed/xunY1NuIYTg?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/2.jpg" alt="video2" class="vs_thumbimage" video="https://www.youtube.com/embed/jIZUJCLpstA?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/3.jpg" alt="video3" class="vs_thumbimage" video="https://www.youtube.com/embed/wGR3Bz0zqK8?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/4.jpg" alt="video4" class="vs_thumbimage" video="https://www.youtube.com/embed/30PYraDc-Ls?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/5.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/8Ppf28SG34Y?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/6.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/dGPCmv9iv54?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/7.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/JwZUrwOVF24?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/8.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/ZRxDrV_15F4?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/9.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/wGR3Bz0zqK8?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/10.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/if2WQAktogE?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/11.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/a7lpWo4s3W8?autoplay=1"  /> 				<img src="/bitrix/templates/vk_video_gallery_new_with_mobile/images/videoslideshow/12.jpg" alt="video5" class="vs_thumbimage" video="https://www.youtube.com/embed/Q-i6Ldocyzw?autoplay=1"  /> 			</div>
   		</div>
 	</div>
 	 
<div id="vs_videoback"> 		 		 
  <div id="vs_videowrapper"> 			<iframe width="500" height="250" src="" frameborder="0" allowfullscreen=""></iframe> 		 			 
    <div id="vs_close_btn"></div>
   		</div>
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