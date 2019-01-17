<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
////////////////////////////
//   ZEN Bank  Logs      ///
//     by r00tme         ///
/////01/22/2016/////////////
////////////////////////////

$lines = 20;
if(!isset($_GET['page'])){$limit='0';$page = '1';}
else{$page = (int)($_GET['page']);$pages = $page - 1;$limit = $lines * $pages;}  
if($limit<0){$limit = 0;}
$td1 ='';
echo '
      </br> 
        <div class="afix">
		   <a class="font main_menu_default_button" href="?p=logs&logs=bank&type=deposit">'.phrase_bank_deposit.'</a> ||
		   <a class="font main_menu_default_button" href="?p=logs&logs=bank&type=withdraw">'.phrase_bank_withraw.'</a> ||
		   <a class="font main_menu_default_button" href="?p=logs&logs=bank">'.phrase_bank_transfer.'</a> 
		</div>
	  </br> 
    ';
		
switch($_GET['type']){
	case "deposit"  : $pagi = "deposit"; $change = "Bank Deposit"; break;
    case "withdraw" : $pagi = "withdraw"; $change = "Bank Withraw"; break; 
    default:$td1="<td>".phrase_to_character."</td>";$pagi = "transfer"; $change = "Bank Character Transfer"; break; 	
}
$list_query = "SELECT TOP {$lines} * FROM [DTweb_Modules_Logs] where id Not in (Select TOP {$limit} [id] FROM [DTweb_Modules_Logs] where module='".$change."' order by [date] desc) and module='".$change."' order by [date] desc";
$sql        = mssql_query("SELECT count(*) FROM [DTweb_Modules_Logs] where module='".$change."' ");
$all_market = mssql_result($sql, 0, 0);  
$deposit    = mssql_query($list_query);
$total      = ceil($all_market/$lines);
pagi_style("logs&logs=bank&type=".$pagi,$total,$lines);

echo "
     <table style='width:100%;font-size:9pt;border-top:1px solid #131304;'> 
	    <tr class='title'><td style='border-bottom:1px solid #000;' colspan='8'>".$change."</td></tr>
	    <tr class='title'> 
		   <td>#</td>
		   <td>".phrase_account."</td>
		   <td>".phrase_from_character."</td>
		   ".$td1."
		   <td>".phrase_deposited."</td>
		   <td>".phrase_bank_after."</td>
		   <td>".phrase_date."</td>
		   <td>".phrase_ip."</td>
        </tr>		   
    ";
  for ($i=0;$i<mssql_num_rows($deposit);$i++){
	   $num++;
	   $td = '';
	   $ns  = $limit + $num;
	   $bgcolor  = "style='border:1px solid #000000' bgcolor='#26130b'";
	   if($i %2){$bgcolor = "bgcolor='#341407'";}
	   $row      = mssql_fetch_array($deposit);
	   $enc      = json_decode($row['bank']);
	   $depo     = $row['bank'];
	   if(!isset($_GET['type'])){
	   $td = "<td>".$enc[0]."</td>";
	   $depo = $enc[1];
	   }
	   $bank_zen = mssql_fetch_array(mssql_query("Select * from [DTweb_Bank] where [memb___id] = '".$row['account']."'")) ;    	   
	echo"		
		<tr ".$bgcolor."> 
	       <td>".$ns."</td>
		   <td>".$row['account']."</td>
		   <td>".$row['character']."</td>
	        ".$td."
		   <td>".$depo."</td>
		   <td>".number_format($bank_zen['Zen'])."</td>
		   <td >".server_time($row['date'])."</td>
		   <td>".$row['ip']."</td>
        </tr>
	"; 	
    }
   echo "</table>";
}
?>


