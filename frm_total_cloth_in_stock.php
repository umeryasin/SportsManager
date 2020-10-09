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

  <title>Total Cloth In Stock</title>
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

</head>
<body class="fixed-nav sticky-footer bg-white" id="page-top">
  <!-- Navigation-->
  <br>
  <div class="">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      
      <!-- Example DataTables Card-->
      <div align="center">
        <form method="Post" action="frm_datewise_quantity.php">

          <?php 

           $con = mysqli_connect('localhost','root','','db_pointofsale');
                      
                    if (!$con) {
                      die('Could not connect: ' . mysqli_error($con));
                    }

          error_reporting(0);

          ?>

         
          <h3 align="center"> Fashion Shop </h3>
          <h5 align="center"><u> Total Cloth In Stock </u></h5>
          <br>
          <table border = "0" width="80%"><tr><td>
          <table>
                   
         
          <br>
                       
            
            <table align="center" width="60%" style="line-height:40px;" cellspacing="0" border= "1">
              <thead align="center">
                <th>Sr. #</th>
                <th>Product</th>
                <th>Quantity In Meters</th>
            </thead>
            <tbody>
              <?php

                    $sql1 = "SELECT *, SUM(Product_Quantity) AS Product_Quantity FROM Product_Master AS PM, Product_Stock AS PS WHERE PM.Barcode_ID = PS.Barcode_ID AND PM.Product_Category_ID = 2 GROUP BY PM.Barcode_ID ";

                    //print_r($sql1);

                    //exit();

                  $query1 = mysqli_query($con,$sql1);
                 
                  for($i=0; $row1 = mysqli_fetch_array($query1); $i++){

                    ?>
                  <tr align="center">
                    <td><?php echo $i+1 ?></td>
                  <td width="54.8%"><?php echo $row1['Product_Name'] ;?></td>
                  
                  <td ><?php echo $row1['Product_Quantity'] ?></td>
                </tr>
                  <?php } ?>
             </tbody>
            </table>
            <table align="center" width="60%" style="line-height:40px;" cellspacing="0" border= "1">
              <tbody>
                <?php 
                $sql3 = "SELECT SUM(Product_Quantity) AS Product_Quantity FROM Product_Stock AS PS, Product_Master AS PM Where PM.Barcode_ID = PS.Barcode_ID AND PM.Product_Category_ID = 2";
                $query3 = mysqli_query($con,$sql3);
                $run = mysqli_fetch_array($query3);
                ?>
                <tr align="center">
                  <td ><b>Total Quantity (in meters) :</b></td>
                  <td width="36.3%"><b><?php echo $run['Product_Quantity']; ?></b></td>
                </tr>
              </tbody>
            </table>        
             
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