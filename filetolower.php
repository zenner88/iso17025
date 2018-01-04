<?php

if ($dir = @opendir(".")) {
  while($file = readdir($dir)) {
		echo "Ubah file $file...";
		if ($file!="." && $file!="..") {
			if (is_dir($file)) {
					$dir2=@opendir($file);
					  while($file2 = readdir($dir2)) {
							if ($file2!="." && $file2!="..") {
								echo "Ubah file $file2...";
								rename($file."\\".$file2,strtolower($file."\\".$file2));
							}
					  }  
					closedir($dir2);
			}
			@rename($file,strtolower($file));
		}
  }  
  closedir($dir);
}

?>
      
