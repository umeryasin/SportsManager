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

  <title>Income Statement</title>
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
          <h5 align="center"> Income Statement </h5>
          <h6 align="center"> <?php echo date("d-M-Y") ?></h6>

            <table class="" id="" width="65%" cellspacing="0" border= "0">
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
            <table class="" id="" width="65%" style="line-height:30px;" cellspacing="0" border= "1">
              <tbody>
                <tr>
                  <td><b>Account Title</b></td>
                  <td><b>Debit</b></td>
                  <td><b>Credit</b></td>
                </tr>

             <?php

                     $sql = "DELETE FROM income_statement";
                    $query1 = mysqli_query($ob->connect(),$sql);
 
                    $sql1 = "SELECT * FROM trial_balance T, Account_Title A WHERE T.Account_Title_ID = A.Account_Title_ID AND A.Account_Title_ID IN(1,40,41,43)";
                    $query1 = mysqli_query($ob->connect(),$sql1);
                    //print_r($sql1);
                    //exit();

                  for($i=0; $row1 = mysqli_fetch_array($query1); $i++){

                    $Account_Title_ID = $row1['Account_Title_ID'];
                    $Entry_Type_ID = $row1['Entry_Type_ID'];
                    $Amount = $row1['Trial_Balance'];

                    $sql2 = "INSERT INTO `income_statement`(`Account_Title_ID`, `Entry_Type_ID`, `Amount`,`Bit`) VALUES ($Account_Title_ID,$Entry_Type_ID,$Amount,0)";
                     $query2 = mysqli_query($ob->connect(),$sql2);
                  }

                  $sql1 = "SELECT * FROM trial_balance T, Account_Title A WHERE T.Account_Title_ID = A.Account_Title_ID AND A.Head_of_Account_ID = 3";
                    $query1 = mysqli_query($ob->connect(),$sql1);
                    //print_r($sql1);
                    //exit();
                   
                  for($i=0; $row1 = mysqli_fetch_array($query1); $i++){
                    $Account_Title_ID = $row1['Account_Title_ID'];
                    $Entry_Type_ID = $row1['Entry_Type_ID'];
                    $Amount = $row1['Trial_Balance'];

                    $sql2 = "INSERT INTO `income_statement`(`Account_Title_ID`, `Entry_Type_ID`, `Amount`,`Bit`) VALUES ($Account_Title_ID,$Entry_Type_ID,$Amount,1)";
                     $query2 = mysqli_query($ob->connect(),$sql2);
                  }
///////////////////////////////////////////////
                  $sql3 = "SELECT * FROM income_statement AS I, Account_Title AS A, Entry_Type AS E WHERE I.Account_Title_ID = A.Account_Title_ID AND I.Entry_Type_ID = E.Entry_Type_ID AND A.Account_Title_ID IN(1,40,41,43)"; 
                  $query3 = mysqli_query($ob->connect(),$sql3);
                  for($i=0; $row3 = mysqli_fetch_array($query3); $i++){
                    $Entry_Type_ID = $row3['Entry_Type_ID'];                    
                    ?>                        
                <tr>
                  <td width="70%"><?php echo $row3['Account_Title']; ?></td>
                  <td style="width: 100px"><?php if ($Entry_Type_ID == 0) {
                   echo $row3['Amount']; } ?></td>
                  <td style="width: 100px"><?php if ($Entry_Type_ID == 1) {
                  echo $row3['Amount']; }?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php
          $sql_debit = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 0 AND Bit = 0";
             $query_debit = mysqli_query($ob->connect(),$sql_debit);
             $row_debit = mysqli_fetch_array($query_debit);

          $sql_credit = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 1 AND I.Account_Title_ID <> 39 AND Bit = 0";
             $query_credit = mysqli_query($ob->connect(),$sql_credit);
             $row_credit = mysqli_fetch_array($query_credit);
            $amount_credit = $row_credit['Amount'] - $row_debit['Amount'];
              ?>
          <table class="" id="" width="65%" style="line-height:30px;" cellspacing="0" border= "1">
              <tbody>
                <tr style="border-top: 1px solid; border-bottom: 1px solid; width: 100px">
                  <td width="70%"><b>Gross Profit (Loss if in Debit):</b></td>
                  <td><b><?php echo 0; ?></b></td>
                  <td style="width: 122px"><b><?php echo $amount_credit; ?></b></td>
                </tr>                 
              </tbody>
            <?php  ?>
            </table>
            <br>
            <table class="" id="" width="65%" style="line-height:30px;" cellspacing="0" border= "1">
              <tbody>
            <?php
            $sql3 = "SELECT * FROM income_statement AS I, Account_Title AS A, Entry_Type AS E WHERE I.Account_Title_ID = A.Account_Title_ID AND I.Entry_Type_ID = E.Entry_Type_ID AND NOT A.Account_Title_ID  IN(1,40,41,43)"; 
                  $query3 = mysqli_query($ob->connect(),$sql3);
                  for($i=0; $row3 = mysqli_fetch_array($query3); $i++){
                    $Entry_Type_ID = $row3['Entry_Type_ID'];                    
                    ?>                        
                <tr>
                  <td width="70%"><?php echo $row3['Account_Title']; ?></td>
                  <td style="width: 100px"><?php if ($Entry_Type_ID == 0) {                    
                   echo $row3['Amount']; } ?></td>
                  <td style="width: 100px"><?php if ($Entry_Type_ID == 1) {
                  echo $row3['Amount']; }?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <table class="" id="" width="65%" style="line-height:30px;" cellspacing="0" border= "1">
              <tbody>
                <tr style=" width: 100px; height: 30px;">
                  <td width="70%"><b style="float: right;"></b></td>
                  <td><b></b></td>
                  <td style="width: 122px"><b></b></td>
                </tr>                          
              </tbody>
          </table>
          <?php
          $sql5 = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 0 AND Bit = 1";
             $query5 = mysqli_query($ob->connect(),$sql5);
             $row5 = mysqli_fetch_array($query5);

          $sql6 = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 1 ";//AND NOT I.Account_Title_ID  IN(1,40,41,43) AND Bit = 1";
             $query6 = mysqli_query($ob->connect(),$sql6);
             $row6 = mysqli_fetch_array($query6);
             $net_profit = $amount_credit - $row5['Amount']; 
              ?>
          <table class="" id="" width="65%" style="line-height:30px;" cellspacing="0" border= "1">
              <tbody>
                <tr style="border-top: 1px solid; border-bottom: 1px solid; width: 100px">
                  <td width="70%"><b style="float: right;">Balance c/d</b></td>
                  <td><b><?php echo 0; ?></b></td>
                  <td style="width: 122px"><b> <?php echo $net_profit; ?></b></td>
                </tr>                          
              </tbody>
          </table>
          <?php
          $sql5 = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 0 AND Bit = 1";
             $query5 = mysqli_query($ob->connect(),$sql5);
             $row5 = mysqli_fetch_array($query5);

          $sql6 = "SELECT SUM(Amount) as Amount FROM income_statement AS I WHERE I.Entry_Type_ID = 1 ";//AND NOT I.Account_Title_ID  IN(1,40,41,43) AND Bit = 1";
             $query6 = mysqli_query($ob->connect(),$sql6);
             $row6 = mysqli_fetch_array($query6);
              ?>
          <table class="" id="" width="65%" style="line-height:30px;" cellspacing="0" border= "1">
              <tbody>
                <tr style="border-top: 1px solid; border-bottom: 1px solid; width: 100px">
                  <td width="70%"><b>Net Profit (Loss if in Debit):</b></td>
                  <td><b><?php echo $net_profit; ?></b></td>
                  <td style="width: 122px"><b></b></td>
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