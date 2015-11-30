<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<? global $USER; ?>
<?
    if(empty($arParams["CHEKCODE"])){
    	$arParams["CHEKCODE"] = '0';
    }
?>
<div class="popup" style="display: none;">
  <div class="popup-container with_border" style="margin: -50px auto 0; top: 50%;"> <a href="/" class="cross"></a>
    <?  if(preg_match('/vk/i', $_SERVER['HTTP_REFERER']) || 1==1):?>
    <span class="ready-klip">посмотрите готовый клип, если уже сделали заказ</span>
    <div class="mail with-button">
	<? if(!$USER->IsAuthorized()): ?>
      <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","only_soc",Array(
			"REGISTER_URL" => "register.php",
			"FORGOT_PASSWORD_URL" => "",
			"PROFILE_URL" => "profile.php",
			"SHOW_ERRORS" => "Y" 
			)
		);?>
	<? else: ?>
		<? if(preg_match("/OKuser/i", $USER->GetLogin())):?>
			<a href="#" style="margin-bottom: 10px; width: 256px;" class="button-slide under-content-title set_sess_vk reload_p">АВТОРИЗОВАТЬСЯ В ОДНОКЛАССНИКАХ</a>
		<? else:?>
			<a href="#" style="margin-bottom: 10px; width: 256px;" class="button-slide under-content-title set_sess_vk reload_p">АВТОРИЗОВАТЬСЯ ВКОНТАКТЕ</a>
		<? endif; ?>
	<? endif; ?>
	</div>
    <? else: ?>
    <span class="ready-klip">
    <?=GetMessage("REPOST_ONLY");?>
    </span>
    <? endif; ?>
  </div>
</div>
<script>
	<? if($_REQUEST['from_fljvrFG']): ?>
		$('.popup').show();
	<? endif; ?>
	if($( window ).width() <= 480){
		$('header menu').html('<li><a id="bxid_642578" class="my_clip_show_auth" href="#" ><span>мой клип</span></a></li>');
	}else{
		$('header menu').prepend('<li><a id="bxid_642578" class="my_clip_show_auth" href="#" ><span>мой клип</span></a></li>');
	}
	$('.popup .cross').click(function(e){
		e.preventDefault();
		$('.popup').hide();
	});
	$('.my_clip_show_auth').click(function(){
		$('.popup').show();
	});

	$('#email_send').click(function(e){
		e.preventDefault();
		check_send($('.email_conf').val())
	});
	$('.email_conf').keyup(function (event) {
		var key = event.keyCode || event.which;
		
		if(key === 13) {
           check_send($(this).val())
        }
        return false;
    });
    
	function check_send(_val){
		 $.post("/ajax/authoriz_by_email.php",{email:_val, chekcode:<?=$arParams["CHEKCODE"]?>}, function(data){
				if(parseInt(data)==1){
					$('.error_answ').html('');
					var location = window.location.href;
					window.location = location.replace('#','') + "?check=1";
				}else{
					$('.email_conf').addClass('input-error');	
				}
			});
	}
	
	$('.set_sess_vk').click(function(){
		var _this = $(this);
		$.post("/ajax/set_sess_vk.php",{}, function(data){
			if(_this.hasClass('reload_p')){
				//console.log(window.location.href);
				window.location = "/";
			}
		});
	})
</script>