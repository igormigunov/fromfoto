<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Моё видео");
$APPLICATION->SetPageProperty("description", "Бесплатно создаю клип из фотографий.");
$APPLICATION->SetTitle("Моё видео");
?> 
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/jquery.countdown.css"> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.plugin.js"></script> 
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.countdown.js"></script>

<? global $USER; ?>
<? if(!$USER->IsAuthorized() || !$_REQUEST['check']):?>
<div style="text-align: center;"> 	<b> 		<span class="big_slog"> 			<font size="5"> 
        <br />
       ХОТИТЕ СДЕЛАТЬ СТИЛЬНЫЙ КЛИП ИЗ СВОИХ ФОТО ?</font></span></b></div>
 
<div style="text-align: center;"><span class="big_slog"><font size="4"><b>абсолютно БЕСПЛАТНО и потратив всего 5 минут!</b></font></span></div>
 
<div style="text-align: center;"><b><span class="big_slog"><font size="5"> 
        <br />
       </font></span></b></div>
 
<div> 
  <div> 
    <div class="header_slog"><iframe frameborder="0" src="//www.youtube.com/embed/v7nWwSf2dHg?rel=0&amp;autoplay=1&amp;loop=1&amp;modestbranding=1&amp;showinfo=0&amp;controls=0&amp;playlist=v7nWwSf2dHg" allowfullscreen="" style="width: 500px; height: 275px;"></iframe></div>
   
    <div class="video_part"> 
      <div class="like_box"> 		 
        <div id="vk_like"> 
          <br />
         </div>
       
        <div id="vk_like"><span style="color: rgb(17, 17, 17);"><b>Мы приготовили для Вас слайд-шоу от лучших дизайнеров Европы!</b></span></div>
       
        <div id="vk_like"><b style="color: rgb(17, 17, 17); font-size: small;">(романтические, детские, свадебные, для себя, в подарок и на память)</b></div>
       	 
        <div class="like_box"> 
          <br />
         </div>
       
        <div class="like_box"> 
          <br />
         </div>
       
<script type="text/javascript">
			   //VK.Widgets.Like("vk_like", {type: "mini"});
			</script>
 </div>
     
      <div class="like_box"> 
        <br />
       </div>
     </div>
   
    <div class="btn_blg" style="width: 287px;"> 	<a href="/clips/" class="btn_go" >создать клип бесплатно</a> </div>
   
    <div class="small-text"> 	 
<!--<p>Выберите шаблон на нашем сайте, загрузите свои фото и получите готовый клип!</p>

  <p>Cервис полностью автоматизирован и не требует от пользователя навыков владения специальными программами</p>
 
  <div> 
    <br />
   </div>-->
 
      <br />
     
      <br />
     </div>
   
    <div id="preview_popup_full" class="no_hide_after_order preview_popup_full_s"></div>
   
    <div id="preview_popup" class="no_hide_after_order preview_popup_s"> 	 
      <div id="auth_social" class="preview_popup" style="border: 3px solid rgb(127, 147, 177); border-radius: 5px; min-height: 250px; background: rgb(255, 255, 255);"> 		 
        <div class="text_popup" id="text_popup1" style="padding-top: 70px;"> 			<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"auth_f",
	Array(
		"REGISTER_URL" => "register.php",
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "profile.php",
		"CHEKCODE" => $_REQUEST["chekcode"],
		"SHOW_ERRORS" => "Y"
	)
);?> 		</div>
       	</div>
     </div>
   
<style>
	input.like_vk{
		border: 1px solid #bcc4d2;
    	height: 34px;
   		margin: 4px 0 0 4px;
    	border-radius: 3px;
   		width: 42px;
	}
	#like_vk{
		 border: medium none;
    	cursor: pointer;
    	margin-top: -3px;
		height: 25px;
	}
  .btn_go {
    *width: 100%;
    height: auto;
    font-size: 11px;
    padding: 10px;
    text-transform: uppercase;
  }
  .small-text {
    color: rgb(0, 0, 0);
    font-size: 12px;
    text-align: center;
  }
</style>
 
<script>
	$('.top_menu .menu').prepend('<a id="bxid_642578" class="my_clip_show_auth" href="#" >мой клип</a>');
	$('.hide_popup_S').click(function(){
		$('.preview_popup_full_s, .preview_popup_s').hide();
	});
	$('.my_clip_show_auth').click(function(){
		$('.preview_popup_full_s, .preview_popup_s').show();
	});
</script>
 <? else: ?> <?
	$user_id = intval($USER->GetID());
?> <? $GLOBALS['arrFilter'] = array('PROPERTY_USER' => ($user_id)?$user_id:"-1"); ?> <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"vk_my_clips",
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
);?> <? endif; ?> </div>
 </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>