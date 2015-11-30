<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$arFields = array(

		"LINK" => "123",
		"NAME" => "123",

	 );
CEvent::SendImmediate('ORDER_CLIP', 'en', $arFields);
?> <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>