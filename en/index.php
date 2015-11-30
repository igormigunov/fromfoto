<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "Create your video");

$APPLICATION->SetTitle("Create your video");

?> 

    

                <div class="col-sm-12 col-xs-12">

                    <!-- FEATURES -->

                    <?$APPLICATION->IncludeComponent("bitrix:news.list", "main_features", Array(

                		"DISPLAY_DATE" => "Y",	// Выводить дату элемента

	                	"DISPLAY_NAME" => "Y",	// Выводить название элемента

	                	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса

	                	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса

	                	"AJAX_MODE" => "Y",	// Включить режим AJAX

	                	"IBLOCK_TYPE" => "features",	// Тип информационного блока (используется только для проверки)

	                	"IBLOCK_ID" => "27",	// Код информационного блока

	                	"NEWS_COUNT" => "3",	// Количество новостей на странице

	                	"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей

	                	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей

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

	                	"CACHE_TYPE" => "A",	// Тип кеширования

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

	                	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"

	                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента

	                	"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей

	                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера

	                	"AJAX_OPTION_ADDITIONAL" => "N",	// Дополнительный идентификатор

	                	),

	                	false

                	);?>

                    <!-- /.features -->



                    <!-- SERVICES -->

                    <div  id="menu-services" class="block-content services-wrapper block-padding">

                        <div class="services">

                        	<? $APPLICATION->IncludeFile(

									$APPLICATION->GetTemplatePath("include_areas/en_services_intro.php"),

									Array(),

									Array("MODE"=>"html")

								);?>

                            <?$APPLICATION->IncludeComponent("bitrix:news.list", "main_services", Array(

                		"DISPLAY_DATE" => "Y",	// Выводить дату элемента

	                	"DISPLAY_NAME" => "Y",	// Выводить название элемента

	                	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса

	                	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса

	                	"AJAX_MODE" => "Y",	// Включить режим AJAX

	                	"IBLOCK_TYPE" => "services",	// Тип информационного блока (используется только для проверки)

	                	"IBLOCK_ID" => "29",	// Код информационного блока

	                	"NEWS_COUNT" => "3000",	// Количество новостей на странице

	                	"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей

	                	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей

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

	                	"CACHE_TYPE" => "A",	// Тип кеширования

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

	                	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"

	                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента

	                	"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей

	                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера

	                	"AJAX_OPTION_ADDITIONAL" => "N",	// Дополнительный идентификатор

	                	),

	                	false

                	);?>



                            <!-- /.row -->

                        </div><!-- /.services -->

                    </div><!-- /.services-wrapper -->
                    
                    
                    <!-- instruction -->

                    <?  $APPLICATION->IncludeComponent("bitrix:news.detail","instruction",Array(

	                    	"DISPLAY_DATE" => "Y",

	                    	"DISPLAY_NAME" => "Y",

	                    	"DISPLAY_PICTURE" => "Y",

	                    	"DISPLAY_PREVIEW_TEXT" => "Y",

	                    	"AJAX_MODE" => "N",

	                    	"IBLOCK_TYPE" => "info",

	                    	"IBLOCK_ID" => "",

	                    	"ELEMENT_ID" => "487",

	                    	"ELEMENT_CODE" => "",

	                    	"CHECK_DATES" => "Y",

		                    "FIELD_CODE" => array("PREVIEW_PICTURE"),

		                    "PROPERTY_CODE" => array("VIDEO","youtube"),

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

                    ); ?>

                    <!-- /.instruction-wrapper -->



                    <!-- RECENT WORKS -->

                    <div id="menu-choose" class="block-content works-wrapper">

                        <div class="works block-padding fullwidth background-gray">

                        	<? $APPLICATION->IncludeFile(

									$APPLICATION->GetTemplatePath("include_areas/en_choose_intro.php"),

									Array(),

									Array("MODE"=>"html")

								);?>

                                

                                

                            <? $APPLICATION->IncludeComponent("bitrix:menu", "clips", Array(

	                            "ROOT_MENU_TYPE" => "clips",	

	                            "MENU_CACHE_TYPE" => "N",	

	                            "MENU_CACHE_TIME" => "3600",	

	                            "MENU_CACHE_USE_GROUPS" => "N",	

	                            "MENU_CACHE_GET_VARS" => "",	

	                            "MAX_LEVEL" => "10",	

	                            "CHILD_MENU_TYPE" => "clips",	

	                            "USE_EXT" => "Y",	

	                            "DELAY" => "N",	

	                            "ALLOW_MULTI_SELECT" => "N",	

	                            ),

	                            false

                            ); ?>    



                            

                            

                            

                            

							<? $APPLICATION->IncludeComponent("bitrix:news.list", "main_clips", Array(

                		"DISPLAY_DATE" => "Y",	// Выводить дату элемента

	                	"DISPLAY_NAME" => "Y",	// Выводить название элемента

	                	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса

	                	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса

	                	"AJAX_MODE" => "Y",	// Включить режим AJAX

	                	"IBLOCK_TYPE" => "clips",	// Тип информационного блока (используется только для проверки)

	                	"IBLOCK_ID" => "34",	// Код информационного блока

	                	"NEWS_COUNT" => "3000",	// Количество новостей на странице

	                	"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей

	                	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей

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

	                	"CACHE_TYPE" => "A",	// Тип кеширования

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

	                	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"

	                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента

	                	"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей

	                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера

	                	"AJAX_OPTION_ADDITIONAL" => "N",	// Дополнительный идентификатор

	                	),

	                	false

                	);?>

                            <!-- /.works-items -->

                        </div><!-- /.works -->

                    </div><!-- /.works-wrapper -->



                    <!-- PRICING -->

                    <div id="menu-pricing" class="block-content pricing-wrapper block-padding">

                        <div class="pricing">

                        	<? $APPLICATION->IncludeFile(

									$APPLICATION->GetTemplatePath("include_areas/en_prices_intro.php"),

									Array(),

									Array("MODE"=>"html")

								);?>

                            

							<?$APPLICATION->IncludeComponent("bitrix:news.list", "main_prices", Array(

                		"DISPLAY_DATE" => "Y",	// Выводить дату элемента

	                	"DISPLAY_NAME" => "Y",	// Выводить название элемента

	                	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса

	                	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса

	                	"AJAX_MODE" => "Y",	// Включить режим AJAX

	                	"IBLOCK_TYPE" => "prices",	// Тип информационного блока (используется только для проверки)

	                	"IBLOCK_ID" => "23",	// Код информационного блока

	                	"NEWS_COUNT" => "3000",	// Количество новостей на странице

	                	"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей

	                	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей

	                	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей

	                	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей

	                	"FILTER_NAME" => "",	// Фильтр

	                	"FIELD_CODE" => "",

	                	"PROPERTY_CODE" => array("PRICE","RED","EXCLUDED"),

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

	                	"CACHE_TYPE" => "A",	// Тип кеширования

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

	                	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"

	                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента

	                	"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей

	                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера

	                	"AJAX_OPTION_ADDITIONAL" => "N",	// Дополнительный идентификатор

	                	),

	                	false

                	);?>

                     <!-- /.row -->

                        </div><!-- /.pricing -->

                    </div><!-- /.pricing-wrapper -->



                    <!-- ABOUT -->

                    <? $APPLICATION->IncludeComponent("bitrix:news.detail","info",Array(

	                    	"DISPLAY_DATE" => "Y",

	                    	"DISPLAY_NAME" => "Y",

	                    	"DISPLAY_PICTURE" => "Y",

	                    	"DISPLAY_PREVIEW_TEXT" => "Y",

	                    	"AJAX_MODE" => "N",

	                    	"IBLOCK_TYPE" => "info",

	                    	"IBLOCK_ID" => "",

	                    	"ELEMENT_ID" => "365",

	                    	"ELEMENT_CODE" => "",

	                    	"CHECK_DATES" => "Y",

		                    "FIELD_CODE" => array("PREVIEW_PICTURE"),

		                    "PROPERTY_CODE" => "",

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

                    <!-- /.about-wrapper -->



                    <!-- RECENT POSTS -->

                    <div id="menu-news" class="block-content recent-posts-wrapper">

                        <div class="recent-posts block-padding fullwidth background-gray">

                            

                            

                                <? $APPLICATION->IncludeFile(

									$APPLICATION->GetTemplatePath("include_areas/en_news_intro.php"),

									Array(),

									Array("MODE"=>"html")

								);?>

                            <div class="posts-wrapper news_add">

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

	                	"FIELD_CODE" => array("DETAIL_TEXT"),

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

	                	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"

	                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента

	                	"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей

	                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера

	                	"AJAX_OPTION_ADDITIONAL" => "N",	// Дополнительный идентификатор

	                	),

	                	false

                	);?>



                         </div>   <!-- /.posts-wrapper -->

                        </div><!-- /.recent-posts -->

                    </div><!-- /.recent-posts-wrapper -->

                    <!-- CONTACT INFO-->

                    <? $APPLICATION->IncludeComponent("bitrix:news.detail","contact",Array(

	                    	"DISPLAY_DATE" => "N",

	                    	"DISPLAY_NAME" => "N",

	                    	"DISPLAY_PICTURE" => "N",

	                    	"DISPLAY_PREVIEW_TEXT" => "Y",

	                    	"AJAX_MODE" => "N",

	                    	"IBLOCK_TYPE" => "contacts",

	                    	"IBLOCK_ID" => "",

	                    	"ELEMENT_ID" => "378",

	                    	"ELEMENT_CODE" => "",

	                    	"CHECK_DATES" => "Y",

		                    "FIELD_CODE" => "",

		                    "PROPERTY_CODE" => Array("ADDRESS","PHONE","EMAIL","MAP_DESCR","MAP","BALOON_DESCR"),

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



                    <!-- FEEDBACK -->

                    <div class="block-content block-padding fullwidth" id="menu-feedback">

                        <h2 class="block-title center">Feedback Form</h2>



                        <p class="center slogan mb50">

                        	<? $APPLICATION->IncludeFile(

									$APPLICATION->GetTemplatePath("include_areas/en_feedback_text.php"),

									Array(),

									Array("MODE"=>"html")

								);?>

                        </p>

                        

                        <div id="answer"></div>



                        <form method="post" id="send_feedback" action="#">

                            <div class="row">

                                <div class="form-group col-sm-6">

                                    <input id="name_feed" type="text" class="form-control" placeholder="Enter the name">

                                </div><!-- /.form-group -->



                                <div class="form-group col-sm-6">

                                    <input id="email_feed" type="email" class="form-control" placeholder="Enter your email address">

                                </div><!-- /.form-group -->

                            </div>



                            <div class="form-group">

                                <div class="row">

                                    <div class="col-sm-12">

                                        <textarea id="text_feed" class="form-control" placeholder="Enter the message" rows="6"></textarea>

                                    </div>

                                </div><!-- /.row -->

                            </div><!-- /.form-group -->



                            <input type="submit" value="Send" id="feed_btn" class="btn btn-primary">

                        </form>

                    </div><!-- /.block-padding -->



                    <!-- SUBSCRIBE -->

                    <div class="block-content subscribe-wrapper">

                        <div class="subscribe background-gray block-padding fullwidth">

                            <h2 class="block-title center">Subscribe to our newsletter and important events</h2>



                            <form method="post" action="?">

                                <div class="row">

                                    <div class="form-group col-sm-9">

                                        <input type="email" id="subscribe_email" required class="form-control" placeholder="E-mail">

                                    </div><!-- /.form-group -->



                                    <div class="col-sm-3 col-xs-12">

                                        <button type="submit" id="subscribe_btn" class="btn btn-block btn-primary">Subscribe</button>

                                    </div>



                                    <? /*<div class="subscribe-promise col-sm-12">

                                        <p><span class="required">*</span> We promise to keep all your detalis safe and we wont send spam!</p>

                                    </div><!-- /.promise --> */?>                               

                                </div><!-- /.row -->

                            </form>

                        </div><!-- /.subscribe -->

                    </div><!-- /.subscribe-wrapper -->  



                    <!-- PARTNERS -->    

                    <div class="block-content partners-wrapper">

                        <div class="partners block-padding">

                        	<? $APPLICATION->IncludeFile(

									$APPLICATION->GetTemplatePath("include_areas/en_partner_intro.php"),

									Array(),

									Array("MODE"=>"html")

								);?>

                            

							<?$APPLICATION->IncludeComponent("bitrix:news.list", "main_partners", Array(

                		"DISPLAY_DATE" => "Y",	// Выводить дату элемента

	                	"DISPLAY_NAME" => "Y",	// Выводить название элемента

	                	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса

	                	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса

	                	"AJAX_MODE" => "Y",	// Включить режим AJAX

	                	"IBLOCK_TYPE" => "partners",	// Тип информационного блока (используется только для проверки)

	                	"IBLOCK_ID" => "28",	// Код информационного блока

	                	"NEWS_COUNT" => "3000",	// Количество новостей на странице

	                	"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей

	                	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей

	                	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей

	                	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей

	                	"FILTER_NAME" => "",	// Фильтр

	                	"FIELD_CODE" => "",

	                	"PROPERTY_CODE" => array("LINK"),

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

	                	"CACHE_TYPE" => "A",	// Тип кеширования

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

	                	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"

	                	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента

	                	"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей

	                	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера

	                	"AJAX_OPTION_ADDITIONAL" => "N",	// Дополнительный идентификатор

	                	),

	                	false

                	);?>

                            

                        </div><!-- /.subscribe -->

                    </div><!-- /.partners-wrapper -->

                </div><!-- /.col-sm-12 -->

            



    

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>