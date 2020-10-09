<?php
	include('connect.php');
	$id=$_GET['id'];
	$result = $con->prepare("DELETE  FROM chartofaccounts WHERE Accounts_Id= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>