<?php
include 'conn.php';
$ob=new conn;

if(isset($_POST['customer_id']))
{
	$customer_id=$_POST['customer_id'];
	$sql="DELETE FROM customer WHERE Customer_ID=$customer_id";
	$run=mysqli_query($ob->connect(),$sql);
	if($run)
		echo "Customer Deleted";
}
?>