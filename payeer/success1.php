<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>
<?
$mrh_pass1 = "7Qq9hoK9WU";
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$shp_item = $_REQUEST["shpItem"];
$crc = $_REQUEST["SignatureValue"];

$crc = strtoupper($crc);

$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:shpItem=$shp_item"));

//if ($my_crc != $crc) { echo "bad sign\n"; exit(); } 

if ($shp_item == 7)
{
	?>
	<div class="klip-text" style="margin: 24px auto 25px;">
		<div class="klip-text-title">Операция по оплате ускорения проведена успешно!</div>
		<div class="klip-text-title">Если клип еще не готов, информацию о его готовности и страница с его наличием будет выслана Вам по электронной почте.</div>
	</div>
	<?
}else{
	CModule::IncludeModule("iblock");
	$ar_pay_clip_res = CIBlockElement::GetList(array(), array("IBLOCK_ID"=>"33", "ID"=>intval($inv_id), "PROPERTY_PAID" => "5"),false,false,array("PROPERTY_PAID", "PROPERTY_FILE_LINK"));
	if(!($ar_pay_clip = $ar_pay_clip_res->GetNext())){
		echo "Клип не оплачен"; exit();
	}
	$FILE_LINK = $ar_pay_clip['PROPERTY_FILE_LINK_VALUE'];
	download_file($FILE_LINK);
	function download_file($file){ 
		if (file_exists($_SERVER['DOCUMENT_ROOT'].$file) && !is_dir($_SERVER['DOCUMENT_ROOT'].$file)) { 
		?>
			<div class="klip-text">
				<div class="klip-text-title">Отличные новости : у Вас получилось !</div>
			</div>
			<div class="video-done">
				<a href="<?=$file;?>" target="_blank" class="btn_go create_new 1 button-slide" download="<?=$file;?>" onclick="yaCounter25315490.reachGoal('buy');">Скачать видео</a>
			</div>
		<?
		}else{ 
			?>
			<div class="klip-text" style="margin: 24px auto 25px;">
				<div class="klip-text-title">Операция по оплате проведена успешно! Теперь Вы можете скачать свой клип у Вас на странице(когда он будет готов) и мы никогда его не удалим!</div>
				<div class="klip-text-title">Если клип еще не готов, информацию о его готовности и страница с его наличием будет выслана Вам по электронной почте.</div>
			</div>
			<?
		}
	}
}




if(isset($_REQUEST['lang']) && $_REQUEST['lang'] == 'en'){
	LocalRedirect('/en/payeer/success.php');
}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>