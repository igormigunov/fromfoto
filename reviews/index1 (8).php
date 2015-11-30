<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Ваши отзывы");
?>


<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>

<script type="text/javascript">
  VK.init({apiId: 4552324, onlyWidgets: true});
</script>

<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 20, width: "520", attach: "*"});
</script>

<style>
	#vk_comments{
		margin: auto;
	}
</style>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>