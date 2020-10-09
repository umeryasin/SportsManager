<?php
include 'class_customers.php';
$name=$_POST['txt_name'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$nic=$_POST['txt_nic'];
$address=$_POST['address'];
$discount=$_POST['discount'];
$ob= new customers;
$ob->insert_customers_frm($name,$gender,$email,$phone,$nic,$address,$discount);
$ob->insert_customers_sql();
mysqli_close();
?>