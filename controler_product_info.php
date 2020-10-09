<?php
include 'class_product_info.php';
$barcode=$_POST['barcode'];
$product_name=$_POST['txt_product_name'];
$product_brand=$_POST['txt_product_brand'];
//$vendor=$_POST['select_vendor'];
$category=$_POST['pro_category_id'];
$pro_color=$_POST['select_pro_color'];
$pro_size=$_POST['select_pro_size'];
	
$product_unit=$_POST['product_unit'];
//$unit_formula=$_POST['txt_unit_formula'];
$whole_sale_price=$_POST['txt_wholesale_price'];
$retail_price=$_POST['txt_retail_price'];
//$stock=$_POST['txt_stock'];
$discount=$_POST['txt_discount'];

$ob=new product_info;
$ob->insert_product_frm($barcode,$product_name,$category,$product_unit,$whole_sale_price,$retail_price,$discount,$pro_color,$pro_size,$product_brand);
//mysqli_close();
?>
