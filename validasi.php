<?php
//periksaroot
define(HAPUS_DATA,0);
define(TAMBAH_DATA,1);
define(SIMPAN_DATA,2);
define(CARI_DATA,3);

function cekvaliditaswaktu($label,$varfile,$max_size=0) {
  //return

}

function cekvaliditasfile($label,$varfile,$max_size=0)
{
	$forbidden_ext = array('php','php3','inc');
	$max_size = $max_size * 1000;
	$ext = array_pop(explode('.',$varfile['name']));
	if($varfile['name'] <> "none")
	{
		if(in_array($ext,$forbidden_ext))
			return $label." (Tidak boleh mengupload file berekstensi '$ext'. Jika memang diperlukan, silahkan di-zip terlebih dahulu sebelum di upload)";
		
		if($max_size>0 && $varfile['size']>$max_size)
			return $label." (Ukuran file yang diupoad terlalu besar. Maks = $max_size kilobyte)"; 
	}
}

function cekvaliditasnama($label,$nama,$max=32,$empty=true)
{
	if(!validasi_nama($nama,$max,$empty))
		return $label;
}

function cekvaliditasnim($label,$nim)
{
	return cekvaliditaskode($label,$nim,$max=16,$empty=true);
}

function cekvaliditasnidn($label,$nidn,$empty=true)
{
	if(!validasi_angka_int($nidn,10,$empty))
		return $label;
}

function cekvaliditaskode($label,$kode,$max=255,$empty=true)
{
	if(($empty == false) && ($kode == ''))
		return $label.' (Tidak boleh kosong)';
		
	$maks = $max * 1;
	if( (strlen($kode) > $maks) && $max != 0)
		return $label. "(Tidak boleh lebih dari $maks karakter)";
			
	//echo $kode;
	$pola = '^([0-9a-zA-Z.,;& \/-])*$';
	if( !eregi($pola,$kode)) 
		return $label;
}

function cekvaliditasnilaihuruf($label,$nilai,$empty=true)
{
	if(!validasi_nilaihuruf($nilai,2,$empty))
		return $label;
}

function cekvaliditasnilaibobot($label,$nilai,$empty=true)
{
	if(!validasi_nilaibobot($nilai,4,$empty))
		return $label;
}

function cekvaliditastanggal($label,$tgl,$bln,$thn,$empty=true)
{	
	if(!validasi_tanggal($tgl,$bln,$thn,$empty))
		return $label;
}

function cekvaliditastahun($label,$thn='',$empty=true)
{
	if(!validasi_tahun($thn,$empty))
		return $label;
}

function cekvaliditasthnajaran($label,$thn='',$sem='',$empty=true)
{
	if(!validasi_thnajaran($thn,$sem,$empty))
		return $label;
}

function cekvaliditasthnbulan($label,$thn='',$bln='',$empty=true)
{
	if(!validasi_thnbulan($thn,$bln,$empty))
		return $label;
}

function cekvaliditasemail($label,$email='',$empty=true)
{
	if(!(validasi_email($email,$empty)))
		return $label;
}

function cekvaliditasweb($label,$web='',$max=64,$empty=true)
{
	if(!(validasi_web($web,$empty)))
		return $label;
}

function cekvaliditasinteger($label,$intgr='',$max=32,$empty=true)
{
	if(!(validasi_angka_int($intgr,$max,$empty)))
		return $label;
}

function cekvaliditasnumerik($label,$num='',$max=32,$empty=true)
{
	if(!(validasi_angka($num,$max,$empty)))
		return $label;
}

function cekvaliditasalphanum($label,$alphanum='',$max=32,$empty=true)
{
	if(!(validasi_alphanum($alphanum,$max,$empty)))
		return $label;
}

function cekvaliditastelp($label,$tlpn='',$max=32,$empty=true)
{
	if(!(validasi_telpon($tlpn,$max,$empty)))
		return $label;
}

function cekvaliditaskodemakul($label,$makul='',$max=16,$empty=true)
{
	if(!(validasi_makul($makul,$max,$empty)))
		return $label;
}

function cekvaliditaskodeprodi($label,$prodi='',$max=8,$empty=true)
{
	if(!(validasi_angka_int($prodi,$max,$empty)))
		return $label;
}


//------------------------------------------------------------------------------
//Fungsi untuk memvalidasi nama (nama apa aja)
//------------------------------------------------------------------------------
function validasi_nama($nama='',$maks=32,$empty=true)
{
	if( (strlen($nama) > $maks))
		return false;	
		
	if(($nama == '') && ($empty == false))
		return false;
	//echo $nama;
	if(!eregi('^[a-zA-Z0-9, .\\\']*$',$nama))
		return false;
	return true;
}

//--------------------------------------
//Validasi nilai huruf
//--------------------------------------
function validasi_nilaihuruf($nilai='',$maks=3,$empty=true)
{
	if(($empty == false) && ($nilai == ''))
		return false;
	$pola = "^([a-fA-FLMT\+\-]{0,$maks})$";
	if( (!eregi($pola,$nilai)))
	{
		return false;
	}
	return true;
}

//--------------------------------------
//Validasi nilai bobot
//--------------------------------------
function validasi_nilaibobot($nilai='',$maks=4,$empty=true)
{
	if(($empty == false) && ($nilai == ''))
		return false;
	$pola = "^([0-9.]{0,$maks})$";
	if( (!eregi($pola,$nilai)))
	{
		return false;
	}
	return true;
}


//----------------------------------------------------------
// Validasi tanggal
// Data yang valid hanya apabila dalam format angka
//----------------------------------------------------------
function validasi_tanggal($tgl,$bln,$thn,$empty = true)
{
	$tglbulan[1] = 31;
	$tglbulan[2] = 28;
	$tglbulan[3] = 31;
	$tglbulan[4] = 30;
	$tglbulan[5] = 31;
	$tglbulan[6] = 30;
	$tglbulan[7] = 31;
	$tglbulan[8] = 31;
	$tglbulan[9] = 30;
	$tglbulan[10] = 31;
	$tglbulan[11] = 30;
	$tglbulan[12] = 31;

	$tgl1 = $tgl*1;
	$bln1 = $bln*1;
	$thn1 = $thn*1;
	
//	echo $bln1;
	if(($empty==false) && ( ($tgl1 == 0) || ($bln1 == 0) || ($thn1 == 0)))
		return false;
		
//	echo $tglbulan[$bln1];
	if(($bln1==2) && (($thn1 % 4) == 0)){
		$tglbulan[2] = 29;
	}
//	echo $tgl1;
	if( ($tgl1 > $tglbulan[$bln1]) || ($tgl1 < 0)) {
		return false;
	}
//	echo $bln1;
	if(($bln1 > 12) || ($bln1 < 0)) {
		return false;
	}
//	echo $thn1;
	if(!eregi('([0-9]){4}',$thn1) && ($thn != '') ){
		return false;
	}
	return true;
}

//---------------------------------
// Validasi tahun aja
//--------------------------------
function validasi_tahun($thn='',$empty=true)
{
	
	if(($empty == false) && ($thn == ''))
		return false;
	if(!eregi('([0-9]){4}',$thn) && ($thn != ''))
		return false;
	return true;
}


//==================================
//validasi tahun ajaran dan semester
function validasi_thnajaran($thn='',$sem='',$empty=true)
{
	if((($thn=='') || ($sem =='')) && ($empty == false))
		return false;
	if(!validasi_tahun($thn))
		return false;
	if(($sem < 0) || ($sem > 5))
		return false;
	return true;
}

//==================================
//validasi tahun ajaran dan semester
function validasi_thnbulan($thn='',$bln='',$empty=true)
{
	if((($thn=='') || ($bln =='')) && ($empty == false))
		return false;
	if(!validasi_tahun($thn))
		return false;
	if(($sem < 0) || ($bln > 12))
		return false;
	return true;
}

//----------------------------------------------
// Eksperimental
//----------------------------------------------
function validasi_kode($kode ='',$maxlen=255,$empty = true)
{
	if(($empty == false) && ($kode == ''))
		return false;
		
	$pola = '^([0-9a-zA-Z.,; \<>&-])$';
	if((!eregi($pola,$kode)) || ($maxlen < strlen($kode)))
	{
		return false;
	}
	return true;
	
}

//----------------------------------------------
//Format email
//---------------------------------------------
function validasi_email($mail,$empty = true)
{
	if (!ereg("^[^@]{1,64}@[^@]{1,255}\.[^@]{1,7}$", $mail)) 
	{
		return false;
	}else{
		return true;
	}
}

//----------------------------------------------
//Format web
//Web harus diawali dengan http://.....
//---------------------------------------------
function validasi_web($web,$empty = true)
{
	$pola = '^http://.+\..+$';
	if(eregi($pola,$web)){
		return true;
	}else{
		return false;
	}
}

// -----------------------------------------------
// Hanya menerima angka integer
// ----------------------------------------------
function validasi_angka_int($num='',$maxlen=255,$empty = true)
{
	$pola = '^([0-9]*)$';
//	echo $num;
	if( ($num == '') && ($empty == false))
		return false;
//	echo $num;
	if(($maxlen < strlen($num)) || !(eregi($pola,$num))) 
		return false;
	return true;
}

// -----------------------------------------------
// Hanya menerima angka doang
// ----------------------------------------------
function validasi_angka($num,$empty = true)
{
	$pola = '^([0-9]*)\.*([0-9]*)$';
	if(eregi($pola,$num))
	{
		return true;
	}else{
		return false;
	};
}

// -----------------------------------------------
// Hanya menerima angka doang
// ----------------------------------------------
function validasi_alphanum($alphanum,$empty = true)
{
	$pola = '^([a-zA-Z0-9]*)$';
	if(eregi($pola,$num))
	{
		return true;
	}else{
		return false;
	};
}

//---------------------------------------------------------
// Validasi data Telepon
// Ada 4 jenis format yang diterima 
//---------------------------------------------------------
function validasi_telpon($telp='',$empty = true)
{
	$pola[0] = '^[0-9]*$'; //angka saja
	$pola[1] = '^\+[0-9]+$'; //nomor internasional
	$pola[2] = '^\(([0-9]{1,4})\)[0-9]{1,}$'; //nomor kode daerah
	$pola[3] = '^([0-9]{1,4})\-[0-9]{1,}$'; //pake kode daerah tapi di pisah oleh strip
	
	if(($empty == false) && ($telp == ''))
		return false;

	foreach ($pola as $v ){
		if(eregi($v,$telp))
			return true;
	}
	return false;
}

function validasi_makul($makul='',$max=16,$empty=true)
{
	$pola = '^([a-zA-Z0-9]*)$';
	if(($empty == false) && ($makul == ''))
		return false;
		
	
	if(eregi($pola,$makul))
	{
		return true;
	}else{
		return false;
	};
}

//Alias dari fungsi compile_message saja
function inv_message($invalid_data,$type=1)
{
	return compile_message($invalid_data,$type);
}

function compile_message($invalid_data,$type=1)
{
	//$type = 2;
	if( count($invalid_data)>0)
	{
		if($type == 1)
		{
			$step = 1;
			$arr_invalid = array_reverse($invalid_data);
			foreach($arr_invalid as $v)
			{
				if($step == 1) {
					$msg = $v;
					$step = 2;
				}else{
					if($step == 2)
					{
						$msg = $v.' & '.$msg;
						$step = 3;
					}else{
						$msg = $v.', '.$msg;
					}
				}
			}
			return $msg;
		}else{
			$msg = '<ul>';
			foreach($invalid_data as $k => $v)
			{
				$msg .= '<li>'.$v.'</li>';
			}
			$msg .= '</ul>';
			return $msg;
		}
	}
	return false;
}

function filter_not_empty($var)
{
	return($var != '');
}

function token_err_mesg($data,$act=99)
{
	switch($act)
	{
		case HAPUS_DATA : 
			$action = 'hapus';
			break;
		case TAMBAH_DATA : 
			$action = 'tambah';
			break;
		case SIMPAN_DATA : 
			$action = 'simpan';
			break;
		default:
			$action = 'cari';
	}
	$msg = 'Form Anda telah kadaluarsa. Data '.$data.' tidak di'.strtolower($action);
	return $msg;
}

function val_err_mesg($data,$type=1,$act=1)
{
	switch($act)
	{
		case HAPUS_DATA : 
			$action = 'hapus';
			break;
		case TAMBAH_DATA : 
			$action = 'tambah';
			break;
		case SIMPAN_DATA : 
			$action = 'simpan';
			break;
		default:
			$action = 'cari';
	}
	
	switch($type)
	{
		case 1 :
			$msg = 'Data '.inv_message($data,$type).' tidak valid. Data tidak di'.strtolower($action);
			break;
		case 2 :
			$msg = 'Data berikut ini tidak valid atau kosong'.inv_message($data,$type).' Data tidak di'.strtolower($action);
			break;
	}
	return $msg;
}
?>
