<?php
include 'conn.php';
$ob=new conn;
$product_code=$_POST['productCode'];
$stock=$_POST['stock'];
$sql="INSERT INTO `temp_table`(`Barcode_ID`, `Available_Stock`) VALUES ('$product_code','$stock')";
$run=mysqli_query($ob->connect(),$sql);
if($run)
echo "Save in Temp Table";
?>