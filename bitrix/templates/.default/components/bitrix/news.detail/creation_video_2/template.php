<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->SetViewTarget("add_content_class"); ?>with_out_border<? $this->EndViewTarget(); ?>
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


if($_COOKIE['UPLOAD_FILES']){
	$tmp = $_COOKIE['UPLOAD_FILES']."/";
}

//выбор фотографий для данного клипа
$arFilter = Array(
   "IBLOCK_ID"=>"31", 
   "ACTIVE"=>"Y", 
   "SECTION_ID"=>($arResult['PROPERTIES']['PHOTO']['VALUE'])? $arResult['PROPERTIES']['PHOTO']['VALUE']:-1
   );
$arSelect = array("PROPERTY_SIZE","PROPERTY_SECOND","PROPERTY_NO_VIDEO","ID","NAME");
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter,false,false,$arSelect);
$photo = array();
while($ar_fields = $res->GetNext())
{
  $photo[] = $ar_fields;
}

$arFilter = array('IBLOCK_ID' => 30, 'ID' => $arResult['IBLOCK_SECTION_ID']);
$rsSection = CIBlockSection::GetList(array(), $arFilter, false, array('UF_INSTAGRAM'));
$arSection = $rsSection->GetNext();
?>
<script src="<?=$templateFolder?>/script.js"></script>

<div class="page-title"><span>шаблон <?=$arResult["NAME"]?></span></div>
<div <? if($_SESSION["user_clip_data"] && 1==0):?> style="display: none; "<? endif; ?> class="template-video">
	<?=$arResult['DISPLAY_PROPERTIES']['PREV_VIMEO2']['~VALUE'];?>
</div>

      <div class="template-step margin" <? if($_SESSION["user_clip_data"] && 1==0):?> style="display: none; "<? endif; ?>>
        <span>ШАГ 1</span> 
		<font id="count_pictures_container"><?printf(GetMessage("FF_ST1_TITLE"), sizeof($arResult["PHOTO"]));?></font>
		<font style="display:none;" id="all_pictures_container"><?=GetMessage("S_ALL_PHOTO_COMPLETE");?></font>
		<? if(!$arSection['UF_INSTAGRAM']): ?>
		<div style="text-align: left; margin-top: 15px; border: 1px solid #aab8ca; padding: 10px; background: #e8eef4;">
			<? if(!is_mobile()): ?>
			<table>
			<tbody><tr>
				<td style="vertical-align:bottom">
					<span style="text-transform: uppercase; position: relative;">
						Совет дизайнера:
					</span>
					<br> лучше всего подойдут
				</td>
				<td style="vertical-align:bottom">
					горизонтальные фото <img src="/images/vert.png" style="border: medium none;"> , 
					хуже вертикальные&nbsp;<img src="/images/hor.png" style="border: medium none;">
				</td>
			</tr>
		  </tbody></table>  
		  <? else: ?>
			<span style="text-transform: uppercase; position: relative;">
				Совет дизайнера:
					</span>
					<br> лучше всего подойдут
					горизонтальные фото  , 
					хуже вертикальные
		  <? endif; ?>
		</div>
		<? endif; ?>
	  </div>
	  
	  <form id="fileupload" action="/ajax/upload.php" method="POST" enctype="multipart/form-data" <? if($_SESSION["user_clip_data"] && 1==0):?> style="display: none; "<? endif; ?>>
      <div class="upload-wrap">
        <div class="upload-button add-photo">
          <div class="upload-button-container">
            <span><?=GetMessage("FF_BUT_ADD")?></span>
            <input type="file" name="files[]" multiple>
          </div>
        </div>
        <div class="upload-button delete-photo" style="cursor: pointer;" >
          <div class="upload-button-container">
            <span><?=GetMessage("FF_BUT_DEL")?></span>
            <input type="button" style="cursor: pointer;" >
          </div>
        </div>
		<? if($arSection['UF_INSTAGRAM']): ?>
			<div class="upload-button instagram-photo" style="cursor: pointer;" >
			  <div class="upload-button-container">
				<span>Фото инстаграм</span>
				<input type="button" style="cursor: pointer;" >
			  </div>
			</div>
		<? endif; ?>
      </div>
	  <div role="presentation" class="table table-striped imgs_uploader"><ul class="upload-table files"></ul></div>
	  </form>
	<div class="step_second">
      <div class="template-step" <? if($_SESSION["user_clip_data"] && 1==0):?> style="display: none; "<? endif; ?>>
        <span>ШАГ 2</span> <?=GetMessage("FF_ST2_TITLE")?>
      </div>
      <div class="upload-wrap" <? if($_SESSION["user_clip_data"] && 1==0):?> style="display: none; "<? endif; ?>>
        <div class="upload-button add-music">
        <?
           	$file_path = CFile::GetPath($arResult['PROPERTIES']['AUDIO_MP3']['VALUE']);
			$paths = explode("/",$file_path);
			$file_name = $paths[sizeof($paths)-1];
		?>
          <div class="upload-button-container add_mp3" style="cursor:pointer;">
            <span><?=GetMessage("FF_BUT_ADD_AUDIO")?></span>
            <input id="fileupload" type="button" />
          </div>
        </div>
      </div>  
      <ul class="upload-table-music" <? if($_SESSION["user_clip_data"] && 1==0):?> style="display: none; "<? endif; ?>>
		<? $file_path = CFile::GetPath($arResult['PROPERTIES']['AUDIO_MP3']['VALUE']); ?>
		<?
			$file_main_name = ($_SESSION["user_clip_data"] && $_SESSION['mp3_name']) ? $_SESSION['mp3_name'] : $file_name;
			$file_main_path = ($_SESSION["user_clip_data"] && $_SESSION['mp3_name']) ? '/upload/tmp/'.$tmp.$_SESSION['mp3_name'] : $file_path;
		?>
        <li src="<?=$file_main_path; ?>" ><span class="mp3_name"><?=$file_main_name;?></span></li>
		
		<span path='<?=$file_main_path;?>' id="path_to_mp3"></span>
		<span path='<?=$file_path;?>' id="path_to_return_mp3" mp3_name="<?=$file_name; ?>"></span>
        <a href="#" id="return_mp3" class="music-button"><?=GetMessage("FF_BUT_RE_AUDIO")?></a>
      </ul>
<? if(! $_SESSION["user_clip_data"] || 1==1):?>
<?if($arResult["TEXTS"]):?>
<? 
   		$newWidth = 193;
		$newHeight = 108;
?>
      <div class="template-step">
        <span>ШАГ 3</span> <?=GetMessage("FF_ST3_TITLE")?>
      </div>
      <!--<form class="template-form">-->
	  <? $arTexts = $_SESSION['texts_user']; ?>
	<?foreach($arResult["TEXTS"] as $k=>$v):?>
		<? $num++; ?>
        <div class="template-text">
          <div class="template-text-container">
            <p>ТЕКСТ <?=$num;?>
            <? if($v['PROPERTY_COUNT_SYMBOLS_VALUE']): ?>
				<span class="template-text-note"><span class="count_text_value"><?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?></span> символов</span>
			<? endif; ?>
			</p>
            <textarea class="text-field text_inp" size_value="<?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?>" placeholder="Напишите сюда ваш текст до <?=$v['PROPERTY_COUNT_SYMBOLS_VALUE']; ?> символов"><? if($_SESSION["user_clip_data"] || ($_REQUEST['ok_auth'] && $USER->IsAuthorized())): ?><?=$arTexts[$k];?><? endif; ?></textarea>
          </div>
          <div class="template-text-video">
          <? if($v['PREVIEW_PICTURE'] || $v['PROPERTY_TIME_CLIP_VALUE']): ?>
               	<?
                   	$renderImage = CFile::ResizeImageGet($v['PREVIEW_PICTURE'], Array("width" => $newWidth, "height" => $newHeight), $resizeType = BX_RESIZE_IMAGE_EXACT);
				?>
	            <img src="<?=$renderImage['src'];?>">
	            <span><?=$v['PROPERTY_TIME_CLIP_VALUE'];?></span>
          <? endif; ?>
          </div>
        </div>
 	<?endforeach;?>
<?endif;?>
<?endif;?>
		<? if(((isset($_COOKIE['FREE_LIMIT']) && $_COOKIE['FREE_LIMIT'] >= 2 && $arResult['PROPERTIES']['FREE_PERIOD']['VALUE']) || (isset($_COOKIE['PAID_LIMIT']) && $_COOKIE['PAID_LIMIT'] >=2 && !$arResult['PROPERTIES']['FREE_PERIOD']['VALUE'])) && !$_REQUEST['test_f']): ?>
			<h2 class="blue" style="text-align:center">
				<?=GetMessage("S_LIMIT")?>
			</h2>
		<? else: ?>
		<? if(! $_SESSION["user_clip_data"] || 1==1):?>
			<div class="mail">
			  <span style="line-height: 1.4; margin-bottom: 28px;"><?=GetMessage("FF_FROM_EMAIL")?></span> 
			  <?$cookie_login = $_SESSION['VK_EMAIL'];
					if(empty($cookie_login)){
						$cookie_login = CUser::GetEmail();
					}?>
			  <input style="margin-top: -1px;" id="email_feed" type="text" placeholder="почта" value="<?=$cookie_login;?>">
			</div>
			<? if(!$USER->IsAuthorized()): ?>
				<div class="mail">
				  <span style="line-height: 1.4; margin-bottom: 28px;">Какой соц.сетью вы пользуетесь?</span> 
				  <div class="soc_auth">
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
				<br />
			<? endif; ?>
			<div class="slide-title-FOC" style="margin: 30px 0">
			  <span><?=GetMessage("FF_MESS1")?></span> 
			</div>
			<? endif; ?>
			<div style="text-align: center; font-weight: bold; color: #5d7395;" class="hide_after_order" id="answer"><? if($_SESSION["user_clip_data"] && 1==0):?><?=GetMessage("S_PROCESSING")?><? endif; ?></div>
			<input type="submit" class="a_order_clip_btn_vk" style="display: none;" value="Отправить" />
			<? if($USER->IsAuthorized()): ?>
			<input <? if($_SESSION["user_clip_data"] && 1==0):?> style="display: none; "<? endif; ?> onclick="yaCounter25315490.reachGoal('zakaz-video');" type="submit" class="button-slide check_before_submit order_clip_please" value="<?=GetMessage("FF_BUT_SEND")?>">
			<? else: ?>
			<input <? if($_SESSION["user_clip_data"] && 1==0):?> style="display: none; "<? endif; ?> type="submit" class="button-slide auth_clip_please" value="<?=GetMessage("FF_BUT_SEND")?>">
			<? endif; ?>
			<div class="pay_block" style="display: none;"></div>
		<? endif; ?>
      <!--</form>-->
	  </div>
      


<div class="popup" style="display: none;">
	<div class="popup-container with_border" style="margin: -160px auto 0; top: 50%;">
		<div class="wait" style="text-align: center;">
			<div class="content-title bold-title" style="text-decoration: uppercase; color: #475f83;">
				отлично, остался последний шаг!
			</div>
			<span class="ready-klip normal big-kl" style="text-decoration: uppercase; margin: 0px 0 20px;" >
				сделайте репост и мы приступим к созданию вашего клипа
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
			<? if(!is_mobile()): ?>
				<div style="margin: auto; width: 590px;">
					<div style="float:left;">
						<img src="/images/repost.png" style="border:none;">
					</div>
					<div style="float:left;">
						<span class="ready-klip normal big-kl" style="margin: 34px 0px 20px;">
							Вот такой безобидный репост
						</span>
						<img src="/images/arrow.png" style="border:none;" />
						<br /><br />
						<a class="button-slide under-content-title repost_clip_vk" onclick="yaCounter25315490.reachGoal('repost1');" style="margin-bottom: 10px; width: 256px; margin-top: 4px;" href="#">сделать репост</a>
					</div>
					<div style="clear: both"></div>
				</div>
			<? else: ?>
				<a href="#" style="text-decoration: uppercase; margin-bottom: 10px; width: 256px;" onclick="yaCounter25315490.reachGoal('repost1');"  class="button-slide under-content-title repost_clip_vk">сделать репост</a>
			<? endif; ?>
			<? endif; ?>
			
			<span class="ready-klip normal big-kl" style="text-decoration: uppercase; margin: 40px 0 20px;" >
				ИЛИ оплатите 100 р., ЕСЛИ НЕ ХОТИТЕ ДЕЛАТЬ РЕПОСТ
			</span>
			<a class="button-slide under-content-title pay_clip_vk" onclick="yaCounter25315490.reachGoal('pay_no_repost');" style="text-decoration: uppercase; margin-bottom: 10px; width: 256px;" href="#">оплатить</a>
		</div>
	</div>
</div>

<?

$tmp = "";

if($_COOKIE['UPLOAD_FILES']){

	$tmp = $_COOKIE['UPLOAD_FILES']."/";

}

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/ajaxupload.js"></script>
<script>
	$('.instagram-photo').click(function(){
		window.location = '/api/instaoath.php?video_id=<?=$_REQUEST['video_id']; ?>';
	});

	$('.soc_auth span').click(function(){
		$('.soc_auth span').removeClass('active');
		$(this).addClass('active');
	});

	var free_period = '<? echo ($arResult['PROPERTIES']['FREE_PERIOD']['VALUE'])? '1':'' ?>';
	$('#return_mp3').click(function(e) {
		e.preventDefault();
		_path = $('#path_to_return_mp3').attr('path');
		_mp3_name = $('#path_to_return_mp3').attr('mp3_name');

		$('#path_to_mp3').attr('path',_path);
						
		$('.mp3_name').html(_mp3_name);
    });
	
	new AjaxUpload($('.add_mp3'),{
		action: '/ajax/upload_mp3.php',
		name: 'uploadmp3',
		onSubmit: function(file, ext){
			if(!(ext &&  /^(mp3)$/.test(ext))){
				alert('<?=GetMessage("S_ONLY_MP3")?>');
				return false;
			};
			$('.mp3_name').html('<img class="preload_mp3" style="height: 40px;" src="<?=SITE_TEMPLATE_PATH?>/images/preload.gif" />');
			<? if($USER->IsAuthorized()): ?>
				$('.order_clip_please').hide();
			<? else: ?>
				$('.auth_clip_please').hide();
			<? endif; ?>
		},
		onComplete: function(file, response){
			<? if($USER->IsAuthorized()): ?>
				$('.order_clip_please').show();
			<? else: ?>
				$('.auth_clip_please').show();
			<? endif; ?>
			if($(response).find('answer').text() == 'ok'){				
				$('#path_to_mp3').attr('path','/upload/tmp/<?=$tmp; ?>' + $(response).find('file').text());
				$('.mp3_name').html(file);
			}
			else{
				alert('<?=GetMessage("S_COULD_NOT_LOAD")?>');
				$('#return_mp3').trigger('click');
			};
		}
	});
	
	function show_ret_mp3(){
		if($('#path_to_return_mp3').attr('mp3_name') != $('.mp3_name').text() && !$('.mp3_name img').hasClass('preload_mp3')){
			$('#return_mp3').show();
		}else{
			$('#return_mp3').hide();
		}
	}
	

	var count_pictures = '<?=sizeof($arResult["PHOTO"]); ?>';
	var timer_change_count_text_photo = setTimeout(function change_count_text_photo() {
		var difference = parseInt(count_pictures) - parseInt($('.upload-table .show_popup img').length);
		timer_change_count_text_photo = setTimeout(change_count_text_photo, 1000);
		if(difference > 0){
			$('#count_pictures_container .count_photo').html(difference);
			$('#count_pictures_container').show();
			$('#all_pictures_container').hide();
			$('.step_second').hide();
		}else{
			$('.step_second').show();
			$('#count_pictures_container').hide();
			$('#all_pictures_container').show();
			show_ret_mp3();
		}
	}, 1000);
	
	$(".text_inp").keyup(function(){
		var size_value = parseInt($(this).attr('size_value'));
        if($(this).val().length > size_value && size_value > 0){
        	$(this).val($(this).val().substr(0, size_value));
        }
		var count_simbols = parseInt(size_value) - parseInt($(this).val().length);
		$('.count_text_value', $(this).parent()).html(count_simbols);
	});

	$('html').keyup(function(e){
    	if(e.keyCode == 46){
			$('.delete-photo').trigger('click');	
		}
	});
	
	$('.delete-photo').click(function(){
		$('li.show_popup img').each(function(index, element) {
            if($(this).hasClass("ui-selected")){
				_this = $(this);
				_this.closest('li.show_popup').remove();
				$.ajax({
					url: "/ajax/upload.php" + '?' + $.param({"file": _this.attr("file_name")}),
   					type: 'DELETE'
				}).done(function() {
					
				});
			}
        });  
	});

	$( ".imgs_uploader" ).selectable({ 
		filter: "li.show_popup img",
		start: function( event, ui ) {
			// return;
		},
		stop: function( event, ui ) {
			// return;
		}
	});
	
	$(".table-striped .files").sortable({
	    	opacity: 0.6,		
			tolerance:'pointer',
	    	start: function(event, ui) {
	    		//$('li.show_popup img').removeClass('ui-selected');
			},
	    	stop: function(event, ui) {
				var imgs = [];
				$("li.show_popup img").each(function(){
					imgs.push($(this).attr('file_name'));
				});
				$.post("/ajax/resorting.php", {imgs:imgs}, function(responseText){
				});
			
				/*$('.img_prev_upl img').each(function(index, element) {
                    if($(this).hasClass('ui-selected')){
						$(this).removeClass('ui-selected');
						$(this).trigger('click');
						return false;
					}
                });*/
			}
	});
	
	$(document).on('click', 'li.show_popup img',function(){
		if($(this).hasClass('ui-selected')){
			$(this).removeClass('ui-selected');
		}else{
			$(this).addClass('ui-selected');
		}
	});
	
	$('.a_order_clip_btn_vk').click(function(e){
		e.preventDefault();
		$('.popup').show();
	});
	
	$('.auth_clip_please').click(function(e){
		e.preventDefault();
		save_state();
		$("#answer").html('');
		if(!$('.vk_auth').hasClass('active') && !$('.ok_auth').hasClass('active')){
			$("#answer").html("<div class=\"errors\">Выберете соц. сеть для Вашего клипа!</div>");
			return false;
		}
		if($("#email_feed").val()){
			if($('.ok_auth').hasClass('active')){
				$('.odnoklassniki-button').trigger('click');
			}else{
				$('.vkontakte-button').trigger('click');
			}
		}else{
			$("#answer").html("<div class=\"errors\">Укажите Вашу почту!</div>");
		}
		
	});
	
	$('.pay_clip_vk').click(function(e){
		e.preventDefault();
		//$('.vkontakte-button').trigger('click');
		$.post("<?=SITE_DIR?>ajax/set_sess_pay.php", {}, function(data){
			
		});
		$('.wait').html('<span class="ready-klip normal big-kl">Подождите, пожалуйста. Ваш клип обрабатывается.</span><img style="height: 40px;" src="<?=SITE_TEMPLATE_PATH?>/images/preload.gif" />');
		
		send_clip('wait_zakaz');
	});
	
	$('.repost_clip_vk').click(function(e){
		e.preventDefault();
		<? if($USER->IsAuthorized() && preg_match("/OKuser/i", $USER->GetLogin())):?>
			window.open('http://www.ok.ru/dk?st.cmd=addShare&st.s=1&st._surl=<?=urlencode('http://fromfoto.com/repost/'.rand(9999999, 99999999).'/');?>','sharer','toolbar=0,status=0,width=548,height=325');
		<? else: ?>
			window.open('https://<?=change_share_mobile(); ?>/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');
		<? endif; ?>
		$('.wait').html('<span class="ready-klip normal big-kl">Подождите, пожалуйста. Ваш клип обрабатывается.</span><img style="height: 40px;" src="<?=SITE_TEMPLATE_PATH?>/images/preload.gif" />');
		send_clip('zakaz');
	});
	
	
	function send_clip(_make_dir){		
		//window.open('https://vk.com/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');
		//$('.popup').hide();
		
		//$("#answer").html('<?=GetMessage("S_PROCESSING")?>');
		//return 1;
			
		$(".order_clip_please").hide();
		
		var imgs = [];
		$(".show_popup img").each(function(index, element){
			imgs.push($(this).attr('href'));
		});		

		var texts = [];
		$("textarea.text_inp").each(function(){
			texts.push($(this).val());
		});
		$.post("<?=SITE_DIR?>ajax/save_texts.php", {texts:texts});
		
		var coords = [];
		<? foreach($photo as $k=>$v):?>
			coords.push('<?=preg_replace("/X|Х/iu", 'x', $v['PROPERTY_SIZE_VALUE']);?>');
		<? endforeach; ?>
		
		$.post("<?=SITE_DIR?>ajax/create_clip.php", 
			{	SECTION_ID:'<?=$arResult['PROPERTIES']['PHOTO']['VALUE']; ?>',
				imgs:imgs,
				texts:texts, 
				coords: coords,
				free_period: free_period,
				email:$("#email_feed").val(), 
				email_vk:$("#email_feed").val(), 
				name:$("#name_feed").val(), 
				mp3:$('#path_to_mp3').attr('path'), 
				vk:1, 
				video_id:'<?=$_REQUEST['video_id'];?>', 
				maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', 
				section_text_id:"<?=$arResult['PROPERTIES']['TEXTS']['VALUE']; ?>"
			}, function(data){

			if(data == 1){
				var now = new Date();
  				var expire = new Date();
  				expire.setFullYear(now.getFullYear());
  				expire.setMonth(now.getMonth());
  				expire.setDate(now.getDate()+1);
  				expire.setHours(0);
  				expire.setMinutes(0);
				
				if(free_period){
					if(getCookie('FREE_LIMIT')){
						setcookie("FREE_LIMIT",parseInt(getCookie('FREE_LIMIT'))+1,expire,'/');
					}else{
						setcookie("FREE_LIMIT",1,expire,'/');
					}
				}else{
					if(getCookie('PAID_LIMIT')){
						setcookie("PAID_LIMIT",parseInt(getCookie('PAID_LIMIT'))+1,expire,'/');
					}else{
						setcookie("PAID_LIMIT",1,expire,'/');
					}
				}
								
				$.post("<?=SITE_DIR?>ajax/create_clip_mob.php",
				{	SECTION_ID:'<?=$arResult['PROPERTIES']['PHOTO']['VALUE']; ?>',
					imgs:imgs,
					texts:texts, 
					coords: coords,
					free_period: free_period,
					email:$("#email_feed").val(), 
					email_vk:$("#email_feed").val(), 
					name:$("#name_feed").val(), 
					mp3:$('#path_to_mp3').attr('path'), 
					vk:1, 
					video_id:'<?=$_REQUEST['video_id'];?>', 
					maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', 
					section_text_id:"<?=$arResult['PROPERTIES']['TEXTS']['VALUE']; ?>",
					make_dir : _make_dir
				}, function(data){
					if(_make_dir == 'wait_zakaz'){
						$.post("<?=SITE_DIR?>ajax/submit_fast.php", {}, function(data){
							if(data != '1'){
								<? unset($_SESSION['paid']); ?>
								$('.pay_block').html(data);
								$('#PayForm').submit();
							}else{
								setTimeout(function(){window.location = '/fljvrFG/?check=1';}, 1*1000);	
							}
						});
					}else{
						setTimeout(function(){window.location = '/fljvrFG/?check=1';}, 15*1000);	
					}
				});
			}else{
				$("#answer").html(data);
				$(".order_clip_please").show();
			}
		});
	};
	
	function save_state(){
		var imgs = [];
		$(".show_popup img").each(function(index, element){
			imgs.push($(this).attr('href'));
		});
		var texts = [];
		$("textarea.text_inp").each(function(){
			texts.push($(this).val());
		});
		$.post("<?=SITE_DIR?>ajax/save_email.php", {VK_EMAIL: $("#email_feed").val()}, function(data){
			
		});
		$.post("<?=SITE_DIR?>ajax/save_texts.php", {texts:texts});
		var coords = [];
		<? foreach($photo as $k=>$v):?>
			coords.push('<?=preg_replace("/X|Х/iu", 'x', $v['PROPERTY_SIZE_VALUE']);?>');
		<? endforeach; ?>
		$.post("<?=SITE_DIR?>ajax/check_before_create.php", {	
				SECTION_ID:'<?=$arResult['PROPERTIES']['PHOTO']['VALUE']; ?>',
				imgs:imgs,
				texts:texts, 
				coords: coords,
				free_period: free_period,
				email:$("#email_feed").val(), 
				email_vk:$("#email_feed").val(), 
				name:$("#name_feed").val(), 
				mp3:$('#path_to_mp3').attr('path'), 
				vk:1, 
				video_id:'<?=$_REQUEST['video_id'];?>', 
				maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', 
				section_text_id: "<?=$arResult['PROPERTIES']['TEXTS']['VALUE']; ?>", 
				no_athorize: "Y"
			}, function(data){
		});
	}
	
	$('textarea.text_inp, #email_feed').change(function(){
		save_state();
	});
	
	$('.check_before_submit').click(function(e){
		e.preventDefault();		

		$("#answer").html('Подождите...');

		$(".order_clip_please").hide();

		var imgs = [];
		$(".show_popup img").each(function(index, element){
			imgs.push($(this).attr('href'));
		});		

		var texts = [];
		$("textarea.text_inp").each(function(){
			texts.push($(this).val());
		});
		$.post("<?=SITE_DIR?>ajax/save_texts.php", {texts:texts});
		
		var coords = [];
		<? foreach($photo as $k=>$v):?>
			coords.push('<?=preg_replace("/X|Х/iu", 'x', $v['PROPERTY_SIZE_VALUE']);?>');
		<? endforeach; ?>
		
		$.post("<?=SITE_DIR?>ajax/check_before_create.php", {	
				SECTION_ID:'<?=$arResult['PROPERTIES']['PHOTO']['VALUE']; ?>',
				imgs:imgs,
				texts:texts, 
				coords: coords,
				free_period: free_period,
				email:$("#email_feed").val(), 
				email_vk:$("#email_feed").val(), 
				name:$("#name_feed").val(), 
				mp3:$('#path_to_mp3').attr('path'), 
				vk:1, 
				video_id:'<?=$_REQUEST['video_id'];?>', 
				maket:'<?=trim($arResult['PROPERTIES']['NAME_AE']['VALUE']);?>', 
				section_text_id: "<?=$arResult['PROPERTIES']['TEXTS']['VALUE']; ?>", 
				no_athorize: "Y"
			}, function(data){

			if(data == 1){
				$('.a_order_clip_btn_vk').trigger('click');
			}else{
				$('html, body').animate({ scrollTop: $("#answer").offset().top }, 1000);
				$("#answer").html(data);
				$(".order_clip_please").show();

			}
		});
	});
	
	function openWindow(url,  width, height, offsetLeft, offsetTop, _name) {
		var offsetLeft = offsetLeft ? offsetLeft :($(window).width() - width) / 2,
			offsetTop = offsetTop ? offsetTop: ($(window).height() - height) / 2,
			params = 'width=' + width + ',height=' + height + ',left=' + offsetLeft + ',top=' + offsetTop + ',resizable=yes,scrollbars=yes';
	
			window.open(url, _name ? _name : '', params);
	}
	
	<? if($_SESSION["user_clip_data"] || ($_REQUEST['ok_auth'] && $USER->IsAuthorized())):?>
		setTimeout(function(){$('.check_before_submit').trigger('click');}, 1*1000);	
	<? endif;?>

	var er_file_types = '<?=GetMessage("S_ER_FILE_TYPES")?>';
	var er_maxFileSize = '<?=GetMessage("S_MAX_FILE_SIZE")?>';
	var er_minFileSize = '<?=GetMessage("S_MIN_FILE_SIZE")?>';
	var er_maxNumberOfFiles = '<?=GetMessage("S_MAX_NUMBR_FILES")?>';
	var free_period = '<? echo ($arResult['PROPERTIES']['FREE_PERIOD']['VALUE'])? '1':'' ?>';
</script>

<!-- The template to display files available for upload -->

<script id="template-upload" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}

	<li class="show_popup">
		<img style="height: 40px;" src="<?=SITE_TEMPLATE_PATH?>/images/preload.gif" />
	</li>

{% } %}

</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
	{% if (!file.error && file.thumbnailUrl) { %}
	<li class="show_popup">        
		{% if (file.thumbnailUrl) { %}
            <img href="{%=file.url%}" real_width="{%=file.real_width%}" real_height="{%=file.real_height%}" file_name="{%=file.name%}" uniq_name="{%=file.name%}-{%=i%}" src="{%=file.thumbnailUrl%}">
		{% } %}
	</li>
	{% } %}
	{%=file.type%}
	{% if (!file.error && (file.name.match( /\.mp4/i ) || file.name.match( /\.avi/i ) || file.name.match( /\.flv/i ) || file.name.match( /\.mov/i )) && !free_period) { %}
	<li class="show_popup">
	{% if (file.url) { %}
		<img class="video_pleer" href="{%=file.url%}" real_width="0" real_height="0" file_name="{%=file.name%}" uniq_name="{%=file.name%}-{%=i%}" src="<?=SITE_TEMPLATE_PATH?>/img/video_camera.png">
	{% } %}
	</li>
	{% } %}
{% } %}
</script>

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.js"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/vendor/jquery.ui.widget.js"></script>

<!-- The Templates plugin is included to render the upload/download listings -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/tmpl.min.js"></script>

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/load-image.min.js"></script>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/canvas-to-blob.min.js"></script>

<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/bootstrap.min.js"></script>

<!-- blueimp Gallery script -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.blueimp-gallery.min.js"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.iframe-transport.js"></script>

<!-- The basic File Upload plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload.js"></script>

<!-- The File Upload processing plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-process.js"></script>

<!-- The File Upload image preview & resize plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-image.js"></script>

<!-- The File Upload audio preview plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-audio.js"></script>

<!-- The File Upload video preview plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-video.js"></script>

<!-- The File Upload validation plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-validate.js"></script>

<!-- The File Upload user interface plugin -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/jquery.fileupload-ui.js"></script>

<!-- The main application script -->

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/main.js?05042015"></script>


<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->

<!--[if (gte IE 8)&(lt IE 10)]>

<script src="<?=SITE_TEMPLATE_PATH?>/js/upload_js/cors/jquery.xdr-transport.js"></script>

<![endif]-->


<style>
	.template-video iframe{
		width: 100%;
	}
	li.show_popup {
		opacity: 1 !important;
	}
	li.show_popup:nth-child(n+<?=sizeof($arResult["PHOTO"])+1;?>) {
		opacity: 0.3 !important;
	}
	.upload-wrap .upload-button::before{
		margin-right: 10px;
	}
	.upload-wrap .upload-button {
		margin: 0 15px;
	}
</style>