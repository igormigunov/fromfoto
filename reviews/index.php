<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Клипы из фото бесплатно (отзывы)");
$APPLICATION->SetPageProperty("title", "Клипы из фото бесплатно (отзывы)");
$APPLICATION->SetPageProperty("keywords", "создать видео из фото, слайдшоу, слайд шоу из фотографий, слайд шоу с музыкой онлайн, видео подарки, фромфото, fromfoto, слайд шоу онлайн, видео из фотографий и музыки");
$APPLICATION->SetPageProperty("description", "На нашем сайте вы можете бесплатно создать видео из фотографий  и музыки в виде уникального слайд-шоу. Также в вашем распоряжении большое количество дополнительных шаблонов и...");
?>


<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>

<script type="text/javascript">
  VK.init({apiId: 4552324, onlyWidgets: true});
</script>

<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 20, width: "520", attach: "*", pageUrl: "http://fromfoto.com/reviews/"});
</script>

<style>
	#vk_comments{
		margin: auto;
	}
</style>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>