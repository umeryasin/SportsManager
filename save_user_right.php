<?php 

include 'conn.php';

$ob = new conn;

$type_id 			= $_POST['User_Type_Id'];
/*$home 			= $_POST['Home'];
$business 			= $_POST['Business'];
$customer 			= $_POST['Customers'];
$vendors 			= $_POST['Vendors'];
$products 			= $_POST['Products'];
$new_invoice 		= $_POST['New_Invoice'];
$accounts 			= $_POST['Accounts'];
$sales_return 		= $_POST['Sales_Return'];
$reports 			= $_POST['Reports'];
$user_management 	= $_POST['User_Management'];*/


if(isset($_POST['Home']))

	$home = 1;
else
	$home = 0;
if(isset($_POST['Business']))

	$business = 1;
else
	$business = 0;
if(isset($_POST['Customers']))

	$customer = 1;
else
	$customer = 0;
if(isset($_POST['Vendors']))

	$vendors = 1;
else
	$vendors = 0;
if(isset($_POST['Products']))

	$products = 1;
else
	$products = 0;
if(isset($_POST['Product_Received']))

	$product_received = 1;
else
	$product_received = 0;
if(isset($_POST['New_Invoice']))

	$new_invoice = 1;
else
	$new_invoice = 0;
if(isset($_POST['Accounts']))

	$accounts = 1;
else
	$accounts = 0;
if(isset($_POST['Sales_Return']))

	$sales_return = 1;
else
	$sales_return = 0;
if(isset($_POST['Exchange_Item']))

	$exchange_item = 1;
else
	$exchange_item = 0;
if(isset($_POST['Reports']))

	$reports = 1;
else
	$reports = 0;
if(isset($_POST['User_Management']))

	$user_management = 1;
else
	$user_management = 0;

/*$sql = "INSERT INTO `user_permission`(`User_Type_Id`, `Home`, `Business`, `Customers`, `Vendors`, `Products`, `New_Invoice`, `Accounts`, `Sales_Return`, `Reports`, `User_Management`) VALUES ('$type_id','$home','$business','$customer','$vendors','$products','$new_invoice','$accounts','$sales_return','$reports','$user_management')";*/

$sql="UPDATE `user_permission` SET `Home`='$home',`Business`='$business',`Customers`='$customer',`Vendors`='$vendors',`Products`='$products', `Product_Received`='$product_received',`New_Invoice`='$new_invoice',`Accounts`='$accounts',`Sales_Return`='$sales_return', `Exchange_Item`='$exchange_item',`Reports`='$reports',`User_Management`='$user_management' WHERE User_Type_Id=$type_id";

$query = mysqli_query($ob->connect(),$sql);

header("location:frm_user_right.php");

?>