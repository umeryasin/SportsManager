<?php
include 'conn.php';
$ob=new conn;

if(isset($_POST['customer_name_save']))
{
	$cus_name=$_POST['customer_name_save'];
	$cus_phone_no=$_POST['customer_phone_save'];
	$cus_gender=$_POST['customer_gender'];
	//////////////////
	$sql_inv="SELECT IFNULL(MAX(Customer_ID),0)+1 AS Customer_ID FROM customer";
          $run_inv=mysqli_query($ob->connect(),$sql_inv);
          $new_inv=mysqli_fetch_array($run_inv);
          $new_inv2=$new_inv['Customer_ID'];
    //////////////////
    $sql="INSERT INTO `customer`(`Customer_ID`, `Customer_Name`, `Gender_ID`, `Contact_No`) VALUES ('$new_inv2', '$cus_name', '$cus_gender','$cus_phone_no')";
    $run=mysqli_query($ob->connect(),$sql);
    echo $new_inv2;
}
?>