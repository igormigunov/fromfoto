<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$title=urlencode("Создаю свой клип :)");
$url=urlencode('http://fromfoto.com/fljvrFG/');
//$url=urlencode("http://www.youtube.com/watch?v=8HwUuVt85uE");
$urlok=urlencode('http://fromfoto.com/fljvrFG/');
$titleok=urlencode(prepare_row('Создаю свой клип из фотографий.'));
$summary=urlencode(prepare_row('БЕСПЛАТНЫЙ сервис для создания клипов из фотографий FromFoto.com. Попробуй!')); 
$image=urlencode('http://fromfoto.com/images/logo2.jpg');

$arAuthServices = $arPost = array();
if(is_array($arParams["~AUTH_SERVICES"]))
{
	$arAuthServices = $arParams["~AUTH_SERVICES"];
}
if(is_array($arParams["~POST"]))
{
	$arPost = $arParams["~POST"];
}
?>
<?if(($arParams["~CURRENT_SERVICE"] <> '') && $arParams["~FOR_SPLIT"] != 'Y'):?>
<script type="text/javascript">
BX.ready(function(){BxShowAuthService('<?=CUtil::JSEscape($arParams["~CURRENT_SERVICE"])?>', '<?=$arParams["~SUFFIX"]?>')});
</script>
<?endif?>
<a class="button-slide under-content-title order_clip_vk" style="text-decoration: uppercase; margin-bottom: 10px; width: 256px;" href="#">сделать репост<a>
<div class="bx-auth" style="display:none;">
	<form method="post" name="bx_auth_services<?=$arParams["SUFFIX"]?>" target="_top" action="<?=$arParams["AUTH_URL"]?>">
		<div class="bx-auth-service-form" id="bx_auth_serv<?=$arParams["SUFFIX"]?>" style="">
			<?foreach($arAuthServices as $service):?>
				<?if(
					(($arParams["~FOR_SPLIT"] != 'Y') || (!is_array($service["FORM_HTML"]))) 
					&& ($service['ID'] == 'VKontakte' || $service['ID'] == 'Odnoklassniki')
				):?>
					
					<div id="bx_auth_serv_<?=$arParams["SUFFIX"]?><?=$service["ID"]?>" ><?=$service["FORM_HTML"]?></div>
				<?endif;?>
			<?endforeach?>
		</div>
	</form>
</div>

<script>
	$('.order_clip_vk').click(function(e){
		e.preventDefault();
		if($('.ok_auth').hasClass('active')){
			$('.odnoklassniki-button').trigger('click');
		}else{
			$('.vkontakte-button').trigger('click');
		}
		//window.open('https://vk.com/share.php?url=<?php echo $url; ?>&title=<?php echo $title; ?>&description=<?php echo $summary; ?>&image=<?php echo $image; ?>','sharer','toolbar=0,status=0,width=548,height=325');
	});
</script>


