<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	

	<script type="text/javascript">
		$(document).ready(function(){	
			$("[title]").easyTooltip();
		});
	</script>
<?php

if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$settings    = mssql_fetch_array(mssql_query("Select * from [DTweb_Market_Settings]"));

$user        = ($_SESSION['dt_username']);  
$item_id     = (int)clean_post($_POST['item_id']);
$lines       = $settings['pagination'];
$message     = array();
$search      = search_items();
item_expired();

if(!isset($_GET['page'])){$limit='0';$page = '1';}
   else{$page = (int)($_GET['page']);$pages = $page - 1;$limit = $lines * $pages;}  
   if($limit<0){$limit = 0;}

$list_query = "SELECT TOP {$lines} * FROM [DTweb_Market] where id Not in (Select TOP {$limit} [id] FROM [DTweb_Market] where [is_sold]='0' ".$search[0]." order by [start_date] desc) and [is_sold]='0' ".$search[0]." order by [start_date] desc";
$sql        = mssql_query("SELECT count(*) FROM [DTweb_Market] where [is_sold]='0' ".$search[0]."");
$all_market = mssql_result($sql, 0, 0);
  
if($sql == true){    
$sql    = mssql_query($list_query);
$total  = ceil($all_market/$lines);
		   
echo $search[1];


if(isset($item_id) && isset($_POST['buy_item'])){ 
    if($item_id != 0 && $item_id != NULL){ 
        market_buy($item_id,$user);
    }
     else { 
	    $message[] = phrase_market_invalid_item;
   }
}	
	
 $message[] = "    
       ".pagi_style("market",$total,$lines)." 

    <table class=' items_row table'>
	<tr class='market_bottom_2 border'><td colspan='3'> ".phrase_there_are.$all_market. phrase_items_in_market ."</td></tr>
        <tr class='market_bottom_2'> 
            <td style='text-align:center;'>".phrase_information."</td>
            <td style='text-align:center;'>".phrase_item."</td>
            <td>".phrase_price."</td>
        </tr>";
  
for ($i = 1; $i < mssql_num_rows($sql); $i++) {
		$MarketItem   = mssql_fetch_array($sql);
        $MarketItemInfo = ItemInfoUser($MarketItem['item']);
        $get_seller_char_name = mssql_fetch_array(mssql_query("SELECT Name FROM [Character] where AccountID = '" . $MarketItem['seller'] . "' order by Resets desc"));
      
		if($user != $MarketItem['seller']){
			$button  = phrase_buy_now;
		}
		else{
			$button  = phrase_back_to_warehouse;
		}
		
        if ($MarketItemInfo['level']) {
            $MarketItemInfo['level'] = " +" . $MarketItemInfo['level'];
        }
        else
            $time_after_start_date = time() - $MarketItem['start_date'];

        if (preg_match("/Absolute/", $MarketItemInfo['name'])) {
            $MarketItemInfo['color'] = "#ff00ff";
        }
        if ($i % 2) {
            $bgcolor = "rgba(14,12,12,0.50) ";
        } else {
            $bgcolor = "rgba(14,12,12,0.60) ";
        }
    $chk_prices    = mssql_fetch_array(mssql_query("Select * from DTweb_Market where id = '".$MarketItem['id']."' and is_sold='0'")); 
    $prices        = array(" Zen " => $chk_prices['zen']," Bless " => $chk_prices['bless']," Credits " => $chk_prices['credit']," Chaos " => $chk_prices['chaos']," Creation " => $chk_prices['creation']," Rena " => $chk_prices['rena']," Stone " => $chk_prices['stone']," Life " => $chk_prices['life']);
    $filter_prices = array_filter($prices);
	$message[]     = "
      <tr style='border:3px solid #2f130a;padding:20px 20px;background-color : ".$bgcolor."'>      
          <td width=\"270\"> ".phrase_sales_announced_by." <b>" . $get_seller_char_name['Name'] . "</b><br />".phrase_added_on." <b>" . date("d/m/Y g:i a", $MarketItem['start_date']) . "</b></td>
          <td align=\"center\" width=\"180\">
          <br /><img src=\"" . $MarketItemInfo['thumb'] . "\" class=\"someClass\" title=\"<div align=center style=\'padding-left: 6px; padding-right:6px;font-family:arial;font-size: 10px;\'><span style=\'font-weight:bold;font-size: 11px; color:#FFFFFF;\'>  </span> <br />" . $MarketItemInfo['overlib'] . "   </font>    </span></div>\" alt=\"" . $MarketItemInfo['name'] . "\" border=\"1\" />    
        <td>";
	          foreach($filter_prices as $resource => $prices){
		           $message[] = $prices . $resource . "</br>";
	              }
                $message[] = "</td></tr>";  
              }
       foreach($message as $show){
	     echo $show;
      }
    echo "</table>";
  }
}
?>     

  
  