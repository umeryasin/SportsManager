<?php
include 'conn.php';
class product_info extends conn{

	private $barcode;
	private $product_name;
	private $vendor;
	private $category;
	private $product_unit;
	private $product_sub_unit;
	//private $unit_formula;
	private $whole_sale_price;
	private $retail_price;
	private $stock;	
	private $new_unit_formula;
	private $discount;
	private $product_color;
	private $product_size;
	private $product_brand;

	public function insert_product_sql()
	{
			//$maximum_record = "SELECT max(`Vendor ID`) FROM `vendor`";
			//$existing_record= mysqli_query($this->connect(),$maximum_record);
		 	//$existing_id = mysqli_fetch_array($existing_record);
		 	//$new_id=$existing_id[0];
		 	//echo $new_id;
		 	$sql="INSERT INTO `product`(`Barcode_ID`, `Product_Name`, `Product_Category_ID`, `Vendor_ID`, `Product_Unit_Id`, `Product_Sub_Unit_Id`, `Wholesale_Price`, `Retail_Price`, `Quantity`) VALUES ('$this->barcode','$this->product_name','$this->category','$this->vendor','$this->product_unit','$this->product_sub_unit','$this->whole_sale_price','$this->retail_price','$this->stock')";
		 	$play=mysqli_query($this->connect(),$sql);
		 	if($play)
		 		header("location: frm_product_info.php");
	}
	public function insert_product_frm($barcode,$product_name,$category,$product_unit,$whole_sale_price,$retail_price,$discount,$pro_color,$pro_size,$product_brand)
	{
			$this->barcode=$barcode;
			$this->product_name=$product_name;
			//$this->vendor=$vendor;
			$this->category=$category;
			$this->product_unit=$product_unit;
			//$this->product_sub_unit=$product_sub_unit;
			
			$this->whole_sale_price=$whole_sale_price;
			$this->retail_price=$retail_price;
			//$this->stock=$stock;
			$this->discount=$discount;
			$this->product_color=$pro_color;
			$this->product_size=$pro_size;
			$this->product_brand=$product_brand;

			$current_date=date("Y-m-d");

			$sql_master="INSERT INTO `product_master`(`Barcode_ID`, `Product_Name`, `Product_Category_ID`, `Product_Unit_Id`,`pro_color_id`,`pro_size_id`, `product_brand`) VALUES ('$this->barcode','$this->product_name','$this->category','$this->product_unit','$this->product_color','$this->product_size','$this->product_brand')";
			$run_master=mysqli_query($this->connect(),$sql_master);

			/*$sql_stock="INSERT INTO `product_stock`(`Barcode_ID`, `Product_Quantity`, `Product_Stock_Date`) VALUES ('$this->barcode','$this->stock','$current_date')";
			$run_stock=mysqli_query($this->connect(),$sql_stock);*/

			$sql_price="INSERT INTO `product_price`(`Barcode_ID`, `Purchase_Price`, `Retail_Price`, `Product_Discount`, `Product_Price_Date`) VALUES ('$this->barcode','$this->whole_sale_price','$this->retail_price','$this->discount','$current_date')";
			$run_price=mysqli_query($this->connect(),$sql_price);

			/////////////////
			$sel_ac_41_sql="SELECT * FROM link_accounts WHERE Account_Title_ID=41";
			$sel_ac_41_run=mysqli_query($this->connect(),$sel_ac_41_sql);
			$sel_ac_41_row=mysqli_fetch_array($sel_ac_41_run);
			$amount_41=$sel_ac_41_row['Amount'];
			$amount_41=$amount_41 + ($this->whole_sale_price * $this->stock);

			$up_41_sql="UPDATE `link_accounts` SET `Account_Date`='$current_date',`Amount`='$amount_41' WHERE Account_Title_ID=41";
			$up_41_run=mysqli_query($this->connect(),$up_41_sql);

			$sel_ac_42_sql="SELECT * FROM link_accounts WHERE Account_Title_ID=42";
			$sel_ac_42_run=mysqli_query($this->connect(),$sel_ac_42_sql);
			$sel_ac_42_row=mysqli_fetch_array($sel_ac_42_run);
			$amount_42=$sel_ac_42_row['Amount'];
			$amount_42=$amount_42 + ($this->whole_sale_price * $this->stock);

			$up_42_sql="UPDATE `link_accounts` SET `Account_Date`='$current_date',`Amount`='$amount_42' WHERE Account_Title_ID=42";
			$up_42_run=mysqli_query($this->connect(),$up_42_sql);

			////////////////

			if($run_master && $run_price)
				header('location: frm_product_info.php');


	}
	public function update_product($barcode,$product_name,$category,$product_unit,$whole_sale_price,$retail_price,$id,$discount)
	{
		$current_date=date("Y-m-d");
		$this->barcode=$barcode;
		$this->product_name=$product_name;
		//$this->vendor=$vendor;
		$this->category=$category;
		$this->product_unit=$product_unit;
		//$this->product_sub_unit=$product_sub_unit;
		
		$this->whole_sale_price=$whole_sale_price;
		$this->retail_price=$retail_price;
		//$this->stock=$new_stock;
		$this->discount=$discount;
		////////////////
		$sql_up="UPDATE `product_master` SET `Barcode_ID`='$this->barcode',`Product_Name`='$this->product_name',`Product_Category_ID`='$this->category',`Product_Unit_Id`='$this->product_unit' WHERE Barcode_ID=$id";
		$run_up=mysqli_query($this->connect(),$sql_up);

		$sql_pr="UPDATE `product_price` SET `Barcode_ID`='$this->barcode' WHERE Barcode_ID=$id";
		$run_pr=mysqli_query($this->connect(),$sql_pr);

		/*$sql_st="UPDATE `product_stock` SET `Barcode_ID`='$this->barcode' WHERE Barcode_ID=$id";
		$run_st=mysqli_query($this->connect(),$sql_st);*/

		/////////////////
		/*
			$sel_ac_41_sql="SELECT * FROM link_accounts WHERE Account_Title_ID=41";
			$sel_ac_41_run=mysqli_query($this->connect(),$sel_ac_41_sql);
			$sel_ac_41_row=mysqli_fetch_array($sel_ac_41_run);
			$amount_41=$sel_ac_41_row['Amount'];
			$amount_41=$amount_41 + ($this->whole_sale_price * $this->stock);

			$up_41_sql="UPDATE `link_accounts` SET `Account_Date`='$current_date',`Amount`='$amount_41' WHERE Account_Title_ID=41";
			$up_41_run=mysqli_query($this->connect(),$up_41_sql);

			$sel_ac_42_sql="SELECT * FROM link_accounts WHERE Account_Title_ID=42";
			$sel_ac_42_run=mysqli_query($this->connect(),$sel_ac_42_sql);
			$sel_ac_42_row=mysqli_fetch_array($sel_ac_42_run);
			$amount_42=$sel_ac_42_row['Amount'];
			$amount_42=$amount_42 + ($this->whole_sale_price * $this->stock);

			$up_42_sql="UPDATE `link_accounts` SET `Account_Date`='$current_date',`Amount`='$amount_42' WHERE Account_Title_ID=42";
			$up_42_run=mysqli_query($this->connect(),$up_42_sql);
			*/
			////////////////
		
		
		$select_pr_sql="SELECT * FROM product_price WHERE Barcode_ID=$id AND Product_Price_Date='$current_date'";
		$select_pr_run=mysqli_query($this->connect(),$select_pr_sql);
		$select_pr_row=mysqli_fetch_array($select_pr_run);

		////////
		if($select_pr_row['Product_Price_Date'] == $current_date)
		{
			$sql_pup="UPDATE `product_price` SET `Purchase_Price`='$this->whole_sale_price',`Retail_Price`='$this->retail_price', `Product_Discount`='$this->discount' ,`Product_Price_Date`='$current_date' WHERE Barcode_ID=$id AND Product_Price_Date='$current_date'";
			$run_pup=mysqli_query($this->connect(),$sql_pup);
		}
		else
		{
			$sql_pup="INSERT INTO `product_price`(`Barcode_ID`, `Purchase_Price`, `Retail_Price`, `Product_Discount`, `Product_Price_Date`) VALUES ( '$this->barcode','$this->whole_sale_price','$this->retail_price', '$this->discount','$current_date')";
			$run_pup=mysqli_query($this->connect(),$sql_pup);
		}

		/*
		$current_date=date("Y-m-d");
		$select_s_sql="SELECT * FROM product_stock WHERE Barcode_ID=$id AND Product_Stock_Date='$current_date'";
		$select_s_run=mysqli_query($this->connect(),$select_s_sql);
		$select_s_row=mysqli_fetch_array($select_s_run);

		////////
		if($select_s_row['Product_Stock_Date'] == $current_date)
		{
			$ex_stock=$select_s_row['Product_Quantity'];
			$new_stock=$ex_stock + $this->stock;

			$sql_pup="UPDATE `product_stock` SET `Barcode_ID`='$this->barcode',`Product_Quantity`='$new_stock',`Product_Stock_Date`='$current_date' WHERE Barcode_ID=$id AND 	Product_Stock_Date='$current_date'";
			echo $sql_pup;
			$run_pup=mysqli_query($this->connect(),$sql_pup);
		}
		else
		{
			$sql_pup="INSERT INTO `product_stock`(`Barcode_ID`, `Product_Quantity`, `Product_Stock_Date`) VALUES ('$this->barcode','$this->stock','$current_date')";
			$run_pup=mysqli_query($this->connect(),$sql_pup);
		}*/

		//if($run_up && $sql_pr && $sql_st)
			header('location: frm_product_info.php');

	}
}
?>