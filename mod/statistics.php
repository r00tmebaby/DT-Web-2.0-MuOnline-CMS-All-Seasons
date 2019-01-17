<?php
@session_start();

include($_SERVER['DOCUMENT_ROOT']."/configs/config.php");
require $_SERVER['DOCUMENT_ROOT']."/inc/modules_funcs.php";
$set=web_settings();
lang();
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
 if($set[3] == "Aion"){
	$color_right =  "color:#fffff2";
	$color_left  =  "color:#ffcc99";
 }
 else{
	$color_right =  ""; 
	$color_left  =  "";
 }

?>
<table class='table'>
	<tr class="title">
		<td><?php echo phrase_information?></td>
		<td><?php echo phrase_statistic?></td>
	</tr>
	<tr>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_name?>: </p><p class="right" style="<?php echo $color_right?>"><?php echo $set[4]; ?></p></td>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_accounts?>: </p><p class="right" style="<?php echo $color_right?>"><?php echo $accounts; ?></p></td>
	</tr>
	<tr>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_from?>: </p><p class="right" style="<?php echo $color_right?>"><?php echo $set[8]; ?></p></td>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_chars?>: </p><p class="right" style="<?php echo $color_right?>"><?php echo $characters; ?></p></td>
	</tr>
	<tr>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_version?>: </p><p class="right" style="<?php echo $color_right?>"><?php echo $set[7]; ?></p></td>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_guild?>: </p><p class="right" style="<?php echo $color_right?>"><?php echo $guilds; ?></p></td>
	</tr>
	<tr>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_exp_drop?>: </p><p class="right" style="<?php echo $color_right?>"><?php echo $set[9].' &amp; '.$set[11]; ?></p></td>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_banned?>: </p><p class="right" style="color:#890000;"><?php echo $ban_chars .'/'. $ban_accs; ?></p></td>
	</tr>
	<tr>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_status?>: </p><p class="right"><?php echo $status; ?></p></td>
		<td><p style="<?php echo $color_left?>" class="left"><?php echo phrase_server_users_online?>: </p><p class="right" style="color:#99ff99;"><?php echo $online; ?></p></td>
	</tr>
</table>
<table class='table'>
	<tr class="title">
		<td><?php echo phrase_server_first_class?></td>
		<td><?php echo phrase_server_second_class?></td>
	</tr>
	<tr>
		<td><p style="<?php echo $color_left?>" class="left">Dark Wizard: </p><p class="right" style="<?php echo $color_right?>"><?php echo $dw; ?></p></td>
		<td><p style="<?php echo $color_left?>" class="left">Soul Master: </p><p class="right" style="<?php echo $color_right?>"><?php echo $sm; ?></p></td>
	</tr>
	<tr>
		<td><p style="<?php echo $color_left?>" class="left">Dark Knight: </p><p class="right" style="<?php echo $color_right?>"><?php echo $dk; ?></p></td>
		<td><p style="<?php echo $color_left?>" class="left">Blade Knight: </p><p class="right" style="<?php echo $color_right?>"><?php echo $bk; ?></p></td>
	</tr>
	<tr>
		<td><p style="<?php echo $color_left?>" class="left">Fairy Elf: </p><p class="right" style="<?php echo $color_right?>"><?php echo $elf; ?></p></td>
		<td><p style="<?php echo $color_left?>" class="left">Muse Elf: </p><p class="right" style="<?php echo $color_right?>"><?php echo $me; ?></p></td>
	</tr>
	<tr>
		<td colspan="2"><p style="<?php echo $color_left?>" class="left">Magic Gladiator: </p><p class="right" style="<?php echo $color_right?>"><?php echo $mg; ?></p></td>
	</tr>
	<?php if($set[7] === "99t"): ?>
	<tr>
		<td colspan="2"><p style="<?php echo $color_left?>" class="left">Dark Lord: </p><p class="right" style="<?php echo $color_right?>"><?php echo $dl; ?></p></td>
	</tr>
	<?php endif; ?>
</table>