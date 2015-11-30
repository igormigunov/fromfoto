<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>



 <div id="menu-contact" class="block-content features-simple-wrapper block-padding fullwidth">

                        <div class="features-simple">

                            <div class="row">

                            	<? if(trim(strip_tags($arResult['PROPERTIES']['ADDRESS']['~VALUE']['TEXT']))):?>

                                <div class="features-simple-block col-sm-4">

                                    <div class="center">

                                        <i class="features-simple-icon fa fa-map-marker"></i>

                                    </div><!-- /.center -->



                                    <h2 class="block-subtitle center"><?=GetMessage("S_ADDRESS")?></h2>                                    



                                    <p class="center">

                                        <?=$arResult['PROPERTIES']['ADDRESS']['~VALUE']['TEXT'];?>

                                    </p>

                                </div><!-- /.features-simple-block -->

                                <? endif; ?>

								<? if(trim(strip_tags($arResult['PROPERTIES']['PHONE']['~VALUE']['TEXT']))):?>

                                <div class="features-simple-block col-sm-4">

                                    <div class="center">

                                        <i class="features-simple-icon fa fa-phone"></i>

                                    </div><!-- /.center -->



                                    <h2 class="block-subtitle center"><?=GetMessage("S_PHONES")?></h2>                                    



                                    <p class="center">

                                        <?=$arResult['PROPERTIES']['PHONE']['~VALUE']['TEXT'];?>

                                    </p>

                                </div><!-- /.features-simple-block -->

                                <? endif; ?>

								<? if(trim(strip_tags($arResult['PROPERTIES']['EMAIL']['~VALUE']['TEXT']))):?>

                                <div class="features-simple-block col-sm-4">

                                    <div class="center">

                                        <i class="features-simple-icon fa fa-envelope"></i>

                                    </div><!-- /.center -->



                                    <h2 class="block-subtitle center"><?=GetMessage("S_MAIL")?></h2>                                    



                                    <p class="center">

                                        <?=$arResult['PROPERTIES']['EMAIL']['~VALUE']['TEXT'];?>

                                    </p>

                                </div><!-- /.features-simple-block -->

                                <? endif; ?>

                            </div><!-- /.row -->

                        </div><!-- /.features-simple -->

                    </div><!-- /.features-simple -->

			

                    <!-- OUR LOCATION -->
					<? if(trim(strip_tags($arResult['PROPERTIES']['MAP_DESCR']['~VALUE']['TEXT']))):?>
                    <div class="block-content block-padding fullwidth background-gray">

                        <?=$arResult['PROPERTIES']['MAP_DESCR']['~VALUE']['TEXT'];?>

                    </div><!-- /.block-padding -->
					 <? endif; ?> 
                    

                    <? if(trim(strip_tags($arResult['PROPERTIES']['MAP']['VALUE']))):?>

                    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>

                    <script>

						ymaps.ready(init);

						function init () {

							var myMap = new ymaps.Map("map_show", {

           						center: [<?=$arResult['PROPERTIES']['MAP']['VALUE'];?>],

            					zoom: 7

       						}),

        					myPlacemark = new ymaps.Placemark([<?=$arResult['PROPERTIES']['MAP']['VALUE'];?>], {

            					balloonContentBody: "<?=$arResult['PROPERTIES']['BALOON_DESCR']['~VALUE']['TEXT'];?>",

        					});



    						myMap.geoObjects.add(myPlacemark);

						}

					

					</script>



                    <div class="fullwidth-no-padding" id="map_show" style="height:200px;">



                    </div><!-- /.fullwidth-no-padding -->      

                    <? endif; ?>  
                    

