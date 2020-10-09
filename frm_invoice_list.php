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

  <title>Invoice List</title>
  
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/invoice_list.css">

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
        <span style="margin-left: 65px;"><img src="images/list.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 55px;"><img src="images/accounts.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 45px;"><img src="images/return.png" style="width: 40px; height: 40px;"></span>
        <span style="margin-left: 55px;"><img src="images/report.png" style="width: 40px; height: 40px;"></span>
        <br>
        <a href="dashboard.php" > Home </a>
        <span style="margin-left: 20px;"><a href="frm_business_info.php"> Business Info </a></span>
        <span style="margin-left: 20px;"><a href="frm_customers.php" > Customers </a></span>
        <span style="margin-left: 20px;"><a href="frm_suppliers.php"> Suppliers </a></span>
        <span style="margin-left: 20px;"><a href="frm_product_category.php"> Product Category </a></span>
        <span style="margin-left: 20px;"><a href="frm_product_info.php" > Products </a></span>
        <span style="margin-left: 20px;"><a href="frm_invoice.php"> New Invoice </a></span>
        <span style="margin-left: 20px;"><a href="frm_invoice_list.php" style="color: red;"> Invoice List </a></span>
        <span style="margin-left: 20px;"><a href="frm_cashin_cashout.php"> Accounts </a></span>
        <span style="margin-left: 20px;"><a href="frm_sales_return.php" > Sales Return </a></span>
        <span style="margin-left: 20px;"><a href="#"> Reports </a></span>
      </ol><hr>
      <br>
      <div style="margin-top: -19px; margin-bottom: 21px;">

<span style="font-size: 22px;margin-left: 450px;"><i style="color: green;" class="fa fa-large fa-list"></i> Invoice List</span>
</div><br>
<!---Start-->
<div style="margin-left: 300px; margin-right: 300px;">
  <form method="post" action="#">
      <label>Select From: </label>
      <input type="date" name="starting_date">
      <label> To: </label>
      <input type="date" name="ending_date">
      <input type="submit" name="submit" value="Apply">
  </form>
</div>
<!---End-->
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Invoice List</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Id</th>
                  <th> Created Date</th>
                  <th> Invoice No.</th>
                  <th> Invoice Type</th>
                  <th> Payment Mode</th>
                  <th> Customer Name</th>
                  <th> Total Amount</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> 1</td>
                  <td> 06/27/2018</td>
                  <td> INV-123456</td>
                  <td> Wholeseller</td>
                  <td> Cash</td>
                  <td> Akram</td>
                  <td> 20000 Rs</td>
                </tr>

                              <tr>
                  <td> 2</td>
                  <td> 06/27/2018</td>
                  <td> INV-123457</td>
                  <td> Retailer</td>
                  <td> Credit</td>
                  <td> Faheem</td>
                  <td> 1900 Rs</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated</div>
      </div>

      <!-- End Example DataTables Card-->



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

<!-- Update Modal Start-->
    <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil fa-large"></i> Update Account</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="updates_account_info.php" method="post">
          
            <label> Account Name :</label>
            <input type="text" class="form-control" style="width: 200px;" name="txt_account_name" placeholder="Account Name" required>
           <br>
            <label>Account Type :</label>&nbsp;
            <br>
            <select class="form-control" style="width: 200px;" name="select_head_of_accounts">
              <option>Slect 1</option>
            </select>
            <br>
            
            <br>        
            <label>Balance Type :</label><br>
            <select class="form-control" style="width: 200px;" name="select_balance_type_info">
              <option>Slect 1</option>
            </select>
            <br>
            <label> Description :</label>
            <textarea name="txt_description" style="width: 250px;" class="form-control"></textarea>
            <br>
            <br>
       
            <div align="center">
              <button class="btn btn-success btn-large" name="save" style="width:100px;"><i class="fa fa-save fa-large"></i> Save</button>
              </div>
          </form>

          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-remove fa-large"></i> Close</button>
            
          </div>
        </div>
      </div>
    </div>
<!--Update Modal End-->
    
    <!-- Logout Modal-->
    <div class="modal fade" id="CustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus fa-large"></i> Add New Customer</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="#" method="post">
          
            <label> Name</label>
            <input type="text" class="form-control" name="txt_name" placeholder="Customer Name" required="required">
            <label> Gender</label><br>
            <input type="radio" name="gender" value="Male"><span>Male</span>
            <input type="radio" name="gender" value="Female"><span>Female</span>
            <br>
            <label>Email</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="text" name="email" placeholder="Email" class="form-control">
            </div>
            <label> Phone#</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-phone-square"></i>
              </div>
              <input type="text" name="phone" class="form-control" placeholder="Phone#">
            </div>
            <label> NIC</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-id-card"></i>
              </div>
              <input type="text" class="form-control" name="txt_nic" placeholder="National Identity Card">
            </div>
            <label> Address</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-address-book"></i>
              </div>
              <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <label>Discount</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-percent"></i>
              </div>
              <input type="number" min="0" class="form-control" name="discount" value="0.0" placeholder="Discount">
            </div>
            <br>
            <div align="center">
              <button class="btn btn-success btn-large" name="save" style="width:100px;"><i class="fa fa-save fa-large"></i> Save</button>
              </div>
          </form>

          </div>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-remove fa-large"></i> Close</button>
            
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
  </div>
</body>
</html>