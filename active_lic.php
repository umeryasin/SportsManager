<?php
include 'conn.php';
$ob=new conn;
$active_code=$_POST['active_code'];
$sql_get="SELECT * FROM `due_date`";
$run_get=mysqli_query($ob->connect(),$sql_get);
$row_get=mysqli_fetch_assoc($run_get);
if($active_code == $row_get['Act_Code'])
{
	$current_month=date('m');
	$current_year=date('Y');
	//echo $current_year;
	if($current_month==12)
	{
		$current_year++;
		//echo $current_year;
		$set_dt=date("$current_year/01/d");
		$sql="UPDATE due_date SET Exp_Date ='$set_dt' WHERE Act_Code='$active_code' ";
		$run=mysqli_query($ob->connect(),$sql);
	}
	else
	{
		$next_month=$current_month+1;
		$set_dt=date("Y/$next_month/d");
		$sql="UPDATE due_date SET Exp_Date ='$set_dt' WHERE Act_Code='$active_code' ";
		$run=mysqli_query($ob->connect(),$sql);
	}
}
header("location: index.php");
?>