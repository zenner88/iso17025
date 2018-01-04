<?
		if ($lihatsemua!=1) {
		/// Paginating ///////////////////////////		


		if ($maxdata==""  || $maxdata<=0) {
			$maxdata==20;
		}
		//$maxdata;
		if ($hal=="" || $hal <0) {
			$hal=1;
		}
		 
		$gright="<img alt='next page' src='".$root."gambar/right.png' border=0>";	 
		$grightg="<img alt='next page' src='".$root."gambar/rightg.png' border=0>";	 
		$gleft="<img alt='prev page' src='".$root."gambar/left.png' border=0>";	 
		$gleftg="<img alt='prev page' src='".$root."gambar/leftg.png' border=0>";	 
		$glast="<img alt='last page' src='".$root."gambar/last.png' border=0>";	 
		$glastg="<img alt='last page' src='".$root."gambar/lastg.png' border=0>";	 
		$gfirst="<img alt='first page' src='".$root."gambar/first.png' border=0>";	 
		$gfirstg="<img alt='first page' src='".$root."gambar/firstg.png' border=0>";	 
	  $maxhal=ceil($total/$maxdata); 
		if ($hal==1 && $maxhal>1) {
			 $tnext=" <font id=tombolnext><a   href='$href&sort=$sort&hal=".($hal+1)."'>$gright</a> 
			 <a  href='$href&sort=$sort&hal=$maxhal'>$glast</a></font>";
			$tprev="<font id=tombolprev_end>$gfirstg $gleftg</font >";
 		}  elseif ($maxhal==$hal && $maxhal!=1) {
			 $tprev="<font  id=tombolprev>
			 <a href='$href&sort=$sort&hal=1'>$gfirst</a>
			 <a href='$href&sort=$sort&hal=".($hal-1)."'>$gleft</a>
			 </font >";
			$tnext="<font  id=tombolnext_end>$grightg $glastg</font >";
 		}  elseif ($maxhal==$hal && $maxhal==1) {
			 $tprev="<font id=tombolprev_end>$gfirstg $gleftg</font>";
			$tnext="<font  id=tombolnext_end>$grightg $glastg</font>"; 
		} else {
			 $tnext="<font id=tombolnext> <a href='$href&sort=$sort&hal=".($hal+1)."'>$gright</a>
			 <a  href='$href&sort=$sort&hal=$maxhal'>$glast</a>
			 </font >";
			 $tprev="<font  id=tombolprev>
			  <a href='$href&sort=$sort&hal=1'>$gfirst</a>
			 <a href='$href&sort=$sort&hal=".($hal-1)."'>$gleft</a></font	 >";
		}
		
		$first=$maxdata*($hal-1);
		
		$qlimit="LIMIT $first,$maxdata";
		
		 
		if ($aksi!="cetak") {
			 $tpage="
			<table  width=95% cellspacing=0    class=paginating>
				<tr  class=paginating valign=top>
					<td>
						Halaman ke $hal dari $maxhal, ditemukan total $total data
					</td>
					<td align=center>
						 halaman ";
						for ($ii==1;$ii<=$maxhal;$ii++) {
							if ($ii!=$hal) {
								$tpage.= " <a href='$href&sort=$sort&hal=$ii'><b>$ii</b></a> ";
							} else {
								$tpage.= "$ii ";
							}
						}
						$tpage.= "
					</td>
					<td align=right nowrap>
						$tprev &nbsp;  $tnext 
					</td>
				</tr>
			</table>
			";
 			}
		}
 		if ($aksi!="cetak") {
			$tpage2.="
			<table  width=95%  cellspacing=0    class=paginating  id=paginate>
				<tr  class=paginating>
					<td>
						<a id=nopaged href=\"$href&sort=$sort&lihatsemua=1 \">Tampilkan semua</a>
						| <a id=paged href='$href&sort=$sort&hal=1'>Tampilkan per halaman</a>
					</td>
	 			</tr>
			</table>
			";
 		
 		}
		$input.="
		<input type=hidden name=hal value='$hal'>
		<input type=hidden name=lihatsemua value='$lihatsemua'>
		";
		////////// End Paginating ////////////////
			$href.="&hal=$hal&lihatsemua=$lihatsemua";

?>