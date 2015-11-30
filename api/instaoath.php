<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<? $APPLICATION->SetTitle("Выбрать фото из инстаграм");?> 
<?php
if($_REQUEST['video_id']){
	$_SESSION['insta_id'] = $_REQUEST['video_id'];
}
// включение класса
require $_SERVER['DOCUMENT_ROOT'].'/api/src/Instagram.php';
use MetzWeb\Instagram\Instagram;

// определение учетных данных
$config = array(
  'apiKey'        => '00efa1acd4a74785a8010d3a47ee6513',
  'apiSecret'     => '501b77272a8b42eb96059c87494798cb',
  'apiCallback'   => 'http://fromfoto.com/api/instaoath.php',
);
$limit = 20;

// инициализация клиента
$instagram = new Instagram($config);

// проверка подлинности
if (!isset($_SESSION['IACCESS_TOKEN'])) {
  if (!isset($_GET['code'])) {
    $auth_url = $instagram->getLoginUrl();
    header('Location: ' . $auth_url);
    die('Redirect');
  } else {
    $data = $instagram->getOAuthToken($_GET['code']);  
    $_SESSION['IACCESS_TOKEN'] = $data;
    $instagram->setAccessToken($_SESSION['IACCESS_TOKEN']);
  }
} else {
  $instagram->setAccessToken($_SESSION['IACCESS_TOKEN']);
}

?>
    <div id="" style="border: none; text-align: center;"> 			 
		<h1 class="big_slog" id="main_h_big"><font size="5">Выберите фото!</font></h1>
		<p><font size="2">
			Для добавления фотографии в клип выбирите все <br /> 
			понравившиеся фото, после этого нажмите на кнопку "ДОБАВИТЬ ФОТО".
		</font>
		<div id="answer" style="color: red"></div>
		<img class="preload_insta" style="height: 34px;display:none; padding: 0 15px; " src="<?=SITE_TEMPLATE_PATH?>/images/preload.gif" />
		<a class="button-slide send_photo" href="#" style="line-height: 29px; height: 27px; padding: 0 15px; font-size: 10px;">ДОБАВИТЬ ФОТО</a>
		</p>
	</div>
    <?php
    try {      
        // поиск подходящего пользователя
        $user = $instagram->searchUser($_POST['u']);

        // поиск фотографий пользователя
        $media = $instagram->getUserMedia($_SESSION['IACCESS_TOKEN']->user->id, $limit);  
        if (count($media->data) > 0) {
			
        ?>
		<div role="presentation" class="table table-striped imgs_uploader">
			<ul class="upload-table files not_sortable" style="border: none;">
			<?
			foreach ($media->data as $item) {
			?>
				
				<li class="show_popup ui-sortable-handle">
					<img 
						href="<?=$item->images->standard_resolution->url;?>" 
						src="<?=$item->images->thumbnail->url;?>" 
					/>
				</li>
			<?
			}
			?>
			</ul>
		</div>
		<? if(count($media->data) == $limit): ?>
		<div id="main_button_wrapper"> 		 
			<div id="button_norm">
				<a offset="<?=$media->pagination->next_max_id; ?>" class="button-slide more-photo" href="#" style="line-height: 29px; height: 27px; padding: 0 15px; font-size: 10px;">больше фотографий...</a>
			</div>
		</div>
		<? endif; ?>
		  <?
        }
      } catch (Exception $e) {
        echo '<p>Произошла неизвестная ошибка, попробуйте позже.</p>';
    }
  ?>
<script>
	var limit = parseInt('<?=$limit?>');
	$(document).on('click', '.more-photo', function(e){
		e.preventDefault();
		var _btn = $(this);
		if(_btn.html() == 'Подождите, пожалуйста...'){
			return false;
		}
		_btn.html('Подождите, пожалуйста...');
		$.post("/api/ajax_instaoath.php", {offset:_btn.attr('offset'), limit:limit}, function(responseText){
			$('.upload-table.files').append(responseText);
			if($('.upload-table.files .offset_photo').length){
				_btn.attr('offset', $('.upload-table.files .offset_photo').attr('offset'));
				$('.upload-table.files .offset_photo').remove();
				_btn.html('больше фотографий...');
			}
			else{
				_btn.closest('#main_button_wrapper').remove();
			}
			
		});
	});
	
	$(document).on('click', '.show_popup img', function(e){
		$(this).toggleClass( "ui-selected" );
	});
	
	$(document).on('click', '.send_photo', function(e){
		e.preventDefault();
		$('#answer').html('');
		var _btn = $(this);
		$('.preload_insta').show();
		_btn.hide();
		var files = [];
		$("li.show_popup img.ui-selected").each(function(){
			var fls = [];
			fls[0] = $(this).attr('src');
			fls[1] = $(this).attr('href');
			files.push(fls);
		});
		$.post("/ajax/upload_insta.php", {files:files}, function(responseText){	
			if(responseText){
				$('#answer').html(responseText);
				$('.preload_insta').hide();
				_btn.show();
			}else{
				window.location = '/create_video/?video_id=<?=$_SESSION['insta_id']; ?>';
			}
		});
	});
	
	/*$( ".imgs_uploader" ).selectable({ 
		filter: "li.show_popup img",
		start: function( event, ui ) {
			// return;
		},
		stop: function( event, ui ) {
			// return;
		}
	});*/
</script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>