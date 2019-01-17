<?php
 $set = web_settings();
	$accounts = mssql_num_rows(mssql_query('SELECT bloc_code FROM MEMB_INFO'));
	$characters = mssql_num_rows(mssql_query('SELECT Name FROM Character'));
	$guilds = mssql_num_rows(mssql_query('SELECT G_Name FROM Guild'));
	
	$ban_chars = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE CtlCode = 1'));
	$ban_accs = mssql_num_rows(mssql_query('SELECT bloc_code FROM MEMB_INFO WHERE bloc_code = 1'));
	
	$dw = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE Class = 0'));
	$sm = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE Class = 1'));
	$dk = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE Class = 16'));
	$bk = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE Class = 17'));
	$elf = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE Class = 32'));
	$me = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE Class = 33'));
	$mg = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE Class = 48'));
	$dl = mssql_num_rows(mssql_query('SELECT Name FROM Character WHERE Class = 64'));
	
	$online = mssql_num_rows(mssql_query('SELECT ConnectStat FROM MEMB_STAT WHERE ConnectStat > 0'));
	
	$status='<span style="color:#ff9673;">Offline</span>';
	
	if($stscheck=@fsockopen($set[5], $set[6], $ERROR_NO, $ERROR_STR, (float)0.5))
	{ 
		$status='<span style="color:#99ff99;">Online</span>';
		fclose($stscheck); 
	}
	else{
		$status='<span style="color:#ff7373;">Offline</span>';
	}
 if($set[3] == "aion"){
	$color_right =  "color:#fffff2";
	$color_left  =  "color:#ffcc99";
 }
 else{
	$color_right =  ""; 
	$color_left  =  "";
 }

?>

<ul>

<li><?php echo phrase_server_name?>: <?php echo $set[4]; ?></li>
<li><?php echo phrase_server_accounts?>: <?php echo $accounts; ?></li>
<li><?php echo phrase_server_from?>: <?php echo $set[8]; ?></li>
<li><?php echo phrase_server_chars?>: <?php echo $characters; ?></li>
<li><?php echo phrase_server_version?>: <?php echo $set[7]; ?></li>
<li><?php echo phrase_server_guild?>: <?php echo $guilds; ?></li>
<li><?php echo phrase_server_exp_drop?>: <?php echo $set[9].' &amp; '.$set[11]; ?></li>
<li><?php echo phrase_server_banned?>: <?php echo $ban_chars .'/'. $ban_accs; ?></li>
<li><?php echo phrase_server_status?>: <?php echo $status; ?></li>
<li><?php echo phrase_server_users_online?>: <?php echo $online; ?></li>
<li>Dark Wizard: <?php echo $dw; ?></li>
<li>Soul Master: <?php echo $sm; ?></li>
<li>Dark Knight: <?php echo $dk; ?></li>
<li>Blade Knight: <?php echo $bk; ?></li>
<li>Fairy Elf: <?php echo $elf; ?></li>
<li>Muse Elf: <?php echo $me; ?></li>
<li>Magic Gladiator: <?php echo $mg; ?></li>
<?php if($set[7] === "99t"): ?>
	<li>Dark Lord: <?php echo $dl; ?></li>
	
<?php endif; ?>
</ul>