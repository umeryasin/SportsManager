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

  <title>Create Product Size</title>
  
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
  <div style="margin-top: 94px;" align="center">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
<div style="" align="center">
<span style="font-size: 22px;"><img src="images/size_new.png" style="width: 50px; height: 50px;"> Create Product Size</span>  
</div>
<br>
      <!-- Example DataTables Card-->
      <div class="card mb-3"  style="width: 100%;">
        <div class="card-header" align="">
          <i class="fa fa-tags"></i> Create Product Size</div>
        <div class="card-body" align="center">
          <div class="row">
            <div class="col-md-7">
              <form method="post" action="create_size.php">
                <div class="row">
                  <div class="col-md-4">
                    <p>Product Size</p>
                  </div>
                  <div class="col-md-4">
                    <input type="text" name="size_name" class="form-control">
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="offset-4 col-md-4">
                    <input type="submit" name="create_size" class="btn" value="Create">
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-5">
              <table class="table table-bordered table-hover" id="dataTable">
                <thead>
                  <tr>
                    <th>Category</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql_get_cat="SELECT * FROM product_size";
                  $run_get_cat=mysqli_query($ob->connect(),$sql_get_cat);
                  while($row_get_cat=mysqli_fetch_assoc($run_get_cat))
                  {
                    ?>
                    <tr>
                      <td><?php echo $row_get_cat['pro_size_name']; ?></td>
                      <td>
                        <a href="create_size_del.php?id=<?php echo $row_get_cat['pro_size_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"> Delete</i></a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!---New-->
            <!-- Example DataTables Card-->
      
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
<script type="text/javascript">
          var business= " <?php echo $run_2['Business']; ?> ";
          if(business!=1)
            $("#business").css("display","none");

          var customer= " <?php echo $run_2['Customers']; ?> ";
          if(customer!=1)
            $("#customer").css("display","none");

          var vendor= " <?php echo $run_2['Vendors']; ?> ";
          if(vendor!=1)
            $("#vendor").css("display","none");

           var product= " <?php echo $run_2['Products']; ?> ";
          if(product!=1)
            $("#product").css("display","none");

          var new_invoice= " <?php echo $run_2['New_Invoice']; ?> ";
          if(new_invoice!=1)
            $("#new_invoice").css("display","none");

          var accounts= " <?php echo $run_2['Accounts']; ?> ";
          if(accounts!=1)
            $("#accounts").css("display","none");

          var sales_return= " <?php echo $run_2['Sales_Return']; ?> ";
          if(sales_return!=1)
            $("#sales_return").css("display","none");

          var reports= " <?php echo $run_2['Reports']; ?> ";
          if(reports!=1)
            $("#reports").css("display","none");

          var user_management= " <?php echo $run_2['User_Management']; ?> ";
          if(user_management!=1)
            $("#user_management").css("display","none");
        </script>

        <script type="text/javascript">
          $("#pro_size_text").css("color","red");
        </script>

  </div>
</body>

</html>
