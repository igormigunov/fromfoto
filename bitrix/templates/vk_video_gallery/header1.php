<?$APPLICATION->ShowPanel();?> 
<div id="wrapper"> <header id="menu-home" class="block-content navbar-wrapper"> 
    <div class="navbar-outer"> 
      <div class="navbar-inner"> 	<nav class="navbar" role="navigation"> 
          <div class="navbar-decoration"> 
            <div class="container"> 
              <div class="navbar-header"> <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <?

                                	$url = (SITE_ID == 'en')?'/en/':'/';

								?> <a class="navbar-brand" href="<?=$url; ?>" > <img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="Home"  /> </a> </div>
             
<!-- /.navbar-header -->
 
              <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6"> 	<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"video_gallery_top",
	Array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	)
);?> 
<!-- /.nav-->
 </div>
             
<!-- /.navbar-collapse -->
 </div>
           
<!-- /.container -->
 </div>
         
<!-- /.navbar-decoration -->
 </nav> 
<!-- /.navbar -->
 				 <? if ($APPLICATION->GetCurPage(false) === '/' || $APPLICATION->GetCurPage(false) === '/en/'): ?> <?

					$iblock_id = (SITE_ID == 'en')?'24':'21';

				?> 
        <div class="container"> 	<? /*$APPLICATION->IncludeComponent("bitrix:news.list", "main_slider", Array(

                		"DISPLAY_DATE" => "Y",	// Выводить дату элемента

	                	"DISPLAY_NAME" => "Y",	// Выводить название элемента

	                	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса

	                	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса

	                	"AJAX_MODE" => "Y",	// Включить режим AJAX

	                	"IBLOCK_TYPE" => "slider",	// Тип информационного блока (используется только для проверки)

	                	"IBLOCK_ID" => $iblock_id,	// Код информационного блока

	                	"NEWS_COUNT" => "3000",	// Количество новостей на странице

	                	"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей

	                	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей

	                	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей

	                	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей

	                	"FILTER_NAME" => "",	// Фильтр

	                	"FIELD_CODE" => "",

	                	"PROPERTY_CODE" => array("LINK","VIDEO"),

                		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы

                		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)

                		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)

	                	"ACTIVE_DATE_FORMAT" => "d-m-Y",	// Формат показа даты

                		"SET_TITLE" => "N",	// Устанавливать заголовок страницы

                		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел

	                	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации

	                	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации

	                	"HIDE_LINK_WHEN_NO_DETAIL" => "Y",	// Скрывать ссылку, если нет детального описания

	                	"PARENT_SECTION" => "",	// ID раздела

	                	"PARENT_SECTION_CODE" => "",	// Код раздела

	                	"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела

	                	"CACHE_TYPE" => "A",	// Тип кеширования

	                	"CACHE_TIME" => "3600",	// Время кеширования (сек.)

	                	"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре

	                	"CACHE_GROUPS" => "Y",	// Учитывать права доступа

	                	"DISPLAY_TOP_PAGER" => "Y",	// Выводить над списком

	                	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком

	                	"PAGER_TITLE" => "Новости",	// Название категорий

	                	"PAGER_SHOW_ALWAYS" => "Y",	// Выводить всегда

	                	"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации

	                	"PAGER_DESC_NUMBERING" => "Y",	// Использовать обратную навигацию

	                	"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",	// Время кеширования страниц для обратной навигации

	                	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"

	                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента

	                	"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей

	                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера

	                	"AJAX_OPTION_ADDITIONAL" => "N",	// Дополнительный идентификатор

	                	),

	                	false

                	); */?> 
          <div class="row"> 
            <div class="navbar-title-wrapper col-xs-12"> 
              <div class="tp-banner-container"> 
                <div class="tp-banner rs-banner"> 
                  <ul class="unstyled" style="position: relative;"> 
<!-- CHART -->
 
                    <li data-transition="fade" data-masterspeed="0" data-slotamount="6"> <img src="<?=SITE_TEMPLATE_PATH?>/img/transparent.png"  /> 
<!-- CHART -->
 
                      <div class="tp-caption sfb" data-x="0" data-y="150" data-speed="900" data-width="887" data-height="419"> <img src="<?=SITE_TEMPLATE_PATH?>/images/chart.png"  /> </div>
                     
<!-- TITLE -->
 
                      <div class="tp-caption sft" data-start="1500" data-x="0" data-y="20" data-speed="900" data-width="493" data-height="209"> 
                        <div class="rs-title center"> 
                          <div style="float: left; padding-right: 10px;"><img src="<?=SITE_TEMPLATE_PATH?>/img/heder/create_video.png"  /></div>
                         <a id="go_clip" href="#menu-choose" ></a> </div>
                       
<!-- /.rs-title -->
 </div>
                     
<!-- CHART ORANGE -->
 
                      <div class="tp-caption sfl" data-start="1500" data-x="280" data-y="120" data-speed="900" data-width="290" data-height="206"> <img src="<?=SITE_TEMPLATE_PATH?>/img/heder/s1.png"  /> </div>
                     
<!-- CHART RED -->
 
                      <div class="tp-caption sft" data-start="1700" data-x="580" data-y="70" data-speed="900" data-width="379" data-height="248"> <img src="<?=SITE_TEMPLATE_PATH?>/img/heder/s2.png"  /> </div>
                     
<!-- CHART GREEN -->
 
                      <div class="tp-caption sft" data-start="1900" data-x="720" data-y="170" data-speed="900" data-width="405" data-height="107"> <img src="<?=SITE_TEMPLATE_PATH?>/img/heder/s3.png"  /> </div>
                     
<!-- CHART BLUE -->
 
                      <div class="tp-caption sfr" data-start="2100" data-x="740" data-y="290" data-speed="900" data-width="404" data-height="117"> <img src="<?=SITE_TEMPLATE_PATH?>/img/heder/s4.png"  /> </div>
                     
                      <div class="tp-caption sfr" data-start="2300" data-x="570" data-y="430" data-speed="900" data-width="460" data-height="119"> <img src="<?=SITE_TEMPLATE_PATH?>/img/heder/s5.png"  /> </div>
                     
                      <div class="tp-bannertimer tp-bottom"></div>
                     </li>
                   </ul>
                 </div>
               
<!-- /.tp-banner -->
 </div>
             
<!-- /.tp-banner-container -->
 </div>
           
<!-- /.navbar-title-wrapper -->
 </div>
         
<!-- /.row -->
 </div>
       
<!-- /.container -->
 <? else: ?> 
        <div class="container"> 
          <div class="row"> 
            <div class="navbar-title-wrapper col-xs-12"> 
              <div class="navbar-title"> 
                <h1><?=$APPLICATION->ShowTitle();?></h1>
               </div>
             </div>
           
<!-- /.navbar-title-wrapper -->
 </div>
         
<!-- /.row -->
 </div>
       <? endif; ?> </div>
     
<!-- /.navbar-inner -->
 </div>
   
<!-- /.navbar-outer -->
 
<!-- /.navbar-wrapper -->
 	 
    <div class="main"> 		 
      <div class="container"> 			 
        <div class="row"></div>
       </div>
     </div>
   </header></div>
