<?php 
// ZAPHOD BREEBLEBROX'S LOGGER A.K.A. ZB LOG
// A CONNECTION LOGGER
// from http://www.spambotsecurity.com
// COPYRIGHT 2008,2009,2010 UNDER GPL V. 2.0
// Version 0.0.2
//

// *****START SCRIPT*****

// SUPER-DEBUG
// Expose errors by uncommenting the next 2 lines. DANGEROUS ON PRODUCTION SERVER!
//ini_set('display_errors',1);
//error_reporting(-1);

// Set variables, globals and the match counter to 0.

include('vault/directory.inc'); //Bring in directory information.

$zblogdir = $path_to_zbblock . "vault/";

// Get the variables for the connection.

$address=strtolower(@$_SERVER['REMOTE_ADDR']); 
$hoster=strtolower(gethostbyaddr($address)); 
$query2=@$_SERVER['QUERY_STRING']; 
$query=strtolower($query2); 
$querydec2=urldecode($query2); //added to remove %## crap for cleaner detections.
$querydec=strtolower($querydec2);
$fromhost2=@$_SERVER['HTTP_REFERER'];
$fromhost=strtolower($fromhost2);
$useragent=@$_SERVER['HTTP_USER_AGENT'];
$lcuseragent=strtolower($useragent);
$thishost=@$_SERVER['HTTP_HOST'];
$requesturi=@$_SERVER['REQUEST_URI'];
$lcrequesturi=strtolower($requesturi);
$pathinfo=@$_SERVER['PATH_INFO'];
$pathinfo=isset($pathinfo); //convert $pathinfo into true(1) if not null.
$rawpost=file_get_contents("php://input");

if (substr($address,0,10) != "192.168.0.") {

if ($rawpost != ""){
$rawpost = "! " . $rawpost;
}

if ($query2 != ""){
$query2 = "! " . $query2;
}

// Log it!

// Check for existance of zblog.txt, if not existant, write execution kill.
$zblogfilename = date('ymd') . '_zblog.txt';

if (!file_exists($zblogdir . $zblogfilename)){
$filex = fopen($zblogdir . $zblogfilename,"a");
$outputstring="<?php die(''); ?>\r\n\r\n";
fwrite($filex,$outputstring);
fclose($filex);
}
// Write zb_log.txt
$klt=$zblogdir . $zblogfilename;
$filex = fopen($klt,"a");
$outputstring="Time: " . date('r') . "\r\nHost: " . $hoster . "\r\nIP: " . $address . "\r\nQuery: " . $query2 . "\r\nPost: " . $rawpost . "\r\nReferer: " . $fromhost . "\r\nUser Agent: " . $useragent . "\r\nReconstructed URL: http:// " . $thishost . " " . $requesturi ."\r\n\r\n" ;
fwrite($filex,$outputstring);
fclose($filex);

if (!file_exists($zblogdir . "zblog.txt")){
$filex = fopen($zblogdir . "zblog.txt","a");
$outputstring="<?php die(''); ?>\r\n\r\n";
fwrite($filex,$outputstring);
fclose($filex);
}
// Write zb_log.txt
$klt=$zblogdir . "zblog.txt";
$filex = fopen($klt,"a");
$outputstring="Time: " . date('r') . "\r\nHost: " . $hoster . "\r\nIP: " . $address . "\r\nQuery: " . $query2 . "\r\nPost: " . $rawpost . "\r\nReferer: " . $fromhost . "\r\nUser Agent: " . $useragent . "\r\nReconstructed URL: http:// " . $thishost . " " . $requesturi ."\r\n\r\n" ;
fwrite($filex,$outputstring);
fclose($filex);

}
?>