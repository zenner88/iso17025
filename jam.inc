<?
	$n=getdate(time());
//	foreach ($n as $k=>$v) {
//		echo "$k => $v<br>";
//	}
?>
<script Language="JavaScript">
var timerID = null;
var timerRunning = false;
var menit = <?=$n[minutes]?>;
var detik = <?=$n[seconds]?>;
var jamku = <?=$n[hours]?>;

var n = new Date();
//var lmenit = n.getMinutes();
var ldetik = n.getSeconds();
//var ljam = n.getHours();


function stopclock (){
        if(timerRunning)
                clearTimeout(timerID);
        timerRunning = false;
}


function showtime () {
        var now = new Date();
//        var hours = now.getHours();
 //       var minutes = now.getMinutes();
        var seconds = now.getSeconds();

			if (((seconds > ldetik) && (seconds!=0))||(seconds==0 && ldetik==59)) {
				if (detik < 59) {
					detik++;
				} else {
					detik=0;
					if (menit < 59) {
						menit ++;
					} else {
						menit=0;
						if (jamku < 23)  {
							jamku++;
						} else {
							jamku=0;
						}
					}
				}
				
			}
			ldetik=seconds;

        var timeValue ;
        timeValue = ((jamku < 10) ? "0" : "") + jamku;
        timeValue += ((menit < 10) ? ":0" : ":") + menit;
        timeValue += ((detik < 10) ? ":0" : ":") + detik;
        window.status = timeValue;
       jam.value= timeValue;
        timerID = setTimeout("showtime()",500);
        timerRunning = true;

}
function startclock () {
        stopclock();
        showtime();
}
</script>