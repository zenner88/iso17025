<?
  			if ($pilihan=="atambah" || $pilihan=="") {
				include "atambah.php";
			} elseif($pilihan=="aupdate") {
				include "aupdate.php";
			} elseif($pilihan=="perbaiki") {
				include "perbaiki.php";
			} elseif($pilihan=="rupdate") {
				include "restore.php";
			} elseif($pilihan=="btambah") {
				include "btambah.php";
			} elseif($pilihan=="bupdate") {
				include "bupdate.php";
			} elseif($pilihan=="konfig") {
				include "konfig.php";
			} elseif($pilihan=="logdokumen") {
			 echo "WOOIII";
				include "logdokumen.php";
			}
			

			?>
