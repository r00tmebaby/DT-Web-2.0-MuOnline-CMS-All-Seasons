<?php
//////////////////////////////////////////////////
//////////////////////////////////////////********
//////////   Multi Payment API    ////////********
//////////   Made for DTweb 2.0   ////////********
//////////  http://DarksTeam.net  ////////******** 
//////////       by r00tme        ////////********
//////////////////////////////////////////********
////* Report bugs to r00tme => DarksTeam.net /////
//////////////////////////////////////////////////

	require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
	require $_SERVER['DOCUMENT_ROOT']."/inc/main_funcs.php";
	require ($_SERVER['DOCUMENT_ROOT']."/inc/lib/paymentwall.php");
    require $_SERVER['DOCUMENT_ROOT']."/anti_ddos/start.php";
	 $log     = "";
     if(isset($_GET[$option['unique_method_key']]) || isset($_GET['method'])){
		if(isset($_GET)){
		       foreach($_GET as $keys=>$valus){
		   	    $log .= "&$keys=$valus";
		       }
		    }
		if(!empty($_GET[$option['unique_method_key']]) || !empty($_GET['method'])){
			
	//===============================PayPal==IPN===============================================================
			if($_GET['method'] === "paypal"){

					$req = 'cmd=_notify-validate';					
		    		foreach ($_POST as $key => $value) {
		    			$value 	= urlencode(stripslashes($value));
		    			$req 	.= "&$key=$value";
		    		}
		            if($option['ppal_debug']===1){
						make_log('/Payments/Paypal/',"[".date("H:i:s", time())."]".$req);
					}
		    		$header	.= "POST /cgi-bin/webscr HTTP/1.0\r\n";
		    		$header	.= "Content-Type: application/x-www-form-urlencoded\r\n";
		    		$header	.= "Content-Length: ".strlen($req)."\r\n\r\n";
		    		$fp 	= @fsockopen('ssl://www.paypal.com', 443, $ERROR_NO, $ERROR_STR, 30);
					
		    		if ($fp) {
					$payer_email 	= addslashes($_POST['payer_email']);
		    	    $receiver_email	= addslashes( $_POST['receiver_email']);
		    	    $item_number 	= addslashes($_POST['item_number']);
		    	    $tax 			= doubleval(addslashes($_POST['tax']));
		    	    $mc_gross 		= addslashes($_POST['mc_gross']);
		    	    $txn_type 		= addslashes($_POST['txn_type']);
		    	    $payment_status	= addslashes($_POST['payment_status']);
		    	    $currency 		= addslashes($_POST['mc_currency']);
		    	    $transaction_id	= addslashes($_POST['txn_id']);

		    			fputs($fp, $header.$req);
		    			while (!feof($fp)) {
		    				$res	= fgets($fp, 1024);
		    				if (strcmp($res, "VERIFIED") == 0) {
		    					make_log('/Payments/Paypal/',"[".date("H:i:s", time())."] PayPal sent [status: VERIFIED] [item_number: ".$item_number."]\n");
		    					if (strtolower($receiver_email) == strtolower($option['paypal_email'])) {
		    						$check_for_temp	= mssql_query("Select amount,currency,memb___id,credits from DTweb_PayPal_Orders where hash='".$item_number."'");
		    						if ($check_for_temp) {
		    							if (($txn_type == 'web_accept' OR $txn_type == 'subscr_payment') AND $payment_status == 'Completed') {
		    								$check_for_temp	= mssql_fetch_array($check_for_temp);
		    								make_log('/Payments/Paypal/',"[".date("H:i:s", time())."] PayPal sent [payment status: ".$payment_status."]  [transaction id: ".$transaction_id."] [userid: ".$check_for_temp['memb___id']."] ".$mc_gross." ".$currency."\n");
		    								$order_cost	= $check_for_temp['amount'];
		    								if ($tax > 0) {
		    									$mc_gross	-= $tax; 
		    								}
		    								if ($mc_gross == $order_cost) {
		    									if ($currency == $check_for_temp['currency']) {
		    										$check_if_transaction_exist	= mssql_query("Select id from DTweb_PayPal_Transactions where transaction_id='".$transaction_id."'");
		    										if (mssql_num_rows($check_if_transaction_exist) <= 0) {
		    											$order_date_time	= time();
		    											$insert_txn_id 		= mssql_query("INSERT INTO DTweb_PayPal_Transactions (transaction_id,amount,currency,memb___id,credits,order_date,status,payer_email)VALUES('".$transaction_id."','".$mc_gross."','".$currency."','".$check_for_temp['memb___id']."','".$check_for_temp['credits']."','".$order_date_time."','".$payment_status."','".$payer_email."')");
		    											if ($insert_txn_id) {
		    												make_log('/Payments/Paypal/',"[".date("H:i:s", time())."] [PayPal Donate Step 1/2] Insert Transaction Infos [transaction id: ".$transaction_id."] [amount: ".$mc_gross." ".$currency."] [userid: ".$check_for_temp['memb___id']."] [credits: ".number_format($check_for_temp['credits'])."]\n");
		    												$check_for_memb_id	= mssql_query("Select memb___id from MEMB_CREDITS where memb___id='".$check_for_temp['memb___id']."'");
		    												if (!$check_for_memb_id) {
		    													$set_credits	= mssql_query("insert into MEMB_CREDITS (memb___id,Credits)VALUES('".$check_for_temp['memb___id']."','".$check_for_temp['credits']."')");
		    												}
		    												else {
		    													$set_credits	= mssql_query("Update MEMB_CREDITS set Credits=Credits+'".$check_for_temp['credits']."'  where memb___id='".$check_for_temp['memb___id']."'");
		    												}
		    												if ($set_credits) {
		    													make_log('/Payments/Paypal/',"[".date("H:i:s", time())."] [PayPal Donate Step 2/2] Set Credits [userid: ".$check_for_temp['memb___id']."] [credits: ".number_format($check_for_temp['credits'])."]\n");
		    												}
		    											}
		    										}
		    									}
		    								}
		    							}
		    							elseif ($payment_status == 'Reversed' OR $payment_status == 'Refunded') {
		    								make_log('/Payments/Paypal/',"[".date("H:i:s", time())."] PayPal sent [payment status: ".$payment_status."]  [transaction id: ".$transaction_id."] [userid: ".$check_for_temp['memb___id']."]\n");
		    								if ($option['paypal_punish'] === 1) {
		    									$update_transaction_info	= mssql_query("Update DTweb_PayPal_Transactions set status='".$payment_status."' where transaction_id='".$transaction_id."'");
		    									if ($update_transaction_info) {
		    										$bloc_userid = mssql_query("Update memb_info set bloc_code='1' where memb___id='".$check_for_temp['memb___id']."'");
		    										if ($bloc_userid) {
		    											make_log('/Payments/Paypal/',"[".date("H:i:s", time())."] [PayPal Donate Punishment] Block account [userid: ".$check_for_temp['memb___id']."]\n");
		    										}
		    									}
		    								}
		    							}
		    						}
		    					}
		    				}
		    				elseif (strcmp($res, "INVALID") == 0) {
		    					make_log('/Payments/Paypal/',"[".date("H:i:s", time())."] PayPal sent [status: INVALID] [transaction id: ".$transaction_id."] or direct access is attempted ".ip()."\n");
		    				}
							else{
								header("Location:/");
							}
		    			}
		    			fclose ($fp);
						header("Location:/"); // Comment this line to debug the module
		    		  }
			}
		else{
		    switch($_GET[$option['unique_method_key']]){
	//=========================PayGol====API================================================================			
				case "paygol":
			
					   if(isset($_GET['key'])){						   
						   if($_GET['key'] == $option['pgol_sec_key']){
                                 $transaction_id     = $_GET['transaction_id'];
                                 $service_id         = $_GET['service_id'];
                                 $shortcode          = $_GET['shortcode'];
                                 $keyword            = $_GET['keyword'];
                                 $message            = $_GET['message'];
                                 $sender             = $_GET['sender'];
                                 $operator           = $_GET['operator'];
                                 $country            = $_GET['country'];
                                 $custom             = $_GET['custom'];
                                 $points             = $_GET['points'];
                                 $price              = $_GET['price'];
                                 $currency           = $_GET['currency'];
								 $check = mssql_query("Select * from DTweb_PayGol_Orders where hash = '".$custom."'");
								 
								 if(mssql_num_rows($check) === 1){
									$info    = mssql_fetch_array($check);
									$credits = json_decode($info['packet']);
									$data    = json_encode(array($transaction_id,$service_id,$shortcode,$keyword,$message,$sender,$operator,$country,$custom,$points,$price,$currency));								
									$update  = mssql_query("Update [Memb_Credits] set [credits] = [credits]+{$credits[0]} where memb___id = '".$info['account']."'");
									if($update){
										mssql_query("Update DTweb_PayGol_Orders set verified=1,data='".$data."' where hash='".$custom."'");
								        make_log('/Payments/PayGol/',"[".date("H:i:s", time())."] PayGol sent [status: SUCCESS] [Transaction ID: {$transaction_id}] [Account: {$info['account']}] [Credits/Amount Paid: x".$credits[0]."/ ".$credits[1]."\n {$currency}] [Shortcode: ".$shortcode."] [Sender: ".$sender."] [Operator: ".$operator."] [Country: ".$country."] [Points: ".$points."] [Price: ".$price."]\n");
								        exit("OK|Success");
									}
									else{
										exit("NOK|Reward not updated");
										make_log('/Payments/PayGol/',"[".date("H:i:s", time())."] PayGol sent Reward not Updated check the Queries, missing tables or columns\n");
									}
								}
								else{
									exit("NOK|Transaction ID not found");
									make_log('/Payments/PayGol/',"[".date("H:i:s", time())."] PayGol sent [status: INVALID] Status ID not Fount or direct access is attempted ".ip()."\n");
								}
						   }else{
                               make_log('/Payments/PayGol/',"[".date("H:i:s", time())."] PayGol sent [status: INVALID] [transaction id: ".$service_id."] or direct access is attempted ".ip()."\n");
							   exit ("NOK|Service ID not recognized");
							   
						   }
					   }		
				break;
	//=========================EpayBG====API================Tested with PHP v5.2 / v7.0.21 =======================			
				case "epaybg":
				
		if(empty($_POST['encoded']) || empty($_POST['checksum'])){
			make_log('/Payments/EpayBG/',"[".date("H:i:s", time())."] Missing encoded or checksum POST variables");

		}else{
			$encoded = $_POST['encoded'];
			$checksum = $_POST['checksum'];
			$hmac = hmac('sha1', $encoded, $option['epay_sec_key']);
            if($option['epay_test'] === 1){
				make_log('/Payments/EpayBG/',"[".date("H:i:s", time())."] Test => [Encoded]:".$encoded . "[Checksum]:".$checksum." [HMAC]:".$hmac);
			}
			if ($hmac == $checksum) { 
				$data = base64_decode($encoded);
				$lines_arr = split("\n", $data);
				$infoData = '';
				foreach ($lines_arr as $line) {
					if (preg_match("/^INVOICE=(\d+):STATUS=(PAID|DENIED|EXPIRED)(:PAY_TIME=(\d+):STAN=(\d+):BCODE=([0-9a-zA-Z]+))?$/",
							$line, $regs)) {
						  make_log('/Payments/EpayBG/',"[".date("H:i:s", time())."] Stage 1/2 => ".$line);
						$invoice   = $regs[1];
						$status    = $regs[2];
						$payDate   = $regs[4]; 
						$stan      = $regs[5]; 
						$bcode     = $regs[6]; 
						$infoData .= "INVOICE=$invoice:STATUS=OK\n";
						if($status==='PAID'){
							$check = mssql_query("Select * from DTweb_EpayBG_Orders where id='".$invoice."'");
							if(mssql_num_rows($check)===0){
							       make_log('/Payments/EpayBG/',"[".date("H:i:s", time())."] Invoice: '".$invoice."' and Hash: '".$hmac."' combination not found!");
							}else{
								$select  = mssql_fetch_array($check);
								$reward  = json_decode($select['packet']);
                                     mssql_query("Update DTweb_EpayBG_Orders set verified = 1 where id='".$invoice."'");
									 mssql_query("Update [MEMB_CREDITS] set [credits] = [credits] + {$reward[0]}  where memb___id='".$select['account']."'");
							    make_log('/Payments/EpayBG/',"[".date("H:i:s", time())."] Stage 2/2 Payment Successful [Account]=>".$select['account']." [Paid]=>".$reward[1]." [Credits Added]=> ".$reward[0]." ");
							}
						}
					}
				}
				echo $infoData, "\n";
			}
			else {
				exit("ERR=Not valid CHECKSUM\n");
				make_log('/Payments/EpayBG/',"[".date("H:i:s", time())."] Bad checksum");
			}
		}
			
				break;
	//=========================MobioBG====API==========================================================			
				case "mobio":
                
                $mobio_remote_addrs = array("87.120.176.216", "194.12.244.114");
				if($option['mobio_get_ip']){
					make_log('/Payments/Mobio/',"[".date("H:i:s", time())."] [Mobio IP]" . ip());	
				}
				if(in_array($_SERVER['REMOTE_ADDR'], $mobio_remote_addrs)) {
					
					$item            = protect($_REQUEST["item"]);
                    $fromnum         = $_REQUEST["fromnum"];
                    $extid           = $_REQUEST["extid"];
					$message         = $_REQUEST["message"];
                    $operator        = $_REQUEST["operator"];
					$amount          = (int)$_REQUEST["amount"];
					$currency        = $_REQUEST["currency"];
					$country         = $_REQUEST["country"];
					$billing_type    = $_REQUEST["billing_type"];
					$billing_status  = $_REQUEST["billing_status"];
					$config          = mobio_config($country,$amount);
					
                    if($option['mobio_get_vars'] === 1)
					{
					    make_log('/Payments/Mobio/',"[".date("H:i:s", time())."] ".$config[0]." /  ".$config[1]." Testing logs is created, please check all post-back variables and complete the configuration file => operator={$operator}&country={$country}&amount={$amount}&currency={$currency}&servID={$config[0]}&tonum={$fromnum}&extid={$extid} ");	
					}
				    else
					{
					    if(is_array($config))
					    {
			               if($billing_status == "Failed")
					       {
					         	if($option['mobio_punishment'] === 1)
					    		{
									
					         		mssql_query("Update MEmb_Info set bloc_code=1 where memb___id='".$item."'");
					         		make_log('/Payments/Mobio/',"[".date("H:i:s", time())."] Billing Failed  Account ".$item." is banned => operator={$operator}&country={$country}&amount={$amount}&currency={$currency}&servID={$config[0]}&tonum={$fromnum}&extid={$extid} ");
					         	}
					         	else
					    		{
					         		make_log('/Payments/Mobio/',"[".date("H:i:s", time())."] Billing Failed  Account ".$item." =>  operator={$operator}&country={$country}&amount={$amount}&currency={$currency}&servID={$config[0]}&tonum={$fromnum}&extid={$extid} ");
					         	}
					    		mssql_query("Insert into [DTweb_Mobio_Orders] (account,time,number,operator,country,packet,data,verified) values ('".$item."','".time()."','".$fromnum."','".$operator."','".$country."','".$packet."','".$data."',0)");
					         	$sms_reply = "Billing Failed";
					       }
					       
					       elseif($billing_status == "OK"){
							       $data ="operator={$operator}&country={$country}&amount={$amount}&currency={$currency}&servID={$config[0]}&tonum={$fromnum}&extid={$extid}";
							       $packet = json_encode(array($config[1],base64_encode($config[2].$currency)));
							       mssql_query("Insert into [DTweb_Mobio_Orders] (account,time,number,operator,country,packet,data,verified) values ('".$item."','".time()."','".$fromnum."','".$operator."','".$country."','".$packet."','".$data."',1)");
     				    	       mssql_query("Update [Memb_Credits] set [credits]=[credits] +".$config[1]." where [memb___id]='".$item."'"); 						
					    		   make_log('/Payments/Mobio/',"[".date("H:i:s", time())."] [Successful Payment] ".$config[1]." credits have been added to account ".$item." => operator={$operator}&country={$country}&amount={$amount}&currency={$currency}&servID={$config[0]}&tonum={$fromnum}&extid={$extid} ");
                                   $sms_reply = "Payment Successful";
						
						   }
						   
	                       file("http://mobio.bg/paynotify/pnsendsms.php?operator={$operator}&country={$country}&amount={$amount}&currency={$currency}&servID={$config[0]}&tonum={$fromnum}&extid={$extid}&message=" . urlencode($sms_reply));
				        }	   
				    } 
				}				
                break;
    //======================== Fortumo API =========================================================//
                case "fortumo":	
				
				    if($option["fortumo_see_ips"] === 1){
				    	make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."] Fortumo IP:" . ip());				    	
				    }
			
			       $servers = ip_range("54.72.6.1","54.72.6.255");				   
				   $add     = array('81.20.151.38', '81.20.148.122', '79.125.125.1', '209.20.83.207');
				   
                   if(in_array(ip(),$servers) || in_array(ip(),$add)) 
				    { 
                        				
	                  if(!empty($option["fortumo_secret"]) && check_signature($_GET, $option["fortumo_secret"])) 
					  {						
                         $sender     = $_GET['sender'];
                         $amount     = $_GET['amount'];
                         $operator   = $_GET['operator']; 
                         $user       = $_GET['cuid'];          
                         $price      = $_GET['price'];       
                         $country    = $_GET['country'];
                         $currency   = $_GET['currency'];
                         $payment_id = $_GET['payment_id'];
                         $service_id = $_GET['service_id'];
	                     $payment_id = $_GET['payment_id'];	
						 $account    = explode($option["fortumo_id"],$user);
                         $details    = mssql_fetch_array(mssql_query("Select * from Memb_Info where memb___id='".$account[0]."'"));
						 $hash       = hmac("SHA1",$account[0].$details['reg_ip'].$details['reg_date'],$option["fortumo_id"]);
							 
						if(preg_match("/failed/i", $_GET['status']))
						{
							 	if($option["fortumo_punish"] === 1 && $hash === $account[1])
								{
								   $ban = mssql_query("Update Memb_Info set bloc_code=1 where memb___id='".$account[0]."'");                       
		                           if($ban){
									  make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."] Account ".$account[0]." has been banned for Transaction Failed [GET Requests]" . $log );  
								   }
								   else{
									  make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."]  Account ".$account[0]." has NOT been! Check the Ban update query [GET Requests]" . $log ); 
								   }								   
								}
								make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."] Transaction Failed [GET Requests]" . $log );			    
						}
						else
						{ 
							if(preg_match("/completed/i", $_GET['status'])) 
							{
		     			        if($hash === $account[1]){
							    	 $upd_cr = mssql_query("Update Memb_Credits set [credits] = [credits] + ".$amount." where memb___id='".$account[0]."'");
							    	 if($upd_cr){
										$packet = json_encode(array($amount,$price.$currency));
										$top    = mssql_fetch_array(mssql_query("Select TOP 1 * from DTweb_Fortumo_Orders where hash='".$hash."' order by id desc"));
										mssql_query("Update DTweb_Fortumo_Orders set [verified] = 1,packet='".$packet."',data='".$log."' where id='".$top['id']."'"); 
									    make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."] Payment has been Successful [GET Requests]" . $log ); 
									 }
									 else{
										make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."] Payment has been Successful but DTweb_Fortumo_Ordersrtumo_Orders table not updated! Manual investigation is required [GET Requests]" . $log );  
									 }									 
							     }                             			
	                        }  		                  
					        else
							{						
						     make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."] Something went wrong and account credits have not been updated! Manual investigation is required[GET Requests]" . $log);				         
							}
				         }
					  }
                      else{ 
					
				       make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."] Invalid Signature [GET Requests]" . $log);
                      }
					   echo 'OK'; 					
				    }
				   else{
					 
					   make_log('/Payments/Fortumo/',"[".date("H:i:s", time())."] IP address not recognized [GET Requests]" . $log);
				   }
	 
                break;
				
			//=========================PaymentWall====API===============================================//			
               case "paymentwall":	
			   
                       Paymentwall_Base::setApiType(Paymentwall_Base::API_VC);
                       Paymentwall_Base::setAppKey($option["paymentwall_id"]);        // available in your Paymentwall merchant area
                       Paymentwall_Base::setSecretKey($option["paymentwall_secret"]); // available in your Paymentwall merchant area
                       $pingback = new Paymentwall_Pingback($_GET, ip());
					   
                       if ($pingback->validate()) {
                          
						    $username        = protectw($pingback->getUserId());
						    $refferenceid    = $pingback->getReferenceId();
					 	if(mssql_num_rows(mssql_query("Select * from Memb_Info where memb___id='".$username."'")) == 1){ 
                                if ($pingback->isDeliverable()) {
		                                           							
					 	    	    $insert = mssql_query("Insert into DTweb_PaymentWall_Orders (account,time,ip,status,packet,data,transaction_id) values ('".$username ."','".time() ."','".ip2long(ip())."','Successful','".$pingback->getVirtualCurrencyAmount()."','".$log."','".$refferenceid."')");
                                    $update = mssql_query("Update Memb_Credits set [credits] = [credits] + ".$pingback->getVirtualCurrencyAmount()." where memb___id='".$username."'"); 
                                    if($update && $insert){
					 	    		   make_log('/Payments/PaymentWall/',"[".date("H:i:s", time())."] [Username] =>" .$username . " paid successful and have received ".$pingback->getVirtualCurrencyAmount()." [GET_Request]" .$log); 
					 	    	   }
					 	    	   else{
					 	    		   make_log('/Payments/PaymentWall/',"[".date("H:i:s", time())."] [Username] =>" .$username . " Paid successful but there is a problem. Check the tables and queries");
					 	    	   }					 	    	 
                                } 
							elseif ($pingback->isCancelable()) {
					 	    	 	if($option["paymentwall_punish"] === 1)
					 	    		{
					 	    		   $exists = mssql_fetch_array(mssql_query("Select * from DTweb_PaymentWall_Orders where transaction_id='".$refferenceid."'"));
					 	    		   if($exists['transaction_id'] == NULL){
					 	    			   $insert = mssql_query("Insert into DTweb_PaymentWall_Orders (account,time,ip,status,packet,data,transaction_id) values ('".$username ."','".time() ."','".ip2long(ip())."','Failed','".$pingback->getVirtualCurrencyAmount()."','".$log."','".$refferenceid."')");   		  
					 	    		   }
					 	    		   else{
					 	    			   $insert = mssql_query("Update DTweb_PaymentWall_Orders set time='".time()."',status='Successful' where transaction_id='".$transaction_id."'"); 
					 	    		   }
					 	               $update = mssql_query("Update Memb_Info set bloc_code=1 where memb___id='".$username."'");                       
		                                if($update && $insert){
					 	    			  make_log('/Payments/PaymentWall/',"[".date("H:i:s", time())."] Account ".$username." has been banned for Transaction Failure [GET Requests]" . $log );  
					 	    		   }
					 	    		   else{
					 	    			$insert = mssql_query("Insert into DTweb_PaymentWall_Orders (account,time,ip,status,packet,data,transaction_id) values ('".$username ."','".time() ."','".ip2long(ip())."','Failed','".$pingback->getVirtualCurrencyAmount()."','".$log."','".$refferenceid."')");   
					 	    			make_log('/Payments/PaymentWall/',"[".date("H:i:s", time())."]  Account ".$username." has NOT been! Check the Ban update query [GET Requests]" . $log ); 
					 	    		   }								   
					 	    		}
					 	    		make_log('/Payments/PaymentWall/',"[".date("H:i:s", time())."] Transaction is Canceled [GET Requests]" . $log );			    				            
                                } 
						    elseif ($pingback->isUnderReview()) {
                                    $insert = mssql_query("Insert into DTweb_PaymentWall_Orders (account,time,ip,status,packet,data,transaction_id) values ('".$username ."','".time() ."','".ip2long(ip())."','Pending','".$pingback->getVirtualCurrencyAmount()."','".$log."','".$refferenceid."')");
                                    if(bool($insert) === true){
					 	    		   make_log('/Payments/PaymentWall/',"[".date("H:i:s", time())."] [Username] =>" .$username . " paid but transaction is Pending and have received ".$pingback->getVirtualCurrencyAmount()." [GET_Request]" .$log); 
					 	    	   }
					 	    	   else{
					 	    		   make_log('/Payments/PaymentWall/',"[".date("H:i:s", time())."] [Username] =>" .$username . " paid but transaction is Pending . Check the tables and queries");
					 	    	   }
                                }
                          echo 'OK'; 
                        }
			             else{
					 			make_log('/Payments/PaymentWall/',"[".date("H:i:s", time())."] [Username] =>" .$username . " doesn't exists");
					       }
					    }
                    else{
                    	 header("Location:/"); break; 
						 //echo $pingback->getErrorSummary();   Do not use it for production! Only for debugging
                    }					   
	                break;
			   
		    	default : header("Location:/"); break;
		     }
		   }
		}
		else{
			header("Location:/");
		}
	 }
	 else{
		 header("Location:/");
	 }		
?>