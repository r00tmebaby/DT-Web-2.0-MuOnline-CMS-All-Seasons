<!-- 
//////////////////////////////////////////////////////
             Market System by r00tme
               date 15/12/2015 
This Market has been made for a friend as a gift but 
I decided to share it to all DarksTeam members !
//////////////////////////////////////////////////////-->
 <script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	
 
<?php
$settings    = mssql_fetch_array(mssql_query("Select * from [DTweb_Market_Settings]"));
$set         = web_settings();
item_expired();
$wh_content = array();
$il = 20;
$key= "";
$zen = 0;$stone=0;$rena=0;$credit=0;$soul=0;$chaos=0;$creation=0;$bless=0;$life=0;
$price_zen = 0;
$price_credit=0;
$table=""; $table1 ="";
echo $search[1] . "</br>";
switch($set[3]){
	  case "Aion": $style1 = "background:url(imgs/1.png)"; $style2 = "<img src='imgs/2.png' class='m'/>";break;
	  default:$style1='background:url(imgs/takenslotbg.jpg)'; $style2 = "<img src='imgs/emptyslotbg.jpg' class='m'/>";break;
  }
if(isset($_SESSION['dt_username'])){

$res_req   = array( 
  "Zen"       => $settings['zen'], 
  "Rena"      => $settings['rena'], 
  "Credits"   => $settings['credits'], 
  "Stone"     => $settings['stone'], 
  "Bless"     => $settings['bless'], 
  "Soul"      => $settings['soul'], 
  "Chaos"     => $settings['chaos'], 
  "Creation"  => $settings['creation'], 
  "Life"      => $settings['life']  
);

if($settings[7] > 0 || $settings[8] > 0 || $settings[9] > 0 || $settings[10] > 0 || $settings[11] > 0 || $settings[12] > 0 || $settings[13] > 0 || $settings[14] > 0 || $settings[15] > 0){
	foreach($res_req as $resource => $amount){
		if($amount == 0){
		$table_info  .=  "";	
		}
		else{
		$table_info  .=  $resource ." \n " .number_format($amount) ." \n | "; 
		}		
	}
  $wh_content[] = "<div class='title'>" . phrase_price_selling .":</br>" . $table_info . "</div>"; 
}

if (isset($_POST['gogo'])) {

$decrypt   = decrypt($_POST['gogo']);

if(($decrypt != false)){ 
   market_sell($decrypt,$zen,$stone,$rena,$credit,$soul,$chaos,$creation,$bless,$life,$_POST['gogo']);
 }
 else{
	echo phrase_market_error_contact_admin; 
 }
}

    $item_opt = season();
    $user_items = all_items($_SESSION['dt_username'],$item_opt[1]);
	$wh_content[] .=  '<table class="vaults">'; 
    $check = '011111111';
    $xx = 0;
    $yy = 1;
    $line = 1;
    $onn = 0;
    $i = -1;
    while ($i < 119) {
	$i++;
	if ($xx == 8) {
	    $xx = 1;
	    $yy++;
	}
	else
	$xx++;
	$TT = substr($check, $xx, 1);
	if ((round($i / 8) == $i / 8) && ($i != 0)) {
	$wh_content[] =  "<td class=\"itemblock\" width=\"32\" height=\"32\" align=center><b>".$line."</b></td></tr><tr>";
	$line++;
	}
	$l = $i;
	$item2 = substr($user_items, ($item_opt[0] * $i), $item_opt[0]);
	$item = ItemInfoUser(substr($user_items, ($item_opt[0] * $i), $item_opt[0]));

	if (!$item['y'])
	    $InsPosY = 1;
	else
	    $InsPosY=$item['y'];

	if (!$item['x'])
	    $InsPosX = 1;
	else {
		
	    $InsPosX = $item['x'];
	    $xxx = $xx;
	    $InsPosXX = $InsPosX;
	    $InsPosYY = $InsPosY;
	    while ($InsPosXX > 0) {
		$check = substr_replace($check, $InsPosYY, $xxx, 1);
		$InsPosXX = $InsPosXX - 1;
		$InsPosYY = $InsPosY + 1;
		$xxx++;
	    }
	} 
	$item['name'] = addslashes($item['name']);
	if ($TT > 1)

	    $check = substr_replace($check, $TT - 1, $xx, 1);
	else {
	    unset($plusche, $rqs, $luck, $skill, $option, $exl);
	    if ($item['name']) {
		for($k = 1; $k < 5;++$k){
			$key .= $k;		
		}

	if($settings[5] > 1 || $settings[6] > 1){
	   if($settings[5]> 1 && $settings[6] > 0) {
		$price_zen    = $settings[5];  
	    $table = phrase_last_zen_price ."<p id='market_zen{$i}'>0</p>";
	   }
	   if($settings[5]> 0 && $settings[6] > 1){
		$price_credit = $settings[6];  
	    $table1 = phrase_last_credit_price . "<p id='market_cr{$i}'>0</p>";
	   }
	}

    $enc_serial = encrypt($item2);

$wh_content[] .= "
<script>
function price_zen{$i}(sum, fixed_price)
{
	document.getElementById('market_zen{$i}').innerHTML = Math.ceil(sum * fixed_price);
}
function price_credits{$i}(sum, fixed_price)
{
	document.getElementById('market_cr{$i}').innerHTML = Math.ceil(sum* fixed_price);
}
</script>
<td style='".$style1."' align=\"center\" colspan='" . $InsPosX . "' rowspan='" . $InsPosY . "' style='width:" . (32 * $InsPosX) . "px;height:" . (32 * $InsPosY - $InsPosY - 1) . "px;' >  
<script>function fireMyPopup{$i}() {document.getElementById(\"mypopup{$i}\").style.display = \"block\";}</script>
 <div class='sell new_sell' id='mypopup{$i}' name='mypopup{$i}' >
    <form method='post' class='form' name='sell{$i}'><img src=".$item['thumb']."> ".$item['overlib']."<br>
      
		<input type='hidden' name='gogo' value='{$enc_serial}'>
     <div class='title'>".phrase_sell_for."</div></br>
	 <table >
	 <tr>
	
	      <td style='font-size:7pt;'>&nbsp;".phrase_zen.":      <input onkeyup='price_zen{$i}(this.value,".$price_zen.")' name='zen'  type='text'  style='height: 25px;  width:33px;'  maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'> </td>
	      <td style='font-size:7pt;'>".phrase_stone.":    <input name='stone'  type='text'  style='height: 25px;  width:33px;'  maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'> </td>
          <td style='font-size:7pt;'>&nbsp;&nbsp;".phrase_rena.":     <input name='rena'   type='text'  style='height: 25px;  width:33px;'  maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'>  </td>

	 </tr>
    <tr>
	     <td style='font-size:7pt;'>".phrase_credits.":     <input onkeyup='price_credits{$i}(this.value,".$price_credit.")' name='credit' id= 'credit' type='text'  style='height: 25px;  width:33px;' maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'> </td>
	     <td style='font-size:7pt;'>".phrase_jewel_bless.": <input name='bless'   type='text'  style='height: 25px;  width:33px;' maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'></td> 
         <td style='font-size:7pt;'>&nbsp;&nbsp;".phrase_jewel_chaos.": <input name='chaos'   type='text'  style='height: 25px;  width:33px;' maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'></td>
	</tr>
	<tr>
	    <td style='font-size:7pt;'>".phrase_jewel_soul.":  <input name='soul'  type='text'  style='height: 25px;  width:33px;' maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'> </td>
	    <td style='font-size:7pt;'>&nbsp;&nbsp;".phrase_jewel_life.":  <input name='life'  type='text'  style='height: 25px;  width:33px;' maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'> </td>
	    <td style='font-size:7pt;'>".phrase_jewel_creation.":  <input name='creation' type='text'  style='height: 25px;  width:33px;' maxlength='3' onkeypress='return event.charCode >= 48 && event.charCode <= 57' value='0'> </td>
	 </tr> 
	 </table>
     <div style='margin:10px 10px;'>
	    
        <input type='button' style='width:100px;' value='".phrase_sell."' onclick=\"sell{$i}.submit()\").style.display=\"none\">
        <input type='button' style='width:100px;' value='".phrase_cancel."' align=center onClick='document.getElementById(\"mypopup{$i}\").style.display=\"none\"'>
     </div>
	 
	
	 ".$table.$table1."
   </form>
 </div>
<a class=\"someClass\" title=\"<br>".$item['overlib']."\"  href=\"javascript:void(0)\" onclick=\"fireMyPopup{$i}()\" style='width:" . (32 * $InsPosX) . "px;height:" . (32 * $InsPosY - $InsPosY - 1) . "px;'><img style='width:" . (32 * $InsPosX) . "px;height:" . (32 * $InsPosY - $InsPosY - 1) . "px;' src='" . $item['thumb'] . "' class='m' /></td>";
	    } 
		else {
$wh_content[] = "<td colspan='0' rowspan='1' style='width:32px;height:32px;border:0px;margin:0px;padding:0px;'><div style='height: 32px;width: 32px;'>".$style2."</div></td>";
	    }
		
	  }
    }
	$wh_content[] =  "<td class=\"itemblock\" align=center><b>15</b></td></tr><tr><td class=\"itemblock\" align=center height=32><b>1</b></td><td class=\"itemblock\" align=center><b>2</b></td><td class=\"itemblock\" align=center><b>3</b></td><td class=\"itemblock\" align=center><b>4</b></td><td class=\"itemblock\" align=center><b>5</b></td><td class=\"itemblock\" align=center><b>6</b></td><td class=\"itemblock\" align=center><b>7</b></td><td class=\"itemblock\" align=center><b>8</b></td><td class=\"itemblock\" align=center><a class='someClass' title='".$set[0]."'>X</a></td></tr></table>";
	
foreach ($wh_content as $wh){
	echo "<center >" .$wh ."</center>";
  }
}
else{
	echo "<div class='error'>".phrase_login_first."</div>";
}
?>
<!-- 
//////////////////////////////////////////////////////
             Market System by r00tme
               date 15/12/2015 
This Market has been made for a friend as a gift but 
I decided to share it to all DarksTeam members !
//////////////////////////////////////////////////////
 -->