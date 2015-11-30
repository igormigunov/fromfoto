<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
 <!-- Our CSS stylesheet file -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/countdown/jquery.countdown.css" />
        
        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
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
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_TIME_CREATE","PREVIEW_PICTURE"));
$type_clips = array();
while($ar_fields = $res->GetNext())
{
	$type_clips[$ar_fields["ID"]] = $ar_fields;
}

$newWidth = 200;
$newHeight = 133;

?>

<? if(!$_REQUEST['show']): ?>
<table class="simple_table" cellspacing='0'>
	<tr>
		<td><?=GetMessage("S_TYPE");?></td>
        <td class="bordr"><img src="/images/pl.png" /></td>
		<td><?=GetMessage("S_READINESS");?></td>
        <td class="bordr"><img src="/images/pl.png" /></td>
		<td><?=GetMessage("S_LOOK");?></td>
	</tr>
	<? foreach($arResult["ITEMS"] as $arItem):?>
    <? 
			$renderImage = CFile::ResizeImageGet($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
			
			$order = 0;
			$filename = "/home/admin/zakaz/".$arItem['ID']."_33/order.txt";
			if(file_exists($filename)){
				$handle = fopen($filename, "r");
				$order = (int)fread($handle, filesize($filename));
				fclose($handle);
			}
			$order = ($order)? $order+1 : 3;
			$create_time = ($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_TIME_CREATE_VALUE'])?$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_TIME_CREATE_VALUE']:60;
			
			$plus_24 = 0;
			$filename = "/home/admin/zakaz/".$arItem['ID']."_33/wait_24.txt";
			if(file_exists($filename)){
				$handle = fopen($filename, "r");
				$plus = (int)fread($handle, filesize($filename));
				fclose($handle);
				if(!$plus){
					$plus_24 = 24*3600;
				}
			}
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
	<tr>
    	<td>
        	"<?=$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['NAME']; ?>"
        	
        </td>
        <td class="bordr"><img src="/images/pl.png" /></td>
        <td style="text-align:center;">
            <? if(!$arItem['PROPERTIES']['VIDEO']['VALUE']):?><? if($start_time):?><?=GetMessage("S_READY_CLIP");?> 
			
			<div class="timer" start_time="<?=$start_time; ?>">
				<div class="countdown"></div>

				<p style="text-align:center; font-size:16px;" class="note"></p>
				</div>
				
				<? else: ?> <?=GetMessage("S_LESS_HOUR");?><? endif; ?><? else: ?><?=GetMessage("S_READY");?><? endif; ?>

			
        </td>
        <td class="bordr"><img src="/images/pl.png" /></td>
        <td style="width:230px">
        	<? if(!$arItem['PROPERTIES']['VIDEO']['VALUE']):?>
				<img src="<?=$renderImage['src'];?>" style="border:none;" />
			<? else: ?>
				<a target="_blank" href="<?=$arItem['DETAIL_PAGE_URL'];?>">
					<img src="/images/play_ready.png" style="border:none; position: absolute; margin-left: 70px; margin-top: 35px;" />
					<img src="<?=$renderImage['src'];?>" style="border:none;" />
				</a>
			<? endif; ?>
        </td>
    </tr>
    <? endforeach; ?>
</table>
<style>
	.simple_table{
		border:2px solid #000001;
		margin: 30px auto;
	}
	.simple_table td{
		border-bottom:2px solid #000001;
		color:#000001;
		font-size:24px;
		padding: 5px 15px;
	}
	.simple_table td.bordr{
		padding: 5px 0px;
	}
	.simple_table td a{
		color:#000001;
		font-size:24px;
		text-decoration:none;
	}
	.simple_table td a:hover{
		text-decoration:none;
	}
	
	a#tell_friends{
		background:url(/images/bgr_ord_btn.png) repeat;
		border: 2px solid #000001;
		box-shadow: none;
		color: #030303 !important;
		display: block;
		font-size: 19px;
		height: 50px;
		padding: 6px 20px 0;
		text-align: center;
		text-decoration: none;
		text-transform: none;
		width: 207px;
		margin:auto;
		font-weight:700;
		line-height: 1;
	}
	
	a#tell_friends:hover{
		background: #fefefe; 
	}
</style>

<p style="text-align:center; font-size:25px; color:#000;"><?=GetMessage("S_LESS_24");?></p>
<?
function prepare_row($str){
	return preg_replace("/\n|\r\n|'/","",strip_tags($str));
}
$title=urlencode(prepare_row(GetMessage("S_TITLE")));
$url=urlencode('http://fromfoto.com/');
$summary=urlencode(prepare_row(GetMessage("S_DESCRIPTION")));
$image=urlencode('http://fromfoto.com/images/logo.png');


?>

<a id="tell_friends" onClick="window.open('https://vk.com/share.php?redir=1&url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" style='padding-top:2px'><?=GetMessage("S_SHARE");?></a>

<script>

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
</script>


<? else: ?>
<table class="simple-little-table" cellspacing='0'>
	<tr>
		<th><?=GetMessage("S_NUMBER");?></th>
		<th><?=GetMessage("S_TYPE");?></th>
		<th><?=GetMessage("S_READINESS");?></th>
		<th><?=GetMessage("S_LOOK");?></th>
		<th><?=GetMessage("S_DOWNLOAD");?></th>
	</tr>
	<? $num = 0; ?>
    <? foreach($arResult["ITEMS"] as $arItem):?>
		<? $num++; ?>
		<? 
			$order = 0;
			$filename = "/home/admin/zakaz/".$arItem['ID']."_33/order.txt";
			if(file_exists($filename)){
				$handle = fopen($filename, "r");
				$order = (int)fread($handle, filesize($filename));
				fclose($handle);
			}
			$order = ($order)? $order+1 : 5;
			$create_time = ($type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_TIME_CREATE_VALUE'])?$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['PROPERTY_TIME_CREATE_VALUE']:60;
			
			$start_time = (strtotime($arItem['DATE_CREATE'])+$order*$create_time*60)-time();
			$start_time = ($start_time>0)?$start_time:false;
		?>
		<tr>
			<td><?=$num;?></td>
			<td>"<?=$type_clips[$arItem['PROPERTIES']['TYPE_CLIP']['VALUE']]['NAME']; ?>"</td>
			<td><?if(!$arItem['PROPERTIES']['VIDEO']['VALUE']):?><?=GetMessage("S_LEFT");?>:<br /><? if($start_time):?><span style="font-weight:bold;" class="timer" start_time="<?=$start_time; ?>"></span><? else: ?><span style="font-weight:bold;"><?=GetMessage("S_LESS_HOUR");?></span><? endif; ?><? else: ?><span style="color:green"><?=GetMessage("S_READY");?></span><? endif; ?></td>
			<td><?if(!$arItem['PROPERTIES']['VIDEO']['VALUE']):?>-<? else: ?><a target="_blank" href="<?=$arItem['DETAIL_PAGE_URL'];?>"><?=GetMessage("S_LOOK2");?></a><? endif; ?></td>
			<td><? if($arItem['PROPERTIES']['PAID']['VALUE']): ?><a download target="_blank" href="<?=$arItem['PROPERTIES']['FILE_LINK']['VALUE'];?>"><?=GetMessage("S_DOWNLOAD2");?></a><? else: ?>-<? endif; ?></td>
		</tr>
	<? endforeach; ?>

</table>



<? endif; ?>
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
</style>
<script>
$(function(){
	$('.timer').each(function(){
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
	});
});
</script>