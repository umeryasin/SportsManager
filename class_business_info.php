<?php
include 'connect.php';
include 'conn.php';
class Business_info extends conn{
	private $name;
	private $email;
	private $contact;
	private $address;

	public function getValues($name1,$email1,$contact1,$address1)
	{
		$this->name=$name1;
		$this->email=$email1;
		$this->contact=$contact1;
		$this->address=$address1;
		
		//echo $this->name.$this->email.$this->contact.$this->address;
	}

	public function insert_business_info()
	{
				//$maximum_record = "SELECT max(`Business ID`) FROM `business info`";
				//$existing_record= mysqli_query($this->connect(),$maximum_record);
		 		//$existing_id = mysqli_fetch_array($existing_record);
		 		//$new_id=$existing_id[0];
		$new_id=1;
		$sql="INSERT INTO `business_info`(`Business_ID`, `Business_Name`, `Logo`, `Email`, `Contact_No`, `Address`) VALUES ('$new_id','$this->name',90876,'$this->email','$this->contact','$this->address')";
		$run=mysqli_query($this->connect(),$sql);
		if($run)
			echo "Done";
		header("location: frm_business_info.php");
	}
	public function getBusinessName()
	{
		$sql="SELECT `Business_Name` FROM `business_info`";
		$run=mysqli_query($this->connect(),$sql);
		$row=mysqli_fetch_array($run);
		$ret=$row[0];
		return $ret;
	}
	public function getBusinessEmail()
	{
		$sql="SELECT `Email` FROM `business_info`";
		$run=mysqli_query($this->connect(),$sql);
		$row=mysqli_fetch_array($run);
		$ret=$row[0];
		return $ret;
	}
	public function getBusinessContact()
	{
		$sql="SELECT `Contact_No` FROM `business_info`";
		$run=mysqli_query($this->connect(),$sql);
		$row=mysqli_fetch_array($run);
		$ret=$row[0];
		return $ret;
	}
	public function getBusinessAddress()
	{
		$sql="SELECT `Address` FROM `business_info`";
		$run=mysqli_query($this->connect(),$sql);
		$row=mysqli_fetch_array($run);
		$ret=$row[0];
		return $ret;
	}


}
?>