<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $con->prepare("DELETE FROM state_info WHERE state_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>