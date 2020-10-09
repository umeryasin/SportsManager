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

if($_SESSION['admin'] == "admin" && $run_2['User_Management'] == 1)
    
    $counter = 1;
else 
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

  <title>User Managment</title>
  
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

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px;"><img src="images/types.png" style="width: 40px; height: 40px;"> <a href="frm_user_type.php"> User Type</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px;"><img src="images/add_user.png" style="width: 40px; height: 40px;"> <a href="frm_add_user.php">Add User</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px;"><img src="images/rights.png" style="width: 40px; height: 40px;"><a href="frm_user_right.php" style="color: red;"> User Rights</a></span>
    <hr style="width: 70%;">
</div><br>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-pencil"></i> Update User Management Information</div>
        <div class="card-body">
          <form action="save_user_right.php" method="post" align="center" style="width: 50%; margin-left: 30%;">
          <div style="float: left;">
            <div>
            Select Page Accessibility
            <hr>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-hand-o-right"></i>
                </div>
                
                <select name="User_Type_Id" id="user_right" class="form-control" style="width: 300px;">
                  <option>Select User Type</option>
                  <?php 
                  $sql = "SELECT * FROM usertype";
                  $query = mysqli_query($ob->connect(),$sql);
                  for ($i=0; $run = mysqli_fetch_array($query); $i++) { 
                    
                ?>
                  <option value="<?php echo $run['User_Type_Id']; ?>"><?php echo $run['User_Type']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <br>
            
            <div align="left">
              <input type="checkbox" id="Home" name="Home">
              <span>Home</span>
              <br>
               <input type="checkbox" id="Business" name="Business">
              <span>Business Info</span>
              <br>
               <input type="checkbox" id="Customers" name="Customers">
              <span>Customers</span>
              <br>
               <input type="checkbox" name="Vendors" id="Vendors">
              <span>Vendors</span>
              <br>
               <input type="checkbox" name="Products" id="Products">
              <span>Products</span>
              <br>
              <input type="checkbox" name="Product_Received" id="Product_Received">
              <span>Product Received</span>
              <br>
               <input type="checkbox" name="New_Invoice" id="New_Invoice">
              <span>New Invoice</span>
              <br>
               <input type="checkbox" name="Accounts" id="Accounts">
              <span>Accounts</span>
              <br>
               <input type="checkbox" name="Sales_Return" id="Sales_Return">
              <span>Sales Return</span>
              <br>
              <input type="checkbox" name="Exchange_Item" id="Exchange_Item">
              <span>Create Category</span>
              <br>
               <input type="checkbox" name="Reports" id="Reports">
              <span>Reports</span>
              <br>
               <input type="checkbox" name="User_Management" id="User_Management">
              <span>User Management</span>
              <br><br>
            </div>
            <div>
              <button class="btn btn-success btn-large" name="save" style="width:100px;"><i class="fa fa-save fa-large"></i> Save</button>
              </div>
          </form>
        </div>
      </div>
      <!---New-->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
   <?php include('footer.php'); ?>
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
<script type="text/javascript">
  $(document).ready(function(){
    $("#user_right").change(function(){
    //$("#Home").attr('checked',true);
    var id = $(this).val();
    ////Start
           $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { home: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Home").attr('checked',true);
            }
            else if(response==0){
              $("#Home").attr('checked',false);
              console.log("Esle");
          }
        }
        });

        $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { business: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Business").attr('checked',true);
            }
            else if(response==0){
              $("#Business").attr('checked',false);
              console.log("Esle");
          }
        }
        });

        $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { customers: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Customers").attr('checked',true);
            }
            else if(response==0){
              $("#Customers").attr('checked',false);
              console.log("Esle");
          }
        }
        });

        $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { vendors: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Vendors").attr('checked',true);
            }
            else if(response==0){
              $("#Vendors").attr('checked',false);
              console.log("Esle");
          }
        }
        });

        $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { products: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Products").attr('checked',true);
            }
            else if(response==0){
              $("#Products").attr('checked',false);
              console.log("Esle");
          }
        }
        });

        $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { product_received: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Product_Received").attr('checked',true);
            }
            else if(response==0){
              $("#Product_Received").attr('checked',false);
              console.log("Esle");
          }
        }
        });

        $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { new_invoice: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#New_Invoice").attr('checked',true);
            }
            else if(response==0){
              $("#New_Invoice").attr('checked',false);
              console.log("Esle");
          }
        }
        });

        $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { accounts: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Accounts").attr('checked',true);
            }
            else if(response==0){
              $("#Accounts").attr('checked',false);
              console.log("Esle");
          }
        }
        });

        $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { sales_return: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Sales_Return").attr('checked',true);
            }
            else if(response==0){
              $("#Sales_Return").attr('checked',false);
              console.log("Esle");
          }
        }
        });

      $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { exchange_item: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Exchange_Item").attr('checked',true);
            }
            else if(response==0){
              $("#Exchange_Item").attr('checked',false);
              console.log("Esle");
          }
        }
        });

    $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { reports: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#Reports").attr('checked',true);
            }
            else if(response==0){
              $("#Reports").attr('checked',false);
              console.log("Esle");
          }
        }
        });

    $.ajax({
          type: "POST",
          url: "process.php",
          dataType:"json",
          data: { user_management: id },
          success:function(response){
            console.log(response);
            if (response==1) {
              $("#User_Management").attr('checked',true);
            }
            else if(response==0){
              $("#User_Management").attr('checked',false);
              console.log("Esle");
          }
        }
        });

    ////End
  });
  });
</script>
<?php
        include 'security_layer.php';
?>
         <script type="text/javascript">
          $("#user_management_text").css("color","red");
           
        </script>
  </div>
</body>

</html>
