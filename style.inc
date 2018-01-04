<?


	$borderdata=" border=1 cellpadding=4 
	cellspacing=0 bordercolor=#eeeeff width=95%";
	$bordercetak=" width=1000  cellpadding=2 cellspacing=0 border=1  bordercolor=#000000 style='font-family:Arial;font-size:8pt;color:#000000;border-collapse:collapse;'";
	$bordercetakA4P=" width=600  cellpadding=2 cellspacing=0 border=1  bordercolor=#000000 style='font-family:Arial;font-size:8pt;color:#000000;border-collapse:collapse;'";


$fnhead="#ffffff";
	$style= "
			<style type=\"text/css\">
			<!--
			table.judulmenukecil {  
				background-color: #ffffff ;
				padding-top: 4;				
				padding-left: 4;				
				padding-bottom: 4;				
				padding-right: 4;				
				width=95%;
				border-collapse:collapse;
				font-family: Arial;
				font-size:10pt;
				font-weight:bold;
			}
			table.judulmenu {  
				background-color:#ccddff ;
				padding-top: 4;				
				padding-left: 4;				
				padding-bottom: 4;				
				padding-right: 4;				
				width=95%;
				border-collapse:collapse;
				font-family: Verdana;
				font-size:11pt;
				font-weight:bold;
				color:#002244;
			}
			td.judulmenu {  
				font-size:11pt;
				font-weight:bold;
				font-family: Verdana;
			}
			table.login {  
				color:#ffffff;
			}
			table.head {  
				background-color: #224488;
				border-collapse:collapse;
				width:100%;  			
			}
			 .footer {  
				background-color: #332277;
				border-collapse:collapse;font-size:8pt;
				color:#ffffff;
				width:770;  			
			}
			.menu {  
				background-color: #aabbee;
				border-collapse:collapse;
				font-size:9pt;
			}
			.cari {  
				background-color: #aabbee;
				border-collapse:collapse;
			}
			.welcome {  
				background-color: #992255;
				border-collapse:collapse;
				color:#ffffff;
 			}
			.welcome {  
				background-color: #992255;
				border-collapse:collapse;
				color:#ffffff;
				font-size:8pt;
			}			
			
			table.data {  
				border-collapse:collapse;
			}
			table.utama {  
				height=80%;
				border-collapse:collapse;background-color: #ffffff;
				width:770;  			
			}
			table.utama2 {  
				height=70%;
				border-collapse:collapse;
				background-color: #ffffff;
 			}
			table.utama3 {  
				height=80%;
				border-collapse:collapse;background-color: 
				#ffffff;
 			}
			 .utama2 {  
 				border-collapse:collapse;background-color: #EEEEff;
				width:770;  			
				background-color: #ffffff;
 			}
			tr.judulsubmenu {  
				font-size:11pt;
				font-weight:bold;
				font-family: Verdana;
				background-image: url('".$root."gambar/atassubmenu.gif');
			}
			td.judulsubmenu {  
				background-image: url('".$root."gambar/atassubmenu.gif');
 				font-size:8pt;
				font-weight:bold;
				font-family: Verdana;
				color: #224488; 
			}
			
			.submenu {
			background-color: #334499;
			width:150;
			}
			.submenu2 {
			background-color: #ffffff;
			width:150;
			}
			body {  position: static; background-color:  #eeeeee 	; background-position: center top; font-size: small; font-style: normal; 
			font-weight: bolder; color: $warnateks; border: medium #FFFFFF solid; list-style-position: outside; list-style-type: circle;
			margin-top:0;margin-left:0;margin-right:0;margin-bottom:0;;
			}
			.cetak {position: static; background-color: #ffffff; background-position: center top; font-size: small; font-style: normal; 
			font-weight: bolder; color: #000000; border: medium #FFFFFF solid; list-style-position: outside; list-style-type: circle;
			margin-top:0;margin-left:0;margin-right:0;margin-bottom:0; width=600;
			}
			.page { page-break-after: always }
			.datautamagenap {  
				background-color: #eedd99;
				border-collapse:collapse;
				color:#000077;
			}			
			.datautamaganjil {  
				background-color: #88ddff;
				border-collapse:collapse;
				color:#000077;
			}			
			tr.judulkolomsm {  background-color: #3366bb;font-size:11pt;font-family:Arial;font-weight:bold;color:#ffffff}
			tr.dataganjilsm {  color: #000000; background-color: #88AAee;font-size:9pt;font-family:Arial;}
			tr.datagenapsm {  color: #000000; background-color: #ffffee;font-size:9pt;font-family:Arial;}



			input {  font-family: Arial, Helvetica, sans-serif; 
			background-color: #ffffff; ;  
			font-size:8pt; 
               padding-bottom: 1}
			select {  font-family: Arial, Helvetica, sans-serif; background-color: #ffffff; 
			border: 1px outset #000000; padding-left: 0; padding-right: 0; padding-top: 0;
			font-size:8pt; 
               padding-bottom: 1}

			textarea {  font-family: Arial, Helvetica, sans-serif; 
			background-color: #ffffff; ;border: 1px outset #000000; 
			padding-left: 0; padding-right: 0; padding-top: 0;font-size:8pt; 
               padding-bottom: 1}

			h3 {font-family:Arial;font-size:12pt;}
			
			table {
			font-family=Arial;
			font-size:8pt;
			width:95%;
			
			}

			table.cetak {  
				width:1000px;
				border-size:1;
				background-color: #338833;
				border-collapse:collapse;
			}

			table.cetak2 {  
				font-family=Arial;
				font-size:8pt;
				width:400;
			}


			a:link {  color: #000099;text-decoration:none;}
			a:visited {  color: #000099;text-decoration:none;}
			a:active {  color: #000099;text-decoration:none;}
			a:hover {  color: #990000;text-decoration:none;}

			a.xx:link {  color: #000099;text-decoration:none;
			font-family:Verdana;
			font-size:7pt;
			}
			a.xx:visited {  color: #000099;text-decoration:none;
			font-family:Verdana;
			font-size:7pt;
			}
			a.xx:active {  color: #000099;text-decoration:none;
			font-family:Verdana;
			font-size:7pt;
			}
			a.xx:hover {  color: #990000;text-decoration:none;
			font-family:Verdana
			font-size:7pt;
			}

			tr.judulkolomkecil {  background-color: #bbbbbb;font-size:7pt;font-family:Arial;font-weight:bold}
			tr.judulkolom {  background-color: #dddddd;font-size:8pt;font-family:Arial;font-weight:bold}
			td.judulkolom {  background-color: #666699}
			td.data {  background-color: #aaaabb; color: #000000}
			tr.dataganjil {  color: #000000; background-color: #ddddee;font-size:8pt;font-family:Arial;}
			tr.datagenap {  color: #000000; background-color: #eeeeee;font-size:8pt;font-family:Arial;}
			tr.pesanbaru {  color: #000000; background-color: #bbbbff;font-size:9pt}
			tr.pesanlama {  color: #000000; background-color: #bbbbbb;font-size:9pt}

			tr.dataganjilkecil {  color: #000000; background-color: #ddddee;font-size:7pt;font-family:Arial;}
			tr.datagenapkecil {  color: #000000; background-color: #eeeeee;font-size:7pt;font-family:Arial;}


			tr.dataganjildetil {  color: #000000; background-color: #ccddcc;font-size:8pt;font-family:Arial;}
			tr.datagenapdetil {  color: #000000; background-color: #ddddee;font-size:8pt;font-family:Arial;}

			tr.judulkolomkecilcetak {  color: #000000;background-color: #ffffff;font-size:7pt;font-family:Arial;font-weight:bold}
			tr.dataganjilkecilcetak {  color: #000000; background-color: #ffffff;font-size:7pt;font-family:Arial;}
			tr.datagenapkecilcetak {  color: #000000; background-color: #ffffff;font-size:7pt;font-family:Arial;}

			tr.judulkolom2 {  background-color: #aaaaaa;font-size:8pt;font-weight:bold;font-family:Arial;}
			tr.dataganjil2 {  color: #000000; background-color: #eeeeee;font-size:8pt;font-family:Arial;}
			tr.datagenap2 {  color: #000000; background-color: #cccccc;font-size:8pt;font-family:Arial;}

			tr.judulkolomisi {  background-color: #5555bb;font-size:9pt;color:#ffffff}
			hr {color:#5555bb;border-collapse:collapse;size:1px}


			a.datagenap:link {  color: #006600;text-decoration:none}
			a.datagenap:visited {  color: #FF9999;text-decoration:none}
			a.datagenap:active {  color: #99FF99;text-decoration:none}
			a.datagenap:hover {  color: #FF3333;text-decoration:none}

			a.dataganjil:link {  color: #000099;text-decoration:none}
			a.dataganjil:visited {  color: #FFFF99;text-decoration:none}
			a.dataganjil:active {  color: #99FF99;text-decoration:none}
			a.dataganjil:hover {  color: #FF3333;text-decoration:none}
			
			
			-->
			</style>";

?>