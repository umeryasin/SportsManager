<?php
include 'conn.php';
$ob=new conn;
$current_date=date("Y-m-d");

if(isset($_POST['code_list']))
{
	$code_list=$_POST['code_list'];
	$name_list=$_POST['name_list'];
	$pro_price_list=$_POST['pro_price_list'];
	$quantity_list=$_POST['quantity_list'];
	$vendor_id=$_POST['vendor_id'];

	/////////////////
			$sel_ac_41_sql="SELECT * FROM link_accounts WHERE Account_Title_ID=41";
			$sel_ac_41_run=mysqli_query($ob->connect(),$sel_ac_41_sql);
			$sel_ac_41_row=mysqli_fetch_array($sel_ac_41_run);
			$amount_41=$sel_ac_41_row['Amount'];
			$amount_41=$amount_41 + ($pro_price_list * $quantity_list);

			$up_41_sql="UPDATE `link_accounts` SET `Account_Date`='$current_date',`Amount`='$amount_41' WHERE Account_Title_ID=41";
			$up_41_run=mysqli_query($ob->connect(),$up_41_sql);

			$sel_ac_42_sql="SELECT * FROM link_accounts WHERE Account_Title_ID=42";
			$sel_ac_42_run=mysqli_query($ob->connect(),$sel_ac_42_sql);
			$sel_ac_42_row=mysqli_fetch_array($sel_ac_42_run);
			$amount_42=$sel_ac_42_row['Amount'];
			$amount_42=$amount_42 + ($pro_price_list * $quantity_list);

			$up_42_sql="UPDATE `link_accounts` SET `Account_Date`='$current_date',`Amount`='$amount_42' WHERE Account_Title_ID=42";
			$up_42_run=mysqli_query($ob->connect(),$up_42_sql);

	////////////////
		$select_s_sql="SELECT * FROM product_stock WHERE Barcode_ID=$code_list AND Product_Stock_Date='$current_date' AND Vendor_ID=$vendor_id";
		$select_s_run=mysqli_query($ob->connect(),$select_s_sql);
		$select_s_row=mysqli_fetch_array($select_s_run);

		////////
		if($select_s_row['Product_Stock_Date'] == $current_date && $vendor_id== $select_s_row['Vendor_ID'])
		{
			$ex_stock=$select_s_row['Product_Quantity'];
			$new_stock=$ex_stock + $quantity_list;

			$sql_pup="UPDATE `product_stock` SET `Product_Quantity`='$new_stock',`Product_Stock_Date`='$current_date' WHERE Barcode_ID=$code_list AND Product_Stock_Date='$current_date' AND Vendor_ID=$vendor_id";
			//echo $sql_pup;
			$run_pup=mysqli_query($ob->connect(),$sql_pup);
				
		}
		else
		{
			$sql_pup="INSERT INTO `product_stock`(`Barcode_ID`, `Product_Quantity`, `Product_Stock_Date`, `Vendor_ID`) VALUES ('$code_list','$quantity_list','$current_date','$vendor_id')";
			$run_pup=mysqli_query($ob->connect(),$sql_pup);
		}
		echo "Completed Times";

}
?>