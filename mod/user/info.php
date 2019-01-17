<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/tipTip.js"></script>
<?php

//////////////////////////
/////  User Info  ////////
/////  by r00tme  ////////
////// 18/01/2016 ////////
//////////////////////////
include('configs/config.php');
if(isset($_SESSION['dt_username'])){	
    $lines      = 30;
    if(!isset($_GET['page'])){$limit='0';$page = '1';}
    else{$page  = (int)($_GET['page']);$pages = $page - 1;$limit = $lines * $pages;}  
    if($limit<0){$limit = 0;}
    $all_logs   = mssql_num_rows(mssql_query("Select * from [DTweb_Login_Logs] where account = '".$_SESSION['dt_username']."'"));	
	$total      = ceil($all_logs/$lines);
        $login      = mssql_fetch_array(mssql_query("Select * from [MEMB_INFO] where [memb___id] = '".$_SESSION['dt_username']."'"));
	$cre        = mssql_fetch_array(mssql_query("Select * from [MEMB_Credits] where [memb___id] = '".$_SESSION['dt_username']."'"));
	$bank       = mssql_fetch_array(mssql_query("Select * from [DTweb_Bank] where [memb___id] = '".$_SESSION['dt_username']."'"));
	$logins     = mssql_query("SELECT TOP {$lines} * FROM [DTweb_Login_Logs] where id Not in (Select TOP {$limit} [id] FROM [DTweb_Login_Logs] where [account]='".$_SESSION['dt_username']."' order by [login] desc) and [account]='".$_SESSION['dt_username']."' order by [login] desc");	
	pagi_style("accdetails",$total,$lines);
	echo "
	    <table class='table'>
	        <tr class='title'> 
		       <td>".phrase_registered_date."</td>
		  	   <td>".phrase_registered_ip."</td>
		  	   <td>".phrase_credits."</td>
		  	   <td>".phrase_zen."</td>
              </tr>
		    <tr> 
		       <td> ".server_time($login['reg_date'])."</td>
			   <td>".$login['reg_ip']."</td>
			   <td>".$cre['credits']."</td>
			   <td>".number_format($bank['Zen'])."</td>
            </tr>
        </table>
		
        <table class='table'>
            <tr class='title'>
				<td>#</td>	
                <td>".phrase_loggin."</td>	
                <td>".phrase_loggout."</td>
                <td>".phrase_total_logged."</td>				  
				<td>IP</td>
            </tr>";					
              for ($i = 1; $i < mssql_num_rows($logins)+1; $i++) {			
		        $logove   = mssql_fetch_array($logins);
				$rank =$i+$limit;
	            switch($logove['logout']){ case 0 : $logout=phrase_still_logged;break; default:$logout=server_time($logove['logout']);break;}
				if($logout != phrase_still_logged){
					$difference = time_diff($logove['login'], $logove['logout']);
				}
                else{
					$difference = phrase_still_logged;
					}
					
				echo"
				<tr>
				  <td>".$rank."</td>	
                  <td>".server_time($logove['login'])."</td>	
                  <td>".$logout."</td> 
                  <td>".$difference."</td>				  
				  <td>".$logove['ip']."</td>
                </tr>";
				}
              echo"</table>";
             pagi_style("accdetails",$total,$lines);
   }

else{
	exit();
}

?>
<style>
.table td{
	font-size:9pt;	
}
</style>