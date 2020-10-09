<?php
session_start();
//include('connect.php');
include 'conn.php';
$ob=new conn;

if (isset($_POST['save'])){

$head_of_account		= $_POST['Head_Of_Account'];
$account_title 			= $_POST['Account_Title'];
$account_code 			= $_POST['Account_Code'];
$opening_balance_date 	= $_POST['Opening_Balance_Date'];
$opening_balance 		= $_POST['Opening_Balance'];

		$sql1 = "SELECT * FROM `account_title` WHERE Account_Title = '$account_title' AND Account_Code = '$account_code'";
		$result = mysqli_query($ob->connect(),$sql1);

		echo "<script>
		alert('Account Title or Account Code Already Exists');
		window.location = 'frm_add_accounts.php'
		</script>";
		 
		$maximum_record = "SELECT max(Account_Title_ID) FROM account_title";

		$existing_record = mysqli_query($ob->connect(),$maximum_record);

		$existing_id = mysqli_fetch_array($existing_record);

		$new_id = $existing_id['max(Account_Title_ID)'];

		$sql = "INSERT INTO account_title VALUES ($new_id+1,'$head_of_account','$account_title','$opening_balance','$opening_balance_date','$account_code') ";
		$run=mysqli_query($ob->connect(),$sql);

		$sql1 = "INSERT INTO link_accounts VALUES ($new_id+1,'$head_of_account','$opening_balance_date','$opening_balance')";
		$run1 = mysqli_query($ob->connect(),$sql1);

		header("location:frm_add_accounts.php");
	}
	
mysqli_close($ob->connect()); 
?>
		

