<?php
// configuration
include('connect.php');

// new data
$id = $_POST['head_of_account_id'];
$a = $_POST['Head_Of_Account_Title'];
$b = $_POST['Entry_Type_ID'];

// query
$sql = "UPDATE charts_of_account
        SET Head_Of_Account_Title = '$a', Entry_Type_ID = '$b'
    WHERE Head_Of_Account_ID = '$id'";

$query = mysqli_query($con,$sql);

header("location: frm_charts_of_account.php");

?>