<?php
include 'conn.php';
$ob=new conn;
///////////////////

if(isset($_POST['Name']))
{
	$val=$_POST['Name'];
	$sql="SELECT Barcode_ID FROM product_master WHERE Barcode_ID='$val'";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Barcode_ID'];
}

if(isset($_POST['Qty']))
{
	$val=$_POST['Qty'];
	$inv_nn=$_POST['inv_nn'];
	$sql="SELECT * FROM sales_detail WHERE Barcode_ID='$val' AND Sales_No=$inv_nn";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	$qty= $row['Quantity'];
	$rqty= $row['Return_Quantity'];
	$remaining_qty=$qty - $rqty;
	echo $remaining_qty;
}

if(isset($_POST['Qty_Q']))
{
	$val=$_POST['Qty_Q'];
	$inv_nn=$_POST['inv_nn'];
	$sql="SELECT * FROM sales_detail WHERE Barcode_ID='$val' AND Sales_No=$inv_nn";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	$qty= $row['Quantity'];
	echo $qty;
}

if(isset($_POST['Unit_Price']))
{
	$val=$_POST['Unit_Price'];
	$inv_nn=$_POST['inv_nn'];
	$sql="SELECT * FROM sales_detail WHERE Barcode_ID='$val' AND Sales_No=$inv_nn";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Sale_Price'];
}

if(isset($_POST['Name_n']))
{
	$val=$_POST['Name_n'];
	$sql="SELECT * FROM product_master WHERE Barcode_ID='$val'";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Product_Name'];
}

if(isset($_POST['Sub_Tot']))
{
	$val=$_POST['Sub_Tot'];
	$inv_nn=$_POST['inv_nn'];
	$sql="SELECT * FROM sales_detail WHERE Barcode_ID='$val' AND Sales_No='$inv_nn' ";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Detail_Total'];
}

?>