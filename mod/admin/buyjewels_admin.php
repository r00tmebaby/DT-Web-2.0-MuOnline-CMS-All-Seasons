<!DOCTYPE html>
<!-- 
///////////////////////////////////////////////////////////
r0toto Admin Panel ///////////31 / 08 / 2016///////////////
     by r00tme         ////http://www.DarksTeam.net   /////          
///////////////////////////////////////////////////////////
-->
<script type="text/javascript" src="js/easyTooltip.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>	


<?php 
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
$messages         = array();
$file            = $_SERVER['DOCUMENT_ROOT']."/configs/mod_settings/buy_jewels.xml";
$get_config      = simplexml_load_file($file);

define("active","active");
define("select_version","select_version");
define("discount","discount");
define("discount_mid","discount_mid");
define("discount_max","discount_max");
define("creation_price","creation_price");
define("soul_price","soul_price");
define("bless_price","bless_price");
define("life_price","life_price");
define("stone_price","stone_price");
define("rena_price","rena_price");
define("guardian_price","guardian_price");
define("bm1","bm1");
define("bm2","bm2");
define("bm3","bm3");
define("sm1","sm1");
define("sm2","sm2");
define("sm3","sm3");
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
switch($active){
	case 1: $active = "selected";$active1 = "";break;
	case 0: $active = "";$active1 = "selected";break;
}
switch($select_version){
	case 1: $actives = "";$actives1 = "selected"; $start = '';$stop = ''; break;
	case 0: $actives = "selected";$actives1 = ""; $start = '<!--';$stop = '-->';break;
}
if(isset($_POST['update'])){
  if($select_version == 1){	
	$start_upd           = save_config($file,active,clean_post(trim($_POST['start'])));
	$start_upd1          = save_config($file,select_version,clean_post(trim($_POST['version'])));
	$start_upd2          = save_config($file,discount,clean_post(trim($_POST['discount'])));
	$start_upd3          = save_config($file,discount_mid,clean_post(trim($_POST['discount_mid'])));
	$start_upd4          = save_config($file,discount_max,clean_post(trim($_POST['discount_max'])));
	$start_upd5          = save_config($file,creation_price,clean_post(trim($_POST['creation_price'])));
	$start_upd6          = save_config($file,soul_price,clean_post(trim($_POST['soul_price'])));
	$start_upd7          = save_config($file,bless_price,clean_post(trim($_POST['bless_price'])));
	$start_upd8          = save_config($file,life_price,clean_post(trim($_POST['life_price'])));
	$start_upd9          = save_config($file,stone_price,clean_post(trim($_POST['stone_price'])));
	$start_upd10         = save_config($file,rena_price,clean_post(trim($_POST['rena_price'])));
	$start_upd11         = save_config($file,guardian_price,clean_post(trim($_POST['guardian_price'])));
	$start_upd12         = save_config($file,bm1,clean_post(trim($_POST['bm1'])));
	$start_upd13         = save_config($file,bm2,clean_post(trim($_POST['bm2'])));
	$start_upd14         = save_config($file,bm3,clean_post(trim($_POST['bm3'])));
	$start_upd15         = save_config($file,sm1,clean_post(trim($_POST['sm1'])));
	$start_upd16         = save_config($file,sm2,clean_post(trim($_POST['sm2'])));
	$start_upd17         = save_config($file,sm3,clean_post(trim($_POST['sm3'])));
	refresh();
  }
  else{
	  
	$start_upd           = save_config($file,active,clean_post(trim($_POST['start'])));
	$start_upd1          = save_config($file,select_version,clean_post(trim($_POST['version'])));
	$start_upd2          = save_config($file,discount,clean_post(trim($_POST['discount'])));
	$start_upd3          = save_config($file,discount_mid,clean_post(trim($_POST['discount_mid'])));
	$start_upd4          = save_config($file,discount_max,clean_post(trim($_POST['discount_max'])));
	$start_upd5          = save_config($file,creation_price,clean_post(trim($_POST['creation_price'])));
	$start_upd6          = save_config($file,soul_price,clean_post(trim($_POST['soul_price'])));
	$start_upd7          = save_config($file,bless_price,clean_post(trim($_POST['bless_price'])));
	$start_upd8          = save_config($file,life_price,clean_post(trim($_POST['life_price'])));
	$start_upd9          = save_config($file,stone_price,clean_post(trim($_POST['stone_price'])));
	$start_upd10         = save_config($file,rena_price,clean_post(trim($_POST['rena_price'])));
	refresh();
  }
}
$option = "";$option1 = "";$option2 = "";
for($i=1; $i < 100; $i++){
        if($i%5 == 0){
		 $obratno = 100 - $i; 
        if($i == $discount){$selectedi = "selected";}else{$selectedi = "";}
	$option .= "<option ".$selectedi." value='".$i."'>".$obratno." % Discount</option>";	
		}
}
for($k=1; $k < 100; $k++){
        if($k%5 == 0){
			 $obratno1 = 100 - $k; 
			 if($k == $discount_mid){$selectedk = "selected";}else{$selectedk = "";}
	$option1 .= "<option ".$selectedk." value='".$k."'>".$obratno1." % Discount</option>";	
		}
}
for($n=1; $n < 100; $n++){
        if($n%5 == 0){
		  $obratno2 = 100 - $n;
            if($n == $discount_max){$selectedn = "selected";}else{$selectedn = "";}		  
	      $option2 .= "<option ".$selectedn." value='".$n."'>".$obratno2." % Discount</option>";	
		}
}
    foreach($messages as $return){
		echo "</br>". $return;
	}
	echo "<center>
			    <table  class='form' style='font-size:12pt; width:600px;'>
			<form  name='".form_enc()."' class='form' method='post'>
			<input class='button' type='submit' value='".phrase_update."' name='update'/>
			<tr class='title'><td style='text-align:center' colspan='2'>".phrase_r0toto_settings."</td></tr>
			<tr>
			  <td title='<div class=admin-title><span>".phrase_r0toto_start.": </span> ".phrase_r0toto_start_desc."'>".phrase_r0toto_start."</td>
			  			<td>
						    <select class='nes' name='start'>
							     <option value='1' ".$active."> Yes </option>
								 <option value='0' ".$active1."> No </option>
						    </select>
						</td>
			</tr>
			<tr>
			  <td title='<div class=admin-title><span>".phrase_bjewels_ver.": </span> ".phrase_bjewels_ver_desc."'>".phrase_bjewels_ver."</td>
			  			<td>
						    <select class='nes' name='version'>
							     <option value='0' ".$actives."> 97D </option>
								 <option value='1' ".$actives1."> 99T (1.0M) </option>
						    </select>
						</td>
			</tr>
			<tr>
			  <td title='<div class=admin-title><span>".phrase_bjewels_discount.": </span> ".phrase_bjewels_discount_desc."'>".phrase_bjewels_discount."</td>
						  <td>
						    <select class='nes' name='discount'>
                                 ".$option."
						    </select>
						</td>
						</td>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_bjewels_discount_mid.": </span> ".phrase_bjewels_discount_mid_desc."'>".phrase_bjewels_discount_mid."</td>
						  <td>
						    <select class='nes' name='discount_mid'>
                                 ".$option1."
						    </select>
						</td>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_bjewels_discount_max.": </span> ".phrase_bjewels_discount_max_desc."'>".phrase_bjewels_discount_max."</td>
						  <td>
						    <select class='nes' name='discount_max'>
                                 ".$option2."
						    </select>
						</td>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_creation_price.": </span> ".phrase_creation_price_desc."'>".phrase_creation_price."</td>
			  			<td>
                             <input name='creation_price' min='1' type='number' value='".$creation_price."'/> x Credits
						</td>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewelofsoul.": </span> ".phrase_jewelofsoul_desc."'>".phrase_jewelofsoul."</td>
			  			<td>
                             <input name='soul_price'  min='1' type='number' value='".$soul_price."'/> x Credits
						</td>
			</tr>
						  <td title='<div class=admin-title><number>".phrase_jewelofbless.": </span> ".phrase_jewelofbless_desc."'>".phrase_jewelofbless."</td>
			  			<td>
                             <input name='bless_price'  min='1' type='number' value='".$bless_price."'/> x Credits
						</td>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jeweloflife.": </span> ".phrase_jeweloflife_desc."'>".phrase_jeweloflife."</td>
			  			<td>
                             <input name='life_price'  min='1' type='number' value='".$life_price."'/> x Credits
						</td>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewelstone.": </span> ".phrase_jewelstone_desc."'>".phrase_jewelstone."</td>
			  			<td>
                             <input name='stone_price'  min='1' type='number' value='".$stone_price."'/> x Credits
						</td>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewel_rena.": </span> ".phrase_jewel_rena_desc."'>".phrase_jewel_rena."</td>
			  			<td>
                             <input name='rena_price'  min='1' type='number' value='".$rena_price."'/> x Credits
						</td>
			</tr>
			</tr>".$start."
						  <td title='<div class=admin-title><span>".phrase_jewelguardian.": </span> ".phrase_jewelguardian_desc."'>".phrase_jewelguardian."</td>
			  			<td>
                             <input name='guardian_price'  min='1' type='number' value='".$guardian_price."'/> x Credits
						</td>
			</tr>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewel_blessx10.": </span> ".phrase_jewel_blessx10_desc."'>".phrase_jewel_blessx10."</td>
			  			<td>
                             <input name='bm1'  min='1' type='number' value='".$bm1."'/> x Credits
						</td>
			</tr>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewel_blessx20.": </span> ".phrase_jewel_blessx20_desc."'>".phrase_jewel_blessx20."</td>
			  			<td>
                             <input name='bm2'   min='1' type='number'  value='".$bm2."'/> x Credits
						</td>
			</tr>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewel_blessx30.": </span> ".phrase_jewel_blessx30_desc."'>".phrase_jewel_blessx30."</td>
			  			<td>
                             <input name='bm3'   min='1' type='number'  value='".$bm3."'/> x Credits
						</td>
			</tr>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewel_soulx10.": </span> ".phrase_jewel_soulx10_desc."'>".phrase_jewel_soulx10."</td>
			  			<td>
                             <input name='sm1'   min='1' type='number'  value='".$sm1."'/> x Credits
						</td>
			</tr>
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewel_soulx20.": </span> ".phrase_jewel_soulx20_desc."'>".phrase_jewel_soulx20."</td>
			  			<td>
                             <input name='sm2'   min='1' type='number'  value='".$sm2."'/> x Credits
						</td>
			</tr>	
			</tr>
						  <td title='<div class=admin-title><span>".phrase_jewel_soulx30.": </span> ".phrase_jewel_soulx30_desc."'>".phrase_jewel_soulx30."</td>
			  			<td>
                             <input name='sm3'   min='1' type='number'  value='".$sm3."'/> x Credits
						</td>
			</tr>
				".$stop."	
			</table><input class='button' type='submit' value='".phrase_update."' name='update'/>";
			
}