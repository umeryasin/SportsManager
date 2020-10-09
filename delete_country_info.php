<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $con->prepare("DELETE FROM country_info WHERE country_id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>