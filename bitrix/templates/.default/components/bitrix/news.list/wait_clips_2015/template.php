<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//для третьего репоста

$arFilter = Array(
   "IBLOCK_ID"=>"36", 
   "ACTIVE"=>"Y", 
   "ID"=>"7891"
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter);
$ar_data = $res->GetNext();
$title1=urlencode($ar_data['NAME']);
$url1=urlencode('http://fromfoto.com/');
$summary1=urlencode(prepare_row($ar_data['PREVIEW_TEXT'])); 
$image1=urlencode('http://fromfoto.com'.CFile::GetPath($ar_data['PREVIEW_PICTURE']));

//для первого репоста

$arFilter = Array(
   "IBLOCK_ID"=>"36", 
   "ACTIVE"=>"Y", 
   "ID"=>"7892"
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter);
$ar_data = $res->GetNext();
$title=urlencode($ar_data['NAME']);
$url=urlencode('http://fromfoto.com/');
$summary=urlencode(prepare_row($ar_data['PREVIEW_TEXT'])); 
$image=urlencode('http://fromfoto.com'.CFile::GetPath($ar_data['PREVIEW_PICTURE']));

function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}

?> 
<?
global $USER;
if($USER->IsAuthorized()){
	$USER->Logout();
}
?> 
<? $this->SetViewTarget("online_state"); ?>
<div class="page-title" style="color: #5d7395;">
	<span>Личный кабинет</span>
</div>
<? $this->EndViewTarget(); ?>
<? $this->SetViewTarget("add_content_class"); ?>page-slide-table <? if($_REQUEST['PRODUCT_ID']): ?>new_cabinet_content<? endif; ?><? $this->EndViewTarget(); ?>
<div class="slide-table-title" style="border-bottom: 0px;">
    <span><?=GetMessage("S_TYPE");?></span>
	<span><?=GetMessage("S_READINESS");?></span>
	<span><?=GetMessage("S_LOOK");?></span>
</div>
<? if($arResult["ITEMS"]): ?>
<div class="slide-table">
<?
$type_clips_id = array();
foreach($arResult["ITEMS"] as $arItem){
	$type_clips_id[] = $arItem['PROPERTIES']['TYPE_CLIP']['VALUE'];
}
$arFilter = Array(
	"IBLOCK_TYPE"=>"clips", 
	"ID"=>$type_clips_id
);
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_TIME_CREATE","PREVIEW_PICTURE", "PROPERTY_FREE_PERIOD"));
$type_clips = array();
while($ar_fields = $res->GetNext())
{
	$type_clips[$ar_fields["ID"]] = $ar_fields;
}
?>
<? foreach($arResult["ITEMS"] as $arItem):?>
<?
if($arItem['PROPERTIES']['FILE_LINK']['VALUE']){
	//LocalRedirect('/show_preview/?clip='.rand(100, 999).$arItem['ID']);
}
?>
<div class="slide-table-item">
	<div class="slide-name">
		<?=$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['NAME']; ?>
	</div>
	<? 
	$renderImage = CFile::ResizeImageGet($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
	
	$order = 1;			
	$create_time = 24*60;
	$plus_24 = 0;

	$start_time = (strtotime($arItem['DATE_CREATE'])+$order*$create_time*60 + $plus_24)-time();

	$start_time = ($start_time>0)?$start_time:false;
	if($start_time && $start_time>24*3600){
		$start_time = 24*3600 - 1;
	}
	if(!$start_time){
		$start_time = rand(20,24)*60;
	}
	
	
	$wait_zakaz = file_exists("/home/admin/wait_zakaz/".$arItem['ID']."_33/");
	?>
	<? if($wait_zakaz):?>
		<div class="slide-time">
			<div class="countdown-title"><?=GetMessage("S_READY_CLIP");?></div>
            <div style="padding-top: 20px" class="countdown_dashboard_finished">
              <div class="dash hours_dash">
                <span class="dash_title">:</span>
                <div class="digit">?</div>
                <div class="digit">?</div>
              </div>
              <div class="dash minutes_dash">
                <span class="dash_title">:</span>
                <div class="digit">?</div>
                <div class="digit">?</div>
              </div>
              <div class="dash seconds_dash">
                <span class="dash_title"></span>
                <div class="digit">?</div>
                <div class="digit">?</div>
              </div>
            </div>
          </div>
	<? elseif($start_time>0 || empty($arItem['PROPERTIES']['FILE_LINK']['VALUE'])):?>
		<? if($start_time):?>
		<div class="slide-time">
			<div class="countdown-title"><?=GetMessage("S_READY_CLIP");?></div>
			<div class="countdown_dashboard" id="countdown_dashboard_<?=$arItem['ID'];?>">
				<div class="dash hours_dash">
					<span class="dash_title">:</span>
					<div class="digit">0</div>
					<div class="digit">0</div>
				</div>
				<div class="dash minutes_dash">
					<span class="dash_title">:</span>
					<div class="digit">0</div>
					<div class="digit">0</div>
				</div>
				<div class="dash seconds_dash">
					<span class="dash_title"></span>
					<div class="digit">0</div>
					<div class="digit">0</div>
				</div>	
				<p><a href="#" class="button-change button-more-speed">Ускорить создание видео</a></p>
			</div>
			<script>
				<?
					$hour = floor($start_time/3600);
					$min = floor(($start_time - $hour*3600)/60);
					$sec = $start_time - $hour*3600 - $min*60;
				?>
				$('#countdown_dashboard_<?=$arItem['ID'];?>').countDown({
   				 targetOffset: {
					'day':    0,
					'month':  0,
					'year':   0,
					'hour':   <?=$hour;?>,
					'min':    <?=$min;?>,
					'sec':    <?=$sec;?>
   				 }
  				});
			</script>
		</div>
		<? else: ?>
			<div style="text-align: center;" class="slide-time"><?=GetMessage("S_LESS_HOUR");?></div>
		<? endif; ?>
	<? else: ?>
		<div class="slide-time">
            <div class="countdown_dashboard_finished">
              <div class="dash hours_dash">
                <span class="dash_title">:</span>
                <div class="digit">Г</div>
                <div class="digit">О</div>
              </div>
              <div class="dash minutes_dash">
                <span class="dash_title">:</span>
                <div class="digit">Т</div>
                <div class="digit">О</div>
              </div>
              <div class="dash seconds_dash">
                <span class="dash_title"></span>
                <div class="digit">В</div>
                <div class="digit">О</div>
              </div>
              <span class="end-timer"><?=date("d.m.Y",strtotime($arItem['TIMESTAMP_X']));?></span>
            </div>
          </div>
	<? endif; ?>
	<div class="slide-video">
		<? if($start_time>0 || empty($arItem['PROPERTIES']['FILE_LINK']['VALUE'])):?>
			<a class="slide-video-img empty">
				<span>ЗДЕСЬ БУДЕТ ВАШЕ ВИДЕО</span>
			</a>
		<? else: ?>
			<? if($_REQUEST['PRODUCT_ID']): ?>
				<a class="slide-video-img no_res" href="/show_preview/?clip=<?=rand(100, 999).$arItem['ID']; ?>">
					<span class="slide-video-button"><?=GetMessage("S_LOOK_READY");?></span>
				</a>
			<? else: ?>
				<a class="slide-video-img no_res" target="_blank" href="
			<? if($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_FREE_PERIOD_ENUM_ID'] != "6"): ?>
				<?echo(str_replace("clip/?num", "clip/buy/?num", $arItem['DETAIL_PAGE_URL']));?>
			<? else: ?>
				<?=$arItem['DETAIL_PAGE_URL'];?>
			<? endif; ?>
					">
						<span class="slide-video-button"><?=GetMessage("S_LOOK_READY");?></span>
					</a>
			<?endif; ?>
		<? endif; ?>
	</div>
	
	
	
</div>
<script>
	var isset_email = false;
</script>
<? if($wait_zakaz):?>
	<p class="black_fr" style="font-size: 12px; color:#303030; text-align:center; text-transform:uppercase; font-family: Arial;">
		<?=GetMessage("S_WAIT_ZAKAZ");?>
	</p>
	
	<div class="attention">
		<?=GetMessage("S_ATTENTION");?>
	</div>
	
	<p style="text-align: center;">
		<a _ID="<?=$arItem['ID'];?>"  onclick="yaCounter25315490.reachGoal('repost1');" class="button-slide a_order_clip_btn_vk copy_clip" style="height: 30px; line-height: 30px; margin-right: 10px; min-width: 150px; display: inline-block; font-size: 10px;" href="#">СДЕЛАТЬ РЕПОСТ</a>
	</p>
	
<? elseif(($start_time>0 || empty($arItem['PROPERTIES']['FILE_LINK']['VALUE'])) && $_REQUEST['PRODUCT_ID']):?>
<div class="add_email_block">
	<div id="answer" style="color: red"></div>
	Поменяйте e-mail, если ошиблись. ссылку на клип мы отправим сюда:<br /><br />
	<div class="clips_email mail">
		<input type="text" placeholder="<?=$arItem['PROPERTIES']['USER_EMAIL']['VALUE'];?>" _id="<?=$arItem['ID'];?>" class="email_feed">
		<input type="submit" value="отправить" class="button-slide add_email">
	</div>
	<div style="clear: both;"></div>
</div>
<script>
	isset_email = true;
	$('.add_email').click(function(e){
		e.preventDefault();
		$('#answer').html('');
		var _email = $('.email_feed').val();
		$.post("<?=SITE_DIR?>ajax/create_person_by_email.php", { email: $('.email_feed').val(), arItemId: $('.email_feed').attr('_id') }, function(data){
			if(data != '1'){
				$('#answer').html(data);
			}else{
				$('#answer').html('Вы изменили Вашу почту на '+_email);
				$('.add_email_block .email_feed').val('');
				$('.add_email_block .email_feed').attr('placeholder', _email);
				isset_email = false;
			}	
		});
	});
</script>
<? endif; ?>
<? if(!$_REQUEST['PRODUCT_ID']): ?>
	<hr align="center" size="1" color="#efefef" />
<? endif; ?>
<? endforeach; ?>
</div>
<? else: ?>
<div id="main_h" style="height: auto; border: none;"> 			  			 
    <p><font size="2" color="#111111">
		На данный момент у Вас нет активных клипов.
	</font></p>
</div>
<div id="main_button_wrapper"> 		 
	<div id="button_norm">
		<a class="button-slide" href="/clips/">создать клип бесплатно</a>
	</div>
</div>
<? endif; ?>
<!--<a href="/clips/" class="button-tab">СОЗДАЙТЕ НОВОЕ СЛАЙД ШОУ</a>-->



<div class="popup" style="display: none;">
	<div class="popup-container with_border" style="margin: -160px auto 0; top: 50%;">
		<div class="content-title bold-title">
			Поздравляем с режиссерским дебютом и отличным клипом!
		</div>
		<span class="ready-klip normal big-kl" style="text-decoration: uppercase; margin: 15px 0 20px;" >
			Мы очень старались, когда создавали ваше видео.<br />
			Пожалуйста расскажите о нас друзьям.
		</span>
		<a onclick="yaCounter25315490.reachGoal('repost3');" class="button-slide under-content-title a_order_clip_btn_vk" style="padding: 0px 10px;" href="#">РАССКАЗАТЬ ДРУЗЬЯМ</a>
		<span class="ready-klip normal" style="text-decoration: uppercase;">
			Им будет полезно, а нам приятно :)
		</span>
	</div>
</div>
<script>
	$('.to_url').click(function(e){
		e.preventDefault();
		_this = $(this);
		<? if(is_mobile()): ?>
			window.location = $.trim(_this.attr('to_url'));
		<? else: ?>
			$('.popup').show();
			setTimeout(function(){window.location = $.trim(_this.attr('to_url'));}, 11*1000);
		<? endif; ?>
	});
	$('.a_order_clip_btn_vk').click(function(e){
		e.preventDefault();
		<? if($USER->IsAuthorized() && preg_match("/OKuser/i", $USER->GetLogin())):?>
			window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=urlencode('http://fromfoto.com/3repost/'.rand(9999999, 99999999).'/');?>','sharer','toolbar=0,status=0,width=548,height=325');
		<? else: ?>
			window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url1; ?>&title=<?php echo $title1; ?>&description=<?php echo $summary1; ?>&image=<?php echo $image1; ?>','sharer','toolbar=0,status=0,width=548,height=325');
		<? endif; ?>
		$('#colorbox').hide();
	});
	$('.a_order_clip_btn_vk_1').click(function(e){
		e.preventDefault();
		<? if($USER->IsAuthorized() && preg_match("/OKuser/i", $USER->GetLogin())):?>
			window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=urlencode('http://fromfoto.com/1repost/'.rand(9999999, 99999999).'/');?>','sharer','toolbar=0,status=0,width=548,height=325');
		<? else: ?>
			window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');
		<? endif; ?>
		$('#colorbox').hide();
	});
	$('a.copy_clip').click(function(e){
		e.preventDefault();
		
		$.post("<?=SITE_DIR?>ajax/copy_clip.php", { ID: $(this).attr('_ID') }, function(data){
			setTimeout(function(){window.location = window.location.href;}, 10*1000);	
		});
		clearInterval(timer_reload);
	});
	$('.popup .cross').click(function(e){
		e.preventDefault();
		$('.popup').hide();
	});
	var timer_reload = setInterval(function() {isset_email = false; window.location = window.location.href; }, 300*1000);
	
	
	
	/*window.onbeforeunload = function (e) { 
		// Ловим событие для Interner Explorer 
		if(isset_email){
			  var e = e || window.event; 
			  var myMessage= "Мы не сможем отправить ваш клип, если не укажите почту"; 
			  // Для Internet Explorer и Firefox 
			  if (e) { 
				e.returnValue = myMessage; 
			  } 
			  // Для Safari и Chrome 
			  return myMessage; 
		}
	};*/ 
	
</script>
<style>
	.attention{
		padding: 10px;
		border: 2px solid #b72c2c;
		color: #b72c2c;
		text-align: center;
		font-family: Arial;
		font-size: 12px;
	}
	.slide-table .button-change.button-more-speed {
		color: #fff;
	  background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4gPHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGRlZnM+PGxpbmVhckdyYWRpZW50IGlkPSJncmFkIiBncmFkaWVudFVuaXRzPSJvYmplY3RCb3VuZGluZ0JveCIgeDE9IjAuNSIgeTE9IjAuMCIgeDI9IjAuNSIgeTI9IjEuMCI+PHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzc1ODhhNSIvPjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iIzVlNzQ5NSIvPjwvbGluZWFyR3JhZGllbnQ+PC9kZWZzPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9InVybCgjZ3JhZCkiIC8+PC9zdmc+IA==');
	  background-size: 100%;
	  background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #7588a5), color-stop(100%, #5e7495));
	  background-image: -moz-linear-gradient(top, #7588a5, #5e7495);
	  background-image: -webkit-linear-gradient(top, #7588a5, #5e7495);
	  background-image: linear-gradient(to bottom, #7588a5, #5e7495);
	  height: 40px;
	  line-height: 40px;
	  text-align: center;
	  -moz-border-radius: 3px;
	  -webkit-border-radius: 3px;
	  border-radius: 3px;
	  text-transform: uppercase;
	  position: relative;
		min-width: 167px;
		left: 23px;
		margin-left: -46px;
		height: 28px;
		line-height: 28px;
	}
	.slide-table .button-change.button-more-speed:hover {
	  background: #7f93b1;
	}
	.slide-table .button-change.button-more-speed:active {
	  background: #5d718f;
	}
</style>