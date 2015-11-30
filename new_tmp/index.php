<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("keywords", "создать видео из фото, слайдшоу, слайд шоу из фотографий, слайд шоу с музыкой онлайн, видео подарки, фромфото, fromfoto, слайд шоу онлайн, видео из фотографий и музыки");
$APPLICATION->SetPageProperty("description", "На нашем сайте вы можете бесплатно создать видео из фотографий  и музыки в виде уникального слайд-шоу. Также в вашем распоряжении большое количество дополнительных шаблонов и...");

$APPLICATION->SetPageProperty("title", "Создавай свое видео из фото на Fromfoto.com");

$APPLICATION->SetTitle("Создавай своё видео");
?>


	
    	<? $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"new_video_index",
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
		"PROPERTY_CODE" => array("VIDEO_MP4","VIDEO_OGV","VIDEO_WEBM","BGR","TEXTS"),
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
	

<script>
	var video = document.getElementById("new_header_stick_video");
	$('.value_on').click(function(e){
		e.preventDefault();
		$('.value_on').hide();
		$('.value_off').show();
		video.volume = 0;
	});
	$('.value_off').click(function(e){
		e.preventDefault();
		$('.value_off').hide();
		$('.value_on').show();
		video.volume = 1;
	});
	count = 2
	num = 1;
	//show_hide_text_timer = setTimeout(show_hide_text, 3000);
	function show_hide_text(){
		num++;
		$('.change_text').hide();
		$('.ch_t_'+num).show();
		if(num == count){
			num = 0;
		}
		show_hide_text_timer = setTimeout(show_hide_text, 3000);
	}
	$('.change_text_all, .change_text_all div').not('.change_text').innerFade({speed:'normal',timeout:4000, children:'.change_text',animationType:'slideOver'});
</script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>