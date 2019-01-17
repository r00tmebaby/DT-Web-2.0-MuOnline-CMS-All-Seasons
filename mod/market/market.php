<!-- 
//////////////////////////////////////////////////////
////////    Market System by r00tme       ////////////
///////        date 15/12/2015            ////////////
//////////////////////////////////////////////////////			   
This Market has been made for a friend as a gift but 
I have decided to share it to all DarksTeam members !
DarksTeam Edition includes:
* Encrypting hidden form fields - Item Serial/ID/Type (with unique key choosen by you)
* Banned Items Option (Via Admin Panel)
* Bought/Sold Items History
* Smart Pagination with good styling
* Item Search by categories,luck,skill, level and two speciffic excellent options
* Proper Warehouse rendering
* Works with all stones from (97D)
* Resets,Levels, SMS, Jewels price for using (Setting it up in the admin panel)
* SQL Injection Filter with CRFS token(HackBar, TamperData and etc..)
* Pick Up Item Manualy when the time has expired (The Market doesn't delete the item as in the original DT Market when the time left)
//////////////////////////////////////////////////////
 -->
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	


<?php

$settings    = mssql_fetch_array(mssql_query("Select * from [DTweb_Market_Settings]")); 
$lines       = $settings['pagination'];
$message     = array();
$search      = search_items();
item_expired();
$continue    = 1;
$selsa       = "";
$td          = "";
if(isset($_GET['hop'])){
	  $selects = trim(strip($_GET['hop']));
	  switch($selects){
		  case 'marketw': include("merchant.php"); $continue = 0;break;
		  case 'marketm': include("myitems.php"); $continue = 0;break;
		  case 'markets': include("solditems.php"); $continue = 0;break;
		  case 'marketb': include("boughtitems.php"); $continue = 0;break;
		  default: $continue = 1; break;
	  }
 }
if(isset($_GET['seller'])){
	$seelrs = clean_post(trim($_GET['seller']));
	$check_exist  = mssql_query("Select * from Character where Name = '".$seelrs."'");
	if(mssql_num_rows($check_exist) != 0){
    $selsa = "and [Seller]='{$seelrs}'";
   }
   else{
	$selsa = '';  
   }
}
if(($continue === 1) || !isset($_GET['hop'])){ 
if(!isset($_GET['page'])){$limit='0';$page = '1';}
else{$page = (int)($_GET['page']);$pages = $page - 1;$limit = $lines * $pages;}  
if($limit<0){$limit = 0;}

$list_query = "SELECT TOP {$lines} * FROM [DTweb_Market] where id Not in (Select TOP {$limit} [id] FROM [DTweb_Market] where [is_sold]='0' ".$selsa.$search[0]." order by [start_date] desc) and [is_sold]='0' ".$selsa.$search[0]." order by [start_date] desc";

$all_market = mssql_num_rows(mssql_query("SELECT * FROM [DTweb_Market] where [is_sold]='0' ".$selsa.$search[0].""));

if($all_market == true){    
$sql    = mssql_query($list_query);
$total  = ceil($all_market/$lines);
echo $search[1];		   
if(isset($_POST['gogo']) && isset($_POST['buy_item'])){ 
       $decrypt = decrypt($_POST['gogo']);
	   if($decrypt != false){ 
        market_buy((int)clean_post($decrypt),logged());
        }
       else { 
	    $message[] = phrase_market_invalid_item;
      }
   }	
if(isset($_GET['type'])){
	if(is_numeric($search[2])){
	$types       = (string) trim(strip_tags($_GET['type']));
	$pagi  = pagi_style("market&type=".$types,$total,$settings['pagination']);
	}
	else{
	$pagi  = pagi_style("market",$total,$settings['pagination']);	
	}
}
else{
	$pagi  = pagi_style("market",$total,$settings['pagination']);
}	
 $message[] = "    
       ".$pagi." 

    <table class=' items_row table'>
	    <tr class='market_bottom_2 border'><td colspan='3'> ".phrase_there_are.$all_market. phrase_items_in_market ."</td></tr>
        <tr class='market_bottom_2'> 
            <td style='text-align:center;'>".phrase_information."</td>
            <td style='text-align:center;'>".phrase_item."</td>
            <td>".phrase_price."</td>
        </tr>"; 
for ($i = 0; $i < mssql_num_rows($sql); $i++) {
		$MarketItem   = mssql_fetch_array($sql);
        $MarketItemInfo = ItemInfoUser($MarketItem['item']);
        $get_seller_char_name = mssql_fetch_array(mssql_query("SELECT Name FROM [Character] where AccountID = '" . $MarketItem['seller'] . "' order by Resets desc"));
        $ecrypt = encrypt($MarketItem['id']);
		if(logged() != $MarketItem['seller']){
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
		
		if(logged()){
		  $buy_form  = "      
	        <form  name='".form_enc()."' class='market_button' method='post'>
              <input name='gogo' value='" . $ecrypt. "' type='hidden'/>
              <input name='buy_item' value='".$button."' type='submit'/></td>
            </form>"; 
	     }
		 else{
			$buy_form =''; 
		 }
	 if($MarketItem['end_date'] > 0){
		  $td = phrase_item_will_expire_on . server_time($MarketItem['end_date']);
		}	
    $chk_prices    = mssql_fetch_array(mssql_query("Select * from DTweb_Market where id = '".$MarketItem['id']."' and is_sold='0'")); 
    $prices        = array(" Zen " => $chk_prices['zen']," Bless " => $chk_prices['bless']," Credits " => $chk_prices['credit']," Chaos " => $chk_prices['chaos']," Creation " => $chk_prices['creation']," Rena " => $chk_prices['rena']," Stone " => $chk_prices['stone']," Life " => $chk_prices['life']," Soul " => $chk_prices['soul']);
    $filter_prices = array_filter($prices);
	$message[]     = "
      <tr class='market' style='background-color : ".$bgcolor."'>      
          <td style='text-align:left' width=\"270\"> ".phrase_sales_announced_by." <b>" . $get_seller_char_name['Name'] . "</b><br />".phrase_added_on." <b></br>" . server_time($MarketItem['start_date']) . "</b></br>".$td."</td>
          <td align=\"center\" width=\"180\">
          <br /><img src=\"" . $MarketItemInfo['thumb'] . "\" class=\"someClass\" title=\"<div align=center style=\'padding-left: 6px; padding-right:6px;font-family:arial;font-size: 10px;\'><span style=\'font-weight:bold;font-size: 11px; color:#FFFFFF;\'> </span> <br />" . $MarketItemInfo['overlib'] . "   </font>    </span></div>\" alt=\"\" border=\"1\" />
           ".$buy_form."
        <td>";
	          foreach($filter_prices as $resource => $prices){
		           $message[] = number_format($prices) . $resource . "</br>";
	              }
                $message[] = "</td></tr>";  
              }
       foreach($message as $show){
	     echo $show;
      }
    echo "</table>";
  }
  else{
	  echo "There are no items in the market";
  }
}	
	
?>     

<!-- 
//////////////////////////////////////////////////////
             Market System by r00tme
               date 15/12/2015 
This Market has been made for a friend as a gift but 
I have decided to share it to DarksTeam members !
//////////////////////////////////////////////////////
 -->  
  