<?php
	include 'connect.php';
	include 'conn.php';
	$ob=new conn;
	//Start session
	session_start();
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	//$link = mysqli_connect('localhost','root',"","db_pointofsale");	
	
	//Sanitize the POST values
	$login = $_POST['username'];
	$password = $_POST['password'];	
	
	//Create query
	$qry  ="SELECT * FROM user AS U, usertype AS UT WHERE U.User_Type_Id = UT.User_Type_Id AND username='$login' AND password='$password'";
	$result = mysqli_query($ob->connect(),$qry);
	
	//Check whether the query was successfull or not
	if($result) {
		if(mysqli_num_rows($result) > 0) {
			$_SESSION['admin'] = "admin";
			
			//Login Successful
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] 	= $member['id'];
			$_SESSION['SESS_FIRST_NAME'] 	= $member['name'];
			$_SESSION['Name']=$member['name'];
			//$_SESSION['SESS_LAST_NAME'] 	= $member['position'];
			$_SESSION['SESS_TYPE_ID'] 		= $member['User_Type_Id'];
			//$_SESSION['SESS_PRO_PIC'] = $member['profImage'];
			session_write_close();
			header("location: dashboard.php");
			exit();
		}else {
			//Login failed
                echo "<script type='text/javascript'> 
                		alert('Wrong Input Details');
                		window.location='index.php'; 
                		</script>";
                //header('location:index.php');			
		}
	}else {
		die("Query failed");
	}
?>