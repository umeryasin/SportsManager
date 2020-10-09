<?php
include 'connect.php';
  //Start session
include 'auth.php';
if($_SESSION['admin'] != "admin")
    header("location: index.php");

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

  <title>About Us</title>
  
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

<span style="font-size: 22px;"><img src="images/about_us.png" style="width: 50px; height: 50px;"> About Us</span>     
    
</div><br>
      <!-- Example DataTables Card-->
      <?php
      $get_sql="SELECT Business_Owner FROM `due_date`";
      $get_run=mysqli_query($ob->connect(),$get_sql);
      $get_row=mysqli_fetch_array($get_run);
      ?>
      

          <section class="ArticleCopy">
            <p style="font-size: 20px;">Sports Manager v1.0</p>
            <?php
            $sql_bus="SELECT * FROM business_info";
            $run_bus=mysqli_query($ob->connect(),$sql_bus);
            $row_bus=mysqli_fetch_array($run_bus);
            ?>
            <p style="font-size: 20px;">Sport Manager: <?php echo $row_bus['Business_ID']; ?></p>
              <p>Sports Manager calculate sale, expenses, manage inventory, sales, sales return and accounts.</p>
              <p>Sports Manager Developed by UTS Experts</p>
              <p>UTS Experts has provided outsourced development services since 2017. We employ a skilled team of developers in Multan, Pakistan, who are totally focused on delivering high quality software solutions which enable our customers to achieve their critical IT objectives.</p>
              <p align="center" style="font-size: 24px;">Registration Information</p>
              <p align="center">This Product is licensed to <b><?php echo $get_row['Business_Owner']; ?></b></p>
              <p align="center" style="font-size: 24px;">Our Mission</p>
              <blockquote>
                <p style="font-size: 20px;">"We provide high value and high quality solutions!"</p>
              </blockquote>
              <p align="center" style="font-size: 24px;">Our Focus</p>
              <div style="margin-left: 180px;">
                  <div style="float: left; margin-right: 30px;">
                    <img src="images/customer_first.svg" width="140px" height="140px">
                    <p> CUSTOMERS FIRST </p>
                  </div>
                  <div style="float: left; margin-right: 30px;">
                    <img src="images/gearwheel.png" width="140px" height="140px">
                    <p> BUILDING VALUE </p>
                  </div>
                  <div style="margin-right: 30px;">
                     <img src="images/empowered.jpg" width="140px" height="140px">
                    <p> EMPOWERED EMPLOYEES </p>
                  </div>
              </div>
              <div>
                <p align="center" style="font-size: 24px;">Approach</p>
                <div align="center">
                  <p>Understanding business requirements and creating value</p>
                  <p>Understanding local and International cultures</p>
                  <p>Staff competence and communications skills</p>
                  <p>High-end full service provider</p>
                </div>
              </div>
              <div>
                <p align="center" style="font-size: 24px;">Commitment</p>
                <div align="center">
                  <p>To develop innovative, high quality solutions.</p>
                  <p>To provide a good working environment</p>
                  <p>To provide fair returns to our stakeholders</p>
                  <p>To support our local community</p>
                </div>
              </div>
              <div>
                <p align="center" style="font-size: 24px;">Contact</p>
                <div align="center">
                  <p>Email: marketing@utsexperts.com</p>
                  <p>Phone#: 03437057036 </p>
                </div>
              </div>

          </section>

    
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
          $("#about_us_text").css("color","red");
        </script>
  </div>
</body>

</html>
