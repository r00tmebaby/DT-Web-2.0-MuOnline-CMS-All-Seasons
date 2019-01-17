<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>

<link rel="stylesheet" type="text/css" href="../js/DateTimePicker.css" />
<script type="text/javascript" src="../js/DateTimePicker.js"></script>
<script type="text/javascript" src="../js/DateTimePicker-i18n.js"></script>	    
<script type="text/javascript">
$("[title]").tooltip();
</script> 
 <!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" href="DateTimePicker-ltie9.css" />
  <script type="text/javascript" src="DateTimePicker-ltie9.js"></script>
 <![endif]-->
 
 <!-- For i18n Support -->


<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$messages     = array();
$info         =  "";
$name         =  "";
$is_banned    =  "";
$info         =  "";
$date_started =  "";
$date_ended   =  "";
$add_ban      =  "";
$del_ban      =  "";
$add_warn     =  "";
$reason       =  ""; 

if(isset($_GET['char']) || isset($_GET['acc'])){
$type = (int)pro($_GET['type']);

 switch($type){
   case 1: $acc  = pro(trim($_GET['acc'])); $vid = "account";  $col = "bloc_code";$post_name = $acc; $check_name = mssql_query("Select [bloc_code] from [Memb_Info] where [memb___id] = '".$acc."'"); break;
   case 2: $char = pro(trim($_GET['char'])); $vid = "character";$post_name = $char;$col = "CtlCode"; $check_name = mssql_query("Select [CtlCode] from [Character] where [Name] = '".$char."'");break;
   default: $type = 0;
}
	
if(isset($acc) || isset($char) && $type != 0){
	
	if(mssql_num_rows($check_name) != 0){
		$banned      = mssql_fetch_array($check_name);
		
		$is_scheduled = mssql_fetch_array(mssql_query("Select TOP 1 * from [DTweb_Banned] where [{$vid}]= '".$post_name."' and [active] = 1 order by id desc"));
		if($banned[$col] == 1 && $is_scheduled['active'] != NULL){
			$name         = $post_name;
			$is_banned    = "<span style='color:#ff4c4d'>This {$vid} has an active ban</span>";
			$info         = "<div class='success'>You have selected {$vid} ".$post_name ."</br>". $is_banned."</div>";
			$date_started = date("d-m-Y H:i",$is_scheduled['start_date']);
		    $date_ended   = date("d-m-Y H:i",$is_scheduled['end_date']);
			$reason       = $is_scheduled['banned_reason'];
		    $add_ban      = "<input class='button' type='submit' value='Edit Ban' name='add_ban'/>";
		    $del_ban      = "<input class='button' type='submit' value='Delete Ban' name='del_ban'/>";
		    $add_warn     = '';			
		}
		elseif($banned[$col] == 0 && $is_scheduled['active'] == 1 && $is_scheduled['warn_count'] == 0){
			$name         = $post_name;
			$is_banned    = "<span style='color:#ff4c4d'>This {$vid} has scheduled ban, check dates for more details</span>";
			$info         = "<div class='success'>You have selected {$vid} ".$post_name ."</br>". $is_banned."</div>";
			$date_started = date("d-m-Y H:i",$is_scheduled['start_date']);
		    $date_ended   = date("d-m-Y H:i",$is_scheduled['end_date']);
            $add_ban      = "<input class='button' type='submit' value='Edit Ban' name='add_ban'/>";
		    $del_ban      = "<input class='button' type='submit' value='Delete Ban' name='del_ban'/>";
		    $add_warn     = '';	
		}
		elseif($banned[$col]== 0 && $is_scheduled['active'] == 1 && $is_scheduled['warn_count']> 0){
			$name         = $post_name;
			if($is_scheduled['warn_count'] >=3){
			  $is_banned    = "<span style='color:#ff4c4d'>This {$vid} has {$is_scheduled['warn_count']} warnings. We think that it is time to get banned. You can delete all warnings and add a ban instead or add a new warning. </span>";
			}
			else{
		      $is_banned    = "<span style='color:#ff4c4d'>This {$vid} has {$is_scheduled['warn_count']} warnings, check dates for more details</span>";
			}
			
    		$info         = "<div class='success'>You have selected {$vid} ".$post_name ."</br>". $is_banned."</div>";
			$date_started = date("d-m-Y H:i",$is_scheduled['start_date']);
		    $date_ended   = date("d-m-Y H:i",$is_scheduled['end_date']);
            $add_ban      = "";
		    $del_ban      = "<input class='button' type='submit' value='Delete Warnings' name='del_ban'/>";
		    $add_warn     = "<input class='button' type='submit' value='Add Warning' name='add_warn'/>";		
		}		
	     else{   
		    $info     = "<div class='success'>You have selected {$vid} ".$post_name ."</br>". $is_banned."</div>";
	        $name     = $post_name;
		    $reason   = $is_scheduled['banned_reason'];
		    $add_ban  = "<input class='button' type='submit' value='Add Ban' name='add_ban'/>";
		    $add_warn = "<input class='button' type='submit' value='Add Warning' name='add_warn'/>";
		 }
	}            
	else{        
		     $info    = "<div class='error'>This {$vid} doesn't exist</div>";
		     $name    = '';
	}
  }

}
if(isset($_POST['add_ban']) || isset($_POST['del_ban']) || isset($_POST['add_warn'])){
	if(isset($_POST['name'])&& isset($_GET['type']) && isset($_POST['start_date']) && isset($_POST['end_date'])){ 		
	    $check_exist = mssql_query("Select TOP 1 * from [DTweb_Banned] where [{$vid}]= '{$name}' and [active]=1 order by id desc");	
	     if($type != 0){
		   if(empty($_POST['end_date']) || empty($_POST['start_date'])){
			   $messages[] = "<div class='error'>Please do not leave e empty fileds</div>";
		   }
		   elseif($_POST['end_date'] < $_POST['start_date']){
			   $messages[] = "<div class='error'>Ban end date must be greater than the starting date</div>";
		   }
		   else{
			   	if(!strlen(trim($_POST['reason']))){
					$reason = "No Reason";
				}
				else{
					$reason = $_POST['reason'];
				}	
            if(mssql_num_rows($check_name) == 1){			
		         if(mssql_num_rows($check_exist) > 0){
					    $checka = mssql_fetch_array($check_exist);
				        $start  = strtotime($_POST['start_date']);
				        $end    = strtotime($_POST['end_date']);
				          if(isset($_POST['del_ban'])){
				            mssql_query("Update [DTweb_Banned] set [end_date] = '".time()."' where [id] = '".$checka['id']."'");					     		   
			                refresh();
						  }
				          elseif(isset($_POST['add_ban'])){
				            mssql_query("Update [DTweb_Banned] set [start_date]={$start},[end_date]={$end}, [banned_reason]='{$reason}' where [id] = '".$checka['id']."'");  	               		   
			                refresh();
						  }
						  elseif(isset($_POST['add_warn'])){
							$new_reason   = json_decode($checka['warn_reason']);	
                            $new_reason[] = $reason;
							$add_reason   = json_encode($new_reason);
                            $count      = $checka['warn_count'] +1; 							
				            mssql_query("Update [DTweb_Banned] set [start_date]={$start},[end_date]={$end}, [warn_reason]='".$add_reason."', [warn_count]={$count} where [id] = '".$checka['id']."'");  	               		   
			                refresh();
						  }
						  else{
							
						}
			        }
			   else{
				  if(isset($_POST['add_ban'])){
			            mssql_query("Insert into [DTweb_Banned] (".$vid.",start_date,end_date,banned_from,banned_date,banned_ip,banned_reason,active) values ('".$name."','".strtotime($_POST['start_date'])."','".strtotime($_POST['end_date'])."','".$_SESSION['dt_username']."','".time()."','".ip()."','".$reason."','1')");				    
					    refresh();
				   }
				  elseif(isset($_POST['add_ban'])){
			            mssql_query("Insert into [DTweb_Banned] (".$vid.",start_date,end_date,banned_from,banned_date,banned_ip,banned_reason,active) values ('".$name."','".strtotime($_POST['start_date'])."','".strtotime($_POST['end_date'])."','".$_SESSION['dt_username']."','".time()."','".ip()."','".$reason."','1')");				    
					    refresh();
				   }
				  elseif(isset($_POST['add_warn'])){
					    $reasons[] = $reason;
			            mssql_query("Insert into [DTweb_Banned] (".$vid.",start_date,end_date,banned_from,banned_date,banned_ip,warn_reason,active,warn_count) values ('".$name."','".strtotime($_POST['start_date'])."','".strtotime($_POST['end_date'])."','".$_SESSION['dt_username']."','".time()."','".ip()."','".json_encode($reasons)."','1','1')");				    
					    refresh();
				   }
				   else{
					   
				   }
			   }
			}
			else{
				$messages[] = "<div class='error'>You have typed wrong details</div>";
			}
	     }
	   }
       else{
		   $messages[] = "<div class='error'>This " . $vid . " is banned </div>";
	   }	   	   
	}
}

echo "
<div class='title'> Ban and Warn Accounts or Characters</div>
". $info;

foreach ($messages as $mess){
	echo $mess;
}
echo"
<form class='form' method='post'>
<table class='table'>
	    <tr>
              <td><label for='name'> Type Name</td></label><td><input autocomplete='off' value= '".$name."' id ='name' type='text' name='name'/><div id='result'></div></td>	        
	    </tr>
		<tr>
		      <td><label for='date'> Start Date</td></label><td><input value='".$date_started."' name='start_date' id ='start_date' type='text' data-field='datetime' readonly><div id='dtBox'></div></td>
	    </tr>
				<tr>
		      <td><label for='date'> End Date</td></label><td><input value='".$date_ended."' name='end_date' id ='end_date'  type='text' data-field='datetime' readonly><div id='dtBox'></div></td>
	    </tr>
		      <td><label for='reason'> Reason</td></label><td>
			  <textarea class='textarea' id = 'reason' cols='80' row='5' type='text' name='reason'/>{$reason}</textarea></td>
        </tr>       
	</table>
	<table align = 'center'>
	    <tr>
			<td align='center'>".$add_ban."</td>
			<td align='center'>".$del_ban."</td>
			<td align='center'>".$add_warn."</td>
	    </tr>
	</table>
</form>";
 
    $query_char = mssql_query("Select * from [DTweb_Banned] where [character] IS NOT NULL and [account] IS NULL and [active] =1 and [warn_count] = 0 order by end_date desc, start_date asc");
    $warn_char  = mssql_query("Select * from [DTweb_Banned] where [character] IS NOT NULL and [account] IS NULL and [active] =1  and [warn_count] > 0 order by end_date desc, start_date asc");
    $warn_acc   = mssql_query("Select * from [DTweb_Banned] where [account] IS NOT NULL and [character] IS NULL and [active] =1  and [warn_count] > 0 order by end_date desc, start_date asc");
	$query_acc  = mssql_query("Select * from [DTweb_Banned] where [account] IS NOT NULL and [character] IS NULL and [active] =1  and [warn_count] = 0 order by end_date desc, start_date asc");
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
						 <td>Banned GM IP</td>
					</tr>";
					
	    	for($i=0; $i < mssql_num_rows($query_char); $i++){
				$all_ban_chars = mssql_fetch_array($query_char);
				$banned_chars  = mssql_fetch_array(mssql_query("Select * from [Character] where [Name] = '".$all_ban_chars['character']."' and [CtlCode]='1'"));
				$googd=0;
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
					      <td><a href='?p=bans&type=2&char=".$all_ban_chars['character']."'>".$all_ban_chars['character']."</a></td>
					      <td>".$started."</td>
						  <td>".$expires."</td>
						  <td>".$all_ban_chars['banned_reason']."</td>
						  <td>".server_time($all_ban_chars['banned_date'])."</td>
						  <td>".($all_ban_chars['banned_from'])."</td>
						  <td>".($all_ban_chars['banned_ip'])."</td>
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
						 <td>Banned GM IP</td>
					</tr>";
					
	    	for($i=0; $i < mssql_num_rows($query_acc); $i++){
				$googd=0;
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
					      <td><a href='?p=bans&type=1&acc=".$all_ban_acc['account']."'>".$all_ban_acc['account']."</a></td>
					      <td>".$startedd."</td>
						  <td>".$expiresd."</td>
						  <td>".$all_ban_acc['banned_reason']."</td>
						  <td>".server_time($all_ban_acc['banned_date'])."</td>
						  <td>".($all_ban_acc['banned_from'])."</td>
						  <td>".($all_ban_acc['banned_ip'])."</td>
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
						 <td>Warned GM IP</td>
					</tr>";
					
	    	for($i=0; $i < mssql_num_rows($warn_char); $i++){
				$all_warn_chars = mssql_fetch_array($warn_char);
				$googd = 0;
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
					      <td><a href='?p=bans&type=2&char=".$all_warn_chars['character']."'>".$all_warn_chars['character']."</a></td>
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
						  <td>".($all_warn_chars['banned_ip'])."</td>
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
						 <td>Warn Reasons</td>
						 <td>Warned date</td>
						 <td>Warned from</td>
						 <td>Warned GM IP</td>
					</tr>";
					
	    	for($i=0; $i < mssql_num_rows($warn_acc); $i++){
				$googd = 0;
				$all_warn_acc = mssql_fetch_array($warn_acc);
				$banned_acc   = mssql_fetch_array(mssql_query("Select * from [Memb_Info] where [memb___id] = '".$all_warn_acc['account']."' and [bloc_code]='1'"));
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
				
                $reasonss  = json_decode($all_warn_acc['warn_reason']);
				$times = 0;
				echo  "<tr class='ban_info' bgcolor='".$bg_colord."'>
					      <td><a href='?p=bans&type=1&acc=".$all_warn_acc['account']."'>".$all_warn_acc['account']."</a></td>
					      <td>".$startedd."</td>
						  <td>".$expiresd."</td>
						  <td>";
				    foreach($reasonss as $times => $reason){
				              	$times++;
			                  echo "<div style=' line-height:1;font-size:8pt;text-height:2pt;text-align:left;'>". $times . ". &nbsp;" . $reason . '</div></br>' ;
				            }
				    echo" </td>

						  <td>".server_time($all_warn_acc['banned_date'])."</td>
						  <td>".($all_warn_acc['banned_from'])."</td>
						  <td>".($all_warn_acc['banned_ip'])."</td>
					  </tr>";						 				  		
	    	}
			echo "</table>";
	    }
}
?>
<script>
jQuery('#datetimepicker').datetimepicker();
</script>
<script>
 $(document).ready(function()
 {
   
     $("#dtBox").DateTimePicker();
   
 });

  
 $(document).ready(function(){  
      $('#name').keyup(function(){ 	      
           var txt = $(this).val(); 
           var acc = $('#acc').val();
           var chars = $('#char').val();		   
           if(txt != '')  
           {  
                $.ajax({  
				     url:"../inc/fetch_char.php", 
                     method:"post",  
                     data:{search:txt,acc:acc,chars:chars},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          $('#result').html(data);  
                     }  
                });  
           }  
           else  
           {  
                $('#result').html('');                 
           }  
      });  
 });  
 </script> 	


	