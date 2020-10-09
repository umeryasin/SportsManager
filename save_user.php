<?php
session_start();
//include('connect.php');
$conn = mysqli_connect("localhost","root","","db_pointofsale");
if (isset($_POST['save'])){
$status = $_POST['user_type'];
// query


		$maximum_record = "SELECT max(user_type_id) FROM user_type_info";

		$existing_record = mysqli_query($conn,$maximum_record);

		 $existing_id = mysqli_fetch_array($existing_record);
		
		 $new_id = $existing_id['max(user_type_id)'];
		 

		$sql = "INSERT INTO user_type_info VALUES ($new_id+1,'$status')";

		
$q = $conn->prepare($sql);
$q->execute();
header("location: frm_user_role.php");
	}




mysqli_close($conn);

?>