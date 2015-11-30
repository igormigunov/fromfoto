<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/countdown/jquery.countdown.css" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

<?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}

//данные для репоста
$arFilter = Array(
   "IBLOCK_ID"=>"36", 
   "ACTIVE"=>"Y", 
   "ID"=>"7890"
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter);
$ar_data = $res->GetNext();
$title=urlencode($ar_data['NAME']);
$url=urlencode('http://fromfoto.com/');
$summary=urlencode(prepare_row($ar_data['PREVIEW_TEXT'])); 
$image=urlencode('http://fromfoto.com'.CFile::GetPath($ar_data['PREVIEW_PICTURE']));

$clips_send = ($_COOKIE['CLIPS_ID']) ? explode(',', $_COOKIE['CLIPS_ID']) : array();
if($USER->IsAuthorized() && !in_array($arResult['ID'], $clips_send)){
	
	
	$arFilter = array(
		"IBLOCK_TYPE"=>"clips", 
		"ID" => $arResult['ID'],
	);
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID", "PROPERTY_PREVIEW_VIDEO", "PROPERTY_YOUTUBE", "PROPERTY_FILE_LINK", "PROPERTY_TYPE_CLIP", "PROPERTY_USER_EMAIL", "PROPERTY_PAID", "PROPERTY_USER_NAME","PROPERTY_USER","PROPERTY_NO_LOGO","PROPERTY_VIDEO_COUNT","PROPERTY_TELL_FRIENDS"));
	$clip = $res->GetNext();
	
	
	if($_COOKIE['CLIPS_ID']){
		setcookie("CLIPS_ID", $_COOKIE['CLIPS_ID'].','.$clip['ID'], time() + 3600*24*3, "/");
	}else{
		setcookie("CLIPS_ID", $clip['ID'], time() + 3600*24*3, "/");
	}
	
	$PROP = array();
	$PROP[109] = ($clip['PROPERTY_PAID_VALUE'])?5:0;
	$PROP[110] = $clip['PROPERTY_TYPE_CLIP_VALUE'];
	$PROP[107] = $clip['PROPERTY_USER_EMAIL_VALUE'];
	$PROP[106] = $clip['PROPERTY_USER_NAME_VALUE'];
	$PROP[185] = $clip['PROPERTY_VIDEO_COUNT_VALUE'];
	$PROP[127] = $clip['PROPERTY_FILE_LINK_VALUE'];
	$PROP[217] = $clip['PROPERTY_YOUTUBE_VALUE'];
	$PROP[225] = $clip['PROPERTY_PREVIEW_VIDEO_VALUE'];
	$PROP[209] = $USER->GetID();
	$PROP[218] = ($clip['PROPERTY_TELL_FRIENDS_VALUE']) ? 49 : 0;
	$PROP[177] = ($clip['PROPERTY_NO_LOGO_VALUE'])?37:0;
	$arLoadProductArray = Array(
		"MODIFIED_BY"    	=> 1,
		"IBLOCK_SECTION" 	=> false,
		"PROPERTY_VALUES"	=> $PROP,
		"DATE_CREATE" 		=> ConvertTimeStamp(time(), "FULL"),
		"ACTIVE"        	=> "Y",
	);

	$el = new CIBlockElement;

	$res = $el->Update($clip['ID'], $arLoadProductArray);
}

$arFilter = Array(

   "IBLOCK_TYPE"=>"clips", 

   "ACTIVE"=>"Y", 

   "ID"=>$arResult['PROPERTIES']['TYPE_CLIP']['VALUE']

   );

$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","PROPERTY_COST","PROPERTY_CURRENCY","PROPERTY_FREE_PERIOD", "PROPERTY_SHOW_OPROS", "PROPERTY_VIDEO_COST", "PROPERTY_FREE_PRICE"));



$ar_clip = $res->GetNext();

function Get_currency($currency){
	switch ($currency) {
	    case "3":
	        return "р.";
	        break;
	    case "4":
	        return "$";
	        break;
	    case "17":
	        return "EUR";
	        break;
	}	
}

function Get_currency_robo($currency){
	switch ($currency) {
	    case "3":
	        return "";
	        break;
	    case "4":
	        return "WMZ";
	        break;
	    case "17":
	        return "WME";
	        break;
	}
}



$arFilter = Array(

   "IBLOCK_TYPE"=>"clips", 

   "ACTIVE"=>"Y", 

   "ID"=>$arResult['PROPERTIES']['TYPE_CLIP']['VALUE']

   );

$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME", "PROPERTY_COST","PROPERTY_CURRENCY","PROPERTY_FREE_PERIOD", "PROPERTY_SHOW_OPROS", "PROPERTY_VIDEO_COST", "PROPERTY_FREE_PRICE"));
$ar_clip = $res->GetNext();

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
<? if(time() < strtotime($arResult['ACTIVE_TO'])): ?>
<div style="margin: 0px auto 25px;" class="klip-text">
	<br /><br />
	<p>ВНАМАНИЕ! Готовый клип будет в лучшем качестве и без надписи «ОБРАЗЕЦ»</p>

</div>
<div class="video" style="width: <? if(is_mobile()): ?>260px;<? else: ?>520px;<? endif; ?>">
<?
	$tmp = $_COOKIE['UPLOAD_FILES']."/resizes/";
	$path_to_dir = '/upload/tmp/'.$tmp.'r/prev/';
	$uploaddir = $_SERVER['DOCUMENT_ROOT'].$path_to_dir;
	$dir = '/home/admin/zakaz/'.$arResult['ID'].'_33/';
	if (!file_exists($dir)) {
		LocalRedirect("/create_video/?video_id=".$_REQUEST['video_id']);
	}
	if (!file_exists($uploaddir)) {
		mkdir($uploaddir, 0755, true);
	}
	if (file_exists($dir)) {
		$filename = $dir."check_list.txt";
		$handle = fopen($filename, "r");
		$contents_img = fread($handle, filesize($filename));
		$contents_img = ( explode("\r\n", $contents_img ) );
		fclose($handle);
		copy($dir.$contents_img[0], $uploaddir.$contents_img[0]);
		//echo $uploaddir.$contents_img[0];
	}
?>
<? 
$APPLICATION->IncludeComponent("bitrix:player", ".default", array(
	"PATH" => $arResult['PROPERTIES']['PREVIEW_VIDEO']['VALUE'],
	"PROVIDER" => "",
	"WIDTH" => is_mobile()? "260" : "520",
	"HEIGHT" => is_mobile()? "160" : "320",
	"AUTOSTART" => "N",
	"REPEAT" => "none",
	"VOLUME" => "90",
	"ADVANCED_MODE_SETTINGS" => "N",
	"PLAYER_TYPE" => "auto",
	"USE_PLAYLIST" => "N",
	"STREAMER" => "",
	"PREVIEW" => (file_exists($uploaddir.$contents_img[0])) ? $path_to_dir.trim($contents_img[0]) : '',
	"FILE_TITLE" => "",
	"FILE_DURATION" => "",
	"FILE_AUTHOR" => "",
	"FILE_DATE" => "",
	"FILE_DESCRIPTION" => "",
	"PLAYER_ID" => "",
	"BUFFER_LENGTH" => "10",
	"DOWNLOAD_LINK" => "",
	"DOWNLOAD_LINK_TARGET" => "_self",
	"ADDITIONAL_WMVVARS" => "",
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
	"ADDITIONAL_FLASHVARS" => "",
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
</div>
<? endif; ?>

<? if(time() < strtotime($arResult['ACTIVE_TO'])): ?>
<br />
<div class="klip-text" style="margin: 24px auto 25px; letter-spacing: -0.25px;">
	<p>Фото в клипе неправильно обрезаны? Покажите, какие именно - и мы сделаем Ваш клип ещё лучше!</p>
	<a class="button-slide button-slide1 " style="display: inline-block;" href="/change_video/?video_id=<?=$arResult['PROPERTIES']['TYPE_CLIP']['VALUE']; ?>&clip=<?=rand(100,999); ?><?=$arResult['ID']; ?><?=rand(1,9); ?>">поправить фото</a>
</div>
<div class="klip-text" style="margin: 24px auto 25px; letter-spacing: -0.25px;">
	<p>Понравился клип? Подтвердите заказ и получите своё видео без надписи «Образец», <br />в лучшем качестве (HD) и с возможностью забрать себе. БЕСПЛАТНО! </p>
	<a class="button-slide button-slide1 open_auth" style="display: inline-block;" href="#">подтвердить заказ</a>
</div>
<div class="popup auth_popup" style="display: none;">
	<div style="display: none">
	<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","soc_create_n",Array(
		"REGISTER_URL" => "register.php",
		"FORGOT_PASSWORD_URL" => "",
		"PROFILE_URL" => "profile.php",
		"SHOW_ERRORS" => "Y" 
		)
	);?>
	</div>
	<div class="popup-container with_border" style="margin: -160px auto 0; top: 50%; border: 3px solid #7f93b1;">
		<div id="close_popup_btn" style="cursor:pointer; position: relative; left: 100%; margin-top: -40px;">
			<img src="/images/close_btn.png" style="width: 40px;" />
		</div>
		<div class="wait" style="text-align: center;">
			<div class="mail" style="margin:50px 0 0; text-align: center; min-height: 106px;">
				<span style="font-family:'One_Days'; color: #5d7395; line-height: 1.4; display: block; margin-bottom: 17px; text-transform: uppercase;">Какой соц.сетью вы пользуетесь?</span> 
				<div class="soc_auth" style="width:132px;">
					  <span class="vk_auth">
						<img class="vk_img" src="/images/vk_auth.png" />
						<img class="vk_img_hover" src="/images/vk_auth_hover.png" />				
					  </span>
					  <span class="ok_auth">
						<img class="ok_img" src="/images/ok_auth.png" />
						<img class="ok_img_hover" src="/images/ok_auth_hover.png" />
					  </span>
				</div>
			</div>
			<a href="#" style="display: inline-block; text-transform: uppercase; font-size: 10px;" class="button-slide button-slide1 no_soc">Я не пользуюсь соцсетями</a>
		</div>
	</div>
</div>

<div class="popup without_auth" style="display: none; z-index: 9999;">
<?
$ar_clip['PROPERTY_COST_VALUE'] = ($ar_clip['PROPERTY_COST_VALUE']) ? $ar_clip['PROPERTY_COST_VALUE'] : '300';

if($ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 27 || $ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 3){
	$m_curr = "RUB";
}elseif($ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 4 || $ar_clip['PROPERTY_CURRENCY_ENUM_ID'] == 8){
	$m_curr = "USD";
}else{
	$m_curr = "EUR";
}
$m_shop = S_SHOP;
$inv_id = $arResult['ID'].'0959';
$out_summ = number_format(preg_replace("/\s/","",$ar_clip['PROPERTY_COST_VALUE']), 2, '.', '');

$inv_desc = base64_encode(GetMessage("S_PAYMENT").$arResult["ID"]);
$m_key = S_KEY;

// регистрационная информация (логин, пароль #1) // registration info (login, password #1) 
$mrh_login = "fromfoto"; 
$mrh_pass1 = "7Qq9hoK9WU"; 
$shp_item = 1; 
$culture = 'ru'; 
$encoding = "utf-8";
$IncCurrLabel = Get_currency_robo($ar_clip['PROPERTY_CURRENCY_ENUM_ID']); 

$crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1:shpItem=$shp_item"); // HTML-страница с кассой // ROBOKASSA HTML-page 
$crc  = md5("$mrh_login::$inv_id:$mrh_pass1:shpItem=$shp_item");

?>
	<form action='https://auth.robokassa.ru/Merchant/Index.aspx' method="POST" style="display: none;" id="PayForm_r">
		<input type="hidden" name="MrchLogin" value="<?=$mrh_login?>" />
		<input type="hidden" name="FreeOutSum" value="<?=$out_summ?>" id="DefaultSum" />
		<input type="hidden" name="InvoiceID" value="<?=$inv_id?>" />
		<input type="hidden" name="Description" value="<?=$inv_desc?>" />
		<input type="hidden" name="SignatureValue" value="<?=$crc?>" />
		<input type="hidden" name="shpItem" value="<?=$shp_item?>" />
		<input type="hidden" name="Culture" value="<?=$culture?>" />
		<input type="hidden" name="Encoding" value="<?=$encoding?>" />
		<input type="submit" value="Оплаить" style="display: none;" id="PauSubmit_r"/>
	</form>	
	<div class="popup-container with_border" 
	<? if(is_mobile()): ?>
		style="margin: -160px auto 0; top: 50%; border: 3px solid #7f93b1; width: 76%;"
	<? else: ?>
		style="width: 37%; margin: -127px auto 0; top: 50%; border: 3px solid #7f93b1; height:165px; "
	<? endif; ?>
	>
		<div id="close_without_auth_btn" style="cursor:pointer; position: relative; left: 100%; margin-top: -40px;">
			<img src="/images/close_btn.png" style="width: 40px;" />
		</div>
		<div class="wait" style="text-align: center;">
			<div class="mail" style="margin:30px 0 0; text-align: center; min-height: 80px;">
				<span style="font-size:14px; font-family:'One_Days'; color: #5d7395; line-height: 1.4; display: block; margin-bottom: 17px; text-transform: uppercase;">
					К сожалению, мы не сможем сделать<br />
					ваш клип бесплатно, если вы не пользуетесь <br />
					вконтакте или Одноклассниками			
				</span> 
			</div>
			<a id="PayRobokassa" href="#" style="display: inline-block; text-transform: uppercase; font-size: 10px;" class="button-slide button-slide1 pay_money">оплатить <?=$ar_clip['PROPERTY_COST_VALUE']; ?>р за клип</a>
		</div>
	</div>
</div>

<div class="popup popup_repost" style="display: none;">
	<div class="pay_block"></div>
	<div class="popup-container with_border" style="margin: -160px auto 0; top: 50%;">
		<div id="close_popup_repost_btn" style="cursor:pointer; position: relative; left: 100%; margin-top: -40px;">
			<img src="/images/close_btn.png" style="width: 40px;" />
		</div>
		<div class="wait" style="text-align: center;">
			<span class="ready-klip normal big-kl" style=" color: #5d7395; font-family:'One_Days'; text-decoration: uppercase; margin: 40px 20px 20px 20px;" >
				сделайте репост и получите своё видео бесплатно! 
			</span>
			
			<? if(!$USER->IsAuthorized()): ?>
			<?$APPLICATION->IncludeComponent("bitrix:system.auth.form","soc_create_n",Array(
				"REGISTER_URL" => "register.php",
				"FORGOT_PASSWORD_URL" => "",
				"PROFILE_URL" => "profile.php",
				"SHOW_ERRORS" => "Y" 
				)
			);?>
			<? else: ?>
			<div class="wait_repost">
				<a href="#" style="text-decoration: uppercase; margin-bottom: 10px; width: 256px;" onclick="yaCounter25315490.reachGoal('repost1');"  class="button-slide under-content-title repost_clip_vk">сделать репост</a>
			</div>
			<? endif; ?>
			
			<span class="ready-klip normal big-kl" style="letter-spacing: 0.75px; color: #5d7395; font-family:'One_Days'; text-decoration: uppercase; margin: 40px 20px 20px 20px;" >
				не хотите делать репост? оплатите 100р. и мы сделаем ваше видео без репоста.
			</span>
			<a class="button-slide under-content-title pay_clip_vk" onclick="yaCounter25315490.reachGoal('pay_no_repost');" style="text-decoration: uppercase; margin-bottom: 10px; width: 256px;" href="#">оплатить</a>
		</div>
	</div>
</div>
<script>
	$('.open_auth').click(function(e){
		e.preventDefault();
		<? if($USER->IsAuthorized()): ?>
			$('.popup_repost').show();
		<? else: ?>
			$('.auth_popup').show();
		<? endif; ?>
	});
	$('#close_popup_btn').click(function(e){
		e.preventDefault();
		$('.auth_popup').hide();
	});
	$('#close_popup_repost_btn').click(function(e){
		e.preventDefault();
		$('.popup_repost').hide();
	});
	$('div.soc_auth > span').click(function(){
		if($(this).hasClass('ok_auth')){
			$('.auth_popup .odnoklassniki-button').trigger('click');
		}else{
			$('.auth_popup .vkontakte-button').trigger('click');
		}
	});
	$('.no_soc').click(function(e){
		e.preventDefault();
		$('.without_auth').show();
	});
	$('#close_without_auth_btn').click(function(e){
		e.preventDefault();
		$('.without_auth').hide();
	});
	$('#PayRobokassa').click(function(e){
		e.preventDefault();
		$("#PayForm_r").submit();
	});
	<? if($USER->IsAuthorized()): ?>
		$('.popup_repost').show();
		$('.pay_clip_vk').click(function(e){
			e.preventDefault();
			$.post("<?=SITE_DIR?>ajax/submit_fast.php", {}, function(data){
				if(data != '1'){
					$('.pay_block').html(data);
					$('#PayForm').submit();
				}else{
					setTimeout(function(){window.location = '/fljvrFG/?check=1';}, 1*1000);	
				}
			});
		});
		$('.repost_clip_vk').click(function(e){
			e.preventDefault();
			$('.wait_repost').html('<img style="height: 40px;" src="<?=SITE_TEMPLATE_PATH?>/images/preload.gif" />');
			<? if($USER->IsAuthorized() && preg_match("/OKuser/i", $USER->GetLogin())):?>
				window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=urlencode('http://fromfoto.com/repost/'.rand(9999999, 99999999).'/');?>','sharer','toolbar=0,status=0,width=548,height=325');
			<? else: ?>
				window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');
			<? endif; ?>
			setTimeout(function(){window.location = '/fljvrFG/?check=1';}, 15*1000);	
		});
	<? endif; ?>
</script>
<style>
.popup .button-slide{
	font-size: 14px;
}
</style>
<? else: ?>
<div class="klip-text" style="margin: 24px auto 25px;">
	<p>К сожалению время хранения Вашего клипа истекло</p>
	<a class="button-slide button-slide1 " style="display: inline-block;" href="/clips/">создать новый клип</a>
</div>
<br />
<? endif; ?>
<style>
	.button-slide.button-slide1 {
		display: inline-block;
		height: 35px;
		line-height: 35px;
		min-width: 170px;
		padding: 0 25px;
	}
</style>