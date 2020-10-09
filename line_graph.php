<?php
	$con = mysqli_connect('localhost','root','','db_pointofsale');


	if (!$con) {
	die('Could not connect: ' . mysqli_error($con));
	}

	$sql = "SELECT Invoice_No, Date, GrandTotal FROM invoice_master ";
	$query = mysqli_query($con,$sql);

	$data = array();
	foreach ($query as $row) {
		$data[] = $row;
	}
?>