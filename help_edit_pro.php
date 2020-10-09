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

 
?>

<!DOCTYPE>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Help</title>
  
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <style type="text/css">
    *, *:before, *:after{
    margin: 0;
    padding: 0;
    direction: ltr;
    box-sizing: border-box;
}
.ArticleCopy{
  font-family: "Helvetica Neue","Helvetica",Helvetica,Arial,sans-serif;
  width: 80%;
  margin:0 auto;
  border: 1px solid #ddd;
  padding: 3rem;
}
.ArticleCopy p {
    text-rendering: optimizeLegibility;
}
.ArticleCopy blockquote {
    border-radius: 3px;
    position: relative;  /*  <--- */
    font-style: italic;
    text-align: center;
    padding: 1rem 1.2rem;
    width: 80%;  /* create space for the quotes */
    color: #4a4a4a;
    margin: 1rem auto 2rem;
    color: #4a4a4a;
    background: #E8E8E8;
}
/* -- create the quotation marks -- */
.ArticleCopy blockquote:before,
.ArticleCopy blockquote:after{
    font-family: FontAwesome;
    position: absolute;
    /* -- inside the relative position of blockquote -- */
    top: 13px;
    color: #E8E8E8;
    font-size: 34px;
}
.ArticleCopy blockquote:before{
    content: "\f10d";
    margin-right: 13px;
    right: 100%;
}
.ArticleCopy blockquote:after{
    content: "\f10e";
    margin-left: 13px;
    left: 100%;  
}
  </style>
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
  <div style="margin-top: -30px;">
    <div class="container-fluid">
      <!-- Breadcrumbs-->

      <div style="margin-top: -20px;" align="center">
        <span style="font-size: 22px;"><img src="images/help.png" style="width: 50px; height: 50px;"> Help</span>
      </div>
      <br>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-question-circle"></i> Help</div>
        <div class="card-body">
          <div style="width: 35%; float: left;">
            <p style="font-size: 25px;">FAQs</p>
            <div class="list-group">
              <a href="help_insert_pro.php" class="list-group-item">How to insert product in Fabric Manger</a>
              <a href="help_edit_pro.php" class="list-group-item active">How to edit saved product</a>
              <a href="help_insert_customer.php" class="list-group-item">How to insert customers info</a>
              <a href="help_insert_vendor.php" class="list-group-item">How to insert vendors info</a>
              <a href="#" class="list-group-item">How to generate invoice</a>
              <a href="#" class="list-group-item">How to how new voucher</a>
              <a href="#" class="list-group-item">How to return sale item</a>
              <a href="#" class="list-group-item">How to manage multiple users</a>
              <a href="#" class="list-group-item">How to create user type</a>
              <a href="#" class="list-group-item">How to new user</a>
              <a href="#" class="list-group-item">Dashboard / Home purpose</a>
              <a href="#" class="list-group-item">How to create user type</a>
            </div>
          </div>
          <div style="margin-left: 460px;">
            <ul>
              <li>Click on edit product if product is already stored</li>
              <li>
                <img src="images/edit_pro.png" width="100%" >
              </li>
              <li>A menu appear</li>
               <li>
                <img src="images/updating_pro.png" width="100%" >
              </li>
              <li>Enter new information. Whether you want to add new stock or changing the info</li>
               <li>
                <img src="images/updating_pro2.png" width="100%" >
              </li>
              <li style="background-color: red;">you cann also delete product by using trash symbol (warning care fully)</li>
              <li>
                <img src="images/del_pro.png" width="100%" >
              </li>
             
            </ul>
          </div>
        </div>
      </div>
      <!---New-->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer" style="width: 100%;">
      <div class="container">
        <div class="text-center">
           <small>Copyright © Research & Solutions <?php echo date('Y'); ?></small>
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
          $("#help_text").css("color","red");
        </script>
  </div>
</body>

</html>
