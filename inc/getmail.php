<?php

include ($_SERVER['DOCUMENT_ROOT']."/configs/config.php");
$mail=$_GET['w'];
if(!preg_match("/^[a-zA-Z0-9.]{1,12}+@[a-zA-Z0-9-]+.[a-zA-Z0-9]{2,4}$/",$mail))
{
    echo "<img src='imgs/error.png'>";
}
else
{
    $mail = str_replace("'" , "", $mail);
    $mail = str_replace(";" , "", $mail);
    $sql="SELECT * FROM MEMB_INFO WHERE mail_addr='$mail'";
    $w=mssql_query($sql);
    $broi=mssql_num_rows($w);
    if($broi==0){echo "<img src='imgs/ok.png'>";}
    else {echo "<img src='imgs/error.png'>";}
}

?>