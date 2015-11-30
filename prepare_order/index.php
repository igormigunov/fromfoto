<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");


$APPLICATION->SetTitle("Создание видео");?>
<? $APPLICATION->IncludeComponent("bitrix:news.detail", "creation_video_step_2", Array(
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить детальное изображение
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"IBLOCK_TYPE" => "clips",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "",	// Код информационного блока
	"ELEMENT_ID" => $_REQUEST["PRODUCT_ID"],	// ID новости
	"ELEMENT_CODE" => "",	// Код новости
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"FIELD_CODE" => array(),
	"PROPERTY_CODE" => array(),
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

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>