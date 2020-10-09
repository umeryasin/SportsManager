<?php
include 'class_user.php';
$ob_add=new user;
////////////
if(isset($_POST['save']))
{
	$usertype=$_POST['UserType'];
	$name=$_POST['name'];
	$username=$_POST['UserName'];
	$password=$_POST['Password'];

	$ob_add->add_user($usertype,$name,$username,$password);
}


?>