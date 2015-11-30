<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?> 

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.viewport.min.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/libraries/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/libraries/isotope/jquery.isotope.min.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/libraries/jquery-smooth-scroll/src/jquery.smooth-scroll.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/libraries/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/libraries/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/heaven.js"></script>

<? if ($APPLICATION->GetCurPage(false) !== '/' && $APPLICATION->GetCurPage(false) !== '/en/'): ?>

<script>

	$('a.navbar-item-target').click(function(){

		//window.location = $(this).attr("href");

	});

</script>

<? endif; ?>

</body>

</html>