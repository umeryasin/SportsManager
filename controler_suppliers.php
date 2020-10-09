<?php
include 'class_suppliers.php';

$name=$_POST['txt_supplier_name'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$reg_no=$_POST['txt_reg_no'];
$address=$_POST['address'];
$country_id=$_POST['txt_country'];

$ob=new vendor;
$ob->insert_vendor_frm($name,$reg_no,$email,$country_id,$phone,$address);
$ob->insert_vendor_sql();
mysqli_close();
?>
