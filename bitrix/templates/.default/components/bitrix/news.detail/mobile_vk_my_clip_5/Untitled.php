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

if(empty($ar_clip["PROPERTY_FREE_PERIOD_ENUM_ID"]))
{
	LocalRedirect("/clip/buy/?num=".$arResult["ID"]);
}

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

<div class="container_video">

	<div class="video_maket">

<?//<iframe style="width: 500px; height: 275px;" src="//www.youtube.com/embed/Kgsn7ccF1ZM?showinfo=0&rel=0&showinfo&modestbranding=1&autoplay=1&disablekb=1"></iframe>?>
    	<? 

         $APPLICATION->IncludeComponent("bitrix:player", ".default", array(

	//"PATH" => (!$arResult['PROPERTIES']['PAID']['VALUE'])?CFile::GetPath($arResult["PROPERTIES"]["VIDEO"]["VALUE"]):$arResult['PROPERTIES']['FILE_LINK']['VALUE'],
	//"PATH" => (empty($arResult['PROPERTIES']['TELL_FRIENDS']['VALUE']))?CFile::GetPath($arResult["PROPERTIES"]["VIDEO"]["VALUE"]):(!empty($arResult['PROPERTIES']['YOUTUBE']['VALUE']))?$arResult['PROPERTIES']['YOUTUBE']['VALUE']:$arResult['PROPERTIES']['FILE_LINK']['VALUE'],
	"PATH" => (empty($arResult['PROPERTIES']['TELL_FRIENDS']['VALUE']) || $arResult['PROPERTIES']['TELL_FRIENDS']['VALUE_ENUM_ID'] == "50")?CFile::GetPath($arResult["PROPERTIES"]["VIDEO"]["VALUE"]):$arResult['PROPERTIES']['YOUTUBE']['VALUE'],

	"PROVIDER" => "",

	"WIDTH" => "700",

	"HEIGHT" => "420",

	"AUTOSTART" => "N",

	"REPEAT" => "none",

	"VOLUME" => "90",

	"ADVANCED_MODE_SETTINGS" => "N",

	"PLAYER_TYPE" => "auto",

	"USE_PLAYLIST" => "N",

	"STREAMER" => "",

	"PREVIEW" => "",

	"FILE_TITLE" => "",

	"FILE_DURATION" => "",

	"FILE_AUTHOR" => "",

	"FILE_DATE" => "",

	"FILE_DESCRIPTION" => "",

	"PLAYER_ID" => "",

	"BUFFER_LENGTH" => "10",

	"DOWNLOAD_LINK" => "",

	"DOWNLOAD_LINK_TARGET" => "_self",

	"ADDITIONAL_WMVVARS" => "modestbranding=1",

	"ALLOW_SWF" => "N",

	"SKIN_PATH" => "/bitrix/components/bitrix/player/mediaplayer/skins",

	"SKIN" => "",

	"CONTROLBAR" => "bottom",

	"WMODE" => "transparent",

	"LOGO" => "",

	"LOGO_LINK" => "",

	"LOGO_POSITION" => "none",

	"PLUGINS" => array(

		0 => "",

		1 => "",

	),

	"ADDITIONAL_FLASHVARS" => "modestbranding=1",

	"WMODE_WMV" => "window",

	"SHOW_CONTROLS" => "Y",

	"SHOW_DIGITS" => "Y",

	"CONTROLS_BGCOLOR" => "FFFFFF",

	"CONTROLS_COLOR" => "000000",

	"CONTROLS_OVER_COLOR" => "000000",

	"SCREEN_COLOR" => "000000",

	"MUTE" => "N"

	),

	false

);?> 

<?
	$no_logo_cost = ($arResult['PROPERTIES']['NO_LOGO']['VALUE'])?$logo_sett['PROPERTY_LOGO_COST_VALUE']:0;

	$ar_clip['PROPERTY_COST_VALUE'] = ($arResult['PROPERTIES']['NO_LOGO']['VALUE'])?($ar_clip['PROPERTY_COST_VALUE'] + $logo_sett['PROPERTY_LOGO_COST_VALUE']):$ar_clip['PROPERTY_COST_VALUE'];
	$cost_video = ($ar_clip['PROPERTY_VIDEO_COST_VALUE'] || $ar_clip['PROPERTY_VIDEO_COST_VALUE'] === '0')? trim($ar_clip['PROPERTY_VIDEO_COST_VALUE']): "100";
	
	
	if($arResult['PROPERTIES']['VIDEO_COUNT']['VALUE']){
		$ar_clip['PROPERTY_COST_VALUE'] += $arResult['PROPERTIES']['VIDEO_COUNT']['VALUE']*$cost_video;
	}
	
	if($ar_clip['PROPERTY_FREE_PRICE_VALUE']){
		$ar_clip['PROPERTY_COST_VALUE'] = 777;
	}

?>    
    </div>

    <? /*<div class="share"><div id="ya_share1"></div></div> */?>

    <div class="video_descr">

    	<?/* $APPLICATION->IncludeFile(

			$APPLICATION->GetTemplatePath("include_areas/".$en_land."user_video_text.php"),

			Array(),

			Array("MODE"=>"html")

		);*/?>

    

    

    	<?// if(!$arResult['PROPERTIES']['PAID']['VALUE']): ?>

    	<?

        	$_plural_days = array(GetMessage("S_DAY"), GetMessage("S_DAYS"), GetMessage("S_DAYS1")); 

			$day = round((strtotime($arResult["ACTIVE_TO"])-time())/(3600*24));

		?>

		<!--<p>
			<?=GetMessage("S_VALIDITY_SHOW")?> <b><?=$day;?> <?=$_plural_days[plural_type($day)]; ?></b>. <?=GetMessage("S_YOU_CAN_PAY")?><br />
        	<? if(!$ar_clip['PROPERTY_FREE_PRICE_VALUE']):?><b><?=GetMessage("S_COST")?> <span class="cost_value"><?=$ar_clip['PROPERTY_COST_VALUE']; ?></span><?=$ar_clip['PROPERTY_CURRENCY_VALUE']; ?></b><? endif; ?>
        </p>-->
        
        <? if($ar_clip['PROPERTY_FREE_PRICE_VALUE']): ?>
        	<p style="font-size:20px;"><?=GetMessage("S_YOUR_PRICE")?> <input class="change_price" value="777" /></p>
        <? endif; ?>

        
<?

if($ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 27 || $ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 3){
	$m_curr = "RUB";
}elseif($ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 4 || $ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 8){
	$m_curr = "USD";
}else{
	$m_curr = "EUR";
}
$m_shop = S_SHOP;
$inv_id = $arResult['ID'];
//$out_summ = number_format(preg_replace("/\s/","",$ar_clip['PROPERTY_COST_VALUE']), 2, '.', '');
$out_summ = number_format(preg_replace("/\s/","","100"), 2, '.', '');

$inv_desc = base64_encode(GetMessage("S_PAYMENT").$arResult["ID"]);
$m_key = S_KEY;

//$arHash = array(
	//$m_shop,
	//$m_orderid,
	//$m_amount,
	//$m_curr,
	//$m_desc,
	//$m_key
//);
//$sign = strtoupper(hash('sha256', implode(":", $arHash)));


 // регистрационная информация (логин, пароль #1) // registration info (login, password #1) 
 $mrh_login = "fromfoto"; 
 $mrh_pass1 = "7Qq9hoK9WU"; 
 $shp_item = 1; 
 $culture = $land; 
 $encoding = "utf-8";  
 
 $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shpItem=$shp_item"); // HTML-страница с кассой // ROBOKASSA HTML-page ?>
 
 <?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}
$title=urlencode(prepare_row(GetMessage("S_TITLE")));
//$url=urlencode('http://fromfoto.com/');
//$url=urlencode("http://www.youtube.com/watch?v=".str_replace("http://youtu.be/", "", $arResult['PROPERTIES']['YOUTUBE']['VALUE'])."&feature=youtu.be");
$url=urlencode("http://www.youtube.com/watch?v=".str_replace("http://youtu.be/", "", $arResult['PROPERTIES']['YOUTUBE']['VALUE'])."");
//$url=urlencode($arResult['PROPERTIES']['YOUTUBE']['VALUE']);
$summary=urlencode(prepare_row(GetMessage("S_DESCRIPTION"))); 
$image=urlencode('http://fromfoto.com/images/logo2.png');


?>

 <div class="row">
 	<?if(empty($arResult['PROPERTIES']['TELL_FRIENDS']['VALUE_ENUM_ID'])):?>

    <a href="#text_before_submit_free" class="order_clip_btn"> Поделится с друзьями </a>

    <div class="popup_video_work_station">
    	<div id="text_before_submit_free">
    		<p class="hh1">Отличные новости:<br />
				Ваш клип готов!</p>
    		<p style="color: #000;">на какую страничку (Вконтакте, Одноклассники, facebook) 
				<br/> бесплатно добавить ваше видео?  </p>
			<div class="soc_s">
				<a href="#" class="a_order_clip_btn_vk"><img src="/images/vk.png" /></a>
				<a href="#" class="a_order_clip_btn_ok"><img src="/images/ok.png" /></a>
				<a href="#" class="a_order_clip_btn_fb"><img src="/images/fb.png" /></a>
			</div>
        	<?=$ar_fields['PREVIEW_TEXT']; ?>
        </div>
    </div>
    
	<script>
		 $(document).ready(function(){
			$('.popup_video_work_station').show();
        }); 
	</script>
    <script>
		$('.a_order_clip_btn_vk').click(function(e){
			e.preventDefault();
			var clips = 0;
				clips = <?=$arResult["ID"]; ?>;
			window.open('https://vk.com/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>','sharer','toolbar=0,status=0,width=548,height=325');
			$.post('/ajax/change_tell_friends.php',{clips:clips},function(){
				var timer_reload = setInterval(function() { window.location = window.location.href; }, 10*1000);
				//window.location = window.location.href;
			});
		});
		$('.a_order_clip_btn_ok').click(function(e){
			e.preventDefault();
			var clips = 0;
				clips = <?=$arResult["ID"]; ?>;
			window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php echo $url; ?>&st.comments=<?php echo $title; ?>','sharer','toolbar=0,status=0,width=548,height=325');
			$.post('/ajax/change_tell_friends.php',{clips:clips},function(){
				var timer_reload = setInterval(function() { window.location = window.location.href; }, 10*1000);
				//window.location = window.location.href;
			});
		});
		$('.a_order_clip_btn_fb').click(function(e){
			e.preventDefault();
			var clips = 0;
				clips = <?=$arResult["ID"]; ?>;
			window.open('http://www.facebook.com/share.php?u=<?php echo $url; ?>','sharer','toolbar=0,status=0,width=548,height=325');
			$.post('/ajax/change_tell_friends.php',{clips:clips},function(){
				var timer_reload = setInterval(function() { window.location = window.location.href; }, 10*1000);
				//window.location = window.location.href;
			});
		});

		
	</script>
    <style>
    
    	#text_before_submit_free .soc_s{
    		text-align: center;
    	}
    	#text_before_submit_free .soc_s a{
    		display: inline-block;
    		padding: 15px;
    	}
		#text_before_submit_free .hh1{
			text-transform:uppercase;
			color:#5d7395;
			font-weight: bold;
			text-align: center;
			font-size: 25px;
			padding: 20px 0;
		}
		#text_before_submit_free p{
			text-transform:uppercase;
			text-align: center;
			font-size: 16px;
		}
		#text_before_submit_free{
			width: 500px;
			height: 350px;
			border: #5d7395 2px solid;
			margin: 10% auto;
			background: #fff;
		}
		.popup_video_work_station{
			position: fixed;
			top: 0;
			width: 100%;
			text-align: center;
			left: 0;
			height: 100%;
			z-index:999999;
			display:none;
			background-color: rgba(0,0,0,0.7);
		}
		

	</style>

<?/*
	 	<div class=" video-done">
	 		<p class="hh1"><?=GetMessage("S_TITLE3")?></p>
	 		<p>Заберите своё слайд-шоу в течении 2 минут совершенно БЕСПЛАТНО: </p>

			<div class="timer" start_time="<?=date()+60*2; ?>">
				<div class="countdown"></div>
				<p style="text-align:center; font-size:16px; display:none;" class="note"></p>
			</div>


	 		<ul class="social2">
				<li>
					<a onClick="window.open('https://vk.com/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" title="<?=GetMessage("S_SHARE_VK");?>" class="social-target tell_friends">
						<img src="/images/vk.png" alt="<?=GetMessage("S_SHARE_VK");?>" class="img-responsive">
					</a>
				</li>
				<li>
					<a onClick="window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php echo $url; ?>&st.comments=<?php echo $title; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" title="<?=GetMessage("S_SHARE_OK");?>" class="social-target tell_friends">
						<img src="/images/ok.png" alt="<?=GetMessage("S_SHARE_OK");?>" class="img-responsive">
					</a>
				</li>
				<li>
					<a onClick="window.open('http://www.facebook.com/share.php?u=<?php echo $url; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" title="<?=GetMessage("S_SHARE_FB");?>" class="social-target tell_friends">
						<img src="/images/fb.png" alt="<?=GetMessage("S_SHARE_FB");?>" class="img-responsive">
					</a>
				</li>
			</ul>
	 	</div>
		<script>
			var timer_reload = setInterval(function() { window.location = window.location.href; }, 120*1000);
		</script>*/?>
		
	<?endif;?>
 	<?if($arResult['PROPERTIES']['TELL_FRIENDS']['VALUE_ENUM_ID'] == "49"):?>
	 	<div class=" video-done">
	 		<p class="hh1"><?=GetMessage("S_TITLE2")?></p>
	 		<p><?=GetMessage("S_MIN_PRICE_STR")?></p>
			 <div class="html_form">
			 <?
			 print "<html><script language=JavaScript ". "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormV.js?". "MerchantLogin=$mrh_login&OutSum=$out_summ&InvoiceID=$inv_id". "&Description=$inv_desc&SignatureValue=$crc&shpItem=$shp_item". "&Culture=$culture&Encoding=$encoding'></script></html>";
	
			 ?>
			 </div>
		</div>
	<?endif;?>
 	<?if($arResult['PROPERTIES']['TELL_FRIENDS']['VALUE_ENUM_ID'] == "50"):?>
	 	<div class="video-done">
	 		<p class="hh1"><?=GetMessage("S_TITLE1")?></p>
	 		<p><?=GetMessage("S_MIN_PRICE_STR")?></p>
			 <div class="html_form">
			 <?
			 print "<html><script language=JavaScript ". "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormV.js?". "MerchantLogin=$mrh_login&OutSum=$out_summ&InvoiceID=$inv_id". "&Description=$inv_desc&SignatureValue=$crc&shpItem=$shp_item". "&Culture=$culture&Encoding=$encoding'></script></html>";
	
			 ?>
			 </div>
		</div>
	<?endif;?>
</div>
 
<script>
$('.change_price').keyup(function(e) {
	var new_price = parseInt('<?=GetMessage("S_MIN_PRICE")?>')+parseInt('<?=$no_logo_cost;?>');
	if(parseInt($(this).val()) > (parseInt('<?=GetMessage("S_MIN_PRICE")?>')+parseInt('<?=$no_logo_cost;?>'))){
		new_price = parseInt($(this).val());
	}
	//$(this).val(new_price);
	$(this).html(new_price);
	$('.html_form').html('<iframe src="/ajax/change_price_btn.php?new_price='+new_price+'&m_curr=<?=$m_curr;?>&inv_desc=<?=$inv_desc;?>&inv_id=<?=$inv_id;?>&land=<?=$land;?>" frameborder="0" scrolling="no" width="190" height="95"></iframe>');
	
	//$.post('/ajax/change_price_btn.php',{new_price:new_price,m_curr:'<?=$m_curr;?>',inv_desc:'<?=$inv_desc;?>',inv_id:'<?=$inv_id;?>',land:'<?=$land;?>'},function(data){
		
	//});
});
</script>
<script>
	
	$('.tell_friends').click(function(){
		var clips = 0;
			clips = <?=$arResult["ID"]; ?>;
		$.post('/ajax/change_tell_friends.php',{clips:clips},function(){
			window.location = window.location.href;
		});
	});
</script>

<? /*<form method="GET" action="//payeer.com/api/merchant/m.php">
<input type="hidden" name="m_shop" value="<?=$m_shop?>">
<input type="hidden" name="m_orderid" value="<?=$m_orderid?>">
<input type="hidden" name="m_amount" value="<?=$m_amount?>">
<input type="hidden" name="m_curr" value="<?=$m_curr?>">
<input type="hidden" name="m_desc" value="<?=$m_desc?>">
<input type="hidden" name="m_sign" value="<?=$sign?>">
<input type="hidden" name="lang" value="<?=$land?>">
<input type="submit" name="m_process" class="btn btn-primary" value="<?=GetMessage("S_PAY");?>" />
</form>*/?>
       <!-- <a download target="_blank" href="<?=CFile::GetPath($arResult["PROPERTIES"]["VIDEO"]['VALUE']);?>"><?=GetMessage("S_PREV_DOWNLOAD");?></a>-->
       
       
		<?/* else:?>
        	<br/><a download class="opros_before" target="_blank" href="<?=$arResult['PROPERTIES']['FILE_LINK']['VALUE'];?>"><?=GetMessage("S_DOWNLOAD");?></a>
            <a download class="opros_after" style="display:none;" href="<?=$arResult['PROPERTIES']['FILE_LINK']['VALUE'];?>"><?=GetMessage("S_DOWNLOAD");?></a>
        <? endif; */?>
		<? if($ar_clip['PROPERTY_SHOW_OPROS_VALUE']): ?>
        	<script>
				$('.opros_before').click(function(e){
					//if(!getCookie("ALREADY_SEND")){
						e.preventDefault();
						$('.opros_form').show('slow');
						//$(this).unbind('click');
						//setcookie("ALREADY_SEND","1",3600*24*365,"/");
						//window.location.href = $(this).attr('href');
					//}
				});
				
				

			</script>
            
            
            <div class="opros_form" style="display:none;">
       <?$APPLICATION->IncludeComponent("bitrix:form", "opros", Array(
	"AJAX_MODE" => "Y",	// Включить режим AJAX
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"WEB_FORM_ID" => "1",	// ID веб-формы
	"RESULT_ID" => $_REQUEST[RESULT_ID],	// ID результата
	"START_PAGE" => "new",	// Начальная страница
	"SHOW_LIST_PAGE" => "N",	// Показывать страницу со списком результатов
	"SHOW_EDIT_PAGE" => "N",	// Показывать страницу редактирования результата
	"SHOW_VIEW_PAGE" => "N",	// Показывать страницу просмотра результата
	"SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
	"SHOW_ANSWER_VALUE" => "N",	// Показать значение параметра ANSWER_VALUE
	"SHOW_ADDITIONAL" => "N",	// Показать дополнительные поля веб-формы
	"SHOW_STATUS" => "Y",	// Показать текущий статус результата
	"EDIT_ADDITIONAL" => "N",	// Выводить на редактирование дополнительные поля
	"EDIT_STATUS" => "Y",	// Выводить форму смены статуса
	"NOT_SHOW_FILTER" => "",	// Коды полей, которые нельзя показывать в фильтре
	"NOT_SHOW_TABLE" => "",	// Коды полей, которые нельзя показывать в таблице
	"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
	"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
	"IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
	"USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"CACHE_NOTES" => "",
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"VARIABLE_ALIASES" => array(
		"action" => "action",
	)
	),
	false
);?> 
</div>
            
        <? endif; ?>
        

        <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>

        

        <script>

			new Ya.share({

        		element: 'ya_share1',

            		elementStyle: {

             		   'type': 'button',

            		    'border': true,

             		   'quickServices': ['yaru', '|',  'vkontakte', '|','facebook', '|','twitter', '|','odnoklassniki', '|','moimir', '|','gplus']

          		  },

				 l10n:'<?=$land;?>', 

           		 popupStyle: {

            		    blocks: {

                   		 '<?=GetMessage("S_SHARE")?>': ['yaru', 'vkontakte', 'facebook', 'twitter', 'odnoklassniki', 'moimir', 'gplus'],

              		  },

              		  copyPasteField: true

           		 }

			});

		</script>

        

       </div>

    </div>

    <style>

	.video_maket, .share{

		display: table;

    	margin-left: auto;

    	margin-right: auto;

	}

	.text-done {
		font-size: 13px;
		font-family: Verdana;
		color: #000;
		width: 419px;
		margin: 10px auto 25px auto;
	}

	.video_descr{

		text-align:center;
		color: #7f93b1;
		font-size: 18px;
		margin-top: 30px;

	}

	.slide-done {
		color: #5d7395;
		font-size: 20px;
		margin-top: 50px;
		font-weight: bold;
	}

	.share{

		margin-top:5px;

		margin-bottom:5px;

	}

	.create-link {
		background: #7487a4;
		color: #fff;
		padding: 9px 17px;
		border-radius: 3px;
		font-family: "Days","Arial",sans-serif;
		height: 44px;
		font-size: 17px;
		text-decoration: none;
		display: inline-block;
	}

	

	.container_video{

		margin-top:10px;

		margin-bottom:10px;

		min-height:256px;

	}
	
	.video_descr iframe{
		min-width:170px !important;
	}
	.video-done .hh1{
		color: #5d7395;
		font-size: 16px;
		*font-weight: bold;
	}
	.video-done p {
		font-size: 12px;
	}
	
	.social2{
		margin-left: 29%;
	}

</style>
<?/*
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/countdown/jquery.countdown.js"></script>
<style>
.countDays, .countDiv0{
	display:none;
}
</style>
<script>
$(function(){
	$('.timer').each(function(){
	if($(this).attr('start_time')){
	var note = $('.note', $(this)),
		ts = new Date(2012, 0, 1),
		newYear = true;
	
	if((new Date()) > ts){
		// The new year is here! Count towards something else.
		// Notice the *1000 at the end - time must be in milliseconds
		ts = (new Date()).getTime() + parseInt($(this).attr('start_time'))*1000;
		newYear = false;
	}
		
	$('.countdown', $(this)).countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){
			
			var message = "";
			
			message += hours + "ч" + ", ";
			message += minutes + "мин" + " и ";
			message += seconds + "сек";
			
			
			note.html(message);
		}
	});
	}
	});
});
</script>
<?/*
	if(empty($arResult['PROPERTIES']['TELL_FRIENDS']['VALUE']))
	{
		CModule::IncludeModule("iblock");
	
		$upd_arr["TELL_FRIENDS"] = '50';
		
		CIBlockElement::SetPropertyValuesEx($arResult["ID"], false, $upd_arr);
	}*/
?>