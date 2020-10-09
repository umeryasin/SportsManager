<?php
include 'conn.php';
$ob=new conn;
$sql_basic="SELECT Basic_Code, Business_ID_Ext FROM due_date";
$run_basic=mysqli_query($ob->connect(),$sql_basic);
$row_basic=mysqli_fetch_assoc($run_basic);
$ext_code=$row_basic['Basic_Code'];
$basic_code=$row_basic['Basic_Code'];
$ext_business_code=$row_basic['Business_ID_Ext'];

$current_year=date("Y");
$current_month=date("m");
$current_day=date("d");

$basic_code=$basic_code + 90870 - $current_year - $ext_business_code;
$basic_code=$basic_code + 32897 + $current_year - $ext_business_code;
$basic_code=$basic_code + 37001 + $current_month - $ext_business_code;
$basic_code=$basic_code + 12476 - $current_month + $ext_business_code;
$basic_code=$basic_code + 78113 - $current_day;
$basic_code=$basic_code - 33972 - $current_day;
$basic_code=$basic_code * ($current_year - $current_month - $current_day);
$basic_code=$basic_code - (21 * 23 * ($current_year - $current_month + $current_day));

$sql_up_act="UPDATE `due_date` SET Act_Code='$basic_code' WHERE Basic_Code='$ext_code'";
$run_up_act=mysqli_query($ob->connect(),$sql_up_act);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Your License has been expired!</title>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="">
  	<meta name="author" content="">
  	<!-- Bootstrap core CSS-->
  	<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<!-- Custom fonts for this template-->
  	<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  	<!-- Custom styles for this template-->
  	<link href="csss/sb-admin.css" rel="stylesheet">
</head>
<body style="background: url(images/IMG_4460.jpg) no-repeat center center fixed;
  -webkit-background-size: cover !important; 
  -moz-background-size: cover !important; 
  -o-background-size: cover !important; 
  background-size: cover !important;">
  <div align="center">
  <h1>Your License has been expired!</h1>
  <h2>Business / Distribution ID: <b style="color: white;"><?php echo $ext_business_code; ?></b></h2>
  <h2>Please! Contact to <a href="https://wwww.utsexperts.com" target="_blank">UTS Experts Team</a></h2>
  <h3>For Contact</h3>
  <h4>Phone#: 03437057036</h4>
  <h4>Phone#: 03494717715</h4>
  <h4>Phone#: 03070751826</h4>
  <h4>Email: <a href="mailto:marketing@utsexperts.com">marketing@utsexperts.com</a></h4>
  </div>
  <form action="active_lic.php" method="post">
  	<div align="center">
  		<span style="font-size: 25px;">Enter Activation Code</span> 
  		<input type="text" name="active_code" class="form-control" style="width: 400px;" autofocus="autofocus">
  		<input type="submit" name="active_but" class="form-control" style="width: 200px;" value="Active">
	</div>
  </form>
</body>
</html>