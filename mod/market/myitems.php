<!-- 
//////////////////////////////////////////////////////
             Market System by r00tme
               date 15/12/2015 
This Market has been made for a friend as a gift but 
I decided to share it to all DarksTeam members !
//////////////////////////////////////////////////////
 -->
<?php

$search      = search_items();
$settings    = mssql_fetch_array(mssql_query("Select * from [Market_Settings]"));
item_expired();

echo $search[1] . "</br>";

if(isset($_SESSION['dt_username'])){
if(!isset($_GET['page'])){$limit='0';$page = '1';}
else{$page = (int)($_GET['page']);$pages = $page - 1;$limit = $settings['pagination'] * $pages;}  
if($limit<0){$limit = 0;}

$list_query = "SELECT TOP ".$settings['pagination']." * FROM [DTweb_Market] where id Not in (Select TOP {$limit} id FROM [DTweb_Market] where [is_sold] = '0' and [seller]='".$user."' order by start_date desc) and [seller]='".$user."' and [is_sold]='0' order by start_date desc";
$sql = mssql_query("SELECT count(*) FROM [DTweb_Market] where [is_sold] = '0' and [seller]='".$user."'");
$items_in_market = mssql_result($sql, 0, 0);
        
$sql         = mssql_query($list_query);
$total = $items_in_market/$settings['pagination'];

if(isset($_POST['gogo']) && isset($_POST['rockendroll'])&& isset($_POST['buy_item'])){ 
       $decrypt = decrypt($_POST['gogo'],$_POST['rockendroll']);
	   if($decrypt != false){ 
        market_buy((int)clean_post($decrypt),$user);
        }
       else { 
	    $error = true;
	    $message[] = phrase_market_invalid_item;
      }
   }

 $message[] = "    
       ".pagi_style("market&select=myitems",$total,$settings['pagination'])." 

    <table border='1' class=' items_row table'>
	<tr class='market_bottom_2 border'><td colspan='4'> ".phrase_there_are.$items_in_market. phrase_items_in_market ."</td></tr>
        <tr class='market_bottom_2'>
            <td style='text-align:center;'>#</td>		
            <td style='text-align:center;'>".phrase_information."</td>
            <td style='text-align:center;'>".phrase_item."</td>
            <td>".phrase_price."</td>
        </tr>";
  
for ($i = 0; $i < mssql_num_rows($sql); $i++) {
        $i2++;
        $rank = $i2;
		$MarketItem = mssql_fetch_array($sql);
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

        if ($time_after_start_date < 43200) {
            $new_gif_value = phrase_new;
			$m=1;
        } else {
            $new_gif_value = phrase_old;
			$m=0;
        }

        if (preg_match("/Absolute/", $MarketItemInfo['name'])) {
            $MarketItemInfo['color'] = "#ff00ff";
        }

        if ($m == 0) {
            $bgcolor = "rgba(17,17,17,0.6) ";
        } else {
            $bgcolor = "rgba(19,19,4,0.6) ";
        }				

        if($MarketItem['end_date'] > 0){
			$td = phrase_item_will_expire_on . server_time($MarketItem['end_date']);
		}
$chk_prices    = mssql_fetch_array(mssql_query("Select * from DTweb_Market where id = '".$MarketItem['id']."' and is_sold='0'")); 
$prices        = array(" Zen " => $chk_prices['zen']," Bless " => $chk_prices['bless'],"Soul " => $chk_prices['soul'], "Credits " => $chk_prices['credit']," Chaos " => $chk_prices['chaos']," Creation " => $chk_prices['creation']," Rena " => $chk_prices['rena']," Stone " => $chk_prices['stone']," Life " => $chk_prices['life']);
$filter_prices = array_filter($prices);
$ecrypt = encrypt($MarketItem['id']);
$message[] = "
        <tr style='border:3px solid rgba(64,16,0,0.8);padding:20px 20px;background-color : ".$bgcolor."'> 
          <td align='center' width=\"50\">".$new_gif_value."</td>
          <td width=\"270\"> 
		  ".phrase_sales_announced_by." <b>" . $get_seller_char_name[0] . "</b><br />
		  ".phrase_added_on." <b>" . server_time($MarketItem['start_date']) . "</b><br />
		  ".$td."
		  </td>
          <td align=\"center\" width=\"180\">
          <br /><img src=\"" . $MarketItemInfo['thumb'] . "\" class=\"someClass\" title=\"<div align=center style=\'padding-left: 6px; padding-right:6px;font-family:arial;font-size: 10px;\'><span style=\'font-weight:bold;font-size: 11px; color:#FFFFFF;\'>  </span> <br />" . $MarketItemInfo['overlib'] . "   </font>    </span></div>\" alt=\"\" border=\"1\" />
      <form  name='".form_enc()."' class='market_button' method='post'>
        <input name='gogo' value='" . $ecrypt[0] . "' type='hidden'/>
		<input name='rockendroll' value='" . $ecrypt[1] . "' type='hidden'/>
        <input  name='buy_item' value='".$button."' type='submit'/></td>
      </form>
          <td>
         ";
		 	foreach($filter_prices as $resource => $prices){
		           $message[] = "<div style='color:#ffb973;'>".$prices ."</div>". $resource . " ";
	              }	 
		 echo "
         </td>
  </tr>";

 }
    foreach($message as $show){
	   echo $show;
   }

echo "</table>";
 }
else{
	echo "<div class='error'>".phrase_login_first."</div>";
}

?>
<!-- 
//////////////////////////////////////////////////////
             Market System by r00tme
               date 15/12/2015 
This Market has been made for a friend as a gift but 
I decided to share it to all DarksTeam members !
//////////////////////////////////////////////////////
 -->