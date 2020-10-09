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
error_reporting(0);

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

  <title>Date-Wise Price List</title>
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
        <form method="Post" action="frm_datewise_price.php">
        <label>Select Product:</label>
          <select name="Barcode_ID" style="width:160px">
                    <option value="0">--Select Product--</option>
              <?php
              $result = $con->prepare("SELECT * FROM Product_Master");
              $result->bindParam(':userid', $res);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
                ?>
                <option value="<?php echo $row['Barcode_ID']; ?>"><?php echo $row['Product_Name']; ?></option>
                <?php
              }
              ?>
          </select>
          <button class="btn btn-success" style="width: 100px; height:35px; margin-top:-8px;margin-left:8px;" type="submit" name="Submit"><i class="fa fa-search fa-large"></i> View</button><br>

          <?php 
          include_once('conn.php');
          $ob=new conn();

          //error_reporting(0);               
               
                  if(!isset($_POST['Submit']))

                    $barcode_ID = "";
                  else
                  $barcode_ID    = $_POST['Barcode_ID'];

                  $sql2 = "SELECT * FROM Product_Master Where Barcode_ID = $barcode_ID";

                  $query2 = mysqli_query($ob->connect(),$sql2);

                  $row2 = mysqli_fetch_array($query2);

                  $Barcode = $row2['Barcode_ID'];

                  $product_name = $row2['Product_Name'];
          ?>

          <hr style="width: 800px;">
          <h5 align="center"> Fashion Shop </h5>
          <h5 align="center"> Product Price Date-Wise </h5>
          <br>
          <table border = "0" width="80%"><tr><td>
          <h6 align="center">Product Name:&nbsp;&nbsp;<?php echo $product_name; ?></h6>
        </td><td><h6>Barcode #:&nbsp;&nbsp;<?php echo $Barcode; ?></h6></td><tr><table>
                   
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
          <br>
                       
            
            <table align="center" width="60%" style="line-height:40px;" cellspacing="0" border= "1">
              <thead align="center">
                <th>Sr. #</th>
                <th>Date</th>
                <th>Price</th>
            </thead>
            <tbody>
              <?php

                    $sql1 = "SELECT *,date_format(Product_Price_Date, '%d-%m-%Y') AS Product_Price_Date FROM Product_Master AS PM, Product_Price AS PP WHERE PM.Barcode_ID = PP.Barcode_ID AND PP.Barcode_ID = $barcode_ID";

                    //print_r($sql1);

                    //exit();

                  $query1 = mysqli_query($ob->connect(),$sql1);
                 
                  for($i=0; $row1 = mysqli_fetch_array($query1); $i++){

                    ?>
                  <tr align="center">
                    <td><?php echo $i+1 ?></td>
                  <td ><?php echo $row1['Product_Price_Date'] ;?></td>
                  
                  <td ><?php echo $row1['Retail_Price'] ?></td>
                </tr>
                  <?php } ?>
             </tbody>
            </table>
            <table align="center" width="60%" style="line-height:40px;" cellspacing="0" border= "1">
              <tbody>
                <?php 
                $sql3 = "SELECT * FROM product_price WHERE Barcode_ID=$barcode_ID ORDER BY Product_Price_ID DESC LIMIT 1";
                $query3 = mysqli_query($ob->connect(),$sql3);
                $run = mysqli_fetch_array($query3);
                ?>
                <tr align="center">
                  <td ><b>Current Price :</b></td>
                  <td width="25.3%"><b><?php echo $run['Retail_Price']; ?></b></td>
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