<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Создание видео");?>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
    
<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/audiocss/index.css" media="screen">

<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/css/video_st.css" media="screen, projection">

<!-- Bootstrap styles -->

<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Generic page styles -->

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/style.css">

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/jquery-cropbox-master/jquery.cropbox.css">

<!-- blueimp Gallery styles -->

<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/jquery.fileupload.css">

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/jquery.fileupload-ui.css">

<!-- CSS adjustments for browsers with JavaScript disabled -->

<noscript><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/jquery.fileupload-noscript.css"></noscript>

<noscript><link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/file_upload/jquery.fileupload-ui-noscript.css"></noscript>

<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/jcrop/jquery.Jcrop.css?321212" type="text/css" />

<style>
body {
	background-color: #E2E2E2;
	background-image:url(../bitrix/templates/video_gallery/img/main_bckgr.png);
	background-position: center 0;
    background-repeat: no-repeat;
}

.navbar-wrapper{
	background:none;
}

.navbar-inner{
	background-image: none;
}

.footer-wrapper{
	background-image:url(../bitrix/templates/video_gallery/img/footer_bckgr.png);
	background-color:inherit;
}

textarea.form-control, input[type="text"], input[type="email"], input[type="password"]{background-color:#d6d8db;border:1px solid #c4c9d1;-webkit-border-radius:8px;-moz-border-radius:8px;-ms-border-radius:8px;-o-border-radius:8px;border-radius:8px;-webkit-box-shadow:inset 0px -4px 0px #c4c9d1;-moz-box-shadow:inset 0px -4px 0px #c4c9d1;box-shadow:inset 0px -4px 0px #c4c9d1 !important;color:#3E3E3E;font-size:18px;text-transform:uppercase}

#name_feed, #email_feed{
	text-transform:none !important;
}

@media (min-width: 1200px){
	.container {
  		width: 1180px;
	}
}
</style>

<div class="create_video" style="padding-top:50px !important;">
<? if($_REQUEST['video_id']): ?>

<? $APPLICATION->IncludeComponent("bitrix:news.detail", "video_creation", Array(
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить детальное изображение
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"IBLOCK_TYPE" => "clips",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "",	// Код информационного блока
	"ELEMENT_ID" => $_REQUEST["video_id"],	// ID новости
	"ELEMENT_CODE" => "",	// Код новости
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"FIELD_CODE" => array(	// Поля
		0 => "PREVIEW_PICTURE",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "VIDEO_WEBM",
		1 => "VIDEO_MP4",
		2 => "VIDEO_OGV",
		3 => "COST",
		4 => "CURRENCY",
		5 => "TEXTS",
		6 => "PHOTO",
		7 => "NAME_AE",
		8 => "AUDIO_MP3"
	),
	"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",	// URL страницы просмотра списка элементов (по умолчанию - из настроек инфоблока)
	"META_KEYWORDS" => "KEYWORDS",	// Установить ключевые слова страницы из свойства
	"META_DESCRIPTION" => "DESCRIPTION",	// Установить описание страницы из свойства
	"BROWSER_TITLE" => "BROWSER_TITLE",	// Установить заголовок окна браузера из свойства
	"DISPLAY_PANEL" => "N",
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"USE_PERMISSIONS" => "N",	// Использовать дополнительное ограничение доступа
	"GROUP_PERMISSIONS" => array(
		0 => "1",
	),
	"CACHE_TYPE" => "N",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"DISPLAY_TOP_PAGER" => "Y",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
	"PAGER_TITLE" => "Страница",	// Название категорий
	"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
	"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	),
	false
);?>

<? endif; ?>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>