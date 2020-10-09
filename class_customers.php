<?php
include 'conn.php';
class customers extends conn{
	//private $id;
	private $name;
	private $gender;
	private $email;
	private $phone;
	private $nic;
	private $address;
	private $discount;
	private $total_spent;

	public function insert_customers_sql()
	{
			$maximum_record = "SELECT max(`Customer_ID`) FROM `customer`";
			$existing_record= mysqli_query($this->connect(),$maximum_record);
		 	$existing_id = mysqli_fetch_array($existing_record);
		 	$new_id=$existing_id[0];
		 	//echo $new_id;
		 	$sql="INSERT INTO `customer`(`Customer_ID`, `Customer_Name`, `Gender_ID`, `Email`, `Discount`, `Contact_No`, `NIC`, `Address`, `Total_Spent`) VALUES ($new_id+1,'$this->name','$this->gender','$this->email','$this->discount','$this->phone','$this->nic','$this->address','$this->total_spent')";
		 	$run=mysqli_query($this->connect(),$sql);
		 	if($run)
		 		header("location: frm_customers.php");
	}
	public function insert_customers_frm($name,$gender,$email,$phone,$nic,$address,$discount)
	{
		//$this->id=$id;
		$this->name=$name;
		$this->gender=$gender;
		$this->email=$email;
		$this->phone=$phone;
		$this->nic=$nic;
		$this->address=$address;
		$this->discount=$discount;
		//$this->total_spent=$total_spent;
	}
	public function update_customer($id,$name,$gender,$email,$phone,$nic,$address,$discount)
	{
		//$id
		$this->name=$name;
		$this->gender=$gender;
		$this->email=$email;
		$this->phone=$phone;
		$this->nic=$nic;
		$this->address=$address;
		$this->discount=$discount;
		$sql="UPDATE `customer` SET `Customer_Name`='$this->name',`Gender_ID`='$this->gender',`Email`='$this->email',`Discount`='$this->discount',`Contact_No`='$this->phone',`NIC`='$this->nic',`Address`='$this->address' WHERE Customer_ID=$id";
		$run=mysqli_query($this->connect(),$sql);
		if($run)
			header('location: frm_customers.php');
	}
}
?>