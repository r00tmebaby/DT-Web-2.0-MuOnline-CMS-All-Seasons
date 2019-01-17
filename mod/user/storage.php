<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	

<?php
include("configs/config.php");
$user = $_SESSION['dt_username'];
$opt_levels = '';$cols1 =  "";$type='';$cols4 =  "";$cols2 =  "";$cols3 =  "";$cols5 =  "";$cols6 =  "";$cols7 =  "";$cols8 =  "";$cols10 = "";$cols11 = "";$cols12 = "";$cols13 = "";$cols15 = "";$cols9 = "";$cols16 = "";

if(isset($_GET['type'])){
$types = (string) trim(strip_tags($_GET['type']));
switch($types){

	           case "Swords":   $pagi = 0;$type="and [item_type]=0";    $cols1 =  "style='color:#fff'"; break;
	           case "Axes":     $pagi = 1;$type="and [item_type]=1";    $cols2 =  "style='color:#fff'"; break;
	           case "Maces":    $pagi = 2;$type="and [item_type]=2";    $cols3 =  "style='color:#fff'"; break;
	           case "Spears":   $pagi = 3;$type="and [item_type]=3";    $cols4 =  "style='color:#fff'"; break;
	           case "Bows":     $pagi = 4;$type="and [item_type]=4";    $cols5 =  "style='color:#fff'"; break;
	           case "Staffs":   $pagi = 5;$type="and [item_type]=5";    $cols6 =  "style='color:#fff'"; break;
	           case "Helmets":  $pagi = 7;$type="and [item_type]=7";    $cols7 =  "style='color:#fff'"; break;
	           case "Armors":   $pagi = 8;$type="and [item_type]=8";    $cols8 =  "style='color:#fff'"; break;
	           case "Gloves":   $pagi = 10;$type="and [item_type]=10";  $cols9 =  "style='color:#fff'"; break;
	           case "Pants":    $pagi = 9;$type="and [item_type]=9";    $cols10 = "style='color:#fff'"; break;
	           case "Boots":    $pagi = 11;$type="and [item_type]=11";  $cols11 = "style='color:#fff'"; break;
	           case "Shields":  $pagi = 6;$type="and [item_type]=6";    $cols12 = "style='color:#fff'"; break;
	           case "Jewelery": $pagi = 14;$type="and [item_type]='14'";$cols13 = "style='color:#fff'"; break;  
	           case "Wings":    $pagi = 12;$type="and [item_type]=12";  $cols15 = "style='color:#fff'"; break;
               case "All":      $pagi = 20;$type='';                    $cols16 = "style='color:#fff'"; break;	
               default:	      $pagi = 20;$type='';                      $cols16 = "style='color:#fff'"; break;	
       }
}
else{
	$type='';
}			 
if(!isset($_GET['page'])){$limit='0';$page = '1';}
else{$page = (int)($_GET['page']);$pages = $page - 1;$limit = $option['storage_pagi'] * $pages;}  
if($limit<0){$limit = 0;}

$list_query = "SELECT TOP {$option['storage_pagi']} * FROM [DTweb_Storage] where [ID] Not in (Select TOP {$limit} [ID] FROM [DTweb_Storage] where [end_date]=0 and [seller]='{$user}' ".$type." order by [start_date] desc) and [end_date]='0' and [seller]='{$user}' ".$type." order by [start_date] desc";
$items_in_market        = mssql_num_rows(mssql_query("SELECT * FROM [DTweb_Storage] where [end_date]=0 and [seller]='{$user}'"));

  
$sql    = mssql_query($list_query);
$total  = ceil($items_in_market/$option['storage_pagi']);




if(isset($_POST['item_id']) && isset($_POST['buy_item'])){ 
$item_id = clean_post($_POST['item_id']);
    if(is_numeric($item_id)){ 

        storage_out($item_id,$user);
    }
     else { 
	    $message[] = phrase_market_invalid_item;
   }
}


 $message[] = "
 <table width='100%' class='title'>
            <tr> <td>Personal Web Storage </td></tr>
           
            <td colspan='2' align='center'>
                ".phrase_there_are.$items_in_market. "  &nbsp".phrase_items_in_storage ."  <br /> </td>
        </tr>
  
    <table width='100%' align='center' border='1' cellpadding='3' cellspacing='2' >
        <tr  align='center'> 
            <td align='center'>".phrase_number."</td>
            <td>".phrase_information."</td>
            <td>".phrase_item."</td>
        </tr>";
  $message[] = '
     <center>
	 <div class="market_top">
	  <div class="afix"  style="margin:5px 5px;">
		<a '.$cols16.' href="index.php?p=storage&type=All">All Items</a> | 
		<a '.$cols1.' href="index.php?p=storage&type=Swords">Swords</a> |
		<a '.$cols2.' href="index.php?p=storage&type=Axes">Axes</a> |
		<a '.$cols3.' href="index.php?p=storage&type=Maces">Maces</a> |
		<a '.$cols4.' href="index.php?p=storage&type=Spears">Spears</a> |
		<a '.$cols5.' href="index.php?p=storage&type=Bows">Bows/X-Bows</a> |
		<a '.$cols6.' href="index.php?p=storage&type=Staffs">Staffs</a> |
		<a '.$cols7.' href="index.php?p=storage&type=Helmets">Helmets</a>  |
		<a '.$cols8.' href="index.php?p=storage&type=Armors">Armors</a> | 
		<a '.$cols9.' href="index.php?p=storage&type=Gloves">Gloves</a>  |
		<a '.$cols10.' href="index.php?p=storage&type=Pants">Pants</a>  |
		<a '.$cols11.' href="index.php?p=storage&type=Boots">Boots</a> |
		<a '.$cols12.' href="index.php?p=storage&type=Shields">Shields</a>  
		<a '.$cols13.' href="index.php?p=storage&type=Jewelery">Jewelery/Jewels</a>  |
		<a '.$cols15.' href="index.php?p=storage&type=Wings">Wings/Cape</a> 
	 </div> ';

for ($i = 1; $i < mssql_num_rows($sql)+1; $i++) {

        $rank = $i+$limit;
		$MarketItem = mssql_fetch_array($sql);
        $MarketItemInfo = ItemInfoUser($MarketItem['item']);

		if($user != $MarketItem['seller']){
			$button  = phrase_contact_administrator;
		}
		else{
			$button  = phrase_back_to_warehouse;
		}
		
        if ($MarketItemInfo['level']) {
            $MarketItemInfo['level'] = " +" . $MarketItemInfo['level'];
        }

        if (preg_match("/Absolute/", $MarketItemInfo['name'])) {
            $MarketItemInfo['color'] = "#ff00ff";
        }

        if ($rank % 2) {
            $bgcolor = "rgba(0,0,0,0.4)";
        } else {
            $bgcolor = "rgba(0,0,0,0.6)";
        }					

$message[] = "

   <tr style='background-color : ".$bgcolor."'>
   <td >".$rank."</td>
             <td align=\"center\" width=\"20\">
          <br /><img width= \" 40px\" src=\"" . $MarketItemInfo['thumb'] . "\" class=\"someClass\" title=\"<div align=center style=\'padding-left: 6px; padding-right:6px;font-family:arial;font-size: 10px;\'><span style=\'font-weight:bold;font-size: 11px; color:#FFFFFF;\'></span> <br />" . $MarketItemInfo['overlib'] . "   </font>    </span></div>\" alt=\"" . $MarketItemInfo['name'] . "\" border=\"1\" />
      <form method='post'>
        <input name='item_id' value='" . $MarketItem['id'] . "' type='hidden'/>
        <input  name='buy_item' class='button' value='".$button."' type='submit'/></td>
      </form>
          </td>
		  <td>
		  ".phrase_added_on." <b>" . date("d/m/Y g:i a", $MarketItem['start_date']) . "</b><br />
		  ".phrase_from." IP: ".$MarketItem['seller_ip']."
		  </td>

       
         </td>
  </tr>";

 }

    foreach($message as $show){
	   echo $show;
   }

echo "</table>";
 
pagi_style("storage",$total,$option['storage_pagi']);
?>
