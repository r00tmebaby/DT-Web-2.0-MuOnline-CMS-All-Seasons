<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> 

<?php

//////////////////////////////////////////////////////////////////////////////////////////////////
//r0toto  ///////////24 / 08 / 2016///////////////////////////////////////////////////////////////
//     by r00tme         ////http://www.DarksTeam.net/////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
//* This module is created for DarksTeam users and integrated to DTweb 2.0 / r00tme version///////
//* This module version works only with the tables given in the release///////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

include("configs/config.php");
$get_config = simplexml_load_file( $_SERVER['DOCUMENT_ROOT'].'/configs/mod_settings/r0toto_settings.xml');
$radio         = "";
$all_numbers   = "";
$active        = $get_config -> active;
$pags          = $get_config -> pagination;
$maxs          = $get_config -> maxs;
$win_nr        = $get_config -> win_nr;
$set_time      = $get_config -> set_time;
$timings       = $get_config -> timing;
$bet_multy     = $get_config -> bet_multy;
$bet_once      = $get_config -> bet_once;
$bet_res       = $get_config -> bet_res;
$bet_amount    = $get_config -> bet_amount;
$rew_res       = $get_config -> rew_res;
$rew_amount    = $get_config -> rew_amount;
$jackpot_on    = $get_config -> jackpot_on;
$jpot_rew      = $get_config -> jpot_rew;
$jpot_rew_div  = $get_config -> jpot_rew_div;
$ballinrow     = $get_config -> ballinrow;
switch($set_time){case 0:$timing = "+" . $timings ."minutes";break;case 1:$timing = "+" . $timings ."hours";break;case 2:$timing = "+" . $timings ."days";break;case 3:$timing = "+" . $timings ."weeks";break;case 4:$timing = "+" . $timings ."months";break;default:$timing = "+" . $timings ."months";break; }
$event_end   = strtotime("{$timing}",time());
$pag         = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 1;
$page        = (int)($pag);

if($active == 0){ die (phrase_currently_disabled);}			
$is_toto     = mssql_query("Select TOP 1 * from [DTweb_r0toto_Dates] where active = '1' order by id desc"); 
$cur_toto    = mssql_fetch_array($is_toto);
$event_infos = mssql_fetch_array(mssql_query("Select TOP 1 * from [DTweb_r0toto_Dates] where active = '0' order by id desc"));
$usr_bets    = mssql_query("Select * from [DTweb_r0toto_Bets] where memb___id='".$_SESSION['dt_username']."' and [toto_id] ='".$cur_toto['id']."' order by id desc");
$event_info  = mssql_fetch_array(mssql_query("Select * from [DTweb_r0toto_Dates] where active = '0' order by id desc"));
$check_jpot  = mssql_query("Select TOP 1 * from [DTweb_r0toto_Bets] order by id desc");
$usr_res     = mssql_fetch_array(mssql_query("Select * from [DTweb_JewelDeposit] where memb___id='".$_SESSION["dt_username"]."'"));		
$bet_acc     = array();
$bet_bets    = array();
$bet_nrs     = array();
$messages    = array();
$user = $_SESSION['dt_username'];
$count       = mssql_num_rows(mssql_query("Select * from [DTweb_r0toto_Bets] where memb___id='".$_SESSION['dt_username']."' and [reward_taken]=0 and [toto_id] != '".$cur_toto['id']."' and [user_won_nr] not like ''"));
$max_pages   = ceil($count/$pags);
$offset      = ($pags) * ($page - 1); 
$all_rewa    = mssql_query(pagination($offset, $pags, "*", "DTweb_r0toto_Bets", "id desc" ,"id","[memb___id]='{$user}' and reward_taken=0 and toto_id != '{$cur_toto['id']}'"));  
for($i=1; $i < $maxs+1; $i++ ){
	$nomer = array($i=>$i);
	foreach ($nomer as $row => $all_numbers){
		   if(($row%$ballinrow) == 0){
			 $tre = "</br>";  
		   }
		   else{
			    $tre ='';
		   }
		$radio .= "<label for='id".$all_numbers."'><input id='id".$all_numbers."' value='".$all_numbers."' type='checkbox' name='".$all_numbers."'/><span>".$all_numbers."</span></label>". $tre ;		
      
	  if(!empty($_POST[$all_numbers])  && $_POST[$all_numbers] > 0){
		 $bet_nrs[] = $_POST[$all_numbers]; 
	    }  
	}
}

//SQL tables switch for Bet/Reward
switch($bet_res){
	case "credits": $tables=$option['cr_db_table'];$users = $option['cr_db_check_by'];$columns = $option['cr_db_column'];break;
	case "zen":$tables="[DTweb_Bank]"; $users = "[memb___id]";$columns = "[Zen]";break;
	default: $tables="[DTweb_JewelDeposit]"; $users = "[memb___id]";$columns = $bet_res;break;
}
switch($rew_res){
	case "credits": $table=$option['cr_db_table'];$user = $option['cr_db_check_by'];$column = $option['cr_db_column'];break;
	case "zen":$table="[DTweb_Bank]"; $user = "[memb___id]";$column = "[Zen]";break;
	default: $table="[DTweb_JewelDeposit]"; $user = "[memb___id]";$column = $rew_res;break;
}
	  
while($bet = mssql_fetch_array($usr_bets)){
		$bet_acc[] = $bet['memb___id'];
		$bet_bets[] = $bet['user_bets'];
}

// Settings for Jackpot	 
if ($jackpot_on == 1){
	$jackpot_img = "<img width='400px;' src='imgs/r0toto/Progressive-jackpot.gif'/><br>
	
	<span class='jackpot'>"  . $cur_toto['toto_jackpot']."</span>";
}

// Push Bet Settings
$count_bets = count($bet_acc);
		if($bet_multy > 1){
            if(in_array($_SESSION['dt_username'],$bet_acc)){   	
	            $next_price  = ceil(($bet_multy*$count_bets) * $bet_amount);
		   }
		   	else{
		    $next_price = $bet_amount;
		  }
	    }
		else{
		    $next_price = $bet_amount;
		}
		
// Bet Function
if(isset($_POST['bet'])){
	$size = count($bet_nrs);
	$size = (int)($size);
	$count_bets  = count($bet_acc);
	$count_bets = (int)($count_bets);
	$is_exist    = mssql_num_rows(mssql_query("Select * from [DTweb_r0toto_Ranks] where [memb___id] = '".$_SESSION["dt_username"]."' and [bets_res] = '".$columns."'"));
	    if($bet_once == 1){
            if(in_array($_SESSION['dt_username'],$bet_acc)){   	
	         $messages[] = phrase_lottery_bet_once;
			 $error = 1;
		   }
	    }
		
		foreach($bet_nrs as $zalog){
			$zalog =clean_post($zalog);			
			if( $zalog <= 0 || $zalog > $maxs || !is_numeric($zalog)){
				$messages[] = phrase_market_error_contact_admin ;
			    $error = 1;	
			}
		}
		
	    if($size < $win_nr || $size > $win_nr){
	    	 $messages[] = phrase_please_choose . $win_nr . phrase_numbers_from_table ;
			 $error = 1;
	    }
	    if($usr_res[''.$bet_res.''] < $next_price){
			
	    	$messages[] = phrase_not_enough_resources . $next_price . $bet_res." ";
			$error = 1;
	    }
	    if($error !== 1){

	        $rus         = json_decode($cur_toto['toto_won_nr']);
	        $usr_won     = intersect($rus,$bet_nrs);
            $show        = json_encode($bet_nrs);
            if($jackpot_on == 1){			
               $new_jackpot = ceil($jpot_rew * $next_price);
			   mssql_query("Update [DTweb_r0toto_Dates] set toto_jackpot = toto_jackpot + ".$new_jackpot." where [active] = 1");
		    }
	    	if(empty($usr_won)){$usr_won = 'NULL';} else{$usr_won = json_encode($usr_won);}
			   mssql_query("Update ".$tables." set [".$columns."] = [".$columns."] - ".$next_price." where ".$users."='".$_SESSION['dt_username']."'");
	    	   mssql_query("Insert into [DTweb_r0toto_Bets] ([toto_id], [memb___id],[user_bets],[toto_won_nr],[user_won_nr],[bet_resource],[won_resource],[bet_date],[bet_ip]) Values ('".$cur_toto['id']."','".$_SESSION['dt_username']."','".json_encode($bet_nrs)."','".$cur_toto['toto_won_nr']."','".$usr_won."','".$bet_res." x ".$next_price."','".$rew_res." x ".$rew_amount." ','".time()."','".ip()."')");
				  if($is_exist > 0){
					mssql_query("Update [DTweb_r0toto_Ranks] set [bets_total] = [bets_total] + '".$next_price."' where [memb___id] = '".$_SESSION["dt_username"]."' and [bets_res] = '".$columns."'"); 
			      }
			      else{
 			        mssql_query("Insert into [DTweb_r0toto_Ranks] (memb___id,bets_total,bets_res) VALUES ('".$_SESSION['dt_username']."','".$next_price."','".$columns."')");
			      }
	           refresh();		
	      
		}
		foreach ($messages as $show){
		echo "<script> alert('".$show."');</script>";
	}
  }

  
// Get Reward
if(isset($_POST['wins'])){
	$id           = (int)$_POST['wins'];
    $toto_id      = (int)$_POST['toto'];	
	$check_wnrs   = mssql_query("Select * from DTweb_r0toto_Bets where toto_id = '".$toto_id."'");
	$info_user    = mssql_fetch_array(mssql_query("Select * from DTweb_r0toto_Bets where id = '".$id."' and memb___id='".$_SESSION['dt_username']."' and reward_taken='0'"));
    $count_won_nr = count(json_decode($info_user['user_won_nr']));
	$winner       = "";
	$update       = bcmul($count_won_nr,$rew_amount); 
	$you_received = phrase_you_have_received;
	$divider      = 1;
	$real         = 0;
	if($count_won_nr > 0){
	
       if($jackpot_on == 1){
		    if($count_won_nr == $win_nr){
                if($jpot_rew_div == 1){	
					 	while($jackpoters = mssql_fetch_array($check_wnrs)){	
                            $all_betters[] = json_decode($jackpoters['user_won_nr']);
							$divider = count($all_betters);
                        }				
					  $update = ($event_infos['toto_jackpot']/ $divider) + ($count_won_nr*$rew_amount);	
				      $real = $event_infos['toto_jackpot']/ $divider;
					}
                else{			
		    	    $update = $event_infos['toto_jackpot'] + ($count_won_nr*$rew_amount); 
                    $real = $event_infos['toto_jackpot'];					
                }
              $winner = "<div class='won'>".phrase_won_jackpot."</div>";
              $you_received = '';			  
		    }
	    }
		$update_reward = mssql_query("Update ".$table." set ".$column." = ".$column." +".$update." where ".$user." = '".$_SESSION['dt_username']."'");
	    $update_event  = mssql_query("Update [DTweb_r0toto_Bets] set [reward_taken] = '1', [jackpot] = '".$real."',[reward_date] = '".time()."', [won_amount] = '".$update."',[reward_ip] = '".ip()."' where id = '".$id."'");
	    mssql_query("Update [DTweb_r0toto_Ranks] set [won_total] = [won_total] + '".$update."', [won_jackpots] = [won_jackpots] + '".$real."',[won_res] = '".$column."' where [memb___id] = '".$_SESSION['dt_username']."' and [bets_res] = '".$bet_res."' ");
	 if(!$update_reward){
		  $messages[] = phrase_market_error_contact_admin;
	  }
	  else{	
        	  
		$messages[] = "<div class='wons'>" . $you_received .$winner ." x ". $update."&nbsp;".$column . "</div>";  			  
	    refresh1();
	  }
	}
 }

// Auto Check and Start new Lotto		
if($active == 1){
  if((mssql_num_rows($is_toto)) == 0)  {
	   mssql_query("Insert into [DTweb_r0toto_Dates] ([toto_start],[toto_end],[toto_won_nr]) VALUES ('".time()."','".$event_end."','".toto_won_nr()."')");
       refresh();
  }
    else{       
	  if($cur_toto['toto_end']< time()){
		mssql_query("Update DTweb_r0toto_Dates set active = '0'"); 
		$event = mssql_fetch_array(mssql_query("Select TOP 1 * from [DTweb_r0toto_Dates] where active = '0' order by id desc"));
	    while($jackpoters = mssql_fetch_array($check_jpot)){	
              $all_betters[] = json_decode($jackpoters['user_won_nr']);
              foreach ($all_betters as $jpot_winners){
		      $divider = count($jpot_winners);
		      if(count($jpot_winners) == $win_nr){
           		$event['toto_jackpot'] = 0;		  
		      }
	       }
        }
		mssql_query("Insert into [DTweb_r0toto_Dates] ([toto_start],[toto_end],[toto_won_nr],[toto_jackpot]) VALUES ('".time()."','".$event_end."','".toto_won_nr()."','".$event['toto_jackpot']."')");
	    refresh();
	  }
    }
}
?>
<script>
jQuery(function(){
    var max = <?php echo $win_nr?>;
    var checkboxes = $('input[type="checkbox"]');

    checkboxes.change(function(){
        var current = checkboxes.filter(':checked').length;
        checkboxes.filter(':not(:checked)').prop('disabled', current >= max);
    });
});
</script>
<?php



/////////////////// Render Visual Part
echo "<center class='gr'>
".$jackpot_img."
    
	</br></br>
	    <table class='r0toto' border='1' width='100%'>
		  <tr class='title'><td colspan='20'>".phrase_current_r0toto . $win_nr.phrase_from .$maxs."</td></tr>
	        <tr class='title'>
		    	<td width='100px;'>".phrase_lottery_started.":</td>
				<td width='100px;'>".phrase_lottery_ended.":</td>
				<td width='80px;'>".phrase_lottery_price.":</td>
				<td width='80px;'>".phrase_lottery_reward.":</td>
				<td>".phrase_lottery_bets."</td>
				</td>
		    </tr>
		    <tr>
		        <td>".server_time($cur_toto['toto_start'])."</td>
		    	<td>".server_time($cur_toto['toto_end'])."</td>
				<td>".$next_price." x ".$bet_res."</td>
				<td>".$rew_amount." x ".$rew_res."</td>
				<td>";
	
		if(count($bet_bets) == 0){
			echo phrase_do_not_have_nr;
			}
		else{
		    foreach($bet_bets as $line){	
			 echo balls($line). "</br>";		  
		    }
		  }
		echo "</td>
		    </tr>
		  </table>
        </br>   
		       <form method='post'>
	             ".$radio."	</br>	
                    <input type='submit' class='button' name='bet' value='".phrase_bet."'/>	
                    <input type='reset' class='button'  value='".phrase_reset."'/>						 
	            </form>
      </br>";
pagi_style("lotto",$max_pages,$pags);

echo "  </br>
	      <table border='1'>
		  <tr class='title'><td colspan='10'>".phrase_bet_history .$win_nr.phrase_from.$maxs."</td></tr>
	        <tr class='title'>
		    	<td width='60px'>".phrase_started."</td>
				<td width='60px'>".phrase_ended."</td>
				<td>".phrase_lottoto_win_nr."</td>
				<td>".phrase_your_nr."</td>
				<td>".phrase_winning_nr."</td>
				<td width='100px;'>".phrase_reward."</td>
		    </tr>";

		while($chek_this = mssql_fetch_array($all_rewa)){
			$i++;
			$count_won_nr = count(json_decode($chek_this['user_won_nr']));
			$count_won_nrs = count(json_decode($chek_this['toto_won_nr']));
		if($count_won_nr > 0){
            if($count_won_nr == $count_won_nrs){$pic = "jackpot.png"; } else{$pic = "normal.png"; }
			$usr_won = "<img style='width:50px;height:50px;' src='imgs/r0toto/".$pic."'/>
			</br>
			 ".$count_won_nr." x ".$rew_amount." ".$rew_res."     
			
			<form name='lidsam".$i."' method='post'>
			   <input type='submit' style='width:80px;font-size:8pt' class='button' value='".phrase_get_reward."'/>
			   <input type='hidden' value='".$chek_this['id']."' name='wins'/>
			   <input type='hidden' value='".$chek_this['toto_id']."' name='toto'/>
			</form></br>";	 
		echo "
		    <tr>
		        <td>".server_time($event_info['toto_start'])."</td>
		    	<td>".server_time($event_info['toto_end'])."</td>
				<td>".balls($chek_this['toto_won_nr'])."</td>
				<td>".balls($chek_this['user_bets'])."</td>
				<td>".balls($chek_this['user_won_nr']) . "</td>
				<td>".$usr_won."</td>
		    </tr>";	
			}			
	}		
echo "
        </table>
	<center>";	


pagi_style("lotto",$max_pages,$pags);
?>

<style>
table{
	
	text-align:center;
	 border: 1px solid #1a0801;
}


</style>
