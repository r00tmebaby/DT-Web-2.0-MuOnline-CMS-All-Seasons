<?php
$message  = array();
$success  = 0;
$rows     = "";

foreach($option['buy_vip_requirements'] as $requirements => $value){
	 if($value > 0){
		 $rows .= "<tr><td class='tdTitle'>".$requirements."</td><td style='width:100px;padding:10px 10px;font-weight:900' class='left'><span style='font-weight:300'>x&nbsp;</span>".$value."</td></tr>";
	 }
}

if($option['buy_vip'] === 1){
	if(isset($_POST['buy']) && isset($_POST['character']) && isset($_POST['time']))
	{
		$time  = (int)$_POST['time'] -1;
		 if(exist($_POST['character'],1) === true)
		 {			 
			 if($time >= 0 && $time < count($option['buy_vip_tm_pr']))
			 {
				if(is_online($_SESSION['dt_username'],1) === 0)
				{
					$info = mssql_query("Select * from Character where isVip=0 and Name='".$_POST['character']."' and AccountID='".$_SESSION['dt_username']."'");
					
					if(mssql_num_rows($info) === 1)
					{
                        
					   $requests = array_values($option['buy_vip_requirements']);	
					   $duraiton = array_keys($option['buy_vip_tm_pr']);
					   $price    = array_values($option['buy_vip_tm_pr']);
					   $info     = mssql_fetch_array($info);
					   
					       if($requests[0] > 0 && $info['Resets'] < $requests[0]){
						       $message[] = phrase_not_enough_resets ;                          					 
					       }
						   elseif($requests[1] > 0 && $info['cLevel'] < $requests[1]){
							   $message[] = phrase_not_enough_levels ; 
						   }
						   elseif($requests[2] > 0 && $info['GrandResets'] < $requests[2]){
							   $message[] = phrase_not_enough_gresets ; 
						   }
						   else{
					       
						   if($price[$time] === 0)	{
						        if(mssql_num_rows(mssql_query("Select TOP 1 * from DTweb_Buy_Vip where character='".$_POST['character']."' and account='".$_SESSION['dt_username']."' and  [trial_used] = 1 ")) === 0){
						     	    $update_vip = mssql_query("Update Character set isVip = 1, VipExpirationTime='".strtotime($duraiton[$time],time())."' where Name='".$_POST['character']."'");
						            $create_log = mssql_query("Insert into DTweb_Buy_Vip (account,character,vip_bought,vip_duration,vip_expires,price_paid,buyer_ip,trial_used) values ('".$_SESSION['dt_username']."','".$_POST['character']."','".time()."','".$duraiton[$time]."','".strtotime($duraiton[$time],time())."','x ".$price[$time]."\n".$option['buy_vip_res']."','".ip2long(ip())."','1')");
								}
						        else{
						     	    $message[] = phrase_vip_trial_already_used  ; 
						        }
					        }						
					        else
						    {
								if($option['buy_vip_res'] == "credits")
								{
								   $table  = "MEMB_Credits";							   
								}
								else
								{
								   $table  = "DTweb_JewelDeposit";										
								}
						 	    	$resources = mssql_fetch_array(mssql_query("Select [{$option['buy_vip_res']}] from [".$table."] where memb___id='".$_SESSION['dt_username']."'"));  
					                if($resources[$option['buy_vip_res']] >= $price[$time]) 
								    {	
								        
								    	$update_vip = mssql_query("Update Character set isVip = 1, VipExpirationTime='".strtotime($duraiton[$time],time())."' where Name='".$_POST['character']."'");
								    	$update_res = mssql_query("Update [{$table}] set [{$option['buy_vip_res']}] = [{$option['buy_vip_res']}] - {$price[$time]} where memb___id='".$_SESSION['dt_username']."'");
										$create_log = mssql_query("Insert into DTweb_Buy_Vip (account,character,vip_bought,vip_duration,vip_expires,price_paid,buyer_ip) values ('".$_SESSION['dt_username']."','".$_POST['character']."','".time()."','".$duraiton[$time]."','".strtotime($duraiton[$time],time())."','x ".$price[$time]."\n".$option['buy_vip_res']."','".ip2long(ip())."')");
								    }
								    else
								    {
								      $message[] =	 phrase_not_enough_resources;
								    }
							}
					    }
					}
					else{
						$message[] = phrase_you_have_vip  ;
					}
				}
				else{
					$message[] = phrase_leave_the_game;
				}
			 }
			 else{
				$message[] = phrase_market_error_contact_admin; //The user is cheating, sending a bad post data
		        // Make logs etc  - keep an eye 	 
			 }
		 }
		 else{
			 $message[] = phrase_market_error_contact_admin; //The user is cheating, sending a bad post data 
		    // Make logs etc  - keep an eye 
		 }
	}
message($message,$success);
?>
<table class='table' style='margin:0 auto;'>
	<tbody>
		<tr class="title">
			<td colspan='2' style='text-align:center'>Buy VIP  Requirements</td>
		</tr>
</table>
<table style='width:250px; margin: 0 auto'>
         <?php  echo $rows;?>
		
	</tbody>
</table>
 <form  name="<?php echo form_enc()?>" class="form" method="post">
<table class='table'>
   <tr>
        <td>      
    		<label for="character"><?php echo phrase_character?>: </label>
    			<select name="character" id="character">
    				<option value="">-</option>
    				<?php
    					$query = mssql_query("SELECT [Name],[isVip],[Resets],[GrandResets],[cLevel],[VipExpirationTime] FROM [Character] WHERE [AccountID]='" . $_SESSION['dt_username'] . "' and [isVip] = 0 ORDER BY GrandResets DESC, Resets DESC, cLevel DESC");
    
    					while($row = mssql_fetch_array($query)){
    				echo '
    				<option value="'.$row['Name'].'"> '.$row['Name'].'</option>';
						}
						echo "
    			</select>
				</td>
				<td>
				   <select  style='min-width:150px;' name='time'>";
				      	$i = 0;
					      foreach($option['buy_vip_tm_pr'] as $time => $price){
							  $prices = $price."&nbsp;" . $option['buy_vip_res'];
							  if($price === 0){
								 $prices = "free trial"; 
							  }
							  $i ++;
							  echo "<option value ='".$i."'>".$time." / ".$prices."</option>";
						  }
					echo'
					   </select>
				</td>
				<td><input type="submit" class="button" name="buy" value="Buy VIP"/></td>
    
     </tr>
    </form>
</table>';
$vips = mssql_query("Select * from Character where [isVip] = 1 and AccountID='".$_SESSION['dt_username']."'");
  if(mssql_num_rows($vips) > 0){
	  echo "<table class='table'>
	              <tr class='title'>
				     <td>#</td>
					 <td>Character </td>
					 <td>Duration</td>
					 <td>VIP Time Left</td>
					 <td>Date Bought</td>
					 <td>Buyer IP</td>
					 <td>Price Paid</td>
				  </tr>
			";
	 $i =0;

  	 while($vipsa = mssql_fetch_array($vips)){
	    $b = mssql_fetch_array(mssql_query("Select TOP 5 * from DTweb_Buy_Vip where character = '".$vipsa['Name']."' order by id desc"));
		 $i++;
		 if($b['trial_used'] == 1){
			 $price_paid = "free trial";
			 }
	    else{
			$price_paid = $b['price_paid'];
			}
		if($b['vip_expires'] > time()){
		 echo  "<tr style='font-size:10pt;text-align:center;text-shadow:1px 1px #000'>
		            <td>".$i."</td>
					<td>".$b['character']."</td>
					<td>".$b['vip_duration']."</td>
					<td>".counter($b['vip_expires'],$i,"?p=buyvip")."</td>
					<td>".server_time($b['vip_bought'])."</td>
					<td>".long2ip($b['buyer_ip'])."</td>
					<td>".$price_paid."</td>				
			   </tr>";
		}
	 }
	 echo "</table>";
  }
}
else{
	echo  "<div class='error'>" . phrase_currently_disabled . "</div>";
}
