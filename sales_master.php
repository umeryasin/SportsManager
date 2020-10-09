<?php
include 'conn.php';
$ob=new conn;
//////////////

$sql="SELECT IFNULL(MAX(Sales_Return_No),0)+1 AS Sales_Return_No FROM sales_return_master";
$run=mysqli_query($ob->connect(),$sql);
$new=mysqli_fetch_array($run);
$sales_no=$new['Sales_Return_No'];

$inv_nn=$_POST['inv_nn'];
$inv_ty_id=$_POST['inv_ty_id'];
$payment_mode_id=$_POST['payment_mode_id'];
$customer_id=$_POST['customer_id'];
$date=$_POST['date'];
$total=$_POST['total'];
$grand_total=$_POST['grand_total'];
$discount=$_POST['discount'];

$date=date_create($date);
$date=date_format($date,"Y-m-d");

$sel_sql="SELECT * FROM sales_return_master WHERE Invoice_No=$inv_nn";
$run_sql=mysqli_query($ob->connect(),$sel_sql);
$row_sql=mysqli_fetch_array($run_sql);
if($row_sql['Invoice_No']==$inv_nn)
{
	$sql_new_up="UPDATE `sales_return_master` SET `Sub_Total`='$total',`GrandTotal`='$grand_total',`Discount`='$discount' WHERE Invoice_No=$inv_nn";
	$run_new_up=mysqli_query($ob->connect(),$sql_new_up);
	/////////////////////////////
	$sql_up="UPDATE `sales_master` SET `Master_Total`='$total',`GrandTotal`='$grand_total',`Discount`='$discount' WHERE Invoice_No=$inv_nn";
		$run_up=mysqli_query($ob->connect(),$sql_up);
}

else{
	$sales_query="INSERT INTO `sales_return_master`(`Sales_Return_No`, `Invoice_No`, `Invoice_Type_ID`, `Payment_Mode_ID`, `Customer_ID`, `Date`, `Sub_Total`, `GrandTotal`, `Discount`) VALUES ('$sales_no','$inv_nn','$inv_ty_id','$payment_mode_id','$customer_id','$date','$total','$grand_total','$discount')";
		$sales_run=mysqli_query($ob->connect(),$sales_query);
		/////////////////////////
		$sql_up="UPDATE `sales_master` SET `Master_Total`='$total',`GrandTotal`='$grand_total',`Discount`='$discount' WHERE Invoice_No=$inv_nn";
		$run_up=mysqli_query($ob->connect(),$sql_up);
}


////////////////////////
if($sales_run)
	echo "Sales Master".$date;

/////////////////////////////////////////////

/*$sql_master = "SELECT IFNULL(MAX(Voucher_ID),0)+1 AS Voucher_ID FROM general_journal_master";
$master_query = mysqli_query($ob->connect(),$sql_master);
$master_run = mysqli_fetch_array($master_query);
$master_row = $master_run['Voucher_ID'];

$current_date = date('Y-m-d');

/*$insert_master = "INSERT INTO `general_journal_master`(`Voucher_ID`, `Transaction_Date`, `Memo_No`, `Is_Adjustment`, `Description`) VALUES ('$master_row','$current_date',0,0,'')";
$insert_query = mysqli_query($ob->connect(),$insert_master);*/

/*
$sql_master1 = "SELECT IFNULL(MAX(General_Journal_Detail_ID),0)+1 AS General_Journal_Detail_ID FROM general_journal_detail";
$master_query1 = mysqli_query($ob->connect(),$sql_master1);
$master_run1 = mysqli_fetch_array($master_query1);
$master_row1 = $master_run1['General_Journal_Detail_ID'];

$sql2 = "SELECT IFNULL(Balance,0) AS Cash_Balance FROM general_journal_detail WHERE Account_Title_ID = 14 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";
$detail_query2 = mysqli_query($ob->connect(),$sql2);
$detail_run2 = mysqli_fetch_array($detail_query2);
$cash_balance = $detail_run2['Cash_Balance'];
//print_r($cash_balance);
//exit();

$new_balance = $cash_balance - $grand_total;


$update_detail = "UPDATE `general_journal_detail` SET `General_Journal_Detail_ID`='$master_row1',`Voucher_ID`='$master_row',`Account_Title_ID`=14,`Entry_Type_ID`=1,`Amount`='$grand_total',`Balance`='$cash_balance' WHERE General_Journal_Detail_ID = $master_row1";
$update_query = mysqli_query($ob->connect(),$update_detail);*/

$sql3 = "SELECT * FROM link_accounts AS LA WHERE LA.Account_Title_ID = 14";
		//print_r($sql3);
		//exit();

		$query3 = mysqli_query($ob->connect(),$sql3);
		$row3 = mysqli_fetch_array($query3);

		$amount = $row3['Amount'];
		$amount = $amount - $grand_total;

		$new_link = "UPDATE link_accounts SET Amount = $amount WHERE Account_Title_ID = 14";
		$new_run  = mysqli_query($ob->connect(),$new_link);

///////////////////////////////////////////////////////////////////

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


$insert_stock = "INSERT INTO `general_journal_detail`(`General_Journal_Detail_ID`, `Voucher_ID`, `Account_Title_ID`, `Entry_Type_ID`, `Amount`,`Balance`) VALUES ('$stock_row1','$master_row',31,0,'$inv_total','$new_stock')";
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

////////////////////////////////////////////////////////////////

		/*$sales_master1 = "SELECT IFNULL(MAX(General_Journal_Detail_ID),0)+1 AS General_Journal_Detail_ID FROM general_journal_detail";
$sales_query1 = mysqli_query($ob->connect(),$sales_master1);
$sales_run1 = mysqli_fetch_array($sales_query1);
$sales_row1 = $sales_run1['General_Journal_Detail_ID'];

$sales2 = "SELECT IFNULL(Balance,0) AS Cash_Balance FROM general_journal_detail WHERE Account_Title_ID = 1 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";
$sales_query2 = mysqli_query($ob->connect(),$sales2);
$sales_run2 = mysqli_fetch_array($sales_query2);
$cash_balance1 = $sales_run2['Cash_Balance'];
//print_r($cash_balance);
//exit();

$new_balance1 = $cash_balance1 - $total;


$update_sales = "UPDATE `general_journal_detail` SET `General_Journal_Detail_ID`='$sales_row1',`Voucher_ID`='$master_row',`Account_Title_ID`=1,`Entry_Type_ID`=0,`Amount`='$total',`Balance`='$new_balance1' WHERE General_Journal_Detail_ID = $sales_row1";
$sales_update = mysqli_query($ob->connect(),$update_sales);*/

$sales3 = "SELECT * FROM link_accounts AS LA WHERE LA.Account_Title_ID = 1";
		//print_r($sql3);
		//exit();

		$query_sales3 = mysqli_query($ob->connect(),$sales3);
		$row_sales3 = mysqli_fetch_array($query_sales3);

		$amount1 = $row_sales3['Amount'];
		$amount1 = $amount1 - $total;

		$new_link1 = "UPDATE link_accounts SET Amount = $amount1 WHERE Account_Title_ID = 1";
		$new_run1  = mysqli_query($ob->connect(),$new_link1);

////////////////////////////////////////////////////////////////

		/*$discount_master1 = "SELECT IFNULL(MAX(General_Journal_Detail_ID),0)+1 AS General_Journal_Detail_ID FROM general_journal_detail";
$discount_query1 = mysqli_query($ob->connect(),$discount_master1);
$discount_run1 = mysqli_fetch_array($discount_query1);
$discount_row1 = $discount_run1['General_Journal_Detail_ID'];

$discount2 = "SELECT IFNULL(Balance,0) AS Cash_Balance FROM general_journal_detail WHERE Account_Title_ID = 39 ORDER BY General_Journal_Detail_ID DESC LIMIT 1";
$discount_query2 = mysqli_query($ob->connect(),$discount2);
$discount_run2 = mysqli_fetch_array($discount_query2);
$cash_balance2 = $discount_run2['Cash_Balance'];
//print_r($cash_balance);
//exit();

$new_balance2 = $cash_balance2 - $discount;


$update_discount = "UPDATE `general_journal_detail` SET `General_Journal_Detail_ID`='$discount_row1',`Voucher_ID`='$master_row',`Account_Title_ID`=39,`Entry_Type_ID`=1,`Amount`='$discount',`Balance`='$new_balance2' WHERE General_Journal_Detail_ID = $discount_row1";
$discount_query = mysqli_query($ob->connect(),$update_discount);*/

$discount3 = "SELECT * FROM link_accounts AS LA WHERE LA.Account_Title_ID = 39";
		//print_r($sql3);
		//exit();

		$query_discount3 = mysqli_query($ob->connect(),$discount3);
		$row_discount3 = mysqli_fetch_array($query_discount3);

		$amount2 = $row_discount3['Amount'];
		$amount2 = $amount2 - $inv_discount;

		$new_link2 = "UPDATE link_accounts SET Amount = $amount2 WHERE Account_Title_ID = 39";
		$new_run2  = mysqli_query($ob->connect(),$new_link2);
?>