<?
$aMenuLinks = Array(
	Array(
		"Главная", 
		"/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Cоздать слайд-шоу", 
		"/#menu-choose", 
		Array(), 
		Array("id"=>"show_steps"), 
		"" 
	),
	Array(
		"Цены", 
		"/#menu-pricing", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"О нас", 
		"/#menu-about", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Инструкция", 
		"/#menu-instruction", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Контакты", 
		"/#menu-contact", 
		Array(), 
		Array(), 
		"" 
	)
);
if($USER->IsAuthorized()){
	unset($aMenuLinks[4]);
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
	if($arUser['PERSONAL_PHOTO']){
		$file = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], array('width'=>50, 'height'=>50), BX_RESIZE_IMAGE_EXACT, true);                
        $menu_str = '<img style="border-radius: 100px; box-shadow: 0 0 0 3px green, 0 0 13px #333;" alt="Мой кабинет" src="'.$file['src'].'" width="50" height="50" border="0" /> <span style="padding-left:6px;">Мой кабинет</span>';
	}else{
		$menu_str = '<img style="border-radius: 100px; box-shadow: 0 0 0 3px green, 0 0 13px #333;" alt="Мой кабинет" src="/incognito.jpg" width="50" height="50" border="0" /> <span style="padding-left:6px;">Мой кабинет</span>';
	}
	
	
	$aMenuLinks[] = Array(
		$menu_str, 
		"/profile/", 
		Array(), 
		Array(), 
		"" 
	);
}

?>