<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/countdown/jquery.countdown.css" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

<?


$arFilter = Array(

   "IBLOCK_TYPE"=>"clips", 

   "ACTIVE"=>"Y", 

   "ID"=>$arResult['PROPERTIES']['TYPE_CLIP']['VALUE']

   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","PROPERTY_COST","PROPERTY_CURRENCY","PROPERTY_FREE_PERIOD", "PROPERTY_SHOW_OPROS", "PROPERTY_VIDEO_COST", "PROPERTY_FREE_PRICE"));



$ar_clip = $res->GetNext();
/*if(empty($ar_clip["PROPERTY_FREE_PERIOD_ENUM_ID"]))
{
	LocalRedirect("/clip/buy/?num=".$arResult["ID"]);
}*/

	//настройки для логотипа.
$arFilter = Array(
   "IBLOCK_ID"=>"17", 
   "ACTIVE"=>"Y", 
   "ID"=>"1586"
   );
$arSelect = array("NAME","PREVIEW_TEXT","ID","PROPERTY_LOGO_COST","PROPERTY_LOGO_SIZE");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$logo_sett = $res->GetNext();

?>
<? if($arResult["PROPERTIES"]["YOUTUBE"]["VALUE"]):?>
<div class="video">
<iframe frameborder="0" src="<?=preg_replace("/youtu\.be/", 'www.youtube.com/embed', $arResult["PROPERTIES"]["YOUTUBE"]["VALUE"]); ?>?rel=0&amp;loop=1&amp;modestbranding=1&amp;showinfo=0&amp;controls=0" allowfullscreen="" style="width: 100%; height: 100%;"></iframe>
<div id="video_fix"></div>
</div>
<? endif; ?>

<? if(!$arResult['PROPERTIES']['PAID']['VALUE']): ?>
<? if(time() < strtotime($arResult['ACTIVE_TO'])): ?>
<div class="klip-text" style="margin: 24px auto 25px;">
	<p>Если фото неправильно обрезаны - укажите на них и мы исправим Ваш клип (бесплатно)</p>
	<a class="button-slide button-slide1 " style="display: inline-block;" href="/change_video/?video_id=<?=$arResult['PROPERTIES']['TYPE_CLIP']['VALUE']; ?>&clip=<?=rand(100,999); ?><?=$arResult['ID']; ?><?=rand(1,9); ?>">поправить фото</a>
</div>
<? else: ?>
<br />
<? endif; ?>
<?
$no_logo_cost = ($arResult['PROPERTIES']['NO_LOGO']['VALUE'])?$logo_sett['PROPERTY_LOGO_COST_VALUE']:0;

//$ar_clip['PROPERTY_COST_VALUE'] = ($arResult['PROPERTIES']['NO_LOGO']['VALUE'])?($ar_clip['PROPERTY_COST_VALUE'] + $logo_sett['PROPERTY_LOGO_COST_VALUE']):$ar_clip['PROPERTY_COST_VALUE'];
$cost_video = ($ar_clip['PROPERTY_VIDEO_COST_VALUE'] || $ar_clip['PROPERTY_VIDEO_COST_VALUE'] === '0')? trim($ar_clip['PROPERTY_VIDEO_COST_VALUE']): "100";
	
	
if($arResult['PROPERTIES']['VIDEO_COUNT']['VALUE']){
	$ar_clip['PROPERTY_COST_VALUE'] += $arResult['PROPERTIES']['VIDEO_COUNT']['VALUE']*$cost_video;
}
	
if($ar_clip['PROPERTY_FREE_PRICE_VALUE']){
	$ar_clip['PROPERTY_COST_VALUE'] = 777;
}


if($ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 27 || $ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 3){
	$m_curr = "RUB";
}elseif($ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 4 || $ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 8){
	$m_curr = "USD";
}else{
	$m_curr = "EUR";
}
$m_shop = S_SHOP;
$inv_id = $arResult['ID'].'0959';
$out_summ = number_format(preg_replace("/\s/","","100"), 2, '.', '');
$out_summ = number_format(preg_replace("/\s/","","444"), 2, '.', '');

$inv_desc = base64_encode(GetMessage("S_PAYMENT").$arResult["ID"]);
$m_key = S_KEY;
// регистрационная информация (логин, пароль #1) // registration info (login, password #1) 
$mrh_login = "fromfoto"; 
$mrh_pass1 = "7Qq9hoK9WU"; 
$shp_item = 1;
$culture = $land; 
$encoding = "utf-8";
$def_sum = $ar_clip["~PROPERTY_COST_VALUE"]>0?$ar_clip["~PROPERTY_COST_VALUE"]:GetMessage("S_MIN_PRICE");
$def_sum2 = 100;
	$inv_id=0;
$crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shpItem=$shp_item"); // HTML-страница с кассой // ROBOKASSA HTML-page
$crc  = md5("$mrh_login::$inv_id:$mrh_pass1:shpItem=$shp_item");

 ?>
 <?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}
$title=urlencode(prepare_row(GetMessage("S_TITLE")));
$url=urlencode("http://www.youtube.com/watch?v=".str_replace("http://youtu.be/", "", $arResult['PROPERTIES']['YOUTUBE']['VALUE'])."");
$summary=urlencode(prepare_row(GetMessage("S_DESCRIPTION"))); 
$image=urlencode('http://fromfoto.com/images/logo2.png');
?>

<div class="klip-text" style="margin: 0px auto 25px; width: 100%;">
	<? if($ar_clip["~PROPERTY_COST_VALUE"]>0):?>
		<p style="font-size:20px; text-transform: uppercase"><b>скачайте свое видео:</b></p>
	<? else:?>
	<p style="font-size:18px; text-transform: uppercase">Поздравляем с отличным клипом! Выбирайте тариф:</p>
	<? endif;?>
	<div class="image_box" style="margin-top: 20px; margin-top: 60px">
		<? if($ar_clip["~PROPERTY_COST_VALUE"]>0):?>
			<div class="tarif-box special" style="width: 30%">
				<div class="ttu border-bottom" style="height: 50px; line-height: 50px;letter-spacing: -1px; font-size: 80%"><?=$ar_clip["~NAME"]?></div>
				<div>
					<span class="price fg"><?=$ar_clip["~PROPERTY_COST_VALUE"]?></span><span class="fg" style="vertical-align: top;line-height: 38px;">руб.</span>
				</div>
				<div style="padding: 0 22px">
					<div class="border-bottom text" style="text-align: center;     padding: 20px 0;">
						Хочу сделать подарок. Яркий и оригинальный!
					</div>
					<div class="border-bottom icon icon-yes text">
						Наилучшее качество
						видео
					</div>
					<div class="border-bottom icon icon-yes text">
						Возможность скачать
						видео БЕЗ нашего лого
					</div>
					<div class="border-bottom icon icon-yes text">
						Скидка 50% на дизайн
						из категории "Лучшее"
					</div>
					<div class="border-bottom icon icon-yes text">
						Без логотипа FromFoto
						и рекламы
					</div>
				</div>
				<a href="javascript::void(0)" class="button-slide button-slide1" style="margin-top: 30px" onclick="doRobo(<?=$def_sum?>,1,'<?=md5("$mrh_login::$inv_id:$mrh_pass1:shpItem=1")?>')">Скачать</a>
			</div>
		<? else:?>
		<div class="tarif-box" style="width: 30%">
			<div class="ttu border-bottom" style="height: 50px; line-height: 50px;letter-spacing: -1px;">просто так</div>
			<div>
				<span class="price fg">0</span><span class="fg" style="vertical-align: top;line-height: 38px;">руб.</span>
			</div>
			<div style="padding: 0 22px">
				<div class="border-bottom text" style="text-align: center;     padding: 20px 0;">
					Забрать видео на мою страничку в соцсеть.
				</div>
				<div class="border-bottom icon icon-yes text">
					Среднее качество
				</div>
				<div class="border-bottom icon icon-no text">
					Скачать видео
				</div>
				<div class="border-bottom icon icon-no text">
					Скидка 50% на следующий заказ!
				</div>
				<div class="border-bottom icon icon-no text">
					Без логотипа FromFoto
				</div>
			</div>
			<a href="javascript::void(0)" class="button-slide button-slide1" style="margin-top: 30px" onclick="$('#pop2').show()">Забрать в соцсеть</a>
		</div>
		<div class="tarif-box special" style="width: 30%">
			<div class="ttu border-bottom" style="height: 50px; line-height: 50px;letter-spacing: -1px;">важное событие</div>
			<div>
				<span class="price fg">300</span><span class="fg" style="vertical-align: top;line-height: 38px;">руб.</span>
			</div>
			<div style="padding: 0 22px">
				<div class="border-bottom text" style="text-align: center;     padding: 20px 0;">
					Хочу сделать подарок. Яркий и оригинальный!
				</div>
				<div class="border-bottom icon icon-yes text">
					Отличное качество (HD)
				</div>
				<div class="border-bottom icon icon-yes text">
					Скачать видео
				</div>
				<div class="border-bottom icon icon-yes text">
					Скидка 50% на следующий заказ!
				</div>
				<div class="border-bottom icon icon-yes text">
					Без логотипа FromFoto
				</div>
			</div>
			<a href="javascript:void(0)" onclick="doRobo(<?=$def_sum?>,1,'<?=md5("$mrh_login::$inv_id:$mrh_pass1:shpItem=1")?>')" class="button-slide button-slide1"  style="margin-top: 30px">Скачать</a>
		</div>
		<div class="tarif-box" style="width: 30%">
			<div class="ttu border-bottom" style="height: 50px; line-height: 50px;letter-spacing: -1px;">порадовать</div>
			<div>
				<span class="price fg">100</span><span class="fg" style="vertical-align: top;line-height: 38px;">руб.</span>
			</div>
			<div style="padding: 0 22px">
				<div class="border-bottom text" style="text-align: center;     padding: 20px 0;">
					Порадую себя или кого-то из близких :)
				</div>
				<div class="border-bottom icon icon-yes text">
					Среднее качество
				</div>
				<div class="border-bottom icon icon-yes text">
					Скачать видео
				</div>
				<div class="border-bottom icon icon-no text">
					Скидка 50% на следующий заказ!
				</div>
				<div class="border-bottom icon icon-no text">
					Без логотипа FromFoto
				</div>
			</div>
			<a href="javascript:void(0)" onclick="doRobo(<?=$def_sum2?>,2,'<?=md5("$mrh_login::$inv_id:$mrh_pass1:shpItem=2")?>')" class="button-slide button-slide1" style="margin-top: 30px">Скачать</a>
		</div>
		<? endif;?>
	</div>
	<div class="popup" id="pop2" style="display: none;">

		<div class="popup-container with_border" style="margin: -160px auto 0; top: 50%;">
			<a href="javascript:void(0)" id="vs_close_btn" onclick="$('#pop2').hide()">&nbsp;</a>
			<div class="content-title bold-title lh-0">
				выберите свою социальную сеть
			</div>
			<div class="content-title bold-title lh-0" style="display: table;width: 77%; margin-left: 12% !important">
				<div style="display: table-cell; text-align: center"><a href="javascript:void(0)" class="box-button vk a_order_clip_btn_vk_1" onClick="window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>','sharer','toolbar=0,status=0,width=548,height=325');">&nbsp;</a></div>
				<div style="display: table-cell;text-align: center"><a href="javascript:void(0)" class="box-button ok a_order_clip_btn_ok_1" onClick="window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=$url;?>','sharer','toolbar=0,status=0,width=548,height=325'); return false; ">&nbsp;</a></div>
			</div>
		</div>
	</div>
</div>
 <div class="klip-text" style="margin: 0px auto 25px;">
 <form action='https://auth.robokassa.ru/Merchant/Index.aspx' method="POST" style="display: none;" id="PayForm">
	<input type="hidden" name="MrchLogin" value="<?=$mrh_login?>" />
	<input type="hidden" name="FreeOutSum" value="<?=$def_sum?>" id="DefaultSum" />
	<input type="hidden" name="InvoiceID" value="<?=$inv_id?>" />
	<input type="hidden" name="Description" value="<?=$inv_desc?>" />
	<input type="hidden" name="SignatureValue" value="<?=$crc?>" id="SignatureValue" />
	<input type="hidden" name="shpItem" value="<?=$shp_item?>" id="shpItem" />
	<input type="hidden" name="Culture" value="<?=$culture?>" />
	<input type="hidden" name="Encoding" value="<?=$encoding?>" />
	<input type="submit" value="Оплаить" style="display: none;" id="PauSubmit"/>
</form>	



<? if(time() < strtotime($arResult['ACTIVE_TO'])): ?>
	<p>Хотите скачать свой клип в лучшем качестве и без нашего лого?</p>
	<a class="button-slide button-slide1 " id="PayRobokassa" style="display: inline-block;" href="#">оплатить и скачать</a>
<? else: ?>
	<p>
		Извините, мы не храним клипы в хорошем качестве более 48 часов, 
		<a style="color: #687d9c;" href="/clips/">создайте</a> заказ заново.
	</p>
<? endif; ?>
 
 </div>
 <? else: ?>
 <div class="klip-text">
	<div class="klip-text-title"><?=GetMessage("S_TITLE4")?></div>
</div> <!-- /ajax/getFile.php?FILE= -->
<div class="video-done">
	<a onclick="yaCounter25315490.reachGoal('buy');" download class="btn_go create_new 1 button-slide" target="_blank" href="<?=$arResult['PROPERTIES']['FILE_LINK']['VALUE'];?>"><?=GetMessage("S_DOWNLOAD");?></a>
</div>

<?endif;?>

<div style="clear:both"></div>

<? if(time() < strtotime($arResult['ACTIVE_TO'])): ?>
<div class="small-text">
    Внимание! Ваш клип будет храниться у нас не более 2х суток. Поспешите его скачать или забрать на свою страницу в соц.сетях.
</div>
<? endif; ?>


 
<script>
$('.tell_friends').click(function(){
	var clips = 0;
		clips = <?=$arResult["ID"]; ?>;
	$.post('/ajax/change_tell_friends.php',{clips:clips},function(){
		window.location = window.location.href;
	});
});
function doRobo($summ,shpItem,SignatureValue){
	$('#DefaultSum').val($summ)
	$('#shpItem').val(shpItem)
	$('#SignatureValue').val(SignatureValue)
	$("#PayForm").submit();
}

</script>
<style>
	.button-slide.button-slide1 {
		display: inline-block;
		height: 35px;
		line-height: 35px;
		min-width: 50px;
		padding: 0 25px;
	}
</style>