<?php
include 'conn.php';
class user extends conn{
	private $max_user_type_id;
	private $usertype;

	private $username;
	private $password;
	private $name;


public function insert_user_type($max_user_type_id,$usertype)
{
	$this->max_user_type_id=$max_user_type_id;
	$this->usertype=$usertype;
	//echo $this->max_user_type_id;
	//echo $this->usertype;
	$sql="INSERT INTO `usertype`(`User_Type_Id`, `User_Type`) VALUES ('$this->max_user_type_id','$this->usertype')";
	$run=mysqli_query($this->connect(),$sql);
	///////////////////
	$sql_u = "INSERT INTO `user_permission`(`User_Type_Id`, `Home`, `Business`, `Customers`, `Vendors`, `Products`, `Product_Received`, `New_Invoice`, `Accounts`, `Sales_Return`, `Exchange_Item`, `Reports`, `User_Management`) VALUES ($this->max_user_type_id,0,0,0,0,0,0,0,0,0,0,0,0)";
	$run_u = mysqli_query($this->connect(),$sql_u);
	if($run && $run_u)
		header('location: frm_user_type.php');
}
public function edit_user_type($max_user_type_id,$usertype)
{
	$this->max_user_type_id=$max_user_type_id;
	$this->usertype=$usertype;
	$sql="UPDATE `usertype` SET `User_Type`='$this->usertype' WHERE User_Type_Id=$this->max_user_type_id ";
	$run=mysqli_query($this->connect(),$sql);
	if($run)
		header('location: frm_user_type.php');
}

public function add_user($usertype,$name,$username,$password)
{
	$this->usertype=$usertype;
	$this->username=$username;
	$this->password=$password;
	$this->name=$name;
	///////
	$sql_user_id="SELECT IFNULL(MAX(id),0)+1 AS id FROM user";
          $run_user_id=mysqli_query($this->connect(),$sql_user_id);
          $new_user_id=mysqli_fetch_array($run_user_id);
          $max_user_type_id=$new_user_id['id'];
          //echo $max_user_type_id;
          ///////////////
          $sql="INSERT INTO `user`(`id`, `username`, `password`, `name`, `User_Type_Id`) VALUES ('$max_user_type_id','$this->username','$this->password','$this->name','$this->usertype')";
          $run=mysqli_query($this->connect(),$sql);
          if($run)
          	header('location: frm_add_user.php');

}
//////
}

?>