</div><!-- /.row -->

</div><!-- /.container -->

</div><!-- /.main -->

<?

	$lang = (SITE_ID == 'en')?'en_':'';

?>

<? //if($APPLICATION->GetCurPage(false) != '/'):?>

<footer class="footer-wrapper">
    <div class="footer-outer">
        <div class="footer-inner">
            <div class="footer"> 
                
                <? /*               

                    <div class="footer-widgets">

                        <div class="container">

                            <div class="row">

                            <div class="widget col-sm-2 col-xs-12">

                            	<? $APPLICATION->IncludeFile(

											$APPLICATION->GetTemplatePath("include_areas/".$lang."menu1.php"),

											Array(),

											Array("MODE"=>"html")

										);?>

                             </div>

                                <!-- /.widget -->	

                                <div class="widget col-sm-3 col-xs-12">

                                    <? $APPLICATION->IncludeFile(

											$APPLICATION->GetTemplatePath("include_areas/".$lang."menu2.php"),

											Array(),

											Array("MODE"=>"html")

										);?>

                                </div><!-- /.widget -->

                                <div class="widget col-sm-3 col-col-xs-12">

                                    <? $APPLICATION->IncludeFile(

											$APPLICATION->GetTemplatePath("include_areas/".$lang."menu3.php"),

											Array(),

											Array("MODE"=>"html")

										);?>

                                </div><!-- /.widget -->                        

                                <div class="widget border-left col-sm-4 col-xs-12">

                                    <div class="col-sm-offset-1">

                                    	<? $APPLICATION->IncludeFile(

											$APPLICATION->GetTemplatePath("include_areas/".$lang."footer_info.php"),

											Array(),

											Array("MODE"=>"html")

										);?>

                                    </div>

                                </div><!-- /.widget -->

                            </div><!-- /.row -->                    

                        </div><!-- /.container -->

                    </div><!-- /.footer-widgets -->*/?>

                        <div class="middle-footer"
							<div class="row">
								<div class="col-xs-3">
									<p class="copyright">
		                                    	<? $APPLICATION->IncludeFile(

													$APPLICATION->GetTemplatePath("include_areas/".$lang."copyright.php"),

													Array(),

													Array("MODE"=>"html")

												);?>
		                            </p>
								</div>
									<div class="col-xs-6 fr_mail">
										<p>ТЕХ.ПОДДЕРЖКА СЕРВИСА: <a href="mailto:fromfoto.com@gmail.com">fromfoto.com@gmail.com</a></p>
									</div>
										<div class="col-xs-3">
											<?

													$iblock_id = (SITE_ID == 'en')?'25':'15';

												?>

		                                    <? $APPLICATION->IncludeComponent("bitrix:news.list", "main_social", Array(

							                		"DISPLAY_DATE" => "Y",	// Выводить дату элемента

								                	"DISPLAY_NAME" => "Y",	// Выводить название элемента

								                	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса

								                	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса

								                	"AJAX_MODE" => "Y",	// Включить режим AJAX

								                	"IBLOCK_TYPE" => "social",	// Тип информационного блока (используется только для проверки)

								                	"IBLOCK_ID" => $iblock_id,	// Код информационного блока

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



		                                    <!-- /.social -->
										</div>
							</div>
						</div>

                                                       

                </div><!-- /.footer -->

            </div><!-- /.footer-inner -->

        </div><!-- /.footer-outer -->

    </footer><!-- /.footer-wrapper -->
<? //endif;?>

</div><!-- /#wrapper -->

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

		window.location = $(this).attr("href");

	});

</script>

<? endif; ?>

</body>

</html>