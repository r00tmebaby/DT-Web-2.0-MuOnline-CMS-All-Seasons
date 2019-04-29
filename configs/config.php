<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
	//===========DT Web 2.0 r00tme version 1.18 Config================================================
	//===============3/06/2018=======================================================================
	//======Originally Developed by MeMoS and shared for DarksTeam.net Users==========================
	//================================================================================================
	// 3 GM steps are available 1 = Beginer GM, 2 = Trusted GM, 666 = Administrator
	$sql_host                     = '';           // Sql server host: 127.0.0.1,localhost,Your Computer Name
	$sql_user                     = '';                  // Sql server user: sa
	$sql_pass                     = '';              // Sql server password
	$database                     = 'MuOnline';     // Mu online database: default = MuOnline 
    $option['web_address']	      = "http://86.11.68.72";  // IP(static IP/external) or Domain Name. Must use http:// !Important for PostBacks and API's
	$option['has_dl']             = 0;                     // (IMPORTANT) Dark Lord: 1 = enable, 0 =  disable
    $option['md5']                = 0;                     // MD5 1 =ON / 0 = OFF
    $option['debug']              = 1;                     // 1=Show Errors / 0 = Hidden Errors   	                                                 
	$option['default_admin']      = 'test';                // Default Admin Account
	$option['default_admin_ip']   = '127.0.0.1';           // Default Admin Account
	$option['item_hex_lenght']    = 64;                    // S1 = 20 , S1-8 =32, S9-13 and IGCN = 64 / No other options are available, Do not fill anything else as the website wont work properly
	//================================================================================================
	//Vote Panel
    $option['vote_credits']       = 1;              // How many credits for one vote
    $option['vote_timing']        = 86400;          // Vote timing (in seconds 86400 = 24h)
	
	//================================================================================================	                                                       
    //Zen Bank                                                    
	$option['bank_limit']         = '60000000000';  // Bank
	$option['ware_limit']         = '2000000000';   // Warehouse	
	$option['inventory_limit']    = '2000000000';   // Character Inventory Limit
	
////////////////////////////////////////////////////////////////////////////////////////////////////////
    //================================================================================================
	// VIP MODULES ***================================================================================
	//================================================================================================
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    //Buy Vip
	$option['buy_vip']            = 1;              // 1= On , 0 = Off
	$option['buy_vip_res']        = "credits";      // Credits default, can be any resource that is available for deposit to the WebBank, make sure you have this column in DP_Jewel_Deposit table// default options: bless,soul,rena,stone,credits,life,chaos,guardian
	
	// Timings and price  / 0 = testing or free trial after expiration can not be applied to this character anymore
	$option['buy_vip_tm_pr']      = array 
	( 
	  "20 seconds"  =>  0    ,                            
	  "1 day"       =>  150  ,
	  "3 days"      =>  400  ,
	  "5 days"      =>  600  ,
	  "7 days"      =>  900  ,
	  "10 days"     =>  1250 ,
	  "15 days"     =>  1800 ,
	  "30 days"     =>  2600 
	);
	
	$option['buy_vip_requirements']      = array
	(                         
	  "Requested Resets"         =>  0  ,  // Requesting Minimal Resets       0=OFF
	  "Requested Level"          =>  0 ,   // Requested Minimal Level         0=OFF
	  "Requested Grand Resets"   =>  0     // Requested Minimal Grand Resets  0=OFF
	);
    //=================================================================================================	
    // Buy Credits
	
    $option['buycredits_methods']	= array( // Start-Stop Payment methods 1=On 0=Off
	  "PayPal"       => 1,
	  "Epay"         => 1,
	  "PayGol"       => 1,
	  "Mobio"        => 1,
	  "Fortumo"      => 1,
      "PaymentWall"  => 1
	);
//////////////////////////////////////////////////////////////////////
//=== Payment Methods Configuration
// This is the method key that will be used for all IPN's change it as every server must to have an unique one.
// *API's do not work locally, a real IP address or domain name is required 
//==================================================================================
// For example IPN's  should look like this if you do no change $option['unique_method_key'] value:
//
// http://IP or hostname /payment_proccess.php?dtweb_payment=paygol     
// http://IP or hostname /payment_proccess.php?dtweb_payment=paypal
// http://IP or hostname /payment_proccess.php?dtweb_payment=epaybg
//
/////////////////////////////////////////////////////////////////////////////////////////////

    $option['unique_method_key'] = "dtweb_payment"      ; // GET variable for the payment process *must be a string	

//PayPal Settings // ======================================================= 

	$option['paypal_email']    = "ludzspy@gmail.com"    ;   // PayPal Email Address
	$option['paypal_punish']   = 1                      ;   // ChargeBack Punishment -> Automatic Permanent Account Ban
	$option['PayPal_cr_bonus'] = "Bonus +50%"           ;   // Credit Bonus compared to other methods -> Some methods generate more profit than the others with this option you can persuade the players to pay via this method and give them more credits in return
	$option['paypal_currency'] = "EUR"                  ;   // All Available =>  https://developer.paypal.com/docs/classic/mass-pay/integration-guide/currency_codes/
	$option['ppal_debug']      = 0;                     ;   // Check whether you receive IPN from PayPAl
	$option['paypal_prices']   = array(
	  11100   =>  0.01 ,   // Credits => Price  //Use 0.01 euro for testing 
		200   =>  2    ,   // Credits => Price
		500   =>  3    ,   // Credits => Price
		1000  =>  10   ,   // Credits => Price
		3000  =>  12  	   // Credits => Price
	);
    
//EpayBG Settings  // =======================================================
	$option['epay_test']     = 1;                    // 1=On/0=Off if you want to use Epay Demo mode for debugging; Keep it false for production   
	$option['Epay_cr_bonus'] = "Bonus +10%";         // Credit Bonus compared to other methods -> Some methods generate more profit than the others with this option you can persuade the players to pay via this method and give them more credits in return
 	$option['epay_client_nr']= "D262694200";         // After business account registration you will be provided with a client number. Type it here!
	$option['epay_email']    = "r00tme@abv.bg";      // Your Business Account Registration Email
	$option['epay_sec_key']  = "EWA17QPLK1WD5D1N3VO8PNE8IHN1798OW7BFZEQO89ADNI50MJYOCZ7ERDGMPJ2J";   // Your Secret key
	$option['epay_inv_exp']  = "+ 2 days";           // Invoice expiration time, minimum 1 day is recommended
	$option['epay_prices']   = array(
	    100   =>  4   ,  // Credits => Price
		200   =>  7   ,  // Credits => Price
		500   =>  13  ,  // Credits => Price
		1000  =>  22  ,  // Credits => Price
		3000  =>  40  	 // Credits => Price
	); 
	
//PayGol Settings //======================================================
	$option['PayGol_cr_bonus']  = "Bonus  +30%";                          // Credit Bonus compared to other methods -> Some methods generate more profit than the others with this option you can persuade the players to pay via this method and give them more credits in return
	$option['pgol_ser_id']      = "329062";                               // Service ID
	$option['pgol_sec_key']     = "648707e6-fc7e-1032-9c5e-e882d49e9b2d"; // Your Secret key
	$option['pgol_currency']    = "EUR";                                  // Default Account currency                                   
	$option['pgol_prices']   = array(
	    100   =>  5   ,  // Credits => Price
		200   =>  8   ,  // Credits => Price
		500   =>  15  ,  // Credits => Price
		1000  =>  25  ,  // Credits => Price
		3000  =>  50  	 // Credits => Price
	); 	
	
//Mobio Settings
	$option['Mobio_cr_bonus'] = "Bonus +10%";   // Credit Bonus compared to other methods -> Some methods generate more profit than the others with this option you can persuade the players to pay via this method and give them more credits in return
    $option['mobio_get_vars'] = 0;              // Use this to get prices values for new services and add them  in $option['mobio_services'] array
    $option['mobio_punish']   = 0;              // Ban Account if payment is failed 1=On/0=Off
	$option['mobio_get_ip']   = 0;              // Record Mobio New IPs=> check Mobio Log Folder
    $option['mobio_services'] = array(
	// You can add as much services you want, just keep the same construction or you will brake up the code!	
	  	array("BG"=>"Bulgaria",                                       // Service Country Code, Country Full
		    1 => array(28531,10  ,"dtweb", "1.20 лв", 1851)  ,        // Payment Amount => array(ServiceID,Credits to add),SMS text, Real Sum, Service Number   
		    2 => array(25561,40  ,"dtweb", "2.40 лв", 1092)  ,        // Payment Amount => array(ServiceID,Credits to add) 
		    4 => array(25562,150 ,"dtweb", "4.80 лв", 1094)  ,        // Payment Amount => array(ServiceID,Credits to add) 
		   12 => array(29883,400 ,"dtweb", "12 лв"  , 1096))          // Payment Amount => array(ServiceID,Credits to add) 			)
        ,
		array("RO"=>"Romania",                                        // Service Country Code, Country Full
		    1 => array(26781,10  ,"plati dtweb", "1.20 euro", 1351) , // Payment Amount => array(ServiceID,Credits to add),SMS text, Real Sum, Service Number   
		    2 => array(25580,40  ,"plati dtweb", "2.40 euro", 1352))  // Payment Amount => array(ServiceID,Credits to add) 
	 );	
	

//Fortumo Settings
	$option['Fortumo_cr_bonus'] = "Bonus  +40%";     // Credit Bonus compared to other methods -> Some methods generate more profit than the others with this option you can persuade the players to pay via this method and give them more credits in return
	$option["fortumo_secret"]   = "99ad5e42d56909776e7071b4a79c2e40"; // Secret Key 
	$option["fortumo_id"]       = "3dc65d738d97dce5ccdbb351b73ba701"; // Service ID  
	$option["fortumo_punish"]   = 0;                 // Ban account if transaction status is failed
	$option["fortumo_see_ips"]  = 0;                 // Log Fortumo IP addresses

//PaymentWall Settings
	$option['PaymentWall_cr_bonus'] = "Bonus  0%";   // Credit Bonus compared to other methods -> Some methods generate more profit than the others with this option you can persuade the players to pay via this method and give them more credits in return
    $option['paymentwall_punish']   = 1;             // Ban account if transaction status is failed 
	$option["paymentwall_secret"]   = "d168d892228c24839d9f17bb57359a3b"; // Secret Key 
	$option["paymentwall_id"]       = "0dddc98c152d39c52eb80bb3e5e9d2b3"; // Service ID 
	$option["pwall_widget_width"]   = "370";         // Form With to adjust it for your template
	$option["pwall_widget_height"]  = "450";         // Form With to adjust it for your template
	$option["pwall_widget"]         = "p4_3";        // Widget type => _3 index calls the 3rd widget in your account
			
    //================================================================================================
	//================================================================================================
    // rc = Reset Character
    $option['rc_level']           = 400;           // Level required to reset a character
	$option['rc_zen']             = 20000000;      // Zen required to reset a character
	$option['rc_zen_type']        = 0;             // Increase required zen for every reset: 1 = enable, 0 =  disable 
	$option['rc_stats_type']      = 1;             // Increase stats for every reset(1r=500,2r=1000,...): 1 = enable, 0 =  disable 
	$option['rc_max_resets']      = 200;           // Max resets
	$option['rc_stats_per_reset'] = 500;           // Bonus stats per reset
	$option['rc_clear_stats']     = 1;             // Clear stats after reset: 1 = enable, 0 =  disable	
	$option['rc_stats_for_sm']    = 300;           // Points for dw,sm and grm 
	$option['rc_stats_for_bk']    = 400;           // Points for dk,bk and  bm
	$option['rc_stats_for_me']    = 500;           // Points for elf,me and he
	$option['rc_stats_for_mg']    = 600;           // Points for mg and dum 
	$option['rc_stats_for_dl']    = 700;           // Points for dl and le
	$option['rc_bonus_points']    = 1;             // Bonus points 
	
	//================================================================================================	
    // Storage Items on Page
	$option['storage_pagi']         = 10; 
    $option['storage_banned_items']	= array("");   // Banned Items for Deposit 0/10 - type/id

	//================================================================================================
    // Add Stats                                       
	$option['as_max_stats']       = 32767;         // The maximum stats a character have

	//================================================================================================	                                               
    // PK Clear                                         
	$option['pkc_zen']            = 15000000;      // Zen required to clear pk level
	$option['pkc_zen_type']       = 1;             // Increase required zen for every pk level: 1 = enable, 0 =  disable 
	
	//================================================================================================                                                  
    // Reset Stats                                      
	$option['rs_level']           = 400;           // Level required to reset stats
	$option['rs_resets']          = 10;            // Resets required to reset stats
	$option['rs_zen']             = 20000000;      // Zen required to reset stats
	
	//================================================================================================
    // Grand Reset                                    
	$option['gr_level']           = 400;           // Level required to grand reset
	$option['gr_resets']          = 10;            // Resets required to grand reset
	$option['gr_zen']             = 20000000;      // Zen required to grand reset
	$option['gr_reward']          = 1000;          // Reward for a grand reset - this is also the after gr start points
	$option['gr_max_resets']      = 10;            // Max grand resets
	$option['rc_gr_bonus']        = 1;             // Reward points for grand reset: 1 = enable, 0 =  disable
	$option['gr_reward_name']     = "Box +5"; // This is the reward name - rena stone item and etc
	//================================================================================================
    //Credits Column Setup
    $option['cr_db_column']       = "credits";
    $option['cr_db_table']        = "Memb_Credits";
    $option['cr_db_check_by']     = "memb___id";
	//================================================================================================ 
    // Gift Module
	
	$option['gift_res']           = array("rena","zen","credits","soul","bless","creation","life","chaos");
    $option['gift_procent']       = 150; // Add this percents to every send resource
	$option['gift_credits']       = 0;   // If this option is > 0, the cost is this value in credits, the multiplier wont work
    //================================================================================================   
	//Warnings Stack
	$option['warning_times']      = 3;   // How many warnings before the ban to be passed

	//Events => time in seconds		  		  
     $eventtime[1]['name']	      = 'Blood Castle';
     $eventtime[1]['start']		  = 'Jan 01,	2016 00:19:00';
     $eventtime[1]['repeattime']  = '3600';                   
     $eventtime[1]['opentime']	  = '300';
     
     $eventtime[2]['name']	      = 'Devil Square';
     $eventtime[2]['start']		  = 'Jan 01,	2016 01:00:00';
     $eventtime[2]['repeattime']	    = '7200';
     $eventtime[2]['opentime']	  = '300';
                                   
     $eventtime[3]['name']	      = 'Castle Siege';
     $eventtime[3]['start']		  = 'Jan 01,	2016 00:00:00';
     $eventtime[3]['repeattime']	    = '7200';
     $eventtime[3]['opentime']	  = '300';
     
     $eventtime[4]['name']	      = 'Sky Event';
     $eventtime[4]['start']		  = 'Jan 01,	2016 01:00:00';
     $eventtime[4]['repeattime']	    = '500';
     $eventtime[4]['opentime']	  = '300';
     
     $eventtime[5]['name']	      = 'Happy Hours';
     $eventtime[5]['start']		  = 'Jan 01,	2016 01:05:00';
     $eventtime[5]['repeattime']	    = '800';
     $eventtime[5]['opentime']	  = '300';
	
	
	//===Admin Modules==========================================================================
    //GM Box Adder Config
	
	$option['Box_timer_test']    = 0;       // *Imortant to be 0, If it is 1 the timer will be 1 minute for testing
	//////////////////////////
	
	$option['Box_timer_GM1']     = 24 ;     // Box Timer for GM level 1 /in hours/
	$option['Box_timer_GM2']     = 12 ;     // Box Timer for GM level 2 /in hours/
	
	/////////////////////////                         
	$option['GM_1_box1']         = 10 ;     // How many boxes +1 GM level 1 can add on day
	$option['GM_1_box2']         = 7  ;     // How many boxes +2 GM level 1 can add on day
	$option['GM_1_box3']         = 5  ;     // How many boxes +3 GM level 1 can add on day
	$option['GM_1_box4']         = 2  ;     // How many boxes +4 GM level 1 can add on day
	$option['GM_1_box5']         = 1  ;     // How many boxes +5 GM level 1 can add on day
	//////////////////////////              
	$option['GM_2_box1']         = 20 ;     // How many boxes +1 GM level 2 can add on day
	$option['GM_2_box2']         = 14 ;     // How many boxes +2 GM level 2 can add on day
	$option['GM_2_box3']         = 10 ;     // How many boxes +3 GM level 2 can add on day
	$option['GM_2_box4']         = 4  ;     // How many boxes +4 GM level 2 can add on day
	$option['GM_2_box5']         = 2  ;     // How many boxes +5 GM level 2 can add on day
	////////////////////////             
	
	//================================================================================================	
	//GM Account and Character Search
	$option ['user_pass_show']   = 1;       // Show User Login Password
    $option['top_acc']           = 20;      // Accounts per page
    $option['top_char']          = 20;      // Characters per page
 	$option['show_item_info']    = 1;       // Show item type/id and serial
	$option['show_item_hex']     = 1;       // Show item HEX
	//================================================================================================

	if (!class_exists('mssqlQuery')) { 
    class mssqlQuery 
    { 
        private $data = array(); 
        private $rowsCount = 0; 
        private $fieldsCount = null; 

        public function __construct($resource) 
        { 
            if ($resource) { 
                while ($data = sqlsrv_fetch_array($resource)) { 
                    $this->addData($data); 
                } 

                sqlsrv_free_stmt($resource); 
            } 
        } 

        public function getRowsCount() 
        { 
            return $this->rowsCount; 
        } 

        public function getFieldsCount() 
        { 
            if ($this->fieldsCount === null) { 
                $this->fieldsCount = 0; 
                $data = reset($this->data); 

                if ($data) { 
                    foreach ($data as $key => $value) { 
                        if (is_numeric($key)) { 
                            $this->fieldsCount++; 
                        } 
                    } 
                } 
            } 

            return $this->fieldsCount; 
        } 

        private function addData($data) 
        { 
            $this->rowsCount++; 
            $this->data[] = $data; 
        } 

        public function getData() 
        { 
            return $this->data; 
        } 

        public function shiftData($resultType = SQLSRV_FETCH_BOTH) 
        { 
            $data = array_shift($this->data); 

            if (!$data) { 
                return false; 
            } 

            if ($resultType == SQLSRV_FETCH_NUMERIC) { 
                foreach ($data as $key => $value) { 
                    if (!is_numeric($key)) { 
                        unset($data[$key]); 
                    } 
                } 
            } else { 
                if ($resultType == SQLSRV_FETCH_ASSOC) { 
                    foreach ($data as $key => $value) { 
                        if (is_numeric($key)) { 
                            unset($data[$key]); 
                        } 
                    } 
                } 
            } 

            return $data; 
        } 
    } 
} 


if (!function_exists('mssql_connect')) { 
    function mssql_connect($servername, $username, $password, $newLink = false) 
    { 
        if (empty($GLOBALS['_sqlsrvConnection'])) { 
            $connectionInfo = array( 
                "CharacterSet" => "UTF-8", 
                "UID" => $username, 
                "PWD" => $password, 
                "ReturnDatesAsStrings" => true 
            ); 

            $GLOBALS['_sqlsrvConnection'] = sqlsrv_connect($servername, $connectionInfo); 

            if ($GLOBALS['_sqlsrvConnection'] === false) { 
                foreach (sqlsrv_errors() as $error) { 
                    echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />"; 
                    echo "code: " . $error['code'] . "<br />"; 
                    echo "message: " . $error['message'] . "<br />"; 
                } 
            } 
        } 

        return $GLOBALS['_sqlsrvConnection']; 
    } 
} 

if (!function_exists('mssql_pconnect')) { 
    function mssql_pconnect($servername, $username, $password, $newLink = false) 
    { 
        if (empty($GLOBALS['_sqlsrvConnection'])) { 
            $connectionInfo = array( 
                "CharacterSet" => "UTF-8", 
                "UID" => $username, 
                "PWD" => $password, 
                "ReturnDatesAsStrings" => true 
            ); 

            $GLOBALS['_sqlsrvConnection'] = sqlsrv_connect($servername, $connectionInfo); 

            if ($GLOBALS['_sqlsrvConnection'] === false) { 
                foreach (sqlsrv_errors() as $error) { 
                    echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />"; 
                    echo "code: " . $error['code'] . "<br />"; 
                    echo "message: " . $error['message'] . "<br />"; 
                } 
            } 
        } 

        return $GLOBALS['_sqlsrvConnection']; 
    } 
} 

if (!function_exists('mssql_close')) { 
    function mssql_close($linkIdentifier = null) 
    { 
        sqlsrv_close($GLOBALS['_sqlsrvConnection']); 
        $GLOBALS['_sqlsrvConnection'] = null; 
    } 
} 

if (!function_exists('mssql_select_db')) { 
    function mssql_select_db($databaseName, $linkIdentifier = null) 
    { 
        $query = "USE " . $databaseName; 

        $resource = sqlsrv_query($GLOBALS['_sqlsrvConnection'], $query); 

        if ($resource === false) { 
            if (($errors = sqlsrv_errors()) != null) { 
                foreach ($errors as $error) { 
                    echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />"; 
                    echo "code: " . $error['code'] . "<br />"; 
                    echo "message: " . $error['message'] . "<br />"; 
                } 
            } 
        } 

        return $resource; 
    } 
} 

if (!function_exists('mssql_query')) { 
    function mssql_query($query, $linkIdentifier = null, $batchSize = 0) 
    { 
        if (preg_match('/^\s*exec/i', $query)) { 
            $query = 'SET NOCOUNT ON;' . $query; 
        } 

        $resource = sqlsrv_query($GLOBALS['_sqlsrvConnection'], $query); 

        if ($resource === false) { 
            if (($errors = sqlsrv_errors()) != null) { 
                foreach ($errors as $error) { 
                    echo "SQLSTATE: " . $error['SQLSTATE'] . "<br />"; 
                    echo "code: " . $error['code'] . "<br />"; 
                    echo "message: " . $error['message'] . "<br />"; 
                } 
            } 
        } 

        return new mssqlQuery($resource); 
    } 
} 

if (!function_exists('mssql_fetch_array')) { 
    function mssql_fetch_array($mssqlQuery, $resultType = SQLSRV_FETCH_BOTH) 
    { 
        if (!$mssqlQuery instanceof mssqlQuery) { 
            return null; 
        } 

        switch ($resultType) { 
            case 'MSSQL_BOTH' : 
                $resultType = SQLSRV_FETCH_BOTH; 
                break; 
            case 'MSSQL_NUM': 
                $resultType = SQLSRV_FETCH_NUMERIC; 
                break; 
            case 'MSSQL_ASSOC': 
                $resultType = SQLSRV_FETCH_ASSOC; 
                break; 
        } 

        return $mssqlQuery->shiftData($resultType); 
    } 
} 

if (!function_exists('mssql_num_rows')) { 
    function mssql_num_rows($mssqlQuery) 
    { 
        if (!$mssqlQuery instanceof mssqlQuery) { 
            return null; 
        } 

        return $mssqlQuery->getRowsCount(); 
    } 
} 


if (!function_exists('mssql_get_last_message')) { 
    function mssql_get_last_message() 
    { 
        preg_match('/^\[Microsoft.*SQL.*Server\](.*)$/i', sqlsrv_errors(SQLSRV_ERR_ALL), $matches); 
        return $matches[1]; 
    } 
} 


$sql_connect = mssql_connect($sql_host, $sql_user, $sql_pass) or die("Couldn't connect to SQL Server!");
$db_connect  = mssql_select_db($database, $sql_connect) or die("Couldn't open database: ". $database."");
if(mssql_num_rows(mssql_query("Select * from DTweb_GM_Accounts")) == 0){
	mssql_query("Insert into [DTweb_GM_Accounts] (name,gm_level,ip) VALUES ('".$option['default_admin']."','666','".$option['default_admin_ip']."')");
}
}
