<!-- 
//////////////////////////////////////////////////////
             Market System by r00tme
               date 15/12/2015 
This Market has been made for a friend as a gift but 
I decided to share it to all DarksTeam members !
//////////////////////////////////////////////////////
 -->
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	
 
<?php


$user = $_SESSION['dt_username'];
$set         = web_settings();
switch($set[3]){
	  case "Aion": $style1 = "background:url(imgs/1.png)"; $style2 = "<img src='imgs/2.png' class='m'/>";break;
	  default:$style1='background:url(imgs/takenslotbg.jpg)'; $style2 = "<img src='imgs/emptyslotbg.jpg' class='m'/>";break;
  }
if(isset($_POST['storage'])){
if (isset($_POST['s'])) {
$decrypt   = decrypt($_POST['gogo']);
if(($decrypt != false)){ 
$itemsa  = ItemInfoUser($decrypt);
   storage_in($decrypt,$itemsa['id'],$itemsa['type']);
 }
 else{
	echo phrase_market_error_contact_admin; 
  }
 }	
}

if(isset($_POST['market'])){
	header("Location:?p=market&select=warehouse");
}
echo "<table width = '100%'  class='table'><tr class='title'><td>Your Warehouse</td></tr></table>";
    $il = $option['item_hex_lenght']; 
    $user_items = all_items($user,1200);
	echo '<table class="vaults">'; 
    $check = '011111111';
    $xx = 0;
    $yy = 1;
	$key = "";
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
	echo "<td class=\"itemblock\" width=\"32\" height=\"32\" align=center><b>".$line."</b></td></tr><tr>";
	$line++;
	}
	$l = $i;
	$item2 = substr($user_items, ($il * $i), $il);
	$item = ItemInfoUser(substr($user_items, ($il * $i), $il));

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

	if($set[5] > 1 || $set[6] > 1){
	   if($set[5]> 1 && $set[6] > 0) {
		$price_zen    = $set[5];  
	    $table = phrase_last_zen_price ."<p id='market_zen{$i}'>0</p>";
	   }
	   if($set[5]> 0 && $set[6] > 1){
		$price_credit = $set[6];  
	    $table1 = phrase_last_credit_price . "<p id='market_cr{$i}'>0</p>";
	   }
	}

 
    $enc_serial = encrypt($item2);
	
echo "
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
          <input type='hidden' name='s'>
		  <input type='hidden' name='gogo' value=".$enc_serial.">
	         <input type='submit' style='width:100px;' value='".phrase_deposit_storage."' name='storage'>
	        <input type='submit' style='width:100px;' value='".phrase_go_market."' name='market'>
	        <input type='button' style='width:100px;' value='".phrase_cancel."' align=center onClick='document.getElementById(\"mypopup{$i}\").style.display=\"none\"'>
	</form>
 </div> 

<a class=\"someClass\" title=\"<br>".$item['overlib']."\"  href=\"javascript:void(0)\" onclick=\"fireMyPopup{$i}()\" style='width:" . (32 * $InsPosX) . "px;height:" . (32 * $InsPosY - $InsPosY - 1) . "px;'><img style='width:" . (32 * $InsPosX) . "px;height:" . (32 * $InsPosY - $InsPosY - 1) . "px;
border:0px;margin:0px;padding:0px;' src='" . $item['thumb'] . "' class='m' /></td>";
	    } 
		else {
echo "<td colspan='0' rowspan='1' style='width:32px;height:32px;border:0px;margin:0px;padding:0px;'><div style='height: 32px;width: 32px;'>".$style2."</div></td>";
	    }
		
	  }
    }
	echo "<td class=\"itemblock\" align=center><b>15</b></td></tr><tr><td class=\"itemblock\" align=center height=32><b>1</b></td><td class=\"itemblock\" align=center><b>2</b></td><td class=\"itemblock\" align=center><b>3</b></td><td class=\"itemblock\" align=center><b>4</b></td><td class=\"itemblock\" align=center><b>5</b></td><td class=\"itemblock\" align=center><b>6</b></td><td class=\"itemblock\" align=center><b>7</b></td><td class=\"itemblock\" align=center><b>8</b></td><td class=\"itemblock\" align=center><a class='someClass' title='".$set[0]."'>X</a></td></tr></table>";
	


  
  
  
?>
<!-- 
//////////////////////////////////////////////////////
             Market System by r00tme
               date 15/12/2015 
This Market has been made for a friend as a gift but 
I decided to share it to all DarksTeam members !
//////////////////////////////////////////////////////
 -->