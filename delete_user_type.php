<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $con->prepare("DELETE FROM usertype WHERE User_Type_Id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();

	$result = $con->prepare("DELETE FROM user_permission WHERE User_Type_Id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>