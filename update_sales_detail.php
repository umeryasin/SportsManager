<?php
include 'conn.php';
$ob=new conn;
/////////////////

$barcode_list=$_POST['barcode_list'];
$quantity_list=$_POST['quantity_list'];
$return_list=$_POST['return_list'];
$sub_total_list=$_POST['sub_total_list'];
$inv_nn=$_POST['inv_nn'];

$sales_new=$_POST['sales_new'];

///////////////
$s="SELECT * FROM sales_detail WHERE Sales_No=$inv_nn AND Barcode_ID=$barcode_list";
	$r=mysqli_query($ob->connect(),$s);
	$f=mysqli_fetch_array($r);
	$ex_q=$f['Return_Quantity'];
	$new_q=$ex_q + $return_list;
//////////////

$slt="SELECT * FROM sales_return_detail WHERE Sales_Return_No=$sales_new AND Barcode_ID=$barcode_list AND Quantity=$return_list";
$slt_run=mysqli_query($ob->connect(),$slt);
$slt_fetch=mysqli_fetch_array($slt_run);

if($slt_fetch['Sales_Return_No']==$sales_new && $slt_fetch['Barcode_ID']==$barcode_list &&  $slt_fetch['Quantity']== $return_list)
{
	
	///////////
	$sql_up="UPDATE `sales_detail` SET `Quantity`=$quantity_list, `Return_Quantity`=$new_q, `Detail_Total`=$sub_total_list WHERE Sales_No=$inv_nn AND Barcode_ID=$barcode_list";
	$run_up=mysqli_query($ob->connect(),$sql_up);
}
else
{
	//$sales_new=$sales_new+1;
	$sql_no="INSERT INTO `sales_return_detail`(`Sales_Return_No`, `Barcode_ID`, `Quantity`, `Sub_Total`) VALUES ('$sales_new','$barcode_list','$return_list','$sub_total_list')";
	$run_no=mysqli_query($ob->connect(),$sql_no);

	$sql_up="UPDATE `sales_detail` SET `Quantity`=$quantity_list, `Return_Quantity`=$new_q, `Detail_Total`=$sub_total_list WHERE Sales_No=$inv_nn AND Barcode_ID=$barcode_list";
	$run_up=mysqli_query($ob->connect(),$sql_up);
	

	/*$select="SELECT Quantity FROM product WHERE Barcode_ID=$barcode_list";
	$select_run=mysqli_query($ob->connect(),$select);
	$select_fetch=mysqli_fetch_array($select_run);
	$select_row=$select_fetch['Quantity'];
	$select_new=$select_row+$quantity_list;

	$qn="UPDATE `product` SET `Quantity`='$select_new' WHERE Barcode_ID=$barcode_list";
	$rn=mysqli_query($ob->connect(),$qn);*/

	if($run_no)
		echo "Sales Return Detail Done";
}

?>