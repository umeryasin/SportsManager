<?php
include_once('conn.php');
$obj=new conn;
    $key=$_GET['key'];
    $array = array();
    //$con=mysqli_connect("localhost","root","","db_pointofsale");
    $query=mysqli_query($obj->connect(), "SELECT * FROM product_master WHERE Barcode_ID LIKE '%{$key}%' OR Product_Name LIKE '{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['Product_Name'];
    }
    echo json_encode($array);
?>
