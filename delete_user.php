<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $con->prepare("DELETE FROM user WHERE id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>