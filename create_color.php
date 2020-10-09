<?php
include 'connect.php';
  //Start session
include 'auth.php';
  include 'conn.php';
$ob=new conn;

$page_per = $_SESSION['SESS_TYPE_ID'];
/*$page_per = "0";
if (isset($_SESSION['SESS_TYPE_ID'])) {
  $page_per = $_SESSION['SESS_TYPE_ID'];

}*/
$cus_sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id = UT.User_Type_Id AND UP.User_Type_Id = $page_per";
$query_cus = mysqli_query($ob->connect(),$cus_sql);

$run_2 = mysqli_fetch_array($query_cus);

/*if ($query_cus) {
  $query_cus = 1;
}else{
  $query_cus = 0;
}*/

if($_SESSION['admin'] == "admin" && $run_2['Accounts'] == 1)
    
    $counter = 1;
else{ 
  session_destroy();
  header("location: index.php");
}

if(isset($_POST['create_color']))
{
	$color_name=$_POST['color_name'];
	$sql_get_latest_id="SELECT MAX(pro_color_id) AS color_id FROM `product_color`";
	$run_get_latest_id=mysqli_query($ob->connect(),$sql_get_latest_id);
	$row_get_latest_id=mysqli_fetch_assoc($run_get_latest_id);
	$new_id=$row_get_latest_id['color_id']+1;

	$sql_save_color="INSERT INTO `product_color`(`pro_color_id`, `pro_color_name`) VALUES ($new_id,'$color_name')";
	$run_save_color=mysqli_query($ob->connect(),$sql_save_color);
	if($run_save_color)
		header('location:frm_product_color.php');
}
?>