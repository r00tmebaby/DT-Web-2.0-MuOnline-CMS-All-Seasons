<?php

include ($_SERVER['DOCUMENT_ROOT']."/configs/config.php");
function protect($var=NULL) {
$newvar = @preg_replace('/[^a-zA-Z0-9\_\-\.]/', '', $var);
if (@preg_match('/[^a-zA-Z0-9\_\-\.]/', $var)) { }
return $newvar;
}
$name=stripslashes($_GET['q']);
    $name = protect($name);
    $sql="SELECT * FROM MEMB_INFO WHERE memb___id='".$name."'";
    $q=mssql_query($sql);
    $broi=mssql_num_rows($q);
    if($broi==0)
    {
        echo "<img src='imgs/ok.png'>";
    }
    else
    {
        echo "<img src='imgs/error.png'>";
    }

