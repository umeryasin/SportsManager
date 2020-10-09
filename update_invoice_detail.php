<?php
include 'conn.php';
$ob=new conn;
///////////////////////////

	/*$inv_id=$_POST['invoice_id'];
	$inv_type_id=$_POST['invoice_type_id'];
	$payment_mode_id=$_POST['payment_mode_id'];
	$inv_date=$_POST['invoice_date'];
	$customer_id=$_POST['customer_id'];
	$inv_total=$_POST['total'];
	$inv_discount=$_POST['discount'];
	$inv_grand_total=$_POST['grand_total'];

	$sql_insert="INSERT INTO `invoice_master`(`Invoice_No`, `Invoice_Type_ID`, `Payment_Mode_ID`, `Customer_ID`, `Date`, `Sub_Total`, `GrandTotal`, `Discount`) VALUES ('$inv_id','$inv_type_id','$payment_mode_id','$customer_id','$inv_date','$inv_total','$inv_grand_total','$inv_discount')";
	$run_insert=mysqli_query($ob->connect(),$sql_insert);*/


////////////////////////////

$sale_price_list=$_POST['sale_price_list'];
$purchase_price_list=$_POST['purchase_price_list'];
$code_list=$_POST['code_list'];
$name_list=$_POST['name_list'];
$quantity_list=$_POST['quantity_list'];
$sub_total_list=$_POST['sub_total_list'];
$pro_discount_list=$_POST['pro_discount_list'];
//$increment=$_POST['increment'];
$invoice_id=$_POST['invoice_id'];
//////////////////////////////////////////////////

/*$sql_select="SELECT Quantity FROM `product` WHERE Barcode_ID='$code_list' ";
$run_select=mysqli_query($ob->connect(),$sql_select);
$row_select=mysqli_fetch_array($run_select);
$max_quan=$row_select['Quantity'];
$get_quan=$max_quan-$quantity_list;*/
////////////////////////////////////////////////


$sql="INSERT INTO `invoicedetails`(`Invoice_No`, `Barcode_ID`, `Quantity`, `Purchase_Price`, `Sale_Price`, `Detail_Total`, `Invoice_Individual_Discount`) VALUES ('$invoice_id','$code_list','$quantity_list','$purchase_price_list','$sale_price_list','$sub_total_list','$pro_discount_list')";
$run=mysqli_query($ob->connect(),$sql);
//////////////////////////////////////////////////
$sql_sale="INSERT INTO `sales_detail`(`Sales_No`, `Barcode_ID`, `Quantity`,`Return_Quantity`, `Purchase_Price`, `Sale_Price`, `Detail_Total`, `Sales_Individual_Discount`) VALUES ('$invoice_id','$code_list','$quantity_list',0,'$purchase_price_list','$sale_price_list','$sub_total_list','$pro_discount_list')";
$run_sale=mysqli_query($ob->connect(),$sql_sale);
//////////////////////////////////////////////////
//$sql_less_pro="UPDATE `product` SET `Quantity`='$get_quan' WHERE Barcode_ID='$code_list'";
//$run_less_pro=mysqli_query($ob->connect(),$sql_less_pro);
if($run && $run_sale); 
	echo "Ajax Done";


?>