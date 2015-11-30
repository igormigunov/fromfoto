<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? global $USER; ?>
<?if($arResult["AUTH_SERVICES"] && !$USER->IsAuthorized()):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "fromfoto", 
	array(
		"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
		"AUTH_URL"=>$arResult["AUTH_URL"],
		"POST"=>$arResult["POST"],
		"POPUP"=>"N",
		"SUFFIX"=>"form",
	), 
	$component, 
	array("HIDE_ICONS"=>"N")
);
?>
<p class="social_opinion"><?=GetMessage("AUTH_PLEASE_REG");?></p>
<div class="error_answ" style="color:red; font-size:20px;"></div>
<a href="#" id="email_conf"></a>
<div class="email_conf_div">
<input type="text" class="email_conf" placeholder="Введите Ваш e-mail" />
<a href="#" id="email_send">отправить</a>
</div>
<script>
	$('#email_conf').click(function(e){
		e.preventDefault();
		$('.email_conf_div').css('display','inline-block');
		$(this).hide();
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
		 $.post("/ajax/authoriz_by_email.php",{email:_val}, function(data){
				if(parseInt(data)==1){
					$('.error_answ').html('');
					var location = window.location.href;
					window.location = location.replace('#','');
				}else{
					$('.error_answ').html(data);	
				}
			});
	}
</script>
<style>
	.email_conf_div{
		display: none;
    	vertical-align: middle;
   		margin-top: 15px;
	}
	a#email_conf{
		width: 206px;
		height:79px;
		display:inline-block;
		background: url('/images/email.png') no-repeat;
	}
	a#email_conf:hover{
		background: url('/images/email_hover.png') no-repeat;
	}
	input.email_conf {
   		height: 50px;
    	padding: 5px;
    	text-transform: none !important;
    	width: 398px;
    	background: #fff !important;
   		border: 2px solid #6da0e1 !important;
    	box-shadow: 0 -4px 0 #fff inset !important;
		color: #5689b6;
	}
	a#email_send{
		background: #fff !important;
    	border: 2px solid #6da0e1 !important;
    	color: #5689b6 !important;
    	height: 50px;
    	margin-top: 0;
    	text-decoration: none !important;
    	text-transform: none !important;
    	display: inline-block;
    	padding: 0px 10px;
		
	}
	a#email_send:hover{
		text-decoration:none !important;
		box-shadow: 0px 0px 12px #5689b6 inset !important;
	}
	.bx-auth{
		padding:0px !important;
		margin:0px !important;
	}
	div.bx-auth-service-form{
		border:none !important;
		background:none !important;
	}
	.bx-auth-service-form span{
		display:none;
	}
	.bx-auth-service-form div{
		display:table-cell;
	}
	.bx-auth-serv-icons a:hover, .bx-auth-serv-icons a, .bx-auth-service-form div a{
		margin:0px 32px 0px 32px !important;
		padding: 0px !important;
	}
	
	.bx-auth-serv-icons a:hover{
		border:none !important;
	}
	
	.bx-ss-icon, .bx-ss-icon:hover, .bx-auth-service-form div a{
		width: 174px !important;
		height: 174px !important;
		background-position: 0px 0px !important;
		border:none !important;
	}
	
	.bx-ss-icon.odnoklassniki, .bx-auth-service-form div a.odnoklassniki-button{
		background-image: url('/images/ok_soc.png') !important;
		
	}
	.bx-ss-icon.odnoklassniki:hover, .bx-auth-service-form div a.odnoklassniki-button:hover{
		background-image: url('/images/ok_soc_hover.png') !important;
	}
	
	.bx-ss-icon.twitter, .bx-auth-service-form div a.twitter-button{
		background-image: url('/images/twitter1.png') !important;
		
	}
	.bx-ss-icon.twitter:hover, .bx-auth-service-form div a.twitter-button:hover{
		background-image: url('/images/twitter_hover1.png') !important;
	}
	
	.bx-ss-icon.vkontakte, .bx-auth-service-form div a.vkontakte-button{
		background-image: url('/images/vk1.png') !important;
		
	}
	.bx-ss-icon.vkontakte:hover, .bx-auth-service-form div a.vkontakte-button:hover{
		background-image: url('/images/vk_hover1.png') !important;
	}
	
	.bx-ss-icon.facebook, .bx-auth-service-form div a.facebook-button{
		background-image: url('/images/fb1.png') !important;
		
	}
	.bx-ss-icon.facebook:hover, .bx-auth-service-form div a.facebook-button:hover{
		background-image: url('/images/fb_hover1.png') !important;
	}
	.social_opinion{
		padding-top:35px;
		font-size:30px;
		color:#6da0e1;
		text-align: center;
		width: 740px;
	}
</style>
<?endif?>