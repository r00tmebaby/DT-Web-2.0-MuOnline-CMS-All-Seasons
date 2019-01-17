<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/tipTip.js"></script>


<?php

//////////////////////////
/////Zen Bank Module//////
///////by r00tme//////////
////// 23/10/2015/////////
//////////////////////////
include_once($_SERVER['DOCUMENT_ROOT']."/configs/config.php"); 
if(isset($_SESSION['dt_username']) && isset($_SESSION['dt_password'])){
	$account   = $_SESSION['dt_username'];
	$errors    = array();
	$opt = "";
	$success   = array();
	$chek_on   = mssql_fetch_array(mssql_query("Select [ConnectStat] from Memb_Stat where [memb___id] = '".$account."'"));
	$info      = mssql_query("Select money,name from character where AccountID='".$account."'");
	$chars     = mssql_query("Select name from Character where AccountID='".$account."'");  
    $acc_zen   = mssql_fetch_array(mssql_query("Select zen from DTweb_Bank where memb___id='".$account."'"));	
	while($characters = mssql_fetch_array($chars)){
		$opt .= "<option value={$characters['name']}><b>{$characters['name']}</b></option>";
	} 
	if(isset($_POST['sent_char']) && isset($_POST['chars_from']) && isset($_POST['chars_to'])){
		$from = clean_post($_POST['chars_from']);
		$to   = clean_post($_POST['chars_to']);
		$zen  = (int)clean_post($_POST['count_zen']);
		$zen_sender = mssql_fetch_array(mssql_query("select Money from Character where name='".$from."'")); 
	        $zen_reciever = mssql_fetch_array(mssql_query("select Money from Character where name='".$to."'")); 
	  
	  if($chek_on['ConnectStat'] != 0){
		  $errors[] .= phrase_leave_the_game;
	  }
	  elseif($zen <= 0){
		  $errors[] .= phrase_correct_amount;
	  }
	  elseif($from == $to){
		  $errors[] .= phrase_zen_yourself;
	  }	  
      elseif($zen_sender['Money'] < $zen){
		  $errors[] .= phrase_not_enough . phrase_zen . phrase_you_have_only .number_format($zen_sender[0]).phrase_zen;
	  }
	  elseif(($zen + $zen_reciever['Money']) >= $option['inventory_limit']){
		  $errors[] .= phrase_cant_sent.$zen.".". phrase_maximum_inventory;
	  }
	  else{
		  $bank_enc  = json_encode(array($to,$zen));
		  mssql_query("Insert into [DTweb_Modules_Logs] (module,account,character,date,ip,bank) VALUES ('Bank Character Transfer','".$account."','".$from."','".time()."', '".ip()."','".$bank_enc."')");
		  mssql_query("Update [character] set [money] = [money] + ".$zen ." where name='".$to."'");
		  mssql_query("Update [character] set [money] = [money] - ".$zen ." where name='".$from."'");
	      $success[] .= phrase_the_amount_of . trim(number_format($_POST['count_zen'])) . phrase_successfully_sent . $to."";
	      refresh();
	 }
	
  }	

if(isset($_POST['charname']) && isset($_POST['doit'])){
	$charname = clean_post($_POST['charname'] );
         $check_bank = mssql_fetch_array(mssql_query("Select zen from DTweb_Bank where [memb___id]='".$account."'"));
	     $check_inv = mssql_fetch_array(mssql_query("Select money from character where [name]='".$charname."'"));
		 $withraw = clean_post($_POST['withraw']);
		if(isset($_POST['deposit']) && empty($_POST['withraw'])){
		    $zen = (int)clean_post($_POST['deposit']);
		    if($chek_on['ConnectStat'] != 0){
		     $errors[] .= phrase_leave_the_game;
	        }
			elseif($zen <= 0){
		    $errors[] .= phrase_correct_amount;
	        }
		    elseif($zen > $check_inv['money']){
		   	$errors[] .= "You do not have this zen amount in your character inventory"; 
		    }
		    elseif(($zen + $check_bank['zen']) >= $option['bank_limit']){
		   	$errors[] .= phrase_maximum_bank . $option['bank_limit'] . phrase_zen;
		    }
			else{
		        mssql_query("Insert into [DTweb_Modules_Logs] (module,account,character,date,ip,bank) VALUES ('Bank Deposit','".$account."','".$charname."','".time()."', '".ip()."','".$zen."')");
				mssql_query("Update [DTweb_Bank] set [zen] = [zen] + ".$zen." where [memb___id]='".$account."'");
				mssql_query("Update [character] set [money] = [money] - ".$zen." where [name]='".$charname."'");
			    $success[] .= phrase_the_amount_of . trim(number_format($_POST['deposit'])).phrase_successfully_sent_to . phrase_bank;
			    refresh();
			}		
		}
		elseif(isset($withraw) && empty($_POST['deposit'])){
		    $zen = (int) clean_post($_POST['withraw']);
		    if($chek_on['ConnectStat'] != 0){
		     $errors[] .= phrase_leave_the_game;
	        }
			elseif($zen <= 0){
		    $errors[] .= phrase_correct_amount;
	        }
		    elseif($zen > $check_bank['zen']){
		   	$errors[] .= phrase_not_enough_zen_bank; 
		    }
		    elseif(($zen + $check_inv['money']) >= $option['inventory_limit']){
		   	$errors[] .= phrase_maximum_inventory.$option['inventory_limit']. phrase_zen;
		    }
			else{
				mssql_query("Insert into [DTweb_Modules_Logs] (module,account,character,date,ip,bank) VALUES ('Bank Withraw','".$account."','".$charname."','".time()."', '".ip()."','".$zen."')");
				mssql_query("Update character set [money] = [money] + ".$zen." where [name]='".$charname."'");
			    mssql_query("Update [DTweb_Bank] set [zen] = [zen] - ".$zen." where [memb___id]='".$account."'");
			    $success[] .= phrase_the_amount_of . number_format($zen).phrase_successfully_sent_to . phrase_your_inventory;
			    refresh();
			}		
		}
	    else{
			$errors[] .= phrase_withraw_deposit_same_time;
		}
	 }
	 
foreach($errors as $message){
  echo "<div class='error'>".$message."</div>";
   }
foreach($success as $message){
  echo "<div class='success'>".$message."</div>";
   } 
 
  	echo "
	   <form  name='".form_enc()."' class='form' method='post'>
	    <div class='font'>".phrase_zenbank_top."</div></br>
	     <div class='line'> ".phrase_from.": <select name='chars_from'><option selected disabled>".phrase_sender."</option>".$opt."</select>
		 <input name='count_zen' type='numbers'/>
		 ".phrase_to.": <select name='chars_to'><option selected disabled>".phrase_receiver."</option>".$opt."</select>		       
       </div>
	   <input type='submit' name='sent_char' value='".phrase_send."'/>
	   </form>
	   <div class='bank'>".phrase_web_bank.": <span class='zen'>".number_format($acc_zen['zen'])."</span> ".phrase_zen."</div>
	";
     while($char_info = mssql_fetch_array($info)){
		 echo " 
		 <div>
		 <form  name='".form_enc()."' class='form' method = 'post'>		
		 <div>".phrase_character." <span class='char_name'>".$char_info['name']."</span>".phrase_have_in_inv.": <span class='zen'>".number_format($char_info['money'])."</span> ".phrase_zen."</div></br>
		 ".phrase_deposit_bank.": <input type='number' name='deposit'/>
		 ".phrase_withraw_char." :  <input type='number' name='withraw'/>
		 <input type='submit' value = '".phrase_send."' name='doit'/>
		 <input type='hidden' value = '".$char_info['name']."' name='charname'/>
		 </div>
		 </form>
		 ";
	 } 
}
else{
	home();
}
?>

<style>
.line{
	display:inline;
}
</style>