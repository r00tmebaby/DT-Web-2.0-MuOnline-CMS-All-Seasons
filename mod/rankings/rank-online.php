<?php
include("configs/config.php");
include("mod/rankings/rank_menu.php");
$set        = web_settings();
$i          = 0;
$flags      = "";
$pag        = (isset($_GET['page']) &&  $_GET['page'] > 0) ? (int)$_GET['page'] : 1;
$page       = (int)($pag);
$count      = mssql_num_rows(mssql_query("Select [GameIDC],[Name] from Character,memb_stat,accountcharacter where 1=1 and memb___id COLLATE DATABASE_DEFAULT=accountid COLLATE DATABASE_DEFAULT and ConnectStat=1 and name COLLATE DATABASE_DEFAULT=GameIDC COLLATE DATABASE_DEFAULT "));
$max_pages  = ceil($count/$set[13]);
$offset     = ($set[13]) * ($page - 1); 
$query      = mssql_query(pagination($offset, $set[13], '[GameIDC],[ConnectTM],[Name],[cLevel],[Class],[AccountID],[Resets],[MapNumber],[MarryName],[CtlCode],[IsMarried],[Money]', 'Character,memb_stat,accountcharacter', 'ConnectTM' ,'[Name]','1=1 and memb___id COLLATE DATABASE_DEFAULT=accountid COLLATE DATABASE_DEFAULT and ConnectStat=1 and name COLLATE DATABASE_DEFAULT=GameIDC COLLATE DATABASE_DEFAULT')); 

pagi_style("onlinenow",$max_pages,$set[13]);

echo "
<table class='table'>
	<tbody>
	<tr class='title'>
		<td>".phrase_id."</td>
		<td>".phrase_name."</td>
		<td>".phrase_class."</td>
		<td>".phrase_level."</td>
		<td>".phrase_resets."</td>
		<td>".phrase_location."</td>
		<td>".phrase_online_since."</td>
	</tr>
";


while($rows = mssql_fetch_array($query)) {
	
$select_ip  = mssql_fetch_array(mssql_query("Select * from [MEMB_STAT] where [memb___id] = '".$rows['AccountID']."'"));
$rank       = $i+$offset;		
$char_class = char_class($rows['Class']);

if(strtolower(geoip_country_code_by_addr(geo_data(), $select_ip['IP'])) <> NULL){
	$flags = "<img width='20px' height='15px'src='http://flags.fmcdn.net/data/flags/normal/". strtolower(geoip_country_code_by_addr(geo_data(), $select_ip['IP'])).".png'/> ";
}

echo '
	<tr>
		<td>
			'.$rank.'
		</td>
		<td>
			
		'.$flags.'<a href="?p=user&character='.$rows['Name'].'">'.$rows['Name'].'</a>
		</td>
		<td>
			'.$char_class.'
		</td>
		<td>
			'.$rows['cLevel'].' 
		</td>
		<td>
			'.$rows['Resets'].'
		</td>
		<td>
			'.de_map($rows['MapNumber']).' 
		</td>
		<td>
			'.time_diff(strtotime($rows['ConnectTM']),time()).'
		</td>
	</tr>

';
}
echo "</table>";

pagi_style("onlinenow",$max_pages,$set[13]);


?>

