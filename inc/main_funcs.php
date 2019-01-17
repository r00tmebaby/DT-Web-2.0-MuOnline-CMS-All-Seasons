<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
function clean_vip(){
	$check_vip = mssql_query("Select VipExpirationTime from Character");
	while($cheks = mssql_fetch_array($check_vip)){
		if($cheks['VipExpirationTime'] < time()){
			mssql_query("Update Character set VipExpirationTime = 0, isVip = 0 where VipExpirationTime < ".time()."");
		}
	}
	
}

function protectw($value) {
	return str_replace(array("'", '"', ";", ")", "(", "=", "%27", "%22"), "", $value);
}

function message($messages,$success = 0){
		 foreach ($messages as $msg){
		 switch($success){
			 case 1: $class='success';break; 
			 default:$class='error';break;
			 }
		 echo "<div class='".$class."'>" . $msg ." </div>";
   } 
}

function GuildMark($hex,$size)
	{
		$cellSize = (int) ($size/8);
		$markCells = str_split($hex,1);
		
		$return = "
		
		<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				";
				for($i=1; $i<=64; $i++)
				{
					$return .= "<td style=\"width: " . $cellSize . "px !important; height: " . $cellSize . "px !important; margin:0px !important; padding:0px !important;\" bgcolor=\""; $return .= GetMarkColor($markCells[$i-1]); $return .= "\"></td>";
					if($i%8==0 && $i != 64) $return .= "</tr><tr>";
				}
			$return .= "
			</tr>
		</table>";
		return $return;
	}
    
function GetMarkColor($mark)
    {
        if($mark == 0){$color = "#666666";}
        if($mark == 1){$color = "#000000";}
        if($mark == 2){$color = "#8c8a8d";}
        if($mark == 3){$color = "#ffffff";}
        if($mark == 4){$color = "#fe0000";}
        if($mark == 5){$color = "#ff8a00";}
        if($mark == 6){$color = "#ffff00";}
        if($mark == 7){$color = "#8cff01";}
        if($mark == 8){$color = "#00ff00";}
        if($mark == 9){$color = "#01ff8d";}
        if($mark == 'a' or $mark == 'A'){$color = "#00ffff";}
        if($mark == 'b' or $mark == 'B'){$color = "#008aff";}
        if($mark == 'c' or $mark == 'C'){$color = "#0000fe";}
        if($mark == 'd' or $mark == 'D'){$color = "#8c00ff";}
        if($mark == 'e' or $mark == 'E'){$color = "#ff00fe";}
        if($mark == 'f' or $mark == 'F'){$color = "#ff008c";}
        return $color;
}

function geo_data(){
	$gi = geoip_open("inc/GeoIP.dat", GEOIP_STANDARD,GEOIP_MEMORY_CACHE);
	return($gi);
}

function totaltime($var)
{
$num = 0;

while($var > 60)
{
   $var = $var - 60;
   $num++;
}
return("{$num} h. and {$var} m.");
}

function make_log($file_name, $content)
{
	$file_date = date('d_m_Y', time());
    $log_date = date('h:i:s', time());
	$log_content='Date: '.$log_date .' | ' . $content . "\r\n";
	file_put_contents('logs/'.$file_name.'['.$file_date.'].log', $log_content, FILE_APPEND);
}

function make_log_news($file_name, $content)
{
	$file_date = date('d_m_Y', time());
    $log_date = date('h:i:s', time());
	$log_content='<hr style="height:5px;background:black"></br><span style="color:orange;text-shadow:0.4px 0.4px #000; font-weight:900;">Date: </span> '.$log_date .' | ' . $content . "\r\n";
	file_put_contents('logs/News/'.$file_name.'['.$file_date.'].html', $log_content, FILE_APPEND);
}
function show_messages($store)
{
	$msgs = (@$store['error']) ? $store['error'] : $store['success'];
	$msg_type = (@$store['error']) ? 'error' : 'success';
	foreach($msgs as $msg)
	{
		echo '<p class="'.$msg_type.'"> '.$msg.'</p>';
	}
}

function show_msg($msg, $num = 0)
{
	$label = ($num === 0) ? 'error' : 'success';
	$message[$label] = array();
	$message[$label][] = $msg;
	show_messages($message);
}

function char_class($value, $view=0)
{
	$class = array(
		0  => array("Dark Wizard","DW"),1 => array("Soul Master","SM"),2 => array("Grand Master","GrM"),3 => array("Grand Master","GrM"),
		16 => array("Dark Knight","DK"),17 => array("Blade Knight","BK"),18 => array("Blade Master","BM"),19 => array("Blade Master","BM"),
		32 => array("Fairy Elf","Elf"),33 => array("Muse Elf","ME"),34 => array("High Elf","HE"),35 => array("High Elf","HE"),
		48 => array("Magic Gladiator"),49 => array("Duel Master","DM"),50 => array("Duel Master","DM"),
		64 => array("Dark Lord","DL"),65 => array("Lord Emperor","LE"),66 => array("Lord Emperor","LE"),
	);
	
	return isset($class[$value][$view]) ? $class[$value][$view] : 'Unknown';   
}
function char_pic($value){
	switch($value){
			case 0: case 1: case 2: case 3:     $pic = "sm.gif";break;
            case 16: case 17: case 18: case 19: $pic = "bk.gif";break;
            case 32: case 33: case 34: case 35: $pic = "elf.gif";break;
            case 48: case 49: case 50: case 3:  $pic = "mg.gif";break;	
            case 64: case 65: case 66: case 3:  $pic = "dl.gif";break;
            default: $pic = " Unknown ";	break;		
	}
	return $pic;
}
function de_map($value)
{
$class = array( 0 => "<font color='#7396FF'>Lorencia</font>", 1 => "Dungeon", 2 => "<font color='#FFD24C'>Davias</font>", 3 => "<font color='#A6FF4C'>Noria</font>", 4 => "Lost Tower",  6 => "Arena", 7 => "Atlans", 8 => "Tarkan", 9 => "Devil Square", 10 => "Icarus", 11 => "Blood castle 1", 12 => "Blood castle 2", 13 => "Blood castle 3", 14 => "Blood castle 4", 15 => "Blood castle 5", 16 => "Blood castle 6", 17 => "Blood castle 7", 18 => "Chaos castle 1", 19 => "Chaos castle 2", 20 => "Chaos castle 3", 21=> "Chaos castle 4", 22 => "Chaos castle 5", 23 => "Chaos castle 6",  24 => "Kalima 1", 25 => "Kalima 2", 28 => "Kalima 1", 29 => "Kalima 1",  30 => "Valery Of Loren", 55 => "Valery Of Loren", 31 => "Land of Trial", 54 => "Aida", 33 => "Aida 2", 34 => "Cry Wolf");
return isset( $class[$value] ) ? $class[$value] : "----";   
}
function de_kills($value)
{
$class = array( 1 => "Hero", 1 => "Commoner", 3 => "Normal", 4 => "Against Murderer", 4 => "Murderer",  6 => "Phonomania");
return isset( $class[$value] ) ? $class[$value] : "----";   
}
function de_gm($value)
{
$class = array( 0 => phrase_module_error33, 8 => phrase_module_error34, 24 => phrase_module_error35, 1 => phrase_module_error36, 32 => phrase_module_error37);
return isset( $class[$value] ) ? $class[$value] : "----";   
}
function pk_level($value, $view=0)
{
	$pklevel = array( 
		1 => array('<span style="color:#605ca8;">Hero</span>','<span style="color:#605ca8;">H.</span>'), 
		2 => array('<span style="color:#605ca8;">Commoner</span>','<span style="color:#605ca8;">C.</span>'), 
		3 => array('<span>Normal</span>','<span>N.</span>'), 
		4 => array('<span style="color:#fbaf5d;">Against Murderer</span>','<span style="color:#fbaf5d;">A.M.</span>'), 
		5 => array('<span style="color:#a0410d;">Murderer</span>','<span style="color:#a0410d;">M.</span>'), 
		6 => array('<span style="color:#c81118;">Phonomania</span>','<span style="color:#c81118;">P.</span>')
	);
	return isset($pklevel[$value][$view]) ? $pklevel[$value][$view] : 'Unknown';   
}

function is_online($char_name, $only_account = 0)
{
	$accountid = mssql_fetch_array(
		mssql_query("SELECT AccountID FROM Character WHERE Name='". $char_name ."'")
	);
	
	$check_status = mssql_fetch_array(
		mssql_query("SELECT ConnectStat FROM MEMB_STAT WHERE memb___id='". $accountid['AccountID'] ."'")
	);
	
	$name = mssql_fetch_array(
		mssql_query("SELECT GameIDC FROM AccountCharacter WHERE id='". $accountid['AccountID'] ."'")
	);
	
	if($only_account===1 && $check_status['ConnectStat'] >= 1){ return 1; }
	elseif($check_status['ConnectStat'] >= 1 && $name['GameIDC'] == $char_name){ return 1; }
	else{ return 0; }
}


function char_info($char_name)
{
	$char = mssql_fetch_array(
		mssql_query("SELECT * FROM Character WHERE Name='". $char_name ."'")
	);
	
	$guild = mssql_fetch_array(
		mssql_query("SELECT G_Name FROM GuildMember WHERE Name='". $char['Name'] ."'")
	);
	
	if($guild['G_Name']==NULL)
	{
		$char['cGuild'] = phrase_no_guild;
	}
	else
	{
		$char['cGuild'] = $guild['G_Name'];
	}
	return $char;
}

function ip() {
    $ipaddress = '0.0.0.0';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function logged(){
   if(isset($_SESSION['dt_username'])){
	   return $_SESSION['dt_username'];
   }
   else{
   	 return false;
   }   
}



// EpayBG
function hmac($algo,$data,$passwd){
        /* md5 and sha1 only */
        $algo=strtolower($algo);
        $p=array('md5'=>'H32','sha1'=>'H40');
        if(strlen($passwd)>64) $passwd=pack($p[$algo],$algo($passwd));
        if(strlen($passwd)<64) $passwd=str_pad($passwd,64,chr(0));

        $ipad=substr($passwd,0,64) ^ str_repeat(chr(0x36),64);
        $opad=substr($passwd,0,64) ^ str_repeat(chr(0x5C),64);

        return($algo($opad.pack($p[$algo],$algo($ipad.$data))));
}

function epay_prepay($info = false){
require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
   	if(isset($_POST['epitem_id']) && logged())
	{
		$donate_id  = (int)$_POST['epitem_id'];
		$donate_id  = $donate_id -1;
        $username   = logged();
		$rand       = rand(565,8966);
		$prices     = array_values($option['epay_prices']);
		$credits    = array_keys($option['epay_prices']);
		if($donate_id >=0 && $donate_id < count($prices))
		{
		    $packet     = json_encode(array($credits[$donate_id],$prices[$donate_id]));
			
               if(!$info){
		          $inv        = mssql_query("Insert into [DTweb_EpayBG_Orders] (account,packet,time,ip,invoice) values ('{$username}','{$packet}','".time()."','".ip2long(ip())."','".$rand."')");
		        }
				
					$invoice_nr = mssql_fetch_array(mssql_query("Select TOP 1 * from  DTweb_EpayBG_Orders where account = '".$username."' order by id desc"));
			       
					return array($rand,$invoice_nr['id'],$username,$prices[$donate_id],$credits[$donate_id],$option['epay_client_nr'],$option['epay_email'],$option['epay_sec_key'],$invoice_nr['time'],$option['epay_inv_exp'],$option['epay_test']);		      
            }
		else
	    {
	    	 return false;
	    }
    }
  	 else
	{
	    return false;
	}
}

function pgol_prepay($info = false){
require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
   	if(isset($_POST['pgol_id']) && logged())
	{
		$donate_id  = (int)$_POST['pgol_id'];
		$donate_id  = $donate_id -1;
        $username   = logged();
		$prices     = array_values($option['pgol_prices']);
		$credits    = array_keys($option['pgol_prices']);
		if($donate_id >=0 && $donate_id < count($prices))
		{
		    $packet     = json_encode(array($credits[$donate_id],$prices[$donate_id]));
			
               if(!$info){
		          $inv        = mssql_query("Insert into [DTweb_PayGol_Orders] (account,packet,time,ip) values ('{$username}','{$packet}','".time()."','".ip2long(ip())."')");
		        }
				
					$invoice_nr = mssql_fetch_array(mssql_query("Select TOP 1 * from  DTweb_PayGol_Orders where account = '".$username."' order by id desc"));
			       
					return array($invoice_nr['id'],$username,$prices[$donate_id],$credits[$donate_id],$option['pgol_currency'],$option['pgol_sec_key'],$option['pgol_ser_id']);		      
            }
		else
	    {
	    	 return false;
	    }
    }
  	 else
	{
	    return false;
	}
}

function paygol_prove(){
require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
if(pgol_prepay()){	
$set        = web_settings();
$info       = pgol_prepay(true);
$hash_item	= md5($info[0] .$info[1].$info[2].$info[3].$info[4].$info[5].uniqid(microtime(),1));		
$rand       = rand(100,900);
mssql_query("Update DTweb_PayGol_Orders set hash = '".$hash_item."' where id='".$info[0]."'");

echo'
<form class="new"name="pg_frm" method="post" action="https://www.paygol.com/pay" >
   <input type="hidden" name="pg_serviceid" value="'.$info[6].'"/>
   <input type="hidden" name="pg_currency" value="'.$info[4].'"/>
   <input type="hidden" name="pg_name" value="Payment for '.$set[4].'"/>
   <input type="hidden" name="pg_custom" value="'.$hash_item.'"/>
   <input type="hidden" name="pg_price" value="'.$info[2].'"/>
   <input type="hidden" name="pg_return_url" value="'.$option['web_address'].'/?p=buycredits&success=1"/>
   <input type="hidden" name="pg_cancel_url" value="'.$option['web_address'].'/?p=buycredits&success=0"/>
    
<table border="0"  width="400px" class="table" style="width:300px;margin:0 auto;">
                    <tr><td colspan="2"><img style="margin-top:20x;background:rgba(255,255,255,0.9)" src="imgs/payments/PayGol_img.png"/></td></tr>
                    <tr><td class="title">Invoice No: </td><td style="font-weight:900">'.$rand.'</td></tr>
                    <tr><td class="title">Credits:</td><td style="font-weight:900">x '.$info[3].'</td></tr>
                    <tr><td class="title">Price:</td><td style="font-weight:900"> '.$info[2].'&nbsp; '.$option['pgol_currency'].'</td></tr>
                    <tr><td class="title" style="padding-right:60px;" colspan="2"><INPUT value="Agree" class="button" name="pg_button" type="submit"/></TD></tr>
        
        </table>


   </form>';


		}	
}

function mobio_config($country,$price){
	require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
    foreach($option['mobio_services'] as $key => $value)
    {
    	$keys  = array_keys($value);
    	
    	if($keys[0] == $country)
    	{
            foreach($value as $new => $ben)
    		{
                if(is_array($ben))
    			{
                	$key   = array_values($ben);
    	    		if($price == $new)
    				{
						return array($key[0],$key[1],$key[3]);
    	    		}		
                }
            }
    	}
     }
}

function pwal_form($username,$email){
	require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
	require($_SERVER['DOCUMENT_ROOT']."/inc/lib/paymentwall.php");
	Paymentwall_Config::getInstance()->set(array('api_type'    => Paymentwall_Config::API_VC,'public_key'  => $option["paymentwall_id"],'private_key' => $option["paymentwall_secret"]));
	    $widget = new Paymentwall_Widget(
    	$username,       
    	$option["pwall_widget"],      
    	array(),     
    	array('email' => $email) 
    );
  echo $widget->getHtmlCode();
}



function epay_prove(){
require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
if(epay_prepay()){	
         $info       = epay_prepay(true);

if($info[10]=== 1){
	$submit_url = 'https://devep2.datamax.bg/ep2/epay2_demo/';
}
else{
	$submit_url = 'https://www.epay.bg/';
}
   
$exp_date   = date("d.m.Y h:i:s",strtotime($info[9],$info[8]));                

$data = <<<DATA
MIN={$info[5]}
INVOICE={$info[1]}
AMOUNT={$info[3]}
EXP_TIME={$exp_date}
DESCR={$info[2]}
DATA;

$ENCODED  = base64_encode($data);
$CHECKSUM = hmac('sha1', $ENCODED, $info[7]); 
mssql_query("Update DTweb_EpayBG_Orders set hash = '".$CHECKSUM."' where id='".$info[1]."'");
echo"
        <form action=".$submit_url." method=POST>
          <input type=hidden name=PAGE value='paylogin'/>
          <input type=hidden name=ENCODED value='".$ENCODED."'/>
          <input type=hidden name=CHECKSUM value='".$CHECKSUM."'/>
          <input type=hidden name=URL_OK value=".$option['web_address']."/?p=buycredits&success=1/>
          <input type=hidden name=URL_CANCEL value='".$option['web_address']."'/?p=buycredits&success=0/>
                <table border='0' width='400px' class='table' style='width:300px;margin:0 auto;'>
				    <tr><td colspan='2'><img style='margin-top:20px;background:rgba(255,255,255,0.9)' src='imgs/payments/epay_img.png'/></td></tr>
                    <tr><td class='title'>Invoice No: </td><td style='font-weight:900'>{$info[0]}</td></tr>
                    <tr><td class='title'>Credits:</td><td style='font-weight:900'>x {$info[4]}</td></tr>
                    <tr><td class='title'>Price:</td><td style='font-weight:900'> {$info[3]} BGN</td></tr>
                    <tr><td class='title' style='padding-right:60px;' colspan='2'><INPUT value='Agree' class='button' type='submit'/></TD></tr>
        </form>
                </table>";
		}	
}

function paypal_prepay(){
require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
if(isset($_POST['ppitem_id']) && logged()){	
		$donate_id  = (int)$_POST['ppitem_id'];
		$donate_id  = $donate_id -1;
        $username   = logged();		
		$prices     = array_values($option['paypal_prices']);
		$credits    = array_keys($option['paypal_prices']);
		$currency   = $option['paypal_currency'];
		$hash_item	= md5($username.$prices[$donate_id].$currency.$credits[$donate_id].uniqid(microtime(),1));
		if($donate_id >= 0 && $donate_id < count($prices)){
		$insert_pre_donate	= mssql_query("INSERT INTO DTweb_PayPal_Orders (donate_id,amount,currency,credits,memb___id,hash) VALUES ('{$donate_id}','{$prices[$donate_id]}','{$currency}','{$credits[$donate_id]}','{$username}','{$hash_item}')");
		if($insert_pre_donate){
		    return array($donate_id,$prices[$donate_id],$currency,$credits[$donate_id],$username,$hash_item,$option['paypal_email'],$option['web_address']);		
		}
		else{
			return false;
		}
	}
	else{
		return false;
	}	
  }
  else{
	  return false;
  }
}

function ppal_prove(){
	if(paypal_prepay()){	
		$info = paypal_prepay();
		$set  = web_settings();
		   			echo '
					
						<table border="0" width="300px" style="margin:0 auto;padding:20px 20px">
						<tr><td colspan="2"><img style="margin-top:20x;background:rgba(255,255,255,0.9)" src="imgs/payments/PayPal_img.png"/></td></tr>
							<tr class="bgcol1">
								<td class="title" align="right" width="50%"><b>Username:</b></td>
								<td class="text_default">'.$info[4].'</td>
							</tr>
							<tr>
								<td class="title" align="right" width="50%"><b>Credits Issued:</b></td>
								<td class="text_default">'.number_format($info[3]).' </td>
							</tr>
							<tr class="bgcol1">
								<td class="title" align="right" width="50%"><b>Donate Amount:</b></td>
								<td class="text_default">'.$info[1].' '.$info[2].'</td>
							</tr>
					
						<form  action="https://www.paypal.com/cgi-bin/webscr" method="post">	
							<tr>
							
								<td>
									<input type="hidden" name="cmd" value="_donations" />
									<input type="hidden" name="business" value="'.$info[6].'" />
									<input type="hidden" name="item_name" value="Donate for '.($set[4]).'" />
									<input type="hidden" name="currency_code" value="'.strtoupper($info[2]).'" />
									<input type="hidden" name="amount" value="'.$info[1].'" />
									<input type="hidden" name="no_shipping" value="1" />
									<input type="hidden" name="shipping" value="0.00" />
									<input type="hidden" name="item_number" value="'.$info[5].'"/>
									<input type="hidden" name="return" value="'.$info[7].'/payment_proccess.php?method=paypal" />
									<input type="hidden" name="cancel_return" value="'.$info[7].'/payment_proccess.php?method=paypal" />
									<input type="hidden" name="notify_url" value="'.$info[7].'/payment_proccess.php?method=paypal" />
									<input type="hidden" name="custom" value="'.$info[4].'" />
									<input type="hidden" name="no_note" value="1" />
									<input type="hidden" name="tax" value="0.00" />
								</td>
							</tr>
							<tr class="title"><td colspan="2"><button type="submit"  class="button">Agree</button></td></tr>
						</table>
					</form>';				
	   }	
}

function check_signature($params_array, $secret) {
   ksort($params_array);

   $str = '';
   foreach ($params_array as $k=>$v) {
     if($k != 'sig') {
       $str .= "$k=$v";
     }
   }
   $str .= $secret;
   $signature = md5($str);

   return ($signature);
}

function check_admin($user)
{ 
	 $is_admin = mssql_fetch_array(mssql_query("Select * from DTweb_GM_Accounts where [Name] = '".$user."'"));
         array();
         if($is_admin['name'] != null){
			if($is_admin['ip'] != ip($user)){
				return false;
			}
			else{
				return array($is_admin['name'],$is_admin['gm_level'],$is_admin['ip']);	
				}  
			}
			else{
				return false;
			}   
}
function default_admin(){
	 $is_admin = mssql_num_rows(mssql_query("Select * from DTweb_GM_Accounts")); 
	 if($is_admin == 0){
		 mssql_query("INSERT [dbo].[DTweb_GM_Accounts] ([name], [gm_level], [ip]) VALUES ('test', 666, '127.0.0.1')");
	 }
	 $is_acc = mssql_num_rows(mssql_query("Select * from MEMB_INFO")); 
	 	if($is_acc == 0){	 
		    mssql_query("INSERT [dbo].[MEMB_INFO] ([memb_guid], [memb___id], [memb__pwd], [memb_name], [sno__numb], [post_code], [addr_info], [addr_deta], [tel__numb], [phon_numb], [mail_addr], [fpas_ques], [fpas_answ], [job__code], [appl_days], [modi_days], [out__days], [true_days], [mail_chek], [bloc_code], [ctl1_code], [IsVip], [VipExpirationTime]) VALUES 
			(1, 'test', 'test', 'Server', '1111111111111', '1234', '11111', '111111111', '12343', '0', 'test@test.test', 'testest', 'test', '1', '2003-11-23 00:00:00', '2003-11-23 00:00:00', '2003-11-23 00:00:00', '2003-11-23 00:00:00', '1', '0', '1', 0, 0)");

			}
}

function refresh(){

 echo '<META HTTP-EQUIV="Refresh" Content="0;">';
}
function refresh1(){
   echo '<META HTTP-EQUIV="Refresh" Content="1;">';
}
function home(){
	echo " <script>window.location.href = '?p=home';</script>";
}

//Paths the images only for Aion
function img_dir($img){
 include("configs/config.php");
 $images = "themes/aion/images/".$img."";
 return $images;
}

//Main Pagination Function
function pagination($offset = 0, $limit = 0, $select = NULL, $table = NULL, $order = NULL, $id_field = NULL, $where = NULL)
{
	$sql_query = 'SELECT TOP ' . (intval($limit)).' ' . $select . '
		FROM ' . $table . ' WHERE '.(!empty($where) ? $where . ' AND ': '').' ' . $id_field . '
		NOT IN (SELECT TOP ' . (intval($offset)).' ' . $id_field . ' 
		FROM ' . $table . (!empty($where) ? ' WHERE ' . $where : '').' 
		ORDER BY ' . $order . ') ORDER BY ' . $order;

    return $sql_query;
}
//Image Slider Proper Size Coverter
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

function ip_range($from, $to) {
  $start = ip2long($from);
  $end = ip2long($to);
  $range = range($start, $end);
  return array_map('long2ip', $range);
}

function protect($var=NULL) {
$newvar = @preg_replace('/[^a-zA-Z0-9\_\-\.]/', '', $var);
if (@preg_match('/[^a-zA-Z0-9\_\-\.]/', $var)) { }
return $newvar;
}


function pagi_style($pages,$max_pages,$page_limit){
include("configs/config.php");

if (empty($_GET['page']) || $_GET['page'] == 0) {$_GET['page'] = 1;}					
$prev = $_GET['page'] - 1;							
$next = $_GET['page'] + 1;							
$set  = web_settings();							
$targetpage = "?p=". $pages;
$paginate = '';
$max_pagesm1 = $max_pages -1;
$prevs='';$nexts='';
if($set[3] != "Aion"){
	$prevs='Previous';$nexts='Next';
}
if($max_pages > 1)
{
   if ($_GET['page'] > 1){
         $paginate.= "<a href='$targetpage&page=$prev'><div class='prev_page'>".$prevs."</div></a>";
        }
		else{
			$paginate.= ""; 
			}
   if ($max_pages < 7 + ($page_limit* 2)) {
       
	   for ($counter = 1; $counter <= $max_pages; $counter++){
           
		 if ($counter == $_GET['page']){
              $paginate.= "<div class='active_page'>$counter</div>";
		   }
			 else{
                $paginate.= "<a href='$targetpage&page=$counter'><div class='inactive_page'>$counter</div></a>";
				  }
		      }
          }
   elseif($max_pages > 5 + ($page_limit* 2)){

      if($_GET['page'] < 1 + ($page_limit* 2)){
          
		  for ($counter = 1; $counter < 4 + ($page_limit* 2); $counter++){
             if ($counter == $_GET['page']){
                 $paginate.= "<div class='active_page'>$counter</div>";
             }
			 else{
             $paginate.= "<a href='$targetpage&page=$counter'><div class='inactive_page'>$counter</div></a>";
			 }
          }
         
         $paginate.= " . ";
         $paginate.= "<a href='$targetpage&page=$max_pages'><div class='inactive_page'>$max_pages</div></a>";
        }
     elseif($max_pages - ($page_limit* 2) > $_GET['page'] && $_GET['page'] > ($page_limit* 2)){
        $paginate.= "<a href='$targetpage&page=1'><div class='inactive_page'>1</div></a>";
        $paginate.= " . ";
        for ($counter = $_GET['page'] - $page_limit; $counter <= $_GET['page'] + $page_limit; $counter++){
           if ($counter == $_GET['page']){
                $paginate.= "<div class='active_page'>$counter</div>";
           }
		   else{
                 $paginate.= "<a href='$targetpage&page=$counter'><div class='inactive_page'>$counter</div></a>";}
         }
       
        $paginate.= " . ";
        $paginate.= "<a href='$targetpage&page=$max_pages'><div class='inactive_page'>$max_pages</div></a>";
     }
  else{
     $paginate.= "<a href='$targetpage&page=1'><div class='inactive_page'>1</div></a>";
     $paginate.= " . ";
       for ($counter = $max_pages - (2 + ($page_limit* 2)); $counter <= $max_pages; $counter++){
          if ($counter == $_GET['page']){
                $paginate.= "<div class='active_page'>$counter</div>";
          }
          else{
                $paginate.= "<a href='$targetpage&page=$counter'><div class='inactive_page'>$counter</div></a>";}
        }
     }
 }
 
 
     if ($_GET['page'] < $counter - 1){
        $paginate.= "<a href='$targetpage&page=$next'><div class='next_page'>".$nexts."</div></a>";
      }
     else{
        $paginate.= "";
      }
    }  
	
   echo "<div id='pagination'>" . $paginate . "</div>";
 }
}

