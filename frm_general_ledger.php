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
        <form method="Post" action="frm_general_ledger.php">
        <label>Select Account:</label>
          <select name="Account_Title_ID" style="width:160px">
                    <option>--Select Accounts--</option>
              <?php
              $result = $con->prepare("SELECT * FROM account_title");
              $result->bindParam(':userid', $res);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
                ?>
                <option value="<?php echo $row['Account_Title_ID']; ?>"><?php echo $row['Account_Title']; ?></option>
                <?php
              }
              ?>
          </select>
          <button class="btn btn-success" style="width: 100px; height:35px; margin-top:-8px;margin-left:8px;" type="submit" name="Submit"><i class="fa fa-search fa-large"></i> View</button><br>

          <?php 

          error_reporting(0);               
               
                  if(!isset($_POST['Submit']))

                    $account_ID = "";
                  else
                  $account_ID    = $_POST['Account_Title_ID'];

                  $sql2 = "SELECT * FROM Account_Title Where Account_Title_ID = $account_ID";

                  $query2 = mysqli_query($ob->connect(),$sql2);

                  $row2 = mysqli_fetch_array($query2);

                  $ccount_Code = $row2['Account_Code'];

                  $account_title = $row2['Account_Title'];
          ?>

          <hr style="width: 800px;">
          <h5 align="center"> Fashion Shop </h5>
          <h5 align="center"> General Ledger </h5>
          <table border = "0" width="80%"><tr><td>
          <h6 align="left">Account Title:&nbsp;&nbsp;<?php echo $account_title; ?></h6>
        </td><td><h6 align="right">Account Code:&nbsp;&nbsp;<?php echo $ccount_Code; ?></h6></td><tr><table>
                   
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
                    $CurrentDate = date('Y-m-d');

                    $sql1 = "SELECT date_format(Transaction_Date, '%d/%m/%Y') as Transaction_Date, Entry_Type_ID, Amount, Balance, Description FROM general_journal_detail GD, Account_Title A , general_journal_master GM WHERE GD.Account_Title_ID = A.Account_Title_ID AND A.Account_Title_ID = GD.Account_Title_ID AND GM.Voucher_ID = GD.Voucher_ID AND GD.Account_Title_ID = $account_ID AND Transaction_Date <= '$CurrentDate'";

                    //print_r($sql1);

                    //exit();

                  $query1 = mysqli_query($ob->connect(),$sql1);
                 
                  for($i=0; $row1 = mysqli_fetch_array($query1); $i++){
                             
                  $Balance = $row1['Balance'];
              
                  if($row1['Balance']<0)
                    $Balance = $Balance * -1.0;                

                    ?>

                  <?php if($row1['Entry_Type_ID'] == 0) {?>
                  <tr >
                  <td width="15%"><?php echo $row1['Transaction_Date'] ;?></td>
                  <td width = "40%"><?php echo $row1['Description'] ; ?></td>
                  
                  <td width="15%"><?php echo $row1['Amount'] ?></td>
                  
                  <td width="15%"></td>
                  
                  <td width="15%"><?php echo number_format($Balance,2); ?></td></tr>
                  <?php } else{ ?>                       
                   <tr >
                  <td width="15%"><?php echo $row1['Transaction_Date'] ;?></td>
                  <td width = "40%"><?php echo $row1['Description'] ; ?></td>
                  
                  <td width="15%"></td>
                  
                  <td width="15%"><?php echo $row1['Amount'] ?></td>
                 
                  <td width="15%"><?php echo number_format($Balance,2); ?></td>
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