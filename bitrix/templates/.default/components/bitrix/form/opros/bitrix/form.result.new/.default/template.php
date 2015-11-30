<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<div class="form_opros">
<div class="arrow"></div>
<div class="arrow-border"></div>
<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>


<? //=$arResult["FORM_NOTE"]?>

<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<div class="descr_form">
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?><?
/***********************************************************************************
					form header
***********************************************************************************/
	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<? if(trim($arResult["FORM_DESCRIPTION"])): ?><p><?=$arResult["FORM_DESCRIPTION"]?></p><? endif; ?>
	<?
} // endif
	?>
</div>
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<div class="form_question">
	<?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
	?>
		<div class="question">
            	<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				<span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><?=$arResult["REQUIRED_SIGN"];?><?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
                <br />
				<?=$arQuestion["HTML_CODE"]?>
		</div>
	<?
	} //endwhile
	?>
<?
if($arResult["isUseCaptcha"] == "Y")
{
?>
	<div class="captcha">
		<b><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></b>
		<br /><input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" /><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
        <br /><br /><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
        <br /><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
	</div>
<?
} // isUseCaptcha
?>
<br />
	<div class="send_data">
				<input type="submit" class="silver_btn" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
	</div>
</div>
<p>
<?=$arResult["REQUIRED_SIGN"];?> - <?=GetMessage("FORM_REQUIRED_FIELDS")?>
</p>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>
<? if ((isset($_REQUEST['WEB_FORM_ID'])) && ($arResult["isFormErrors"] != "Y")): ?>
	<p><?=GetMessage("S_THATS_OK");?></p>
	<a download class="opros_after_send" target="_blank" href=""><?=GetMessage("S_DOWNLOAD");?></a>
	<script>
		$('.opros_after_send').attr('href',$('.opros_before').attr('href'));
		setcookie("ALREADY_SEND","1",3600*24*365,"/");
	</script>
<? endif; ?>

</div>
<style>
	.form_opros{
      	background:#FFF;
     	border:solid 1px #BBBBBB;
      	border-radius:5px;
      	box-shadow:0px 0px 15px #999;
		margin: auto;
   		width: 330px;
		margin-top: 10px;
	}
	.arrow {
 		 border-bottom: 11px solid #fff;
 		 border-left: 11px solid transparent;
		 border-right: 11px solid transparent;
 		 height: 0;
 		 left: 48%;
 		 position: relative;
  		 top: -11px;
 		 width: 0;
 		 z-index: 1001;
	}

      .arrow-border {
 		 border-bottom: 11px solid #bbbbbb;
 		 border-left: 11px solid transparent;
 		 border-right: 11px solid transparent;
 		 height: 0;
 		 left: 48%;
 		 position: relative;
 		 top: -24px;
 		 width: 0;
 		 z-index: 1000;
	}
	.form_opros input[type="text"]{
		width:290px !important;
	}
	.form_opros textarea{
		width:290px !important;
	}
	
	.silver_btn{
	background:#bbbbbb;
	background-image:-webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #f5f2f2), color-stop(100%, #bbbbbb));
	background-image:-webkit-linear-gradient(top, #f5f2f2,#bbbbbb);
	background-image:-moz-linear-gradient(top, #f5f2f2,#bbbbbb);
	background-image:-o-linear-gradient(top, #f5f2f2,#bbbbbb);
	background-image:linear-gradient(top, #f5f2f2,#bbbbbb);
	
	
	
	
	
	border: none;
	-webkit-box-shadow: 0px 2px 1px 1px rgba(146, 146, 146, 1);
	-moz-box-shadow:    0px 2px 1px 1px rgba(146, 146, 146, 1);
	box-shadow:         0px 2px 1px 1px rgba(146, 146, 146, 1);
	-webkit-border-radius:50px;
	-moz-border-radius:50px;
	-ms-border-radius:50px;
	-o-border-radius:50px;
	border-radius:50px;
	
	color: #333333;
    font-size: 21px;
	padding:4px 20px 0;
	text-transform:uppercase;
}

.silver_btn:hover{
	-webkit-box-shadow: 0px -1px 1px 1px rgba(146, 146, 146, 1);
	-moz-box-shadow:    0px -1px 1px 1px rgba(146, 146, 146, 1);
	box-shadow:         0px -1px 1px 1px rgba(146, 146, 146, 1);
}
</style>