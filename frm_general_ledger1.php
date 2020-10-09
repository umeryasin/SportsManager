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

  <title>General Ledger</title>
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
        <form method="Post" action="#">
        
          <h5 align="center"> Fashion Shop </h5>
          <h5 align="center"> General Ledger </h5>
          <table border = "0" width="80%"><tr><td>
          </td><tr></table>
          
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
          <br>
                  
            <table align="center" width="80%" style="line-height:40px;" cellspacing="0" border= "0">
              <thead>
                <th>Date</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
            </thead>
            <tbody>
              <?php

              include('connect.php');
              $id = $_GET['id'];
             // print_r($id);

              //exit();
              
                  $sql1 = $con->prepare("SELECT date_format(Transaction_Date, '%d/%m/%Y') as Transaction_Date, Entry_Type_ID, Amount, Balance, Description FROM general_journal_detail GD, Account_Title A, general_journal_master GM WHERE GD.Account_Title_ID = A.Account_Title_ID AND A.Account_Title_ID = GD.Account_Title_ID AND GM.Voucher_ID = GD.Voucher_ID AND GD.Account_Title_ID = A.Account_Title_ID AND A.Account_Title_ID = '$id'");
                  //$sql1->bindParam(':userid', $id);

                  $sql1->execute();
                //  print_r($sql1);
                //  exit();
                  for($i=0; $row1 = $sql1->fetch(); $i++){

                    $Balance = $row1['Balance'];
                    if ($Balance<0){
                        $Balance = $Balance * -1.0;                      
                    }

                ?>             
                  
                  <?php if($row1['Entry_Type_ID'] == 0) {?>
                  <tr >
                  <td width="15%"><?php echo $row1['Transaction_Date'] ;?></td>
                  <td width = "40%"><?php echo $row1['Description'] ; ?></td>
                  
                  <td width="15%"><?php echo $row1['Amount'] ?></td>
                  
                  <td width="15%"></td>
                  
                  <td width="15%"><?php echo number_format("$Balance",2); ?></td></tr>
                  <?php } else{ ?>                       
                   <tr>
                  <td width="15%"><?php echo $row1['Transaction_Date'] ;?></td>
                  <td width = "40%"><?php echo $row1['Description'] ; ?></td>
                  
                  <td width="15%"></td>
                  
                  <td width="15%"><?php echo $row1['Amount'] ?></td>
                  
                  <td width="15%"><?php echo number_format("$Balance",2); ?></td>
                  </tr>     
                  <?php } 
                } ?>
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