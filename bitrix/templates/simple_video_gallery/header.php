<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<!doctype html>



<html>

<head>

	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?$APPLICATION->ShowHead()?>

	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/colorbox.css">

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

<script>

var SITE_DIR='<?=SITE_DIR?>';

</script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/script.js"></script>

</head>

<body>

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