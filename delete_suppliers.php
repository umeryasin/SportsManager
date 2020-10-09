<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $con->prepare("DELETE FROM `vendor` WHERE `vendor`.`Vendor_ID` = :memid");
	$result->bindParam(':memid', $id);
	$result->execute();

	header('location: frm_suppliers.php');
?>