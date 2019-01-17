<?php
//////////////////////////////
// Ban && Warn Char or Acc ///
//     by r00tme       ///////  
///     03/04/2018     ///////    
//////////////////////////////

if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
include("mod/rankings/rank_menu.php");
    $query_char = mssql_query("Select * from [DTweb_Banned] where [character] IS NOT NULL and [account] IS NULL and [active] = 1 and [warn_count] = 0 order by end_date desc, start_date asc");
    $warn_char  = mssql_query("Select * from [DTweb_Banned] where [character] IS NOT NULL and [account] IS NULL and [active] = 1 and [warn_count] > 0 order by end_date desc, start_date asc");
    $warn_acc   = mssql_query("Select * from [DTweb_Banned] where [account] IS NOT NULL and [character] IS NULL and [active] = 1 and [warn_count] > 0 order by end_date desc, start_date asc");
	$query_acc  = mssql_query("Select * from [DTweb_Banned] where [account] IS NOT NULL and [character] IS NULL and [active] = 1  and [warn_count] = 0 order by end_date desc, start_date asc");

	if(mssql_num_rows($query_char) > 0 || mssql_num_rows($query_acc) > 0 || mssql_num_rows($warn_char) > 0 || mssql_num_rows($warn_acc) > 0)
	{
	if(mssql_num_rows($query_char) > 0){
			echo "
			<div class='ban_chars_title'>Banned Characters</div>
			<table border='1' style='text-align:center;' align='center'>
			        <tr class='title'>
					     <td>Character</td>
						 <td>Status</td>
						 <td>Expire</td>
						 <td>Reason</td>
						 <td>Banned date</td>
						 <td>Banned from</td>
					</tr>";
					
	    	for($i=0; $i < mssql_num_rows($query_char); $i++){
				$all_ban_chars = mssql_fetch_array($query_char);
				$banned_chars  = mssql_fetch_array(mssql_query("Select * from [Character] where [Name] = '".$all_ban_chars['character']."' and [CtlCode]='1'"));
				if($banned_chars['CtlCode'] == 1){
					$googd++;
					$expires    =  ban_counter($all_ban_chars['end_date'],$googd,"?p=bans");			
					$started    = "Activated: </br>" . server_time($all_ban_chars['start_date']);
					$bg_color   = "#400000";
				}
				else{
					$expires    = "Expires:</br>" . server_time($all_ban_chars['end_date']);
					$started    = 'Scheduled for:</br> ' . server_time($all_ban_chars['start_date']);
					$bg_color   = "#403000";
				}	
				echo  "<tr class='ban_info' bgcolor='".$bg_color."'>
					      <td><a href='user&character=".$all_ban_chars['character']."'>".$all_ban_chars['character']."</a></td>
					      <td>".$started."</td>
						  <td>".$expires."</td>
						  <td>".$all_ban_chars['banned_reason']."</td>
						  <td>".server_time($all_ban_chars['banned_date'])."</td>
						  <td>".($all_ban_chars['banned_from'])."</td>
					  </tr>";						 
				  		
	    	}
			echo "</table></br>";
	    }
		
        if(mssql_num_rows($query_acc) > 0){
			echo "
			<div class='ban_chars_title'>Banned Accounts</div>
			<table border='1' style='text-align:center;' align='center'>
			        <tr class='title'>
					     <td>Account</td>
						 <td>Status</td>
						 <td>Expire</td>
						 <td>Reason</td>
						 <td>Banned date</td>
						 <td>Banned from</td>
					</tr>";
					
	    	for($i=0; $i < mssql_num_rows($query_acc); $i++){
				$all_ban_acc = mssql_fetch_array($query_acc);
				$banned_acc  = mssql_fetch_array(mssql_query("Select * from [Memb_Info] where [memb___id] = '".$all_ban_acc['account']."' and [bloc_code]='1'"));
				if($banned_acc['bloc_code'] == 1){
					$googd++;
					$expiresd    =  ban_counter($all_ban_acc['end_date'],$googd,"?p=bans");			
					$startedd    = "Activated: </br>" . server_time($all_ban_acc['start_date']);
					$bg_colord   = "#400000";
				}
				else{
					$expiresd    = "Expires:</br>" . server_time($all_ban_acc['end_date']);
					$startedd    = 'Scheduled for:</br> ' . server_time($all_ban_acc['start_date']);
					$bg_colord   = "#403000";
				}	
				echo  "<tr class='ban_info' bgcolor='".$bg_colord."'>
					      <td><a href='user&account=".$all_ban_acc['account']."'>".$all_ban_acc['account']."</a></td>
					      <td>".$startedd."</td>
						  <td>".$expiresd."</td>
						  <td>".$all_ban_acc['banned_reason']."</td>
						  <td>".server_time($all_ban_acc['banned_date'])."</td>
						  <td>".($all_ban_acc['banned_from'])."</td>
					  </tr>";						 
				  		
	    	}
			echo "</table>";
	    }
		
		 

        if(mssql_num_rows($warn_char) > 0){
			echo "
			<div class='ban_chars_title'>Warned Characters</div>
			<table border='1' style='text-align:center;' align='center'>
			        <tr class='title'>
					     <td>Character</td>
						 <td>Status</td>
						 <td>Expire</td>
						 <td>Warn Reasons</td>
						 <td>Warned date</td>
						 <td>Warned from</td>
					</tr>";
					
	    	for($i=0; $i < mssql_num_rows($warn_char); $i++){
				$all_warn_chars = mssql_fetch_array($warn_char);
				$banned_chars  = mssql_fetch_array(mssql_query("Select * from [Character] where [Name] = '".$all_warn_chars['character']."' and [CtlCode]='1'"));
				if($banned_chars['CtlCode'] == 1){
					$googd++;
					$expires    =  ban_counter($all_warn_chars['end_date'],$googd,"?p=bans");			
					$started    = "Activated: </br>" . server_time($all_warn_chars['start_date']);
					$bg_color   = "#400000";
				}
				else{
					$expires    = "Expires:</br>" . server_time($all_warn_chars['end_date']);
					$started    = 'Scheduled for:</br> ' . server_time($all_warn_chars['start_date']);
					$bg_color   = "#403000";
				}	
          			
                $reasonss  = json_decode($all_warn_chars['warn_reason']);					

				echo  "<tr class='ban_info' bgcolor='".$bg_color."'>
					      <td><a href='?user&character=".$all_warn_chars['character']."'>".$all_warn_chars['character']."</a></td>
					      <td>".$started."</td>
						  <td>".$expires."</td>
						  <td>";
				foreach($reasonss as $times => $reason){
					 $times++;
			    echo "<div style='text-align:left;'>". $times . ". &nbsp;" . $reason . '</div></br>' ;
				    }
				echo" </td>
						  <td>".server_time($all_warn_chars['banned_date'])."</td>
						  <td>".($all_warn_chars['banned_from'])."</td>
					  </tr>";						 
				  		
	    	}
			echo "</table></br>";
	    }
        if(mssql_num_rows($warn_acc) > 0){
			echo "
			<div class='ban_chars_title'>Warned Accounts</div>
			<table border='1' style='text-align:center;' align='center'>
			        <tr class='title'>
					     <td>Account</td>
						 <td>Status</td>
						 <td>Expire</td>
						 <td>Warned Times</td>
						 <td>Warn Reasons</td>
						 <td>Warned date</td>
						 <td>Warned from</td>
					</tr>";
					
	    	for($i=0; $i < mssql_num_rows($warn_acc); $i++){
				$all_warn_acc = mssql_fetch_array($warn_acc);
				$banned_acc  = mssql_fetch_array(mssql_query("Select * from [Memb_Info] where [memb___id] = '".$all_warn_acc['account']."' and [bloc_code]='1'"));
				if($banned_acc['bloc_code'] == 1){
					$googd++;
					$expiresd    =  ban_counter($all_warn_acc['end_date'],$googd,"?p=bans");			
					$startedd    = "Activated: </br>" . server_time($all_warn_acc['start_date']);
					$bg_colord   = "#400000";
				}
				else{
					$expiresd    = "Expires:</br>" . server_time($all_warn_acc['end_date']);
					$startedd    = 'Scheduled for:</br> ' . server_time($all_warn_acc['start_date']);
					$bg_colord   = "#403000";
				}	
				echo  "<tr class='ban_info' bgcolor='".$bg_colord."'>
					      <td><a href='?p=user&account=".$all_warn_acc['account']."'>".$all_warn_acc['account']."</a></td>
					      <td>".$startedd."</td>
						  <td>".$expiresd."</td>
						  <td>".$all_warn_chars['warn_count']."</td>
						  <td>".json_decode($all_warn_chars['warn_reason'])."</td>
						  <td>".server_time($all_warn_acc['banned_date'])."</td>
						  <td>".($all_warn_acc['banned_from'])."</td>
					  </tr>";						 				  		
	    	}
			echo "</table>";
	    }
	}
	else{
		echo "<div class='error'>No one is banned or warned yet</div>";
	}
}
?>
