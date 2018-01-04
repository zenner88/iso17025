<?
function getpembagiinteger($x) {
	if ($x%10==0) {
		$pembagi=10;
	} else if ($x%9==0) {
		$pembagi=9;
	} else if ($x%8==0) {
		$pembagi=8;
	} else if ($x%7==0) {
		$pembagi=7;
	} else if ($x%6==0) {
		$pembagi=6;
	} else if ($x%5==0) {
		$pembagi=5;
	} else if ($x%4==0) {
		$pembagi=4;
	} else if ($x%3==0) {
		$pembagi=3;
	} else if ($x%2==0) {
		$pembagi=2;
	} else if ($$x%1==0) {
		$pembagi=1;
	}
	return $pembagi;
}

function creatediagrambatang($datatabel,$data,$datanx,$datareal,$judul,$folder,$xx,$hr) {
	global $ombangambing;
$im = @ImageCreate ($datatabel[panjang], $datatabel[lebar]);

if ($judul[warna]=="") {
	$datawarna[latartabel] = ImageColorAllocate ($im, 0, 0, 0);
	$datawarna[latar] = ImageColorAllocate ($im, 255, 255, 255);
	$datawarna[garis] = ImageColorAllocate ($im, 0, 0, 0);
	$datawarna[tabel] = ImageColorAllocate ($im, 0, 0, 255);
} else {
	$datawarna[latar] = ImageColorAllocate ($im, $judul[warna][latar][R], $judul[warna][latar][G], $judul[warna][latar][B]);
	$datawarna[garis] = ImageColorAllocate ($im, $judul[warna][garis][R], $judul[warna][garis][G], $judul[warna][garis][B]);
	$datawarna[tabel] = ImageColorAllocate ($im, $judul[warna][tabel][R], $judul[warna][tabel][G], $judul[warna][tabel][B]);
	$datawarna[latartabel] = ImageColorAllocate ($im, $judul[warna][latartabel][R], $judul[warna][latartabel][G], $judul[warna][latartabel][B]);
}
$fjxheight=imagefontheight($judul[x][font]);
$fjxwidth=imagefontwidth($judul[x][font]);
$fjyheight=imagefontheight($judul[y][font]);
$fjywidth=imagefontwidth($judul[y][font]);
$fj1height=imagefontheight($judul[1][font]);
$fj1width=imagefontwidth($judul[1][font]);
$fj2height=imagefontheight($judul[2][font]);
$fj2width=imagefontwidth($judul[2][font]);





$fyheight=imagefontheight($judul[ny][font]);
$fywidth=imagefontwidth($judul[ny][font]);

$fxheight=imagefontheight($judul[nx][font]);
$fxwidth=imagefontwidth($judul[nx][font]);

$datax=array_keys($data);

$jarakx=($datatabel[maxx]-$datatabel[minx])/$datatabel[jmltitikx];
$jaraky=($datatabel[maxy]-$datatabel[miny])/$datatabel[jmltitiky];

$datatabel[xmax]=$datatabel[panjang]-$datatabel[jarakbingkai];
$datatabel[ymax]=$datatabel[jarakbingkai];

$xo=$datatabel[jarakbingkai];
$yo=$datatabel[lebar]-$datatabel[jarakbingkai];



/// Buat Gambar//////////////////////////

imagefill($im,1,1,$datawarna[latar]); 

///// Buat Bingkai //////////////////////////////////
imagerectangle ($im, $xo, $yo, $datatabel[xmax], $datatabel[ymax], $datawarna[latartabel]);

//imagefilltoborder ($im,$xo+10,$yo+10, $datawarna[latartabel], $datawarna[gari]);
//imagefill($im,$xo+10,$yo+10,$datawarna[latartabel]); 

$jx=$fjywidth*strlen($judul[y][nama])/2;
$jy=$fjyheight;
imagestringup ($im, $judul[y][font], $xo+5 , ($datatabel[lebar]/2)+$jx, $judul[y][nama], $datawarna[garis]);


$jx=$fjxwidth*strlen($judul[x][nama])/2;
$jy=$fjxheight;
imagestring ($im, $judul[x][font], ($datatabel[panjang]/2)-$jx, $datatabel[lebar]-($datatabel[jarakbingkai]/2), $judul[x][nama], $datawarna[garis]);


$jx=$fj2width*strlen($judul[2][nama])/2;
$jyt=$jy=$fj2height;
imagestring ($im, $judul[2][font], ($datatabel[panjang]/2)-$jx,($datatabel[jarakbingkai]/2), $judul[2][nama], $datawarna[garis]);


$jx=$fj1width*strlen($judul[1][nama])/2;
$jy=$fj1height;
imagestring ($im, $judul[1][font], ($datatabel[panjang]/2)-$jx, 
($datatabel[jarakbingkai]/2)-$jy, $judul[1][nama], $datawarna[garis]);


$ytmp=($yo-$datatabel[ymax])/$datatabel[jmltitiky];
$xtmp=$xo;

for ($i=0;$i<=$datatabel[jmltitiky];$i++) {
	imagearc ($im, $xtmp, $yo-($ytmp*$i), 5, 5,0,360, $datawarna[garis]);
	$nilai="".($i*$jaraky)."";
	$jx=$fywidth*strlen($nilai);
	$jy=$fywidth;
	imagestring ($im, $judul[ny][font], $xtmp-$jx-$jy, $yo-($ytmp*$i)-$jy, $nilai, $datawarna[garis]);
}

$xtmp=($datatabel[xmax]-$xo)/$datatabel[jmltitikx];
$ytmp=$yo;

for ($i=0;$i<=$datatabel[jmltitikx];$i++) {
	imagearc ($im, $xo+($xtmp*$i), $yo, 5, 5,0,360, $datawarna[garis]);
	$nilai="".($i*$jarakx)."";
	$jx=$fxwidth*strlen($nilai)/2;
	$jy=$fywidth;
	imagestring ($im, $judul[nx][font], $xo+($xtmp*$i)-$jx ,$ytmp+$jy+$jx,  $nilai, $datawarna[garis]);
}


 
$xtmp=@(($datatabel[xmax]-$xo)/($datatabel[maxx]-$datatabel[minx]));
$ytmp=@(($yo-$datatabel[ymax])/($datatabel[maxy]-$datatabel[miny]));
$xlama=$xo;
$ylama=$yo;
$ii=0;
unset($nilai);
 foreach ($datareal as $kk=>$dr) {
		 $x=$dr[x];
		 $y=$dr[y];
 		if ($x!="" && $y!="") {
			$xkiri=$xo+($xtmp*$x)-$datatabel[jarakbatang];
			$xkanan=$xo+($xtmp*$x)+$datatabel[jarakbatang];
			imagefilledrectangle ($im, $xkiri, $yo-($ytmp*$y)-$datatabel[jarakbatang], $xkanan, $yo-($ytmp*$y)+$datatabel[jarakbatang], $datawarna[tabel]);
	
	 		$jx=$fxwidth*strlen($nilai)/2;
			$jy=$fxwidth;
					$turun=0;
	 		imagestring ($im, $judul[nx][font], $xo+($xtmp*$x)-$jx, $yo+$jy+$turun, $nilai, $datawarna[garis]);
	
			$xlama=$xo+($xtmp*$x);
			$ylama=$yo-($ytmp*$y);
			$ii++;
		}
}
 
	// Cari x0
	$xg0=@(-$hr[b]/$hr[a]);
	if ($xg0<0) { 
 		$xg0=0;
		$yg0=$hr[b];
	} else if ($xg0 > $datatabel[maxx]) {
 		$xg0=$datatabel[maxx];
		$yg0=($hr[a]*$datatabel[maxx])+$hr[b];
	} else {	
		//echo " x0 di garis X";
		$yg0=0;
	}

	// Cari x1
	 $xg1=@(($datatabel[maxy]-$hr[b])/$hr[a]);
	if ($xg1 > $datatabel[maxx]) { 
 		$xg1=$datatabel[maxx];
		$yg1=($hr[a]*$datatabel[maxx])+$hr[b];
	} elseif($xg1 <0) {
 		$xg1=0;
		$yg1=$hr[b];
	} else {
		//echo " x1 di garis X";
		$yg1=$datatabel[maxy];
	}

 	$xtmp=@(($datatabel[xmax]-$xo)/($datatabel[maxx]-$datatabel[minx]));
 	$ytmp=@(($yo-$datatabel[ymax])/($datatabel[maxy]-$datatabel[miny]));
	$xgr0=$xo+$xg0*$xtmp;	
	$xgr1=$xo+$xg1*$xtmp;	
	$ygr0=$yo-$yg0*$ytmp;	
	$ygr1=$yo-$yg1*$ytmp;	
	imageline($im,$xgr0,$ygr0,$xgr1,$ygr1,$datawarna[garis]);

	$xx=$xx.".png";
	ImagePNG ($im,"$folder".$xx);
	imagedestroy($im);
	return  $xx;
}
function rg($x,$y) {
	if (is_array($x) && is_array($y)) {
		$n=0;
		foreach ($x as $k=>$v) {
			if ($x[$k]!="" && $y[$k]!="") {
	 			$hasil[sigxy]+=$x[$k]*$y[$k];
				$hasil[sigx]+=$x[$k];
				$hasil[sigy]+=$y[$k];
				$hasil[sigx2]+=$x[$k]*$x[$k];
				$hasil[sigy2]+=$y[$k]*$y[$k];
				$n++;
			}
		}
		$hasil[n]=$n;
		return $hasil;
	} else {
		return "Error";
	}
}

function reglinear($x,$y) {
	if (is_array($x) && is_array($y)) {
		$t=rg($x,$y);
		//echo $t[sigx2];
		$hasil[a]=@((($t[n]*$t[sigxy])-($t[sigx]*$t[sigy]))/(($t[n]*$t[sigx2])-($t[sigx]*$t[sigx])));
		$hasil[b]=@(($t[sigy]-($hasil[a]*$t[sigx]))/$t[n]);
		$hasil[eq]="<b> Y = ".number_format($hasil[a],4)."*X + ".number_format($hasil[b],4)." </b>";

		$hasil[r]=@((($t[n]*$t[sigxy])-($t[sigx]*$t[sigy]))/( sqrt(($t[n]*$t[sigx2]) - ($t[sigx]*$t[sigx])) * sqrt(($t[n]*$t[sigy2]) - ($t[sigy]*$t[sigy]))));


		return $hasil;
	} else {
		return "Error";
	}
}

?>