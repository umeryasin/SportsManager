<?php
include 'class_user.php';
$ob_user=new user;
//////////////
$usertype=$_POST['UserType'];
/////////////
 $sql_user_id="SELECT IFNULL(MAX(User_Type_Id),0)+1 AS User_Type_Id FROM usertype";
          $run_user_id=mysqli_query($ob_user->connect(),$sql_user_id);
          $new_user_id=mysqli_fetch_array($run_user_id);
          $max_user_type_id=$new_user_id['User_Type_Id'];
          
          $ob_user->insert_user_type($max_user_type_id,$usertype);
          //mysqli_close();
?>