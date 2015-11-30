<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<? global $USER; ?>
<?
    if(empty($arParams["CHEKCODE"])){
    	$arParams["CHEKCODE"] = '0';
    }
?>
<div class="popup" style="display: none;">
  <div class="popup-container with_border" style="margin: -50px auto 0; top: 50%;"> <a href="/" class="cross"></a>
    <span class="ready-klip">посмотрите готовый клип, если уже сделали заказ</span>
    <div class="mail with-button">
		<a href="#" style="margin-bottom: 10px; width: 256px;" class="button-slide under-content-title set_sess_vk reload_p">АВТОРИЗОВАТЬСЯ</a>
	</div>
  </div>
</div>
<script>
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
	
	$('.reload_p').click(function(){
		window.location= '/fljvrFG/'; 
	})
</script>