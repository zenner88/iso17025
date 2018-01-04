<?

include "arraybahasa.php";

// ARRAY SURVEY
$arraysurvey[1][P]="Seberapa puas Anda atas Jasa Pengujian yang telah kami berikan?";
$arraysurvey[2][P]="Bagaimana tangapan Anda atas ketepatan waktu penyampaian hasil pengujian :";
$arraysurvey[3][P]="Bagaimana menurut pendapat Anda atas keyakinan keakurasian pengujian kami?";
$arraysurvey[4][P]="Bagaimana tingkat keramahan staf kami dalam melayani Anda?";
$arraysurvey[5][P]="Apakah fasilitas laboratorium sudah memadai dan memiliki peralatan modern/mutakhir?";
$arraysurvey[6][P]="Apakah personel laboratorium tanggap terhadap permintaan pengujian?";

$arraysurvey[1][J][A]="Puas (Baik)";
$arraysurvey[1][J][B]="Biasa Saja (Cukup)";
$arraysurvey[1][J][C]="Tidak Puas";

$arraysurvey[2][J][A]="Tepat Waktu";
$arraysurvey[2][J][B]="Terkadang Terlambat";
$arraysurvey[2][J][C]="Selalu Terlambat";

$arraysurvey[3][J][A]="Akurat";
$arraysurvey[3][J][B]="Cukup Akurat";
$arraysurvey[3][J][C]="Meragukan";

$arraysurvey[4][J][A]="Bersahabat";
$arraysurvey[4][J][B]="Tidak cukup ramah";
$arraysurvey[4][J][C]="Tidak ramah";

$arraysurvey[5][J][A]="Sudah";
$arraysurvey[5][J][B]="Cukup";
$arraysurvey[5][J][C]="Kurang";

$arraysurvey[6][J][A]="Baik";
$arraysurvey[6][J][B]="Cukup";
$arraysurvey[6][J][C]="Kurang";

/////////////



$arrayduplo[0]="Single";
$arrayduplo[1]="Duplo";

$q="SELECT * FROM kelompokjenisuji ORDER BY ID";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)>0) {
	while ($d=sqlfetcharray($h)) {
	  //($d[ID]) 
		$arraykelompokjenisuji["$d[ID]"]="$d[NAMA]";
	}
}



$arraystatushasil[0]="Analisis";
$arraystatushasil[1]="Selesai";
$arraystatushasil[2]="Batal";
$arraystatushasil[3]="Administrasi";
$arraystatushasil[4]="Klien";
//$arraystatushasil[7]="Administrasi Akhir";

$arraystatuspermintaan[0]="Ada di Man. Teknis";
$arraystatuspermintaan[1]="Ada di Supervisor";
$arraystatuspermintaan[2]="Ada di Analis";
$arraystatuspermintaan[3]="Sedang Dianalisis";
$arraystatuspermintaan[4]="Diperiksa Supervisor";
$arraystatuspermintaan[5]="Diperiksa Manager Teknis";
$arraystatuspermintaan[6]="Analisa Ulang";
$arraystatuspermintaan[7]="Administrasi Akhir";
$arraystatuspermintaan[8]="Pelanggan Komplain";
$arraystatuspermintaan[99]="Selesai";
$arraystatuspermintaan[100]="";


$arraystatusanalis[3]="Sedang Dianalisis";
$arraystatusanalis[4]="Selesai Dianalisis";

$arraystatussup[5]="Benar";
$arraystatussup[6]="Harus Dianalisa Ulang";

$arraystatusman[7]="Benar";
$arraystatusman[4]="Harus Dianalisa Ulang";

$arraystatusadm[99]="Selesai";
$arraystatusadm[8]="Pelanggan Komplain";

$arraystatusklien[99]="Selesai";
$arraystatusklien[8]="Pelanggan Komplain";


for ($i=0;$i<=23;$i++) {
  $arraykelompokanalisis[$i]="0";
}


///$arrayanalisis[0]="Kadar Air";
///$arrayanalisis[1]="Kadar Protein";
///$arrayanalisis[2]="Kadar Lemak cara Soxhlet";
///$arrayanalisis[3]="Kadar Abu";
//$arrayanalisis[4]="Penentuan Mineral dgn AAS";
///$arrayanalisis[5]="Penentuan Serat Kasar";
///$arrayanalisis[6]="Penentuan Kadar KH cara Luff Schoorl";
///$arrayanalisis[7]="Penentuan Gula Pereduksi dgn Luff Schoorl";
///$arrayanalisis[8]="Penentuan Gula Total  dgn Luff Schoorl";
///$arrayanalisis[9]="Penentuan Klorida cara Mohr";
$arrayanalisis[10]="Penentuan Cd dgn AAS";
$arrayanalisis[11]="Penentuan Pb dgn AAS";
$arrayanalisis[12]="Penentuan Cr dgn AAS";
$arrayanalisis[13]="Penentuan Zn dgn AAS";
$arrayanalisis[14]="Penentuan Cu dgn AAS";
$arrayanalisis[15]="Penentuan Fe dgn AAS";
$arrayanalisis[16]="Penentuan Hg tanpa nyala dgn AAS";
$arrayanalisis[17]="Penentuan Cd cara Ekstraksi";
$arrayanalisis[18]="Penentuan Pb cara Ekstraksi";
$arrayanalisis[19]="Penentuan Cr cara Ekstraksi";
$arrayanalisis[20]="Penentuan Zn cara Ekstraksi";
$arrayanalisis[21]="Penentuan Fe cara Ekstraksi";
$arrayanalisis[22]="Penentuan Cu cara Ekstraksi";
$arrayanalisis[23]="Penentuan Mn+ cara Ekstraksi";


 
$q="SELECT ID,NAMA,NAMA2,RUMUS,HASIL,SATUAN,IDKELOMPOK FROM jenisuji ORDER BY ID";
$h=doquery($q,$koneksi);
 
if (sqlnumrows($h)>0) {
	while ($d=sqlfetcharray($h)) {
	 	$arrayanalisis[$d[ID]]=$d[NAMA];
	 	$arrayanalisiscetak[$d[ID]]=$d[NAMA2];
	 	$arrayanalisisrumus[$d[ID]]=$d[RUMUS];
	 	$arrayanalisishasil[$d[ID]]=$d[HASIL];
	 	$arrayanalisissatuan[$d[ID]]=$d[SATUAN];
    $arraykelompokanalisis[$d[ID]]=$d[IDKELOMPOK];
	}
}
 
///$arrayanalisis2[0]="Air";
///$arrayanalisis2[1]="Protein";
///$arrayanalisis2[2]="Lemak";
///$arrayanalisis2[3]="Abu";
//$arrayanalisis2[4]="Mineral";
///$arrayanalisis2[5]="Serat";
///$arrayanalisis2[6]="KH";
///$arrayanalisis2[7]="Gula Pereduksi";
///$arrayanalisis2[8]="Gula Total";
///$arrayanalisis2[9]="Klorida";
$arrayanalisis2[10]="Cd";
$arrayanalisis2[11]="Pb";
$arrayanalisis2[12]="Cr";
$arrayanalisis2[13]="Zn";
$arrayanalisis2[14]="Cu";
$arrayanalisis2[15]="Fe";
$arrayanalisis2[16]="Hg";
$arrayanalisis2[17]="Cd";
$arrayanalisis2[18]="Pb";
$arrayanalisis2[19]="Cr";
$arrayanalisis2[20]="Zn";
$arrayanalisis2[21]="Fe";
$arrayanalisis2[22]="Cu";
$arrayanalisis2[23]="Mn+";

$q="SELECT * FROM jenisuji ORDER BY ID";
$h=doquery($q,$koneksi);
if (sqlnumrows($h)>0) {
	while ($d=sqlfetcharray($h)) {
		$arrayanalisis2[$d[ID]]=strtokimia($d[NAMA2]);
	}
}

 

/// Kode transaksi ///
//  B == Pembelian Biasa, DB == Diskon Pembelian, PB == PPn Pembelian, UB Bayar Hutang
//  J == Penjualan Biasa, DJ == Diskon Penjualan, PJ == PPn Penjualan , JP Persediaan
//  R == Retur Penjualan dari Pelanggan (Keuangan terlibat)
//  L == Retur Penjualan dari Pelanggan (Keuangan Tidak Terlibat/Tukar Guling)
//  N == Retur Pembelian ke Distributor (Keuangan Tidak terlibat/Tukar Guling)
////////////////////////

$arrayppn[0]="Tanpa PPN";
$arrayppn[1]="PPN 10%";

$arraystatusprojek[0]="Dalam proses";
$arraystatusprojek[1]="Selesai";


$arraystatuspesanan[0]="Dalam proses";
$arraystatuspesanan[1]="Selesai";

$arraygudang[1]="Gudang Perusahaan";
$arraygudang[0]="Gudang Distributor";

$arrayakun[penjualan]="4100";
$arrayakun[kas]="1101";
$arrayakun[piutang]="1112";
$arrayakun[utang]="2110";
$arrayakun[persediaan]="1131";
$arrayakun[diskonbeli]="5115";
$arrayakun[diskonjual]="4115";
$arrayakun[ppnbeli]="11501";
$arrayakun[ppnjual]="2113";
$arrayakun[hpp]="5100";
$arrayakun[retur]="4110";
$arrayakun[perantara]="6220";
$arrayakun[gajimandor]="6101";

$arrayjenisstok[N]="Gudang";
$arrayjenisstok[R]="Retur";





$arrayjenisbayar[1]="Tunai";
$arrayjenisbayar[0]="Kredit";

$arraycarabayar[1]="Cash";
$arraycarabayar[0]="Transfer";


$arrayjenist[2]="Penyesuaian";
$arrayjenist[1]="Penerimaan";
$arrayjenist[0]="Pengeluaran";





/*
$q="SELECT ID,NAMA FROM jenis ORDER BY NAMA";
$h=doquery($q,$koneksi);
while ($d=sqlfetcharray($h)) {
	$arrayjenis[$d[ID]]=$d[NAMA];
}
*/

$angka[0]="Nol";
$angka[1]="Satu";
$angka[2]="Dua";
$angka[3]="Tiga";
$angka[4]="Empat";
$angka[5]="Lima";
$angka[6]="Enam";
$angka[7]="Tujuh";
$angka[8]="Delapan";
$angka[9]="Sembilan";
$angka[10]="Sepuluh";
$angka[11]="Sebelas";
$angka[100]="Seratus";
$angka[1000]="Seribu";

$arraystatusjenisuang[0]="Definitif";
$arraystatusjenisuang[1]="Uang Muka";


$arraystatusuang[0]="Tunai";
$arraystatusuang[1]="Tidak Tunai";


$arraystatusretur[0]="Lunas";
$arraystatusretur[1]="Belum Lunas";

	
$arraystatusterima[0]="Lunas";
$arraystatusterima[1]="Belum Lunas";

$arraystatuskeluar[0]="Lunas";
$arraystatuskeluar[1]="Belum Lunas";
$arraystatuskeluar[2]="Black List";


$arraysatuandasar[0]="satuan";
$arraysatuandasar[1]="lusin";
$arraysatuandasar[2]="dus";




$arraytingkat[B]="Administrasi";
$arraytingkat[C]="Manajer Teknis";
$arraytingkat[D]="Supervisor";
$arraytingkat[E]="Analis";
$arraytingkat[A]="Administrator";
$arraytingkat[F]="Klien";




$arrayhari[0]="Minggu";
$arrayhari[1]="Senin";
$arrayhari[2]="Selasa";
$arrayhari[3]="Rabu";
$arrayhari[4]="Kamis";
$arrayhari[5]="Jumat";
$arrayhari[6]="Sabtu";

$arraybulan[0]="Januari";
$arraybulan[1]="Februari";
$arraybulan[2]="Maret";
$arraybulan[3]="April";
$arraybulan[4]="Mei";
$arraybulan[5]="Juni";
$arraybulan[6]="Juli";
$arraybulan[7]="Agustus";
$arraybulan[8]="September";
$arraybulan[9]="Oktober";
$arraybulan[10]="November";
$arraybulan[11]="Desember";

/////////////////////////////////////////////////////////////////

function buatlogiso($jenislog,$keterangan,$query,$iduser) {
  global $koneksi,$arraylogiso,$jenisusers;
  if ($jenisusers==1) {
    $namajenisuser=" (KLIEN)";
  }
  $q="INSERT INTO logdokumen (ID,JENISDOKUMEN,NAMA,PEGAWAI,WAKTU,ASAL,JENISLOG)
  VALUES
  (0,'$keterangan','".str_replace("'","\\'",$query)."','$iduser$namajenisuser',NOW(),'".getasal()."','".$arraylogiso[$jenislog]."' )";
  doquery($q,$koneksi);
  echo mysql_error();
  
 }


$arraylogiso[0]="Tambah Operator";
$arraylogiso[1]="Update Operator";
$arraylogiso[2]="Hapus Operator";
$arraylogiso[3]="Ganti Password";
$arraylogiso[4]="Tambah Permintaan";
$arraylogiso[5]="Update permintaan";
$arraylogiso[6]="Hapus permintaan";
$arraylogiso[7]="Tambah Jenis Uji Permintaan";
$arraylogiso[8]="Update Jenis Uji permintaan";
$arraylogiso[9]="Hapus jenis Uji permintaan";
$arraylogiso[10]="Setting Kop";
$arraylogiso[11]="Setting Biaya Uji";
$arraylogiso[12]="Buat Laporan";
$arraylogiso[13]="Buat Tagihan";

$arraylogiso[14]="MT: Update Data/Status Permintaan";
$arraylogiso[15]="Supervisor: Update Data/Status Permintaan";
$arraylogiso[16]="Analis: Update Data/Status Permintaan";

$arraylogiso[17]="Supervisor: Upload file referensi khusus.";
$arraylogiso[18]="Analis: Upload file hasil.";

$arraylogiso[19]="Tambah Instruksi Kerja";
$arraylogiso[20]="Update Instruksi Kerja";
$arraylogiso[21]="Hapus Instruksi Kerja";

$arraylogiso[22]="Tambah Jenis Uji";
$arraylogiso[23]="Update Jenis Uji";
$arraylogiso[24]="Hapus Jenis Uji";
$arraylogiso[25]="Setting Nilai Baku";

$arraylogiso[26]="Tambah Kelompok Jenis Uji";
$arraylogiso[27]="Update Kelompok Jenis Uji";
$arraylogiso[28]="Hapus kelompok Jenis Uji";

?>
