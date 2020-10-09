<?php
session_start();
//include('connect.php');
$conn = mysqli_connect("localhost","root","","db_pointofsale");
if (isset($_POST['save'])){

$country_id 	= $_POST['txt_country_id'];
$country_name	= $_POST['cbo_CountryName'];
$state_name		= $_POST['txt_StateName'];	
// query
$sql1 = "SELECT * FROM state_info WHERE StateName = '$state_name' and country_id = $country_id";
//print_r($sql1);
//exit;

	$result = mysqli_query($conn,$sql1);
	$final_result= mysqli_num_rows($result);
	if($final_result>=1)
{ ?>
		<script>
			alert('Data Already Exists');
			window.location = "frm_state_info.php"
		</script>
	<?php
	}else{

		$maximum_record = "SELECT max(state_id) FROM state_info";

		$existing_record = mysqli_query($conn,$maximum_record);

		 $existing_id = mysqli_fetch_array($existing_record);
		
		$new_id = $existing_id['max(state_id)'];
		 


		$sql = "INSERT INTO state_info VALUES ($new_id+1,'$country_name','$state_name')";

		
$q = $conn->prepare($sql);
$q->execute();
header("location: frm_state_info.php");
	}




}

mysqli_close($conn);

?>