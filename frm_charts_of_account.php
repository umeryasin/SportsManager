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

  <title>Charts Of Account</title>
  
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
<span style="font-size: 18px; padding-left: 15px; padding-right: 15px; "><img src="images/chart.png" style="width: 30px; height: 30px;"> <a href="frm_charts_of_account.php" style="color: red;"> Charts Of Account</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px; "><img src="images/title.png" style="width: 30px; height: 30px;"> <a href="frm_add_accounts.php" > Add Account Title</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px; "><img src="images/voucher.png" style="width: 30px; height: 30px;"> <a href="frm_add_voucher.php" > Add Vouchers</a></span>

<hr style="width: 70%;">
</div><br>
      <!-- Example DataTables Card-->
    <div class="card mb-3" style="width: 40%; float: left; margin-right: 5px;">
        <div class="card-header" align="center">
          <i class="fa fa-pencil"></i> Add Head Of Account</div>
        <div class="card-body">
          <form action="save_headofaccount.php" method="post">
            
            <label> Head Of Account Title :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-tags"></i>
                </div>
                <input type="text" style="width: 200px;" name="Head_Of_Account_Title" placeholder="Head Of Account Title" class="form-control">
              </div>
              <br>
              <label> Account Type :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-tags"></i>
                </div>
                <select class="form-control" style="width: 220px;" name="Account_Type">
              <option>--Select Type--</option>
              <?php
              $result = $con->prepare("SELECT * FROM entry_type");
              $result->bindParam(':userid', $res);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){
                ?>
                <option value="<?php echo $row['Entry_Type_ID']; ?>"><?php echo $row['Entry_Type']; ?></option>
                <?php
              }
              ?>
            </select>
              </div>
              <br>
            <div align="center">
              <button class="btn btn-success btn-large" name="save" style="width:100px;"><i class="fa fa-save fa-large"></i> Save</button>
              </div>
          </form>
        </div>
      </div>
      
      <div class="card mb-3" style="width: 55%;">
        <div class="card-header">
          <i class="fa fa-table"></i> Head Of Account List</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Head Of Account Title</th>
                  <th> Account Type</th>
                </tr>
              </thead>
              <tbody>
              <?php 

      $sql = $con->prepare("SELECT * FROM charts_of_accounts AS C, entry_type AS E Where C.Entry_Type_ID = E.Entry_Type_ID AND Head_Of_Account_ID > 0 ");
        
        $sql->execute();
        for($i=0; $row = $sql->fetch(); $i++){
      ?>
              
                <tr>
                  <td> <?php echo $row['Head_Of_Account_Title']; ?></td>
                  <td> <?php echo $row['Entry_Type']; ?></td>
                  
                </tr>
                <?php
        }
      ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
 if(confirm("Sure you want to delete this Charts Of Account ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_charts_of_account.php",
   data: info,
   success: function(){
   window.location = 'frm_charts_of_account.php';
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
