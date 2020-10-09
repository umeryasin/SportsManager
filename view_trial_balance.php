<?php
include 'connect.php';
  //Start session
include 'auth.php';

if($_SESSION['admin'] != "admin")
    header("location: index.php");
?>

<!DOCTYPE>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Trial Balance</title>
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
  <br>
  <div class="">
    <div class="container-fluid">
      <!-- Example DataTables Card-->

      <div align="center">
        <form action="save_trial_balance.php" method="Post">

          <label>Date : </label>
          <input type="date" style="width: 160px;" name="Trial_Balance_Date" value="">
         
          &nbsp;&nbsp;&nbsp;&nbsp;
          <button class="btn btn-success btn-large" style="margin-top:-8px;margin-left:8px;" type="" name="save"><i class="fa fa-plus-circle fa-large"></i> Post</button>
          <button class="btn btn-success btn-large" id="show" style="margin-top:-8px;margin-left:8px;" type="" name="save"><i class="fa fa-eye fa-large"></i> View</button>
          <br>
          <?php
          error_reporting(0);

          if(date_create($_POST['Trial_Balance_Date'])!= ""){

          $fromdate = date_create($_POST['Trial_Balance_Date']);
          ?>
         
          <hr style="width: 500px;">
          <h5 align="center"> Fashion Shop </h5>
          <h5 align="center"> Trial Balance </h5>
          <h6 align="center"> Date:&nbsp;&nbsp;<?php echo date_format($fromdate,"d-M-Y") ?></h6>
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
            <div id="view">
            <table width="80%" style="line-height:40px;" cellspacing="0" border= "0">
              <thead>
                <tr style="border-bottom: 1px solid;">
                  
                  <th width="25%"> Account Title</th>
                  <th width="10%"> Debit</th>
                  <th width="10%"> Credit</th>
                </tr>
              </thead>

              <?php

              $con = mysqli_connect('localhost','root','','db_pointofsale');
               

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

              $sql4 = "SELECT A.account_title, T.Entry_Type_ID, Trial_Balance FROM account_title AS A, entry_type AS E, Trial_Balance AS T WHERE A.account_title_id = T.account_title_id AND E.Entry_Type_ID = T.Entry_Type_ID";
             // print_r($sql4);
              //exit();

              $run1 = mysqli_query($con,$sql4);

              for($i=0; $row5 = mysqli_fetch_array($run1); $i++){
    ?>

      <tr>
        <td><?php echo $row5['account_title']; ?></td>
        <?php if($row5['Entry_Type_ID']== 0){
          ?>
        <td><a href="frm_general_ledger1.php"><?php echo $row5['Trial_Balance']; ?></a></td>
        <td></td>
      <?php }else{ ?>
      <td></td>
      
      <td><a href="frm_general_ledger1.php"><?php echo $row5['Trial_Balance']; ?></a></td>
      </tr>
    <?php
      } 
    } //Second For Loop Close
              ?>
            <tr>
              <td><b>Total Balance :</b></td>
              <td><b>
              <?php 

              $sql6 = "SELECT SUM(Trial_Balance) AS Total_Debit FROM Trial_Balance WHERE Entry_Type_ID = 0";

              $run6 = mysqli_query($con,$sql6);

              $row6 = mysqli_fetch_array($run6);

              echo $row6['Total_Debit'];

               ?></b></td>
                <td><b>
              <?php 

              $sql7 = "SELECT SUM(Trial_Balance) AS Total_Credit FROM Trial_Balance WHERE Entry_Type_ID = 1";

              $run7 = mysqli_query($con,$sql7);

              $row7 = mysqli_fetch_array($run7);
              $balance = $row7['Total_Credit'];
              echo $balance;

               ?></b></td>
            </tr>
              
            </table>
            </div>  

          </form>
      </div>
    </div>
  <?php } ?>
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