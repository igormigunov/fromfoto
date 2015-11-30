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
</footer>
</body></html>