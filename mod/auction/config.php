<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
include_once($_SERVER['DOCUMENT_ROOT']."/configs/config.php"); 
          
$web = array(
    "md5" => false,
    "user_session_name" => "dt_username",
    "pass_session_name" => "dt_password"
);


$db_config = array(
    "database" =>"{$database}",
    "dbhost" => "{$sql_host}", 
    "dbuser" => "{$sql_user}",
    "dbpass" => "{$sql_pass}",
);

	$sql_connect = mssql_connect($sql_host, $sql_user, $sql_pass) or die('Couldn&#39;t connect to SQL Server!');
	$db_connect = mssql_select_db($database, $sql_connect) or die('Couldn&#39;t open database: ' . $database);

	$check = mssql_num_rows(mssql_query("Select * from DTweb_Auction_Settings"));
	if($check== 0){
		$aray = array("rena","0","0","0","0","0","0","0","0");
		$encode = json_encode($aray);
	mssql_query("Insert into DTweb_Auction_Settings ([time],[resources]) values ('150','".$encode."')");
	}
	else{
$setup = mssql_fetch_array(mssql_query("Select * from DTweb_Auction_Settings"));
	}
$auction = array(
    
    "level"          => rand($setup['min'],$setup['max']),
	"randomoptions"  => $setup['randomoptions'],
	"option"         => $setup['options'],
    "luck"           => $setup['luck'],
    "skill"          => $setup['skill'],	
	"table"          => $setup['table'],
	"column"         => $setup['column'],
	"time"           => $setup['time'],
	"excopt"         => 4,
	"level_wings"    => 1,
    "excopt_wep"     => array(8, 16, 32),
    "excopt_gear"    => array(2, 4, 8),
    "excopt_wings"   => array(4)
  );


}
