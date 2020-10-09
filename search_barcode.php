<?php
    include 'connect.php';
    include 'conn.php';
    $obj=new conn;
    $key=$_GET['key2'];
    //print_
    //$con=mysqli_connect("localhost","root","","db_pointofsale");
    $sql = "SELECT * FROM product WHERE Barcode_ID = 897";
    $query=mysqli_query($obj->connect(), $sql);
   
    $row = mysqli_fetch_assoc($query);
    $array= $row['Product_Name'];
    echo json_encode($array);
    mysqli_close($con);
?>
