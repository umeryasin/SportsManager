<?php
	include('connect.php');
	$id=$_GET['id'];
	
	$result = $con->prepare("DELETE FROM account_title WHERE Account_Title_ID= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>