<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	

<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$type = ""; $cols1   ="";$cols2   ="";$cols3   =""; $cols4   ="";$cols5   ="";$cols6   ="";$cols7   ="";$cols8   ="";$cols9   ="";$cols10  ="";$cols11  ="";$cols12  ="";$cols13  ="";$cols14  ="";$cols15  ="";$cols16  ="";$itema   ="";$items   ="";$se1="";$se2="";$se3="";$se4="";$se5="";$se6="";$se7="";$se8="";$se9="";
 if((mssql_num_rows(mssql_query("Select * from DTweb_Market_Settings"))) == 0){
	mssql_query("Insert into DTweb_Market_Settings ([pagination]) VALUES ('5')"); 
 }
 
if(isset($_GET['type'])){
$types = $_GET['type'];
switch($types){
	           case "Swords":  $type="and [type]=0"; $cols1 = "style='color:#FFFFFF'"; break;
	           case "Axes":    $type="and [type]=1"; $cols2 = "style='color:#FFFFFF'"; break;
	           case "Maces":   $type="and [type]=2"; $cols3 = "style='color:#FFFFFF'"; break;
	           case "Spears":  $type="and [type]=3"; $cols4 = "style='color:#FFFFFF'"; break;
	           case "Bows":    $type="and [type]=4"; $cols5 = "style='color:#FFFFFF'"; break;
	           case "Staffs":  $type="and [type]=5"; $cols6 = "style='color:#FFFFFF'"; break;
	           case "Helmets": $type="and [type]=7"; $cols7 = "style='color:#FFFFFF'"; break;
	           case "Armors":  $type="and [type]=8"; $cols8 = "style='color:#FFFFFF'"; break;
	           case "Gloves":  $type="and [type]=10";$cols9 = "style='color:#FFFFFF'"; break;
	           case "Pants":   $type="and [type]=9"; $cols10 = "style='color:#FFFFFF'"; break;
	           case "Boots":   $type="and [type]=11";$cols11 = "style='color:#FFFFFF'"; break;
	           case "Shields": $type="and [type]=6"; $cols12 = "style='color:#FFFFFF'"; break;
	           case "Jewelery":$type="and [type]='12' or [type]='13'";$cols13 = "style='color:#FFFFFF'"; break;  
	           case "Wings":   $type="and [type]=14";$cols15 = "style='color:#FFFFFF'"; break;
               case "All":     $type='';$cols16 = "style='color:#FFFFFF'"; break;	
               default:        $type='';$cols16 = "style='color:#FFFFFF'"; break;					  
	         }
}			 
echo'
    <center>
	 <div class="market_top">
	  <div class="afix"  style="margin:5px 5px;">
		<a '.$cols16.' href="index.php?p=general&marketconf&type=All">'.phrase_all_items.'</a> | 
		<a '.$cols1.' href="index.php?p=general&marketconf&type=Swords">'.phrase_swords.'</a> |
		<a '.$cols2.' href="index.php?p=general&marketconf&type=Axes">'.phrase_axes.'</a> |
		<a '.$cols3.' href="index.php?p=general&marketconf&type=Maces">'.phrase_maces.'</a> |
		<a '.$cols4.' href="index.php?p=general&marketconf&type=Spears">'.phrase_spears.'</a> |
		<a '.$cols5.' href="index.php?p=general&marketconf&type=Bows">'.phrase_bows.'/'.phrase_crossbows.'</a> |
		<a '.$cols6.' href="index.php?p=general&marketconf&type=Staffs">'.phrase_stafs.'</a> |
		<a '.$cols7.' href="index.php?p=general&marketconf&type=Helmets">'.phrase_helmets.'</a>  |
		<a '.$cols8.' href="index.php?p=general&marketconf&type=Armors">'.phrase_armors.'</a>  
		<a '.$cols9.' href="index.php?p=general&marketconf&type=Gloves">'.phrase_gloves.'</a>  |
		<a '.$cols10.' href="index.php?p=general&marketconf&type=Pants">'.phrase_pants.'</a>  |
		<a '.$cols11.' href="index.php?p=general&marketconf&type=Boots">'.phrase_boots.'</a> |
		<a '.$cols12.' href="index.php?p=general&marketconf&type=Shields">'.phrase_shields.'</a>  |
		<a '.$cols13.' href="index.php?p=general&marketconf&type=Jewelery">'.phrase_jewelery.'/'.phrase_jewels.'</a>  |
		<a '.$cols15.' href="index.php?p=general&marketconf&type=Wings">'.phrase_wings.'/'.phrase_cape.'</a> 
	 </div></div>'; 
 
$settings   = mssql_fetch_array(mssql_query("Select * from [Market_Settings]"));
$all_items  = mssql_query("Select * from [DTweb_JewelDeposit_Items] where [banned] = '0' ".$type." ");
$all_banned = mssql_query("Select * from [DTweb_JewelDeposit_Items] where [banned] = '1'");
switch($settings['end_timing']){
	case "0":      $se0 = "selected"; break;
	case "120":    $se1 = "selected"; break;
	case "21600":  $se2 = "selected"; break;
	case "43200":  $se3 = "selected"; break;
	case "86400":  $se4 = "selected"; break;
	case "259200": $se5 = "selected"; break;
	case "432000": $se6 = "selected"; break;
	case "604800": $se7 = "selected"; break;
	case "864000": $se8 = "selected"; break;
        case "1209600":$se9 = "selected"; break;
    
}

for($i=0, $max = mssql_num_rows($all_items);$i < $max; $i++){
	$item = mssql_fetch_array($all_items);
	$items .= "<option value='".$item['name']."'>".$item['name']."</option>";
}
for($i=0, $max = mssql_num_rows($all_banned);$i < $max; $i++){
	$itemsa = mssql_fetch_array($all_banned);
	$itema .= "<option value='".$itemsa['name']."'>".$itemsa['name']."</option>";
	
}
if((mssql_num_rows($all_banned)) ==0 ){
	$itema = "<option selected> ".phrase_no_banned_items."</option>";
}

if(isset($_POST['items']) && isset($_POST['ban'])){
	    mssql_query("Update [DTweb_JewelDeposit_Items] set [banned] = '1' where [name] = '".clean_post($_POST['items'])."'");
	    echo phrase_the_item_successfully_banned;
	    refresh();
		 
}
if(isset($_POST['unban']) && isset($_POST['itema'])){ 
		mssql_query("Update [DTweb_JewelDeposit_Items] set [banned] = '0' where [name] = '".clean_post($_POST['itema'])."'");
	    echo phrase_the_item_successfully_unbanned;
		refresh();		  
}
if(isset($_POST['update'])){
	    $continue  = true;
	    $zen       = intval(clean_post($_POST['zen']));
		$credit    = intval(clean_post($_POST['credits']));
		$bless     = intval(clean_post($_POST['bless']));
		$life      = intval(clean_post($_POST['life']));
		$chaos     = intval(clean_post($_POST['chaos']));
		$creation  = intval(clean_post($_POST['creation']));
		$stone     = intval(clean_post($_POST['stone']));
		$rena      = intval(clean_post($_POST['rena']));
		$soul      = intval(clean_post($_POST['soul']));
		$end_time  = intval(clean_post($_POST['end_time']));
		$pagi      = intval(clean_post($_POST['pagi']));
		$resets    = intval(clean_post($_POST['resets']));
		$zen_multy =(string)clean_post($_POST['zen_multi']);
		$cr_multy  =(string)clean_post($_POST['cr_multi']);
		$sms       = intval(clean_post($_POST['sms']));
		$enc       = trim($_POST['enc']);
        if($zen_multy < 1){$zen_multy = 1;}
		if($cr_multy  < 1){$cr_multy  = 1;}	
		
        mssql_query("Update [DTweb_Market_Settings] set 
	                [pagination]        = '".$pagi."'
                   ,[reset_request]     = '".$resets."'
                   ,[sms_request]       = '".$sms."'
                   ,[end_timing]        = '".$end_time."'
                   ,[zen_multi]         = '".$zen_multy."'
                   ,[credits_multi]     = '".$cr_multy."'
                   ,[zen]               = '".$zen."'
                   ,[rena]              = '".$rena."'
                   ,[credits]           = '".$credit."'
                   ,[stone]             = '".$stone."'
                   ,[bless]             = '".$bless."'
                   ,[soul]              = '".$soul."'
                   ,[chaos]		        = '".$chaos."'
                   ,[creation]		    = '".$creation."'
				   ,[encrypt_key]		= '".$enc."'
                   ,[life]		        = '".$life."'");
	   echo phrase_market_settings_successfully_updated;
	refresh();		
   
}
switch($settings['sms_request']){case 0: $settings['sms_request'] = phrase_none; default: $settings['sms_request'] = $settings['sms_request'];}
switch($settings['reset_request']){case 0: $settings['reset_request'] = phrase_none; default: $settings['reset_request'] = $settings['reset_request'];}
switch($settings['zen_multi']){case 1: $settings['zen_multi'] = phrase_none; default: $settings['zen_multi'] = $settings['zen_multi'];}
switch($settings['credits_multi']){case 1: $settings['credits_multi'] = phrase_none; default: $settings['credits_multi'] = $settings['credits_multi'];}

  echo '  
    </br>
	 <table class="form" style="border:none;width:560px;">
	     <form   name="'.form_enc().'" method="post">	  
	        <select style="width:150px;color:#a6ff4c" name="items">
		       '.$items.'
              </select>
			 <input name="ban" style="width:100px;" class="button" type="submit" value="'.phrase_ban_item.'"/>     
	      <select style="width:150px;color:#ff2626" name="itema">
		       '.$itema.'
              </select>
			<input name="unban" style="width:100px;"  class="button" type="submit" value="'.phrase_unban_item.'"/>
   	 </tr>
	<tr><td class="title" colspan="3">'.phrase_general_settigns.'</td></tr>
	 <tr>
   	  <td class="admin_td" title="<div  class=admin-title><span style=\' color:#fcb073\'>'.phrase_pagination.':</span> '.phrase_pagination_info.'</div>">'.phrase_pagination.'</td>
	  <td><input type="text"  maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="pagi"  value="'.$settings['pagination'].'"/> </td>
	 </tr>
	 <tr>
   	  <td class="admin_td" title="<div  class=admin-title><span style=\' color:#fcb073\'>'.phrase_encryption_code.':</span> '.phrase_enc_code_expl.' </div>">'.phrase_encryption_code.'</td>
	  <td><input type="text"  style="width:270px;" minlength="15" maxlength="30" name="enc"  value="'.$settings['encrypt_key'].'"/> </td>
	 </tr>
	 <tr>
	   <td class="admin_td" title="<div class=admin-title><span>'.phrase_market_ending_time.':</span> '.phrase_market_ending_time_expl.'</div>">'.phrase_market_ending_time.'</td>
	  <td>
	        <select name="end_time">
	           <option '.$se0.' value="0">'.phrase_deactivated.'</option>
	           <option '.$se1.' value="120">'.phrase_test_min.'</option>
			   <option '.$se2.' value="21600">6 '.phrase_hourss.'</option>
			   <option '.$se3.' value="43200">12 '.phrase_hourss.'</option>
			   <option '.$se4.' value="86400">24 '.phrase_hourss.'</option>
			   <option '.$se5.' value="259200">3 '.phrase_days.'</option>
			   <option '.$se6.' value="432000">5 '.phrase_days.'</option>
			   <option '.$se7.' value="604800">7 '.phrase_days.'</option>
			   <option '.$se9.' value="1209600">14 '.phrase_days.'</option>
	        </select>
		 </td>	   
	 </tr>
	 <tr><td class="title" colspan="3">'.phrase_sell_item_price.'</td></tr>
	 <tr>	 
	  <td class="admin_td" title="<div class=admin-title><span>'.phrase_resets_price.':</span> '.phrase_resets_price_exp.'</div>">'.phrase_resets_price.'</td>
	  <td><input type="text"  maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="resets"  value="'.$settings['reset_request'].'"/> 
	 </tr>
   <tr>
	   <td class="admin_td" title="<div class=admin-title><span>'.phrase_resource_price.': </span> '.phrase_resource_price_exp.'</div>">'.phrase_resource_price.'</td>
	 <td>
	  Zen   &nbsp;<input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="zen"  value="'.$settings['zen'].'"/>
	  Rena  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="rena"  value="'.$settings['rena'].'"/>
	  Stone &nbsp;&nbsp;<input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="stone"  value="'.$settings['stone'].'"/></br>
	  Life  &nbsp;<input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="life"  value="'.$settings['life'].'"/>
	  Bless &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="bless"  value="'.$settings['bless'].'"/>
	  Chaos &nbsp;<input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="chaos"  value="'.$settings['chaos'].'"/></br>
	  Soul  <input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="soul"  value="'.$settings['soul'].'"/>
	  Creation <input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="creation"  value="'.$settings['creation'].'"/>
	  Credits <input type="text"  style="width:50px;" maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="credits"  value="'.$settings['credits'].'"/>
	  </td>
	</tr>
	   <tr>
	     <td class="admin_td" title="<div class=admin-title><span>'.phrase_sms_request.':</span> '.phrase_sms_request_exp.'</div>">'.phrase_sms_request.'</td>
	     <td><input type="text"  maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="sms"  value="'.$settings['sms_request'].'"/>     
	 </tr>	 
	 <tr>
	<tr><td class="title" colspan="3">'.phrase_market_fee.'</td></tr>
	 <tr >
	   <td class="admin_td" title="<div class=admin-title><span> '.phrase_zen_multiplier.': </span> '.phrase_zen_multiplier_exp.'">'.phrase_zen_multiplier.'</td>
	   <td><input type="text" min="1" maxlength="3"  name="zen_multi"  value="'.$settings['zen_multi'].'"/> </td>
	 </tr>
	 <tr>
	   <td class="admin_td" title="<div class=admin-title><span> '.phrase_credit_multiplier.': </span> '.phrase_credit_multiplier_exp.'">'.phrase_credit_multiplier.'</td>
	  <td><input type="text" min="1"  value="'.$settings['credits_multi'].'" maxlength="3" name="cr_multi"  /> </td>
	 </tr>
      <tr>
	   <td colspan="10" style="text-align:center;"><input class="button" name="update" value= "'.phrase_update.'" type="submit"/></td>
      </tr>	 
	    </form>
   </table>
</center>
  ';
}
?>

