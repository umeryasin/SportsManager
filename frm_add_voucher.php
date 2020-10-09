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

$run_2 = mysqli_fetch_array($query_cus);

/*if ($query_cus) {
  $query_cus = 1;
}else{
  $query_cus = 0;
}*/

if($_SESSION['admin'] == "admin" && $run_2['Accounts'] == 1)
    
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

  <title>Add Voucher</title>

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
<body class="fixed-nav sticky-footer bg-white" id="page-top">
  <!-- Navigation-->
  <?php include 'navbar.php'; ?>
  <?php include 'nav3.php'; ?>
     
  <!--Nav-End-->
  <br>
  <div style="margin-top: 94px;">
    <div class="container-fluid">
      <!-- Breadcrumbs-->

<div style="margin-top: -20px;" align="center">
<span style="font-size: 18px; padding-left: 15px; padding-right: 15px; "><img src="images/chart.png" style="width: 30px; height: 30px;"> <a href="frm_charts_of_account.php"> Charts Of Account</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px; "><img src="images/title.png" style="width: 30px; height: 30px;"> <a href="frm_add_accounts.php" > Add Account Title</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px; "><img src="images/voucher.png" style="width: 30px; height: 30px;"> <a href="frm_add_voucher.php" style="color: red;"> Add Vouchers</a></span>

<hr style="width: 70%;">
</div><br>
      <!-- Example DataTables Card-->
      <?php 
      
      $sql = $con->prepare("SELECT IFNULL(MAX(Voucher_ID),0) +1 AS Voucher_ID FROM general_journal_master");

      $sql->bindParam(':userid', $res);
      $sql->execute();

      $query = $sql->fetch();

      $voucher_id = $query['Voucher_ID']; 

      $sql1 = $con->prepare("SELECT IFNULL(MAX(General_Journal_detail_ID),0) +1 AS Detail_ID FROM general_journal_detail");

      //$sql1->bindParam(':userid', $res);
      $sql1->execute();

      $query1 = $sql1->fetch();

      $Detail_ID = $query1['Detail_ID']; 

      ?>
      <div style="margin-left: 50px;">
        <?php
          $voucher_number = sprintf('%02d',0);
          $row1 = $voucher_number.$voucher_id;
        ?>
        <form action="save_voucher.php" method="post">
         <label> Transaction Date : </label>
            &nbsp;&nbsp;
            <input type="date" style="width: 150px;" value="<?php echo date("Y-m-d"); ?>" name="Transaction_Date" required="">
            <label style="margin-left: 30px;"> Transaction # : </label>
            &nbsp;&nbsp;VR-
            <input type="text" style="width: 150px;" value="<?php echo $row1; ?>" name="Voucher_ID" readonly>
            <input type="hidden" style="width: 150px;" value="<?php echo $Detail_ID; ?>" name="Detail_ID">      
            <label style="margin-left: 50px;"> Is Adjustment : </label>
            &nbsp;
            <input type="checkbox" value="1" style="
            -moz-transform: scale(1.5); /* FF */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            padding: 10px;
          " name="Is_Adjustment">
            <label style="margin-left: 30px;"> Memo : </label>
            &nbsp;&nbsp;
            <input type="text" style="width: 150px;" value="" name="Memo_No">
            <input type="hidden" style="width: 150px;" value="" name="Balance">
            <br><br>
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th width="20%"> Accounts</th>
                  <th width="15%"> Debit</th>
                  <th width="15%"> Credit</th>
                  <th> Description</th>
                </tr>
              </thead>
              <tbody id="addr0">
                <tr>
                  <td> <select class="form-control" name="Account_Title_ID1">
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
                  </select></td>
                  <td><input type="text" class="form-control" id="debit1" name="Debit1"> </td>
                  <td><input type="text" class="form-control" id="credit1" name="Credit1" disabled="disabled"> </td>
                  <td><input type="text" class="form-control" id="description" name="Description"> </td>
                </tr>
                <tr>
                  <td> <select class="form-control" name="Account_Title_ID2">
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
                  </select></td>
                  <td><input type="text" class="form-control" id="debit2" name="Debit2" disabled="disabled"> </td>
                  <td><input type="text" class="form-control" id="credit2" name="Credit2"> </td>
                  <td><input type="text" class="form-control" id="desc" name="Description"> </td>
                </tr>
                <tr id='addr1'></tr>
                <tr>
                  <td> <strong style="float: right;">SUM :</strong></td>
                  <td> <input type="text" class="form-control" id="tdbt" name="" readonly=""></td>
                  <td> <input type="text" class="form-control" id="tcrd" name="" readonly=""></td>
                  <td> </td>
                </tr>
                <tr>
                  <td> <strong style="float: right;">SUM In Words :</strong></td>
                  <td colspan="2"> <input type="text" class="form-control" id="amount-rupees" name="" readonly=""></td>
                  <td> </td>
                  <td> </td>
                </tr>
              </tbody>
            </table>
            <div align="center">
              <button class="btn btn-success btn-large" name="save" style="width:100px;"><i class="fa fa-save fa-large"></i> Save</button>
            </div>
            <br>
              <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
          </form>
      </div>
    </div>
    <!-- /.content-wrapper-->
   <?php include('footer.php'); ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
<!-- JavaScript Libraries-->
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="dcalendar.picker.js"></script>
 
</script>
   <script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/num-to-words.js" type="text/javascript"></script>
<script>

/*$(document).ready(function(){
  $('#description').change(function() {
    $('#desc').val($(this).val());
});
});*/

$("#description").on("keyup",function(){
  $('#desc').val($(this).val());
});

$("#desc").on("keyup",function(){
  $('#description').val($(this).val());
});


//Enter Only Numbers
$(".numbers").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
               return false;
     }
});

var words="";
$(function() {
    $("#debit1").on("keydown keyup", converttoword);
  function converttoword() {
    var totaldebit1 = (
    Number($("#debit1").val())
    );
    $("#tdbt").val(totaldebit1);
    words1 = toWords(totaldebit1);
    $("#amount-rupees").val(words1 + "Rupees Only");
  }
});

$("#debit1").change(function(){

  if($("#debit1").val()>0){
    $("#credit1").attr('readonly',true);
    $("#debit2").attr('readonly',true);
  }
  else
  {
    $("#credit1").attr('readonly',false);
    $("#debit2").attr('readonly',false);
  }
});

$("#credit1").change(function(){
   if($("#credit1").val()>0){
  $("#debit1").attr('readonly',true);
  $("#credit2").attr('readonly',true);
}
  else
  {
    $("#debit1").attr('readonly',false);
    $("#credit2").attr('readonly',false);
  }
});

$("#debit2").change(function(){
  if($("#debit2").val()>0)
    $("#credit2").attr('readonly',true);
  else
    $("#credit2").attr('readonly',false);
});

$("#credit2").change(function(){
  if($("#credit2").val()>0)
    $("#debit2").attr('readonly',true);
  else
    $("#debit2").attr('readonly',false);
});
</script>
<script>
//Enter Only Numbers
$(".numbers").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
               return false;
     }
});

var words="";
$(function() {
    $("#credit1").on("keydown keyup", per);
  function per() {
    var totalcredit1 = (
    Number($("#credit1").val())
    );
    $("#tcrd").val(totalcredit1);
    words2 = toWords(totalcredit1);
    $("#amount-rupees").val(words2 + "Rupees Only");
  }
});
</script>
<script>
//Enter Only Numbers
$(".numbers").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
               return false;
     }
});

var words="";
$(function() {
    $("#debit2").on("keydown keyup", per);
  function per() {
    var totaldebit2 = (
    Number($("#debit2").val())
    );
    $("#tdbt").val(totaldebit2);
    words3 = toWords(totaldebit2);
    $("#amount-rupees").val(words3 + "Rupees Only");
  }
});
</script>

<script>
//Enter Only Numberss
$(".numbers").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
               return false;
     }
});

var words="";
$(function() {
    $("#credit2").on("keydown keyup", per);
  function per() {
    var totalcredit2 = (
    Number($("#credit2").val())
    );
    $("#tcrd").val(totalcredit2);
    words4 = toWords(totalcredit2);
    $("#amount-rupees").val(words4 + "Rupees Only");
    
  }
});
</script>

    <script src="bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
    <script src="bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
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
 if(confirm("Sure you want to delete this Customer Info ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_chart_of_accounts.php",
   data: info,
   success: function(){
   window.location = 'frm_chart_of_accounts.php';
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
    .animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
<script type="text/javascript">
  $(document).ready(function() {
  var i = 1;
  $("#add_row").click(function() {
  $('tr').find('input').prop('disabled',true)
    $('#addr' + i).html("<td>" + (i + 1) + "</td><td><input type='text' name='Account_Title_ID2" + i + "'  placeholder='User ID' class='form-control input-md'/></td><td><input type='text' name='uname" + i + "' placeholder='Name' class='form-control input-md'/></td><td><input type='text' name='nic" + i + "' placeholder='NIC' class='form-control input-md'/></td><td><input type='text' name='amount" + i + "' placeholder='Amount' class='form-control input-md'/></td><td><input type='date' name='dt" + i + "' placeholder='Date' class='form-control input-md'/></td>");

    $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
    i++;
  });
});
</script>

<?php
        include 'security_layer.php';
?>
        <script type="text/javascript">
          $("#accounts_text").css("color","red");
        </script>
  </div>
</body>
</html>