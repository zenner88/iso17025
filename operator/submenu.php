<?
	if ($pilihan=="") {
		if ($tingkats=="A") {
		$REQUEST_URI.="?pilihan=alihat&aksi=tampilkan";
		} else {
		$REQUEST_URI.="?pilihan=tambah";
		}
	}
	$arraysubmenu[0][Judul]="Tambah Operator";
	$arraysubmenu[1][Judul]="Update Operator";

	$arraysubmenu[0][href]="index.php?pilihan=tambah";
	$arraysubmenu[1][href]="index.php?pilihan=lihat";

	$arraysubmenu[0][t]="";
	$arraysubmenu[1][t]="";

	
	createsubmenu("Data Operator",$arraysubmenu);
?>
