<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?$APPLICATION->ShowHead()?>
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/stylesheets/style.css">
<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/stylesheets/jquery.Jcrop.min.css">
<link href='http://fonts.googleapis.com/css?family=Days+One' rel='stylesheet' type='text/css'>
<link href='<?=SITE_TEMPLATE_PATH?>/stylesheets/media.css' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.Jcrop.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.countdown.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/autoresize.jquery.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>
<!--[if lt IE 9]> 
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
  <![endif]-->
<title><?$APPLICATION->ShowTitle()?></title>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>

<script type="text/javascript">
  VK.init({apiId: 4526258, onlyWidgets: true});
</script>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
</head>
<body>

<?$APPLICATION->ShowPanel();?>
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
<header>
  <div class="logo"> <a <? if ($APPLICATION->GetCurPage(false) != '/'): ?>href="/" <? endif; ?>><img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" alt=""></a> </div>
  <? $APPLICATION->IncludeComponent("bitrix:menu", "top_menu", array(
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
</header>
<div class="content <?$APPLICATION->ShowViewContent('add_content_class');?>">
<?$APPLICATION->ShowViewContent('online_state');?>
<div class="content-container<?$APPLICATION->ShowViewContent('add_class');?>">