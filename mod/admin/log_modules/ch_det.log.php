<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
////////////////////////////
//   Change Details  Logs      ///
//     by r00tme         ///
/////20/07/2016/////////////
////////////////////////////

$lines = 20;
if(!isset($_GET['page'])){$limit='0';$page = '1';}
else{$page = (int)($_GET['page']);$pages = $page - 1;$limit = $lines * $pages;}  
if($limit<0){$limit = 0;}
$list_query = "SELECT TOP {$lines} * FROM [DTweb_Modules_Logs] where id Not in (Select TOP {$limit} [id] FROM [DTweb_Modules_Logs] where module='Change Account Details' order by [date] desc) and module='Change Account Details' order by [date] desc";
$sql        = mssql_query("SELECT count(*) FROM [DTweb_Modules_Logs] where module='Change Account Details' ");
$all_market = mssql_result($sql, 0, 0);  
$changes    = mssql_query($list_query);
$total      = ceil($all_market/$lines);
pagi_style("logs&logs=chdetails",$total,$lines);

echo "
     <table style='width:100%;font-size:9pt;border-top:1px solid #131304;'> 
	    <tr class='title'><td style='border-bottom:1px solid #000;' colspan='8'>Change Account Details</td></tr>
	    <tr class='title'> 
		   <td>#</td>
		     <td>".phrase_account."</td>
		     <td>".phrase_date."</td>
		     <td>".phrase_ip."</td>
		     <td>".phrase_email."</td>
			 <td>".phrase_newemail."</td>
		     <td>".phrase_password."</td>
			 <td>".phrase_newpassword."</td>
        </tr>		   
    ";
  for ($i=0;$i<mssql_num_rows($changes);$i++){
	   $num++;
	   $ns  = $limit + $num;
	   $bgcolor  = "style='border:1px solid #000000' bgcolor='#26130b'";
	   if($i %2){$bgcolor = "bgcolor='#341407'";}
	   $row  = mssql_fetch_array($changes);   
if ($row['newpass'] != $row['bank']){$class= "class='red'";}	 
if ($row['newmail'] != $row['stats']){$class= "class='red'";}	  
	echo"		
		<tr ".$bgcolor."> 
	       <td>".$ns."</td>
		   <td>".$row['account']."</td>
		   <td>".server_time($row['date'])."</td>
		   <td >".$row['ip']."</td>
		   <td>".$row['stats']."</td>
		   <td ".$class.">".$row['newmail']."</td>
		   <td>".$row['bank']."</td>
		   <td ".$class.">".$row['newpass']."</td>
        </tr>
	"; 	
    }
   echo "</table>";
}
?>

<style>
 .red{
	 color:#ff9326;
	 text-shadow:1px 1px #000000;
 }
</style>

