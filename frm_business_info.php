<?php
include 'connect.php';
  //Start session
include 'auth.php';

  include 'class_business_info.php';
  $ob= new Business_info;

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

if($_SESSION['admin'] == "admin" && $run_2['Business'] == 1)
    
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

  <title>Business Info</title>
  
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
  <div style="margin-top: 70px;">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      
      <br>
      <div style="margin-top: -20px;" align="center">
        <span style="font-size: 22px;"><img src="images/company.png" style="width: 50px; height: 50px;"> Business Information</span>
      </div> 
      <br>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-pencil"></i> Update Business Information
        </div>
        <div class="card-body">
          <form action="controler_business_info.php" method="post" align="center" enctype="multipart/form-data">
          <div class="row">
            <div class="col-md-2"></div>
            <!--Start-->
          <div class="col-md-4">
            <div>
            <label> Business Name</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-info"></i>
                </div>
                <input type="text" name="name" placeholder="Business Name" class="form-control" value="<?php echo $ob->getBusinessName();?>" id="name">
              </div>
            </div>
             <div>
            <label> Email</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-envelope"></i>
                </div>
                <input type="email" name="email" placeholder="Email" class="form-control" value="<?php echo $ob->getBusinessEmail(); ?>" id="email">
              </div>
            </div>
            <div>
            <label> Contact</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-phone-square"></i>
                </div>
                <input type="text" name="contact" placeholder="Contact" class="form-control" value="<?php echo $ob->getBusinessContact(); ?>" id="contact">
              </div>
            </div>
            <div>
            <label> Address</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-address-book"></i>
                </div>
                <input type="text" name="address" placeholder="Address" class="form-control" value="<?php echo $ob->getBusinessAddress(); ?>" id="address">
              </div>
            </div>
          </div>
          <!--End-->
          

         <div class="col-md-4">
            <div>
            <img src="images/Logo_avatar.png" style="width: 250px; height: 250px;" class="img-responsive">
          </div>
          <div>
            <label> Upload</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-upload"></i>
                </div>
                <input type="file" name="image" class="form-control" id="image" disabled="disabled">
              </div>
          </div>
         </div>
          <div class="col-md-2"></div>

          </div>

          <br>
            <div>
              <button class="btn btn-success btn-large" name="save" style="width:100px;" id="save"><i class="fa fa-save fa-large"></i> Save</button>
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
<?php
        include 'security_layer.php';
?>

        <script type="text/javascript">
          var name=$("#name").val();
          if(name=='')
          {
            $("#name").attr("disabled",false);
            $("#email").attr("disabled",false);
            $("#contact").attr("disabled",false);
            $("#address").attr("disabled",false);
            $("#save").attr("disabled",false);
          }
          else
          {
            $("#name").attr("disabled",true);
            $("#email").attr("disabled",true);
            $("#contact").attr("disabled",true);
            $("#address").attr("disabled",true);
            $("#save").attr("disabled",true);
          }
        </script>
        <script type="text/javascript">
        	$("#business_text").css("color","red");
        </script>
  </div>
</body>

</html>
