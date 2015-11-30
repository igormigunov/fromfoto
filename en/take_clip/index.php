<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<? require_once($_SERVER["DOCUMENT_ROOT"]."/ajax/yadisk.php");?>

<?
CModule::IncludeModule("iblock");

$clip_ids = array();
foreach($_REQUEST as $k=>$v){
	if(preg_match("/zakaz/",$k)){
		$ids = explode("_",$v);
		$clip_ids[] = $ids[0];
	}
}

$arFilter = Array(
   "IBLOCK_TYPE"=>"clips", 
   "ACTIVE"=>"Y", 
   "ID"=>$clip_ids
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_TYPE_CLIP","PROPERTY_USER_EMAIL","PROPERTY_USER_NAME"));

$ar_clip = array();
$clip_options_id = array();
while($clip = $res->GetNext()){
	$ar_clip[$clip['ID']] = $clip;
	$clip_options_id[] = $clip['PROPERTY_TYPE_CLIP_VALUE'];
}

$arFilter = Array(
   "IBLOCK_TYPE"=>"clips", 
   "ACTIVE"=>"Y", 
   "ID"=>$clip_options_id
   );
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, array("NAME","ID","PROPERTY_FREE_PERIOD"));

$ar_clip_option = array();
while($clip_option = $res->GetNext()){
	$ar_clip_option[$clip_option['ID']] = $clip_option;
}


foreach($ar_clip as $k=>$v){
	$ar_clip[$k]['clip_options'] = $ar_clip_option[$v['PROPERTY_TYPE_CLIP_VALUE']];
}


$conf = new Config();
$logger = new Logger();
$YaAuth = new YaAuth($conf,$logger);
$YaDisk = new YaDisk($YaAuth->getToken(),$conf,$logger);


$videos = array();
foreach($_REQUEST as $k=>$v){
	if(preg_match("/zakaz/",$k)){
		$files = $YaDisk->ls('/'.$v.'/video/');
		if(is_array($files)){
			foreach($files as $k_f=>$v_f){
				if($v_f['type'] == 'f' && preg_match("/\.mp4/",$v_f['href'])){
					$videos[$v] = $v_f['href'];
					break 1;
				}
			}
		}
	}
}

$el = new CIBlockElement;

foreach($videos as $k=>$v){
	$YaDisk->download($v,'/upload/clips/'.$v);
	
	$ids = explode("_",$k);
	
	$PROP = array();
	$PROP[108] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].'/upload/clips/'.$v);
	$PROP[110] = $ar_clip[$ids[0]]['PROPERTY_TYPE_CLIP_VALUE'];
	$PROP[107] = $ar_clip[$ids[0]]['PROPERTY_USER_EMAIL_VALUE'];
	$PROP[106] = $ar_clip[$ids[0]]['PROPERTY_USER_NAME_VALUE'];
	
	$arLoadProductArray = Array(
 	 "MODIFIED_BY"    => 1,
 	 "IBLOCK_SECTION" => false,
 	 "PROPERTY_VALUES"=> $PROP,
 	 "ACTIVE"         => "Y",
	 "ACTIVE_TO"      => (isset($ar_clip[$ids[0]]['clip_options']['PROPERTY_FREE_PERIOD_VALUE']) && $ar_clip[$ids[0]]['clip_options']['PROPERTY_FREE_PERIOD_VALUE'])? date("d.m.Y H:i:s",time()+3600*24*$day_free):date("d.m.Y H:i:s",time()+3600*24*$day_commerc)
 	 );
	 
	 $res = $el->Update($ids[0], $arLoadProductArray);
	 
	 $arFields = array(
		"NAME" => $ar_clip[$ids[0]]['PROPERTY_USER_NAME_VALUE'],
		"EMAIL" => $ar_clip[$ids[0]]['PROPERTY_USER_EMAIL_VALUE'],
		"LINK" => 'http://'.$_SERVER['HTTP_HOST'].'/en/clip/?num='.$ids[0],
	 );
	CEvent::SendImmediate("CLIP_READY", "en", $arFields);
	
	unlink($_SERVER["DOCUMENT_ROOT"].'/upload/clips/'.$v);
}

?>


<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php"); ?>