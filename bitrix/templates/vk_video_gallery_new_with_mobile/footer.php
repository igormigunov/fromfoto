</div>
</div>
<!-- content -->
<div class="links_footer" style="text-align: left; min-height: 15px;">
     <?/*<a href="/news/klip_iz_foto/">Инструкция по работе с сервисом</a> | 
	<a href="/news/">Полезные статьи</a>*/?>
  </div>
  <div style="clear: both;"></div>
<footer>
  <div class="copyright"><?=date("Y");?>, FROMFOTO, Ltd</div>
  <div class="support">ТЕХ. ПОДДЕРЖКА СЕРВИСА: <a href="mailto:fromfoto.com@gmail.com">fromfoto.com@gmail.com</a></div>
  <div class="social">
  <? $APPLICATION->IncludeFile(
		$APPLICATION->GetTemplatePath("include_areas/social.php"),
		Array(),
		Array("MODE"=>"html")
	);?>
  </div>
  <?
  global $USER;
  if (!CModule::IncludeModule("iblock")) die();
  $rs = CIblockElement::getList(array(), array("IBLOCK_ID" => 35,"ACTIVE"=>"Y", array(
      "LOGIC" => "OR",
      array("PROPERTY_IP" => $_SERVER["REMOTE_ADDR"],),
      array("PROPERTY_USER" => $USER->getID()),
  )), false, false, array("ID","PROPERTY_BLOCK_FOR"))->fetch();
 if(MakeTimeStamp($rs["PROPERTY_BLOCK_FOR_VALUE"])>=time()):

     $m_shop = S_SHOP;
     $inv_id = $rs['ID'].'0959';
     $inv_desc = base64_encode("Оплата недельной блокировки");
     $m_key = S_KEY;
     $mrh_login = "fromfoto";
     $mrh_pass1 = "7Qq9hoK9WU";
     $shp_item = 10;
     $culture = $land;
     $encoding = "utf-8";
     $def_sum = 100;
     $crc  = md5("$mrh_login::$inv_id:$mrh_pass1:shpItem=$shp_item");
  ?>
  <div class="popup" id="popLimit" style="display: none;">
    <div class="popup-container with_border" style="margin: -320px auto 0; top: 50%;">
      <div class="content-title bold-title lh-0" style="text-align: center">
        <img src="<?=SITE_TEMPLATE_PATH?>/images/oops.jpg" alt="">
          <? print_r($rs["PROPERTY_BLOCK_FOR_VALUE"])?>
      </div>
      <div class="content-title bold-title lh-0">
<div class="fdays" style="padding: 0 20px">
          <span class="redd">создание видео - долгий процесс!</span> к сожалению, Вы превысили свой
          недельный <span class="redd">бесплатный</span> лимит. зайдите к нам позже, либо
          оплатите 100р. и создайте ещё несколько клипов. <br>
    <a href="javascript:void(0)" onclick="$('#PayFormLimit').submit()" class="button-slide button-slide1 ttu"  style="margin-top: 30px">оплатить 100р.</a>
</div>

      </div>
    </div>
  </div>
     <form action='https://auth.robokassa.ru/Merchant/Index.aspx' method="POST" style="display: none;" id="PayFormLimit">
         <input type="hidden" name="MrchLogin" value="<?=$mrh_login?>" />
         <input type="hidden" name="FreeOutSum" value="<?=$def_sum?>" id="DefaultSum" />
         <input type="hidden" name="InvoiceID" value="<?=$inv_id?>" />
         <input type="hidden" name="Description" value="<?=$inv_desc?>" />
         <input type="hidden" name="SignatureValue" value="<?=$crc?>" id="SignatureValue" />
         <input type="hidden" name="shpItem" value="<?=$shp_item?>" id="shpItem" />
         <input type="hidden" name="Culture" value="<?=$culture?>" />
         <input type="hidden" name="Encoding" value="<?=$encoding?>" />
         <input type="submit" value="Оплаить" style="display: none;" id="PauSubmit"/>
     </form>
     <script>
         $('#popLimit').show();
     </script>
     <style>
         .button-slide.button-slide1 {
             display: inline-block;
             height: 35px;
             line-height: 35px;
             min-width: 50px;
             padding: 0 25px;
             font-size:11px
         }
     </style>
  <? endif;?>
</footer>
</body></html>