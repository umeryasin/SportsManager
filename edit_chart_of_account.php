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

  <title>Update Charts Of Account</title>
  
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
  <?php include 'navbar.php' ?>
  <br>
  <div>
    <div class="container-fluid">
      <!-- Breadcrumbs-->
            <ol class="">
        <img src="images/home.png" style="width: 40px; height: 40px;">
        <span style="margin-left: 45px;"><img src="images/company.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 70px;"><img src="images/customer.ico" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 50px;"><img src="images/supplier.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 70px;"><img src="images/category.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 75px;"><img src="images/products.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 50px;"><img src="images/invoice.png" style="width: 40px; height: 40px;"></span>
        
        <span style="margin-left: 55px;"><img src="images/accounts.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 45px;"><img src="images/return.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 55px;"><img src="images/report.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 55px;"><img src="images/user.jpg" style="width: 40px; height: 40px;"></span>
        <br>
        <a href="dashboard.php" > Home </a>
        <span style="margin-left: 20px;"><a href="frm_business_info.php"> Business Info </a></span>
        <span style="margin-left: 20px;"><a href="frm_customers.php" > Customers </a></span>
        <span style="margin-left: 20px;"><a href="frm_suppliers.php"> Vendors </a></span>
        <span style="margin-left: 20px;"><a href="frm_product_category.php" > Product Category </a></span>
        <span style="margin-left: 20px;"><a href="frm_product_info.php" > Products </a></span>
        <span style="margin-left: 20px;"><a href="frm_invoice.php"> New Invoice </a></span>
       
        <span style="margin-left: 20px;"><a href="frm_accounts.php" style="color: red;"> Accounts </a></span>
        <span style="margin-left: 20px;"><a href="frm_sales_return.php" > Sales Return </a></span>
        <span style="margin-left: 20px;"><a href="#"> Reports </a></span>
        <span style="margin-left: 20px;"><a href="frm_user_managment.php"> User Management</a></span>
      </ol><hr>
      <br>
      <div style="margin-top: -19px; margin-bottom: 21px;">
<span style="font-size: 18px;margin-left: 320px;"><img src="images/chart.png" style="width: 40px; height: 40px;"> <a href="frm_charts_of_account.php" style="color: red;"> Charts Of Account</a></span>

<span style="font-size: 18px;margin-left: 50px;"><img src="images/title.png" style="width: 40px; height: 40px;"> <a href="frm_add_accounts.php" > Add Account Title</a></span>

<span style="font-size: 18px;margin-left: 50px;"><img src="images/voucher.png" style="width: 40px; height: 40px;"> <a href="frm_add_voucher.php" > Add Vouchers</a></span>

<hr style="width: 750px;">
      
</div><br>
      <!-- Example DataTables Card-->

            <?php
              include('connect.php');
              $id = $_GET['id'];
              $result = $con->prepare("SELECT * FROM charts_of_accounts AS C, entry_type AS E WHERE C.Entry_Type_ID = E.Entry_Type_ID AND Head_Of_Account_ID= :userid");
              $result->bindParam(':userid', $id);
              $result->execute();
              for($i=0; $row = $result->fetch(); $i++){

            if(isset($_POST['update'])){      
          $id = $_POST['head_of_account_id'];
          $a = $_POST['Head_Of_Account_Title'];
          $b = $_POST['Entry_Type_ID'];

          // query
          $sql = $con->prepare("UPDATE charts_of_accounts
                  SET Head_Of_Account_Title = '$a', Entry_Type_ID = '$b'
              WHERE Head_Of_Account_ID = '$id'");
          
          $sql->execute();
            ?>
            <script>
  window.location = 'frm_charts_of_account.php';
</script>
<?php } ?>

    <div class="card mb-3" style="width: 40%; float: left; margin-right: 5px;">
        <div class="card-header" align="center">
          <i class="fa fa-edit"></i> Update Head Of Account</div>
        <div class="card-body">
          <form action="#" method="post">
            <input type="hidden" name="head_of_account_id" value="<?php echo $id; ?>" />
            <label> Head Of Account Title :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-tags"></i>
                </div>
                <input type="text" style="width: 200px;" name="Head_Of_Account_Title" placeholder="Head Of Account Title" value="<?php echo $row['Head_Of_Account_Title']; ?>" class="form-control">
              </div>
              <br>
              <label> Account Type :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-tags"></i>
                </div>
                <select class="form-control" style="width: 220px;" name="Entry_Type_ID">
              <option value="<?php echo $row['Entry_Type_ID']; ?>"><?php echo $row['Entry_Type']; ?></option>
              <option>--Select Type--</option>
              <?php
              $result = $con->prepare("SELECT * FROM entry_type");
              $result->bindParam(':userid', $res);
              $result->execute();
              for($i=0; $row2 = $result->fetch(); $i++){
                ?>
                <option value="<?php echo $row2['Entry_Type_ID']; ?>"><?php echo $row2['Entry_Type']; ?></option>
                <?php
              }
              ?>
            </select>
              </div>
              <br>
            <div align="center">
              <button class="btn btn-success btn-large" name="update" style="width:100px;"><i class="fa fa-edit fa-large"></i> Update</button>
              </div>
          </form>
        </div>
      </div>
      <?php } ?>
      <div class="card mb-3" style="width: 55%;">
        <div class="card-header">
          <i class="fa fa-table"></i>Updated Head Of Account List</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Head Of Account Title</th>
                  <th> Account Type</th>
                  <th> Action</th>
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
                  <td width="12%">
                    <a data-placement="left" href="edit_chart_of_account.php?id=<?php echo $row['Head_Of_Account_ID']; ?>" title="Click to Edit" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> </a>
                    
                  </td>
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
