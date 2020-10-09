<?php
include 'connect.php';
  //Start session
include 'auth.php';

include 'conn.php';
$ob=new conn;

$page_per = $_SESSION['SESS_TYPE_ID'];
/*$page_per = "0";
if (isset($_SESSION['SESS_TYPE_ID'])) {
  $page_per = $_SESSION['SESS_TYPE_ID'];

}*/
$cus_sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id = UT.User_Type_Id AND UP.User_Type_Id = $page_per";
$query_cus = mysqli_query($ob->connect(),$cus_sql);

$run2 = mysqli_fetch_array($query_cus);

/*if ($query_cus) {
  $query_cus = 1;
}else{
  $query_cus = 0;
}*/

if($_SESSION['admin'] == "admin" && $run2['Reports'] == 1)
    
    $counter = 1;
else{ 
  session_destroy();
  header("location: index.php");
}
?>

<!DOCTYPE>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Customer Info Report</title>
<style type="text/css">
  hr {
    color: black;
    background-color: black;
  }
</style>
<link href="dcalendar.picker.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
<script>
$("#show").click(function(e) {
    e.preventDefault();
    $("#view").show();
    commit(); // moved from the onClick attribute
});
</script>
</head>
<body class="fixed-nav sticky-footer bg-white" id="page-top">
  <!-- Navigation-->
 
  <div class="">
    <div class="container-fluid">
      <!-- Example DataTables Card-->
      <?php 
      $con = mysqli_connect('localhost','root','','db_pointofsale');
               

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
      
      $sql1 = "SELECT * FROM business_info";
      $query = mysqli_query($con,$sql1);
      $row = mysqli_fetch_array($query);
      ?>
      <div align="center">
        <form action="#" method="Post">

          
          <h5 align="center"><?php echo $row['Business_Name']; ?></h5>
          <h5 align="center"><?php echo $row['Contact_No']; ?></h5>
          <br>
          <h5>Customer Info Report</h5>
          <br>
            <table class="" id="" width="70%" cellspacing="0" border= "0">
              <thead>
                <tr style="border-bottom: 1px solid;">
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
            </table>
            <div id="view">
            <table width="70%" style="line-height:40px;" cellspacing="0" border= "0">
              <thead>
                <tr style="border-bottom: 1px solid;">
                  
                  <th width="20%"> Customer Name</th>
                  <th width="10%"> Gender</th>
                  <th width="15%"> Email</th>
                  <th width="15%"> Phone #</th>
                  <th width="8%"> Discount</th>
                  <th width="8%"> Total Spent</th>
                </tr>
              </thead>

              <?php

              $con = mysqli_connect('localhost','root','','db_pointofsale');
               

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

              $sql2 = "SELECT * FROM customer AS C, gender AS G WHERE C.Gender_ID = G.Gender_ID AND Customer_ID > 0";
             // print_r($sql4);
              //exit();

              $run1 = mysqli_query($con,$sql2);

              for($i=0; $row1 = mysqli_fetch_array($run1); $i++){

    ?>
      <tr>
        <td><?php echo $row1['Customer_Name']; ?></td>
        <td><?php echo $row1['Gender']; ?></td>
        <td><?php echo $row1['Email']; ?></td>
        <td><?php echo $row1['Contact_No']; ?></td>
        <td><?php echo $row1['Discount']; ?></td>
        <td><?php echo $row1['Total_Spent']; ?></td>
      </tr>
    <?php }  ?>
            </table>
            </div>
          </form>
      </div>
    </div>
 
    <!-- /.content-wrapper-->
    <footer class="sticky-footer" style="width: 1280px; height: 30px;">
      <div class="container">
        <div class="text-center">
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
<!-- JavaScript Libraries-->
    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendors/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendors/datatables/jquery.dataTables.js"></script>
    <script src="vendors/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="jss/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="jss/sb-admin-datatables.min.js"></script>
    <script src="js/jquery.js"></script>
  </div>
</body>
</html>