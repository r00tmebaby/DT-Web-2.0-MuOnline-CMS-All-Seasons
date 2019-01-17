<?php
$yes="";
$loggedwith = "";
if(isset($_SESSION['dt_username']) && isset($_SESSION['dt_password'])){
	$check_top = mssql_fetch_array(mssql_query("Select MAX(login) as login from [DTweb_Login_Logs] where account = '".$_SESSION['dt_username']."'"));
	$select = mssql_fetch_array(mssql_query("Select logout from [DTweb_Login_Logs] where account = '".$_SESSION['dt_username']."' and login='".$check_top['login']."'"));
	if(($check_top['login'] == null) || ($select['logout'] != 0)){
	mssql_query("Insert into [DTweb_Login_Logs] (account,login,logout,ip) VALUES ('".$_SESSION['dt_username']."','".time()."','0','".ip()."')");
	}
	$check_admin_sessions = mssql_query("Select * from DTweb_GM_Accounts");
	for($i=0;$i < mssql_num_rows($check_admin_sessions); $i++){
		$admins = mssql_fetch_array($check_admin_sessions);
		if(isset($_SESSION['admin_user']) && isset($_SESSION['admin_ip'])){
		if(($_SESSION['admin_user'] == $admins[0]) && ($_SESSION['admin_ip'] == $admins[2] )){
			$selecta = mssql_fetch_array(mssql_query("Select * from DTweb_GM_Accounts where name='".$_SESSION['admin_user']."' and ip = '".$_SESSION['admin_ip']."'"));
		    $yes = "<table class='form'><form name=".form_enc()." method='post'><input class='button' style='width:80px;height:20px;font-size:9pt;' type='submit' name='adminsback' value='".phrase_switch_back."'></form></table>";
		    $loggedwith = "<span style='font-size:12pt;'>".phrase_you_have_switched."</span> ";
		}
	  }
	}
	
	$is_admin = check_admin($_SESSION['dt_username']);
	if($is_admin != false){
			switch($_GET['p']){
			case "characters": case "resetcharacter": case  "addstats" : case "pkclear" : case  "resetstats" : case  "grandreset":
			$char= "in"; $adm=""; $acc = "";break;
			case "bank" : case  "accdetails" : case  "auction" : case  "storage" : case  "warehouse" :case  "lotto" : case  "buyjewels" : case  "market" : case  "votes": case "jewels":
			$char= ""; $adm=""; $acc = "in";break;
			case "addbox": case "addnews" : case "general" : case  "bans" : case  "warnings" : case  "accountedit" : case  "logs": case  "auctioned":
			$char= ""; $acc = ""; $adm="in"; break;			
			default: $char= ""; $acc = ""; $adm=""; break;
		  }
		  
            $admin_menu = '

                 <h4 >

                   '.phrase_admin_settigns.'
                 </h4>
                 
	             <ul >				    
				    <li><a href="?p=general">'.phrase_general_config.'</a></li>
                   	<li><a href="?p=addnews">'.phrase_add_news.'</a></li>
                   	<li><a href="?p=bans">'.phrase_add_ban.'</a></li>
                   	<li><a href="?p=warnings">'.phrase_add_warning.'</a></li>
                   	<li><a href="?p=accountedit">'.phrase_account_edit.'</a></li>
					<li><a href="?p=addbox">'.phrase_add_box.'</a></li>
                   	<li><a href="?p=logs&logs">'.phrase_logs.'</a></li>
                   </ul>   
             ';
	}
	else{
		switch($_GET['p']){
			case "characters": case "resetcharacter": case  "addstats" : case "pkclear" : case  "resetstats" : case  "grandreset":
			$char= "in"; $acc = "";break;
			case "bank" : case  "accdetails" :  case  "storage" : case  "warehouse" : case  "logs" : case  "lotto" : case  "buyjewels" : case  "auction" : case  "market" : case  "votes": case "jewels":
			$char= ""; $acc = "in";break;
			default: $char= ""; $acc = "";break;
		}
	}
	if(isset($_POST['logout'])){
		mssql_query("Update [DTweb_Login_Logs] set logout='".time()."' where login = '".$check_top['login']."' and account = '".$_SESSION['dt_username']."'");
		unset($_SESSION['dt_username']);
	    unset($_SESSION['dt_password']);
	    session_destroy();
		home();
	}
	if(isset($_POST['adminsback'])){
		$_SESSION['dt_username'] = $_SESSION['admin_user'];
		unset($_SESSION['admin_user']);
		unset($_SESSION['admin_ip']);
		header("Location:".$_SESSION['location']."");
		unset($_SESSION['location']);
	}
	
 echo '
<div class="panel-group nav" id="accordion">   
<span style="color:#c6884c;font-weight:bold;">'.phrase_welcome.'</span> '.$yes.$loggedwith.$_SESSION['dt_username'].'
'.$admin_menu.'	   

      <h4 >
       
       '.phrase_account_settings.'
      </h4>
<ul>
        	<li><a href="?p=accdetails">'.phrase_account_details.'</a></li>
			<li><a href="?p=lotto">'.phrase_lotto.'</a></li>
        	<li><a href="?p=bank">'.phrase_zen_bank.'</a></li>
			<li><a href="?p=buyjewels">'.phrase_buy_jewels.'</a></li>
			<li><a href="?p=jewels">'.phrase_jewel_bank.'</a></li>
			<li><a href="?p=warehouse">'.phrase_warehouse.'</a></li>			
        	<li><a href="?p=auction">'.phrase_auction.'</a></li>
        	<li><a href="?p=market">'.phrase_item_market.'</a></li>
			<li><a href="?p=storage">'.phrase_personal_storage.'</a></li>
		
        	<li><a href="?p=votes">'.phrase_vote.'</a></li>
        </ul>   

        <h4>
        '.phrase_character_settings.'
        </h4>


	  <ul  >
        	<li><a href="?p=characters">'.phrase_characters.'</a></li>
        	<li><a href="?p=resetcharacter">'.phrase_reset_character.'</a></li>
        	<li><a href="?p=addstats">'.phrase_add_stats.'</a></li>
        	<li><a href="?p=pkclear">'.phrase_pk_clear.'</a></li>
        	<li><a href="?p=resetstats">'.phrase_reset_stats.'</a></li>
        	<li><a href="?p=grandreset">'.phrase_grand_reset.'</a></li>
         </ul>   

    <form name="'.form_enc().'" method="post">
       <input type="submit" class="button border" value="'.phrase_logout.'" name="logout"/>
    </form>    
</div>';	
	}
else { 
	echo '
<form name="'.form_enc().'" method="post">
	<ul class="form" style="width:80%;">
		<li>
			<label for="acc">'.phrase_account.': </label>
			<input id="acc" name="account" type="text" maxlength="10" />
		</li>
		<li>
			<label for="pass">'.phrase_password.': </label>
			<input name="password" type="password" maxlength="10" />
		</li>
			
		<li class="buttons">
			<input  name="login" type="submit" value="'.phrase_login.'" />
			<input type="button" onclick="window.location.href="?p=register"" value="'.phrase_sign_up.'" />
		</li>
	</ul>
</form>';
	}
	if(isset($_POST['login'])){
		do_login();
	}
?>