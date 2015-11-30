<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if($arResult["ITEMS"]): ?>

<div class="row">

<? foreach($arResult["ITEMS"] as $arItem):?>

<?

$arFilter = Array(

   "IBLOCK_ID"=>"19", 

   "SECTION_ID"=>($arItem['PROPERTIES']['EXCLUDED']['VALUE'])? $arItem['PROPERTIES']['EXCLUDED']['VALUE']:"-1", 

   "ACTIVE"=>"Y"

   );

$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array('NAME'));



?>









<div class="pricing-column-wrapper col-sm-4">

<div class="pricing-column <? if($arItem['PROPERTIES']['RED']['VALUE']):?>featured<? endif; ?>">

    <h2 class="pricing-column-title"><?=$arItem['~NAME'];?></h2>

    <h3 class="pricing-column-subtitle"><?=$arItem['PROPERTIES']['PRICE']['VALUE'];?></h3>

    <div class="pricing-content">

        <ul class="unstyled pricing-list">

        	<? while($ar_fields = $res->GetNext()):?>

            	<li><?=$ar_fields["NAME"]; ?></li>

            <? endwhile; ?>

        </ul><!-- /.pricing-list -->



        <a href="#menu-choose" class="btn<? if($arItem['PROPERTIES']['RED']['VALUE']):?> btn-warning<? else: ?> btn-primary<? endif; ?> show_steps"><?=GetMessage("S_TO_CONTACT")?></a>

    </div><!-- /.pricing-content -->

</div><!-- /.pricing-column -->

</div><!-- /.pricing-column-wrapper -->

<? endforeach; ?>

</div>

<? endif; ?>