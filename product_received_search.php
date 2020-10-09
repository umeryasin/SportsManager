<?php
include 'conn.php';
$ob=new conn;
///////
if (isset($_POST['pro_name']))
{
	$barcode=$_POST['pro_name'];
	$sql="SELECT * FROM product_master WHERE Barcode_ID='$barcode'";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Product_Name'];
}
if (isset($_POST['purchase_price']))
{
	$barcode=$_POST['purchase_price'];
	$sql="SELECT * FROM product_price WHERE Barcode_ID='$barcode' ORDER BY Product_Price_ID DESC LIMIT 1";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Purchase_Price'];
}
if (isset($_POST['pro_id']))
{
	$barcode=$_POST['pro_id'];
	$sql="SELECT * FROM product_master WHERE Barcode_ID= '$barcode' OR Product_Name='$barcode' ";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Barcode_ID'];
}

?>