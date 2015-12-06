<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? 
CModule::IncludeModule("iblock");
$mrh_pass2 = "7Qq9hoK9WU";
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$shp_item = $_REQUEST["shpItem"];
$crc = $_REQUEST["SignatureValue"];

$_REQUEST["InvId"] = preg_replace("/0959$/", '', $_REQUEST["InvId"]);

$crc = strtoupper($crc);

$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass2:shpItem=$shp_item"));

// проверка корректности подписи
// check signature
//if ($my_crc !=$crc)
//{
 // echo "bad sign\n";
 // exit();
//}

$arFilter = Array(
   "IBLOCK_TYPE"=>"clips", 
  "ACTIVE"=>"Y", 
  "ID"=>intval($_REQUEST["InvId"])
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_TYPE_CLIP","PROPERTY_USER_EMAIL","PROPERTY_USER_NAME","PROPERTY_PAID", "PROPERTY_USER", "PROPERTY_VIDEO","PROPERTY_FILE_LINK","PROPERTY_TELL_FRIENDS","PROPERTY_YOUTUBE"));
$clip = $res->GetNext();
if ($shp_item == 10){
	$itemID=intval($_REQUEST["InvId"]);
	helpertools::unBlockUser(array("ID"=>$itemID));
	echo "OK$inv_id";
	exit();
}
if ($shp_item == 7)
{
	$_REQUEST["InvId"] = intval($_REQUEST["InvId"])/1000;
	$arFilter = Array(
	    "IBLOCK_TYPE"=>"clips",
	    "ACTIVE"=>"Y",
	    "ID"=>intval($_REQUEST["InvId"])
	   );
	   
	   
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_TYPE_CLIP","PROPERTY_USER_EMAIL","PROPERTY_USER_NAME","PROPERTY_PAID", "PROPERTY_USER", "PROPERTY_VIDEO","PROPERTY_FILE_LINK","PROPERTY_TELL_FRIENDS","PROPERTY_YOUTUBE"));
	$clip = $res->GetNext();
	
	if($clip["PROPERTY_TELL_FRIENDS_ENUM_ID"]){
		echo "Вы уже оплатили!";
	}else{
		$el = new CIBlockElement;
		$upd_arr["TELL_FRIENDS"] = '49';
		$res = $el->SetPropertyValuesEx($_REQUEST["InvId"], false, $upd_arr);
		
		if(file_exists("/home/admin/wait_zakaz/".intval($_REQUEST['InvId'])."_33/")){
			rename("/home/admin/wait_zakaz/".intval($_REQUEST['InvId'])."_33/", "/home/admin/zakaz/".intval($_REQUEST['InvId'])."_33/");
			$arLoadProductArray = Array(
				"MODIFIED_BY"    => 1,
				"DATE_CREATE"    => ConvertTimeStamp(time(), "FULL"),
				"IBLOCK_SECTION" => false,
				"ACTIVE"         => "Y"
			);
			echo $el->Update(intval($_REQUEST['InvId']), $arLoadProductArray);
		}
		
		$uploaddir_texts = '/home/admin/zakaz/'.$_REQUEST["InvId"].'_33/';
		$fp = fopen($uploaddir_texts.'paid.txt', 'w');
		
		fwrite($fp, "1");
		fclose($fp);
		
		echo "OK$inv_id";
	}
	exit();
}

if($clip["PROPERTY_PAID_VALUE"]){
	echo "Вы уже оплатили!";
}else{

$el = new CIBlockElement;
$PROP = array();
$PROP[108] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$clip['PROPERTY_FILE_LINK_VALUE']);
$PROP[110] = $clip['PROPERTY_TYPE_CLIP_VALUE'];
$PROP[107] = $clip['PROPERTY_USER_EMAIL_VALUE'];
$PROP[106] = $clip['PROPERTY_USER_NAME_VALUE'];
$PROP[209] = $clip['PROPERTY_USER_VALUE'];
$PROP[218] = $clip['PROPERTY_TELL_FRIENDS_ENUM_ID'];
$PROP[217] = $clip['PROPERTY_YOUTUBE_VALUE'];
$PROP[109] = 5;
$best_order = false;
if(file_exists('/home/admin/best_zakaz/'.$_REQUEST["InvId"].'_33/')){
	$arFilterB = array("IBLOCK_ID"=>"35", "PROPERTY_USER" => $clip['PROPERTY_USER_VALUE']);
	$res_b = CIBlockElement::GetList(Array("TIMESTAMP"=>"DESC"), $arFilterB, false, false, array("NAME","ID", "PROPERTY_USER", "PROPERTY_IP","PROPERTY_COUNT_BEST_CLIPS","PROPERTY_ORDERS_COUNT"));
	$clip_b = $res_b->GetNext();
	$PROP_B = array();
	$PROP_B[211] = $clip_b['PROPERTY_USER_VALUE'];
	$PROP_B[180] = $clip_b['PROPERTY_IP_VALUE'];
	$PROP_B[220] = $clip_b['PROPERTY_COUNT_BEST_CLIPS_VALUE'] ? ($clip_b['PROPERTY_COUNT_BEST_CLIPS_VALUE'] + 1) : 1;
	$PROP_B[183] = $clip_b['PROPERTY_ORDERS_COUNT_VALUE'];
	$el_b = new CIBlockElement;
	$arLoadProductArray = Array(
 		"MODIFIED_BY"    => 1,
		"IBLOCK_SECTION" => false,
		"PROPERTY_VALUES"=> $PROP_B,
		"ACTIVE"         => "Y"
	);
	$res_b = $el_b->Update($clip_b["ID"], $arLoadProductArray);

	$best_order = true;
	$uploaddir = '/home/admin/zakaz/'.$_REQUEST["InvId"].'_33/';
	rename('/home/admin/best_zakaz/'.$_REQUEST["InvId"].'_33/', $uploaddir);
	$fp = fopen($uploaddir.'paid.txt', 'w');
	fwrite($fp, "1");
	fclose($fp);
	
	$fp = fopen($uploaddir.'wait_24.txt', 'w');
	fwrite($fp, "0");
	fclose($fp);
	
	$fp = fopen($uploaddir.'check_list.txt', 'a+');
	fwrite($fp, "paid.txt
	");
	fclose($fp);
}
//if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/paid_clip/'.$_REQUEST["InvId"].'/')) {
  //  mkdir($_SERVER['DOCUMENT_ROOT'].'/paid_clip/'.$_REQUEST["InvId"].'/', 0755, true);
//}

//$old_path =$_SERVER['DOCUMENT_ROOT'].CFile::GetPath($clip['PROPERTY_VIDEO_VALUE']);
//$file_name = rand(999,9999).'.mp4';
//$file_path = $_SERVER['DOCUMENT_ROOT'].'/paid_clip/'.$_REQUEST["InvId"].'/'.$file_name;
//copy($old_path,$file_path);

//$PROP[127] = '/paid_clip/'.$_REQUEST["InvId"].'/'.$file_name;

$PROP[127] = $clip['PROPERTY_FILE_LINK_VALUE'];

$arLoadProductArray = Array(
 	"MODIFIED_BY"    => 1,
	"IBLOCK_SECTION" => false,
	"PROPERTY_VALUES"=> $PROP,
	"ACTIVE"         => "Y"
);
	 
$res = $el->Update($_REQUEST["InvId"], $arLoadProductArray);


$arFields = array(

		"NAME" => $clip['PROPERTY_USER_NAME_VALUE'],

		"EMAIL" => $clip['PROPERTY_USER_EMAIL_VALUE'],

		"LINK" => 'http://'.$_SERVER['HTTP_HOST'].'/clip/?num='.$_REQUEST["InvId"],
		
		"DAWNLOAD" => 'http://'.$_SERVER['HTTP_HOST'].$clip['PROPERTY_FILE_LINK_VALUE']

);
	 
$site_id = (isset($_REQUEST['lang']) && $_REQUEST['lang'] == 'en')? "en":"s1";
if(!$_REQUEST['no_send_mess']){
	CEvent::SendImmediate($best_order ? "CLIP_PAID_BEST":"CLIP_PAID", $site_id, $arFields);
}



echo "OK$inv_id";
}
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>