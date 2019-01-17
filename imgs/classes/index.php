<?php $allow = array("127.0.0.1"); //allowed IPs

if(!in_array($_SERVER['REMOTE_ADDR'], $allow) && !in_array($_SERVER["HTTP_X_FORWARDED_FOR"], $allow)) {

    header("Location: http://muplayring.net"); //redirect

    exit();

}


?>