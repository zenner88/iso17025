<?
function tekstorumus($s) {
	$tmp=explode(";",$s);
	foreach ($tmp as $v) {
		$tmp2=explode("=",$v);
		$var=$tmp2[0];
		$val=$tmp2[1];
		$rumus[$var]=$val;
	}
	return $rumus;
}

function hasilanalis($rumus,$jenis) {
	$hasil=0;
	if ($jenis==1) { ////////////// Kadar Air
		if ($rumus[bc]==0 || $rumus[bc]=="") {
			$hasil="Error: Berat contoh 0";
		} else {
			$hasil=100*(($rumus[b]-$rumus[a])-($rumus[c]-$rumus[a]))/$rumus[bc];
		}
	}
	return $hasil;
}

?>