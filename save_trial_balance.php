<?php
session_start();
//include('connect.php');
$conn = mysqli_connect("localhost","root","","db_pointofsale");

$trial_date 	= date('Y-m-d');
$Trial_ID 		= $_POST['Trial_ID'];
		
		$sql1 = "SELECT DISTINCT Account_Title_ID FROM General_Journal_Detail AS GD, General_Journal_Master AS GM WHERE GD.Voucher_ID = GM.Voucher_ID AND GM.Transaction_Date <= '$trial_date'";
		//print_r($sql1);
		//exit();
		$sql = "DELETE FROM Trial_Balance";
		$query = mysqli_query($conn,$sql);

		$query1 = mysqli_query($conn,$sql1);
		
		for($i=0; $row = mysqli_fetch_array($query1); $i++){

			$account_title_id = $row['Account_Title_ID'];

		$sql2 = "SELECT Balance FROM General_Journal_Detail WHERE Account_Title_ID = $account_title_id Order By General_Journal_Detail_ID DESC LIMIT 1";
		
		$query2 = mysqli_query($conn,$sql2);
		
		$row2 = mysqli_fetch_array($query2);

		$Balance = $row2['Balance'];

		if ($Balance<0)
			$Balance = $Balance * -1.0;

		$result3 = "SELECT C.Entry_Type_ID FROM account_title AS A, charts_of_accounts AS C WHERE A.Head_Of_Account_ID = C.Head_Of_Account_ID AND A.Account_Title_ID = $account_title_id";
		print_r($result3);

		$query3 = mysqli_query($conn,$result3);

		$row3 = mysqli_fetch_array($query3);

		$Entry_Type_id = $row3['Entry_Type_ID'];
		
		$sql = "INSERT INTO Trial_Balance VALUES ('$Trial_ID'+1,'$trial_date','$account_title_id','$Entry_Type_id','$Balance')";

		$run = mysqli_query($conn,$sql);

		$Trial_ID = $Trial_ID+1;

		} //For Loop Close
		//exit();

		$sql3 = "SELECT * FROM link_accounts WHERE Account_Title_ID >= 40 AND Account_Title_ID <= 43 ";
		$query4 = mysqli_query($conn,$sql3);

		for($i=0; $run3 = mysqli_fetch_array($query4); $i++){

			$account_title_id = $run3['Account_Title_ID'];
			$amount = $run3['Amount'];

			if ($account_title_id == 40) {
				$sql = "INSERT INTO Trial_Balance VALUES ('$Trial_ID'+1,'$trial_date',40,0,'$amount')";
			}else if ($account_title_id == 41) {
				$sql = "INSERT INTO Trial_Balance VALUES ('$Trial_ID'+1,'$trial_date',41,1,'$amount')";
			}else if ($account_title_id == 42) {
			$sql = "INSERT INTO Trial_Balance VALUES ('$Trial_ID'+1,'$trial_date',42,0,'$amount')";
			}else
			$sql = "INSERT INTO Trial_Balance VALUES ('$Trial_ID'+1,'$trial_date',43,0,'$amount')";

		$run = mysqli_query($conn,$sql);

		$Trial_ID = $Trial_ID+1;
		}

		
		header("location:frm_trial_balance.php");	
		mysqli_close($conn); 
		?>