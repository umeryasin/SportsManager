<?php
include 'conn.php';
$ob=new conn;
if(isset($_POST['category_id']))
{
	$category_id=$_POST['category_id'];
	$sql="SELECT * FROM productunit,productcategory WHERE productunit.Product_Category_ID=productcategory.Product_Category_ID AND productunit.Product_Category_ID=$category_id ";
	$run=mysqli_query($ob->connect(),$sql);
	;
	while($row=mysqli_fetch_array($run))
	{
	echo "<option";
	echo " value='";
	echo $row['Product_Unit_Id'];
	echo "'>";
	echo $row['Product_Unit'];
	echo "</option>";
	}
}


?>