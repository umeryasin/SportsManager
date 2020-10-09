<?php
include 'class_user.php';
$ob_edit=new user;
///////////
$max_user_type_id=$_POST['id'];
$usertype=$_POST['UserType'];
//////////
$ob_edit->edit_user_type($max_user_type_id,$usertype);
mysqli_close();

?>