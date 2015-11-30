<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords", "создать видео из фото, слайдшоу, слайд шоу из фотографий, слайд шоу с музыкой онлайн, видео подарки, фромфото, fromfoto, слайд шоу онлайн, видео из фотографий и музыки");
$APPLICATION->SetPageProperty("description", "На нашем сайте вы можете бесплатно создать видео из фотографий  и музыки в виде уникального слайд-шоу. Также в вашем распоряжении большое количество дополнительных шаблонов и...");

$APPLICATION->SetPageProperty("title", "Создавай свое видео из фото на Fromfoto.com");

$APPLICATION->SetTitle("Создавай своё видео");

?>
<? if(!$USER->IsAuthorized() || !$_REQUEST['check']):?>
<div class="content-title bold-title"><b><span class="big_slog" style="box-sizing: border-box; font-size: 24px;">ХОТИТЕ СДЕЛАТЬ СТИЛЬНЫЙ КЛИП ИЗ СВОИХ ФОТО ?</span></b> 
  <br />
 
  <p><span>абсолютно БЕСПЛАТНО и потратив всего 5 минут!</span></p>
 </div>
 
<div class="video main">
	<img src="<?php echo SITE_TEMPLATE_PATH; ?>/images/imgo.jpg" class="img-for-mobile" style="display: none;" alt="">
	<iframe frameborder="0" src="//www.youtube.com/embed/v7nWwSf2dHg?rel=0&amp;autoplay=1&amp;loop=1&amp;modestbranding=1&amp;showinfo=0&amp;controls=0&amp;playlist=v7nWwSf2dHg" allowfullscreen="" style="width: 100%;"></iframe> 
 </div>
 
<div class="content-info"> 
  <div id="vk_like"><span style="color: rgb(17, 17, 17);"><b>Мы приготовили для Вас слайд-шоу от лучших дизайнеров Европы!</b></span></div>
       
        <div id="vk_like"><b style="color: rgb(17, 17, 17); font-size: small;">(романтические, детские, свадебные, для себя, в подарок и на память)</b></div>
 </div>
 <a href="/clips/" class="button-slide" >создать клип бесплатно</a> 
<div class="small-text"><font face="Arial" size="1"> СЕРВИС НЕ ТРЕБУЕТ ОТ ПОЛЬЗОВАТЕЛЯ НАВЫКОВ ВЛАДЕНИЯНИЯ СПЕЦИАЛЬНИМИ ПРОГРАММАМИ</font></div>



   	 
      <? $APPLICATION->IncludeComponent("bitrix:system.auth.form","vk_mobile_fromfoto",Array(
	"REGISTER_URL" => "register.php",
	"FORGOT_PASSWORD_URL" => "",
	"PROFILE_URL" => "profile.php",
	"CHEKCODE" => $_REQUEST["chekcode"],
	"SHOW_ERRORS" => "Y" 
	)
);?>


<? else: ?>
<? 
$user_id = intval($USER->GetID());
$GLOBALS['arrFilter'] = array('PROPERTY_USER' => ($user_id)?$user_id:"-1"); 
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"vk_mobile_my_clips",
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
		"PROPERTY_CODE" => array("USER_NAME","USER_EMAIL","VIDEO","PAID","TYPE_CLIP", "FILE_LINK", "NO_LOGO", "VIDEO_COUNT", "TELL_FRIENDS"),
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
);?>
<? endif; ?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>