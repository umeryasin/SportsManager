<?php
include 'class_customers.php';
$id=$_POST['id'];
$name=$_POST['txt_name'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$nic=$_POST['txt_nic'];
$address=$_POST['address'];
$discount=$_POST['discount'];
$ob=new customers;
$ob->update_customer($id,$name,$gender,$email,$phone,$nic,$address,$discount);
//mysqli_close();

?>