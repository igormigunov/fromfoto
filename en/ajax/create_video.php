<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Создание видео");?>
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/audiocss/index.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/video_st.css" media="screen, projection">

<!-- Bootstrap styles -->

<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Generic page styles -->

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/style.css">

<!-- blueimp Gallery styles -->

<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/jquery.fileupload.css">

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/jquery.fileupload-ui.css">

<!-- CSS adjustments for browsers with JavaScript disabled -->

<noscript><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/jquery.fileupload-noscript.css"></noscript>

<noscript><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/jquery.fileupload-ui-noscript.css"></noscript>

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/jcrop/jquery.Jcrop.css?321212" type="text/css" />
<div class="create_video" style="padding-top:10px !important;">
<? if($_REQUEST['video_id']): ?>

<? $APPLICATION->IncludeComponent("bitrix:news.detail","video_creation",Array(

	                    	"DISPLAY_DATE" => "Y",

	                    	"DISPLAY_NAME" => "Y",

	                    	"DISPLAY_PICTURE" => "Y",

	                    	"DISPLAY_PREVIEW_TEXT" => "Y",

	                    	"AJAX_MODE" => "N",

	                    	"IBLOCK_TYPE" => "clips",

	                    	"IBLOCK_ID" => "",

	                    	"ELEMENT_ID" => $_REQUEST['video_id'],

	                    	"ELEMENT_CODE" => "",

	                    	"CHECK_DATES" => "Y",

		                    "FIELD_CODE" => array("PREVIEW_PICTURE"),

		                    "PROPERTY_CODE" => array("VIDEO_WEBM","VIDEO_MP4","VIDEO_OGV","COST","CURRENCY","TEXTS","PHOTO","NAME_AE"),

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

	                    	"CACHE_TYPE" => "N",

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

<? endif; ?>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>