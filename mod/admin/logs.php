<!--//////////////////////////
/////// Log System ///////////
//////  by r00tme  ///////////
//////  01/21/2015  //////////
////* Serial Exist Check  ////
////* User Session Switch ////
////* Pagination    /////////
-->
<div class='afix battle_tap title'>
 <a class="border market_bottom_2 hvr-pulse" href="?p=logs&logs=bank"><?php print phrase_bank_logs?></a>
   <a class="border market_bottom_2 hvr-pulse" href="?p=logs&logs=market"><?php print phrase_market_logs?></a>  
     <a class="border market_bottom_2 hvr-pulse" href="?p=logs&logs=jewels"><?php print phrase_jewels_logs?></a> 
       <a class="border market_bottom_2 hvr-pulse" href="?p=logs&logs=addstats"><?php print phrase_addstats_logs?></a> 
	     <a class="border market_bottom_2 hvr-pulse" href="?p=logs&logs=resetstats"><?php print phrase_resetststats_logs?></a> 
		   <a class="border market_bottom_2 hvr-pulse" href="?p=logs&logs=resetchar"><?php print phrase_resetchar_logs?></a> 
			 <a class="border market_bottom_2 hvr-pulse" href="?p=logs&logs=logins"><?php print phrase_login_logs?></a> 
			   <a class="border market_bottom_2 hvr-pulse" href="?p=logs&logs=chdetails"><?php print phrase_ch_det_logs?></a> 
</div>
<script type="text/javascript" src="../js/easyTooltip.js"></script>
<script type="text/javascript" src="../js/ajax.js"></script>	

<script>
function clean(el){
	var textfield = document.getElementById(el);
	var regex = /[^a-z 0-9?!.,]/gi;
	if(textfield.value.search(regex) > -1) {
		textfield.value = textfield.value.replace(regex, "");
        }
}
</script>

<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$q_change = "";
$q_change1 ='';
$continue = 0;
if(isset($_GET['logs'])){
	  $logs = trim(clean_post($_GET['logs']));
	  switch($logs){
		  case 'bank': include($_SERVER['DOCUMENT_ROOT']."/mod/admin/log_modules/bank_log.php"); break;
		  case 'auction': include($_SERVER['DOCUMENT_ROOT']."/mod/admin/log_modules/auction_log.php"); break;
		  case 'jewels': include($_SERVER['DOCUMENT_ROOT']."/mod/admin/log_modules/jewels_log.php"); break;
		  case 'addstats': include($_SERVER['DOCUMENT_ROOT']."/mod/admin/log_modules/addstats_log.php");break;
		  case 'resetstats': include($_SERVER['DOCUMENT_ROOT']."/mod/admin/log_modules/resetstats_log.php"); break;
		  case 'resetchar': include($_SERVER['DOCUMENT_ROOT']."/mod/admin/log_modules/resetchar_log.php"); break;
          case 'logins': include($_SERVER['DOCUMENT_ROOT']."/mod/admin/log_modules/logins_log.php"); break;	
          case 'chdetails': include($_SERVER['DOCUMENT_ROOT']."/mod/admin/log_modules/ch_det.log.php"); break;			  
		  default: $continue = 1; break;
	  }
 }
if($continue === 1){
    $lines = 20;
    if(!isset($_GET['page'])){$limit='0';$page = '1';}
    else{$page = (int)($_GET['page']);$pages = $page - 1;$limit = $lines * $pages;}  
    if($limit<0){$limit = 0;}
	
	if(isset($_GET['account'])){

		$account = trim(clean_post($_GET['account']  ));
			if(isset($_GET['buyer'])){
				$buyer   = trim(clean_post($_GET['buyer']    ));
			}
						if(isset($_GET['seller'])){
				$seller   = trim(clean_post($_GET['seller']    ));
			}
						if(isset($_GET['sellerip'])){
				$sellerip   = trim(clean_post($_GET['sellerip']    ));
			}
						if(isset($_GET['buyerip'])){
				$buyerip   = trim(clean_post($_GET['buyerip']    ));
			}
						if(isset($_GET['inventory'])){
				$invent   = trim(clean_post($_GET['inventory']    ));
			}


		switch($account){
		    case "inventory": $_SESSION['admin_user'] = $_SESSION['dt_username'];$_SESSION['admin_ip'] = ip();$_SESSION['dt_username'] = $invent;header("Location:?p=market&select=warehouse");break;
			case "buyer": $q_change = " where purchased_by='".$buyer."'";$q_change1 = " and purchased_by='".$buyer."'";break;
			case "seller": $q_change = " where seller='".$seller."'";$q_change1 = " and seller='".$seller."'";break;
			case "sellerip": $q_change = " where seller_ip='".$sellerip."'";$q_change1 = " and seller_ip='".$sellerip."'";break;
			case "buyerip": $q_change = " where buyer_ip='".$buyip."'";$q_change1 = " and buyer_ip='".$buyip."'";break;
		    default: $q_change='';$q_change1='';
		}
	}
$list_query = "SELECT TOP {$lines} * FROM [Market] where id Not in (Select TOP {$limit} [id] FROM [Market] ".$q_change." order by [start_date] desc) ".$q_change1." order by [start_date] desc";
$all_market = mssql_num_rows( mssql_query("SELECT * FROM [Market] ".$q_change.""));
$sql        = mssql_query($list_query);
$total      = ceil($all_market/$lines);
$show_acc   = array();
$show_char  = array();

serial_search("?p=logs&logs");

pagi_style("logs&logs=market",$total,$lines);    
   echo"<table class='afix'style='font-size:8pt;text-align:center' width='100%'>
            <tr class='title'>
				<td>ID</td>
		        <td>".phrase_item."</td>
				<td>".phrase_serial."</td>
				<td>".phrase_seller."</td>				
                <td style='width:20px;'>".phrase_added."</td>
				<td>".phrase_prices."</td>				
                <td>".phrase_sold."</td>
                <td>".phrase_sold_date."</td>
            </tr>";
			
	for($i=1; $i < mssql_num_rows($sql); $i++){
		$row = mssql_fetch_array($sql);
        $item = ItemInfoUser($row['item']);	
        $price = array("Rena" => $row['rena'],"Zen" => $row['zen'],"Credits"=>$row['credit'],"Stone"=>$row['stone'],"Chaos"=>$row['chaos'],"Bless"=>$row['bless'],"Life"=>$row['life'],"Creation"=>$row['creation']); 
        $filter_prices = array_filter($price);
	    if($row['purchased_by'] === NULL){
			$sold = "<font color='#ff794c'>".phrase_not_sold."</font>";
			$sold_date = "<font color='#ff794c'>".phrase_not_sold."</font>";
		}
		else{
			$sold = "<a href='?p=logs&logs=market&account=buyer&buyer=".($row['purchased_by'])."'>
			<font color='#73ff73'>".$row['purchased_by']."</font></a></br>
			<a href='?p=logs&logs=market&account=buyerip&buyerip=".$row['buyer_ip']."'>".$row['buyer_ip']."</a>";
		    $sold_date = server_time($row['sold_date']);
		}
		$bgcolor = "style='border:1px solid #000000' bgcolor='#26130b'";
		if($i %2){
			$bgcolor = "bgcolor='#341407'";
		}		
		echo "		      
     		<tr ".$bgcolor.">
		        <td>".$row['id']."</td>
				<td><img src=\"" . $item['thumb'] . "\" class=\"someClass\" title=\"<div align=center style=\'padding-left: 6px; padding-right:6px;font-family:arial;font-size: 10px;\'><span style=\'font-weight:bold;font-size: 11px; color:#FFFFFF;\'>  </span> <br />" . $item['overlib'] . "   </font>    </span></div>\" alt=\"" . $item['name'] . "\" border=\"1\" /></td>
				<td><a href='?p=logs&logs=market&serial=".substr($row['item'],6,8)."'>".substr($row['item'],6,8)."</a></td>
				<td><a href='?p=logs&logs=market&account=seller&seller=".$row['seller']."'>".$row['seller']."</a></br><a href='?p=logs&logs=market&account=sellerip&sellerip=".$row['seller_ip']."'>".$row['seller_ip']."</a></td>
                <td style='width:60px;'>".server_time($row['start_date'])."</td>
				<td>";
			  foreach($filter_prices as $res => $amount){
               echo $amount . "\n" .$res."</br>";		
		          }	
		echo "</td>				
                <td style='width:40px;'>".$sold."</td>
				<td style='width:60px;'>".$sold_date."</td>
            </tr>
		";	
	}
	echo"</table>";
	pagi_style("logs&logs=market",$total,$lines); 
 }
}
?>