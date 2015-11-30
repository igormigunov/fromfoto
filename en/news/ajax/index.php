<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?$APPLICATION->IncludeComponent("bitrix:news.list", "main_news", Array(

                		"DISPLAY_DATE" => "Y",	// Выводить дату элемента

	                	"DISPLAY_NAME" => "Y",	// Выводить название элемента

	                	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса

	                	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса

	                	"AJAX_MODE" => "Y",	// Включить режим AJAX

	                	"IBLOCK_TYPE" => "news",	// Тип информационного блока (используется только для проверки)

	                	"IBLOCK_ID" => "12",	// Код информационного блока

	                	"NEWS_COUNT" => "3000",	// Количество новостей на странице

	                	"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей

	                	"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей

	                	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей

	                	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей

	                	"FILTER_NAME" => "",	// Фильтр

	                	"FIELD_CODE" => "",

	                	"PROPERTY_CODE" => "",

                		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы

                		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)

                		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)

	                	"ACTIVE_DATE_FORMAT" => "d-m-Y",	// Формат показа даты

                		"SET_TITLE" => "N",	// Устанавливать заголовок страницы

                		"SET_STATUS_404" => "N",	// Устанавливать статус 404, если не найдены элемент или раздел

	                	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации

	                	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации

	                	"HIDE_LINK_WHEN_NO_DETAIL" => "Y",	// Скрывать ссылку, если нет детального описания

	                	"PARENT_SECTION" => "",	// ID раздела

	                	"PARENT_SECTION_CODE" => "",	// Код раздела

	                	"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела

	                	"CACHE_TYPE" => "N",	// Тип кеширования

	                	"CACHE_TIME" => "3600",	// Время кеширования (сек.)

	                	"CACHE_FILTER" => "Y",	// Кешировать при установленном фильтре

	                	"CACHE_GROUPS" => "Y",	// Учитывать права доступа

	                	"DISPLAY_TOP_PAGER" => "Y",	// Выводить над списком

	                	"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком

	                	"PAGER_TITLE" => "Новости",	// Название категорий

	                	"PAGER_SHOW_ALWAYS" => "Y",	// Выводить всегда

	                	"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации

	                	"PAGER_DESC_NUMBERING" => "Y",	// Использовать обратную навигацию

	                	"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600",	// Время кеширования страниц для обратной навигации

	                	"PAGER_SHOW_ALL" => "Y",	// Показывать ссылку "Все"

	                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента

	                	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей

	                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера

	                	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор

	                	),

	                	false

                	);?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>