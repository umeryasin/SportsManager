<?php
include 'connect.php';
include 'auth.php';
include 'conn.php';
$ob=new conn;
$id=$_GET['id'];
$sql="DELETE FROM productcategory WHERE Product_Category_ID=$id";
$run=mysqli_query($ob->connect(),$sql);
if($run)
	header('location:frm_create_category.php');
?>