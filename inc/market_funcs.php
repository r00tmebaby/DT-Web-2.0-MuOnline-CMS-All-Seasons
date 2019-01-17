<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
/////////////////////////////////////////////////////////////////////////////////
//  This market functions are created and implemented only for DT web 2.0 /////// 
// I can not give you any guarantee that the will work properly somewhere else //
//  You have to manage it yourself///////////////////////////////////////////////
//////////Created for DT web 2.0 ////////////////////////////////////////////////
//////////    1/04/2018   //////////////////////////////////////////////////////
///////////   by r00tme   ///////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


function item_expired(){
	$settings  = mssql_fetch_array(mssql_query("Select * from [DTweb_Market_Settings]"));
	if($settings ['end_timing'] > 0){
	$today = time();
	$check_items = mssql_query("Select [end_date],[id] from [DTweb_Market_Settings] where [is_sold] = 0 and [end_date] > 0");
    for($i=0, $count = mssql_num_rows($check_items); $i < $count; $i++){
	    
	   $expires = mssql_fetch_array($check_items);	
   
	   if($today > $expires['end_date']){		 
			mssql_query("Update [DTweb_Market] set [is_sold] = 1 where [id] = '".$expires['id']."'");
	  }
	}
  }
}

function valid_item($item){
require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
  $chk_serial  = substr($item, 6,8);
  if ($chk_serial == "00000000" || (strlen($item) != $option['item_hex_lenght']) || (!preg_match("/(^[a-zA-Z0-9])/", $item)) || ($item == str_repeat('F',$option['item_hex_lenght']))) {
      return false;
  }else{
	  return true;
  }
}

function gm_warehouse($account,$level_req=0,$ui=0) {
$form = "";	
$ui++;
$set         = web_settings();
$wh_content  = array();
$empty       = 'FFFFFFFFFFFFFFFFFFFF';
switch($set[3]){
	  case "Aion": $img1= "1.png"; $img2 = "2.png";break;
	  default:$img1='takenslotbg.jpg'; $img2 = "emptyslotbg.jpg";break;
  }

    $il = 20; 
	
$user_items = all_items($account,1200);
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
	$item2 = substr($user_items, ($il * $i), $il);
	$item = ItemInfoUser(substr($user_items, ($il * $i), $il),$level_req);

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
		$key = '';
	    if ($item['name']) {
		for($k = 1; $k < 5;++$k){
			$key .= $k;		
		}

if(isset($_POST['item_id'])){
	
	if($level_req > 2){
		$error = 1;
	if (preg_match("/{$_POST['item_id']}/", $user_items)){
	    $mynewitems      = str_replace($_POST['item_id'], $empty, $user_items);	
     $error = 0;		
	}
     if($error == 0){
		 mssql_query("Update [warehouse] set [Items]=0x" . $mynewitems . " WHERE [AccountId]='" . $account . "'");
	refresh();
	 }
	}
}
if($level_req > 2){
	$form = 
	"
	<div style='margin:10px 10px;'>	  
	   <form name='nas".$ui."' method='post'> <input name='item_id' value='".$item2."' type='hidden'/>
        <input type='submit' name='del_item' style='width:100px;' value='".phrase_delete."' onclick=\"sell{$i}.submit()\").style.display=\"none\">
        <input type='button' style='width:100px;' value='".phrase_cancel."' align=center onClick='document.getElementById(\"mypopup{$i}\").style.display=\"none\"'>
     </div>
    </form>
	";
}
$wh_content[] = "

     <td style='background-repeat:no-repeat;background-image:url(imgs/".$img1.");' align=\"center\" colspan='" . $InsPosX . "' rowspan='" . $InsPosY . "' style='width:" . (32 * $InsPosX) . "px;height:" . (32 * $InsPosY - $InsPosY - 1) . "px;' >  
     <script>function fireMyPopup{$i}() {document.getElementById(\"mypopup{$i}\").style.display = \"block\";}</script>
     <div class='sell new_sell' id='mypopup{$i}' name='mypopup{$i}' >".$form."</div>

<a class=\"someClass\" title=\"<br>".$item['overlib']."\"  href=\"javascript:void(0)\" onclick=\"fireMyPopup{$i}()\" style='width:" . (32 * $InsPosX) . "px;height:" . (32 * $InsPosY - $InsPosY - 1) . "px;'><img style='width:" . (32 * $InsPosX) . "px;height:" . (32 * $InsPosY - $InsPosY - 1) . "px;' src='" . $item['thumb'] . "' class='m' /></td>";
	    } 
		else {
$wh_content[] = "<td colspan='0' rowspan='1' style='width:32px;height:32px;border:0px;margin:0px;padding:0px;'><div style='height: 32px;width: 32px;'><img src='imgs/{$img1}' class='m'></div></td>";
	    }
		
	  }
    }
	$wh_content[] =  "<td class=\"itemblock\" align=center><b>15</b></td></tr><tr><td class=\"itemblock\" align=center height=32><b>1</b></td><td class=\"itemblock\" align=center><b>2</b></td><td class=\"itemblock\" align=center><b>3</b></td><td class=\"itemblock\" align=center><b>4</b></td><td class=\"itemblock\" align=center><b>5</b></td><td class=\"itemblock\" align=center><b>6</b></td><td class=\"itemblock\" align=center><b>7</b></td><td class=\"itemblock\" align=center><b>8</b></td><td class=\"itemblock\" align=center><a class='someClass' title='".$set[0]."'>X</a></td></tr></table>";
	
foreach ($wh_content as $wh){
	echo "<div style='float:right;margin-top:20px;'>". $wh ."</div>";
  }
}

function decrypt($data){
 return base64_decode($data);
}


function encrypt($data){
 return base64_encode($data);
}

function all_items($account,$lenght,$table = "warehouse",$user_col="AccountId",$item_col="items"){
	
    if(phpversion() >= "5.3"){
		$itemsa = mssql_fetch_array(mssql_query("SELECT [".$item_col."] FROM [".$table."] WHERE [".$user_col."]='".$account."'"));
		  return strtoupper(bin2hex($itemsa[$item_col]));
	}
	else{
		  return substr(mssql_get_last_message(mssql_query("declare @items varbinary(".$lenght."); set @items=(select [".$item_col."] from [".$table."] where [".$user_col."]='".$account."'); print @items;")),2);	        	
	}
}

 function market_buy($item_id,$buyer){
	 require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
      $success     = 0;
	  $user        = (string)clean_post($buyer); 
	  $id          = (int)clean_post($item_id);
	  $message     = array();
	  $owner       = 0;
      $market_item = mssql_query("Select * from [DTweb_Market] where [id] = '".$id."'");
	  $market_pr   = mssql_fetch_array($market_item);
      $buyer_res   = mssql_fetch_array(mssql_query("Select * from [DTweb_JewelDeposit] where [memb___id] = '".$user."'"));
	  $buyer_zen   = mssql_fetch_array(mssql_query("Select [Zen] from [DTweb_Bank] where [memb___id] = '".$user."'"));
	  $buyer_cr    = mssql_fetch_array(mssql_query("Select [Credits] from [Memb_Credits] where [memb___id] = '".$user."'"));
	  $mycuritems  = all_items($user,1200);
	  $place       = item_x_y($market_pr['item']); 
	  $slot        = smartsearch($mycuritems, $place['x'], $place['y']);
	  $item        = ItemInfoUser($market_pr['item']);
      $test        = $slot * 20;	  
      $mynewitems  = substr_replace($mycuritems, $market_pr['item'], ($test), 20);    
 
	  if($market_pr['seller'] === $user){ 
	     $owner = 1;
		 $market_pr['creation']=0;$market_pr['credit']=0;$market_pr['zen']=0;$market_pr['stone']=0; $market_pr['rena']=0;$market_pr['bless']=0;$market_pr['soul']=0;$market_pr['life']=0;$market_pr['chaos']=0;
	  }
      
      if((mssql_num_rows($market_item)) == 0){
		    $message[] = phrase_market_invalid_item;
	  }
	  elseif($market_pr['is_sold'] == 1){ 
		 $message[] = phrase_market_invalid_item;
	  }
	  elseif($owner == 1 && $market_pr['is_sold'] == 1){
		  $message[] = phrase_market_invalid_item;
	  }
      elseif(mssql_num_rows(mssql_query("Select * From MEMB_STAT WHERE ConnectStat=1 and memb___id='".$user."'")) != 0){
			$message[] = phrase_leave_the_game;
	  }
	  elseif($buyer_res['stone'] < $market_pr['stone']){
			$message[] = phrase_not_enough . phrase_stone;
	  }
	  elseif($buyer_res['rena'] < $market_pr['rena']){
			$message[] = phrase_not_enough . phrase_rena;
	  }
	  elseif($buyer_res['bless'] < $market_pr['bless']){
			$message[] = phrase_not_enough . phrase_jewel_bless;
	  }
	  elseif($buyer_res['soul'] < $market_pr['soul']){
			$message[] = phrase_not_enough . phrase_jewel_soul;
	  }
	  elseif($buyer_res['life'] < $market_pr['life']){
			$message[] = phrase_not_enough . phrase_jewel_life;
	  }
	  elseif($buyer_res['chaos'] < $market_pr['chaos']){
			$message[] = phrase_not_enough . phrase_jewel_chaos;
	  }
	  elseif($buyer_res['creation'] < $market_pr['creation']){
			$message[] = phrase_not_enough . phrase_jewel_creation;
	  }
	  elseif($buyer_zen['Zen'] < $market_pr['zen']){
			$message[] = phrase_not_enough . phrase_zen;
	  }
   	  elseif($buyer_cr['Credits'] < $market_pr['credit']){
			$message[] = phrase_not_enough . phrase_credits;
	  }
	  elseif($slot == 1337){
			$message[] = phrase_not_enough_place;
	  }
	  else{
		  if($owner == 1){
			$success = 1;
			mssql_query("Update [DTweb_Market] set [is_sold] = '1', purchased_by = '".$market_pr['seller']."' where [id]='".$id."'");
            mssql_query("Update [warehouse] set [Items]=0x" . $mynewitems . " where [AccountId]='".$user."'");
            $message[] = phrase_itemа. "<div style='display:inline;text-shadow:1px 1px #000;color:#ffa64c; font-size:11pt;'>" . $item['name'] ."</div>" . phrase_itemа_success_re;
            refresh1();
		}
		  else{
			$success = 1;
			mssql_query("Update [DTweb_Market] set [is_sold] = '1', [sold_date]='".time()."', [purchased_by]='".$user."', [buyer_ip] = '".ip()."' where [id]='".$id."'");
		    mssql_query("Update [DTweb_JewelDeposit] set [rena]=[rena] - '{$market_pr['rena']}',[stone]=[stone] - '{$market_pr['stone']}',[soul]=[soul] - '{$market_pr['soul']}',[chaos]=[chaos] - '{$market_pr['chaos']}',[bless]=[bless] - '{$market_pr['bless']}',[creation]=[creation] - '{$market_pr['creation']}',[life]=[life] - '{$market_pr['life']}' where [memb___id] = '".$user."'");
			mssql_query("Update [Memb_Credits] set [credits] = [credits] - '{$market_pr['credit']}' where [memb___id] = '".$user."'");
			mssql_query("Update [DTweb_Bank] set [zen] = [zen] - '{$market_pr['zen']}' where [memb___id] = '".$user."'");
		    mssql_query("Update [warehouse] set [Items]=0x" . $mynewitems . " where [AccountId]='".$user."'");
            mssql_query("Update [DTweb_JewelDeposit] set [rena]=[rena] + '{$market_pr['rena']}',[stone]=[stone] + '{$market_pr['stone']}',[soul]=[soul] + '{$market_pr['soul']}',[chaos]=[chaos] + '{$market_pr['chaos']}',[bless]=[bless] + '{$market_pr['bless']}',[creation]=[creation] + '{$market_pr['creation']}',[life]=[life] + '{$market_pr['life']}' where [memb___id] = '".$market_pr['seller']."'");
			mssql_query("Update [Memb_Credits] set [credits] = [credits] + '{$market_pr['credit']}' where [memb___id] = '".$market_pr['seller']."'");
			mssql_query("Update [DTweb_Bank] set [zen] = [zen] + '{$market_pr['zen']}' where [memb___id] = '".$market_pr['seller']."'");
			$message[] = phrase_itemа. "<div style='display:inline;text-shadow:1px 1px #000;color:#ffa64c; font-size:11pt;'>" . $item['name'] ."</div>" . phrase_itemа_success_re;

            refresh1();
		}
			  
	}
  message($message,$success);	
}
     
function market_sell($item_serial,$zen,$stone,$rena,$credit,$soul,$chaos,$creation,$bless,$life,$decrypt){
require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
$success     = 0;
$zen         = clean_post($_POST['zen']);
$stone       = clean_post((int)($_POST['stone']));
$rena        = clean_post((int)($_POST['rena']));
$credit      = clean_post((int) round($_POST['credit']));
$soul        = clean_post((int)($_POST['soul']));
$chaos       = clean_post((int)($_POST['chaos']));
$creation    = clean_post((int)($_POST['creation']));
$bless       = clean_post((int)($_POST['bless']));
$life        = clean_post((int)($_POST['life']));
$user        = $_SESSION['dt_username'];
$settings    = mssql_fetch_array(mssql_query("Select * from [Market_Settings]"));
$rez         = mssql_fetch_array(mssql_query("Select [AccountId],[Items],[Money] from [warehouse] where [AccountID]='".$user."'"));
$is_online   = mssql_fetch_array(mssql_query("Select [ConnectStat] from [MEMB_STAT] WHERE [memb___id]='".$user."'"));    
$check_sms   = mssql_num_rows(mssql_query("Select * from [sms_logs] WHERE [account]='".$user."'")); 
$check_res   = mssql_fetch_array(mssql_query("Select * from [DTweb_JewelDeposit]_Items where [memb___id]='".$user."'"));
$check_zen   = mssql_fetch_array(mssql_query("Select zen from [DTweb_Bank] where [memb___id]='".$user."'"));
$chk_resets  = mssql_fetch_array(mssql_query("Select Max(Resets) from [character] where [AccountID]='".$user."'"));
$check_cr    = mssql_fetch_array(mssql_query("Select credits from [Memb_Credits] where memb___id='".$user."'"));
switch($settings['sms_request']){case 1:$check_sms = $check_sms;break;default:$check_sms = true;break;}	
$end_date    = strtotime("+".$settings['end_timing']."seconds",time());
$upd_zen     = bcmul($zen,$settings['zen_multi']);
$upd_credit  = round($credit * $settings['credits_multi']);
$all_banned  = mssql_query("Select * from [DTweb_JewelDeposit_Items] where [banned] = 1");
$messages    = array();
$wh_content  = array();
$item        = ItemInfoUser($item_serial);
$banned      = array();

for($i=0, $max = mssql_num_rows($all_banned);$i < $max; $i++){
	$itemsa = mssql_fetch_array($all_banned);	
	$banned[] = ($itemsa['type'].$itemsa['id']);	
	 
}

    
	if(valid_item($item_serial) == false){
		$messages[] = phrase_market_invalid_item;
	}
	elseif (in_array($item['id'].$item['type'],$banned)) {
	    $messages[] = phrase_market_banned_item;
	}
	elseif ($is_online['ConnectStat'] != 0) {
        $messages[] = phrase_leave_the_game;
	}	
    elseif ($zen == 0 && $rena == 0 && $soul == 0 && $credit == 0 && $stone == 0 && $life == 0 && $chaos == 0 && $creation == 0 && $bless == 0) {
        $messages[] = phrase_empty_fields;
	}	
	elseif(!is_numeric($zen) or !is_numeric($stone) or !is_numeric($rena) or !is_numeric($chaos) or !is_numeric($creation) or !is_numeric($life) or !is_numeric($bless) or !is_numeric($soul)){ 
        $messages[] = phrase_invalid_symbols;
	}		
	elseif($zen < 0 or $stone < 0  or $rena < 0 or $credit < 0 or $creation < 0 or $bless < 0 or $chaos < 0 or $soul < 0 or $bless < 0) {
	    $messages[] = phrase_correct_price;
	}
	elseif ($rez['AccountId'] != $_SESSION['dt_username']) {
	    $messages[] = phrase_market_item_not_yours;
	}
	elseif ($check_sms < $settings['sms_request']) {
	    $messages[] = phrase_market_sms_error;
	}
	elseif ($settings['reset_request'] > $check_res[0]) {
	    $messages[] = phrase_not_resets;
	}

	elseif ($settings['rena'] > $check_res['rena']) {
	    $messages[] = phrase_not_enough . phrase_rena;
	}
	elseif ($settings['zen'] > $check_zen[0]) {
	    $messages[] = phrase_not_enough . phrase_zen;
	}
    elseif ($settings['stone'] > $check_res['stone']) {
	    $messages[] = phrase_not_enough . phrase_stone;
	}
	elseif ($settings['credits'] > $check_cr[0]) {
	    $messages[] = phrase_not_enough . phrase_credits;
	}
	elseif ($settings['bless'] > $check_res['bless']) {
	    $messages[] = phrase_not_enough . phrase_jewel_bless;
	}
	elseif ($settings['soul'] > $check_res['soul']) {
	    $messages[] = phrase_not_enough . phrase_jewel_soul;
	}
	elseif ($settings['chaos'] > $check_res['chaos']) {
	    $messages[] = phrase_not_enough . phrase_jewel_chaos;
	}
	elseif ($settings['creation'] > $check_res['creation']) {
	    $messages[] = phrase_not_enough . phrase_jewel_creation;
	}
	elseif ($settings['life'] > $check_res['life']) {
	    $messages[] = phrase_not_enough . phrase_jewel_life;
	}	
	else{

    $item_level = id_type($item_serial);
    $itemtem    = ItemInfoUser($item_serial);	
	$mycuritems = all_items($user,1200);
     
	if (preg_match("/{$item_serial}/", $mycuritems)) {
	       $empty           = str_repeat("F",$option['item_hex_lenght']);
	       $mynewitems      = str_replace($item_serial, $empty, $mycuritems);
		
		    mssql_query("Update [DTweb_JewelDeposit] set [rena]=[rena] - '{$settings[8]}',[stone]=[stone] - '{$settings[10]}',[soul]=[soul] - '{$settings[12]}',[chaos]=[chaos] - '{$settings[13]}',[bless]=[bless] - '{$settings[11]}',[creation]=[creation] - '{$settings[14]}',[life]=[life] - '{$settings[15]}' where [memb___id] = '".$user."'");
			mssql_query("Update [Memb_Credits] set [credits] = [credits] - '{$settings[9]}' where [memb___id] = '".$user."'");
			mssql_query("Update [DTweb_Bank] set [zen] = [zen] - '{$settings[7]}' where [memb___id] = '".$user."'");
		  
		  if($settings[4] != 0){
	  	     $update_market   = mssql_query("INSERT INTO [DTweb_Market] ([item_type],[item_id],[item],[zen],[soul],[bless],[chaos],[creation],[life],[stone],[credit],[rena], [seller],[start_date],[is_sold],[seller_ip],[end_date],[name],[level],[skill],[luck],[options],[excellent]) VALUES('".$item_level["level1"]."','".$item_level["level2"] . "','".$item_serial."','".round($upd_zen)."','".$soul."','".$bless."','".$chaos ."','".$creation."','".$life ."','".$stone ."','".round($upd_credit) ."','".$rena ."','".$user."','".time()."','0','".ip()."','".$end_date."','".($itemtem['name'])."','".$itemtem['level']."','".$itemtem['srch_skill']."','".$itemtem['srch_luck']."','".$itemtem['opt']."','".$itemtem['exl']."')");
			 }
		  else {
		     $update_market   = mssql_query("INSERT INTO [DTweb_Market] ([item_type],[item_id],[item],[zen],[soul],[bless],[chaos],[creation],[life],[stone],[credit],[rena], [seller],[start_date],[is_sold],[seller_ip],[name],[level],[skill],[luck],[options],[excellent]) VALUES('".$item_level["level1"]."','".$item_level["level2"] . "','".$item_serial."','".round($upd_zen)."','".$soul."','".$bless."','".$chaos ."','".$creation."','".$life ."','".$stone ."','".round($upd_credit) ."','".$rena ."','".$user."','".time()."','0','".ip()."','".($itemtem['name'])."','".$itemtem['level']."','".$itemtem['srch_skill']."','".$itemtem['srch_luck']."','".$itemtem['opt']."','".$itemtem['exl']."')");	
		     
			 }
		if(!$update_market){
		
			$messages[] = phrase_market_error_contact_admin;
		}
		else{
	    mssql_query("Update [warehouse] set [Items]=0x" . $mynewitems . " WHERE [AccountId]='" . $user . "'");
		
	    $messages[] = phrase_market_the_item ."<div style='display:inline;text-shadow:1px 1px #000;color:#ffa64c; font-size:11pt;'>" . $itemtem['name'] ."</div>". phrase_market_the_item_success;        
		$success = 1;
		}
	 } 
    else {	
	    $messages[] = phrase_market_item_not_found;
	  }	  
	}
    message($messages,$success);
}


function strip($var){
$banned = array(";", "'","=","#","--");
$onlyconsonants = str_replace($banned, "", $var);
return $onlyconsonants;
}  

function search_items(){
$echo        = "";
$srchs       = array();
$message     = array();
$opt_levels = '';$cols1 =  "";$type='';$cols4 =  "";$cols2 =  "";$cols3 =  "";$cols5 =  "";$cols6 =  "";$cols7 =  "";$cols8 =  "";$cols10 = "";$cols11 = "";$cols12 = "";$cols13 = "";$cols15 = "";$cols9 = "";$cols16 = "";
$pagi   = 20;
$query_change = "";


for($i =1; $i<14; $i++){
	$opt_levels .= "<option value='".$i."'>".$i."</option>";
}
if(isset($_GET['type'])){
$types       = (string) trim(strip_tags($_GET['type']));
switch($types){
	           case "Swords":   $pagi = 0;$type="and [item_type]=0";    $cols1 =  "style='color:#fff'"; break;
	           case "Axes":     $pagi = 1;$type="and [item_type]=1";    $cols2 =  "style='color:#fff'"; break;
	           case "Maces":    $pagi = 2;$type="and [item_type]=2";    $cols3 =  "style='color:#fff'"; break;
	           case "Spears":   $pagi = 3;$type="and [item_type]=3";    $cols4 =  "style='color:#fff'"; break;
	           case "Bows":     $pagi = 4;$type="and [item_type]=4";    $cols5 =  "style='color:#fff'"; break;
	           case "Staffs":   $pagi = 5;$type="and [item_type]=5";    $cols6 =  "style='color:#fff'"; break;
	           case "Helmets":  $pagi = 7;$type="and [item_type]=7";    $cols7 =  "style='color:#fff'"; break;
	           case "Armors":   $pagi = 8;$type="and [item_type]=8";    $cols8 =  "style='color:#fff'"; break;
	           case "Gloves":   $pagi = 10;$type="and [item_type]=10";  $cols9 =  "style='color:#fff'"; break;
	           case "Pants":    $pagi = 9;$type="and [item_type]=9";    $cols10 = "style='color:#fff'"; break;
	           case "Boots":    $pagi = 11;$type="and [item_type]=11";  $cols11 = "style='color:#fff'"; break;
	           case "Shields":  $pagi = 6;$type="and [item_type]=6";    $cols12 = "style='color:#fff'"; break;
	           case "Jewelery": $pagi = 14;$type="and [item_type]='14'";$cols13 = "style='color:#fff'"; break;  
	           case "Wings":    $pagi = 12;$type="and [item_type]=12";  $cols15 = "style='color:#fff'"; break;
               case "All":      $pagi = 20;$type='';                    $cols16 = "style='color:#fff'"; break;	
               default:	      $pagi = 20;$type='';                    $cols16 = "style='color:#fff'"; break;					  
	         }	
}				  
echo  '
<script>
$("input").bind("keypress", function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});
</script>
     <center>
	 <div class="market_top">
	  <div class="afix"  style="margin:5px 5px;">
		<a '.$cols16.' href="index.php?p=market&type=All">All Items</a> | 
		<a '.$cols1.' href="index.php?p=market&type=Swords">Swords</a> |
		<a '.$cols2.' href="index.php?p=market&type=Axes">Axes</a> |
		<a '.$cols3.' href="index.php?p=market&type=Maces">Maces</a> |
		<a '.$cols4.' href="index.php?p=market&type=Spears">Spears</a> |
		<a '.$cols5.' href="index.php?p=market&type=Bows">Bows/X-Bows</a> |
		<a '.$cols6.' href="index.php?p=market&type=Staffs">Staffs</a> |
		<a '.$cols7.' href="index.php?p=market&type=Helmets">Helmets</a>  |
		<a '.$cols8.' href="index.php?p=market&type=Armors">Armors</a> | 
		<a '.$cols9.' href="index.php?p=market&type=Gloves">Gloves</a>  |
		<a '.$cols10.' href="index.php?p=market&type=Pants">Pants</a>  |
		<a '.$cols11.' href="index.php?p=market&type=Boots">Boots</a> |
		<a '.$cols12.' href="index.php?p=market&type=Shields">Shields</a>  
		<a '.$cols13.' href="index.php?p=market&type=Jewelery">Jewelery/Jewels</a>  |
		<a '.$cols15.' href="index.php?p=market&type=Wings">Wings/Cape</a> 
	 </div>            		
   <form name="'.form_enc().'" class="market_form" method="post">
	     <span>'.phrase_type_item_name.':</span>
            <input type="text" style="width:220px" pattern="^[a-zA-Z0-9]+$" name="item_name"/>
	        <select style="width:70px" name="levels">
			<option selected disabled>Level</option>
			'.$opt_levels.'</select>			  
			<select style="width:70px" name="skill">			
			    <option selected disabled>Skill</option>
			    <option value="1">Yes</option>
				</select>
			<select style="width:70px" name="luck">
			    <option selected disabled>Luck</option>
			    <option value="1">Yes</option>
			</select></br>
     <select style="width:150px" name="opt">			
        <option selected disabled >Options</option>
        <option value="1" >Additional Damage +4 </option>
        <option value="2" >Additional Damage +8 </option>
        <option value="3" >Additional Damage +12</option>
        <option value="4" >Additional Damage +20</option>
        <option value="5" >Additional Damage +24</option>
        <option value="6" >Additional Damage +28</option>
        <option disabled>------</option>
        <option value="7" >Additional Defence +4 </option>
        <option value="8" >Additional Defence +8</option>
        <option value="9" >Additional Defence +12</option>
        <option value="10" >Additional Defence +20</option>
        <option value="11" >Additional Defence +24</option>
        <option value="12" >Additional Defence +28</option>
     </select>
     <select style="width:150px" name="exl1">
        <option selected disabled>Excellent 1</option>
        <option value="1">Increase Zen After Hunt +40%</option>
        <option value="2">Defence success rate +10%</option>
        <option value="3">Reflect damage +5%</option>
        <option value="4">Damage Decrease +4%</option>
        <option value="5">Increase MaxMana +4%</option>
        <option value="6">Increase MaxHP +4%</option>
        <option  value="---" disabled="disabled">---</option>
        <option value="7">Increase attacking(wizardly)speed+7</option>
        <option value="8">Increase wizardly damage +2%</option>
        <option value="9">Increase Damage +level/20</option>
        <option value="10">Excellent Damage Rate +10%</option>
        <option value="11">+50 of damage transferred as Life</option>
        <option value="12">10% Mana loss instead of Life</option>
        <option  value="---" disabled="disabled">---</option>
        <option value="13">Additional Damage</option>
        <option value="14">Additional Defence</option>
        <option value="15">Life +</option>
        <option value="16">Mana +</option>
      </select> 

     <select style="width:150px" name="exl2">
        <option selected disabled>Excellent 2</option>
        <option value="1">Increase Zen After Hunt +40%</option>
        <option value="2">Defence success rate +10%</option>
        <option value="3">Reflect damage +5%</option>
        <option value="4">Damage Decrease +4%</option>
        <option value="5">Increase MaxMana +4%</option>
        <option value="6">Increase MaxHP +4%</option>
        <option  value="---" disabled="disabled">---</option>
        <option value="7">Increase attacking(wizardly)speed+7</option>
        <option value="8">Increase wizardly damage +2%</option>
        <option value="9">Increase Damage +level/20</option>
        <option value="10">Excellent Damage Rate +10%</option>
        <option value="11">+50 of damage transferred as Life</option>
        <option value="12">10% Mana loss instead of Life</option>
        <option  value="---" disabled="disabled">---</option>
        <option value="13">Additional Damage</option>
        <option value="14">Additional Defence</option>
        <option value="15">Life +</option>
        <option value="16">Mana +</option>
      </select>  
			   <input style="width:100px" type="submit" name="search" value="'.phrase_search.'"/>   
		</form>
	      <div class="afix market_bottom">
             <a href="?p=market&hop=marketw"><img src="imgs/arrow.png"> '.phrase_warehouse.'</a>
             <a href="?p=market&hop=market"><img src="imgs/arrow.png"> '.phrase_market.'</a>
	         <a href="?p=market&hop=marketmy"><img src="imgs/arrow.png"> '.phrase_my_items_on_market.'</a>
	         <a href="?p=market&hop=marketb"><img src="imgs/arrow.png"> '.phrase_my_bought_items.'</a>
	         <a href="?p=market&hop=markets"><img src="imgs/arrow.png"> '.phrase_my_sold_items.'</a>   
          </div>
	</div>';	
if(isset($_POST['search']))	{	
	$srch_name = strip($_POST['item_name']);
	
if(isset($_POST['opt'])){
    switch($_POST['opt']){
		case 1: $srch_opt = "Additional Damage +4 ";break;
		case 2: $srch_opt = "Additional Damage +8 ";break;
		case 3: $srch_opt = "Additional Damage +12";break;
		case 4: $srch_opt = "Additional Damage +20";break;
		case 5: $srch_opt = "Additional Damage +24";break;
		case 6: $srch_opt = "Additional Damage +28";break;
		case 7: $srch_opt = "Additional Damage +4 ";break;
		case 8: $srch_opt = "Additional Damage +8 ";break;
		case 9: $srch_opt = "Additional Damage +12";break;
		case 10:$srch_opt = "Additional Damage +20";break;
		case 11:$srch_opt = "Additional Damage +24";break;
		case 12:$srch_opt = "Additional Damage +28";break;
        default:$srch_opt = "";break;
	}
}
if(isset($_POST['luck'])){
	switch($_POST['luck']){
		case 1:  $luck = 1; break;
		default: $luck = 0; break;
	}
}
if(isset($_POST['skill'])){
	switch(isset($_POST['skill'])){
		case 1:  $skill = 1; break;
		default: $skill = 0; break;
	}
}
if(isset($_POST['exl1'])){
	switch($_POST['exl1']){
		case 1: $srch_exl1 = "Increase Zen After Hunt +40%";   break;
		case 2: $srch_exl1 = "Defence success rate +10%";   break;
		case 3: $srch_exl1 = "Reflect damage +5%";   break;
		case 4: $srch_exl1 = "Damage Decrease +4%";   break;
		case 5: $srch_exl1 = "Increase MaxMana +4%";   break;
		case 6: $srch_exl1 = "Increase MaxHP +4%";   break;
		case 7: $srch_exl1 = "Increase attacking(wizardly)speed+7";   break;
		case 8: $srch_exl1 = "Increase wizardly damage +2%";   break;
		case 9: $srch_exl1 = "Increase Damage +level/20";   break;
		case 10:$srch_exl1 = "Excellent Damage Rate +10%";  break;
		case 11:$srch_exl1 = "+50 of damage transferred as Life";  break;
		case 12:$srch_exl1 = "10% Mana loss instead of Life";  break;
		case 13:$srch_exl1 = "Additional Damage";  break;
		case 14:$srch_exl1 = "Additional Defence";  break;
		case 15:$srch_exl1 = "Life +";  break;
		case 16:$srch_exl1 = "Mana +";  break;
		default:$srch_exl1 = "";	
	}
}
if(isset($_POST['exl2'])){
	switch(($_POST['exl2'])){
		case 1: $srch_exl2 = "Increase Zen After Hunt +40%";   break;
		case 2: $srch_exl2 = "Defence success rate +10%";   break;
		case 3: $srch_exl2 = "Reflect damage +5%";   break;
		case 4: $srch_exl2 = "Damage Decrease +4%";   break;
		case 5: $srch_exl2 = "Increase MaxMana +4%";   break;
		case 6: $srch_exl2 = "Increase MaxHP +4%";   break;
		case 7: $srch_exl2 = "Increase attacking(wizardly)speed+7";   break;
		case 8: $srch_exl2 = "Increase wizardly damage +2%";   break;
		case 9: $srch_exl2 = "Increase Damage +level/20";   break;
		case 10:$srch_exl2 = "Excellent Damage Rate +10%";  break;
		case 11:$srch_exl2 = "+50 of damage transferred as Life";  break;
		case 12:$srch_exl2 = "10% Mana loss instead of Life";  break;
		case 13:$srch_exl2 = "Additional Damage";  break;
		case 14:$srch_exl2 = "Additional Defence";  break;
		case 15:$srch_exl2 = "Life +";  break;
		case 16:$srch_exl2 = "Mana +";  break;
		default:$srch_exl2 = "";
	}
}
	if(isset($_POST['levels'])){
	    if(is_numeric($_POST['levels'])){
	    	$levels = $_POST['levels'];
	    }
	    else{
	    	$levels = 0;
	    }
	}
if(!empty($srch_name)){	
	$srchs[] = " and name like '%{$srch_name}%' ". $type;
}
elseif(isset($_POST['luck'])&& !isset($_POST['levels']) && !isset($_POST['opt']) && !isset($_POST['skill'])&& !isset($_POST['exl1'])&& !isset($_POST['exl2'])){
	$srchs[] = " and [luck] = '{$luck}' ". $type;
}
elseif(isset($_POST['luck'])&& isset($_POST['exl2']) && !isset($_POST['opt']) && !isset($_POST['skill'])&& !isset($_POST['exl1']) && !isset($_POST['levels'])){
	$srchs[] = " and [luck] = '{$luck}' ". $type;
}
elseif(isset($_POST['luck'])&& isset($_POST['exl1']) && !isset($_POST['opt']) && !isset($_POST['skill'])&& !isset($_POST['exl2']) && !isset($_POST['levels'])){
	$srchs[] = " and [luck] = '{$luck}' ". $type;
}
elseif(isset($_POST['levels']) && !isset($_POST['luck']) && !isset($_POST['opt']) && !isset($_POST['skill'])&& !isset($_POST['exl1'])&& !isset($_POST['exl2'])){
	$srchs [] = " and [level] = '{$levels}' ". $type;
   }
elseif(isset($_POST['skill']) && !isset($_POST['levels']) && !isset($_POST['opt']) && !isset($_POST['luck'])&& !isset($_POST['exl1'])&& !isset($_POST['exl2'])){
	$srchs[] = " and [skill] = '{$skill}' ". $type;
}
elseif(isset($_POST['skill']) && isset($_POST['luck']) && !isset($_POST['levels']) && !isset($_POST['opt']) && !isset($_POST['exl1'])&& !isset($_POST['exl2'])){
	$srchs[] = " and [skill] = '{$skill}' and [luck] = '{$luck}'  ". $type;
}
elseif(isset($_POST['skill']) && isset($_POST['luck']) && isset($_POST['levels'])  && !isset($_POST['opt']) && !isset($_POST['exl1'])&& !isset($_POST['exl2'])){
	$srchs[] = " and [skill] = '{$skill}' and [luck] = '{$luck}'  and [level] = '{$levels}' ". $type;
}
elseif(isset($_POST['skill']) && isset($_POST['luck']) && isset($_POST['levels']) && isset($_POST['opt']) && !isset($_POST['exl1'])&& !isset($_POST['exl2'])){
	$srchs[] = " and [skill] = '{$skill}' and [luck] = '{$luck}'  and [options] = '{$srch_opt}'  and [level] = '{$levels}' ". $type;
}
elseif(isset($_POST['skill']) && isset($_POST['luck']) && isset($_POST['levels']) && isset($_POST['opt']) && isset($_POST['exl1']) && isset($_POST['exl2'])){
	$srchs[] = " and [skill] = '{$skill}' and [excellent] like '%{$srch_exl1}%' and [luck] = '{$luck}'  and [options] = '{$srch_opt}'  and [excellent] like '%{$srch_exl2}%' and [level] = '{$levels}' ". $type;
}
elseif(isset($_POST['opt']) && !isset($_POST['levels'])  && !isset($_POST['skill'])&& !isset($_POST['exl1'])&& !isset($_POST['exl2']) && !isset($_POST['luck'])){	
	$srchs[] = "  and [options] = '{$srch_opt}' ". $type;
}
elseif(isset($_POST['exl1']) && !isset($_POST['levels']) && !isset($_POST['opt']) && !isset($_POST['skill']) && !isset($_POST['exl2']) && !isset($_POST['luck'])){
	$srchs[] = " and [excellent] like '%{$srch_exl1}%' ". $type;
}
elseif(isset($_POST['exl2'])&& !isset($_POST['levels']) && !isset($_POST['opt']) && !isset($_POST['skill'])&& !isset($_POST['exl1']) && !isset($_POST['luck'])){
	$srchs[] = " and [excellent] like '%{$srch_exl2}%' ". $type;
}
elseif(isset($_POST['exl1']) && isset($_POST['levels']) && isset($_POST['opt']) && isset($_POST['exl2'])  && !isset($_POST['skill']) && !isset($_POST['luck'])){
	$srchs[] = " and [excellent] like '%{$srch_exl1}%' and [options] = '{$srch_opt}' and [excellent] like '%{$srch_exl2}%' and [level] = '{$levels}'  ". $type;
}
elseif(isset($_POST['exl1']) && isset($_POST['levels']) && isset($_POST['exl2']) && !isset($_POST['skill']) && !isset($_POST['exl1'])&& !isset($_POST['luck'])&& !isset($_POST['opt'])){
	$srchs[] = " and [excellent] like '%{$srch_exl1}%' and [excellent] like '%{$srch_exl2}%' and [level] = '{$levels}'  ". $type;
}
elseif(isset($_POST['exl1']) && isset($_POST['levels'])&& !isset($_POST['luck']) && !isset($_POST['exl2'])&& !isset($_POST['opt'])){
	$srchs[] = " and [excellent] like '%{$srch_exl1}%' and [level] = '{$levels}'  ". $type;
}
elseif(isset($_POST['exl2']) && isset($_POST['levels'])){
	$srchs[] = " and [excellent] like '%{$srch_exl2}%' and [level] = '{$levels}'  ". $type;
}
elseif(isset($_POST['exl1']) && isset($_POST['exl2']) && !isset($_POST['opt'])&& !isset($_POST['luck'])&& !isset($_POST['levels'])&& !isset($_POST['skill'])){
	$srchs[] = " and [excellent] like '%{$srch_exl2}%' and [excellent] like '%{$srch_exl1}%'". $type;
}
elseif(isset($_POST['exl1']) && isset($_POST['opt']) && !isset($_POST['exl2']) && !isset($_POST['levels'])&& !isset($_POST['skill'])){
	$srchs[] = " and [excellent] like '%{$srch_exl1}%' and [options] ='{$srch_opt}'". $type;
}
elseif(isset($_POST['exl2']) && isset($_POST['opt'])&& !isset($_POST['skill'])&& !isset($_POST['luck'])&& !isset($_POST['levels'])){
	$srchs[] = " and [excellent] like '%{$srch_exl2}%' and [options] = '{$srch_opt}'". $type;
}
elseif(isset($_POST['exl1']) && isset($_POST['exl2']) && isset($_POST['opt'])&& !isset($_POST['skill'])&& !isset($_POST['luck'])&& !isset($_POST['levels'])){
	$srchs[] = " and [excellent] like '%{$srch_exl2}%' and [excellent] = '%{$srch_exl1}%' and [options] = '{$srch_opt}' ". $type;
 }
}
else{
	$srchs [] = "".$type."";
}
    foreach($srchs as $key){
	$query_change .= $key;
   }

  return array($query_change,$echo,$pagi);
  
}
function storage_out($item_id,$buyer){
	  $success     = "";
	  $user        = clean_post($buyer); 
	  $id          = (int)($item_id);
      $market_item = mssql_query("Select * from [DTweb_Storage] where [id] = '".$id."'");
	  $market_pr   = mssql_fetch_array($market_item);
	  $mycuritems  = all_items($user,1200);
	  $item        = ItemInfoUser($market_pr['item']);
	  $slot        = smartsearch($mycuritems, $item['x'], $item['y']);
      $test        = $slot * 20;	  
      $mynewitems  = substr_replace($mycuritems, $market_pr['item'], ($test), 20);    
      $message     = array();
      if((mssql_num_rows($market_item)) == 0){
		    $message[] = phrase_storage_invalid_item;
	  }
      elseif(mssql_num_rows(mssql_query("Select * From MEMB_STAT WHERE ConnectStat=1 and memb___id='".$user."'")) != 0){
			$message[] = phrase_leave_the_game;
	  }
	  elseif($market_pr['end_date'] != 'NULL'){
		  $message[] = phrase_storage_invalid_item;
	  }
	  elseif($slot == 1337){
			$message[] = phrase_no_enough_space;
	  }
	  else{
	 
			$success = 1;
			mssql_query("Update [warehouse] set [Items]=0x" . $mynewitems . " where [AccountId]='".$user."'");
			mssql_query("Update [DTweb_Storage] set end_date='".time()."', buyer_ip='".ip()."' where [id]='".$id."'");
            $message[] = phrase_storage_the_item. "<span title=\"" . $item['name'] . " <br><br><img src=" . $item['thumb'] . "\" class=\"someClass\" >
            <font style=\"font-size: 14px;color:#ff5c26\">" . $item['name'] . " </span></font>" . phrase_itemа_success_re;
            refresh1();
		
			  
	}
    message($message,$success);	
}

function storage_in($item_serial,$item_id,$item_type){
	
include("configs/config.php"); 
if(isset($_SESSION['dt_username']))	{
$user        = ($_SESSION['dt_username']);
$rez         = mssql_fetch_array(mssql_query("Select [AccountId],[Items],[Money] from [warehouse] where [AccountID]='".$user."'"));
$is_online   = mssql_fetch_array(mssql_query("Select [ConnectStat] from [MEMB_STAT] WHERE [memb___id]='".$user."'"));    	
$messages    = array();
$wh_content  = array();
$item_level  = id_type($item_serial);
$itemtem     = ItemInfoUser($item_serial);	
$mycuritems  = all_items($user,1200);
$itemsa      = array($mycuritems);
	if (strlen($item_serial) != 20) {
	    $messages[] = phrase_market_invalid_item;
	}

	elseif (in_array($item_id."/".$item_type,$option['storage_banned_items'])) {
	    $messages[] = phrase_market_banned_item;
	}
    elseif ($is_online['ConnectStat'] != 0) {
        $messages[] = phrase_leave_the_game;
	}	
	elseif (in_array($item_serial,$itemsa)) {
	    $messages[] = phrase_market_item_not_yours;
	}
	elseif ($rez['AccountId'] != $_SESSION['dt_username']) {
	    $messages[] = phrase_market_item_not_yours;
	}	
	else{


	if (preg_match("/{$item_serial}/i", $mycuritems)) {
	    $empty           = "FFFFFFFFFFFFFFFFFFFF";
	    $mynewitems      = str_replace($item_serial, $empty, $mycuritems);
        
		$update_market   = mssql_query("INSERT INTO [DTweb_Storage] 
		([item_type],[item_id],[item],[seller],[start_date],[seller_ip],[name], [level],[skill],[luck],[options],[excellent]) VALUES
		('".$item_level["level1"]."','".$item_level["level2"] . "','".$item_serial."','".$user."','".time()."','".ip()."','".$itemtem['name']."','".$itemtem['level']."','".$itemtem['srch_skill']."','".$itemtem['srch_luck']."','".$itemtem['opt']."','".$itemtem['exl']."')");	
		     
		if(!$update_market){
			$messages[] = phrase_market_error_contact_admin;
		}
		else{
	    mssql_query("Update [warehouse] set [Items]=0x" . $mynewitems . " WHERE [AccountId]='" . $user . "'");
		
	    $messages[] = phrase_storage_the_item ."<span style=\"text-shadow:1px 1px; font-size:12pt;cursor: pointer;\" title=\"".$itemtem['name']." <br><br><img src=".$itemtem['thumb']." \" class=\"someClass\" >
        <font style=\"font-size: 14px;color:#ff5c26\">".$itemtem['name']." </span></font>". phrase_item_success_storage;        
		$success = 1;
		
		}
	 } 
    else {	
	    $messages[] .= phrase_storage_item_not_found;
	  }	  
	}
    message($messages,$success); 
  }
} 

function exist($var,$type = 0){
	$all = array();
	// if type = 0 (default) we search for an account else we search for character
	$check = mssql_query("Select * from Character");
	while($rows = mssql_fetch_array($check)){
		if($type === 0){
		  $all[] = $rows['AccountID'];
		}
		else{
		  $all[] = $rows['Name'];	
		}
	}
	if(in_array($var,$all)){
		if($type === 0){
		  return true;
		}
		else{
			if(isset($_SESSION['dt_username'])){
			   if(mssql_num_rows(mssql_query("Select * from Character where Name='".$var."' and AccountID='".$_SESSION['dt_username']."'")) === 1){
				return true;
			 }
              else{
              
              }			 
		  }
		  else{
			  return false;
		  }
	   }
	}
	else{
		return false;
	}
}

function gm_cl_warehouse($gmuser,$post){
	if(isset($post)){	
		    $check_exist = mssql_num_rows(mssql_query("Select * from warehouse where AccountID='".$gmuser."'"));
		if($check_exist < 0){
			mssql_query("Insert into warehouse (AccountID) values ('".$gmuser."')");
		}
		if(season()){
			  $info = season();
              mssql_query("Update [warehouse] set [items] = 0x".str_repeat("F",($info[1]*2))."  where [AccountID] = '".$gmuser."'");
		    }
		}
}

function itemSerial($l=8) {
        $query = mssql_fetch_array(mssql_query("exec WZ_GetItemSerial"));
		return sprintf("%08X", $query[0], 00000000);
}
	
function switch_box($count, $gmuser){
	include("configs/config.php");

	  $gm_level = check_admin($gmuser);
	    $hex_template = "";
		$name ='';	
		$bank = "";
		$available_box = array();
		$deposited_box = "";
		$query_gm   = mssql_fetch_array(mssql_query("Select account,box1,box2,box3,box4,box5 from DTweb_GM_Box_Adder_Logs where end_date='".gm_box_timer($gmuser)."'"));
	    $query_bank = mssql_fetch_array(mssql_query("Select box1,box2,box3,box4,box5 from [DTweb_GM_Box_Inventory] where [memb___id]='".$gmuser."'"));	
			switch ($count) {
                  case 1: 
				       
					  $hex_template = "CB400000000000800000";
		          	  $name ='Box of Kundun +1';
					  $column="[box1]";
					  $bank = $query_bank['box1'];
					  $available_box = $option["GM_".$gm_level[1]."_box".$count.""] - $query_gm['box1'];
					  $deposited_box = $query_gm[1]; 
                      break;
                  case 2: 
					  $hex_template = str_replace("%SERIAL%", itemSerial(8), "CB4800%SERIAL%800000");
		          	  $name='Box of Kundun +2';
					  $column ="[box2]";					  
					  $bank = $query_bank['box2'];
					  $available_box = $option["GM_".$gm_level[1]."_box".$count.""] - $query_gm['box2'];
					  $deposited_box = $query_gm[2];
                      break;
                  case 3: 
					  $hex_template = str_replace("%SERIAL%", itemSerial(8), "CB5000%SERIAL%800000");
		              $name='Box of Kundun +3';
					  $column="[box3]";
					  $bank = $query_bank['box3'];
					  $available_box = $option["GM_".$gm_level[1]."_box".$count.""] - $query_gm['box3'];
					  $deposited_box = $query_gm[3];
                      break;           
                  case 4:
					  $hex_template = str_replace("%SERIAL%", itemSerial(8), "CB5800%SERIAL%800000"); 
		          	  $name='Box of Kundun +4';
					  $column="[box4]";
					  $bank = $query_bank['box4'];
					  $available_box = $option["GM_".$gm_level[1]."_box".$count.""] - $query_gm['box4'];
					  $deposited_box = $query_gm[4];
                      break;
                  case 5:			  
				      $hex_template = str_replace("%SERIAL%", itemSerial(8), "CB6000%SERIAL%800000");                     
		           	  $name='Box of Kundun +5';	
                      $column="[box5]";	
					  $bank = $query_bank['box5'];
                      $available_box = $option["GM_".$gm_level[1]."_box".$count.""] - $query_gm['box5'];	
                      $deposited_box = $query_gm[5];					  
                      break;
                  default:
					 exit("<div class='error'>Невалиден бокс</div>");
		        };
				
		return array($hex_template,$name,$column,$count,$bank,$available_box,$deposited_box);
}
function create_box_bank($account){
			$box_bank = mssql_query("Select * from [DTweb_GM_Box_Inventory] where [memb___id] = '".$account."'");
            $checks = check_admin($account);
   		    if($checks[0] != null){
				if(((mssql_num_rows($box_bank)) == 0)){
					mssql_query("Insert into DTweb_GM_Box_Inventory ([memb___id],box1,box2,box3,box4,box5,gm_level) VALUES ('".$account."','0','0','0','0','0','".$checks[1]."')");
				}
			}
}

function gm_box_timer($gmuser){
	$max_time = "";
	include("configs/config.php");
$gm_level = check_admin($gmuser);
if($gm_level[1] < 3){
    $time=time();
        if($gm_level[1] == 1){
        	
        	if($option['Box_timer_test'] == 1){
        	$after=$time+(60);
             }
            else{
        	$after=$time+($option['Box_timer_GM1']*60*60);
            }
        }
        if($gm_level[1] == 2){
        	
        	if($option['Box_timer_test'] == 1){
        	$after=$time+(60);
             }
            else {
        	$after=$time+($option['Box_timer_GM2']*60*60);
            }
        }
$check_logs = mssql_fetch_array(mssql_query("Select * from DTweb_GM_Box_Adder_Logs where account = '".$gmuser."'"));

           if ($check_logs['account'] == null){
           	    
				mssql_query("Insert into DTweb_GM_Box_Adder_Logs (account,box1,box2,box3,box4,box5,start_date,end_date,ip) VALUES ('{$gmuser}','0','0','0','0','0','{$time}','{$after}','".ip()."')");
           }

$select_active = mssql_query("Select max(end_date) as enddate from DTweb_GM_Box_Adder_Logs where account = '".$gmuser."'");
           
		   while($newtime = mssql_fetch_array($select_active))
		   {
           	    if($time > $newtime['enddate']){
           		     mssql_query("Insert into DTweb_GM_Box_Adder_Logs (account,box1,box2,box3,box4,box5,start_date,end_date,ip) VALUES ('{$gmuser}','0','0','0','0','0','{$time}','{$after}','".ip()."')");
           	       
					}   
				 $max_time .= $newtime[0];	
            }
   return $max_time;
   
	}
	else {
		"";
	}
}
function box_counter($time){
	$counter = '';
			$counter.=	"
			<div class='bold' id ='countdown'>
				<script>
						var target_date = new Date( ".$time." * 1000).getTime() ;
						var days, hours, minutes, seconds;
						var countdown = document.getElementById('countdown');

						setInterval(function () 
							{
							var color = '#B9FF73';
							var current_date = new Date().getTime();
							var seconds_left = (target_date - current_date) / 1000;

							days = parseInt(seconds_left / 86400);
							seconds_left = seconds_left % 86400;

							hours = parseInt(seconds_left / 3600);
							seconds_left = seconds_left % 3600;

							minutes = parseInt(seconds_left / 60);
							seconds = parseInt(seconds_left % 60);

							if (days > 0)
								{	color = '#B35900';
									countdown.innerHTML = '<font color='+ color +'>' + days + ' d ' + hours + ' h '
									+ minutes + ' m ' + seconds + ' s </font>'; 
								}
							if (days < 1)
								{
									color = '#D96C00';
									countdown.innerHTML = '<font color='+ color +'>' + hours + ' h '
									+ minutes + ' m ' + seconds + ' s </font>'; 
								}
							if (hours < 1)
								{
									color = '#FF9326';
									countdown.innerHTML = '<font color='+ color +'>' + minutes + ' m ' + seconds + ' s </font>'; 
								}    
							if (minutes < 1 )
								{
									color = '#FFA64C';
									countdown.innerHTML =  '<font color='+ color +'>' + seconds + ' s </font>'; 
								}
							if (seconds_left < 30)
								{
									color = '#FFCC99';
									countdown.innerHTML = '<font color='+ color +'>' + seconds + ' s </font>'; 
								}
							if (seconds_left <= 0)
								{	
							     color = '#79FF4C';
                                 countdown.innerHTML = '<font color='+ color +'>  Бокс лимита е ресетнат';							
                                 $(document).ready(function() {
                                  window.setTimeout(function(){window.location.href = '?p=boxadder'},2000);
                                 });
	
								}
							
							}, 1000);
						</script>
	</DIV>"; return $counter;

}
function counter($time,$advai,$location,$counter =""){
$counter.=	"
<div class='bold' id ='countdown".$advai."'>
<script>
var target_date".$advai." = new Date( ".$time." * 1000).getTime() ;
 
var days".$advai.", hours".$advai.", minutes".$advai.", seconds".$advai.";
 
var countdown".$advai." = document.getElementById('countdown".$advai."');

    setInterval(function () {
  	var color = '#d90000';
    var current_date".$advai." = new Date().getTime();
    var seconds_left".$advai." = (target_date".$advai." - current_date".$advai.") / 1000;
	
	days".$advai." = parseInt(seconds_left".$advai." / 86400);
    seconds_left".$advai." = seconds_left".$advai." % 86400;
     
    hours".$advai." = parseInt(seconds_left".$advai." / 3600);
    seconds_left".$advai." = seconds_left".$advai." % 3600;
     
    minutes".$advai." = parseInt(seconds_left".$advai." / 60);
    seconds".$advai." = parseInt(seconds_left".$advai." % 60);

	if (days".$advai." > 0)	{
	 color = '#d90000';
	 countdown".$advai.".innerHTML = days".$advai." + ' d ' + hours".$advai." + ' h '
	 + minutes".$advai." + ' m ' + seconds".$advai." + ' s '; 
	}
	
    if  (days".$advai." < 1)	{
	 color = '#d90000';
	 countdown".$advai.".innerHTML = hours".$advai." + ' h '
	 + minutes".$advai." + ' m ' + seconds".$advai." + ' s'; 
	}

	 if (hours".$advai." < 1)	{
	 color = '#ff2626';
	 countdown".$advai.".innerHTML = minutes".$advai." + ' m ' + seconds".$advai." + ' s'; 
	}	
	if (minutes".$advai." < 1 )	{
	 color = '#ffb299';
	 countdown".$advai.".innerHTML =  seconds".$advai." + ' s'; 
	}
	 if (seconds_left".$advai." < 30)	{
	 color = '#ffefbf';
	 countdown".$advai.".innerHTML = '<font color='+ color +'>' + seconds".$advai." + ' s '; 
	}
	 if (seconds_left".$advai." <= 0)	{
	   location.reload();
	}

}, 1000); </script>
	</DIV>";

	return $counter;

}


function ban_counter($time,$advai,$location,$counter =""){
$counter.=	"
<div class='bold' id ='countdown".$advai."'>
<script>
var target_date".$advai." = new Date( ".$time." * 1000).getTime() ;
 
var days".$advai.", hours".$advai.", minutes".$advai.", seconds".$advai.";
 
var countdown".$advai." = document.getElementById('countdown".$advai."');

    setInterval(function () {
  	var color = '#d90000';
    var current_date".$advai." = new Date().getTime();
    var seconds_left".$advai." = (target_date".$advai." - current_date".$advai.") / 1000;
	
	days".$advai." = parseInt(seconds_left".$advai." / 86400);
    seconds_left".$advai." = seconds_left".$advai." % 86400;
     
    hours".$advai." = parseInt(seconds_left".$advai." / 3600);
    seconds_left".$advai." = seconds_left".$advai." % 3600;
     
    minutes".$advai." = parseInt(seconds_left".$advai." / 60);
    seconds".$advai." = parseInt(seconds_left".$advai." % 60);

	if (days".$advai." > 0)	{
	 color = '#d90000';
	 countdown".$advai.".innerHTML = days".$advai." + ' d ' + hours".$advai." + ' h '
	 + minutes".$advai." + ' m ' + seconds".$advai." + ' s '; 
	}
	
    if  (days".$advai." < 1)	{
	 color = '#d90000';
	 countdown".$advai.".innerHTML = hours".$advai." + ' h '
	 + minutes".$advai." + ' m ' + seconds".$advai." + ' s'; 
	}

	 if (hours".$advai." < 1)	{
	 color = '#ff2626';
	 countdown".$advai.".innerHTML = minutes".$advai." + ' m ' + seconds".$advai." + ' s'; 
	}	
	if (minutes".$advai." < 1 )	{
	 color = '#ffb299';
	 countdown".$advai.".innerHTML =  seconds".$advai." + ' s'; 
	}
	 if (seconds_left".$advai." < 30)	{
	 color = '#ffefbf';
	 countdown".$advai.".innerHTML = '<font color='+ color +'>' + seconds".$advai." + ' s '; 
	}
	 if (seconds_left".$advai." <= 0)	{
		 color = '#dfffbf';
	 countdown".$advai.".innerHTML = '<font color='+ color +'>  This ban has expired!!'; 
	 $(document).ready(function() {
       window.setTimeout(function(){window.location.href = '".$location."'},1200);
       });
	   location.reload();
	}

}, 1000); </script>
	</DIV>";

	return $counter;

}
}