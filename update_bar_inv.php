<?php
include 'conn.php';
$ob=new conn;
error_reporting(0);
if (isset($_POST['id']))
{
	$barcode=$_POST['id'];
	$sql="SELECT * FROM product_master WHERE Barcode_ID='$barcode'";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Product_Name'];
}

if (isset($_POST['p_name']))
{
	$barcode=$_POST['p_name'];/*
	$sql="SELECT SUM(Product_Quantity) AS Product_Quantity FROM product_stock WHERE Barcode_ID='$barcode' ";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Product_Quantity'];*/
	$net_quantity=0;
	$sql_s="SELECT SUM(Product_Quantity) AS Product_Quantity FROM product_stock WHERE Barcode_ID=$barcode GROUP BY Barcode_ID";
                  $run_s=mysqli_query($ob->connect(),$sql_s);
                  $row_s=mysqli_fetch_array($run_s);
                  $pro_qunatity=$row_s['Product_Quantity'];


                  $sql_ss="SELECT SUM(Quantity) AS Quantity FROM invoicedetails WHERE Barcode_ID=$barcode GROUP BY Barcode_ID";
                  $run_ss=mysqli_query($ob->connect(),$sql_ss);
                  $row_ss=mysqli_fetch_array($run_ss);
                  $pro_sale_quantity=$row_ss['Quantity'];

                  $sql_sss="SELECT SUM(Quantity) AS Quantity FROM sales_return_detail WHERE Barcode_ID=$barcode GROUP BY Barcode_ID";
                  $run_sss=mysqli_query($ob->connect(),$sql_sss);
                  $row_sss=mysqli_fetch_array($run_sss);
                  $return_q=$row_sss['Quantity'];


                  $net_quantity=$pro_qunatity-$pro_sale_quantity+$return_q;
                  echo $net_quantity;

}
if (isset($_POST['retail_price']))
{
	$barcode=$_POST['retail_price'];
	$sql="SELECT * FROM product_price WHERE Barcode_ID='$barcode' ORDER BY Product_Price_ID DESC LIMIT 1";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Retail_Price'];
}
if (isset($_POST['purchase_price']))
{
	$barcode=$_POST['purchase_price'];
	$sql="SELECT * FROM product_price WHERE Barcode_ID='$barcode' ORDER BY Product_Price_ID DESC LIMIT 1";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Purchase_Price'];
}

if (isset($_POST['individual_discount']))
{
	$barcode=$_POST['individual_discount'];
	$sql="SELECT * FROM product_price WHERE Barcode_ID='$barcode' ORDER BY Product_Price_ID DESC LIMIT 1";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Product_Discount'];
}

////////////////////////////////////
if (isset($_POST['select_bar']))
{
	$barcode=$_POST['select_bar'];
	$sql="SELECT * FROM product_master WHERE Barcode_ID= '$barcode' OR Product_Name='$barcode' ";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Barcode_ID'];
}

if (isset($_POST['select_price']))
{
	$barcode=$_POST['select_price'];
	$sql="SELECT * FROM product_price,product_master WHERE product_price.Barcode_ID= '$barcode' OR product_master.Product_Name='$barcode' ORDER BY Product_Price_ID DESC LIMIT 1";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Retail_Price'];
}
if (isset($_POST['select_price_pr']))
{
	$barcode=$_POST['select_price_pr'];
	$sql="SELECT * FROM product_price,product_master WHERE product_price.Barcode_ID= '$barcode' OR product_master.Product_Name='$barcode' ORDER BY Product_Price_ID DESC LIMIT 1";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Purchase_Price'];
}

if (isset($_POST['Select_Cat']))
{
	$barcode=$_POST['Select_Cat'];
	$sql="SELECT * FROM product_master AS PM, productunit AS PU WHERE PM.Product_Unit_Id=PU.Product_Unit_Id AND Barcode_ID=$barcode";
	$run=mysqli_query($ob->connect(),$sql);
	$row=mysqli_fetch_array($run);
	echo $row['Product_Unit'];
	if($row['Product_Unit']=='')
		echo "Qty";
}




?>