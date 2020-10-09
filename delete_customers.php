<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $con->prepare("DELETE FROM `customer` WHERE `customer`.`Customer_ID` = :memid");
	$result->bindParam(':memid', $id);
	$result->execute();

	header('location:frm_customers.php')
?>