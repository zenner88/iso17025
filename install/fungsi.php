<?
//cekfile();
function periksaroot() {
  global $root;
  if (!($root=="../")) {
    $root="./";
  }
}
periksaroot();


 function getasal() {
	global $REMOTE_ADDR;
	return "$REMOTE_ADDR";
}

 	


	function sqlnumrows($hasil) {
		return mysql_num_rows($hasil);
	}
	function doquery($query,$koneksi) {
		$h=mysql_query($query,$koneksi);
		////echo mysql_error();
		return $h;
	}
	
	function sqlfetcharray($hasil) {
		return mysql_fetch_array($hasil);
	}

	function sqlaffectedrows($koneksi) {
		return mysql_affected_rows($koneksi);
	}
	
	function koneksiBD() {
		$konek = mysql_connect($hostsql,$loginsql,$passwordsql);
		return $konek;
	}
	
	function isemail($email) {	
		return (ereg("^[^@ \t]+@[^@ \t]+\.[^@ \t]+",$email));
	}
	
	function isintegerpositif ($angka) {
		return (ereg("^[0-9][0-9]*$",$angka));
	}
	
	function isangka($angka) {
		return (ereg("^[0-9]+$",$angka));
	}

	function istahun($tahun) {
		return (isintegerpositif($tahun) && ereg("[0-9]{4}",$tahun) && $tahun > 1900);
	}

	
	function iskabisat($tahun) {
		return (($tahun % 100 != 0 && $tahun % 4 == 0) || ($tahun % 100 == 0 && $tahun % 400 == 0)  );
	}
	
	function istanggal($tanggal,$bulan,$tahun,$komentar) {
		if (!isintegerpositif($tanggal)) {
			//echo "Tanggal $komentar harus diisi dengan bilangan bulat 1 s.d 31<br>";
			return 0;
		}
		if (!isintegerpositif($bulan) || ($bulan > 12 || $bulan < 1)) {
			//echo "Bulan $komentar harus diisi bilangan bulat 1 s.d 12<br>";
			return 0;
		}
		if (!isintegerpositif($tahun) || $tahun < 1900) {
			//echo "Tahun $komentar harus diisi bilangan bulat 4 digit > 1900<br>";
			return 0;
		}
		
		if ($bulan == 4 ||
			$bulan == 6 ||
			$bulan == 9 ||
			$bulan == 11
		) {
			if ($tanggal > 30) {
				//echo "Tanggal $komentar untuk bulan 4, 6, 9, dan 11 harus diisi bilangan bulat 1 s.d 30<br>";
		//		exit;
			return 0;
			}
		} elseif ($bulan == 2) {
			if ($tanggal > 28 && !iskabisat($tahun)) {
				//echo "Tanggal $komentar untuk bukan tahun kabisat ($tahun) harus diisi bilangan bulat 1. s.d 28<br>";
			//	exit;
				return 0;
			}
		} else {
			if ($tanggal > 31) {
				//echo "Tanggal $komentar untuk bulan 1, 3 , 5, 7 , 8, 10, dan 12 harus diisi bilangan bulat 1 s.d 31<br>";
				return 0;
			}
		}
		return 1;
	}
	
	function isarraysama($array1,$array2) {
		if (count($array1)!=count($array2)) {
			return false;
		} else {
			$sama=true;
			for ($i=0;$i<count($array1);$i++) {
				if ($array[$i]!=$array2[$i]) {
					$sama=false;
					break;
				}
			}
			return $sama;
		}
	}

	function hasilquerytoarray ($hasil,$i) {
		//$hasil;
		while ($row = sqlfetcharray($hasil)) {
			$hasil[]=$row[$i];
			echo "$row[$i]";
		}
		return $hasil;
	}		
	



	
	function addnol($nilai,$banyakdigit) {
		
		$tmp="";
		for ($d=$banyakdigit-1;$d>=1;$d--) {
			if ($nilai/pow(10,$d) >= 1) {
			  break;
			} else {
				$tmp.="0";
			}
		}
		return "$tmp$nilai";
	}
	





	function locktabel($daftartabel) {
		global $koneksi;
		doquery("LOCK TABLE $daftartabel",$koneksi);
		//echo mysql_error();
	}


	function unlocktabel() {
		global $koneksi;
		doquery("UNLOCK TABLE",$koneksi);
	}

	function getkode() {
		global $koneksi;
		$q="SELECT PASSWORD(PASSWORD(DATE_FORMAT(NOW(),'%d%m%Y'))) AS HASIL";
		$h=doquery($q,$koneksi);
		$d=sqlfetcharray($h);
		return $d[HASIL];
		}
		
		
?>
