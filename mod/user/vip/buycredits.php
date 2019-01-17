<?php
///////////////////////////
// Buy credits DTweb 2.0 //
//     by r00tme         //
///////////////////////////
if(logged()){
require_once($_SERVER['DOCUMENT_ROOT']."/inc/lib/paymentwall.php");
$username = logged();
$messages = array();
$success  = 0;
$i        = 0;
$active   = array_values($option['buycredits_methods']);
$set      = web_settings();
$details  = mssql_fetch_array(mssql_query("Select * from Memb_Info where memb___id='".$username."'"));
$credits  = mssql_fetch_array(mssql_query("Select * from Memb_Credits where memb___id='".$username."'"));
echo'
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="../imgs/default.css" />
<script type="text/javascript" src="../js/bootstrap-select.min.js"></script>
<script src="https://assets.fortumo.com/fmp/fortumopay.js" type="text/javascript"></script>

<table class="table" style="margin:0 auto;">
		<tr class="title">
			<td colspan="2" style="text-align:center">Buy Credits</td>
		</tr>
</table>

<form  class="form" method="post">
<table class="table" >
   <tr><td style="width:300px;height:80px;background:url(\'../imgs/payments/coins_temp.png\');background-size:cover;" >
   <div class="coins_text">You have '.number_format($credits['credits']).'</div>
</div></td>

        <td style="float:right;border:none;"> 
    		<select class="selectpicker" onchange="showSelected(this.value)" name="method" id="character">
			   <option disabled selected >Select Payment Method</option>';					   
			      foreach($option['buycredits_methods'] as $methods => $value){
					  $i++;
			    	  if($value == 1){
						  echo "<option data-content=\"<img src='imgs/payments/".$methods.".png' width='80px' height='30px'/><span style='color:#ffa64c;padding-left:5px;font-weight:900;text-shadow:1px 1px #000'>".$option[$methods.'_cr_bonus']."</span>\" value='".$i."'></option>";
					  }
			      }
				echo '	  
				  	
		    </select>				
		<td></tr>								
	</table>
  </form>';
   if(isset($_GET['success'])){
	   $suc = (int)$_GET['success'];
	   switch($suc){
		   case 1: echo "<div id='message' style='display:none;' class='success'><p>Thanks for your payment.</p><p> Your order will be automatically delivered shortly</p></div>";break;
		   default: echo "<div id='message' style='display:none;' class='error'><p>We are sorry to hear that you have canceled the order.</p><p> Please do not hesitate to contact us if you need any assistance</div></p>"; break;
	   }
   }
   
// PayPal Form Start ->
echo'  
<div id="showdiv1" style="display:none;">
       <table>
			<form name="paypal_donate" action="" method="POST">
				<table style="margin: 0 auto;" class="table">
			    <tr>
				          <td style="padding:10px 10px;width:100px;text-align:center" class="title">Buy</td>
						  <td><select name="ppitem_id"  style="width:250px">';
		$count	= 0;
		foreach ($option['paypal_prices'] as $credits => $price) {
				$count++;
				echo ' <option value="'.$count.'"> x'.$credits.' Credits For '.$price . " " . $option['paypal_currency'].'</option> ';
			
		}
        echo "	 </select><td>";
		if ($count == 0) {
				$messages[] = ('There is no active payment right now');
		}
		else {
			echo '		
					<td>
						<input type="submit" class="button" value="Proceed Checkout">
					</td>
				</tr>';
		}
        
		echo '</form></table>';
		
		$check_payments = mssql_query("Select * from DTweb_PayPal_Transactions where memb___id='".$username."' order by id desc");
		if(mssql_num_rows($check_payments) > 0){
	echo'		
       <table class="table">
	        <tr class="title">
			    <td>#</td>
				<td>Paid</td>
				<td>Credits</td>
				<td>Date</td>
				<td>Status</td>
			</tr>';
		unset ($i);
		$i=0;
		while($dets = mssql_fetch_array($check_payments)){
			$i++;
			echo
			'
			  <tr>
			      <td style="font-size:10pt">'.$i.'</td>
				  <td style="font-size:10pt">'.$dets['amount'].' &nbsp;'.$dets['currency'].'</td>
				  <td style="font-size:10pt"><img width="20px"src="../imgs/payments/dtcoins.png"/> '.$dets['credits'].'</td>
				  <td style="font-size:10pt">'.server_time($dets['order_date']).'</td>
				  <td style="font-size:10pt">'.$dets['status'].'</td>
			  </tr>			
			';
		}
		echo '</table>';
		}	
    echo'			
</div>';
// PayPal End /////////////
//-------------------------
// EpayBG Form Start ->

echo '
<div id="showdiv2" style="display:none;">
     <table>
			<form name="epay_donate" action="" method="POST">
				<table style="margin: 0 auto;" class="table">
			    <tr>
				          <td style="padding:10px 10px;width:100px;text-align:center" class="title">Buy</td>
						  <td><select name="epitem_id"  style="width:250px">';
		$count	= 0;
		foreach ($option['epay_prices'] as $credits => $price) {
				$count++;
				echo ' <option value="'.$count.'"> x'.$credits.' Credits For '.$price . '&nbsp;BGN</option> ';
			
		}
        echo "	 </select><td>";
		if ($count == 0) {
				$messages[] = ('There is no active payment right now');
		}
		else {
			echo '		
					<td>
						<input type="submit" class="button" value="Proceed Checkout">
					</td>
				</tr>';
		}

		echo '</form></table>';
	
    unset($check_payments);	
	$check_payments = mssql_query("Select * from [DTweb_EpayBG_Orders] where account='".$username."' and verified = 1 order by id desc");

	if(mssql_num_rows($check_payments) > 0){
	echo'		
       <table class="table">
	        <tr class="title">
			    <td>#</td>
				<td>Invoice</td>
				<td>Paid</td>
				<td>Credits</td>
				<td>Date</td>
				<td>IP</td>
				<td>Status</td>
			</tr>';
		unset ($i);
		$i=0;
		while($dets = mssql_fetch_array($check_payments)){
			$prices = json_decode($dets['packet']);
			$i++;
			echo
			'
			  <tr>
			      <td style="font-size:10pt">'.$i.'</td>
				  <td style="font-size:10pt">'.$dets['invoice'].'</td>
				  <td style="font-size:10pt">'.$prices[1].'</td>
				  <td style="font-size:10pt"><img width="20px"src="../imgs/payments/dtcoins.png"/> '.$prices[0].'</td>
				  <td style="font-size:10pt">'.server_time($dets['time']).'</td>
				  <td style="font-size:10pt">'.long2ip($dets['ip']).'</td>
				  <td style="font-size:10pt">Confirmed</td>
			  </tr>			
			';
		}
		echo '</table>';
		}
	echo'

</div>
';
// EpayBG End //////////////
//-------------------------
// PayGol Form Start ->	

echo'

<div id="showdiv3" style="display:none;">
			<form name="paygol_donate" action="" method="POST">
				<table style="margin: 0 auto;" class="table">
			    <tr>
				          <td style="padding:10px 10px;width:100px;text-align:center" class="title">Buy</td>
						  <td><select name="pgol_id"  style="width:250px">';
		$count	= 0;
		foreach ($option['pgol_prices'] as $credits => $price) {
				$count++;
				echo ' <option value="'.$count.'"> x'.$credits.' Credits For '.$price . '&nbsp;'.$option['pgol_currency'].'</option> ';
			
		}
        echo "	 </select><td>";
		if ($count == 0) {
				$messages[] = ('There is no active payment right now');
		}
		else {
			echo '		
					<td>
						<input type="submit" class="button" value="Proceed Checkout">
					</td>
				</tr>';
		}

		echo '</form></table>';
    unset($check_payments);
	$check_payments = mssql_query("Select * from [DTweb_PayGol_Orders] where account='".$username."' and verified = 1 order by id desc");

		if(mssql_num_rows($check_payments) > 0){
	echo'		
       <table class="table">
	        <tr class="title">
			    <td>#</td>
				<td>Paid</td>
				<td>Credits</td>
				<td>Date</td>
				<td>IP</td>
				<td>Status</td>
			</tr>';
		unset ($i);
		$i=0;
		while($dets = mssql_fetch_array($check_payments)){
			$prices = json_decode($dets['packet']);
			$i++;
			echo
			'
			  <tr>
			      <td style="font-size:10pt">'.$i.'</td>
				  <td style="font-size:10pt">'.$prices[1].'</td>
				  <td style="font-size:10pt"><img width="20px"src="../imgs/payments/dtcoins.png"/> '.$prices[0].'</td>
				  <td style="font-size:10pt">'.server_time($dets['time']).'</td>
				  <td style="font-size:10pt">'.long2ip($dets['ip']).'</td>
				  <td style="font-size:10pt">Confirmed</td>
			  </tr>			
			';
		}
		echo '</table>';
		}
	
     echo' 
</div>';
//========= Paygol Form End	==//
//------------------------------
//========= Mobio Start ======//

echo ' <div id="showdiv4" style="display:none;">';
 
$countries = "";
$price     = "";
   foreach($option['mobio_services'] as $key => $value){
	  $keys  = array_keys($value);
	  $keys1 = array_values($value);

      $countries .="<option value='".$keys[0]."'>".$keys1[0]."</option>";
	   foreach($value as $new => $ben){	   	   
           if(is_array($ben)){
           	    $key   = array_values($ben);
           		$price    .= "<option value='".$key[3]."'>".$key[3]."</option>";
           }
	   }
   }
   
echo '
<div style="background:#310f05;"> 
<h5 class="title">How to get credits with Mobio SMS service ?</h5>
    <ul style="text-align:left;padding:5px 5px ;border:1px solid #67210a;">
      <li> - Use the form and select your country and desired donation</li>
      <li> - Please be aware of the message and type is properly</li> 
      <li> - We do not take any responsibility if you use different message-phone number combinations</li>
      <li> - You will receive your reward soon after your payment has been made</li>';
	  if($option['mobio_punish'] === 1){
		  echo '<li class="error"> You will be banned for cheating !</li>';
	  }
 echo'
    </ul>
</div>
<div style="float:left">
    <form id="mobio" class="form">
    	<input type="hidden" name="account" value="'.$username.'"/>
    <table width="200px" border="0" cellspacing="0">
      <tr>
        <td class="title">Country</td>
        <td><select name="country"  id="country" onchange="functions(\'mobio\')">'.$countries.'</select></td>
      </tr>
      <tr>
        <td class="title">Amount</td><td><select name="price" onchange="functions(\'mobio\')" id="price"><option disabled selected>-</option>'.$price.'</select></td>
      </tr>
    </table>
</div>
<div style="float:right;width:375px;"><div id="mobios"></div></div>
</form>';
 unset($check_payments);
	$check_payments = mssql_query("Select * from [DTweb_Mobio_Orders] where account='".$username."' order by id desc");

		if(mssql_num_rows($check_payments) > 0){
	echo'		
       <table class="table">
	        <tr class="title">
			    <td>#</td>
				<td>Paid</td>
				<td>Credits</td>
				<td>Date</td>
				<td>Country</td>
				<td>Number</td>
				<td>Status</td>
			</tr>';
		unset ($i);
		$i=0;
		while($dets = mssql_fetch_array($check_payments)){
			$prices = json_decode($dets['packet']);
			$i++;
			if($dets['verified']===1){
				$status = "Completed";
			}
			else{
				$status = "Failed";
			}
			
			echo
			'
			  <tr>
			      <td style="font-size:10pt">'.$i.'</td>
				  <td style="font-size:10pt">'.base64_decode($prices[1]).'</td>
				  <td style="font-size:10pt"><img width="20px"src="../imgs/payments/dtcoins.png"/> '.$prices[0].'</td>
				  <td style="font-size:10pt">'.server_time($dets['time']).'</td>
				  <td style="font-size:10pt">'.($dets['country']).'</td>
				  <td style="font-size:10pt">'.($dets['number']).'</td>
				  <td style="font-size:10pt">'.$status.'</td>
			  </tr>			
			';
		}
		echo '</table>';
		}

echo'
</div>';

//===== Mobio End ==//
//------------------------------
//==== Fortumo Start ====//
echo'
<div id="showdiv5" style="display:none;">
<div style="background:#310f05;"> 
<h5 class="title">How to get credits with Fortumo SMS service ?</h5>
    <ul style="text-align:left;padding:5px 5px ;border:1px solid #67210a;">
      <li> - Click the button <span style="color:#d6611f;font-weight:600">\'Pay Now\'</span> and a popup window will be opened</li>
      <li> - Choose the desired credits and select the payment amount</li> 
      <li> - You will receive your reward soon after your payment has been made</li>';
	  if($option['fortumo_punish'] === 1){
		  echo '<li class="error"> You will be banned for cheating !</li>';
	  }
echo '
    </ul>
</div>
<form id="fortumo" class="form" method="post">
    <input type="hidden" name="acc" value="'.$username.'"/>
    <a id="fmp-button" rel="'.$option["fortumo_id"].'/'.$username.$option["fortumo_id"].hmac("SHA1",$username.$details['reg_ip'].$details['reg_date'],$option["fortumo_id"]).'"><input type="submit" onclick="functions(\'fortumo\')" name="submit" value="Pay Now"/></a>
    <img style="opacity:0.7;margin-top:10px;background:rgba(255,255,255,0.9)" src="imgs/payments/fortumo_img.png"/>
</form>';
   unset($check_payments);
	$check_payments = mssql_query("Select * from [DTweb_Fortumo_Orders] where account='".$username."' and verified= 1 order by id desc");

		if(mssql_num_rows($check_payments) > 0){
	echo'		
       <table class="table">
	        <tr class="title">
			    <td>#</td>
				<td>Paid</td>
				<td>Credits</td>
				<td>Date</td>
				<td>Status</td>
			</tr>';
		unset ($i);
		$i=0;
		while($dets = mssql_fetch_array($check_payments)){
			$prices = json_decode($dets['packet']);
			$i++;			
			echo
			'
			  <tr>
			      <td style="font-size:10pt">'.$i.'</td>
				  <td style="font-size:10pt">'.$prices[1].'</td>
				  <td style="font-size:10pt"><img width="20px"src="../imgs/payments/dtcoins.png"/> '.$prices[0].'</td>
				  <td style="font-size:10pt">'.server_time($dets['time']).'</td>
				  <td style="font-size:10pt">Completed</td>
			  </tr>			
			';
		}
		echo '</table>';
		}

 echo'
</div>';
//===== Fortumo End ===//
//------------------------------
//==== PaymentWall Start ====//
echo'
<div id="showdiv6" style="display:none;">
<div style="margin:0 auto;" class="form">
   <img src="../imgs/payments/paymentwall_img.png"/>';
   pwal_form($username,$details['mail_addr'],$details['reg_date'],$details['reg_ip']);
echo'                
</div>';

     unset($check_payments);
	$check_payments = mssql_query("Select * from [DTweb_PaymentWall_Orders] where account='".$username."' order by id desc");

	if(mssql_num_rows($check_payments) > 0){
	echo'		
       <table  class="table">
	        <tr class="title">
			    <td>#</td>
				<td>Transaction id</td>
				<td>Credits</td>
				<td>Date</td>
				<td>Ip</td>
				<td>Status</td>
			</tr>';
		unset ($i);
		$i=0;
		while($dets = mssql_fetch_array($check_payments)){
			$i++;			
			echo
			'
			  <tr>
			      <td style="font-size:10pt">'.$i.'</td>
				  <td style="font-size:10pt">'.$dets['transaction_id'].'</td>
				  <td style="font-size:10pt"><img width="20px"src="../imgs/payments/dtcoins.png"/> '.$dets['packet'].'</td>
				  <td style="font-size:10pt">'.server_time($dets['time']).'</td>
				  <td style="font-size:10pt">'.long2ip($dets['ip']).'</td>
				  <td style="font-size:10pt">'.$dets['status'].'</td>
			  </tr>			
			';
		}
		echo '</table>';
		}
		
echo'	
</div>';

//===========PaymentWall Ends ===//
message($messages,$success);
ppal_prove();
epay_prove();
paygol_prove();
}
?>

<script>
$(function() {
    $('.selectpicker').selectpicker();
});

    var myDivs = new Array(1, 2, 3, 4,5,6);

    function showSelected(sapna) {
        var t = 'showdiv' + sapna,
            r, dv;
        for (var i = 0; i < myDivs.length; i++) {
            r = 'showdiv' + myDivs[i];
            dv = document.getElementById(r);
            if (dv) {
                if (t === r) {
                    dv.style.display = 'block';
                } else {
                    dv.style.display = 'none';
                }
            }
        }
        return false;
    }

 $( document ).ready(function(){
     $('#message').fadeIn('slow', function(){
        $('#message').delay(5000).fadeOut(); 			
     });
 });

$(function(){
  $('.selectpicker').selectpicker({});
  
  $(document).on('change','.dropdown-menu inner',function(e){
    var img = $('selectpicker option:selected').attr('data-xxx');
    alert(img);
  });
});


function functions(opt){
    var str = $('#'+opt).serialize();
    $.ajax({
        url: '../inc/jax.php?funcs='+opt,
        type: "POST",
        data: str,
        success: function(msgc)
        {
            $('#'+opt+'s').empty().append(""+msgc+"").hide().fadeIn("fast");
        }
    });	
}
</script>
<style>

.select-container{
  float:left;
}
.img-preview{
  float:left;  
}

</style>
