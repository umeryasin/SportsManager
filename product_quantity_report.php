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

  <title>Product Quantity Report</title>
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
      $sql1 = "SELECT * FROM business_info";
      $query = mysqli_query($ob->connect(),$sql1);
      $row = mysqli_fetch_array($query);
      ?>
      <div align="center">
        <form action="#" method="Post">

          
          <h5 align="center"><?php echo $row['Business_Name']; ?></h5>
          <h5 align="center"><?php echo $row['Contact_No']; ?></h5>
          <br>
          <h5>Product Quantity Report</h5>
          <br>
            <table class="" id="" width="60%" cellspacing="0" border= "0">
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
            <table width="60%" style="line-height:40px;" cellspacing="0" border= "0">
              <thead>
                <tr style="border-bottom: 1px solid;">
                  <th width="10%"> Barcode ID</th>
                  <th width="30%"> Product Name</th>
                  <th width="5%"> Quantity</th>
                </tr>
              </thead>

              <?php

              $sql2 = "SELECT * FROM product_master WHERE Barcode_ID > 0";
             // print_r($sql4);
              //exit();
              $run1 = mysqli_query($ob->connect(),$sql2);

              for($i=0; $row1 = mysqli_fetch_array($run1); $i++){

                $Barcode_ID = $row1['Barcode_ID'];

                $sql3 = "SELECT SUM(Product_Quantity) AS Pro_Qty FROM Product_Stock AS PS WHERE Barcode_ID = $Barcode_ID";
              //print_r($sql3);
              //exit();

                $run2 = mysqli_query($ob->connect(),$sql3);

                $row2 = mysqli_fetch_array($run2);

                $pro_Qty = $row2['Pro_Qty'];

                $sql4 = "SELECT SUM(Quantity) AS Pro_Sal_Qty FROM InvoiceDetails AS ID WHERE Barcode_ID = $Barcode_ID";
             // print_r($sql4);
              //exit();

                $run3 = mysqli_query($ob->connect(),$sql4);

                $row3 = mysqli_fetch_array($run3);

                $pro_Sal_Qty = $row3['Pro_Sal_Qty'];
                ////
                $sql_sss="SELECT SUM(Quantity) AS Quantity FROM sales_return_detail WHERE Barcode_ID=$Barcode_ID GROUP BY Barcode_ID";
                  $run_sss=mysqli_query($ob->connect(),$sql_sss);
                  $row_sss=mysqli_fetch_array($run_sss);
                  $return_q=$row_sss['Quantity'];


                $net_pro_Qty = $pro_Qty - $pro_Sal_Qty + $return_q;

                $sql5 = "SELECT Purchase_Price, Retail_Price FROM Product_Price WHERE Barcode_ID = $Barcode_ID ORDER BY Product_Price_ID DESC LIMIT 1" ;
             // print_r($sql4);
              //exit();

                $run4 = mysqli_query($ob->connect(),$sql5);

                $row4 = mysqli_fetch_array($run4);

    ?>
      <tr>
        <td><?php echo $row1['Barcode_ID']; ?></td>
        <td><?php echo $row1['Product_Name']; ?></td>
        <td><?php echo $net_pro_Qty; ?></td>
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