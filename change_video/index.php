<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

	

$APPLICATION->SetTitle("Создание видео");?>
<? if($_REQUEST['auth_service_id'] && $_REQUEST['auth_service_id'] == 'VKontakte' && !$_REQUEST['video_id']):?>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","fromfoto",Array(
     "REGISTER_URL" => "register.php",
     "FORGOT_PASSWORD_URL" => "",
     "PROFILE_URL" => "profile.php",
     "SHOW_ERRORS" => "Y" 
     )
);?>
<? endif;?>

<style>
#return_mp3 {
	display: block;
	width: 212px;
	margin: 0;
	margin-top: 14px;
}
.navbar-title{
		display:none;
	}
.navbar{
	margin-bottom:0px !important;
}

.popup_video_work_station .btns .btn_go {
	padding: 11px;
	height: 42px;
	margin: 20px;
	width: 250px;
	font-size: 14px;
}
.popup_video_work_station .text_preview {
	font-size: 16px;
}
.create_video #mp3_viz {
	text-align: right;
	padding-top: 19px;
}
#vim iframe {
	width: 305px;
	height: 171px;
}
.create_video .container_h3 {
	font-size: 15px;
	margin: 30px 0;
}
.create_video .container {
	width: 794px !important;
}
.button-create i {
	color: #5d7395;
	padding-right: 10px;
}
.popup_video_work_station .btns .btn_go {
	display: inline;
	padding: 10px;
	font-size: 14px;
	border-radius: 2px;
}
.text-music {
	font-size: small;
	text-align: center;
}
</style>

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
	background-color: #E2E2E2 !important;
	color:#000 !important;
	background-color:inherit;
}

.footer-copyright{
	color:#000 !important;
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

<div class="create_video">
<? if($_REQUEST['video_id']): ?>

<? $APPLICATION->IncludeComponent("bitrix:news.detail", "vk_redactor_video_change_09092015", Array(
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
		8 => "AUDIO_MP3",
		9 => "FREE_PERIOD",
		10 => "VIDEO_COST",
		11 => "LOGO_SIZE",
		12 => "WITH_LOGO",
		13 => "PREV_VIMEO",
		14 => "FREE_PRICE",
		15 => "PREV_VIMEO2",
		16 => "PREVIEW_VIDEO",
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