<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<? global $USER; ?>
<?
    if(empty($arParams["CHEKCODE"])){
    	$arParams["CHEKCODE"] = '0';
    }
?>
<a href="#" class="hide_popup_S" style="position: absolute; right: 10px; top: 5px; text-decoration: none;">Х</a>

<? if(preg_match('/vk/i', $_SERVER['HTTP_REFERER']) || $_REQUEST['admin_show'] || 1==1):?>
<p class="social_opinion social_opinion2"><?=GetMessage("AUTH_PLEASE_REG2");?></p>
<div class="error_answ" style="color:red; font-size:14px;"></div>
<div class="email_conf_div" style="text-align: center; margin: 0 100px;">
<?$cookie_login = ${COption::GetOptionString("main", "cookie_name", "BITRIX_SM")."_LOGIN"};?>
	<input type="text" class="email_conf" placeholder="почта@почта.ru" value="<?=$cookie_login;?>" style="float: left; margin: 0 20px; width: 250px;" />
	<a href="#" class="btn_go" id="email_send" style="float: left; margin-top: 1px; background: #687c9c; height: 36px; padding: 8px; width:230px; border: 1px solid #000000;">перейти в мой кабинет</a>
</div>
<? else: ?>
<p class="social_opinion social_opinion2"><?=GetMessage("REPOST_ONLY");?></p>
<? endif; ?>
<div style="clear: both;"></div>
<!--<p class="social_opinion social_opinion2"><?=GetMessage("AUTH_PLEASE_REG4");?></p>-->
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
		 $.post("/ajax/authoriz_by_email.php",{email:_val, chekcode:<?=$arParams["CHEKCODE"]?>}, function(data){
				if(parseInt(data)==1){
					$('.error_answ').html('');
					var location = window.location.href;
					window.location = location.replace('#','') + "?check=1";
				}else{
					$('.error_answ').html(data);	
				}
			});
	}
</script>
<style>
	.btn_go{
		text-transform: uppercase;
		font-size: 13px;
   		*width: 30%;
	}
	.email_conf_div{
		display: block;
    	vertical-align: middle;
   		margin-top: 15px;
	}
	a#email_conf{
		height:79px;
		background: url('/images/email.png') no-repeat;
	}
	a#email_conf:hover{
		background: url('/images/email_hover.png') no-repeat;
	}
	
	input.email_conf {
    	width: 50%;
   		height: auto;
    	padding: 5px;
    	text-transform: none !important;
    	*width: 398px;
    	background: #fff !important;
   		border: 2px solid #e9ecf0 !important;
    	box-shadow: 0 -4px 0 #fff inset !important;
		color: #5d7395;
		border-radius: 3px;
	}
	a#email_send{
		height: auto;
	 	padding: 5px;
    	*padding-bottom: 10px;
    	*width: 50%;
    	margin-top: 20px;
		border-radius: 3px !important;
	}
	
	a#email_send:hover{
		background: #7f93b1 !important;
		border: 1px solid #000000 !important; 
	}

/*	a#email_send:hover{
		text-decoration:none !important;
		box-shadow: 0px 0px 12px #5689b6 inset !important;
	}*/
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
		*padding-top:35px;
		font-size:25px;
		font-weight: bold;
		color:#5d7395;
		text-align: center;
		width: 740px;
		text-transform: uppercase;
	}
	.social_opinion2{
		padding-top:10px;
		font-weight: normal;
		font-size:15px;
		color:#000;
		text-align: center;
		width: 740px;
		text-transform: uppercase;
	}
</style>
