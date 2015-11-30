<?

/*

You can place here your functions and event handlers



AddEventHandler("module", "EventName", "FunctionName");

function FunctionName(params)

{

	//code

}

*/



if(!isset($_COOKIE['UPLOAD_FILES'])){

	setcookie("UPLOAD_FILES", date('ymdHis').rand(99999,9999999), time()+86400*365, "/");

}





function show_tree($array, $level){

	$arURL = explode("?", $_SERVER['REQUEST_URI']);

	$arr_selected = array();

	$level = ($level>1)?2:1;

	echo "<div class='lvl_".$level."'>";

	$selected = ($arURL[0] == $array["LINK"])?'class="selected"':'';

	echo "<a ".$selected." href='".$array["LINK"]."'>âñå</a>";

	foreach($array['items'] as $k=>$arItem){

    	echo "<img width='2' height='12' src='".SITE_TEMPLATE_PATH."/images/navi_deli_inner.png'>";

		$selected = ($arItem["SELECTED"])?'class="selected"':'';

		echo "<a ".$selected." href='".$arItem["LINK"]."'>".$arItem["TEXT"]."</a>";

		if($arItem["SELECTED"]){

			$arr_selected = $arItem;

		}

	}

    echo "</div>";

	if($arr_selected && $arr_selected['items']){

		show_tree($arr_selected, $arr_selected['DEPTH_LEVEL']);

	}

}



function transform2forest($rows, $idName, $pidName) {

        $children = array(); // children of each ID

        $ids = array();

        foreach ($rows as $i=>$r) {

            $row =& $rows[$i];

            $id = $row[$idName];

            $pid = $row[$pidName];

            $children[$pid][$id] =& $row;

            if (!isset($children[$id])) $children[$id] = array();

            $row['items'] =& $children[$id];

            $ids[$row[$idName]] = true;

        }

        // Root elements are elements with non-found PIDs.

        $forest = array();

        foreach ($rows as $i=>$r) {

            $row =& $rows[$i];

            if (!isset($ids[$row[$pidName]])) {

                $forest[$row[$idName]] =& $row;

            }

            unset($row[$idName]); unset($row[$pidName]);

        }

        return $forest;

    }



function check_post_email($email){

	$regex = '/^((\"[^\"\f\n\r\t\v\b]+\")|([\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+(\.[\w\!\#\$\%\&\'\*\+\-\~\/\^\`\|\{\}]+)*))@((\[(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))\])|(((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9]))\.((25[0-5])|(2[0-4][0-9])|([0-1]?[0-9]?[0-9])))|((([A-Za-z0-9\-])+\.)+[A-Za-z\-]+))$/';

	if (preg_match($regex . 'D', $email)) {

		return true;

	}

	return false;

}



function plural_type($n) {

  return ($n%10==1 && $n%100!=11 ? 0 : ($n%10>=2 && $n%10<=4 && ($n%100<10 || $n%100>=20) ? 1 : 2));

} 



$day_commerc = 2;

$day_free = 40;

define('S_SHOP','12623569');
define('S_KEY','1d#234?_sadf');

function sendClipReadyAgent()
{
	if(CModule::IncludeModule("iblock")){
		$arSelect = Array(
			"ID", 
			"IBLOCK_ID",
			"PREVIEW_TEXT",		
			"NAME", 
			"DATE_CREATE", 
			"PROPERTY_USER_EMAIL", 
			"PROPERTY_USER_NAME", 
			"PROPERTY_PAID", 
			"PROPERTY_TELL_FRIENDS", 
			"PROPERTY_ALREADY_SEND",
			"TELL_FRIENDS", 
			"PROPERTY_FILE_LINK",
			"PROPERTY_PREVIEW_VIDEO",
			"PROPERTY_USER",
		);
		$arFilter = array(
			"IBLOCK_ID" => 33,
			"!PROPERTY_FILE_LINK" => '',
			">DATE_CREATE" => ConvertTimeStamp(time()-3600*40, "FULL"),
		);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		$el = new CIBlockElement;
		while($row = $res->GetNext())
		{
			if(((($row['PROPERTY_PAID_VALUE'] || $row['PROPERTY_TELL_FRIENDS_VALUE']) && (strtotime($row['DATE_CREATE'])+2*3600) < time() ) 
				|| (strtotime($row['DATE_CREATE'])+24*3600) < time()) 
				&& $row['PREVIEW_TEXT'] != 'send' 
				&& trim($row['PROPERTY_FILE_LINK_VALUE']) != '' 
			){

				$arLoadProductArray = Array(
					"MODIFIED_BY"    	=> 1, 
					"IBLOCK_SECTION" 	=> false,
					"PREVIEW_TEXT"		=> 'send',
					"ACTIVE"         	=> "Y",
				);

				$PRODUCT_ID = $row['ID'];
				$reslt = $el->Update($PRODUCT_ID, $arLoadProductArray);
				
				$rsUser = CUser::GetByID($row['PROPERTY_USER_VALUE']);
				$arUser = $rsUser->Fetch();
				
				$arFields = array(
					"NAME" => $arUser['NAME'],
					"EMAIL" => $arUser['EMAIL'],
					"LINK_CLIP" => 'http://'.$_SERVER['HTTP_HOST'].'/clip/?num='.$ids[0],
					"LINK" => 'http://'.$_SERVER['HTTP_HOST'].'/fljvrFG/',

				);		 
				$site_id = "s1";
				$TYPE_ORD = ($row['PROPERTY_PAID_VALUE']) ? "BEST_CLIP_READY":"CLIP_READY";
				if($arUser['EMAIL']){
					CEvent::SendImmediate($TYPE_ORD, $site_id, $arFields);
				}
			}
		}
	}
	return "sendClipReadyAgent();";
}

function ret_param($url, $type='video_id'){
	preg_match('/'.$type.'=[^\&]+|'.$type.'.{0,6}=[^\&]+/', $url, $param);
	$param = explode("=",$param[0]);
	return ($param[1]) ? $param[1] : '';
}

function change_share_mobile($desctop="vk.com", $mobile="m.vk.com"){
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/Mobile_Detect.php');
	$detect = new Mobile_Detect;
	if ( $detect->isMobile() ) {
		return $mobile;
	}
	return $desctop;
}

function is_mobile(){
	require_once($_SERVER["DOCUMENT_ROOT"].'/lib/Mobile_Detect.php');
	$detect = new Mobile_Detect;
	return $detect->isMobile();
}


?>