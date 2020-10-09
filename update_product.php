<?php
include 'class_product_info.php';
$ob1=new product_info;
$barcode=$_POST['barcode'];
$product_name=$_POST['txt_product_name'];
//$vendor=$_POST['select_vendor'];
$category=$_POST['select_category'];
$product_unit=$_POST['charclass'];
$product_sub_unit=$_POST['role'];
//$unit_formula=$_POST['txt_unit_formula'];
$whole_sale_price=$_POST['txt_wholesale_price'];
$retail_price=$_POST['txt_retail_price'];
//$ex_stock=$_POST['txt_stock'];
//$new_stock=$_POST['txt_stock_update'];
$discount=$_POST['txt_discount'];
//$update_stock=$ex_stock+$new_stock;
$id=$_POST['id'];

$ob1->update_product($barcode,$product_name,$category,$product_unit,$whole_sale_price,$retail_price,$id,$discount);

?>