<?php
	@session_start();
	ob_start();	

	require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
	include $_SERVER['DOCUMENT_ROOT']."/inc/geoip.php";
	require $_SERVER['DOCUMENT_ROOT']."/inc/sqlcfg.php";
	require $_SERVER['DOCUMENT_ROOT']."/inc/main_funcs.php";
	require $_SERVER['DOCUMENT_ROOT']."/inc/modules_funcs.php";	
	require $_SERVER['DOCUMENT_ROOT']."/inc/iteminfouser.php";
	require $_SERVER['DOCUMENT_ROOT']."/inc/market_funcs.php";

	if ($option['debug'] == 0){	
	require $_SERVER['DOCUMENT_ROOT']."/block/zbblock.php";
	}
	
	$set   = web_settings();
    lang();
	auto_ban();
    clean_vip();
	

// Double Check if the theme exist	
$theme = $_SERVER['DOCUMENT_ROOT'].'/themes/' . $set[3] . '/theme.php';
if (file_exists($theme)) {
    require($_SERVER['DOCUMENT_ROOT'].'/themes/' . $set[3] . '/theme.php');
} else {
     exit("The theme <font color='red'>".$set[3]."</font> doesn't exists! Check the file name or directory, please!");
	 
}

if((mssql_num_rows(mssql_query("Select * from DTweb_GM_Accounts"))) == 0){
	echo "You need to use your external IP address. The default local IP and account 'test' has been set for default";
	$add_admin = mssql_query("Insert into DTweb_GM_Accounts (name,gm_level,ip) values ('test','666','".$_SERVER['SERVER_ADDR']."')");
}
ob_end_flush();




