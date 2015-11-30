<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
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
<a class="button-slide under-content-title order_clip_vk set_sess_vk" style="margin-bottom: 10px; width: 256px;" href="#">АВТОРИЗОВАТЬСЯ ВКОНТАКТЕ<a>
<a class="button-slide under-content-title order_clip_ok set_sess_vk" style="margin-bottom: 10px; width: 256px;" href="#">АВТОРИЗОВАТЬСЯ В ОДНОКЛАССНИКАХ<a>
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
		$('.vkontakte-button').trigger('click');
	});
	$('.order_clip_ok').click(function(e){
		e.preventDefault();
		$('.odnoklassniki-button').trigger('click');
	});
</script>


