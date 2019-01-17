<?php
    $key=$_GET['key'];
    $array = array();
    include("../../configs/config.php");
    $query = mssql_query("select * from Character where Name LIKE '%{$key}%'");
    while($row = mssql_fetch_array($query))
    {
      $array[] = $row['Name'];
    }
    echo json_encode($array);
?>
