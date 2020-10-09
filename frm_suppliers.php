<?php
include 'connect.php';
  //Start session
include 'auth.php';
include 'class_suppliers.php';
$ob=new vendor;

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

if($_SESSION['admin'] == "admin" && $run_2['Vendors'] == 1)
    
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

  <title>Vendors</title>
  
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
<span style="font-size: 22px;"><img src="images/supplier.png" style="width: 50px; height: 50px;"> Vendors Information</span>  
</div>
<div align="right">
  <a data-toggle="modal" data-target="#VendorModal" class="btn btn-large btn-primary" style="color: white;"><i style="color: white;" class="fa fa-plus fa-large"></i> Add New Vendor</a>  
</div>
<br>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Vendors Information</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Name</th>
                  <th> Email</th>
                  <th> Phone#</th>
                  <th> NTN / Reg. No.</th>
                  <th> Address</th>
                  <th> Country</th>
                  <th> Action</th>
                </tr>
              </thead>
            <tbody>
                <?php
                $sql_vendor="SELECT * FROM `vendor`";
                $run=mysqli_query($ob->connect(),$sql_vendor);
                while($row=mysqli_fetch_array($run))
                {
                ?>
                <tr>
                  <td> <?php echo $row['Vendor_Name']; ?></td>
                  <td> <?php echo $row['Email']; ?></td>
                  <td> <?php echo $row['Contact_No']; ?></td>
                  <td> <?php echo $row['Reg_No'];?></td>
                  <td> <?php echo $row['Address']; ?></td>
                  <td> <?php echo $row['Country_Name']; ?></td>
                  <td>
                    <a class="editbutton" data-placement="left" id="<?php echo $row['Vendor_ID']; ?>" href="edit_supplier.php?id=<?php echo $row['Vendor_ID']; ?>" title="Click to Edit"><button class="btn btn-success"><i class="fa fa-pencil"></i> </button></a>
                    <a href="delete_suppliers.php?id=<?php echo $row['Vendor_ID']; ?>" onclick="return confirm('Sure You Want To Delete Vendor Info ?')" title="Click to Delete Info"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                  </td>
                </tr>
                <?php
                }
                ?>
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
    <?php include('footer.php'); ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>


    
    <!-- Logout Modal-->
    <div class="modal fade" id="VendorModal" tabindex="-1" role="dialog" aria-labelledby="VendorModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="VendorModalLabel"><i class="fa fa-user-plus fa-large"></i> Add New Vendor</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="controler_suppliers.php" method="post">
              <label> Vendor Name</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-circle-o"></i>
              </div>
            <input type="text" class="form-control" name="txt_supplier_name" placeholder="Vendor Name" required="required"></div>
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
            <label> NTN / Reg. No.</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-id-card"></i>
              </div>
              <input type="text" class="form-control" name="txt_reg_no" placeholder="NTN / Reg. No.">
            </div>
            <label> Address</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-address-book"></i>
              </div>
              <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <label>Country</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-flag"></i>
              </div>
              <input type="text" class="form-control" name="txt_country" placeholder="Country">
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
 if(confirm("Sure you want to delete this Vendor Info ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_suppliers.php",
   data: info,
   success: function(){
   window.location = 'frm_suppliers.php';
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
          $("#vendor_text").css("color","red");
        </script>
  </div>
</body>
</html>