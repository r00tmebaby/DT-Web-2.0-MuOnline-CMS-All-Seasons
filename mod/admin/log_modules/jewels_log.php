<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
////////////////////////////
// Jewel Depositor Logs  ///
//     by r00tme         ///
////////01/22/2016//////////
////* Serial Search  ///////
////* Pagination    ////////
////////////////////////////

$lines = 20;
if(!isset($_GET['page'])){$limit='0';$page = '1';}
else{$page = (int)($_GET['page']);$pages = $page - 1;$limit = $lines * $pages;}  
if($limit<0){$limit = 0;}
serial_search("?p=logs&logs=jewels");

echo '
      </br> 
        <div class="afix">
		   <a class="font main_menu_default_button" href="?p=logs&logs=jewels&deposit=deposit">'.phrase_jewel_deposit.'</a> ||
		   <a class="font main_menu_default_button" href="?p=logs&logs=jewels">'.phrase_jewel_withraw.'</a> 
		</div>
	  </br> 
    ';
		
if($_GET['deposit']){
$list_query = "SELECT TOP {$lines} * FROM [DTweb_Modules_Logs] where id Not in (Select TOP {$limit} [id] FROM [DTweb_Modules_Logs] where module='Jewel Deposit' order by [date] desc) and module='Jewel Deposit' order by [date] desc";
$sql        = mssql_query("SELECT count(*) FROM [DTweb_Modules_Logs] where module='Jewel Deposit' ");
$all_market = mssql_result($sql, 0, 0);  
$deposit    = mssql_query($list_query);
$total      = ceil($all_market/$lines);
pagi_style("logs&logs=jewels&deposit=deposit",$total,$lines);
echo "
     <table style='width:100%;font-size:9pt;border-top:1px solid #131304;'> 
	    <tr class='title'><td style='border-bottom:1px solid #000;' colspan='5'>Jewel Deposit</td></tr>
	    <tr class='title'> 
		   <td>#</td>
		   <td>".phrase_account."</td>
		   <td>".phrase_deposited."</td>
		   <td>".phrase_date."</td>
		   <td>".phrase_ip."</td>
        </tr>		   
    ";
  for ($i=0;$i<mssql_num_rows($deposit);$i++){
	   $num++;
	   $ns  = $limit + $num;
	   $bgcolor  = "style='border:1px solid #000000' bgcolor='#26130b'";
	   if($i %2){$bgcolor = "bgcolor='#341407'";}
	   $row      = mssql_fetch_array($deposit);
	   $deposted = json_decode($row['jewels']);
	   $colors   = mssql_fetch_array(mssql_query("Select * from [DTweb_Deposit_Settings] where [ItemFour] = '".$deposted[0]."'")) ;    	   
	echo"		
		<tr ".$bgcolor."> 
	       <td>".$ns."</td>
		   <td>".$row['account']."</td>
		   <td style='color:".$colors['ItemColor']."'>".$deposted['ItemName']." x ".$colors['ItemName']."</td>
		   <td >".server_time($row['date'])."</td>
		   <td>".$row['ip']."</td>
        </tr>
	"; 	
    }
   echo "</table>";
 }
else{
$list_query = "SELECT TOP {$lines} * FROM [DTweb_Modules_Logs] where id Not in (Select TOP {$limit} [id] FROM [DTweb_Modules_Logs] where module='Jewel Withraw' order by [date] desc) and module='Jewel Withraw' order by [date] desc";
$sql        = mssql_query("SELECT count(*) FROM [DTweb_Modules_Logs] where module='Jewel Withraw' ");
$all_market = mssql_result($sql, 0, 0);  
$whithraw   = mssql_query($list_query);
$total      = ceil($all_market/$lines);
pagi_style("logs&logs=jewels",$total,$lines);
echo "
     <table class='afix' style='width:100%;font-size:9pt;border-top:1px solid #131304;'>
	    <tr class='title'><td colspan='6'>Jewel Withraw</td></tr>
	    <tr class='title'>
           <td>#</td>		
		   <td>".phrase_account."</td>
		   <td>".phrase_deposited."</td>
		   <td>".phrase_serial."</td>
		   <td>".phrase_date."</td>
		   <td>".phrase_ip."</td>
        </tr>		   
    ";
  for ($i=0;$i<mssql_num_rows($whithraw);$i++){
	  	$bgcolor = "style='border:1px solid #000000' bgcolor='#26130b'";
		$num++;
	    $ns  = $limit + $num;
		if($i %2){
		$bgcolor = "bgcolor='#341407'";
		}     		
	    $row        = mssql_fetch_array($whithraw);
	    $whithrawal = json_decode($row['jewels']); 
	    $serial     = substr($whithrawal[0],6,8);
	    $colors     = mssql_fetch_array(mssql_query("Select * from [DTweb_Deposit_Settings] where [ItemFour] = '".substr($whithrawal[0],0,4)."'")) ;
	echo"		
		<tr ".$bgcolor."> 
		   <td>".$ns."</td>
		   <td>".$row['account']."</td>
		   <td style='color:".$colors['ItemColor']."'>".$whithrawal[2]." x ".$whithrawal[1]."</td>
		   <td><a href='?p=logs&logs=jewels&serial=".substr($whithrawal[0],6,8)."'>".strtoupper($serial)."</a></td>
		   <td >".server_time($row['date'])."</td>
		   <td>".$row['ip']."</td>
        </tr>
	"; 
  }
echo "</table>";
}
}
?>