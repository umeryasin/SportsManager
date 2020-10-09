<?php
session_start();
//include('connect.php');
include 'conn.php';
$ob=new conn;

if (isset($_POST['save'])){

$voucher_id 		= $_POST['Voucher_ID'];
$transaction_date	= $_POST['Transaction_Date'];
$memo_no 			= $_POST['Memo_No'];
$is_adjustment 		= $_POST['Is_Adjustment'];
$account_ID1 		= $_POST['Account_Title_ID1'];
$debit_amount1 		= $_POST['Debit1'];
$credit_amount1 	= $_POST['Credit1'];
$account_ID2 		= $_POST['Account_Title_ID2'];
$debit_amount2 		= $_POST['Debit2'];
$credit_amount2 	= $_POST['Credit2'];
$description 		= $_POST['Description'];
$Detail_ID 			= $_POST['Detail_ID'];


		$sql = "INSERT INTO general_journal_master VALUES ('$voucher_id','$transaction_date','$memo_no','$is_adjustment','$description') ";
		
		$run=mysqli_query($ob->connect(),$sql);

		
		$result = "SELECT IFNULL(Balance,0) as Balance FROM General_Journal_Detail as G, Account_Title as A Where G.Account_Title_ID = A.Account_Title_ID and G.Account_Title_ID = $account_ID1 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";

		$query1 = mysqli_query($ob->connect(),$result);
		$row1 = mysqli_fetch_array($query1);

		$balance = $row1['Balance'];

		$new_balance = $balance + $debit_amount1;

		$sql1 = "INSERT INTO General_Journal_Detail VALUES ('$Detail_ID','$voucher_id','$account_ID1','0','$debit_amount1','$new_balance') ";

		$run1=mysqli_query($ob->connect(),$sql1);

		$result1 = "SELECT IFNULL(Balance,0) as Balance FROM General_Journal_Detail as G, Account_Title as A Where G.Account_Title_ID = A.Account_Title_ID and G.Account_Title_ID = $account_ID2 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";

		$query2 = mysqli_query($ob->connect(),$result1);
		$row2 = mysqli_fetch_array($query2);

		$balance1 = $row2['Balance'];
		
		
		$new_balance1 =  $balance1 - $credit_amount2;

		$sql2 = "INSERT INTO General_Journal_Detail VALUES ('$Detail_ID'+1,'$voucher_id','$account_ID2','1','$credit_amount2','$new_balance1') ";
		
		$run2=mysqli_query($ob->connect(),$sql2);

		$sql3 = "SELECT * FROM link_accounts AS LA, Account_Title AS A WHERE LA.Account_Title_ID = A.Account_Title_ID AND A.Account_Title_ID = $account_ID1";
		//print_r($sql3);
		//exit();

		$query3 = mysqli_query($ob->connect(),$sql3);
		$row3 = mysqli_fetch_array($query3);

		$amount = $row3['Amount'];
		$amount = $amount + $debit_amount1;

		$new_link = "UPDATE link_accounts SET Amount = $amount WHERE Account_Title_ID = $account_ID1";
		$new_run  = mysqli_query($ob->connect(),$new_link);

		$sql4 = "SELECT * FROM link_accounts AS LA, Account_Title AS A WHERE LA.Account_Title_ID = A.Account_Title_ID AND A.Account_Title_ID = $account_ID2";
		$query4 = mysqli_query($ob->connect(),$sql4);
		$row4 = mysqli_fetch_array($query4);

		

		$amount1 = $row4['Amount'];
		$amount1 = $amount1 + $credit_amount2;



		$new_link1 = "UPDATE link_accounts SET Amount = $amount1 WHERE Account_Title_ID = $account_ID2";
		$new_run1  = mysqli_query($ob->connect(),$new_link1);

		header("location:frm_add_voucher.php");
	 }
	
mysqli_close($ob->connect()); 
?>
		

