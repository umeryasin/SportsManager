<?php
session_start();
//include('connect.php');
$conn = mysqli_connect("localhost","root","","db_pointofsale");
if (isset($_POST['save'])){

$account_name	= $_POST['txt_account_name'];
$account_type   = $_POST['select_head_of_accounts'];
$balance_type	= $_POST['select_balance_type_info'];
$description	= $_POST['txt_description'];
$sql1 = "SELECT * FROM `chartofaccounts` WHERE Accounts_Name='$account_name' ";
$result = mysqli_query($conn,$sql1);
	if(mysqli_num_rows($result)>0)
	{
		echo "<script>
			alert('Account Name Already Exists');
			window.location = 'frm_chart_of_accounts.php'
		    </script>";
	}
	else
	{
		if($account_type=="---Select Type---")
			$account_type=0;
		else if($account_type=="Income")
			$account_type=1;
		else if($account_type=="Expenses")
			$account_type=2;
		else if($account_type=="Laibilities")
			$account_type=3;
		else if($account_type=="Assests")
			$account_type=4;
		else if($account_type=="Equity")
			$account_type=5;


		if($balance_type=="Balance")
			$balance_type=1;
		else if($balance_type=="Bank Balance")
			$balance_type=2;

		$maximum_record = "SELECT max(Accounts_Id) FROM chartofaccounts";

		$existing_record = mysqli_query($this->connect(),$maximum_record);

		 $existing_id = mysqli_fetch_array($existing_record);
		
		$new_id = $existing_id['max(Accounts_Id)'];
		 
		$sql = "INSERT INTO `chartofaccounts`(`Accounts_Id`, `Accounts_Name`, `HeadOfAccounts_Id`, `BalanceType_Id`,`Description`) VALUES ($new_id+1,'$account_name','$account_type','$balance_type','$description') ";
		$run=mysqli_query($conn,$sql);
		header("location:frm_chart_of_accounts.php");
	}
	}
mysqli_close($conn); 
?>
		

