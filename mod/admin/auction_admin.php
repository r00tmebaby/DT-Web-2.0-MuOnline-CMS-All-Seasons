<!DOCTYPE html>
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	

<link rel="stylesheet" type="text/css" href="mod/auction/template/css/tiptip.css">
<script type="text/javascript" src="mod/auction/template/javascript/jquery.js"></script>
<script type="text/javascript" src="mod/auction/template/javascript/main.js"></script>
<script type="text/javascript" src="mod/auction/template/javascript/tipTip.js"></script>
<body>
<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
	
///////////////////////////////////////////////////
//        Created          /////// by r00tme //////
// for DarksTeam Comunity  ////// 11/24/2015 //////
///////////////////////////////////////////////////
//http://http://darksteam.net /////////////////////
///////////////////////////////////////////////////
if(check_admin($_SESSION['dt_username'])){

$lastauction  = mssql_fetch_array(mssql_query("Select TOP 1 *  From [DTWeb_Auctions] order by [id] desc"));

$iinfo        = itemInfouser($lastauction['item']);
$item_view    = "";
$submit       = "";
$return_res1  = 0;
$return_res2  = 0;
$table        = "";
$bet_user     = "";
$luck0        = "";
$luck1        = "";
$cols1        = "";$cols2="";$cols3="";$cols4="";$cols5="";$cols6="";$cols7="";$cols8="";$cols9="";$cols10="";$cols11="";$cols12="";$cols13="";$cols14="";$cols15="";$cols16="";$cols17="";$cols18="";
$td           = "";
$table_bets   = "";
$showitem     = "";
$luck0        = "";
$skill        = "";
$skill0       = "";
$min_lvl0     = "";
$max_lvl0     = "";
$options0     = ""; $options1     = ""; $options2     = ""; $options3     = ""; $options4     = "";
$randopt0     = ""; $randopt1     = ""; $randopt2     = "";
$max_lvl1     = ""; $max_lvl2     = ""; $max_lvl3     = ""; $max_lvl4     = ""; $max_lvl5     = ""; $max_lvl6     = ""; $max_lvl7     = ""; $max_lvl8     = ""; $max_lvl9    = ""; $max_lvl10     = ""; $max_lvl11     = ""; $max_lvl12     = ""; $max_lvl13     = "";
$min_lvl1     = ""; $min_lvl2     = ""; $min_lvl3     = ""; $min_lvl4     = ""; $min_lvl5     = ""; $min_lvl6     = ""; $min_lvl7     = ""; $min_lvl8     = ""; $min_lvl9    = ""; $min_lvl10     = ""; $min_lvl11     = ""; $min_lvl12     = ""; $min_lvl13     = "";
$skill1       = "";
$return_res2  = "";
$page         = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 0;
$items        = (isset($_GET['items'])) ? $_GET['items'] : false;
$offset       = 25 * $page;
$next         = $page+1;
$messages     = array();
$wins         = mssql_fetch_array(mssql_query("SELECT MAX(id) as winds FROM DTWeb_Auctions"));
$chk_item     = mssql_fetch_array(mssql_query("SELECT * FROM DTWeb_Auctions where [id]='".$wins['winds']."'"));
$chk_bets     = mssql_query("Select * from [DTweb_Auction_Bets] where [auction_id] = '".$chk_item['id']."' order by count desc");
$cur_item     = mssql_fetch_array(mssql_query("SELECT * FROM DTWeb_Auctions where id='".$wins['winds']."' "));
$exist        = mssql_fetch_array(mssql_query("Select count(*) as sums from DTweb_Auction_Settings " ));
$options      = mssql_fetch_array(mssql_query("Select * from DTweb_Auction_Settings " ));
$item_view   .= '<div style="float:left;" class="iteminfo" title="' . $iinfo['overlib'] . '" width="120"><img height="120px" src="/'.$iinfo['thumb'].'" style="max-width: 90px;" /></div>';

switch($page)      {case 0:$prev = $page;break;default:$prev = $page-1;break;}
switch($options['luck']){case 0: $luck0    ='selected';break;case 1: $luck1    ='selected';break;}
switch($options['skill']){case 0: $skill0   ='selected';break;case 1: $skill1   ='selected';break;}
switch($options['return_res']){case 0: $return_res1   ='selected';break;case 1: $return_res2   ='selected';break;}
switch($options['time']){case 0: $options0 ='selected';break;case 4: $options1 ='selected';break;case 8: $options2 ='selected';break;case 12: $options3 ='selected';break;case 16: $options4 ='selected';break;}
switch($options['options']){case 0: $options0 ='selected';break;case 4: $options1 ='selected';break;case 8: $options2 ='selected';break; case 12: $options3 ='selected'; break; case 16: $options4 ='selected';break;}
switch($options['randomoptions']){case 0: $randopt0 ='selected';break;case 2: $randopt1 ='selected';break;case 4: $randopt2 ='selected';break;}
switch($options['min']){case 0: $min_lvl0 ='selected';break;case 1: $min_lvl1 ='selected';break;case 2: $min_lvl2   = 'selected';break;case 3  :  $min_lvl3   = 'selected';break;case 4  :  $min_lvl4   = 'selected';break;case 5  :  $min_lvl5   = 'selected';break;case 6  :  $min_lvl6   = 'selected';break;case 7  :  $min_lvl7   = 'selected';break;case 8  :  $min_lvl8   = 'selected';break;case 9  :  $min_lvl9   = 'selected';break;case 10 :  $min_lvl10  = 'selected';break;case 11 :  $min_lvl11  = 'selected';break;case 12 :  $min_lvl12  = 'selected';break;case 13 :  $min_lvl13  = 'selected';break;	}
switch($options['max']){case 0: $max_lvl0 ='selected';break;case 1: $max_lvl1 ='selected';break;case 2: $max_lvl2   = 'selected';break;case 3  :  $max_lvl3   = 'selected';break;case 4  :  $max_lvl4   = 'selected';break;case 5  :  $max_lvl5   = 'selected';break;case 6  :  $max_lvl6   = 'selected';break;case 7  :  $max_lvl7   = 'selected';break;case 8  :  $max_lvl8   = 'selected';break;case 9  :  $max_lvl9   = 'selected';break;case 10 :  $max_lvl10  = 'selected';break;case 11 :  $max_lvl11  = 'selected';break;case 12 :  $max_lvl12  = 'selected';break;case 13 :  $max_lvl13  = 'selected';break;	}
switch($options['table']){case null: $options['table'] = "No";break;default:$options['table'];}
switch($options['column']){case null: $options['column'] = "No";break;default:$options['column'];}
switch($exist['sums'])  {case 0: $submit  .= '<input type="submit" class="button" name="create" value="Create" />';$text="Create Settings";break;default: $submit .= '<input type="submit" style="width:100px;" class="button border" name="update" value="'.phrase_update.'" />';$text=phrase_update;break;}
if(isset($_GET['category'])){
switch($_GET['category'])  {case "InAuction": $val ='type <14 and auction=1 '; $cols17 = "style='font-weight:600;color:#FFA630'"; break;case "NotAuction": $val ='type < 14 and auction = 0 '; $cols18 = "style='font-weight:600;color:#FFA630'"; break;case "Swords": $val ='type = 0 '; $cols1 = "style='font-weight:600;color:#FFA630'"; break;case "Axes":   $val ='type = 1 '; $cols2 = "style='font-weight:600;color:#FFA630'"; break;case "Maces":  $val ='type = 2 '; $cols3 = "style='font-weight:600;color:#FFA630'"; break;case "Spears": $val ='type = 3 '; $cols4 = "style='font-weight:600;color:#FFA630'"; break;case "Bows":   $val ='type = 4 '; $cols5 = "style='font-weight:600;color:#FFA630'"; break;case "Staffs": $val ='type = 5 '; $cols6 = "style='font-weight:600;color:#FFA630'"; break;case "Helmets":$val ='type = 7 '; $cols7 = "style='font-weight:600;color:#FFA630'"; break;case "Armors": $val ='type = 8 '; $cols8 = "style='font-weight:600;color:#FFA630'"; break;case "Gloves": $val ='type = 10 '; $cols9 = "style='font-weight:600;color:#FFA630'"; break;case "Pants":  $val ='type = 9 '; $cols10 = "style='font-weight:600;color:#FFA630'"; break;case "Boots":  $val ='type = 11 '; $cols11 = "style='font-weight:600;color:#FFA630'"; break;case "Shields":$val ='type = 6 '; $cols12 = "style='font-weight:600;color:#FFA630'"; break;case "Rings":  $val ='type = 14 '; $cols13 = "style='font-weight:600;color:#FFA630'"; break;case "Pendants":$val ='type = 13 '; $cols14 = "style='font-weight:600;color:#FFA630'"; break;case "Wings_Cape":$val ='type = 12 '; $cols15 = "style='font-weight:600;color:#FFA630'"; break;case "All": $val = 'type < 14 '; $cols16 = "style='font-weight:600;color:#FFA630'"; break;	default: $val ='type < 14 ';break;					  }
}

if(isset($_GET['category'])){
$all_items    = mssql_query("select type, id, name, auction from DTweb_JewelDeposit_Items where ".$val." order by type asc");
$table       .=" <div id='filmstrip' style='overflow:Scroll;background:#040404; padding:10px 10px; height:1300px;white-space: nowrap;'>";	
$count        = mssql_num_rows(mssql_query("Select * from DTweb_JewelDeposit_Items where ".$val.""));	
$max_page     = ceil($count/25);
}
else{
$all_items    = mssql_query(pagination($offset,25, 'type, id, name, auction' ,'DTweb_JewelDeposit_Items','type asc','type'));
$count        = mssql_num_rows(mssql_query("Select * from DTweb_JewelDeposit_Items"));	
$max_page     = ceil($count/25);
}

if(isset($_POST['update'])){
   if($_POST['lvl_min'] > $_POST['lvl_max']){
	$messages[] = phrase_select_proper_values;	
   }
   else { 
    $matral = array(clean_post($_POST['rena']),clean_post($_POST['stone']),clean_post($_POST['credits']),clean_post($_POST['bless']),clean_post($_POST['chaos']),clean_post($_POST['soul']),clean_post($_POST['life']),clean_post($_POST['creation']),clean_post($_POST['guardian']));
	$key = json_encode($matral);	
	mssql_query("Update [DTweb_Auction_Settings] set [resources] = '".$key."',[return_res]='".clean_post($_POST['return_res'])."',[table]='".clean_post($_POST['table'])."',[time]='".clean_post((int)$_POST['time'])."', [options]='".clean_post((int)$_POST['options'])."',[randomoptions]='".clean_post((int)$_POST['randomoptions'])."',[luck]='".clean_post((int)$_POST['luck'])."',[skill]='".clean_post((int)$_POST['skill'])."',[min]='".clean_post((int)$_POST['lvl_min'])."',[max]='".clean_post((int)$_POST['lvl_max'])."', [user] = '".clean_post($_POST['table_acc'])."'");	
	$messages[] .= phrase_DTweb_Auction_Settings_updated;
   }	
}
if(isset($_POST['delete'])){	   
	mssql_query("Delete from [DTWeb_Auctions] where id='".$wins['winds']."'");	
	$messages[] .= phrase_item_sucessfully_deleted;		
}
if(isset($_POST['create'])){
        if(empty($_POST['time'])){
        	$messages[] .= phrase_empty_fields;	
        }	
		else{
        	mssql_query("Insert into DTweb_Auction_Settings (time,options,randomoptions,luck,skill,max,min) VALUES('".clean_post((int)$_POST['time'])."','0','0','0','0','0','0')");	
        	$messages[] .= phrase_DTweb_Auction_Settings_updated;		
        }
    }

echo "<center>
<form  name='".form_enc()."' clas='form' method='post'>";
	if(mssql_num_rows($chk_bets) == 0){
		$bet_user .= "<span class='titles'>".phrase_no_bets_yet."</span>";
	}
	else{
		$table_bets = "
		<table class='table' border='1' style='font-size:10px;table-layout:fixed;'>
		   <tr>
              <td>".phrase_account."</td>		
              <td>".phrase_bet_amount."</td>
              <td>".phrase_bet_time."</td>	
              <td>".phrase_bet_ip."</td>
           </tr>";
	while($bets = mssql_fetch_array($chk_bets)){	
		$bet_user .= 
		'
		  <tr style="color:#FFFFF2;"><td>'.$bets[0].'</td>
		  <td style="color:#BDBDAE;text-align:center;">'.$bets[2].'</td>	  
		  <td style="color:#BDBDAE">'.server_time($bets[4]).'</td>
		  <td style="color:#BDBDAE">'.$bets[3].'</td>
		  </tr>
		'; 
	    }
	}
	$showitem .=	
	'<table width="100%">
	<tr>
	 <td colspan="8"rowsnan="3">
	   <div style="margin-left:50px">'.$item_view.'</div>
	   <div><input type="submit" class="button" name="delete" value="'.phrase_reset_item.'"/></div>
	 </td>
	  <td align="left" style="padding-left:20px;" colspan="8">
	  <div class="class">'.phrase_item_nr.': <span class="titles">'.$chk_item['id'].' </span></div> </br>
	  <div class="class">'.phrase_item_hex.': <span class="titles">'.$chk_item['item'].'</div></br>
	  <div class="class">'.phrase_starting_time.': <span class="titles">'.server_time($chk_item['start_time']).'</span></div></br>
	  <div class="class">'.phrase_ending_time.': <span class="titles">'.server_time($chk_item['time']).'</span></div></br>
	  <div class="class">'.phrase_current_bets_info.':  '.$table_bets.' '.$bet_user.'</div>
       <td>
	   </tr>
</table>';
		
foreach ($messages as $fart){
	echo "<center><div style='text-shadow:1px 1px #000;color:white;'>".$fart."</div></center></br>";
	refresh();
}

$check_opt = mssql_fetch_array(mssql_query("Select * from DTweb_Auction_Settings"));
$jd = json_decode($check_opt['resources']);

if($jd[0] == "rena")    {$select1 = ""; $selects1="selected";}else{$select1 = "selected"; $selects1="";}
if($jd[1] == "stone")   {$select2 = ""; $selects2="selected";}else{$select2 = "selected"; $selects2="";}
if($jd[2] == "credits") {$select3 = ""; $selects3="selected";}else{$select3 = "selected"; $selects3="";}
if($jd[3] == "bless")   {$select4 = ""; $selects4="selected";}else{$select4 = "selected"; $selects4="";}
if($jd[4] == "chaos")   {$select5 = ""; $selects5="selected";}else{$select5 = "selected"; $selects5="";}
if($jd[5] == "soul")    {$select6 = ""; $selects6="selected";}else{$select6 = "selected"; $selects6="";}
if($jd[6] == "life")    {$select7 = ""; $selects7="selected";}else{$select7 = "selected"; $selects7="";}
if($jd[7] == "creation"){$select8 = ""; $selects8="selected";}else{$select8 = "selected"; $selects8="";}
if($jd[8] == "guardian"){$select9 = ""; $selects9="selected";}else{$select9 = "selected"; $selects9="";}

	
if(!isset($_GET['items']) && !isset($_GET['history'])){
echo'
          <script type="text/javascript" src="js/easyTooltip.js"></script>
          <script type="text/javascript" src="js/ajax.js"></script>	
          <div class="afix">
		   <a class="font main_menu_default_button" href="?p=admauction&items">'.phrase_all_auction_items.'</a> ||
		   <a class="font main_menu_default_button" href="?p=admauction&history">'.phrase_auction_history.'</a> 
		  </div> 
	 <table class="form" style="width:100%;font-size:10pt;"> 
	 <form name="'.form_enc().'" method="post" >
       <tr class="title"><td align="center" colspan="10">'.phrase_general_settings.'</td></tr>
	   <td style="float:right;margin-right:20px;">'.phrase_working_resources.'</td>
	   <td><input type="button" name="column" value="'.$options[8].'"/></td>
	   <td colspan="9" class="class="bottomauction">* '.phrase_working_resources_exp.' </td>
	</tr>
	<tr>
	   <td style="float:right;margin-right:20px;">'.phrase_resource_table.'</td>
	    <td><input type="text" name="table" value="'.$options[7].'"/></td>
	    <td colspan="9"class="class="bottomauction">* '.phrase_resources_table_exp.' </td>
	 </tr>
	 	<tr>
	   <td style="float:right;margin-right:20px;">'.phrase_resource_table_account.'</td>
	    <td><input  class="inputs" type="text" name="table_acc" value="'.$options[12].'"/></td>
	    <td colspan="9"class="class="bottomauction">* '.phrase_resource_table_account_exp.'</td>
	 </tr>	
	 </table>
	 <table class="form" style="width:100%;font-size:10pt;>
	 <tr class="title">
	 <td style="padding:5px 5px; text-align:center;font-size:12pt;text-shadow:1px 1px #000;" colspan="9">'.phrase_random_resource.'</td>
	 </tr>
	 	<tr class="title">
	         <td class="select">Rena</td>
			 <td class="select">Stone</td>
			 <td class="select">Credits</td>
			 <td class="select">Bless</td>
			 <td class="select">Chaos</td>
			 <td class="select">Soul</td>
			 <td class="select">Life</td>
			 <td class="select">Creation</td>
			 <td class="select">Guardian</td>
	    </tr>    
	   	<tr>
	         <td><select class="select" name="rena" class="yes">    <option '.$select1.' value="0">No</option><option '.$selects1.' value="rena"><div class="yes">Yes</div></option></select></td>
			 <td><select class="select" name="stone">   <option '.$select2.' value="0">No</option><option '.$selects2.' value="stone">Yes</option></select></td>
			 <td><select class="select" name="credits"> <option '.$select3.' value="0">No</option><option '.$selects3.' value="credits">Yes</option></select></td>
			 <td><select class="select" name="bless">   <option '.$select4.' value="0">No</option><option '.$selects4.' value="bless">Yes</option></select></td>
			 <td><select class="select" name="chaos">   <option '.$select5.' value="0">No</option><option '.$selects5.' value="chaos">Yes</option></select></td>
			 <td><select class="select" name="soul">    <option '.$select6.' value="0">No</option><option '.$selects6.' value="soul">Yes</option></select></td>
			 <td><select class="select" name="life">    <option '.$select7.' value="0">No</option><option '.$selects7.' value="life">Yes</option></select></td>
			 <td><select class="select" name="creation"><option '.$select8.' value="0">No</option><option '.$selects8.' value="creation">Yes</option></select></td>
			 <td><select class="select" name="guardian"><option '.$select9.' value="0">No</option><option '.$selects9.' value="guardian">Yes</option></select></td>
	   </tr> 
   </table>	
<table class="form" style="font-size:9px;table-layout:fixed;width:100%;">
       <tr class="title"><td style="text-align:center" align="center" colspan="12">'.phrase_DTweb_Auction_Settings.'</td></tr>
	   <tr align="center">
          <td colspan="2">'.phrase_timer.'</td>		  
	      <td style="width:50px;">'.phrase_luck.'</td>
	      <td>'.phrase_skill.'</td>
	      <td>'.phrase_options.'</td>
	      <td>'.phrase_random_exl.'</td>
	      <td>'.phrase_min_level.'</td>
	      <td>'.phrase_max_level.'</td>
		  <td>'.phrase_return_res.'</td>
		  <td colspan="4">'.$text.'</td>
	    </tr>
	    
		<tr>
		    <td colspan="2"valign="top"><input style="width:80px;height:35px;margin:5px 5px;" name="time" value="'.$options[0].'" type="number"/></td>
	     
		    <td><select style="width:50px;" name="luck">	
		       <option '.$luck0.' value="0">'.phrase_no.'</option>
		       <option '.$luck1.' value="1">'.phrase_yes.'</option>
		    </select></td>
		   
		    <td><select style="width:50px;" name="skill"> 
		       <option '.$skill0.' value="0">'.phrase_no.'</option>
		       <option '.$skill1.' value="1">'.phrase_yes.'</option>
		    </select></td>
			
			<td><select style="width:50px;" name="options"> 
		       <option '.$options0.' value="0">'.phrase_no.'</option>
		       <option '.$options1.' value="4">4</option>
			   <option '.$options2.' value="8">8</option>
			   <option '.$options3.' value="12">12</option>
			   <option '.$options4.' value="16">16</option>

		    </select></td>
			
			<td ><select  style="width:50px;" name="randomoptions"> 
			   <option '.$randopt0.' value="0">'.phrase_no.'</option>
		       <option '.$randopt1.' value="2">2</option>
		       <option '.$randopt2.' value="4">4</option>
		    </select></td>
		   
		   	<td ><select style="width:50px;" name="lvl_min">	     
		       <option '.$min_lvl0.' value="0">'.phrase_no.'</option>
		       <option '.$min_lvl1.' value="1">1</option>
			   <option '.$min_lvl2.' value="2">2</option>
			   <option '.$min_lvl3.' value="3">3</option>
			   <option '.$min_lvl4.' value="4">4</option>
			   <option '.$min_lvl5.' value="5">5</option>
			   <option '.$min_lvl6.' value="6">6</option>
			   <option '.$min_lvl7.' value="7">7</option>
			   <option '.$min_lvl8.' value="8">8</option>
			   <option '.$min_lvl9.' value="9">9</option>
			   <option '.$min_lvl10.' value="10">10</option>
			   <option '.$min_lvl11.' value="11">11</option>
			   <option '.$min_lvl12.' value="12">12</option>
			   <option '.$min_lvl13.' value="13">13</option>
		    </select></td>
		   
		   	<td><select style="width:50px;" name="lvl_max">	     
		       <option '.$max_lvl0.' value="0">'.phrase_no.'</option>
		       <option '.$max_lvl1.' value="1">1</option>
			   <option '.$max_lvl2.' value="2">2</option>
			   <option '.$max_lvl3.' value="3">3</option>
			   <option '.$max_lvl4.' value="4">4</option>
			   <option '.$max_lvl5.' value="5">5</option>
			   <option '.$max_lvl6.' value="6">6</option>
			   <option '.$max_lvl7.' value="7">7</option>
			   <option '.$max_lvl8.' value="8">8</option>
			   <option '.$max_lvl9.' value="9">9</option>
			   <option '.$max_lvl10.' value="10">10</option>
			   <option '.$max_lvl11.' value="11">11</option>
			   <option '.$max_lvl12.' value="12">12</option>
			   <option '.$max_lvl13.' value="13">13</option>
		    </select></td>
			<td><select style="width:50px;" name="return_res">	     
		       <option '.$return_res1.' value="0">'.phrase_no.'</option>
		       <option '.$return_res2.' value="1">'.phrase_yes.'</option>
		    </select></td>
		    <td colspan="4" valign="top" style="padding-left:20px">'.$submit.'</td>
			</tr>
					 
	 
</table>'.$showitem.'</form>	
';
}
elseif(isset($_GET['items'])){
 echo'
    <table class=" form table"><tr><td>
      <div class="afix" style=" line-height: 1.5;text-align:center;background-image:url(mod/auction/template/images/vignette-fade.png);background-size:cover;">
		<a '.$cols1.' href="?p=admauction&items&category=Swords">'.phrase_swords.'</a> |
		<a '.$cols2.' href="?p=admauction&items&category=Axes">'.phrase_axes.'</a> |
		<a '.$cols3.' href="?p=admauction&items&category=Maces">'.phrase_maces.'</a> |
		<a '.$cols4.' href="?p=admauction&items&category=Spears">'.phrase_spears.'</a> |
		<a '.$cols5.' href="?p=admauction&items&category=Bows">'.phrase_bows.'</a> |
		<a '.$cols6.' href="?p=admauction&items&category=Staffs">'.phrase_stafs.'</a> |
		<a '.$cols7.' href="?p=admauction&items&category=Helmets">'.phrase_helmets.'</a>  |
		<a '.$cols8.' href="?p=admauction&items&category=Armors">'.phrase_armors.'</a> | 
		<a '.$cols9.' href="?p=admauction&items&category=Gloves">'.phrase_gloves.'</a>  |
		<a '.$cols10.' href="?p=admauction&items&category=Pants">'.phrase_pants.'</a>  |
		<a '.$cols11.' href="?p=admauction&items&category=Boots">'.phrase_boots.'</a> |
		<a '.$cols12.' href="?p=admauction&items&category=Shields">'.phrase_shields.'</a>  |		
		<a '.$cols13.' href="?p=admauction&items&category=Rings">'.phrase_jewelery.'</a>  |
		<a '.$cols14.' href="?p=admauction&items&category=Pendants">'.phrase_pendants.'</a>  |
		<a '.$cols15.' href="?p=admauction&items&category=Wings_Cape">'.phrase_wings.'/'.phrase_cape.'</a>
		<div style="margin:5px 5px;width:100%;height:1px;border-bottom:1px solid #444;"></div>
		<a '.$cols16.' href="?p=admauction&items&category=All">'.phrase_all_items.'</a> |
		<a '.$cols18.' href="?p=admauction&items&category=NotAuction">'.phrase_not_auction_items.'</a> |
		<a '.$cols17.' href="?p=admauction&items&category=InAuction">'.phrase_auction_items.'</a>  
	</div> </br>
	        <div class="afix" style="margin-left:12px;margin-top:20px;">
			  <a class="main_menu_default_button" href="?p=admauction&history">'.phrase_auction_history.'</a> 
		      <a class="main_menu_default_button" href="?p=admauction">'.phrase_main_menu.'</a>			 
  	<input class="button" style="width:150px;" type="submit" value="'.phrase_update.'"/>
			<div style="margin-top:10px;float:right;margin-right:8px;">
				<a class="menu table_set" href="?p=admauction&items&page=0"> << </a>
				<a class="menu table_set" href="?p=admauction&items&page='.$prev.'">&lt;</a>
				<a class="menu table_set" class="active" href="?p=admauction&items&page='.$page.'"><font color="#DBA64C">'.$page.'</font></a>
				<a class="menu table_set" href="?p=admauction&items&page='.$next.'">&gt;</a>
				<a class="menu table_set" href="?p=admauction&items&page='.$max_page.'"> >> </a>
			</div>	<td></div></tr></table>
				';
	        
if(mssql_num_rows($all_items) != 0){	
echo '

'.$table.'
	<form class="form" name="'.form_enc().'"	method="post">
      <table class="auctiontable" style="width:590px">
        <tr class="title">
	      <td>#</td>
		  <td>'.phrase_type.'</td>
		  <td>'.phrase_name.'</td>
		  <td>'.phrase_auction.'</td>
		</tr>  
      ';
}
else{
	echo "</br>".phrase_you_dont_have_items_in_group;
}	   
    
for($nr = 1;$items = mssql_fetch_array($all_items);$nr++){ 
	$num = $nr + $offset; 
    $images = "imgs/items/".$items['type']."/".$items['id'].".gif";
    if($items['type'] < 6){$width='25'; $height='40';} else{$width='40'; $height='30';}  
	switch($items['auction']){case 0: $value='No';$colors='rgba(255,121,76,0.4)'; $auc_sel = 'selected';break;case 1: $value='Yes';$colors='rgba(150,255,115,0.4)';$auc_sel = 'selected';break;}
	echo"
	
	   <tr style='color:#FFA64C'>
	      <td>".$num."</td>
	      <td><img width='".$width."px' height='".$height."px' src='".$images."'/></td>
	      <td>".$items['name']."</td>
		  <td>
		        <select style='color:#c67f2d;font-weight:600;text-shadow:1px 1px #000;outline:none !important;-webkit-appearance:none !important;background:".$colors."' name='add_auction".$nr."'>
		          <option  disabled ".$auc_sel.">".$value."</option>
				  <option value='0'>".phrase_no."</option>
				  <option  value='1'>".phrase_yes."</option>
		        </select>	
            <input name='name".$nr."' value='".$items['name']."' type='hidden'/>	
		  </td></tr>";
 	    if(isset($_POST['add_auction'.$nr.'']) && isset($_POST['add_auction'.$nr.''])){
		    mssql_query("Update DTweb_JewelDeposit_Items set auction = ".$_POST['add_auction'.$nr.'']." where name= '".$_POST['name'.$nr.'']."'");
		     refresh();   
	    }
	}
    echo '</table></form></center>';
   
  
 } 
elseif(isset($_GET['history'])){
	    $query = mssql_query("Select * From [DTWeb_Auctions] Where [winner]!= NULL order by [id] desc");
	
	if(isset($_GET['account']) && !isset($_POST['id']) && !isset($_POST['biddes'])){				
				echo "
				<table class='table form' style='table-layout:fixed; font-size:9px; width:580px'>
				<tr class='title'>
				<td>".phrase_account."</td>
				<td>".phrase_item."</td>
				<td>".phrase_bid."</td>
				<td>".phrase_bidding_time."</td>
				<td>".phrase_ip_address."</td></tr>";
				 $bidd = mssql_query("Select * from [DTweb_Auction_Bets] where [user] ='".$_GET['account']."' order by time desc");
	               while($bidders = mssql_fetch_array($bidd)){  
                    $item = mssql_fetch_array(mssql_query("Select item from DTWeb_Auctions where id='".$bidders['auction_id']."'"));				   
					$iinfo = itemInfouser($item['item']);
					echo'
					    <tr>
						
                           <td class="afix"><a href="?p=admauction&history&account='.$bidders['user'].'">'.$bidders['user'].'</a></td>
 						  	<td style="text-align:center;" class="iteminfo" title="' . $iinfo['overlib'] . '" width="70">
                            <img height="70" src="/' . $iinfo['thumb'] . '" style="max-width: 64px;" />
                            <div style="font-size:8pt;">' . $item['item'] . '</div>
						   </td>
						   <td>'.$bidders['count'].'</td>
					       <td>'.server_time($bidders['time']).'</td>
					       <td>'.$bidders['ip'].'</td>
						</tr>
					';     
					}
					
				} 
     		if(isset($_POST['id']) && isset($_POST['biddes'])){	
               			
				echo "
				<table class='table form' style='table-layout:fixed; font-size:9px; width:580px'>
				
				<tr class='title'><td>Account</td><td>Bid</td><td>".phrase_bidding_time."</td><td>".phrase_ip_address."</td></tr>";

					$bidd = mssql_query("Select * from [DTweb_Auction_Bets] where auction_id = '".$_POST['id']."' and user !='".$_POST['name']."' order by count desc");
	               while($bidders = mssql_fetch_array($bidd)){ 
                    			   
					$td .= 					"
					    <tr>
                           <td class='afix'><a href='?p=admauction&history&account=".$bidders['user']."'>".$bidders['user']."</td>
 						   <td>".$bidders['count']."</td>
					       <td>".server_time($bidders['time'])."</td>
					       <td>".$bidders['ip']."</td>
						</tr>
					";     
					}
				} 

    echo "</br>".$td .'
	        <div class="afix" style="margin-bottom:20px;">
			  <a class="main_menu_default_button" href="?p=admauction&history">'.phrase_auction_history.'</a> 
		      <a class="main_menu_default_button" href="?p=admauction">'.phrase_main_menu.'</a>
			</div>
			<script type="text/javascript" src="js/easyTooltip.js"></script>
             <script type="text/javascript" src="js/ajax.js"></script>	
               <table border="1" style="table-layout:fixed; font-size:9px; width:580px">
                        <tr>						  
                           <td>'.phrase_winner_account.'</td>
						   <td>'.phrase_winner_bid.'</td>
						   <td>'.phrase_time_started.'</td>
						   <td>'.phrase_time_ended.'</td>
						   <td>'.phrase_winner_ip.'</td>
				           <td colspan="2">'.phrase_item.'</td>
                       </tr>';
	 
    while ($r = mssql_fetch_array($query)) {
    $count = mssql_fetch_array(mssql_query("Select count, auction_id,user From [DTweb_Auction_Bets] Where [user]='{$r['winner']}' and [auction_id]='{$r['id']}'"));
	$iinfo = Iteminfouser($r['item']);
    $i++;
	
         echo'<form class="form" name="'.form_enc().'" style="font-size:9px;" method="post">
                       <tr >				      
                           <td class="afix"><a href="?p=admauction&history&account='.$r['winner'].'">'.$r['winner'].'</a></td>					   
                           <td>'.$count['count'].'</td> 
						   <td>' .server_time($r['time']) . '</td>						   
						   <td>' .server_time($r['end_time']) . '</td>				   
                           <td>' . $r['ip'] . '  </td>						   
						   <td colspan="2" style="text-align:center;" class="iteminfo" title="' . $iinfo['overlib'] . '" width="70">
                               <img height="40" src="/' . $iinfo['thumb'] . '" style="max-width: 64px;" />
                               <div style="font-size:8pt;">' . $r['item'] . '							   
							      <input name="name" value="'.$r['winner'].'" type="hidden">
							      <input name="id" value="'.$count['auction_id'].'" type="hidden"> 
							    <input class="button" style="width:100px;" name="biddes" value="Show All Bids" type="submit"></div>
						</td>
                       </tr>                   
				   </form>
               ';
        }
     }
	 echo " </table> ";
  }
else{
	home();
}
}
?>
<style>
.titles{
	color:#fffff2;
	text-shadow:1px 1px #000;
}
.class{
		color:#b9b9c8;
	text-shadow:1px 1px #000;
}
.select{
	width:50px;
}


</style>