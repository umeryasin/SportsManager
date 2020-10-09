<?php
include 'connect.php';
include 'conn.php';
  //Start session
  session_start();

$ob = new conn;
$totalsale = 0;

$page_per = $_SESSION['SESS_TYPE_ID'];
/*$page_per = "0";
if (isset($_SESSION['SESS_TYPE_ID'])) {
  $page_per = $_SESSION['SESS_TYPE_ID'];

}*/
$cus_sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id = UT.User_Type_Id AND UP.User_Type_Id = $page_per";
$query_cus = mysqli_query($ob->connect(),$cus_sql);

$run_2 = mysqli_fetch_array($query_cus);

/*if ($query_cus) {
  $query_cus = 1;
}else{
  $query_cus = 0;
}*/

if($_SESSION['admin'] == "admin")
    
    $counter = 1;
  else{ 
  session_destroy();
  header("location: index.php");
}

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Point of Sale</title>
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="jss/morris.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <!--<link rel="stylesheet" type="text/css" href="css/my_style.css">-->
  <style type="text/css">
    .chart-container {
      width: 600px;
      height: auto;
    }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-white" id="page-top">
  <!-- Navigation-->
  <?php include 'navbar.php' ?>
  <?php include 'nav2.php';?>
  <br>
  <div style="margin-top: 80px;">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fa fa-check"></i> Successfully Loged In!</h5>
                  Welcome <?php echo $_SESSION['Name']; ?> to <?php echo $run_2['User_Type']; ?> Panel.
      </div>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-2 col-sm-6 mb-3" id="display_s">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-shopping-cart"></i>
              </div>
                <?php 
                $current_date = date('Y-m-d');

                $sql1 = "SELECT SUM(Master_Total) AS Master_Total FROM Invoice_master WHERE Date = '$current_date'";
                $run1 = mysqli_query($ob->connect(),$sql1);
                $query1 = mysqli_fetch_array($run1);
                $totalsale = $query1['Master_Total'];
                $totalsale = $totalsale + 0;
                ?>
              <div class="mr-5" style="font-weight: bold; font-size: 22px;"> <span class="sales">Sales</span></div>
              <div class="mr-5"><?php echo $totalsale; ?> Rs.</div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-3" id="display_p">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fas fa-percent"></i>
              </div>
                    <?php 
                    $current_date1 = date("Y-m-d");
                    $sql2 = "SELECT *, Sum(ID.Quantity * ID.Purchase_Price) as Total_Purchase FROM invoicedetails AS ID, Invoice_master AS IM, Product_Master as P WHERE P.Barcode_ID = ID.Barcode_ID AND IM.Invoice_No = ID.Invoice_No AND IM.Date = '$current_date1'";
                    //echo $sql2;
                    //exit;
                    $run2 = mysqli_query($ob->connect(),$sql2);
                    $query2 = mysqli_fetch_array($run2);
                    $total_Purchase = $query2['Total_Purchase'];
 

                    $sql2 = "SELECT *, Sum(ID.Quantity * ID.Sale_Price) as Total_Sales, Sum(Discount) AS Discount FROM invoicedetails AS ID, Invoice_master AS IM, Product_Master as P WHERE P.Barcode_ID = ID.Barcode_ID AND IM.Invoice_No = ID.Invoice_No AND IM.Date = '$current_date1'";
                    $run2 = mysqli_query($ob->connect(),$sql2);
                    $query2 = mysqli_fetch_array($run2);
                    $total_Sales = $query2['Total_Sales'];
                    $discount   = $query2['Discount'];

                    $total_profit = $total_Sales - $total_Purchase - $discount;
                    ?>
              <div class="mr-5" style="font-weight: bold; font-size: 22px;"> Profit</div>
              <div class="mr-5"><?php echo $total_profit; ?> Rs.</div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-3" id="display_e">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa fa-money"></i>
              </div>
                <?php 

                $sql3 = "SELECT SUM(GD.Amount) AS Expense FROM general_journal_detail AS GD, link_accounts AS A , general_journal_master AS GM WHERE A.Head_Of_Account_ID = 3 AND GD.Account_Title_ID = A.Account_Title_ID AND GD.Voucher_ID = GM.Voucher_ID AND GM.Transaction_Date='$current_date1'";
                $run3 = mysqli_query($ob->connect(),$sql3);
                $query3 = mysqli_fetch_array($run3);

                $expense = $query3['Expense'];

                ?>
              <div class="mr-5" style="font-weight: bold; font-size: 22px;"> Expense</div>
              <div class="mr-5"><?php if($expense==null) echo "0"; else echo $expense; ?> Rs.</div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-3" id="display_c">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-google-wallet"></i>
              </div>
                    <?php 
                    $sql4 = "SELECT SUM(GD.Amount) AS Cash FROM general_journal_detail AS GD, Account_Title AS A, general_journal_master AS GM WHERE GD.Voucher_ID=GM.Voucher_ID AND A.Account_Title_ID = GD.Account_Title_ID AND GD.Account_Title_ID =14 AND GM.Transaction_Date='$current_date1'";
                    //print_r($sql4);
                    //exit();
                    $run4 = mysqli_query($ob->connect(),$sql4);
                    $query4 = mysqli_fetch_array($run4);

                    $cash = $query4['Cash'];

                    //$cashincounter = $totalsale - $expense;

                    ?>
              <div class="mr-5" style="font-weight: bold; font-size: 22px;"> Cash in Counter</div>
              <div class="mr-5"><?php if($cash==null) echo 0; else echo $cash-$expense; ?> Rs.</div>
            </div>
          </div>
        </div>
        <div class="col-xl-2 col-sm-6 mb-3" id="display_b">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-bank"></i>
              </div>
                    <?php 
                    $sq15= "SELECT Balance AS Cash FROM general_journal_detail AS GD, general_journal_master AS GM, Account_Title AS A WHERE A.Account_Title_ID = GD.Account_Title_ID AND A.Account_Title = 'Bank A/c' AND GD.Voucher_ID=GM.Voucher_ID AND Transaction_Date='$current_date1' ORDER BY General_Journal_Detail_ID DESC Limit 1";
                    //print_r($sql4);
                    //exit();
                    $run15 = mysqli_query($ob->connect(),$sq15);
                    $row15 = mysqli_fetch_array($run15);

                    $cash_b = $row15['Cash'];

                    //$cashincounter = $totalsale - $expense;

                    ?>
              <div class="mr-5" style="font-weight: bold; font-size: 22px;"> Cash in Bank</div>
              <div class="mr-5"><?php if($cash_b==null) echo "0"; else echo $cash_b; ?> Rs.</div>
            </div>
          </div>
        </div>
      </div>
      <!-- Area Chart Example-->
      <div class="card mb-3" style="width: 60%; margin: auto;">
        <div class="card-header">
          <i class="fa fa-money"></i> Latest Transactions</div>
          <div class="card-body">
            <div class="table-responsive">
          <table class="table table-bordered" cellspacing="0">
            <thead>
              <tr>
                  <th> Id</th>
                  <th> Date </th>
                  <th> Total</th>
                  <th> Discount</th>
                  <th> Grand Total</th>
                </tr>
            </thead>

                  <?php
                  $sql = "SELECT *, date_format(Date, '%d/%m/%Y') AS Inv_Date FROM Invoice_master ORDER BY Invoice_No DESC Limit 10";
                  $run = mysqli_query($ob->connect(),$sql);

                  for($i=0; $query = mysqli_fetch_array($run); $i++){

                  ?>
              <tbody>
                <tr>
                  <td><a href="frm_sales_return.php?InvoiceNo=<?php echo $query['Invoice_No']; ?>"><?php echo $query['Invoice_No']; ?></a></td>
                  <td><?php echo $query['Inv_Date']; ?></td>
                  <td><?php echo $query['Master_Total']; ?></td>
                  <td><?php echo $query['Discount']; ?></td>
                  <td><?php echo $query['GrandTotal']; ?></td>
                </tr>
              </tbody>
            <?php } ?>
            </table>
            </div>
          </div>
       
        <div class="card-footer small text-muted">
          <a href="frm_invoice.php" class="btn btn-sm btn-info float-left">Generate New Invoice</a>
                <a href="invoice_list_report.php" class="btn btn-sm btn-secondary float-right" target="_blank">View All Invoices</a>
        </div>
      </div>
          </div>
          
          <!-- /Card Columns-->
        </div>
      <!-- Example DataTables Card-->
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php include('footer.php'); ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
 
    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendors/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendors/chartjs/Chart.min.js"></script>
    <script src="vendors/datatables/jquery.dataTables.js"></script>
    <script src="vendors/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="jss/sb-admin.min.js"></script>
    <script src="jss/raphael-min.js"></script>
    <script src="jss/morris.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="jss/sb-admin-datatables.min.js"></script>
    <!--<script src="jss/sb-admin-charts.min.js"></script>-->
  
</body>

<?php

if($run_2['Home'] == 1)
$display=1;
else
$display=0;

?>

        <script type="text/javascript">
          var display=" <?php echo $display; ?> ";
          if(display==1)
            console.log("display allowed");

          else
        {
          $("#display_s").css("display","none");
          $("#display_p").css("display","none");
          $("#display_e").css("display","none");
          $("#display_c").css("display","none");
          $("#display_b").css("display","none");
        }
          
        </script>
        <?php
        include 'security_layer.php';
        ?>


</html>
