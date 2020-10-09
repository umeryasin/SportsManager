<?php
include 'conn.php';
class vendor extends conn{
	//private $id;
	private $name;
	private $reg_no;
	private $email;
	private $country_id;
	private $phone;
	private $address;

	public function insert_vendor_sql()
	{
			$maximum_record = "SELECT max(`Vendor_ID`) FROM `vendor`";
			$existing_record= mysqli_query($this->connect(),$maximum_record);
		 	$existing_id = mysqli_fetch_array($existing_record);
		 	$new_id=$existing_id[0];
		 	//echo $new_id;
		 	$sql="INSERT INTO `vendor`(`Vendor_ID`, `Vendor_Name`, `Reg_No`, `Email`, `Country_Name`, `Contact_No`, `Address`) VALUES ($new_id+1,'$this->name','$this->reg_no','$this->email','$this->country_id','$this->phone','$this->address')";
		 	$run=mysqli_query($this->connect(),$sql);
		 	if($run)
		 		header("location: frm_suppliers.php");
	}
	public function insert_vendor_frm($name,$reg_no,$email,$country_id,$phone,$address)
	{
		//$this->id=$id;
		$this->name=$name;
		$this->reg_no=$reg_no;
		$this->email=$email;
		$this->country_id=$country_id;
		$this->phone=$phone;
		$this->address=$address;
		//$this->total_spent=$total_spent;
	}
	public function update_vendor($id,$name,$email,$phone,$reg_no,$address,$country_id)
	{
		$this->name=$name;
		$this->reg_no=$reg_no;
		$this->email=$email;
		$this->country_id=$country_id;
		$this->phone=$phone;
		$this->address=$address;
		$sql="UPDATE `vendor` SET `Vendor_Name`='$this->name',`Reg_No`='$this->reg_no',`Email`='$this->email',`Country_Name`='$this->country_id',`Contact_No`='$this->phone',`Address`='$this->address' WHERE Vendor_ID=$id";
		$run=mysqli_query($this->connect(),$sql);
		if($run)
		header('location:frm_suppliers.php');	
	}
}
?>