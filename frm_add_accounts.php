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

  <title>Add Accounts</title>
  
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

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px; "><img src="images/title.png" style="width: 30px; height: 30px;"> <a href="frm_add_accounts.php" style="color: red;"> Add Account Title</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px; "><img src="images/voucher.png" style="width: 30px; height: 30px;"> <a href="frm_add_voucher.php" > Add Vouchers</a></span>

<hr style="width: 70%;">
</div><br>
      <!-- Example DataTables Card-->
      <div class="card mb-3" style="width: 30%; float: left; margin-right: 5px;">
        <div class="card-header" align="center">
          <i class="fa fa-pencil"></i> Add Accounts</div>
        <div class="card-body">
          <form action="save_account_title.php" method="post">
            
            <label> Head Of Accounts :</label>
            <select class="form-control" style="width: 220px;" name="Head_Of_Account">
              <option>--Select Accounts--</option>
              <?php
              $result = $con->prepare("SELECT * FROM charts_of_accounts");
              $result->bindParam(':userid', $res);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
                ?>
                <option value="<?php echo $row['Head_Of_Account_ID']; ?>"><?php echo $row['Head_Of_Account_Title']; ?></option>
                <?php
              }
              ?>
            </select>
            <br>
            <label> Account Title :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-tags"></i>
                </div>
                <input type="text" name="Account_Title" placeholder="Account Title" class="form-control">
              </div>
              <br>
              <label> Account Code :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-code-fork"></i>
                </div>
                <input type="text" name="Account_Code" placeholder="Account Code" class="form-control">
              </div>
              <br>
              <label> Opening Balance Date :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="date" name="Opening_Balance_Date" class="form-control" required>
              </div>
              <br>
             <label> Opening Balance :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-tags"></i>
                </div>
                <input type="text" name="Opening_Balance" placeholder="0.00" class="form-control">
              </div>
              <br>
            <div align="center">
              <button class="btn btn-success btn-large" name="save" style="width:100px;"><i class="fa fa-save fa-large"></i> Save</button>
              </div>
          </form>
        </div>
      </div>
      <!---New-->
            <!-- Example DataTables Card-->
      <div class="card mb-3" style="width: 68%;">
        <div class="card-header">
          <i class="fa fa-table"></i> Accounts Title</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th > Head Of Accounts</th>
                  <th > Accounts Title</th>
                  <th> Account Code</th>
                  <th> Date</th>
                  <th> Opening Balance</th>
                  
                </tr>
              </thead>
              <tbody>
              <?php
              
              
 
              $sql1 = "SELECT * FROM account_title AS A,charts_of_accounts AS C WHERE A.Head_Of_Account_ID = C.Head_Of_Account_ID AND Account_Title_ID > 0";

         $query1 = mysqli_query($ob->connect(),$sql1);

          while($row1 = mysqli_fetch_array($query1)){

        ?>
                <tr>
                  <td width="10%"> <?php echo $row1['Head_Of_Account_Title']; ?></td>
                  <td width="32%"> <?php echo $row1['Account_Title']; ?></td>
                  <td width="10%"> <?php echo $row1['Account_Code']; ?></td>
                  <td width="15%"> <?php echo $row1['Opening_Balance_Date']; ?></td>
                  <td width="8%"> <?php echo $row1['Opening_Balance']; ?></td>
                  
                </tr>
                <?php
        }
      ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
      <!-- End Example DataTables Card-->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
   <?php include('footer.php'); ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <div class="modal fade" id="DelAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Sure you want to delete this Account Title ?</div>
          <div class="modal-footer">
            <a href="#" id="<?php echo $row1['Account_Title_ID'];?>" class="delbutton" title="Click to Delete Info"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
 if(confirm("Sure you want to delete this Account Title ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_account_title.php",
   data: info,
   success: function(){
   window.location = 'frm_add_accounts.php';
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
    .animate({ opacity: "hide" }, "slow");

 }

return false;

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
