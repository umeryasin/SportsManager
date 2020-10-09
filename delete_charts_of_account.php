<?php
	include('connect.php');
	$id=$_GET['id'];
	
	$result = $con->prepare("DELETE FROM charts_of_accounts WHERE Head_Of_Account_ID= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>