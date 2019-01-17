<?php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {header("Location:../error.php");}else{
function check_inject() {
$badchars = array(";", "'", "\"", "*", "DROP", "SHUTDOWN", "SELECT", "UPDATE", "DELETE", "-","--");
foreach($_POST as $value) {
if(in_array($value, $badchars)) { exit(); }
else { 
$check = preg_split("//", $value, -1, PREG_SPLIT_OFFSET_CAPTURE);
foreach($check as $char) {
if(in_array($char, $badchars)) { exit(); }
}
 }
  }
   }

function clean_post($var=NULL) {
$newvar = @preg_replace('/[^a-zA-Z0-9\_\-\.]/', '', $var);
if (@preg_match('/[^a-zA-Z0-9\_\-\.]/', $var)) { }
return $newvar;
}
function pro($protected) { // This Will be the fuction we call to protect the variables.
	$banlist = array ("or=", "#", "|", ";", "*", '"', "+", "''", "ALTER", "alter", "+28", "-", "--", "%", "..", "%20", "'", "\"", "<", "\\", "|", "/", "=", "insert", "INSERT", "select", "SELECT", "WHERE", "where", "sele", "union", "UNION", "table", "TABLE", "update", "UPDATE", "delete", "distinct", "having", "truncate", "ftp", "FTP", "execute", "EXECUTE", "set", "res3t", "drop", "DROP", "TRUNCATE", "SET", "$", "del", "DEL", "replace", "handler", "like", "procedure", "limit", "order by", "group by", "asc", "desc", "Update", "UPdate", "UPDate", "UPDAte", "UPDATe", "updatE", "updaTE", "updATE", "upDATE", "uPDATE", "UpDaTe", "UpDAte", "UpDATE", "UPdATE", "UPDaTE", "UPDAtE", "UPdaTE", "UpDAtE", "UPDaTe", "UPdaTE", "FROM", "FrOm", "FRom", "FROm", "fROM", "frOM", "froM", "FRoM", "from", "fROM", "From", "FrOM", "Character", "CHARACTER", "character", "dbo", "memb_info", "warehouse", "dx", "ctlcode", "CTLCODE", "clevel", "CLEVEL", "MEMB_INFO", "dRop","drOp","droP","DrOp","dRoP","DroP","DRoP","DrOP","DROp","Drop"); 
	//$banlist is the list of words you dont want to allow.
	if ( preg_match ( "/[a-zA-Z0-9@]+/", $protected ) ) { // Makes sure only legitimate Characters are used.
		$protected = trim(str_replace($banlist, '', $protected)); // Takes out whitespace, and removes any banned words.
		return $protected;
		//echo "+";
	} else {
		//echo "-";
		echo $protected; 
		
	} 
}
}
?>