<?php
include 'connect.php';
include 'conn.php';
$ob = new conn;
    $key=$_GET['key3'];
    $array = array();
    //$con=mysqli_connect("localhost","root","","db_pointofsale");
    $query=mysqli_query($ob->connect(), "SELECT Barcode_ID FROM product WHERE Product_Name LIKE '%{$key}%'");
    while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['Barcode_ID'];
    }
    echo json_encode($array);
    mysqli_close($con);
?>