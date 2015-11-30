<?
	if(isset($_POST['clips'])){
		foreach($_POST['clips'] as $k=>$v){
			$filename = "/home/admin/zakaz/".$v."/wait_24.txt";
			if(file_exists($filename)){
				$handle = fopen($filename, "w+");
				fwrite($handle,"12345");
				fclose($handle);
			}
		}	
	}

?>