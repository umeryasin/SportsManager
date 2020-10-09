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

  <title>General Journal</title>
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
  <br>
  <div class="">
    <div class="container-fluid">
      <!-- Example DataTables Card-->
      <div align="center">
        <form action="frm_general_journal.php" method="Post">

          <label>From : </label>
          <input type="date" style="width: 160px;" name="date1" value="">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <label>To : </label>
          <input type="date" style="width: 160px;" name="date2" value="">
          &nbsp;&nbsp;&nbsp;&nbsp;
          <button class="btn btn-success" style="width: 100px; height:35px; margin-top:-8px;margin-left:8px;" type="submit"><i class="fa fa-search fa-large"></i> Search</button><br>

          <?php 

          error_reporting(0);               
               
                $fromdate = date_create($_POST['date1']);
                  $todate   = date_create($_POST['date2']);
                  $from_date  = $_POST['date1'];
                  $to_date    = $_POST['date2'];
                  $Description = null;
          ?>
          <?php 

          $sql1 = "SELECT * FROM business_info";
          $query = mysqli_query($ob->connect(),$sql1);
          $row = mysqli_fetch_array($query);
          ?>
          <hr style="width: 500px;">
          <h5 align="center"><?php echo $row['Business_Name']; ?></h5>
          <h5 align="center"> General Journal </h5>
          <h6 align="center"> Duration:&nbsp;&nbsp;From:&nbsp;&nbsp;<?php echo date_format($fromdate,"d-M-Y") ?> &nbsp;&nbsp;&nbsp;To:&nbsp;&nbsp; <?php echo date_format($todate,"d-M-Y") ?> </h6>

            <table class="" id="" width="80%" cellspacing="0" border= "0">
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
            <table class="" id="" width="80%" style="line-height:30px;" cellspacing="0" border= "0">
              <thead>
                <tr style="border-bottom: 1px solid;">
                  <th width="10%"> Date</th>
                  <th width="25%"> Account Title</th>
                  <th width="25%"> </th>
                  <th width="10%"> Debit</th>
                  <th width="10%"> Credit</th>
                </tr>
              </thead>
            <tbody>
              <?php

                  $Current_Date = date('Y-m-d');
                   
                  //print_r($sql);
                  //exit();
                   
                 // print_r($sql1);
                  //exit();
                   
                    if ($from_date == "" && $to_date == "") {
                       $sql4 = "SELECT Voucher_ID,Description FROM general_journal_master WHERE Transaction_Date <= '$Current_Date' ";
                    }else{
                    $sql4 = "SELECT Voucher_ID,Description FROM general_journal_master
                    WHERE Transaction_Date BETWEEN '$from_date' AND '$to_date'";
                  }

                  $query4 = mysqli_query($ob->connect(),$sql4);

                  for($i=0; $row4 = mysqli_fetch_array($query4);$i++){
                   
                      $Voucher_ID = $row4['Voucher_ID'];

                      if ($from_date == "" && $to_date == "") {
                       $sql1 = "SELECT G1.Voucher_ID, date_format(Transaction_Date, '%d/%m/%Y') as Transaction_Date, Account_Title, A.Account_Title_ID, Entry_Type, Amount, Description FROM general_journal_master AS G1, general_journal_detail AS G2, Entry_Type AS E, account_title AS A
                    WHERE G1.Voucher_ID = G2.Voucher_ID AND G2.Entry_Type_ID = E.Entry_Type_ID AND E.Entry_Type_ID = 0 AND A.Account_Title_ID = G2.Account_Title_ID AND Transaction_Date <= '$Current_Date' AND G1.Voucher_ID = $Voucher_ID";
                    }else{
                    $sql1 = "SELECT G1.Voucher_ID, date_format(Transaction_Date, '%d/%m/%Y') as Transaction_Date, Account_Title, A.Account_Title_ID, Entry_Type, Amount, Description FROM general_journal_master AS G1, general_journal_detail AS G2, Entry_Type AS E, account_title AS A
                    WHERE G1.Voucher_ID = G2.Voucher_ID AND G2.Entry_Type_ID = E.Entry_Type_ID AND E.Entry_Type_ID = 0 AND A.Account_Title_ID = G2.Account_Title_ID AND Transaction_Date BETWEEN '$from_date' AND '$to_date' AND G1.Voucher_ID = $Voucher_ID";
                  }

                      $query1 = mysqli_query($ob->connect(),$sql1);
                      $x = 0;
                      for($a=0;$row1=mysqli_fetch_array($query1);$a++){
                        $x++;
                        if($x==1){
                      ?>                                        
                 
                    <tr>
                      <td><?php echo $row1['Transaction_Date']; ?></td>
                      <td colspan="2"><?php echo $row1['Account_Title']; ?></td>
                      <td><?php echo $row1['Amount']; ?></td>
                      <td></td>
                    </tr>
                    <tr>
                      <?php }else{  ?>

                    <tr>
                      <td></td>
                      <td colspan="2"><?php echo $row1['Account_Title']; ?></td>
                      <td><?php echo $row1['Amount']; ?></td>
                      <td></td>
                    </tr>
                    <tr>

                      <?php
                      }} 
                   
                   if ($from_date == "" && $to_date == "") {

                  $sql2 = "SELECT A.Account_Title_ID,Account_Title, Entry_Type, Amount, Description FROM general_journal_master AS G1, general_journal_detail AS G2, Entry_Type AS E, account_title AS A
                          WHERE G1.Voucher_ID = G2.Voucher_ID AND G2.Entry_Type_ID = E.Entry_Type_ID AND E.Entry_Type_ID = 1 AND A.Account_Title_ID = G2.Account_Title_ID AND Transaction_Date <= '$Current_Date' AND G1.Voucher_ID = $Voucher_ID";
                        }else{
                          $sql2 = "SELECT A.Account_Title_ID,Account_Title, Entry_Type, Amount, Description FROM general_journal_master AS G1, general_journal_detail AS G2, Entry_Type AS E, account_title AS A
                          WHERE G1.Voucher_ID = G2.Voucher_ID AND G2.Entry_Type_ID = E.Entry_Type_ID AND E.Entry_Type_ID = 1 AND A.Account_Title_ID = G2.Account_Title_ID AND  Transaction_Date BETWEEN '$from_date' AND '$to_date' AND G1.Voucher_ID = $Voucher_ID"; 

                        }

                  $query2 = mysqli_query($ob->connect(),$sql2); 
                  for($j=0; $row2 = mysqli_fetch_array($query2); $j++){
                   ?>              
                        <tr>
                          <td></td>
                          <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row2['Account_Title']; ?></td>
                          <td></td>
                          <td><?php echo $row2['Amount']; ?></td>
                        </tr>
                  <?php } ?>
                  
                      <tr>
                          <td></td>
                          <td colspan="2" style="border-bottom: 1px solid;"><?php echo "(".$row4['Description'].")"; ?></td>
                          <td></td>
                          <td></td>
                        </tr>
                  <?php             
          }

         ?>
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