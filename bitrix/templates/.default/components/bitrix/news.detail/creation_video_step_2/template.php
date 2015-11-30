<div style="min-height:300px">
</div>

<div class="popup">
	<div class="popup-container with_border" style="margin: 0 auto 0; top: 20px;">
		<div class="wait popup-wait" style="text-align: center;">
			<div class="content-title bold-title" style="text-decoration: uppercase; color: #5d7395; font-family: 'One_Days'; font-weight: normal; line-height: 25px;">
				ВАШ ЗАКАЗ ОБРАБАТЫВАЕТСЯ, это займет 2-3 минуты.<br />
				НЕ ЗАКРЫВАЙТЕ СТРАНИЦУ!
				<br />
				<img style="height: 50px; margin-top: 5px;" src="<?=SITE_TEMPLATE_PATH?>/images/preload.gif" />
				<br /><br />
				<iframe frameborder="0" src="//www.youtube.com/embed/beTu5telWXk?rel=0&amp;autoplay=1&amp;fs=1&amp;loop=0&amp;modestbranding=1&amp;showinfo=0&amp;loop=1&amp;hd=1&amp;controls=0&amp;"></iframe>
			</div>
			
		</div>
	</div>
</div>
<script>
	setInterval(function(){
		$.post("<?=SITE_DIR?>ajax/test_face.php", { PRODUCT_ID : "<?=$arResult["ID"]; ?>" }, function(data){
			if(data == "ok"){
				window.location = "/step_three/?PRODUCT_ID=<?=$arResult["ID"]; ?>";	
			}
		});
	}, 10*1000);
</script>