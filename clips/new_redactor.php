<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);
$APPLICATION->SetTitle("�������� �����");?>
<?
if($_REQUEST["state"]){
	$_REQUEST["video_id"] = ret_param(urldecode($_REQUEST["state"]), video_id);
	$_SESSION["state_auth"] = $_REQUEST["state"];
}
global $USER;
if(!$USER->IsAuthorized() && !$_REQUEST["state"]){
	unset($_SESSION["user_clip_data"]);
}
if($_REQUEST["video_id"]){
	$_SESSION["video_id"] = $_REQUEST["video_id"];
}
if(!$_REQUEST["video_id"] && $_SESSION["video_id"]){
	LocalRedirect("/create_video/?ok_auth=1&video_id=".$_SESSION["video_id"]);
}
?>
<? $APPLICATION->IncludeComponent("bitrix:news.detail", "creation_video_18082015", Array(
	"DISPLAY_DATE" => "Y",	// �������� ���� ��������
	"DISPLAY_NAME" => "Y",	// �������� �������� ��������
	"DISPLAY_PICTURE" => "Y",	// �������� ��������� �����������
	"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"IBLOCK_TYPE" => "clips",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "",	// ��� ��������������� �����
	"ELEMENT_ID" => $_REQUEST["video_id"],	// ID �������
	"ELEMENT_CODE" => "",	// ��� �������
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"FIELD_CODE" => array(	// ����
		0 => "PREVIEW_PICTURE",
	),
	"PROPERTY_CODE" => array(	// ��������
		0 => "VIDEO_WEBM",
		1 => "VIDEO_MP4",
		2 => "VIDEO_OGV",
		3 => "COST",
		4 => "CURRENCY",
		5 => "TEXTS",
		6 => "PHOTO",
		7 => "NAME_AE",
		8 => "AUDIO_MP3",
		9 => "FREE_PERIOD",
		10 => "VIDEO_COST",
		11 => "LOGO_SIZE",
		12 => "WITH_LOGO",
		13 => "PREV_VIMEO",
		14 => "FREE_PRICE",
		15 => "PREV_VIMEO2",
	),
	"IBLOCK_URL" => "news.php?ID=#IBLOCK_ID#\"",	// URL �������� ��������� ������ ��������� (�� ��������� - �� �������� ���������)
	"META_KEYWORDS" => "KEYWORDS",	// ���������� �������� ����� �������� �� ��������
	"META_DESCRIPTION" => "DESCRIPTION",	// ���������� �������� �������� �� ��������
	"BROWSER_TITLE" => "BROWSER_TITLE",	// ���������� ��������� ���� �������� �� ��������
	"DISPLAY_PANEL" => "N",
	"SET_TITLE" => "Y",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
	"USE_PERMISSIONS" => "N",	// ������������ �������������� ����������� �������
	"GROUP_PERMISSIONS" => array(
		0 => "1",
	),
	"CACHE_TYPE" => "N",	// ��� �����������
	"CACHE_TIME" => "3600",	// ����� ����������� (���.)
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"DISPLAY_TOP_PAGER" => "Y",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
	"PAGER_TITLE" => "��������",	// �������� ���������
	"PAGER_TEMPLATE" => "",	// ������ ������������ ���������
	"PAGER_SHOW_ALL" => "Y",	// ���������� ������ "���"
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	),
	false
);?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>