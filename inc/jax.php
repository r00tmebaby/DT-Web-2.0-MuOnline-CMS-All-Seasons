<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	require $_SERVER['DOCUMENT_ROOT']."/configs/config.php";
	require $_SERVER['DOCUMENT_ROOT']."/inc/main_funcs.php";

	if(isset($_GET['funcs'])){
	        switch($_GET['funcs']){
			  case "mobio":
                if(isset($_POST['price']) && isset($_POST['account']) && isset($_POST['country']))
	            {	
	                $phone_code = "";
	            	$sms_text   = "";
	            	$credits    = "";
	            	$price      = "";
	            	$account    = $_POST['account'];
	                foreach($option['mobio_services'] as $key => $value)
	            	{
	            		$keys  = array_keys($value);
	            		if($keys[0] == $_POST['country'])
	            		{
	                        foreach($value as $new => $ben)
	            			{
                                if(is_array($ben))
	            				{
                                	$key   = array_values($ben);
	            					$price      .= "<option value='".$key[3]."'>".$key[3]."</option>";
	            		    		if($_POST['price'] == $key[3])
	            					{
	            		    			$phone_code .=$key[4];
	            		    			$sms_text   .=$key[2];
	            		    			$credits    .=$key[1];
	            		    		}		
                                }
	                        }
	            		}
                     }
	            	 if($_POST['country']<>"BG"){
	            		 $account = "";
	            	 }
	            	 if($phone_code <> NULL && $sms_text <> NULL  && $credits <> NULL ){
	            		echo '
	            	       <div style="background:#403000;padding:10px 10px;border-radius:5px 5px 5px 5px ">
	            	          Please send message with text <span style="color:#FF9326"> '.$sms_text.'&nbsp;'.$account.'</span>  to number <span style="color:#FF9326">'.$phone_code.' </span>	
	            	         and you will automatically receive <span style="color:#FFFF4C">'.$credits.'</span> credits into your account
	            	       </div>'; 
	            	 }
	            	 else{
	            		 echo "<div class='error'>Please selected related to the chosen  country amount and currency.</div>";
	            	 }
                
	            }
				break;
				case "fortumo":
				    if(!empty($_POST['acc'])){
				           $account = trim($_POST['acc']);
				           $details = mssql_fetch_array(mssql_query("Select * from Memb_Info where memb___id='".$account."'"));
			        
				       if($details['memb___id'] <> null){
				    	   $hash    = hmac("SHA1",$account.$details['reg_ip'].$details['reg_date'],$option["fortumo_id"]);
				    	 mssql_query("Insert into DTweb_Fortumo_Orders (account,time,ip,hash) values ('".$account."','".time()."','".ip2long(ip())."','".$hash."')");   
				       }
   		            }
			break;
			}
    }
}
else{
	die();
}
?>