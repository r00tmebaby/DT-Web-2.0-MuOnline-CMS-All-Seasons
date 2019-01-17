<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
if(isset($_GET['character'])){

	$char         = clean_post(trim($_GET['character']));
	$check_exist  = mssql_query("Select * from Character where Name = '".$char."'");
	if(mssql_num_rows($check_exist) != 0){
$char_info = mssql_fetch_array($check_exist);
$start = '';
$end='';	
$td  = "";
	
$check_guild  = mssql_fetch_array(mssql_query("Select * from [GuildMember] where [name] = '{$char}'"));
$check_times  = mssql_fetch_array(mssql_query("Select * from [Memb_stat] where [memb___id] = '{$char_info['AccountID']}'"));
$check_reg    = mssql_fetch_array(mssql_query("Select * from [Memb_Info] where [memb___id] = '{$char_info['AccountID']}'"));
$check_zen    = mssql_fetch_array(mssql_query("Select * from [DTweb_Bank] where [memb___id] = '{$char_info['AccountID']}'"));
$mark         = mssql_fetch_array(mssql_query("Select [g_mark] from [Guild] where [g_name]='{$check_guild['G_Name']}'")); 
$check_mark   = mssql_num_rows(mssql_query("Select * from [Market] where [Seller] = '{$char_info['AccountID']}' and [is_sold] ='0'"));
$logo         = urlencode(bin2hex($mark['g_mark']));
if($char_info['QuestMonsters'] > 0){
	$active_quest = "<font color='green'> Yes </font>";
}
else{
	$active_quest = "<font color='red'> No </font>";
}
if($check_guild['G_Name'] != null){
	$guild = $check_guild['G_Name'];
}
else{
	$guild = "No Guild Member";
}
if(is_online($char,1) == 1){
	$online = "<font color='#b3ff99'>Online</font>";
}
else{
	$online = "<font color='#ff4c4d'>Offline</font>";
}
if($char_info['CtlCode'] > 0){
	$special = "GM";
}
else{
	$special = "Normal User";
}
if($check_times['ConnectTM'] == null || $check_times['DisConnectTM'] == null){
	$check_times['ConnectTM'] = "Not Played Yet";$check_times['DisConnectTM'] = "Not Played Yet";
}
if($option['gift_credits'] > 0){
   $price_is = "The price for sending is ".$option['gift_credits']." Credits";
}
elseif($option['gift_procent'] > 0){
   $price_is = "The price for sending is </br> The sending resource + " .$option['gift_procent']." % from each";
}
else{
	 $price_is = '';
}
if($char_info['MarryName'] == 0){
	$nary ='Not Married';
}
else{
	$nary = '<a href="?p=user&character='.$mary.'"> '.$mary.'</a> ';
}
foreach ($option['gift_res'] as $res){
	if(isset($_SESSION['dt_username'])){
	$chk_usr_res  = mssql_fetch_array(mssql_query("Select * from [DTweb_JewelDeposit] where [memb___id] = '{$_SESSION['dt_username']}'"));
	$chk_usr_cr   = mssql_fetch_array(mssql_query("Select * from [Memb_Credits] where [memb___id] = '{$_SESSION['dt_username']}'"));
    $chk_usr_zen  = mssql_fetch_array(mssql_query("Select * from [DTweb_Bank] where [memb___id] = '{$_SESSION['dt_username']}'"));
	
	    if($res == 'credits'){
			if($chk_usr_cr['credits'] == Null){
			 $currents = 0;
			}
			else{
	    	$currents = $chk_usr_cr['credits'];
			}
	    }
	    if($res == 'zen'){
			if($chk_usr_zen['Zen'] == Null){
			 $currents = 0;	
			}
			else{
	    	$currents = $chk_usr_zen['Zen'];
			}
	    }
	    if($res !='zen' && $res != 'credits'){
			if($chk_usr_res["{$res}"] == Null){
			$currents = 0;
			}
			else{
	    	$currents = $chk_usr_res["{$res}"];
			}
	    }
	
	$td .= '<tr><td ><div align="right" class="style1">'.$res.': </div></td>
                <td colspan="2">
				   <div align="left">
				      <span class="style6"><input name="'.$res.'" type="number" value="" maxlength="20" size="15" class="style"></span>
					</div>
				</td>
            <td > You have: <b>'.$currents.'</b></td></tr>';
}
}
if(isset($_POST['send_res'])){

	if(!isset($_SESSION['dt_username'])){
       $show_msg['error'][] = phrase_login_first;
	}
	else{
	   $sender = $_SESSION['dt_username'];
       send_gifts($char,$char_info['AccountID'],$sender);
	}
}
if(!isset($_SESSION['dt_username'])){
	$start = '<!--';$end = '-->';
}
			if($mark['g_name'] <> NULL){
				$show_mark = '<img src="inc/decode.php?decode='. $logo .'" height="20" width="20" border="0"></br>'.$mark['g_name'].'';
			}
			else{
				$show_mark = "----";
			}
			
			
echo '

<div class="col-lg-12">
<div class="col-sm-6 ">
<table style="width:280px;height:420px;" align="center"  class="pull-left ">
          <tbody><tr>
            <td width="23%" align="right" class="alt9"><span class="normal_text">Character:</span></td>
            <td width="48%" class="normal_text_white"><div align="left" class="normal_text_white">
                 '.$char.'         </div></td>
            <td width="29%" class="normal_text_white"></td>
          </tr>
          <tr>
            <td align="right" class="alt9"><span class="normal_text">Class:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                '.char_class($char_info['Class']).'            </div></td>
          </tr>
          <tr>
            <td align="right" class="alt9"><span class="normal_text">Guild:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
             '.$show_mark.'&nbsp;'.$guild.'</td>
          </tr>
          <tr>
            <td align="right" class="alt9"><span class="normal_text">Status:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
          <b>'.$online.'</b></a> <span>'.time_diff(strtotime($check_times['DisConnectTM']),time()).'</font></span>            </div></td>
          </tr>

          <tr>
            <td align="right" class="alt9"><span class="normal_text">Registered:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                '.server_time($check_reg['reg_date']).'             </div></td>
          </tr>


          <tr>
            <td align="right" class="alt9"><span class="normal_text">Special:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
<b>'.$special.'</b>            </div></td>
          </tr>


          <tr>
            <td align="right" class="alt9"><span class="normal_text">Last conn:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                '.$check_times['ConnectTM'].'           </div></td>
          </tr>
          <tr>
            <td align="right" class="alt9"><span class="normal_text">Last disc:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                '.$check_times['DisConnectTM'].'            </div></td>
          </tr>

          <tr>
            <td align="right" class="alt9"><span class="normal_text">Week on:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                1 day 9 hours 2 minutes            </div></td>
          </tr>
          <tr>
            <td align="right" class="alt9"><span class="normal_text">Total on:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                19 days 8 hours 57 minutes            </div></td>
          </tr>
          <tr>
            <td align="right" class="alt9"><span class="normal_text">Quest No:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                '.$char_info['QuestNumber'].'
            </div></td>
          </tr>
          <tr>
            <td align="right" class="alt9"><span class="normal_text">ActiveQuest:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                <font color="green">'.$active_quest.'</font> (Monsters killed: <b>'.$char_info['QuestMonsters'].'</b>)            </div></td>
          </tr>
          <tr>
            <td align="right" class="alt9"><span class="normal_text">Market:</span></td>
            <td colspan="2" class="normal_text_white"><div align="left" class="normal_text_white">
                <font color="lightblue"><a href="?p=market&seller='.$char.'">View '.$check_mark.' items!</a></font>
            </div></td>
          </tr>
                  <tr>
                    <td align="right" class="alt9 normal_text">Married to:</td>
                    <td colspan="2" align="left">'.$nary.'                   </td>
                  </tr>
               

              
                  <tr>
                    <td align="right" class="alt9 normal_text">Resets:</td>
                    <td colspan="2" align="left">'.$char_info['Resets'].'
                    </td>
                  </tr>
             

                  <tr>
                    <td align="right" class="alt9 normal_text">Level:</td>
                    <td colspan="2" align="left">'.$char_info['cLevel'].'                    </td>
                  </tr>
             

              
                  <tr>
                    <td align="right" class="alt9 normal_text">Player Kills:</td>
                    <td colspan="2" align="left">'.de_kills($char_info['PkLevel']).'                    </td>
                  </tr>
           

        
                  <tr>
                    <td align="right" class="alt9 normal_text">Map:</td>
                    <td colspan="2" align="left">'.de_map($char_info['MapNumber']).'                    </td>
                  </tr>
    
                  <tr>
                    <td align="right" class="alt9 normal_text">Zen:</td>
                    <td colspan="2" align="left">'.number_format($char_info['Money']).'                     </td>
                  </tr>

                  <tr>
                    <td align="right" class="alt9 normal_text">Bank Zen:</td>
                    <td colspan="2" align="left">'.number_format($check_zen['Zen']).'                    </td>
                  </tr>

 </table></div><div class="col-sm-6">

   <img style="width:280px;height:420px;" src="imgs/classes/'.char_pic($char_info['Class']).'"/>

 </div> </div>
'.$start.'
<div class="send_gift">
<form class="form" method="post" name= "kok" />
<div style="text-align:center;padding-bottom:20px;"> '.$price_is.'</div>	<center>	
<table width="550px" border="0"  cellpadding="0" cellspacing="2">
                                   <tr>
                                      <td class=""><div align="right" class="style1">Character: </div></td>
                                      <td colspan="2"><div align="left">
									  <span class="style6">
                                          <input disabled value="'.$char.'" maxlength="10" size="15" class="style">
                                      </span></div></td>
<td> To who you want to send a gift</td>
                                    </tr>                                
                                      '.$td.'                                  
                                </tbody></table>
		
		<input type="submit" class="button" value="Send Gift" name="send_res"/>
		
		
		</form>'.$end.'</div></centeR>';
		
	}
   else{
	  echo "This character doesn't exist"; 
   }
} 
}
?>
