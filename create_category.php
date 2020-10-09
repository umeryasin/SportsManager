<?php
if(isset($_POST['create_cate']))
{
	$cate_name=$_POST['cate_name'];
	include 'connect.php';
	include 'auth.php';
  	include 'conn.php';
	$ob=new conn;
	$sql_get_max_id="SELECT MAX(Product_Category_ID) FROM productcategory";
	$run_get_max_id=mysqli_query($ob->connect(),$sql_get_max_id);
	$row_get_max_id=mysqli_fetch_assoc($run_get_max_id);
	$max_id=$row_get_max_id['MAX(Product_Category_ID)']+1;
	$sql="INSERT INTO `productcategory`(`Product_Category_ID`, `Category_Name`) VALUES ($max_id,'$cate_name')";
	$run=mysqli_query($ob->connect(),$sql);
	if($run)
		header('location:frm_create_category.php');
}
?>