<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)):?>

<? 
	$sel_section = ($_REQUEST['section'])? $_REQUEST['section']:94;
	if($arParams["BEST_PAGE"] && $arParams["BEST_PAGE"] == 'Y'){
		foreach($arResult as $k=>$v){
			if($v['PARAMS']['UF_BEST'] && $v['DEPTH_LEVEL'] == '1'){
				$sel_section = $v['PARAMS']['ID'];
				break;
			}
		}	
	}

?>

<ul class="works-filter clips parent_clips">

	<? /*<li class="selected"><a href="#" data-filter="*"><span><?=GetMessage("S_ALL")?></span></a></li>*/ ?>
	<? $num = 0; ?>
	<? foreach($arResult as $k=>$v): ?>
    	<? $num++; ?>
			
		<? if($v['DEPTH_LEVEL'] == '1'): ?>
			<?
            	$class = (!$v['PARAMS']['UF_BEST'] && $arParams["BEST_PAGE"]) ? 'default_behavior' : '';
				$href = (!$v['PARAMS']['UF_BEST'] && $arParams["BEST_PAGE"]) ? '/clips/?section='.$v['PARAMS']['ID'] : '#';	
				$href = ($v['PARAMS']['UF_BEST']) ? '/clips/best/' : $href;	
				$class = ($v['PARAMS']['UF_BEST'] && !$arParams["BEST_PAGE"]) ? 'default_behavior' : $class;		
			?>
        	<li class="<? if($v['PARAMS']['UF_BEST']) :?>best_cat <? endif; ?><? if($sel_section == $v['PARAMS']['ID']): ?>selected<? endif; ?> <? if($num == 1): ?>first_sel_clip<? endif; ?>">
            	<a class="<?=$class; ?>" href="<?=$href; ?>" clip_id="<?=$v['PARAMS']['ID'];?>" id="clip_ch_<?=$v['PARAMS']['ID'];?>" data-filter=".templ_<?=$v['PARAMS']['ID'];?>"><span><?=$v['TEXT'];?></span></a>
            </li>

    	<? endif; ?>

	<? endforeach; ?>

</ul>



<? $parent_id = 0; ?>

<ul class="works-filter clips child_clips">

	<? foreach($arResult as $k=>$v): ?>

    	<? 

		if($v['DEPTH_LEVEL'] == '1'){

			$parent_id = $v['PARAMS']['ID'];

		}

		?>

		<? if($v['DEPTH_LEVEL'] == '2'): ?>

        	<li style="display:none" class="parent_clip_<?=$parent_id; ?>"><a href="#" data-filter=".templ_<?=$v['PARAMS']['ID'];?>"><span><?=$v['TEXT'];?></span></a></li>

    	<? endif; ?>

	<? endforeach; ?>

</ul>



<? endif; ?>