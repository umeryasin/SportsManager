<?php
session_start();
//include('connect.php');
$conn = mysqli_connect("localhost","root","","db_pointofsale");
if (isset($_POST['save'])){


$country_name	= $_POST['cbo_CountryName'];
$state_name		= $_POST['cbo_StateName'];
$city_name 		= $_POST['txt_CityName'];	
// query
$sql1 = "SELECT * FROM city_info WHERE CityName = '$city_name' and state_id = $state_id";
//print_r($sql1);
//exit;

	$result = mysqli_query($conn,$sql1);
	$final_result= mysqli_num_rows($result);
	if($final_result>=1)
{ ?>
		<script>
			alert('Data Already Exists');
			window.location = "frm_city_info.php"
		</script>
	<?php
	}else{

		$maximum_record = "SELECT max(city_id) FROM city_info";

		$existing_record = mysqli_query($conn,$maximum_record);

		 $existing_id = mysqli_fetch_array($existing_record);
		
		$new_id = $existing_id['max(city_id)'];
		 


		$sql = "INSERT INTO city_info VALUES ($new_id+1,'$country_name','$state_name','$city_name')";

		
$q = $conn->prepare($sql);
$q->execute();
header("location: frm_city_info.php");
	}




}

mysqli_close($conn);

?>