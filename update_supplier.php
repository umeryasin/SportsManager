<?php
include 'class_suppliers.php';
$id=$_POST['id'];
$name=$_POST['txt_supplier_name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$reg_no=$_POST['txt_reg_no'];
$address=$_POST['address'];
$country_id=$_POST['txt_country'];
$ob=new vendor;
$ob->update_vendor($id,$name,$email,$phone,$reg_no,$address,$country_id);

?>