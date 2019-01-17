<!DOCTYPE html>
<!-- 
///////////////////////////////////////////////////////////
r0toto Admin Panel ///////////24 / 08 / 2016///////////
     by r00tme         ////http://www.DarksTeam.net
///////////////////////////////////////////////////////////
* This module is created for DarksTeam users and integrated to DTweb 2.0 / r00tme version
* This module version works only with the tables given in the release
//////////////////////////////////////////////////////////////
-->
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	

<?php 
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$messages        = array();
$file            = $_SERVER['DOCUMENT_ROOT']."/configs/mod_settings/r0toto_settings.xml";
$get_config      = simplexml_load_file($file);

$minutes = "";
$hours  = "";  
$days = "";   
$weeks = "";  
$months = ""; 
define("active",        "active");
define("pagination",    "pagination");
define("maxs",          "maxs");
define("win_nr",        "win_nr");
define("set_time",     "set_time");
define("timing",       "timing");
define("bet_multy",     "bet_multy");
define("bet_once",      "bet_once");
define("bet_res",       "bet_res");
define("bet_amount",    "bet_amount");
define("rew_res",      "rew_res");
define("rew_amount",    "rew_amount");
define("jackpot_on",    "jackpot_on");
define("jpot_rew",      "jpot_rew");
define("jpot_rew_div",  "jpot_rew_div");
define("balldesign",    "balldesign");
define("ballinrow",    "ballinrow");


$active        = $get_config -> active;
$pagi          = $get_config -> pagination;
$maxs          = $get_config -> maxs;
$win_nr        = $get_config -> win_nr;
$set_time      = $get_config -> set_time;
$timing        = $get_config -> timing;
$bet_multy     = $get_config -> bet_multy;
$bet_once      = $get_config -> bet_once;
$bet_res       = $get_config -> bet_res;
$bet_amount    = $get_config -> bet_amount;
$rew_res       = $get_config -> rew_res;
$rew_amount    = $get_config -> rew_amount;
$jackpot_on    = $get_config -> jackpot_on;
$jpot_rew      = $get_config -> jpot_rew;
$jpot_rew_div  = $get_config -> jpot_rew_div;
$ball_design   = $get_config -> balldesign;
$ball_row      = $get_config -> ballinrow;
$directory     = ('imgs/r0toto/balls'); 
$balls         = "";
$hours         = "";
$days          = "";
$weeks         = "";
$months        = "";
$bet_onces1    = "";
$jackpot_on0   = "";
$jackpot_on1   = "";
$jpot_rew_div1 = "";

$image         = "<img width='30px' src ='imgs/r0toto/balls/".$ball_design."/1.png' />";	
foreach (scandir($directory) as $file) {
    if ('.' === $file) continue;
    if ('..' === $file) continue; 
    if($ball_design == $file){$selected = "selected";}else{$selected = '';}
    $balls .= "<option ".$selected." value='".$file."'>".$file."</option>";
	}

switch($active){
	case 1: $active = "selected";$active1 = "";break;
	case 0: $active = "";$active1 = "selected";break;
}

switch($bet_once){
	case 0: $bet_onces0 = "selected";break;
	case 1: $bet_onces1 = "selected";break;
}
switch($jackpot_on){
	case 0: $jackpot_on0 = "selected";break;
	case 1: $jackpot_on1 = "selected";break;
}
switch($jpot_rew_div){
	case 0: $jpot_rew_div0 = "selected";break;
	case 1: $jpot_rew_div1 = "selected";break;
}
switch($set_time){
	case 0: $minutes = "selected";break;
	case 1: $hours = "selected";break;
	case 2: $days = "selected"; break;
	case 3: $weeks = "selected";break;
	case 4: $months = "selected";break;
}
if(isset($_POST['update'])){

	if($_POST['maxs'] < $_POST['min']){
		$messages[] = phrase_error_min_is_higher;
	}
	elseif(((int)$_POST['bet_res']) || ((int)$_POST['rew_res'])){
		$messages[] = phrase_error_type_correct_resource;
	}
    elseif($_POST['bet_multy'] < 1){
		$messages[] = phrase_error_type_constant;
	}
	else{
		$file            = $_SERVER['DOCUMENT_ROOT']."/configs/mod_settings/r0toto_settings.xml";
	
	$start_upd          = save_config($file,active,clean_post(trim($_POST['start'])));
	$pagi_upd           = save_config($file,pagination,clean_post(trim($_POST['pagi'])));
	$maxs_upd           = save_config($file,maxs,clean_post(trim($_POST['maxs'])));
	$win_nr_upd         = save_config($file,win_nr,clean_post(trim($_POST['min'])));
	$time_type_upd      = save_config($file,set_time,clean_post(trim($_POST['time_type'])));
	$time_upd           = save_config($file,timing,clean_post(trim($_POST['time'])));
	$bet_multy_upd      = save_config($file,bet_multy,clean_post(($_POST['bet_multy'])));
	$bet_once_upd       = save_config($file,bet_once,clean_post(trim($_POST['bet_once'])));
	$bet_res_upd        = save_config($file,bet_res,clean_post(($_POST['bet_res'])));
	$bet_amount_upd     = save_config($file,bet_amount,clean_post(trim(($_POST['bet_amount']))));
	$rew_res_upd        = save_config($file,rew_res,clean_post(($_POST['rew_res'])));
	$rew_amount_upd     = save_config($file,rew_amount,clean_post(trim($_POST['rew_amount'])));
	$jackpot_on_upd     = save_config($file,jackpot_on,clean_post(trim($_POST['jackpot_on'])));
	$jpot_rew_upd       = save_config($file,jpot_rew,clean_post(trim($_POST['jpot_rew'])));
	$jpot_rew_div_upd   = save_config($file,jpot_rew_div,clean_post(trim($_POST['jpot_rew_div'])));
	$balldesign_upd     = save_config($file,balldesign,clean_post(trim($_POST['balldesign'])));	
	$ball_row_upd       = save_config($file,ballinrow,clean_post(trim($_POST['ballinrow'])));	
	refresh();
	}
}
    foreach($messages as $return){
		echo "</br>". $return;
	}
	echo "<center>
			    <table  class='form' style='font-size:12pt; width:600px;'>
			<form  name='".form_enc()."' class='form' method='post'>
			<input class='button' type='submit' value='".phrase_update."' name='update'/>
		        <tr class='title'><td style='text-align:center' colspan='2'>".phrase_r0toto_settings."</td></tr>
				    <tr><td title='<div class=admin-title><span>".phrase_r0toto_start.": </span> ".phrase_r0toto_start_desc."'>".phrase_r0toto_start."</td>
					    <td>
						    <select class='nes' name='start'>
							     <option value='1' ".$active."> Yes </option>
								 <option value='0' ".$active1."> No </option>
						    </select>
						</td>
					</tr>
					<tr>
					   <td title='<div class=admin-title><span>".phrase_r0toto_time_type.": </span> ".phrase_r0toto_time_type_desc."'>".phrase_r0toto_time_type."

					   <td><input type='number' class='nes' min='0' value='".$timing."' name='time'/>
					        <select class='nes' name='time_type'>
						         <option value='0' ".$minutes. ">Minutes</option>
								 <option value='1' ".$hours.   ">Hours</option>
								 <option value='2' ".$days.    ">Days</option>
								 <option value='3' ".$weeks.   ">Weeks</option>
								 <option value='4' ".$months.  ">Months</option>
						    </select>
					    </td>
					</tr>
                    <tr><td title='<div class=admin-title><span>".phrase_r0toto_pagi.": </span> ".phrase_r0toto_pagi_desc."'>".phrase_r0toto_pagi."</td><td><input  min='1'  class='nes' type='number'  value='".$pagi."' name='pagi'/></td></tr>
                    <tr>
					<td title='<div class=admin-title><span>".phrase_r0toto_min.": </span> ".phrase_r0toto_min_desc."'>".phrase_r0toto_min."</td>
					<td><input class='nes' style='width:50px' type='number' value='".$win_nr."' name='min'/> / <input  style='width:50px' class='nes' min='0' type='number' value='".$maxs."' name='maxs'/>
					</td>
                   
					</tr>
					 <tr>
					<td title='<div class=admin-title><span>".phrase_r0toto_balls.": </span> ".phrase_r0toto_balls_desc."'>".phrase_r0toto_balls."</td>
					<td><select name='balldesign'>".$balls."</select>".$image."</td>
                   
					</tr>
					 <tr>
					<td title='<div class=admin-title><span>".phrase_r0toto_ballsrow.": </span> ".phrase_r0toto_balls_descballsrow."'>".phrase_r0toto_ballsrow."</td>
					<td><input name='ballinrow' value='".$ball_row."' type='number'/></td>
                   
					</tr>
				<tr class='title'><td style='text-align:center' colspan='2'>".phrase_r0toto_reward_settings."</td></tr>
				    <tr><td title='<div class=admin-title><span> ".phrase_bet_once.": </span> ".phrase_bet_once_desc."'>".phrase_bet_once."</td>
					    <td>
						     <select class='nes' name='bet_once'>
							    <option value='1' ".$bet_onces1.">Yes</option>
								<option value='0' ".$bet_onces0.">No</option>
					    </td>
					</tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_bet_multy.": </span> ".phrase_bet_multy_desc."'>".phrase_bet_multy."</td><td><input class='nes' min='0' type='text' value='".$bet_multy."' name='bet_multy'/></td></tr>
					<tr><td title='<div class=admin-title><span> ".phrase_bet_res.": </span> ".phrase_bet_res_desc."'>".phrase_bet_res."</td><td><input class='nes' min='0'  style='width:50px'  type='number'  value='".$bet_amount."' name='bet_amount'/> x <input  style='width:80px' type='text'  value='".$bet_res."' name='bet_res'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_win_res.": </span> ".phrase_win_res_desc."'>".phrase_win_res."</td><td><input class='nes' min='0'  style='width:50px' type='number'  value='".$rew_amount."' name='rew_amount'/> x <input  style='width:80px' type='text'  value='".$rew_res."' name='rew_res'/></td></tr>

				<tr class='title'><td style='text-align:center' colspan='2'>".phrase_lotto_jackpot."</td></tr>
				    <tr><td title='<div class=admin-title><span> ".phrase_jackpot_on." : </span>".phrase_jackpot_on_desc."'>".phrase_jackpot_on."</td>
							<td>
						     <select class='nes' name='jackpot_on'>
							    <option value='1' ".$jackpot_on1.">Yes</option>
								<option value='0' ".$jackpot_on0.">No</option>
					        </td>
					</tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_jackpot_const." : </span> ".phrase_jackpot_const_desc."'>".phrase_jackpot_const."</td><td class='nes'><input class='nes' type='text' value='".$jpot_rew."' name='jpot_rew'/></td></tr>
                    <tr><td title='<div class=admin-title><span> ".phrase_jackpot_dev." : </span> ".phrase_jackpot_dev_desc."'>".phrase_jackpot_dev."</td>							<td>
						     <select class='nes' name='jpot_rew_div'>
							    <option value='1' ".$jpot_rew_div1.">Yes</option>
								<option value='0' ".$jpot_rew_div0.">No</option>
					        </td></tr>	

				<tr><td align='center' colspan='20'>
				<input class='button' type='submit' value='".phrase_update."' name='update'/></td></tr>
			  </form>		
		    </table>
	
	</center>
	
	";
}
	?>
<style>
.nes{
	margin-left:10px;
}
.short{
	width:5px;
}
.be{
	float:left;
}

</style>