<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?>

<!-- FEEDBACK -->
 
  <div id="menu-feedback" class="block-content block-padding fullwidth"> 
    <h2 class="block-title center">Напишите нам</h2>
   
    <p class="center slogan mb50"> 	<? $APPLICATION->IncludeFile(

									$APPLICATION->GetTemplatePath("include_areas/feedback_text.php"),

									Array(),

									Array("MODE"=>"html")

								);?> </p>
   
    <div id="answer"></div>
   <form action="#" id="send_feedback" method="post"> 
      <div class="row"> 
        <div class="form-group col-sm-6"> <input type="text" placeholder="Введите имя" class="form-control" id="name_feed" /> </div>
       
<!-- /.form-group -->
 
        <div class="form-group col-sm-6"> <input type="email" placeholder="Введите email" class="form-control" id="email_feed" /> </div>
       
<!-- /.form-group -->
 </div>
     
      <div class="form-group"> 
        <div class="row"> 
          <div class="col-sm-12"> <textarea rows="6" placeholder="Введите сообщение" class="form-control" id="text_feed"></textarea> </div>
         </div>
       
<!-- /.row -->
 </div>
     
<!-- /.form-group -->
 <input type="submit" class="btn btn-primary" id="feed_btn" onclick="yaCounter25315490.reachGoal('send-form'); return true;" value="Отправить" /> </form> </div>
<!-- CONTACT INFO-->
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"contact",
	Array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "contacts",
		"IBLOCK_ID" => "",
		"ELEMENT_ID" => "330",
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => "",
		"PROPERTY_CODE" => Array("ADDRESS","PHONE","EMAIL","MAP_DESCR","MAP","BALOON_DESCR"),
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

 
 <div class="vk_group" style="padding-top:20px; padding-bottom:20px;"><? $APPLICATION->IncludeFile(

											$APPLICATION->GetTemplatePath("include_areas/".$lang."footer_info.php"),

											Array(),

											Array("MODE"=>"html")

										);?></div>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>