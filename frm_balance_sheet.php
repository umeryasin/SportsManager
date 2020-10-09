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

  <title>Balance Sheet</title>
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

</head>
<body class="fixed-nav sticky-footer bg-white" id="page-top">
  <!-- Navigation-->
 
  <div class="">
    <div class="container-fluid">
      <!-- Example DataTables Card-->
      <div align="center">
        <form action="frm_income_statement.php" method="Post">
          <?php 
          $sql1 = "SELECT * FROM business_info";
          $query = mysqli_query($ob->connect(),$sql1);
          $row = mysqli_fetch_array($query);
          ?>
          <h5 align="center"><?php echo $row['Business_Name']; ?></h5>
          <h5 align="center"> Balance Sheet </h5>
          <h6 align="center"> <?php echo date("d-M-Y") ?></h6>

            <table class="" id="" width="90%" cellspacing="0" border= "0">
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
            <br>
            <table class="" id="" width="50%" style="line-height:30px; float: left;" cellspacing="0" border= "0">
              <tbody>
                <tr>
                  <td width="10%"><b>Assets :</b></td>
                  <td></td>
                  <td></td>
                  
                </tr>
                  <?php
                  $sql1 = "SELECT Account_Title, Amount FROM link_accounts AS LA, account_title AS A 
                  WHERE LA.Account_Title_ID = A.Account_Title_ID AND LA.Head_of_Account_ID IN(5,11)";
                  $query1 = mysqli_query($ob->connect(),$sql1);

                  for($i=0; $row1 = mysqli_fetch_array($query1); $i++){
                  ?>
                <tr>
                  <td></td>
                  <td width="25%"><?php echo $row1['Account_Title']; ?></td>
                  <td width="8%"><?php echo $row1['Amount']; ?></td>
                </tr>              
              <?php } ?>
                <?php
                $sql2 = "SELECT SUM(Amount) as Assets FROM link_accounts AS LA WHERE LA.Head_of_Account_ID IN(5,11)";
                $query2 = mysqli_query($ob->connect(),$sql2);
                for($i=0; $row2 = mysqli_fetch_array($query2); $i++){
                $assets = $row2['Assets'];
                ?>
                <tr>
                  <td></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Total Assets: (Rs.)</b></td>
                  <td style="border-top: 1px solid; border-bottom: 1px solid; width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $row2['Assets']; ?></b></td>
                </tr>   
              </tbody>
            <?php } ?>
            </table>
            <table class="" id="" width="50%" style="line-height:30px;" cellspacing="0" border= "0">
              <tbody>
                <tr>
                  <td width="10%"><b>Liabilities :</b></td>
                  <td></td>
                  <td></td>
                </tr>
                <?php
                $sql3 = "SELECT Account_Title, Amount FROM link_accounts AS LA, account_title AS A 
                WHERE LA.Account_Title_ID = A.Account_Title_ID AND LA.Head_of_Account_ID = 6";
                $query3 = mysqli_query($ob->connect(),$sql3);

                for($i=0; $row3 = mysqli_fetch_array($query3); $i++){
                ?>
                <tr>
                  <td></td>
                  <td width="25%"><?php echo $row3['Account_Title']; ?></td>
                  <td width="8%"><?php echo $row3['Amount']; ?></td>                 
                </tr>              
              <?php } ?>
                  <?php
                  $sql4 = "SELECT SUM(Amount) as Liability FROM link_accounts AS LA WHERE LA.Head_of_Account_ID = 6";
                  $query4 = mysqli_query($ob->connect(),$sql4);
                  for($i=0; $row4 = mysqli_fetch_array($query4); $i++){
                  $liabilities = $row4['Liability'];
                  ?>
                <tr>
                  <td></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Total Liabilities: (Rs.)</b></td>
                  <td style="border-top: 1px solid; border-bottom: 1px solid; width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $row4['Liability']; ?></b></td>                  
                </tr>                          
              </tbody>
            <?php } ?>
            </table>
            <table class="" id="" width="50%" style="line-height:30px;" cellspacing="0" border= "0">
              <tbody>
                <tr>
                  <td width="19%"><b>Owner's Equity :</b></td>
                  <td></td>
                  <td></td>
                </tr>
                  <?php
                  $sql5 = "SELECT Account_Title, Amount FROM link_accounts AS LA, account_title AS A 
                  WHERE LA.Account_Title_ID = A.Account_Title_ID AND LA.Head_of_Account_ID = 4";
                  $query5 = mysqli_query($ob->connect(),$sql5);
                  for($i=0; $row5 = mysqli_fetch_array($query5); $i++){
                  ?>
                <tr>
                  <td></td>
                  <td width="45%"><?php echo $row5['Account_Title']; ?></td>
                  <td width="8%"><?php echo $row5['Amount']; ?></td>                  
                </tr>              
              <?php } ?>
              <?php
          $sql_debit = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 0 AND Bit = 0";
             $query_debit = mysqli_query($ob->connect(),$sql_debit);
             $row_debit = mysqli_fetch_array($query_debit);

          $sql_credit = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 1 AND I.Account_Title_ID <> 39 AND Bit = 0";
             $query_credit = mysqli_query($ob->connect(),$sql_credit);
             $row_credit = mysqli_fetch_array($query_credit);
            $amount_credit = $row_credit['Amount'] - $row_debit['Amount'];
              ?>
              <?php
          $sql_net = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 0 AND Bit = 1";
             $query_net = mysqli_query($ob->connect(),$sql_net);
             $row_net = mysqli_fetch_array($query_net);
             $net_profit = $amount_credit - $row_net['Amount'];
              ?>
              <tr>
                  <td></td>
                  <td width="45%">Net Profit</td>
                  <td width="8%"><?php echo $net_profit; ?></td>
                </tr>  
                <?php
                $sql6 = "SELECT SUM(Amount) as Equity FROM link_accounts AS LA WHERE LA.Head_of_Account_ID = 4";
                $query6 = mysqli_query($ob->connect(),$sql6);
                for($i=0; $row6 = mysqli_fetch_array($query6); $i++){
                $Equity = $row6['Equity'];
                $net_balance = $row_net['Amount'];
                $total_equity = $Equity + $net_profit;
                $t_sum = $liabilities + $Equity + $net_profit;
                ?>
                <tr>
                  <td></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Total Equity: (Rs.)</b></td>
                  <td style="border-top: 1px solid; border-bottom: 1px solid; width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $total_equity; ?></b></td>
                </tr>
                <tr>
                <td></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Total Liabilities And Equity : (Rs.)</b></td>
                <td style="border-top: 1px solid; border-bottom: 1px solid; width: 100px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $t_sum; ?></b></td>
                </tr>                          
              </tbody>
              <?php } ?>
            </table>
            <br>
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