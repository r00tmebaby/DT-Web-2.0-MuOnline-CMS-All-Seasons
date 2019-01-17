<?php if (isset($_SESSION['dt_username'])){
	$set=web_settings();
	$memb_info  = mssql_fetch_array(mssql_query("Select * from [Memb_info] where [memb___id] = '".$_SESSION['dt_username']."'"));
	$played     = mssql_fetch_array(mssql_query("Select GAMEIDC from [AccountCharacter] where [id] = '".$_SESSION['dt_username']."'"));
	$last_web   = mssql_fetch_array(mssql_query("Select TOP 1 * from [DTweb_Login_Logs] where [account] = '".$_SESSION['dt_username']."' and logout !=0 order by id desc"));
	$is_admin = check_admin($_SESSION['dt_username']);
		if($last_web['login'] == null){
			$web_info = '<center>----</center>';
		}
		else {
			$web_info = server_time($last_web['login']) ;
		}
	if($is_admin == false){
	$user_status = "User";
    }
	else{
		    switch($is_admin[1]){
				case 1:$user_status = 'Beginner GM';   break;
				case 2:$user_status = 'Trusted GM';   break;
				case 666:$user_status = 'Administrator'; break;
			}
	}
?>
<article class="contents_area_wrp">
<Div></div>
<div id="content">
    <div id="box1">
        <div class="title1">
            <h1>User Panel</h1>
        </div>
        <div id="content_center">
            <div class="box-style4" style="margin-bottom: 20px;">
                <div class="entry">
                    <div id="ucp_info">
                        <div class="half">
                            <table width="100%">
                                <tr>
                                    <td width="5%"><img
                                            src="../themes/respect/images/icons/user.png"/>
                                    </td>
                                    <td width="45%">Account</td>
                                    <td width="50%"><?php echo $_SESSION['dt_username']?></td>
                                </tr>
                                <tr>
                                    <td><img
                                            src="../themes/respect/images/icons/email.png"/>
                                    </td>
                                    <td>Email</td>
                                    <td><?php echo $memb_info['mail_addr']?></td>
                                </tr>
                                <tr>
                                    <td><img
                                            src="../themes/respect/images/icons/award_star_bronze_1.png"/>
                                    </td>
                                    <td>Rank</td>
                                    <td><?php echo $user_status?></td>
                                </tr>
                                <tr>
                                    <td><img
                                            src="../themes/respect/images/icons/server.png"/>
                                    </td>
                                    <td>Server</td>
                                    <td><?php echo $set[9]?></td>
                                </tr>
                                                            </table>
                        </div>
                        <div class="half">
                            <table width="100%">
                                <tr>
                                    <td width="5%"><img
                                            src="../themes/respect/images/icons/date.png"/>
                                    </td>
                                    <td width="40%">Member Since</td>
                                    <td width="55%"><?php echo server_time($memb_info['reg_date'])?></td>
                                </tr>
                                <tr>
                                    <td><img
                                            src="../themes/respect/images/icons/shield.png"/>
                                    </td>
                                    <td>Last Login</td>
                                    <td><?php echo $web_info?>                                   </td>
                                </tr>
                                <tr>
                                    <td><img
                                            src="../themes/respect/images/icons/ip.png"/>
                                    </td>
                                    <td>Last Login Ip</td>
                                    <td><?php echo $last_web['ip']?></td>
                                </tr>
                                <tr>
                                    <td><img
                                            src="../themes/respect/images/icons/ip.png"/>
                                    </td>
                                    <td>Current Ip</td>
                                    <td><?php echo ip()?></td>
                                </tr>
                                                            </table>
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div class="box-style4">
              
                <div class="entry">
                    <div id="character-info">
					
					<?php include ("inc/loader.php")?>
              </div>
            </div>
        </div>
    </div>
</div>
</article>
<?php }
else{
?>
<article class="contents_area_wrp">
<Div></div>
<div id="content">
    <div id="box1">
        <div id="content_center">
            <div class="box-style4">
              
                <div class="entry">
                    <div id="character-info">
					<?php include ("inc/loader.php")?>
              </div>
            </div>
        </div>
    </div>
</div>
</article>
<?php }?>