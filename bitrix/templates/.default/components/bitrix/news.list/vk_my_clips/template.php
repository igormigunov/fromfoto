<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$title1=urlencode("У меня получилось:)");
$url1=urlencode('http://fromfoto.com');
$urlok1=urlencode('http://fromfoto.com');
//$urlok=urlencode("www.tut.by");
$titleok1=urlencode('Пробую:)');
$summary1=urlencode(prepare_row("Бесплатные клипы и слайд-шоу из фото. В подарок, на память, детские, романтичные, свадебные и другие ... на fromfoto")); 
$image1=urlencode('http://fromfoto.com/images/logo42.jpg');
?> 

 <!-- Our CSS stylesheet file -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/countdown/jquery.countdown.css" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}
?>        
<div class="chel_login">
	<div class="lg">
		<? global $USER; ?>
		<?=$USER->GetLogin();?>
	</div>
	<div class="rg">
		<a href="/?logout=yes"><?=GetMessage("S_ONLINE");?></a>
	</div>
</div>
<? if($arResult["ITEMS"]): ?>
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

$newWidth = 270;
$newHeight = 180;

//PROPERTY_FREE_PERIOD_ENUM_ID

?>
<table class="simple_table" cellspacing='0' style="margin: 3px 0;">
	<tr class="first_coll">
		<th class="table_tr" style="padding-left: 0;"><?=GetMessage("S_TYPE");?></th>
		<th class="table_tr" style="padding: 18px 77px;"><?=GetMessage("S_READINESS");?></th>
		<th class="table_tr"><?=GetMessage("S_LOOK");?></th>
	</tr>
</table>

<div class="my_video">
    <? $n = 0; ?>
	<? foreach($arResult["ITEMS"] as $arItem):?>
    <? 
		$n++; 
		$f_class = ($n == 1)? 'first_td':'first_td';	
	?>
    <? 
			$renderImage = CFile::ResizeImageGet($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
			
			$order = 1;
			/*$filename = "/home/admin/zakaz/".$arItem['ID']."_33/order.txt";
			if(file_exists($filename)){
				$handle = fopen($filename, "r");
				$order = (int)fread($handle, filesize($filename));
				fclose($handle);
			}
			$order = ($order)? $order+1 : 3;*/
			
			$create_time = 180;
			
			$plus_24 = 0;
			if(empty($arItem['PROPERTIES']['TELL_FRIENDS']['VALUE']))
			{
				$plus_24 = 1;
				$create_time = ($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_TIME_CREATE_VALUE'])?$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_TIME_CREATE_VALUE']:60;
			}
			
			/*$filename = "/home/admin/zakaz/".$arItem['ID']."_33/wait_24.txt";
			if(file_exists($filename)){
				$handle = fopen($filename, "r");
				$plus = (int)fread($handle, filesize($filename));
				fclose($handle);
				if(!$plus){
					$plus_24 = 24*3600;
				}
			}*/
			if($plus_24){
				$time_nt = $create_time*60 + $plus_24;
				$start_time = (strtotime($arItem['DATE_CREATE'])+$time_nt)-time();
			}else{
				$start_time = (strtotime($arItem['DATE_CREATE'])+$order*$create_time*60 + $plus_24)-time();
			}
			$start_time = ($start_time>0)?$start_time:false;
			if($start_time && $start_time>24*3600){
				$start_time = 24*3600 - 1;
			}
		?>
<?
$title=urlencode(prepare_row(GetMessage("S_TITLE")));
$url=urlencode('http://fromfoto.com/');
$urlok=urlencode('http://www.youtube.com/watch?v=p9JHc6o7c9A');
$summary=urlencode(prepare_row(GetMessage("S_DESCRIPTION"))); 
$image=urlencode('http://fromfoto.com/images/logo2.png');

?>
	<div class="row">
		<div class="col-xs-3 <?=$f_class?> header_bold">
			<?=$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['NAME']; ?>
            <?// if($arItem['PROPERTIES']['VIDEO']['VALUE'] || $arItem['PROPERTIES']['FILE_LINK']['VALUE']):?>
            <? if($start_time):?>
			<? /*<br />
            <a href="/create_video/?video_id=<?=$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['ID']; ?>" class="add_changes"><?=GetMessage("S_ADD_CHANGES");?></a>  
			<a class="add_changes" id="tell_friends" onClick="window.open('https://<?=change_share_mobile(); ?>/share.php?redir=1&url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" style='padding-top:2px'><?=GetMessage("S_SHARE");?></a>*/?>
            <? endif; ?>
		</div>
		<div class="col-xs-5 <?=$f_class?>" style="text-align: center; padding-top: <? if($start_time):?>4px<? else: ?>35px;<? endif; ?>">
			<?// if(!($arItem['PROPERTIES']['VIDEO']['VALUE'] || $arItem['PROPERTIES']['FILE_LINK']['VALUE'])):?>
            <? if($start_time>0 || empty($arItem['PROPERTIES']['FILE_LINK']['VALUE'])):?>
				<? if($start_time):?><?=GetMessage("S_READY_CLIP");?> 
				
				<div class="timer" start_time="<?=$start_time; ?>">
					<div class="countdown"></div>
					<p style="text-align:center; font-size:16px; display:none;" class="note"></p>
					<? if(empty($arItem['PROPERTIES']['TELL_FRIENDS']['VALUE'])):?>
		                <div>
							<a class="btn_go create_new" href="<?echo(str_replace("clip/?num", "clip/fast/?num", $arItem['DETAIL_PAGE_URL']));?>" style="padding: 5px; width: 210px; height: auto; font-size: 10px;">ускорить создание клипа</a>
						</div>
					<? endif; ?>
				</div>
					
				<? else: ?>
				 <?=GetMessage("S_LESS_HOUR");?>
				<? endif; ?>
			<? else: ?>
			<div class="timer">
				<div class="countdown countdownHolder">
					<span class="countDays">
						<span class="position">
							<span class="digit static" style="top: 0px; opacity: 1;"></span>				
						</span>
							<span class="position">
								<span class="digit static" style="top: 0px; opacity: 1;"></span>
							</span>
					</span>
					<span class="countDiv countDiv0"></span>
					<span class="countHours">
						<span class="position">
							<span class="digit static" style="top: 0px; opacity: 1;">Г</span>
						</span>
							<span class="position">
								<span class="digit static" style="top: 0px; opacity: 1;">О</span>
							</span>
					</span>
					<span class="countDiv countDiv1"></span>
						<span class="countMinutes">
							<span class="position">
								<span class="digit static" style="top: 0px; opacity: 1;">Т</span>
							</span>
								<span class="position">
									<span class="digit static" style="top: 0px; opacity: 1;">О</span>
								</span>
						</span>
							<span class="countDiv countDiv2"></span>
								<span class="countSeconds">
									<span class="position">
										<span class="digit static" style="top: 0px; opacity: 1;">В</span>
									</span>
										<span class="position">
											<span class="digit static" style="top: 0px; opacity: 1;">О</span>
										</span>
								</span>
				</div>

				<p style="padding-right:18px;" class="note date_video"><?=date("d.m.Y",strtotime($arItem['TIMESTAMP_X']));?></p>
				</div>
                    
				<? endif; ?>

		</div>
		<div class="col-xs-4 img-ready <?=$f_class?>">
			<? //if(!($arItem['PROPERTIES']['VIDEO']['VALUE'] || $arItem['PROPERTIES']['FILE_LINK']['VALUE'])):?>
            <? if($start_time>0 || empty($arItem['PROPERTIES']['FILE_LINK']['VALUE'])):?>
				<img src="/images/clip_here.png" style="border:none; width:219px;" />
			<? else: ?>
				<a href="#text_before_submit_free" style="width: 218px; font-size: 12px; height: 30px; padding-top: 7px; margin-top: 47px;" class="btn_go create_new to_url" href="#"  target="_blank" to_url="
				<? if($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_FREE_PERIOD_ENUM_ID'] != "6"): ?>
					<?echo(str_replace("clip/?num", "clip/buy/?num", $arItem['DETAIL_PAGE_URL']));?>
				<? else: ?>
					<?=$arItem['DETAIL_PAGE_URL'];?>
				<? endif; ?>
				">
					<?=GetMessage("S_LOOK_READY");?>
				</a>
			<? endif; ?>
		</div>
	</div>
    <? endforeach; ?>
	</div>

<br /><br />
<a class="btn_go create_new" href="/clips/"><?=GetMessage("S_CREATE_NEW");?></a>
<br />
<p style="text-align: center;font-size: 13px;color: #000;margin: 30px 35px 10px 35px;"><?=GetMessage("S_CHECK_SPAM");?></p>

<div class="hide_after_order" style="display:none">
	<div id="text_before_submit_free">
	<br />
	<p class="hh1" style="padding:9px 20px 0px;"><?=GetMessage("S_TITLE_1")?></p>
	<br />
    	<p><?=GetMessage("S_TITLE_2")?></p>
		<div class="soc_s" style="padding-bottom: 20px; padding-top: 25px;">
			<a href="#" onclick="yaCounter25315490.reachGoal('repost3');" class="a_order_clip_btn_vk btn_go" style="font-size: 12px; height: 38px; padding: 11px; width: 270px;">РАССКАЗАТЬ ДРУЗЬЯМ</a>
		</div>
		<br/>
    	<p style="width: 90%; margin: auto; font-size: 13px;"><?=GetMessage("S_TITLE_3")?></p>
    </div>
    <script>
		$('#cboxClose').trigger('click');
	</script>
</div>

<script>
	$('.to_url').click(function(e){
		e.preventDefault();
		_this = $(this);
		setTimeout(function(){window.location = $.trim(_this.attr('to_url'));}, 20*1000);
	});
	$(".to_url").colorbox({
		inline:true, 
		width:"770px", 
		height:"350px",
		overlayClose:false
	});
	var timer_reload = setInterval(function() { window.location = window.location.href; }, 3600*1000);
	
	$('#tell_friends').click(function(){
		var clips = {};
		<? foreach($arResult["ITEMS"] as $arItem):?>
			clips['<?=$arItem['ID']; ?>'] = "<?=$arItem['ID']; ?>_33";
		<? endforeach; ?>
		$.post('/ajax/change_time.php',{clips:clips},function(){
			window.location = window.location.href;
		});
	});
	$('.a_order_clip_btn_vk').click(function(e){
		e.preventDefault();
		window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url1; ?>&title=<?php echo $title1; ?>&description=<?php echo $summary1; ?>&image=<?php echo $image1; ?>','sharer','toolbar=0,status=0,width=548,height=325');
		//window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url; ?>','sharer','toolbar=0,status=0,width=548,height=325');
		$('#colorbox').hide();
	});
</script>

<? else: ?>
<p style="text-align:center; padding-top:50px; font-size:25px; color:#000;"><?=GetMessage("S_NO_CLIPS");?></p>
<? endif; ?>

<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/countdown/jquery.countdown.js"></script>

<script>
	var timer_reload = setInterval(function() { window.location = window.location.href; }, 300*1000);
</script>
<style>
.countDays, .countDiv0{
	display:none;
}
#cboxClose{
	display: none;
}
#text_before_submit_free .soc_s{
    		text-align: center;
    	}
    	#text_before_submit_free .soc_s a{
    		display: inline-block;
    		padding: 15px;
    	}
		#text_before_submit_free p.hh1{
			text-transform:uppercase;
			color:#5d7395;
			font-weight: bold;
			text-align: center;
			font-size: 20px;
			padding: 40px 20px 0;
		}
		#text_before_submit_free p{
			text-transform:uppercase;
			text-align: center;
			font-size: 16px;
			color: #000;
		}

		/*.yes_know img,.no_know img{
			width: 35px;
   			margin-bottom: 6px;
    		margin-right: 4px
		}
		#text_before_submit_free{
			color:#4b65a6 !important;
			padding:10px; 
			background: rgb(209,219,231);
		}
		#cboxLoadedContent{
			}
		
		#text_before_submit_free a{
			color:#4b65a6 !important;
			text-decoration:none;
		}
		
		#text_before_submit_free h2,#text_before_submit_free h1,#text_before_submit_free h3{
			text-transform:uppercase;
			color:#4b65a6;
		}
		
		#text_before_submit_free ol{
			font-size:19px;
			margin-left:50px;
		}
		
		.yes_know{
			float:left;
		}
		.no_know{
			float:right;
		}
		.no_know, .yes_know{
			font-size: 20px;
    		font-weight: bold;
		}*/
		body{
			background:#fff !important;
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