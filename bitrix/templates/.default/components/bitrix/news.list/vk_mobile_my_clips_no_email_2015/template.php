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
global $USER;
$url1=urlencode('http://fromfoto.com/?uid='.$USER->getID());
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
$url=urlencode('http://fromfoto.com/?uid='.$USER->getID());
$summary=urlencode(prepare_row($ar_data['PREVIEW_TEXT'])); 
$image=urlencode('http://fromfoto.com'.CFile::GetPath($ar_data['PREVIEW_PICTURE']));

function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}

?> 
<?
global $USER;
?> 
<? $this->SetViewTarget("online_state"); ?>
<div class="page-title">
	<span><?=$USER->GetFirstName();?></span>
	<a href="/?logout=yes" class="button-online"><?=GetMessage("S_ONLINE");?></a>
</div>
<? $this->EndViewTarget(); ?>
<? $this->SetViewTarget("add_content_class"); ?>page-slide-table<? $this->EndViewTarget(); ?>
<div class="slide-table-title" style="border-bottom: none;">
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
<div class="slide-table-item">
	<div class="slide-name">
		<?=$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['NAME']; ?>
	</div>
	<? 
	$renderImage = CFile::ResizeImageGet($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
	
	$order = 1;			
	$create_time = 180;
	$plus_24 = 0;
	if(empty($arItem['PROPERTIES']['TELL_FRIENDS']['VALUE']) && empty($arItem['PROPERTIES']['PAID']['VALUE']) )
	{
		$plus_24 = 1;
		$create_time = ($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_TIME_CREATE_VALUE'])?$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_TIME_CREATE_VALUE']:60;
	}
	if($plus_24){
		$time_nt = $create_time*60 + $plus_24;
		$start_time = (strtotime($arItem['DATE_CREATE'])+$time_nt)-time();
	}else{
		if($arItem['PROPERTIES']['TELL_FRIENDS']['VALUE']){
			$create_time = 60;
		}
		if($arItem['PROPERTIES']['PAID']['VALUE']){
			$create_time = 5;
		}
		$plus_24=3600; /* Время в инфоблоках на час больше серверного. Хотфикс!!!Костыль!!!! */
		$start_time = (strtotime($arItem['DATE_CREATE'])+$order*$create_time*60 + $plus_24)-time();
	}
	$start_time = ($start_time>0)?$start_time:false;
	if($start_time && $start_time>24*3600){
		$start_time = 24*3600 - 1;
	}

	$wait_zakaz = file_exists("/home/admin/wait_zakaz/".$arItem['ID']."_33/");
	?>
	<? if($wait_zakaz):?>
		<div class="slide-time">
			<div <? if(!is_mobile()): ?>style="min-width: 430px; margin-top: -18px; margin-left: -54px;"<? endif; ?> class="countdown-title"><?=GetMessage("S_READY_CLIP");?></div>
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
			<div <? if(!is_mobile()): ?>style="min-width: 430px; margin-top: -18px; margin-left: -54px;"<? endif; ?> class="countdown-title"><?=GetMessage("S_READY_CLIP");?></div>
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
				<? if(empty($arItem['PROPERTIES']['TELL_FRIENDS']['VALUE'])):?>
					<a _ID="<?=$arItem['ID'];?>"  onclick="yaCounter25315490.reachGoal('repost1');openpopup1($(this))" class="button-slide button-tab" style="height: 30px; line-height: 30px; margin-right: 10px; min-width: 150px; display: inline-block; font-size: 10px;" href="#" data-href="<?echo(str_replace("clip/?num", "clip/fast/?num", $arItem['DETAIL_PAGE_URL']));?>">Ускорить создание видео</a>
				<? endif; ?>
			</div>
			<script>
				function openpopup1($el){
					$('#paybtn').attr('href',$el.data('href'))
					$('#sharebtn_1').attr('_ID',$el.attr("_ID"))
					$('#sharebtn_2').attr('_ID',$el.attr("_ID"))
					$('#pop1').show()
				}
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
			<a class="slide-video-img no_res" href="<? if($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_FREE_PERIOD_ENUM_ID'] != "6"): ?>
			<?echo(str_replace("clip/?num", "clip/buy/?num", $arItem['DETAIL_PAGE_URL']));?>
		<? else: ?>
			<?=$arItem['DETAIL_PAGE_URL'];?>
		<? endif; ?>" target="_blank">
					<span class="slide-video-button"><?=GetMessage("S_LOOK_READY");?></span>
				</a>
		<? endif; ?>
	</div>
	
	
	
</div>

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
	
<? elseif($start_time>0 || empty($arItem['PROPERTIES']['FILE_LINK']['VALUE'])):?>
<!--div class="add_email_block">
	<div class="attention">
		<?=GetMessage("S_ATTENTION");?>
	</div>

	<p style="text-align: center;">
		<a _ID="<?=$arItem['ID'];?>"  onclick="yaCounter25315490.reachGoal('repost1');" class="button-slide a_order_clip_btn_vk_1" style="height: 30px; line-height: 30px; margin-right: 10px; min-width: 150px; display: inline-block; font-size: 10px;" href="#">СДЕЛАТЬ РЕПОСТ</a>
	</p>
</div-->
<? endif; ?>
<hr align="center" size="1" color="#efefef" />
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



<!--div class="popup" style="display: none;">
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
</div-->
<div class="popup" id="pop1" style="display: none;">

	<div class="popup-container with_border" style="margin: -160px auto 0; top: 50%;">
		<a href="javascript:void(0)" id="vs_close_btn" onclick="$('#pop1').hide()">&nbsp;</a>
		<div class="content-title bold-title lh-0">
			<br>сделайте репост и получите свое видео через 1 час<br>
			<a  onclick="yaCounter25315490.reachGoal('repost3');$('#pop2').show()" class=" button-slide button-tab" style="padding: 0px 10px;" href="#"><span class="slide-video-button new-style">сделать репост</span></a>
		</div>
		<div class="content-title bold-title lh-0">
			если вас нет в соц. сетях или не хотите делать репост
			оплатите 100р. и получите свое видео через 1 час <br>
			<a id="paybtn" class="button-slide button-tab" style="padding: 0px 10px;" href="javascript:void(0)"><span class="slide-video-button new-style">оплатить</span></a>
		</div>
	</div>
</div>
<div class="popup" id="pop2" style="display: none;">

	<div class="popup-container with_border" style="margin: -160px auto 0; top: 50%;">
		<a href="javascript:void(0)" id="vs_close_btn" onclick="$('#pop2').hide()">&nbsp;</a>
		<div class="content-title bold-title lh-0">
			выберите свою социальную сеть
		</div>
		<div class="content-title bold-title lh-0" style="display: table;width: 77%; margin-left: 12% !important">
			<div style="display: table-cell; text-align: center"><a id="sharebtn_1" href="javascript:void(0)" class="box-button vk a_order_clip_btn_vk_1">&nbsp;</a></div>
			<div style="display: table-cell;text-align: center"><a id="sharebtn_2" href="javascript:void(0)" class="box-button ok a_order_clip_btn_ok_1">&nbsp;</a></div>
		</div>
	</div>
</div>
<script>
	var ShareVKCount=-1;
	var ShareVKCountStart=-1
	var ShareOKCount=-1;
	var ShareOKCountStart=-1
	var jqxhr
	var VK = {
		Share: {
			count: function(value, count) {
				ShareVKCount=count
				if(ShareVKCountStart<0)ShareVKCountStart=ShareVKCount
			}
		}
	};

	function getVKShareCount($id){
		jqxhr=$.getJSON('http://vk.com/share.php?act=count&index=1&url=<?php echo $url; ?>&callback=?');
		jqxhr.complete(function() {
			if(ShareVKCount>ShareVKCountStart && $id>0){
				$.post("/ajax/goshare.php","share_id="+$id+"&shareKey=<?=helpertools::getShareKey($USER->getID())?>",function(data){
					if(data.MESSAGE=="ok"){
						window.location.reload()
					}else{
						alert(data.MESSAGE)
					}
				},'json')
			}
		});
	}
	function getOKShareCount($id){
	if($id>0) {
		$.post("/ajax/goshare.php", "share_id=" + $id + "&shareKey=<?=helpertools::getShareKey($USER->getID())?>", function (data) {
			if (data.MESSAGE == "ok") {
				window.location.reload()
			} else {
				alert(data.MESSAGE)
			}
		}, 'json')
	}
	}
	getVKShareCount()
	//getOKShareCount()
	$('.to_url').click(function(e){
		e.preventDefault();
		_this = $(this);
		<? if(is_mobile()): ?>
			window.location = $.trim(_this.attr('to_url'));
		<? else: ?>
			$('#pop1').show();
			//setTimeout(function(){window.location = $.trim(_this.attr('to_url'));}, 11*1000);
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
		var $win;
		var $share_id=$(this).attr("_id")
		<? if($USER->IsAuthorized() && preg_match("/OKuser/i", $USER->GetLogin())):?>
			window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=urlencode('http://fromfoto.com/1repost/'.rand(9999999, 99999999).'/');?>','sharer','toolbar=0,status=0,width=548,height=325');
		<? else: ?>
		getVKShareCount($share_id)
		$win=window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');
		var timer = setInterval(checkChild, 500);

		function checkChild() {
			if ($win.closed) {
				getVKShareCount($share_id)
				clearInterval(timer);
			}
		}
		<? endif; ?>
		$('#colorbox').hide();
	});
	$('.a_order_clip_btn_ok_1').click(function(e){
		e.preventDefault();
		var $win2;
		var $share_id=$(this).attr("_id")
		getOKShareCount($share_id)
		$win2=window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?php echo $url; ?>','sharer','toolbar=0,status=0,width=548,height=325');
		var timer2 = setInterval(checkChildOk, 500);
		function checkChildOk() {
			if ($win2.closed) {
				getOKShareCount($share_id)
				clearInterval(timer2);
			}
		}

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
		$('#pop1').hide();
	});
	var timer_reload = setInterval(function() { window.location = window.location.href; }, 300*1000);
</script>
<style>
	.attention{
		padding: 10px;
		border: 2px solid #b72c2c;
		color: #b72c2c;
		text-align: center;
		font-family: Arial;
		font-size: 12px;
		max-width: 430px;
		margin: auto;
		background: #fff;
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