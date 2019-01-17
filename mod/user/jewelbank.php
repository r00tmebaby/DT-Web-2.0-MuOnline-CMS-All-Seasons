<?php
////////////////////////////////////////////////////////
//////////////////////////////// Created   /////////////
// Jewels Depositor v1.1   /////   for  ////////////////
//////  by r00tme  //////////// DarksTeam///////////////
////// 03/04/2018 //////////////////////////////////////   
//////////////////////////http://darksteam.net//////////
////////////[DTweb_JewelDeposit]////////////////////////
////// * Last update speed optimizations ///////////////
////////////////////////////////////////////////////////

$message      = array();
$settings    = jw_deposit();
$jewela      = 0;
$counter     = 0;
$success     = 0;
$online      = mssql_num_rows(mssql_query("Select * from MEMB_STAT where memb___id='{$_SESSION['dt_username']}' and connectstat='1'"));
$jewels      = mssql_fetch_array(mssql_query("select * from [DTweb_JewelDeposit] where [memb___id]='".$_SESSION['dt_username']."'"));		 
$warehouse   = market_warehouse($_SESSION['dt_username']);  

    if($jewels['memb___id'] == null){
        mssql_query("Insert into [DTweb_JewelDeposit] (memb___id)  values ('".$_SESSION['dt_username']."')");
    }

    if(isset($_POST['deposit']) && isset($_POST["type"]) && isset($_POST["count"]))
	  {
		  $type  = clean_post($_POST["type"]);
		  $count = (int)$_POST["count"];
		  
            if($online == 1)
			{
				$message[] = phrase_leave_the_game;
			}
            elseif($count <= 0)
			{
            	$message[] = phrase_empty_fields;
            }			
	        elseif($type <> $settings[0] || $settings[3] < $count || $settings[3] <= 0)
			{
            	$message[] = phrase_dont_have_jewels;
            }
            else
			{           	
		        foreach($warehouse as $item){
		        	if($item['hex'] == $settings[0]){				
		        		$item_position = $item['item_position'];
		        		$items         = all_items($_SESSION['dt_username'],1200);				
		        		$i             = -1;
		        		$num           = 0;
		        		$broika        = 0;
		        		while($i < 119){	
		        			$i++;
		        			if($i == $item_position && $num==0){
		        				$items= substr_replace($items,str_repeat('F',20),($i*20), 20);
		        				$num++;
		        				$broika += $num;
		        			}
		        		}				
		        		mssql_query("UPDATE [warehouse] SET [items]=0x".$items." WHERE [AccountId]='".$_SESSION['dt_username']."'");
		        		$counter++;		        		
		        		if($counter == $_POST["count"])
						{
		        			$deposit_log = json_encode(array($item['hex'],$broika));
		        			mssql_query("Insert into [DTweb_Modules_Logs] (module,account,date,ip,jewels) VALUES ('Jewel Deposit','".$_SESSION['dt_username']."','".time()."','".ip()."','".$deposit_log."')");				
		        		    break;
		        		}		
		        	 }
	              } 
		        mssql_query("UPDATE [DTweb_JewelDeposit] SET ".$settings[2]."=".$settings[2]."+".$_POST["count"]." WHERE [memb___id]='".$_SESSION['dt_username']."'");
	            $message[] = phrase_deposit_successfull;
				$success   = 1;
            }			
      }
 

    if(isset($_POST['withdraw']) && isset($_POST["count"])){
		   $type  = clean_post($_POST["type"]);
		   $count = (int)$_POST["count"];   
		
            if($online == 1)
			{
				$message[] = phrase_leave_the_game;
			}
            elseif($count <= 0)
			{
            	$message[] = phrase_empty_fields;
            }			
	        elseif($type <> $settings[0] || $jewels[''.$settings[2].''] <= $count || $jewels[''.$settings[2].''] <= 0 )
			{
            	$message[] = phrase_dont_have_jewels;
            }
            else{
				
	            for($i = 0;$i < $_POST["count"]; $i++)
	            	{		
	            		$mycuritems = all_items($_SESSION['dt_username'],1200);
	            		$newitem = str_replace("55555555", itemSerial(), $settings[4]);
	            	
	            		$slot = smartsearch($mycuritems,1,1);
	            		$test = $slot * 20;
	            		if ($slot==1337)
						{
	            			$message[] = phrase_no_enough_space;
	            			break;
	            		}
	            		else
						{	            
	            			$mynewitems = substr_replace($mycuritems, $newitem, $test, 20);	            			
	            			$update = mssql_query("
	            				UPDATE [warehouse] SET [Items]=0x".$mynewitems." WHERE [AccountId]='".$_SESSION['dt_username']."';
	            				UPDATE  [DTweb_JewelDeposit] set [{$settings[2]}]= [{$settings[2]}]-1 WHERE [memb___id]='".$_SESSION['dt_username']."'");		
	            		    if($update === true){
								$success   = 1;
							}
						}
	            	}
	            	if($success === 1){
	            	    $withraw_log = json_encode(array($newitem,$settings[1],$_POST["count"]));
	            	        mssql_query("Insert into [DTweb_Modules_Logs] (module,account,date,ip,jewels) VALUES ('Jewel Withdraw','".$_SESSION['dt_username']."','".time()."','".ip()."','".$withraw_log."')");
	            	        $message[] = phrase_withraw_successfull;
							$success   = 1;
	            	}
	            }		
    }
 message($message,$success);
 
echo "		
	<form class='form' method='post'>
	<span style='margin-right:10px;'>".phrase_amount."</span><input type='number' min='1' max='200' name='count'/>
	    <select name='type'>";				 
	       $jewels_bas = mssql_query("Select * from [DTweb_Deposit_Settings] where [active]='1'");
		   
                for( $i= 0 , $max = count($jewels_bas); $i < $max ; $i++ )
				{	
                    while($jewels_base = mssql_fetch_array($jewels_bas))
				    {		
	                   $jewels_hex = $jewels_base['ItemFour'];			 
                       $jewels_name = $jewels_base['ItemName'];		 
	                   echo "<option value='".$jewels_hex."'> ".$jewels_name." </option>";
                    }  
                }
	             echo "</select>				   
		               <input type='submit'  name='deposit' value='".phrase_deposit."'/>		           
			           <input type='submit' name='withdraw' value='".phrase_withraw."'/> 
		          </form>
	
                <table style='width:200px;' align='left'>
			      <tr>
				     <td class='title' colspan='2'>".phrase_banks."</td>
				  </tr>";
        $jewels_bas  = mssql_query("Select * from [DTweb_Deposit_Settings] where [active]='1'");		  
        $select_bank = mssql_fetch_array(mssql_query("select * from [DTweb_JewelDeposit] where [memb___id]='".$_SESSION['dt_username']."'"));	  
        
        for( $i= 0 , $max = count($jewels_bas);$i < $max ; $i++ )
				{
		        	while($jewels_base = mssql_fetch_array($jewels_bas))
					{			
	                   $jewels_name   = $jewels_base['ItemName'];
	                   $jewels_column = $jewels_base['ItemColumn'];
		               $jewels_color  = $jewels_base['ItemColor'];
	                   $jewel_count   = 0;		
		                if ($select_bank[''.$jewels_column.''] == null )
					     {
		        	        $select_bank[''.$jewels_column.''] = 0;
		                 }
		                else 
					     {
		        	      $select_bank[''.$jewels_column.'']= $select_bank[''.$jewels_column.''];
		                 }
	            
	                echo "<tr style='color:".$jewels_color.";'><td class='td'>" . $jewels_name . " </td><td class='tdinf'>".$select_bank[''.$jewels_column.'']."</td></tr>";
				   }
	            }
	   
	 echo "</table> 
                <table style='width:200px;' align='right'>
			    <tr><td class='title' colspan='2'>".phrase_warehouse."</td></tr>";
				
        $jewels_bas = mssql_query("Select * from [DTweb_Deposit_Settings] where [active]='1'");
		
	        for( $i= 0 , $max = count($jewels_bas);$i < $max ; $i++ )
			{
	    	   while($jewels_base = mssql_fetch_array($jewels_bas))
			   {			
	            $jewels_name     = $jewels_base['ItemName'];
	    		 $jewels_hex     = $jewels_base['ItemFour'];
	    		 $jewels_color   = $jewels_base['ItemColor'];
	            $jewel_count     = 0;		   
                $warehouse       = market_w($_SESSION['dt_username']);
	               foreach($warehouse as $item)
				   {
                      $item = substr($item,0,4);			
	                   if($item == $jewels_hex)
					   {			  
	       	            $jewel_count++;
	                   }
	    		    }			   
               echo "<tr style='color:".$jewels_color.";'><td class='td'>".$jewels_name."</td><td class='tdinf'> ".$jewel_count."</td></tr>"; 	  
			  }
            }
    echo "</table>";

