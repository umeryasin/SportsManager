<?php
	include('connect.php');
	$id=$_GET['id'];
	

	$result_stock = $con->prepare("DELETE FROM `product_stock` WHERE `product_stock`.`Barcode_ID` = :memid");
	$result_stock->bindParam(':memid', $id);
	$result_stock->execute();

	$result_price = $con->prepare("DELETE FROM `product_price` WHERE `product_price`.`Barcode_ID` = :memid");
	$result_price->bindParam(':memid', $id);
	$result_price->execute();

	$result_master = $con->prepare("DELETE FROM `product_master` WHERE `product_master`.`Barcode_ID` = :memid");
	$result_master->bindParam(':memid', $id);
	$result_master->execute();

	header('location: frm_product_info.php');

?>