<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?php
require $_SERVER['DOCUMENT_ROOT'].'/api/src/Instagram.php';
use MetzWeb\Instagram\Instagram;
$config = array(
  'apiKey'        => '00efa1acd4a74785a8010d3a47ee6513',
  'apiSecret'     => '501b77272a8b42eb96059c87494798cb',
  'apiCallback'   => 'http://fromfoto.com/api/instaoath.php',
);
$instagram = new Instagram($config);
if($_SESSION['IACCESS_TOKEN']) {      
    // поиск фотографий пользователя
    $media = $instagram->getUserMedia($_SESSION['IACCESS_TOKEN']->user->id, $_POST['limit'], $_POST['offset']);  
    if (count($media->data) > 0) {
		foreach ($media->data as $item) {
				?>
				<li class="show_popup ui-sortable-handle">
					<img 
						href="<?=$item->images->standard_resolution->url;?>" 
						src="<?=$item->images->thumbnail->url;?>" 
					/>
				</li>
				<?
		}
	}?>
	<? if(count($media->data) == $limit): ?>
		<li offset="<?=$media->pagination->next_max_id; ?>" class="offset_photo" style="display:none;" >offset</li>
	<? endif; ?>
<?}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>