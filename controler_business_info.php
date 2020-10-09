<?php
include 'class_business_info.php';
	$b_name=$_POST['name'];
	$b_email=$_POST['email'];
	$b_contact=$_POST['contact'];
	$b_address=$_POST['address'];
	//$image = $_FILES['upload_business_image']['name'];

	/*$image = $_FILES['upload_business_image']['name'];
	$target = "images/".basename($image);
	$con=mysqli_connect("localhost","root","","db_pointofsale");
	$sql = "INSERT INTO business info (Logo) VALUES ('$image')";
	$suc=mysqli_query($con, $sql);
	if($suc)
		echo "Yes";*/

		$ob= new Business_info;
		$ob->getValues($_POST['name'],$_POST['email'],$_POST['contact'],$_POST['address']);
		$ob->insert_business_info();
		mysqli_close();
		
?>
