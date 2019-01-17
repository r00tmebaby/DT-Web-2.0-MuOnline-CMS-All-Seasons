<?php 
////////////////////////////////////////////////////////////////
// Buy Jewels   ///originaly created and released - 21/08/2015//
// by r00tme    // ported and built into DT Web - 31/08/2016////
////////////////////////////////////////////////////////////////
$message = array();
$success = 0;
include("configs/config.php");
$get_config      = simplexml_load_file('./configs/mod_settings/buy_jewels.xml');
$active          = $get_config -> active;
$select_version  = $get_config -> select_version;
$discount        = $get_config -> discount;
$discount_mid    = $get_config -> discount_mid;
$discount_max    = $get_config -> discount_max;
$creation_price  = $get_config -> creation_price;
$soul_price      = $get_config -> soul_price;
$bless_price     = $get_config -> bless_price;
$life_price      = $get_config -> life_price;
$stone_price     = $get_config -> stone_price;
$rena_price      = $get_config -> rena_price;
$guardian_price  = $get_config -> guardian_price;
$bm1             = $get_config -> bm1;
$bm2             = $get_config -> bm2;
$bm3             = $get_config -> bm3;
$sm1             = $get_config -> sm1;
$sm2             = $get_config -> sm2;
$sm3             = $get_config -> sm3;
////////////////////////////////////////////////////////////////////////	
            


if ($active == 1){
	
  $current_credits = mssql_fetch_array(mssql_query("Select ".$option['cr_db_column']." from ".$option['cr_db_table']." where  ".$option['cr_db_check_by']." = '".$_SESSION['dt_username']."'"));
if(isset($_POST['jewels'])){
  $post_jewels = protect($_POST['jewels']);

  // Jewel Of Bless Price
	if (($post_jewels) == 'b1'){
		$price = $bless_price;
		$item = "1 x Jewel of Bless";
		$column = '[bless]';
		$count  = 1;
	}
		if (($post_jewels) == 'b10'){
		$price = ceil(((10*($bless_price))*$discount/100));
		$item = "10 x Jewel of Blesses";
		$column = '[bless]';
		$count  = 10;
	}
		if (($post_jewels) == 'b20'){
		$price = ceil((20*($bless_price)*$discount_mid/100));
		$item = "20 x Jewel of Blesses";
		$column = '[bless]';
		$count  = 20;
	}
		if (($post_jewels) == 'b30'){
		$price = ceil((30*($bless_price)*$discount_max/100));
		$item = "30 x Jewel of Blesses";
		$column = '[bless]';
		$count  = 30;
	}
  // Jewel Of Soul Price
		if (($post_jewels) == 's1'){
		$price = $soul_price;
		$item = "1 x Jewel of Soul";
		$column = '[soul]' ;
		$count  = 1;
	}
		if (($post_jewels) == 's10'){
		$price = ceil((10*($soul_price)*$discount/100));
		$item = "10 x Jewel of Souls";
		$column = '[soul]' ;
		$count  = 10;
	}
		if (($post_jewels) == 's20'){
		$price = ceil((20*($soul_price)*$discount_mid/100));
		$item = "20 x Jewel of Souls";
		$column = '[soul]' ;
		$count  = 20;
	}
		if (($post_jewels) == 's30'){
		$price = ceil((30*($soul_price)*$discount_max/100));
		$item = "30 x Jewel of Souls";
		$column = '[soul]' ;
		$count  = 30;
	}
   // Jewel Of Guardian Price
		if (($post_jewels) == 'g1'){
		$price = $guardian_price;
		$item = "1 x Jewel of Guardians";
		$column = '[guardian]';
		$count  = 1;
		
	}
		if (($post_jewels) == 'g10'){
		$price = ceil((10*($guardian_price)*$discount/100));
		$item = "10 x Jewel of Guardian";
		$column = '[guardian]';
		$count  = 10;
	}
		if (($post_jewels) == 'g20'){
		$price = ceil((20*($guardian_price)*$discount_mid/100));
		$item = "20 x Jewel of Guardians";
		$column = '[guardian]';
		$count  = 20;
	}
		if (($post_jewels) == 'g30'){
		$price = ceil((30*($guardian_price)*$discount_max/100));
		$item = "30 x Jewel of Guardians";
		$column = '[guardian]';
		$count  = 30;
	}
	// Jewel Of Creation Price
		if (($post_jewels) == 'c1'){
		$price = $creation_price;
		$item = "1 x Jewel of Creation";
		$column = '[creation]';
		$count  = 1;
	}
		if (($post_jewels) == 'c10'){
		$price = ceil((10*($creation_price)*$discount/100));
		$item = "10 x Jewel of Creations";
		$column = '[creation]';
		$count  = 10;
	}
		if (($post_jewels) == 'c20'){
		$price = ceil((20*($creation_price)*$discount_mid/100));
		$item = "20 x Jewel of Creations";
		$column = '[creation]';
		$count  = 20;
	}
		if (($post_jewels) == 'c30'){
		$price = ceil((30*($creation_price)*$discount_max/100));
		$item = "30 x Jewel of Creations";
		$column = '[creation]';
		$count  = 30;
	}
	// Jewel Of Life Price
		if (($post_jewels) == 'l1'){
		$price = $life_price;
		$item = "1 x Jewel of Life";
		$column = 'life'  ;
		$count  = 1;
	}
		if (($post_jewels) == 'l10'){
			echo $price;
		$price = ceil((10*($life_price)*$discount/100));
		$item = "10 x Jewel of Lifes";
		$column = 'life';
		$count  = 10;
	}
		if (($post_jewels) == 'l20'){
		$price = ceil((20*($life_price)*$discount_mid/100));
		$item = "20 x Jewel of Lifes";
		$column = 'life'  ;
		$count  = 20;
	}
		if (($post_jewels) == 'l30'){
		$price = ceil((30*($life_price)*$discount_max/100));
		$item = "30 x Jewel of Lifes";
		$column = 'life'  ;
		$count  = 30;
	}
	// Jewel Of Soul Mix Price
			if (($post_jewels) == 'sm10'){
		$price = ceil((($sm1)*$discount/100));
		$item = "10 x Soul Mixes";
		$column = '[soulmix1]';
		$count  = 1;
	}
		if (($post_jewels) == 'sm20'){
		$price = ceil((($sm2)*$discount_mid/100));
		$item = "20 x Soul Mixes";
		$column = '[soulmix2]';
		$count  = 1;
	}
		if (($post_jewels) == 'sm30'){
		$price = ceil((($sm3)*$discount_max/100));
		$item = "30 x Soul Mixes";
		$column = '[soulmix3]';
		$count  = 1;
	}
	// Jewel Of Bless Mix Price
		if (($post_jewels) == 'bm10'){
		$price = ceil((($bm1)*$discount/100));
		$item = "10 x Bless Mixes";
		$column = '[blessmix1]';
		$count  = 1;
	}
	    if (($post_jewels) == 'bm20'){
		$price = ceil((($bm2)*$discount_mid/100));
		$item = "20 x Bless Mixes";
		$column = '[blessmix2]'; 
		$count  = 1;
	}
		if (($post_jewels) == 'bm30'){
		$price = ceil((($bm3)*$discount_max/100));
		$item = "30 x Bless Mixes";
		$column = '[blessmix3]';
		$count  = 1;
	}
	// Stone Price
		if (($post_jewels) == 'sto1'){
		$price = $stone_price;
		$item = "1 x Stone";
		$column = '[stone]';
		$count  = 1;
	}
		if (($post_jewels) == 'sto10'){
		$price = ceil((10*($stone_price)*$discount/100));
		$item = "10 x Stones";
		$column = '[stone]';
		$count  = 10;
	}
		if (($post_jewels) == 'sto20'){
		$price = ceil((20*($stone_price)*$discount_mid/100));
		$item = "20 x Stones";
		$column = '[stone]';
		$count  = 20;
	}
		if (($post_jewels) == 'sto30'){
		$price = ceil((30*($stone_price)*$discount_max/100));
		$item = "30 x Stones";
		$column = '[stone]';
		$count  = 30;
	}
		// Rena Price
		if (($post_jewels) == 're1'){
		$price = $rena_price;
		$item = "1 x Rena";
		$column = 'rena';
		$count  = 1;
	}
		if (($post_jewels) == 're10'){
		$price = ceil((10*($rena_price)*$discount/100));
		$item = "10 x Rena";
		$column = 'rena';
		$count  = 10;
	}
		if (($post_jewels) == 're20'){
		$price = ceil((20*($rena_price)*$discount_mid/100));
		$item = "20 x Rena";
		$column = 'rena';
		$count  = 20;
	}
		if (($post_jewels) == 're30'){
		$price = ceil((30*($rena_price)*$discount_max/100));
		$item = "30 x Rena";
		$column = 'rena';
		$count  = 30;
	}
}
       if ($select_version == 1){
         	$show = '';
            $end  =	'';
            }
           else {
       	   $show = '<!--';
           $end  =	' -->';	
            }
			
if (isset($_POST['buy'])){
	  if($price > $current_credits[$option['cr_db_column']] ){
		  $message[] = phrase_not_enough_credits;
	 }
	  else {
		    mssql_query("Update ".$option['cr_db_table']." set ".$option['cr_db_column']." = ".$option['cr_db_column']."-".$price." where ".$option['cr_db_check_by']." = '".$_SESSION['dt_username']."'");
			mssql_query("Update [DTweb_JewelDeposit] set ".$column." = ".$column."+".$count." where [memb___id] = '".$_SESSION['dt_username']."'");

            // Optional make logs  time(), $ip, and etc);
			
		   $message[] = "You paid ".$price." credits and bought ".$item;
		   $success = 1;
	     //refresh();
	  }
}
	foreach($message as $mistaken){
               switch($success){
				   case 1: $class='success';break;
				   default:$class='error';break;
			   }
		    echo "<div style='cursor:pointer' class='".$class."'>" . $mistaken . "</div>";			
	}
  $updated_credits = mssql_fetch_array(mssql_query("Select ".$option['cr_db_column']." from ".$option['cr_db_table']." where  ".$option['cr_db_check_by']." = '".$_SESSION['dt_username']."'"));
?>

    <table class='form' style='margin:0 auto;'>
	<tr> <td colspan='2' style='text-align:center; color:#99ff99'><?php echo phrase_You_have. $updated_credits[$option['cr_db_column']] . phrase_creditss;?> 
	</td></tr>
		  <form id='tab' method='post'>  
		    <td><select style='width:300px; color:white;' name='jewels'> 
						<option value ='re1' >Rena x1                /  <?php echo $rena_price.phrase_creditss;?></option>
						<option value ='re10'>Rena x10               /  <?php echo ceil((10*($rena_price)*$discount/100)).phrase_creditss;?></option>
						<option value ='re20'>Rena x20               /  <?php echo ceil((20*($rena_price)*$discount_mid/100)).phrase_creditss;?></option>
						<option value ='re30'>Rena x30               /  <?php echo ceil((30*($rena_price)*$discount_max/100)).phrase_creditss;?></option>
						<option disabled >-------------------------</option>
						<option value ='sto1' >Stone x1              /  <?php echo $stone_price.phrase_creditss;?></option>
						<option value ='sto10'>Stone x10             /  <?php echo ceil((10*($stone_price)*$discount/100)).phrase_creditss;?></option>
						<option value ='sto20'>Stone x20             /  <?php echo ceil((20*($stone_price)*$discount_mid/100)).phrase_creditss;?></option>
						<option value ='sto30'>Stone x30             /  <?php echo ceil((30*($stone_price)*$discount_max/100)).phrase_creditss;?></option>
						<option disabled >-------------------------</option>
						<option value ='b1' >Jewels of Bless x1     /  <?php echo $bless_price.phrase_creditss;?></option>
						<option value ='b10'>Jewels of Bless x10     /  <?php echo ceil(((10*($bless_price))*$discount/100)).phrase_creditss;?></option>
						<option value ='b20'>Jewels of Bless x20     /  <?php echo ceil((20*($bless_price)*$discount_mid/100)).phrase_creditss;?></option>
						<option value ='b30'>Jewels of Bless x30     /  <?php echo ceil((30*($bless_price)*$discount_max/100)).phrase_creditss;?></option>				  	
						<option disabled >-------------------------</option>
						<option value ='s1' >Jewels of Soul x1       /  <?php echo $soul_price.phrase_creditss;?></option>
						<option value ='s10'>Jewels of Soul x10      /  <?php echo ceil((10*($soul_price)*$discount/100)).phrase_creditss;?></option>
						<option value ='s20'>Jewels of Soul x20      /  <?php echo ceil((20*($soul_price)*$discount_mid/100)).phrase_creditss;?></option>
						<option value ='s30'>Jewels of Soul x30      /  <?php echo ceil((30*($soul_price)*$discount_max/100)).phrase_creditss;?></option>	
						<option disabled >-------------------------</option>
						<option value ='l1' >Jewels of Life x1       /  <?php echo $life_price.phrase_creditss;?></option>
						<option value ='l10'>Jewels of Life x10      /  <?php echo ceil((10*($life_price)*$discount/100)).phrase_creditss;?></option>
						<option value ='l20'>Jewels of Life x20      /  <?php echo ceil((20*($life_price)*$discount_mid/100)).phrase_creditss;?></option>
						<option value ='l30'>Jewels of Life x30      /  <?php echo ceil((30*($life_price)*$discount_max/100)).phrase_creditss;?></option>	
						<option disabled >-------------------------</option>
						<option value ='c1' >Jewels of Creation x1   /  <?php echo $creation_price.phrase_creditss;?></option>
						<option value ='c10'>Jewels of Creation x10  /  <?php echo ceil((10*($creation_price)*$discount/100)).phrase_creditss;?></option>
						<option value ='c20'>Jewels of Creation x20  /  <?php echo ceil((20*($creation_price)*$discount_mid/100)).phrase_creditss;?></option>
						<option value ='c30'>Jewels of Creation x30  /  <?php echo ceil((30*($creation_price)*$discount_max/100)).phrase_creditss;?></option>	
<?php echo $show;?>	<option disabled >-------------------------</option>	
<option value ='g1' >Jewels of Guardian x1   /  <?php echo $guardian_price.phrase_creditss;?></option>
						<option value ='g10'>Jewels of Guardian x10  /  <?php echo ceil((10*($guardian_price)*$discount/100)).phrase_creditss;?></option>
						<option value ='g20'>Jewels of Guardian x20  /  <?php echo ceil((20*($guardian_price)*$discount_mid/100)).phrase_creditss;?></option>
						<option value ='g30'>Jewels of Guardian x30  /  <?php echo ceil((30*($guardian_price)*$discount_max/100)).phrase_creditss;?></option>	
						<option disabled >-------------------------</option>
						<option value ='sm10'>Soul Mix x10           /  <?php echo $sm1.phrase_creditss;?></option> 
						<option value ='sm20'>Soul Mix x20           /  <?php echo ceil($sm2) .phrase_creditss;?></option> 
						<option value ='sm30'>Soul Mix x30           /  <?php echo ceil($sm3) .phrase_creditss;?></option> 
						<option disabled >-------------------------</option>
						<option value ='bm10'>Bless Mix x10          /  <?php echo ceil($bm1) .phrase_creditss;?></option>	 
						<option value ='bm20'>Bless Mix x20          /  <?php echo ceil($bm2) .phrase_creditss;?></option>
						<option value ='bm30'>Bless Mix x30          /  <?php echo ceil($bm3) .phrase_creditss;?></option><?php echo $end;?>
				    </select></td>                                    
					
	  <td align='center' colspan = '4'><input type='submit' name='buy' class='button' value ='<?php echo phrase_buy_jewels?>'/></td></tr>
			</form>
			
	</table>	

<?php 
}
else {
	echo phrase_currently_disabled;
}

?>	