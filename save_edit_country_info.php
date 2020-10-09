<?php
// configuration
include('connect.php');

// new data

$a	= $_POST['CountryName'];
// query
$sql = "UPDATE country_info 
        SET CountryName = `$a`
		WHERE country_id= $id";

$run = mysqli_query($db,$sql);

header("location: country_info.php");

?>