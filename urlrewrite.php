<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/examples/my-components/news/#",
		"RULE" => "",
		"ID" => "demo:news",
		"PATH" => "/examples/my-components/news_sef.php",
	),
	array(
		"CONDITION" => "#^/e-store/books/reviews/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/e-store/books/reviews/index.php",
	),
	array(
		"CONDITION" => "#^/e-store/xml_catalog/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/e-store/xml_catalog/index.php",
	),
	array(
		"CONDITION" => "#^/3repost/([0-9]+)/#",
		"RULE" => "param=\$1",
		"ID" => "",
		"PATH" => "/ok/3repost.php",
	),
	array(
		"CONDITION" => "#^/content/articles/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/articles/index.php",
	),
	array(
		"CONDITION" => "#^/1repost/([0-9]+)/#",
		"RULE" => "param=\$1",
		"ID" => "",
		"PATH" => "/ok/1repost.php",
	),
	array(
		"CONDITION" => "#^/repost/([0-9]+)/#",
		"RULE" => "param=\$1",
		"ID" => "",
		"PATH" => "/ok/repost.php",
	),
	array(
		"CONDITION" => "#^/en/content/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/en/content/news/index.php",
	),
	array(
		"CONDITION" => "#^/e-store/books/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/e-store/books/index.php",
	),
	array(
		"CONDITION" => "#^/content/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/content/news/index.php",
	),
	array(
		"CONDITION" => "#^/content/faq/#",
		"RULE" => "",
		"ID" => "bitrix:support.faq",
		"PATH" => "/content/faq/index.php",
	),
	array(
		"CONDITION" => "#^/en/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/en/news/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>