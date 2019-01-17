<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
 if(isset($_SESSION['lang'])){
	 switch($_SESSION['lang']){
       case 'bg':      
	   $d = "д "; $m = "м "; $s = "с "; $h="ч ";
       break;
       case 'en':    
	   $d = "d "; $m = "m "; $s = "s "; $h="h ";
       break;
	   default:
	   	   $d = "d "; $m = "m "; $s = "s "; $h="h ";
	   break;
  }
 }


?>

<script type="text/javascript">
function eventstime(lasttime, repeattime, showid, opentime) {
	if (lasttime < 0) lasttime = repeattime-1;
	if (lasttime <= opentime) {
		document.getElementById(showid).innerHTML = "is Open";
		setTimeout('eventstime('+(lasttime-1)+', '+repeattime+', \''+showid+'\', '+opentime+');', 999);
	} else {
		var secs = lasttime % 60;
		if (secs < 10) secs = '0'+secs;
		var lasttime1 = (lasttime - secs) / 60;
		var mins = lasttime1 % 60;
		if (mins < 10) mins = '0'+mins;
		lasttime1 = (lasttime1 - mins) / 60;
		var hours = lasttime1 % 24;
		var days = (lasttime1 - hours) / 24;
		if (days > 1) days = days+' days + ';
		else if (days > 0) days = days+' day + ';
		document.getElementById(showid).innerHTML = days+hours+'<?php echo $h;?> : '+mins+'<?php echo $m;?> : '+secs+"<?php echo $s;?>";
		setTimeout('eventstime('+(lasttime-1)+', '+repeattime+', \''+showid+'\', '+opentime+');', 999);
	}
}
</script>

<?
echo'
<table class="event_timer" border="0" style="margin-left:20px;font-size:15pt;">';
$i = 0;
echo '';
foreach ($eventtime as $value) {
	$i++;
	$bc_remain = $value['repeattime'] - ((time() - strtotime($value['start'])) % $value['repeattime']);
	$startevents .= 'eventstime('.$bc_remain.', '.$value['repeattime'].', \'event'.$i.'\', '.$value['opentime'].'); ';
	echo '<tr height="25"><td class="title" style="padding:5px;" align="center">'.$value['name'].'</td><td> <span style="margin-left:10px;" id="event'.$i.'" style="color:#FF6611;"></span></td></tr>';
}
echo '<script type="text/javascript">'.$startevents.'</script>
</table>';
}
?>