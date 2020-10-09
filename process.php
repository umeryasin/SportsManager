<?php 

include 'conn.php';

$ob = new conn;

if (isset($_POST['home'])) {
	
	$home = $_POST['home'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $home AND Home = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}
if (isset($_POST['business'])) {
	
	$business = $_POST['business'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $business AND Business = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['customers'])) {
	
	$customers = $_POST['customers'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $customers AND Customers = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['vendors'])) {
	
	$vendors = $_POST['vendors'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $vendors AND Vendors = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}
if (isset($_POST['products'])) {
	
	$products = $_POST['products'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $products AND Products = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['product_received'])) {
	
	$product_received = $_POST['product_received'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $product_received AND Product_Received = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['new_invoice'])) {
	
	$new_invoice = $_POST['new_invoice'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $new_invoice AND New_Invoice = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['accounts'])) {
	
	$accounts = $_POST['accounts'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $accounts AND Accounts = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['sales_return'])) {
	
	$sales_return = $_POST['sales_return'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $sales_return AND Sales_Return = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['exchange_item'])) {
	
	$exchange_item = $_POST['exchange_item'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $exchange_item AND Exchange_Item = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['reports'])) {
	
	$reports = $_POST['reports'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $reports AND Reports = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}

if (isset($_POST['user_management'])) {
	
	$user_management = $_POST['user_management'];

	$sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id=UT.User_Type_Id AND UP.User_Type_Id = $user_management AND User_Management = 1";

	$query = mysqli_query($ob->connect(),$sql);

	if ($run = mysqli_fetch_array($query)) {
		
		$run1 = 1;

		echo $run1;
	}
	else{

		$run2 = 0;

		echo $run2;
	}

	//$run = mysqli_fetch()
}
?>