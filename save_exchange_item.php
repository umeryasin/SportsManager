<?php
session_start();
//include('connect.php');
//$conn = mysqli_connect("localhost","root","","db_pointofsale");
include 'conn.php';
$ob=new conn;
if (isset($_POST['save'])){

$date				= $_POST['Date'];
$customer_name 		= $_POST['Customer_Name'];
$product_name1 		= $_POST['Product_Name1'];
$qty1 				= $_POST['Qty1'];
$product_name2 		= $_POST['Product_Name2'];
$qty2 				= $_POST['Qty2'];

		
		$maximum_record = "SELECT max(Exchange_Item_ID) FROM exchange_item";

		$existing_record = mysqli_query($ob->connect(),$maximum_record);

		$existing_id = mysqli_fetch_array($existing_record);

		$new_id = $existing_id['max(Exchange_Item_ID)'];

		$sql = "INSERT INTO exchange_item VALUES ($new_id+1,'$date','$customer_name','$product_name1','$qty1','$product_name2','$qty2') ";
		//print_r($sql);
		//exit();
		$run=mysqli_query($ob->connect(),$sql);

		$sql_select="SELECT Product_Quantity FROM `product_stock` WHERE Barcode_ID='$product_name1' ";
		$run_select=mysqli_query($ob->connect(),$sql_select);
		$row_select=mysqli_fetch_array($run_select);
		$max_quan=$row_select['Product_Quantity'];
		$get_quan=$max_quan+$qty1;

		$sql_mor_pro="UPDATE `product_stock` SET `Product_Quantity`='$get_quan' WHERE Barcode_ID='$product_name1'";
		$run_mor_pro=mysqli_query($ob->connect(),$sql_mor_pro);

		$sql_select1="SELECT Product_Quantity FROM `product_stock` WHERE Barcode_ID='$product_name2' ";
		$run_select1=mysqli_query($ob->connect(),$sql_select1);
		$row_select1=mysqli_fetch_array($run_select1);
		$min_quan=$row_select1['Product_Quantity'];
		$get_quan1=$min_quan-$qty2;

		$sql_less_pro="UPDATE `product_stock` SET `Product_Quantity`='$get_quan1' WHERE Barcode_ID='$product_name2'";
		$run_less_pro=mysqli_query($ob->connect(),$sql_less_pro);

		header("location:frm_exchange_item.php");
	}
	
mysqli_close($conn); 
?>
		

