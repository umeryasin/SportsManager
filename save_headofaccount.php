<?php
session_start();
//include('connect.php');
include 'conn.php';
$ob=new conn;
if (isset($_POST['save'])){

$head_of_account	= $_POST['Head_Of_Account_Title'];
$account_type 		= $_POST['Account_Type'];

$sql1 = "SELECT * FROM `charts_of_account` WHERE Head_Of_Account_Title='$head_of_account'";
$result = mysqli_query($ob->connect(),$sql1);
	
		echo "<script>
			alert('Head Of Account Name Already Exists');
			window.location = 'frm_chart_of_account.php'
		    </script>";
		 
		    $maximum_record = "SELECT max(Head_Of_Account_ID) FROM charts_of_accounts";

		$existing_record = mysqli_query($ob->connect(),$maximum_record);

		 $existing_id = mysqli_fetch_array($existing_record);
		
		$new_id = $existing_id['max(Head_Of_Account_ID)'];

		$sql = "INSERT INTO charts_of_accounts VALUES ($new_id+1,'$head_of_account','$account_type')";
		$run=mysqli_query($ob->connect(),$sql);
		header("location:frm_charts_of_account.php");
	}
	
mysqli_close($ob->connect()); 
?>
		

