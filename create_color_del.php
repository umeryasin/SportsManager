<?php
include 'connect.php';
include 'auth.php';
include 'conn.php';
$ob=new conn;
$id=$_GET['id'];
$sql="DELETE FROM product_color WHERE pro_color_id=$id";
$run=mysqli_query($ob->connect(),$sql);
if($run)
	header('location:frm_product_color.php');
?>