<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if($arResult['ITEMS']):?>
<div id="preview_popup_full">
</div>
<div id="preview_popup">
<? if(!$_REQUEST['show']):?>
<? foreach($arResult['ITEMS'] as $arItem): ?>
<?
	$id_popup = '';
	switch($arItem['ID']){
		case '1545':
			$id_popup = 'preview_popup_first_select';
		break;
		case '1556':
			$id_popup = 'preview_popup_create_select';
		break;
		case '1558':
			$id_popup = 'preview_popup_final_user';
		break;
		case '1557':
			$id_popup = 'preview_popup_final_our';
		break;
	}
?>
<div id="<?=$id_popup;?>" class="preview_popup" <? if(!$_REQUEST['show']):?>style="background-image:url('<?=$arItem['PREVIEW_PICTURE']['SRC'];?>');"<? endif; ?> >
    	
		<div class="text_popup">
        	<?=$arItem['PREVIEW_TEXT']; ?>
        </div>
        <div class="btn_work">
        	<?
            	switch($arItem['ID']){
	        		case '1545':?>
		        		<a href="#" id="people_sel"><?=GetMessage("S_FOR_SELF")?></a>
						<a href="#" class="right_btn" id="biz_sel"><?=GetMessage("S_FOR_BUSINESS")?></a>
                        <?
	        		break;
		        	case '1556':
		        		?>
		        			<a href="#" id="task_free"><?=GetMessage("S_FREE")?></a>
							<a href="#" id="task_paid" class="right_btn"><?=GetMessage("S_WITHOUT_PAYMENT")?></a>
                        <?
		        	break;
		        	case '1558':
			        	?>
                        	<div class="centr_btn">
		        				<a href="#menu-choose"><?=GetMessage("S_SELECT_TEMPLATE")?></a>
                            </div>
                        <?
		        	break;
		        	case '1557':
		        		?>
                        	<div class="centr_btn">
		        				<a href="#menu-choose"><?=GetMessage("S_SELECT_TEMPLATE")?></a>
                            </div>
                        <?
		        	break;
	        	}
			?>
			
        </div>
		
			
		
</div>

<? endforeach; ?>
<? else: ?>
		<div id="preview_popup_first_select" class="preview_popup" >
			<div class='back_close_popup'><img src='<?=SITE_TEMPLATE_PATH?>/img/back_close_popup.png' border='0' /></div>
			<div class="prev_name">ВЫ ХОТИТЕ <span style="color:#aafcd3;">СОЗДАТЬ</span>:</div>
			<div class='gr_pp'>
				<table class="text_popup">
				<tr>
					<td class='left_side left_size_ilign'>
						<p>
							Видео подарок<br />
							Детское слайд шоу<br />
							Свадебное слайд шоу<br />
							Love story<br />
							Видео поздравление
						</p>
					</td>
					<td class='middle_line_side'>
					</td>
					<td class='right_side right_size_ilign'>
						<p>
							Видео презентацию<br />
							Фото/видео отчет<br />
							Анимацию логотипа<br />
							Трейлер, заставку<br />
							Рекламное видео
						</p>
					</td>
				</tr>
				<tr>
					<td colspan='3' style='height:20px'>
					</td>
				</tr>
				<tr>
					<td class='left_side btn_ord'>
						<a href="#" id="people_sel"><?=GetMessage("S_FOR_SELF")?></a>
					</td>
					<td>
					</td>
					<td class='right_side btn_ord'>
						<a href="#menu-choose" class="right_btn" id="biz_sel"><?=GetMessage("S_FOR_BUSINESS")?></a>
					</td>
				</tr>
				</table>
			</div>
		</div>
		<div id="preview_popup_final_user" class="preview_popup" >
			<div class='back_close_popup'><img src='<?=SITE_TEMPLATE_PATH?>/img/back_close_popup.png' border='0' /></div>
			<div class="prev_name" style='font-size:27px; padding-top:10px;'>Для создания <span style="color:#aafcd3;">слайд шоу</span>, нужно поместить<br />Ваши фотографии (видео,текст,музыку)<br />в один из видео шаблонов на нашем сайте</div>
			<div class='gr_pp'>
				<table class="text_popup">
				<tr>
					<td class='left_side left_size_ilign'>
						<p>
							Автоматизация<br /><br />
							Качество графики<br />
							PRO<br /><br />
							Длительность слайд шоу<br />
							3 мин.<br /><br />
							Стоимость<br />
							от <span style="color:#e0476a;">0р</span>.
						</p>
					</td>
					<td class='middle_line_side'>
					</td>
					<td class='right_side right_size_ilign'>
						<p>
							Ручная работа<br /><br />
							Качество графики<br />
							PRO<br /><br />
							Длительность слайд шоу<br />
							НЕОГРАНИЧЕНО<br /><br />
							Стоимость<br />
							от <span style="color:#e0476a;">900р</span>.
						</p>
					</td>
				</tr>
				<tr>
					<td colspan='3' style='height:20px'>
					</td>
				</tr>
				<tr>
					<td class='left_side btn_ord'>
						<a href="#menu-choose" id="people_free_btn">сделаю самостоятельно</a>
					</td>
					<td>
					</td>
					<td class='right_side btn_ord'>
						<a href="#menu-feedback" class="right_btn" id="for_me">сделайте за меня</a>
					</td>
				</tr>
				</table>
			</div>
		</div>
<? endif; ?>
</div>
<? endif; ?>

<? if($_REQUEST['show']):?>
<style>
	#preview_popup_final_user .text_popup{
		line-height:0.9;
	}
	#preview_popup_final_user .text_popup br{
		padding:0px;
		margin:0px;
		height:0px;
		line-height:0px;
	}
	.prev_name{
		text-transform:uppercase;
	}
	.back_close_popup{
		position: absolute;
		right: 15px;
		top: 15px;
		cursor:pointer;
	}
	#preview_popup, #preview_popup .text_popup{
		width:auto !important;
		height:auto !important;
	}
	.gr_pp{
		background:url('<?=SITE_TEMPLATE_PATH?>/img/pix_pupap.png') repeat;
		margin:20px 55px 31px 55px;
		-webkit-box-shadow: inset 2px 2px 7px 0px rgba(50, 50, 50, 0.41);
		-moz-box-shadow:    inset 2px 2px 7px 0px rgba(50, 50, 50, 0.41);
		box-shadow:         inset 2px 2px 7px 0px rgba(50, 50, 50, 0.41);
	}
	.gr_pp .text_popup{
		padding: 25px 40px 25px 40px;
		height: auto !important;
	}
	
	.btn_ord a{
		display:block;
		width:220px;
		height:43px;
		background: rgb(123,220,171); 
		background: -moz-linear-gradient(left,  rgba(123,220,171,1) 0%, rgba(176,243,209,1) 100%); 
		background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(123,220,171,1)), color-stop(100%,rgba(176,243,209,1))); 
		background: -webkit-linear-gradient(left,  rgba(123,220,171,1) 0%,rgba(176,243,209,1) 100%); 
		background: -o-linear-gradient(left,  rgba(123,220,171,1) 0%,rgba(176,243,209,1) 100%); 
		background: -ms-linear-gradient(left,  rgba(123,220,171,1) 0%,rgba(176,243,209,1) 100%); 
		background: linear-gradient(to right,  rgba(123,220,171,1) 0%,rgba(176,243,209,1) 100%); 
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7bdcab', endColorstr='#b0f3d1',GradientType=1 ); 
		color: #ffffff !important;
		text-decoration: none;
		text-align: center;
		text-transform: uppercase;
		border: 1px solid #fff;
		font-size: 22px;
		padding-top: 6px;
		-webkit-box-shadow: 2px 2px 5px 0px rgba(50, 50, 50, 0.5);
		-moz-box-shadow:    2px 2px 5px 0px rgba(50, 50, 50, 0.5);
		box-shadow:         2px 2px 5px 0px rgba(50, 50, 50, 0.5);
	}
	
	.btn_ord a:hover{
		background: #9bbce7; 
	}
	
	.gr_pp .text_popup td{
		text-align:left;
	}
	
	
	
	.gr_pp .text_popup td.btn_ord, #preview_popup_final_user .gr_pp .text_popup td{
		text-align:center;
	}
	
	.gr_pp .text_popup td p{
		padding:0px;
		margin:0px;
	}
	
	.gr_pp .text_popup td.left_side{
		padding-right:40px;
	}
	
	.gr_pp .text_popup td.middle_line_side{
		width: 40px;
		border-left: 2px solid #ffffff;
		height: 100%;
	}
	
	.prev_name{
		font-size: 38px;
		color: #ffffff;
		text-align: center;
		margin-top: 20px;
	}
	#preview_popup{
		background: #5996e0; 
		background: -moz-linear-gradient(-45deg,  #5996e0 0%, #90b3db 50%, #5996e0 100%); 
		background: -webkit-gradient(linear, left top, right bottom, color-stop(0%,#5996e0), color-stop(50%,#90b3db), color-stop(100%,#5996e0)); 
		background: -webkit-linear-gradient(-45deg,  #5996e0 0%,#90b3db 50%,#5996e0 100%); 
		background: -o-linear-gradient(-45deg,  #5996e0 0%,#90b3db 50%,#5996e0 100%); 
		background: -ms-linear-gradient(-45deg,  #5996e0 0%,#90b3db 50%,#5996e0 100%); 
		background: linear-gradient(135deg,  #5996e0 0%,#90b3db 50%,#5996e0 100%); 
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5996e0', endColorstr='#5996e0',GradientType=1 );
	}
</style>

<script>
	$('.back_close_popup').click(function(){
		if(step > 1){
			$('#preview_popup_full, #preview_popup').show();
			$('#preview_popup_first_select').show();
			$('#preview_popup_final_user').hide();
		}else{
			$('#preview_popup').hide();
			$('#preview_popup_full').hide();
		}
		step = 1;
	});
	$('#preview_popup_final_user #for_me').click(function(e){
		$('#preview_popup').hide();
		$('#preview_popup_full').hide();
	});
</script>
<? endif; ?>

<script>
var step = 1;
$(document).ready(function(e) {
    $('.show_steps').click(function(e) {
        e.preventDefault();
		$('#preview_popup_full, #preview_popup').show();
		video.pause();
		state = 1;
		console.log('1');
		<? if($_REQUEST['show']):?>
			alert($('#preview_popup').width()/2);
			$('#preview_popup').css('margin-left','-'+($('#preview_popup').width()/2));
			
		<? endif; ?>
    });
});
	
	<? if(!$_REQUEST['show']):?>
	$('#preview_popup_first_select #biz_sel').click(function(e){
		e.preventDefault();
		$('#preview_popup_first_select').hide();
		$('#preview_popup_final_user').show();
		$('#preview_popup_final_user .centr_btn a').addClass('biz_btn');
	});
	<? else: ?>
		$('#preview_popup_first_select #biz_sel').click(function(e){
			$('#clip_ch_97').trigger('click');
			$('#preview_popup').hide();
			$('#preview_popup_full').hide();
		});
		
		$('#preview_popup_final_user #people_free_btn').click(function(e){
			$('#clip_ch_94').trigger('click');
			$('#preview_popup').hide();
			$('#preview_popup_full').hide();
		});
	<? endif; ?>
	
	<? if(!$_REQUEST['show']):?>
	$('#preview_popup_first_select #people_sel').click(function(e){
		e.preventDefault();
		$('#preview_popup_first_select').hide();
		$('#preview_popup_create_select').show();
		step++;
	});
	<? else: ?>
		$('#preview_popup_first_select #people_sel').click(function(e){
		e.preventDefault();
		$('#preview_popup_first_select').hide();
		$('#preview_popup_final_user').show();
		step++;
	});
	<? endif; ?>
	
	$('#preview_popup_create_select #task_free').click(function(e){
		e.preventDefault();
		$('#preview_popup_create_select').hide();
		$('#preview_popup_final_user').show();
		$('#preview_popup_final_user .centr_btn a').addClass('people_free_btn');
	});
	
	$('#preview_popup_create_select #task_paid').click(function(e){
		e.preventDefault();
		$('#preview_popup_create_select').hide();
		$('#preview_popup_final_our').show();
		$('#preview_popup_final_our .centr_btn a').addClass('people_paid_btn');
	});
	
	$('#preview_popup_final_our .centr_btn a, #preview_popup_final_user .centr_btn a').click(function(){
		switch(true){
			case $(this).hasClass('biz_btn') :
				$('#clip_ch_97').trigger('click');
			break;	
			case $(this).hasClass('people_free_btn') :
				$('#clip_ch_94').trigger('click');
			break;	
			case $(this).hasClass('people_paid_btn') :
				$('#clip_ch_107').trigger('click');
			break;	
		}
		
		$('#preview_popup').hide('slow');
		$('#preview_popup_full').hide();
		//$('#menu-choose').css('z-index','999999');
		//$('#menu-choose').css('position','relative');
	});
	
	document.body.addEventListener('keydown', function (e) {
   		if ((e.altKey) && (e.ctrlKey)) {
      		$('#preview_popup').hide();
			$('#preview_popup_full').hide();
   		}
	});
	
</script>