<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if($arResult["ITEMS"]): ?>

<div class="row">

<div class="navbar-title-wrapper col-xs-12">

    <div class="tp-banner-container">        

        <div class="tp-banner rs-banner" >

            <ul class="unstyled" style="position: relative">             

                <!-- MAN -->

                <? foreach($arResult["ITEMS"] as $arItem):?>

                <li data-transition="fade" data-masterspeed="0">

                    <img src="<?=SITE_TEMPLATE_PATH?>/img/transparent.png" alt="">



                    <!-- MAN -->

                    <div class="tp-caption sfb"

                        data-x="255"

                        data-y="30"

                        data-speed="900"

                        data-width="<?=$arItem['PREVIEW_PICTURE']['WIDTH'];?>"

                        data-height="<?=$arItem['PREVIEW_PICTURE']['HEIGHT'];?>">

                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arItem['NAME']?>">

                    </div>



                    <!-- TITLE -->

                    <div class="tp-caption sft"

                        data-start="2400"

                        data-x="center"

                        data-y="270"

                        data-speed="900">



                        <h2 class="rs-spectatular-title center"><?=$arItem['NAME']?></h2>

                    </div>  



                    <!-- SLOGAN -->

                    <div class="tp-caption sft"

                        data-start="2800"

                        data-x="center"

                        data-y="380"

                        data-speed="900">



                        <p class="rs-slogan center">

                            <?=$arItem['PREVIEW_TEXT']?>                                                     

                        </p>

                    </div> 



                    <!-- BUTTON -->

                    <? if(isset($arItem['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']) && $arItem['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']):?>

                    

                    <div class="tp-caption sft"

                        data-start="3200"

                        data-x="center"

                        data-y="440"

                        data-speed="900">



                        <div class="center">

                            <a title="<?=$arItem['NAME'];?>" href="<?=SITE_DIR?>ajax/video.php?video_id=<?=$arItem['DISPLAY_PROPERTIES']['VIDEO']['FILE_VALUE']['ID'];?>" class="btn btn-simple popup_video">

                            <?=GetMessage("S_WATCH_VIDEO")?>

                            </a>                

                        </div><!-- /.center -->                                                   

                    </div>

		

                    

                    <? elseif(trim($arItem['PROPERTIES']['LINK']['VALUE'])): ?>

                    <div class="tp-caption sft"

                        data-start="3200"

                        data-x="center"

                        data-y="440"

                        data-speed="900">



                        <div class="center">

                            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']; ?>" class="btn btn-simple">

                                <?=GetMessage("S_READ_MORE")?>

                            </a>                

                        </div><!-- /.center -->                                                   

                    </div>  

                    <? endif; ?>                                    



                    <div class="tp-bannertimer tp-bottom"></div>

                </li>

                <? endforeach; ?>
                

            </ul>

        </div><!-- /.tp-banner -->

    </div><!-- /.tp-banner-container -->



</div><!-- /.navbar-title-wrapper -->

</div>


<div class="row">
                        <div class="navbar-title-wrapper col-xs-12">
                            <div class="tp-banner-container">                                
                                <div class="tp-banner rs-banner" >
                                    <ul class="unstyled" style="position: relative">
                                        <!-- CHART -->
                                         

                                    </ul>
                                </div><!-- /.tp-banner -->
                            </div><!-- /.tp-banner-container -->

                        </div><!-- /.navbar-title-wrapper -->
                    </div>

<script>

	$(".popup_video").colorbox({iframe:true, width:"830", height:"620"});

</script>

<? endif; ?>