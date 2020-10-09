<?php
include 'connect.php';
  //Start session
include 'auth.php';
?>

<!DOCTYPE>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <script src="jquery-3.3.1.min.js"></script>

  <title>POS</title>
  
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <script>
function sum() {
            var txtFirstNumberValue = document.getElementById('txt1').value;
            var txtSecondNumberValue = document.getElementById('txt2').value;
            var result = parseInt(txtFirstNumberValue) - parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt3').value = result;
        
            }
      
       var txtFirstNumberValue = document.getElementById('txt11').value;
            var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt22').value = result;        
            }
      
       var txtFirstNumberValue = document.getElementById('txt11').value;
            var txtSecondNumberValue = document.getElementById('txt33').value;
            var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt55').value = result;
        
            }
      
       var txtFirstNumberValue = document.getElementById('txt4').value;
       var result = parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('txt5').value = result;
        }
      
        }
</script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include 'navbar.php' ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Receipt And Payment Vouchers</li>
      </ol><br>
      <div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="dashboard.php" class="btn btn-large btn-primary" style="float: left;"><i class="fa fa-arrow-left fa-large"></i> Back</a>
      <div  id="voucher_head" style="position: relative; left: 90px;">
        <h1>Research & Solution</h1>
      </div>
</div><br><br>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header" align="center">
          <i class="fa fa-fw fa-copy"></i> Receipt And Payment Voucher</div>
        <div class="card-body">
            
            <!---Start-->
            <form action="save_rp.php" method="post">
  <p><b style="float: left;">Transaction Date</b><b style="float: left; margin-left: 112px;">Transaction Number</b><b style="float: left ;margin-left: 35px;">Is Adjustment</b>
    <b style="margin-left: 21px;">Memo</b></p>
<input type="date" name="trans_date" class="tcal tcalInput" value="" style="height:35px; color:#222; width:180px; float: left;" />

<input type="text" name="trans_no" value="" placeholder="Transaction Number" style="height:35px; color:#222; width:180px; float: left; margin-left: 60px;" />
<input type="checkbox" style="margin-left: 7px; float: left;" value="Yes" name="adj">
<input type="text" name="memo" value="" placeholder="Memo" style="height:35px; color:#222; width:180px; float: left; margin-left: 114px;" />
<br>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
  <thead>
    <tr>
      <th> Select</th>
      <th> ACCOUNT </th>
      <th> Entry Type </th>
      <th> Amount</th>
      <th> DESCRIPTION </th>

    </tr>
  </thead>
  <tbody>
    
      
      <tr id="yes">
      <td><input type="checkbox" name="record"></td>
      <td><select name="select_head_of_accounts" style="width:180px; height:30px; margin-left:-5px;">
  <?php
  include('connect.php');
  $result = $con->prepare("SELECT HeadOfAccounts_Name FROM `headofaccounts_info`");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
  ?>
    <option><?php echo $row['HeadOfAccounts_Name']; ?></option>
  <?php
  }
  ?>
</select>
</td>
      <td>
        <select style="width: 180px; height: 35px;" name="select_entry_type">
          <?php
          include('connect.php');
          $result = $con->prepare("SELECT * FROM `entrytype_info`");
          $result->bindParam(':userid', $res);
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          ?>
          <option><?php echo $row['EntryType_Info']; ?></option>
          <?php
          }
          ?>
        </select>
      </td>
      <td><input type="text" name="txt_amount" placeholder="Amount" style="width: 180px; height: 35px;"></td>
      <td><input type="text" name="txt_description" placeholder="Description" style="width: 180px; height: 35px;"></td>
      
      </tr>
      
      
    
    
    
      <tr>
        <th><strong style="font-size: 20px; color: #222222;">SUM:</strong></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    
  </tbody>
</table><br>

      <button class="btn btn-info btn-large" style="margin-left: 400px;"><i class="icon icon-save icon-large"></i> Save</button>
</form>
<form>
<input type="button" id="add-row" value="Add Row" class="btn btn-success">

<button type="button" id="delete-row" class="btn btn-danger"> Delete Row</button>
</form>
            <!---End-->
        </div>
      </div>
      

    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          
        </div>
      </div>
    </footer>
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
            <a class="btn btn-primary" href="#">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!--Start Row Generator jQuery Function-->

<script type="text/javascript">
    $("#yes").ready(function(){
        $("#add-row").click(function(){
            //var name = $("#name").val();
            //var email = $("#email").val();
            var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + "<select name='select_head_of_accounts' style='width:180px; height:30px; margin-left:-5px;'><?php include('connect.php'); $result = $con->prepare('SELECT HeadOfAccounts_Name FROM `headofaccounts_info`'); $result->bindParam(':userid', $res); $result->execute(); for($i=0; $row = $result->fetch(); $i++){ ?> <option><?php echo $row['HeadOfAccounts_Name']; ?></option> <?php } ?> </select>" +"</td><td>"+ "<select style='width: 180px; height: 35px;' name='select_entry_type'><?php include('connect.php'); $result = $con->prepare("SELECT * FROM `entrytype_info`"); $result->bindParam(':userid', $res); $result->execute(); for($i=0; $row = $result->fetch(); $i++){ ?> <option><?php echo $row['EntryType_Info']; ?></option> <?php } ?></select>" + "</td><td>" + "<input type='text' name='txt_amount' placeholder='Amount' style='width: 180px; height: 35px;'>" + "</td><td>" + "<input type='text' name='txt_description' placeholder='Description' style='width: 180px; height: 35px;'>" + "</td></tr>";
            $("table tbody").append(markup);
        });
        
        // Find and remove selected table rows
        $("#delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
              if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
        });
    });    
</script>
<!--End Row Generator jQueryFunction-->
    <!-- Bootstrap core JavaScript-->
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
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this Country Info ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_country_info.php",
   data: info,
   success: function(){
   window.location = 'frm_country_info.php';
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
    .animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
  </div>
</body>

</html>
