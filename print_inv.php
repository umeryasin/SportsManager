<?php
include 'conn.php';
$ob=new conn;

	$inv_id=$_POST['invoice_id'];
	$inv_type_id=$_POST['invoice_type_id'];
	$payment_mode_id=$_POST['payment_mode_id'];
	$inv_date=$_POST['invoice_date'];
	$customer_id=$_POST['customer_id'];
	$inv_total=$_POST['total'];
	$inv_discount=$_POST['discount'];
	$inv_grand_total=$_POST['grand_total'];
	$time=$_POST['strTime'];

	$sql_insert="INSERT INTO `invoice_master`(`Invoice_No`, `Invoice_Type_ID`, `Payment_Mode_ID`, `Customer_ID`, `Date`, `Master_Total`, `GrandTotal`, `Discount`, `Time`) VALUES ('$inv_id','$inv_type_id','$payment_mode_id','$customer_id','$inv_date','$inv_total','$inv_grand_total','$inv_discount','$time')";
	$run_insert=mysqli_query($ob->connect(),$sql_insert);
	
///////////////////////////
	$sql_sale="INSERT INTO `sales_master`(`Sales_No`, `Invoice_No`, `Invoice_Type_ID`, `Payment_Mode_ID`, `Customer_ID`, `Date`, `Master_Total`, `GrandTotal`, `Discount`, `Time`) VALUES ('$inv_id','$inv_id','$inv_type_id','$payment_mode_id','$customer_id','$inv_date','$inv_total','$inv_grand_total','$inv_discount','$time')";
	$run_sale=mysqli_query($ob->connect(),$sql_sale);
	if($run_insert && $sql_sale)
		echo "invoice master & sales master done";
//////////////////////////
	$sql_select="SELECT * FROM customer WHERE Customer_ID=$customer_id ";
	$run_select=mysqli_query($ob->connect(),$sql_select);
	$row_select=mysqli_fetch_array($run_select);
	$max_quan=$row_select['Total_Spent'];
	$get_quan=$max_quan+$inv_grand_total;
////////////////////////////
	$sql_cus="UPDATE `customer` SET `Total_Spent`='$get_quan' WHERE Customer_ID=$customer_id ";
	$run_cus=mysqli_query($ob->connect(),$sql_cus);


// Accounts Works //

$accounts_title = "SELECT Account_Title_ID FROM `account_title` WHERE Account_Title = 'Sales A/c'";
$run_account=mysqli_query($ob->connect(),$accounts_title);
$row_account=mysqli_fetch_array($run_account);
$new_title_ID=$row_account['Account_Title_ID'];
//echo $new_title_ID;
//exit();

$accounts_title1 = "SELECT Count(Account_Title_ID) as count_ID FROM `link_accounts` AS LA WHERE LA.Account_Title_ID = '$new_title_ID' AND LA.Account_Date = '$inv_date'";
$run_account1=mysqli_query($ob->connect(),$accounts_title1);
$row_account1=mysqli_fetch_array($run_account1);
$count_ID=$row_account1['count_ID'];
//echo $accounts_title1;
//exit();

//////////////////////////////////////////////////

if($count_ID==0){
$sql1="INSERT INTO `link_accounts`(`Account_Title_ID`, `Head_Of_Account_ID`, `Account_Date`, `Amount`) VALUES ('$new_title_ID',8,'$inv_date','$inv_grand_total')";
$run1=mysqli_query($ob->connect(),$sql1);}
else{
	$accounts_title1 = "SELECT Amount FROM `link_accounts` WHERE Account_Title_ID = '$new_title_ID' AND Account_Date = '$inv_date'";
	$run_account1=mysqli_query($ob->connect(),$accounts_title1);
	$row_account1=mysqli_fetch_array($run_account1);
	$Amount=$row_account1['Amount'];

	$Amount = $Amount + $inv_grand_total;

	$sql1="UPDATE `link_accounts` SET `Amount`= $Amount WHERE Account_Title_ID = '$new_title_ID' AND Account_Date = '$inv_date'";
//echo $sql1;
//exit();
$run1=mysqli_query($ob->connect(),$sql1);

}
///////////////////////////////////////////////////////

$sql_master = "SELECT IFNULL(MAX(Voucher_ID),0)+1 AS Voucher_ID FROM general_journal_master";
$master_query = mysqli_query($ob->connect(),$sql_master);
$master_run = mysqli_fetch_array($master_query);
$master_row = $master_run['Voucher_ID'];

$current_date = date('Y-m-d');

$insert_master = "INSERT INTO `general_journal_master`(`Voucher_ID`, `Transaction_Date`, `Memo_No`, `Is_Adjustment`, `Description`) VALUES ('$master_row','$current_date',0,0,'Paid through Invoice # $inv_id')";
$insert_query = mysqli_query($ob->connect(),$insert_master);

$sql_master1 = "SELECT IFNULL(MAX(General_Journal_Detail_ID),0)+1 AS General_Journal_Detail_ID FROM general_journal_detail";
$master_query1 = mysqli_query($ob->connect(),$sql_master1);
$master_run1 = mysqli_fetch_array($master_query1);
$master_row1 = $master_run1['General_Journal_Detail_ID'];

//Update the Cash A/c
//if payment mode is cash
if($payment_mode_id==1)
{
	$sql2 = "SELECT IFNULL(Balance,0) AS Cash_Balance FROM general_journal_detail WHERE Account_Title_ID = 14 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";
$detail_query2 = mysqli_query($ob->connect(),$sql2);
$detail_run2 = mysqli_fetch_array($detail_query2);
$cash_balance = $detail_run2['Cash_Balance'];
//print_r($cash_balance);
//exit();

$new_balance = $cash_balance + $inv_grand_total;

$insert_detail = "INSERT INTO `general_journal_detail`(`General_Journal_Detail_ID`, `Voucher_ID`, `Account_Title_ID`, `Entry_Type_ID`, `Amount`,`Balance`) VALUES ('$master_row1','$master_row',14,0,'$inv_grand_total','$new_balance')";
$insert_query = mysqli_query($ob->connect(),$insert_detail);

$sql3 = "SELECT * FROM link_accounts AS LA WHERE LA.Account_Title_ID = 14";
		//print_r($sql3);
		//exit();

		$query3 = mysqli_query($ob->connect(),$sql3);
		$row3 = mysqli_fetch_array($query3);

		$amount = $row3['Amount'];
		$amount = $amount + $inv_grand_total;

		$new_link = "UPDATE link_accounts SET Amount = $amount WHERE Account_Title_ID = 14";
		$new_run  = mysqli_query($ob->connect(),$new_link);
}
//if payment mode is Bank
elseif($payment_mode_id==2)
{
	$sql2 = "SELECT IFNULL(Balance,0) AS Cash_Balance FROM general_journal_detail WHERE Account_Title_ID = 44 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";
$detail_query2 = mysqli_query($ob->connect(),$sql2);
$detail_run2 = mysqli_fetch_array($detail_query2);
$cash_balance = $detail_run2['Cash_Balance'];
//print_r($cash_balance);
//exit();

$new_balance = $cash_balance + $inv_grand_total;

$insert_detail = "INSERT INTO `general_journal_detail`(`General_Journal_Detail_ID`, `Voucher_ID`, `Account_Title_ID`, `Entry_Type_ID`, `Amount`,`Balance`) VALUES ('$master_row1','$master_row',44,0,'$inv_grand_total','$new_balance')";
$insert_query = mysqli_query($ob->connect(),$insert_detail);

$sql3 = "SELECT * FROM link_accounts AS LA WHERE LA.Account_Title_ID = 44";
		//print_r($sql3);
		//exit();

		$query3 = mysqli_query($ob->connect(),$sql3);
		$row3 = mysqli_fetch_array($query3);

		$amount = $row3['Amount'];
		$amount = $amount + $inv_grand_total;

		$new_link = "UPDATE link_accounts SET Amount = $amount WHERE Account_Title_ID = 44";
		$new_run  = mysqli_query($ob->connect(),$new_link);
}

//////////////////////////////////////////////

		/*$sql_stock1 = "SELECT IFNULL(MAX(General_Journal_Detail_ID),0)+1 AS General_Journal_Detail_ID FROM general_journal_detail";
$stock_query1 = mysqli_query($ob->connect(),$sql_stock1);
$stock_run1 = mysqli_fetch_array($stock_query1);
$stock_row1 = $stock_run1['General_Journal_Detail_ID'];

$stock2 = "SELECT IFNULL(Balance,0) AS Cash_Balance FROM general_journal_detail WHERE Account_Title_ID = 31 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";
$stock_query2 = mysqli_query($ob->connect(),$stock2);
$stock_run2 = mysqli_fetch_array($stock_query2);
$stock_balance = $stock_run2['Cash_Balance'];
//print_r($cash_balance);
//exit();

$new_stock = $stock_balance + $inv_total;


$insert_stock = "INSERT INTO `general_journal_detail`(`General_Journal_Detail_ID`, `Voucher_ID`, `Account_Title_ID`, `Entry_Type_ID`, `Amount`,`Balance`) VALUES ('$stock_row1','$master_row',31,1,'$inv_total','$new_stock')";
$stock_query = mysqli_query($ob->connect(),$insert_stock);

$stock3 = "SELECT * FROM link_accounts AS LA WHERE LA.Account_Title_ID = 31";
		//print_r($sql3);
		//exit();

		$stock_query3 = mysqli_query($ob->connect(),$stock3);
		$row_stock3 = mysqli_fetch_array($stock_query3);

		$amount4 = $row_stock3['Amount'];
		$amount4 = $amount4 + $inv_total;

		$new_link4 = "UPDATE link_accounts SET Amount = $amount4 WHERE Account_Title_ID = 31";
		$new_run4  = mysqli_query($ob->connect(),$new_link4);*/

//////////////////////////////////////////////////

		$discount_master1 = "SELECT IFNULL(MAX(General_Journal_Detail_ID),0)+1 AS General_Journal_Detail_ID FROM general_journal_detail";
$discount_query1 = mysqli_query($ob->connect(),$discount_master1);
$discount_run1 = mysqli_fetch_array($discount_query1);
$discount_row1 = $discount_run1['General_Journal_Detail_ID'];

$discount2 = "SELECT IFNULL(Balance,0) AS Cash_Balance FROM general_journal_detail WHERE Account_Title_ID = 39 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";
$discount_query2 = mysqli_query($ob->connect(),$discount2);
$discount_run2 = mysqli_fetch_array($discount_query2);
$cash_balance2 = $discount_run2['Cash_Balance'];
//print_r($cash_balance);
//exit();

$new_balance2 = $cash_balance2 + $inv_discount;

if($inv_discount>0){
$insert_discount = "INSERT INTO `general_journal_detail`(`General_Journal_Detail_ID`, `Voucher_ID`, `Account_Title_ID`, `Entry_Type_ID`, `Amount`,`Balance`) VALUES ('$discount_row1','$master_row',39,0,'$inv_discount','$new_balance2')";
$sales_query = mysqli_query($ob->connect(),$insert_discount);
}

$discount3 = "SELECT * FROM link_accounts AS LA WHERE LA.Account_Title_ID = 39";
		//print_r($sql3);
		//exit();

		$query_discount3 = mysqli_query($ob->connect(),$discount3);
		$row_discount3 = mysqli_fetch_array($query_discount3);

		$amount2 = $row_discount3['Amount'];
		$amount2 = $amount2 + $inv_discount;

		$new_link2 = "UPDATE link_accounts SET Amount = $amount2 WHERE Account_Title_ID = 39";
		$new_run2  = mysqli_query($ob->connect(),$new_link2);

/////////////////////////////////////////////////////

		$sales_master1 = "SELECT IFNULL(MAX(General_Journal_Detail_ID),0)+1 AS General_Journal_Detail_ID FROM general_journal_detail";
$sales_query1 = mysqli_query($ob->connect(),$sales_master1);
$sales_run1 = mysqli_fetch_array($sales_query1);
$sales_row1 = $sales_run1['General_Journal_Detail_ID'];

$sales2 = "SELECT IFNULL(Balance,0) AS Cash_Balance FROM general_journal_detail WHERE Account_Title_ID = 1 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";
$sales_query2 = mysqli_query($ob->connect(),$sales2);
$sales_run2 = mysqli_fetch_array($sales_query2);
$cash_balance1 = $sales_run2['Cash_Balance'];
//print_r($cash_balance);
//exit();

$new_balance1 = $cash_balance1 + $inv_total;


$insert_sales = "INSERT INTO `general_journal_detail`(`General_Journal_Detail_ID`, `Voucher_ID`, `Account_Title_ID`, `Entry_Type_ID`, `Amount`,`Balance`) VALUES ('$sales_row1','$master_row',1,1,'$inv_total','$new_balance1')";
$sales_query = mysqli_query($ob->connect(),$insert_sales);

$sales3 = "SELECT * FROM link_accounts AS LA WHERE LA.Account_Title_ID = 1";
		//print_r($sql3);
		//exit();

		$query_sales3 = mysqli_query($ob->connect(),$sales3);
		$row_sales3 = mysqli_fetch_array($query_sales3);

		$amount1 = $row_sales3['Amount'];
		$amount1 = $amount1 + $inv_total;

		$new_link1 = "UPDATE link_accounts SET Amount = $amount1 WHERE Account_Title_ID = 1";
		$new_run1  = mysqli_query($ob->connect(),$new_link1);

/*
$account_title = "SELECT Account_Title_ID FROM `account_title` WHERE Account_Title = 'Discount Allowed A/c'";
$run_accounts=mysqli_query($ob->connect(),$account_title);
$row_accounts=mysqli_fetch_array($run_accounts);
$new_titles_ID=$row_accounts['Account_Title_ID'];
//echo $new_title_ID;
//exit();

$account_title1 = "SELECT Count(Account_Title_ID) as count_ID FROM `link_accounts` AS LA WHERE LA.Account_Title_ID = '$new_titles_ID' AND LA.Account_Date = '$inv_date'";
$run_accounts1=mysqli_query($ob->connect(),$account_title1);
$row_accounts1=mysqli_fetch_array($run_accounts1);
$counts_ID=$row_accounts1['count_ID'];
//echo $accounts_title1;
//exit();

//////////////////////////////////////////////////

if($counts_ID==0){
$sqls1="INSERT INTO `link_accounts`(`Account_Title_ID`, `Head_Of_Account_ID`, `Account_Date`, `Amount`) VALUES ('$new_titles_ID',3,'$inv_date','$inv_discount')";
$runs1=mysqli_query($ob->connect(),$sqls1);}
else{
	$account_title1 = "SELECT Amount FROM `link_accounts` WHERE Account_Title_ID = '$new_titles_ID' AND Account_Date = '$inv_date' ";
	$run_accounts1=mysqli_query($ob->connect(),$account_title1);
	$row_accounts1=mysqli_fetch_array($run_accounts1);
	$Discount=$row_accounts1['Amount'];

	$Discount = $Discount + $inv_discount;

	$sqls1="UPDATE `link_accounts` SET `Amount`= $Discount WHERE Account_Title_ID = '$new_titles_ID' AND Account_Date = '$inv_date'";
//echo $sql1;
//exit();
$runs1=mysqli_query($ob->connect(),$sqls1);

}*/
?>