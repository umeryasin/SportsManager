<?php
session_start();
//include('connect.php');
$conn = mysqli_connect("localhost","root","","db_pointofsale");
if (isset($_POST['save'])){
$country_name = $_POST['CountryName'];
// query
$sql1 = "SELECT * FROM country_info WHERE CountryName = '$country_name'";
//print_r($sql1);
//exit;

	$result = mysqli_query($conn,$sql1);
	$final_result= mysqli_num_rows($result);
	if($final_result>=1)
{ ?>
		<script>
			alert('Data Already Exists');
			window.location = "frm_country_info.php"
		</script>
	<?php
	}else{

		$maximum_record = "SELECT max(country_id) FROM country_info";

		$existing_record = mysqli_query($conn,$maximum_record);

		 $existing_id = mysqli_fetch_array($existing_record);
		
		 $new_id = $existing_id['max(country_id)'];
		 

		$sql = "INSERT INTO country_info VALUES ($new_id+1,'$country_name')";

		
$q = $conn->prepare($sql);
$q->execute();
header("location: frm_country_info.php");
	}




}

mysqli_close($conn);

?>