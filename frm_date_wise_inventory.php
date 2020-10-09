<?php
include 'connect.php';
  //Start session
include 'auth.php';

include 'conn.php';

error_reporting(0);

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

  <title>Date-Wise Inventory List</title>
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
        <form method="post" action="frm_date_wise_inventory.php">
        <label>From Date:</label>
        <input type="Date" name="starting_date">
        <label>To Date:</label>
        <input type="Date" name="ending_date">
          <button class="btn btn-success" style="width: 100px; height:35px; margin-top:-8px;margin-left:8px;" type="submit" name="Submit"><i class="fa fa-search fa-large"></i> View</button><br>

          <hr style="width: 800px;">
          <?php
          $sql_b="SELECT * FROM business_info";
          $run_b=mysqli_query($ob->connect(),$sql_b);
          $row_b=mysqli_fetch_array($run_b);
          ?>
          <h5 align="center"><?php echo $row_b['Business_Name']; ?></h5>
          <h5 align="center"> Inventory Date-Wise </h5>  
          <?php
            $from_date=$_POST['starting_date'];
            $to_date=$_POST['ending_date'];
          ?>
          <table border = "0" width="80%"><tr><td>
          <h6 align="center">From Date: <?php echo $from_date; ?></h6>
        </td><td> <h6>To Date: <?php echo $to_date; ?></h6> </td><tr></table>
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

            <table align="center" width="80%" style="line-height:40px;" cellspacing="0" border= "1">
              <thead align="center">
                <th> Sr. #</th>
                <th> Barcode</th>
                <th> Product Name</th>
                <th> Quantity</th>
            </thead>
            <?php
            
            $p_sql="SELECT *, SUM(Product_Quantity) AS Product_Quantity FROM product_master, product_stock WHERE product_master.Barcode_ID=product_stock.Barcode_ID AND product_stock.Product_Stock_Date BETWEEN '" . $from_date . "' AND  '" . $to_date . "' GROUP BY product_master.Barcode_ID";
            $p_run=mysqli_query($ob->connect(),$p_sql);
            //echo $p_sql;
            $i=1;
            while($p_row=mysqli_fetch_array($p_run))
            {
            ?>
            <tbody align="center">
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $p_row['Barcode_ID']; ?></td>
                <td><?php echo $p_row['Product_Name']; ?></td>
                <td><?php echo $p_row['Product_Quantity']; ?></td>
              </tr>
             </tbody>
             <?php
             $i++;
            }
             ?>
            </table>
            <table align="center" width="80%" style="line-height:40px;" cellspacing="0" border= "1">
              <tbody>
          
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
   
  
  </div>
</body>
</html>