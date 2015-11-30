<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!doctype html>



<html>

<head>

	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?$APPLICATION->ShowHead()?>

	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/colorbox.css">
    
    <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/magnific/magnific-popup.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/libraries/font-awesome/css/font-awesome.css" media="screen, projection">

    <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/libraries/rs-plugin/css/settings.css" media="screen, projection">

    <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/bootstrap.min.css" media="screen, projection">

    <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/animation.min.css" media="screen, projection">

	<? if ($APPLICATION->GetCurPage(false) !== '/ajax/create_video.php' && $APPLICATION->GetCurPage(false) !== '/en/ajax/create_video.php'): ?>
    <link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/heaven.css" media="screen, projection">
    <? endif; ?>



    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700' rel='stylesheet' type='text/css'>



    <title><?$APPLICATION->ShowTitle()?></title>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.colorbox.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/magnific/jquery.magnific-popup.js"></script>

<script>

var SITE_DIR='<?=SITE_DIR?>';

</script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/script.js"></script>

<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>

<script type="text/javascript">
  VK.init({apiId: 4526258, onlyWidgets: true});
</script>

</head>

<body class="sticky-header">

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52090351-1', 'fromfoto.com');
  ga('send', 'pageview');
  setTimeout(function(){
	ga('send', 'event', 'New Visitor', location.pathname);
  }, 15000);

</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter25315490 = new Ya.Metrika({id:25315490,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25315490" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->


    <? /*<!-- Start SiteHeart code -->
    <script>
    (function(){
    var widget_id = 723768;
    _shcp =[{widget_id : widget_id}];
    var lang =(navigator.language || navigator.systemLanguage
    || navigator.userLanguage ||"en")
    .substr(0,2).toLowerCase();
    var url ="widget.siteheart.com/widget/sh/"+ widget_id +"/"+ lang +"/widget.js";
    var hcc = document.createElement("script");
    hcc.type ="text/javascript";
    hcc.async =true;
    hcc.src =("https:"== document.location.protocol ?"https":"http")
    +"://"+ url;
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hcc, s.nextSibling);
    })();
    </script>
    <!-- End SiteHeart code -->*/?>


<?$APPLICATION->ShowPanel();?>

	<div class="scroll_top" style="position:fixed;bottom: 10px; cursor: pointer; position: fixed; right: 10px; z-index: 99999; display:none;">
    	<img style="border:none;" src="<?=SITE_TEMPLATE_PATH?>/img/top.png" />
    </div>
    <script>
		$('.scroll_top').click(function(){
			$("html, body").animate({ scrollTop: 0 }, "slow");
  			return false;
		});

		function time_show_scroll() {
     		if($(window).scrollTop()>100){
				$('.scroll_top').show(100);
			}else{
				$('.scroll_top').hide(100);
			}
			
			if($(window).scrollTop()>600){
				<? if ($APPLICATION->GetCurPage(false) == '/' || $APPLICATION->GetCurPage(false) == '/en/'): ?>
				video.pause();
				<? endif; ?>
				state = 1;
			}
		}

		setInterval(time_show_scroll, 100);

	</script>
 <? if ($APPLICATION->GetCurPage(false) !== '/profile/' && $APPLICATION->GetCurPage(false) !== '/create_video/'): ?>   
<? $GLOBALS['filter_ex'] = array('ID' => array("1556","1545")); ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"clips_prev_popup",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "info",
		"IBLOCK_ID" => "17",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "filter_ex",
		"FIELD_CODE" => array("DETAIL_TEXT"),
		"PROPERTY_CODE" => array(0=>"TITLE_WINDOWS"),
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
<? endif; ?> 

<div id="wrapper">

	<? if($_REQUEST['show']): ?>

    <header <? if($APPLICATION->GetCurPage(false) !== '/'): ?>style="background-image: url('<?=SITE_TEMPLATE_PATH?>/img/clouds3_.jpg');"<? endif;?> id="menu-home" class="block-content navbar-wrapper">

        <div class="navbar-outer">

            <div class="navbar-inner">

            	<nav class="navbar" role="navigation">

                    <div class="navbar-decoration">

                        <div class="container">

                            <div class="navbar-header">                            

                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6">

                                    <span class="sr-only">Toggle navigation</span>

                                    <span class="icon-bar"></span>

                                    <span class="icon-bar"></span>

                                    <span class="icon-bar"></span>

                                </button>

                                <?

                                	$url = (SITE_ID == 'en')?'/en/':'/';

								?>

                                <a class="navbar-brand" href="<?=$url; ?>">

                                    <img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="Home">

                                </a>

                            </div><!-- /.navbar-header -->



                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">

                            	<?$APPLICATION->IncludeComponent("bitrix:menu", "video_gallery_top", array(

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

                                <!-- /.nav-->

                            </div><!-- /.navbar-collapse -->

                        </div><!-- /.container -->

                    </div><!-- /.navbar-decoration -->

                </nav><!-- /.navbar -->

				

                <? if ($APPLICATION->GetCurPage(false) === '/' || $APPLICATION->GetCurPage(false) === '/en/'): ?> 

                

                <?

					$iblock_id = (SITE_ID == 'en')?'24':'21';

				?>
                
                
         
                <?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"header_prev",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "info",
		"IBLOCK_ID" => "",
		"ELEMENT_ID" => "1425",
		"ELEMENT_CODE" => "",
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array("PREVIEW_PICTURE"),
		"PROPERTY_CODE" => array("VIDEO_MP4","VIDEO_OGV","VIDEO_WEBM"),
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
               
                <div class="container"> 
                
                
                
                	<? /*$APPLICATION->IncludeComponent("bitrix:news.list", "main_slider", Array(

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


                <div class="head_stick" style="<? if(!$_REQUEST['show']):?>height:410px !important;<? else: ?>height:640px;<? endif; ?>"> 
                  	<a class="show_steps menu_hh" style="display: block; height: 137px; position: absolute; width: 273px; top: 300px; left: 524px;" href="#menu-choose" ></a>
                   <? /*if($_REQUEST['show']):?>
                    <style>
						.menu_hh{
								left: 50%;
  							 	top: 298px !important;
    							width: 270px !important;
								position:relative !important;
    							margin-left: -103px;
    							height: 70px !important;
								background:url('<?=SITE_TEMPLATE_PATH?>/img/btn_try_hover.png') no-repeat;
							}
							.menu_hh:hover{
								background:url('<?=SITE_TEMPLATE_PATH?>/img/btn_try.png') no-repeat;
							}
					</style>
                     <? endif;*/?>
 
                    
                <div class="vimeo_rott">
					<? if($_REQUEST['show']):?>
                    	<img src="<?=SITE_TEMPLATE_PATH?>/img/gradient2.png" class="gradient_on_video" />
                    <? else: ?>
                    	<img src="<?=SITE_TEMPLATE_PATH?>/img/gr_gr.png" class="gradient_on_video" />
                    <? endif; ?>

                <iframe  src="//player.vimeo.com/video/102526128?title=0&byline=0&portrait=0&autoplay=1&loop=1" width="407" height="236" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
               
                 </div>

         

 </div><!-- /.container --> 

                <? else: ?>

                <div class="container">

                    <div class="row">

                        <div class="navbar-title-wrapper col-xs-12">

                            <div class="navbar-title">

                                <h1><?=$APPLICATION->ShowTitle();?></h1>

                            </div>

                        </div><!-- /.navbar-title-wrapper -->

                    </div><!-- /.row -->

                </div>

                <? endif; ?>      

            </div><!-- /.navbar-inner -->

        </div><!-- /.navbar-outer -->

    </header><!-- /.navbar-wrapper -->
    
    <? else: ?>
    <div class="top_menu container" style = "display: block;">
    	
    <div class="logo">
    	<a href="/"><img src="/images/from_logo.png" style="padding: 3px; width: 28px;" />FromFoto.com</a>
    </div>

    <div class="menu">
    <?$APPLICATION->IncludeComponent("bitrix:menu", "simple_video_gallery_top", array(

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
       </div>
    </div>
    <!--<script>
		$('.top_menu.container').width($('.top_menu.container').width()+112);
	</script>-->
    <style>
    .bottom_text {
    	text-align: center;
		font-weight: bold;
		line-height: 1;
		padding: 20px 0px;
		border: 1px solid #5d7395;
		font-size: 20px;
		color: #5d7395;
		line-height: 25px;
    }
    div input.vk_input {
    	height: 41px;
    	background: #fff !important;
		border: 3px solid #e9ecf0 !important;
		text-transform: none !important;
		box-shadow: none !important;
		width: 313px;
		padding: 4px;
		border-radius: 0px !important;
    }
    .blue {
    	font-size: 20px;
    	text-transform: uppercase;
    }
    .header_bold {
    	color: #5d7395;
		font-size: 14px;
		font-family: "Days","HeliosThin","Arial",sans-serif;
		text-transform: uppercase;
		padding-top: 35px;
    }
    .add_changes {
    	color: #5d7395;
		font-size: 8px;
		background: #e9ecf0;
		padding: 4px 13px;
		border-radius: 3px;
    }
    .date_video {
    	color: #000;
		font-size: 13px;
		padding-right: 66px;
		padding-top: 0;
		text-align: right;
		position: relative;
		margin-top: -14px;
    }
    .first_td {
    	height: 200px;
    }
    .my_video {
    	margin: 40px auto;
    	width: 700px;
    	overflow: hidden;
    }
    .create_new.btn_go {
    	font-size: 12px;
		height: 40px;
		padding-top: 12px;
		text-transform: uppercase;
		border-radius: 4px;
    }
    .chel_login {
    	height: 45px;
    }
    .simple_table, .simple_table tbody, .simple_table tr {
    	display: block;
    }
    .first_td img {
    	width: 180px;
    	float: right;
    }
    .first_coll {
    	width: 700px;
    	margin: auto;
    }
    .simple_table th {
    	font-size: 18px;
		padding: 18px 46px;
    }
    .chel_login div, .chel_login div.rg {
    	font-size: 14px;
    }
    .chel_login div span {
    	font-size: 9px;
    }
    .fr_mail {
    	font-size: 14px;
	text-align: center;
    }
    .fr_mail p {
    	margin-top: 2px;
    }
    .list_third {
    	margin: 10px auto;
    	font-size: 11px;
    	text-transform: uppercase;
    	letter-spacing: 1px;
    	width: 400px;
		padding: 0 64px;
    	font-weight: bold;
    }
    .list_third li {
    	margin: 6px 0;
    }
    .centr_head p {
    	text-align: center;
    	color: #517498;
		font-size: 15px;
		text-transform: uppercase;
		letter-spacing: 1px;
    }
    .centr_head {
    	clear: both;
    }
		.top_menu{
			padding: 0px 56px !important;
			background:#517498;
			border-bottom-left-radius:15px;
			border-bottom-right-radius:15px;
			font-family:'Days', 'HeliosThin', 'Arial', sans-serif;
			overflow: hidden;
		}
		.top_menu .logo a:hover{
			background:none;
		}
		.top_menu .logo a {
  			/*display: table-cell;
			font-size: 30px;
			font-weight: normal;
			height: 65px;
			text-decoration: none;
			vertical-align: middle;*/
			display: inline-block;
			 font-size: 14px;
			 padding-top: 9px;
			 text-transform: uppercase;
		}
		
		.top_menu .logo{
			float:left;
		}
		
		.top_menu .menu{
			float:right;
		}
		.header_slog {
			color: #517498;
			margin: 15px;
		}
		
		.top_menu .menu a{
			/*display: table-cell;
			float: left;
			font-size: 22px;
			height: 65px;
			padding: 10px;
			vertical-align: middle;*/
			font-size: 12px;
			display: block;
			float: left;
			padding: 15px 8px;
		}
		
		.top_menu a{
			color:#fff;
			font-weight:normal;
			text-decoration:none !important;
		}
		
		.top_menu a:hover, .top_menu a.active{
			color: #fff !important;
			text-decoration:none !important;
			background:#4e6986;
		}
		
		.footer-wrapper{
			background-image:none !important;
			background-color:#fff !important;
		}
		
		.footer-copyright{
			box-shadow: none !important;
		}
		.work-target img {
			display: block;
			height: 127px;
			max-width: 100%;
			width: 232px;
		}
		.middle-block {
		    width: 794px !important;
		    padding: 0;
		  }
	</style>
    <? endif; ?>

	<div class="main" style = "display: block;width:100%;">

		<div class="container middle-block" style="display: block;width:90%;">

			<div class="row" style="display: block;width:100%;">
