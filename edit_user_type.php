<?php
include 'connect.php';
  //Start session
include 'auth.php';
  include 'class_user.php';
  $ob=new user;

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

  <title>Edit User Type</title>
  
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
  <div style="margin-top: -30px;">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
<div style="margin-top: -20px;" align="center">

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px;"><img src="images/types.png" style="width: 40px; height: 40px;"> <a href="frm_user_type.php" style="color: red;"> User Type</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px;"><img src="images/add_user.png" style="width: 40px; height: 40px;"> <a href="frm_add_user.php">Add User</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px;"><img src="images/rights.png" style="width: 40px; height: 40px;"><a href="frm_user_right.php"> User Rights</a></span>
    <hr style="width: 70%;">
</div>
       <br>
      <!-- Example DataTables Card-->
      <div class="card mb-3" style="width: 40%; float: left; margin-right: 5px;">
        <div class="card-header" align="center">
          <i class="fa fa-pencil"></i> Update User Type</div>
        <div class="card-body">
          <form action="controler_edit_user_type.php" method="post">
            <?php
            $id=$_GET['id'];
            $sql_edit_user_tye="SELECT * FROM usertype WHERE User_Type_Id='$id'";
            $run_edit_user_type=mysqli_query($ob->connect(),$sql_edit_user_tye);
            $row_edit_user_type=mysqli_fetch_array($run_edit_user_type);
            ?>
            <label> User Type :</label>
              <div class="input-group" style="width: 220px;">
                <div class="input-group-addon">
                  <i class="fa fa-user-circle-o"></i>
                </div>
                <input type="hidden" name="id" value="<?php echo $row_edit_user_type['User_Type_Id']; ?>">
                <input type="text" name="UserType" placeholder="User Type" class="form-control" value="<?php echo $row_edit_user_type['User_Type']; ?>">
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
      <div class="card mb-3" style="width: 55%;">
        <div class="card-header">
          <i class="fa fa-table"></i> User Type</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> User Type</th>
                  <th> Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      $sql_get_user_type="SELECT * FROM usertype";
                      $run_get_user_type=mysqli_query($ob->connect(),$sql_get_user_type);
                      while($row_get_user_type=mysqli_fetch_array($run_get_user_type))
                      {
                  ?>
                <tr>
                  <td> <?php echo $row_get_user_type['User_Type']; ?></td>
                  <td>
                    <a class="editbutton" disabled="disabled" data-placement="left" id="<?php echo $row_get_user_type['User_Type_Id']; ?>" href="" title="Click to Edit"><button class="btn btn-success" disabled="disabled"><i class="fa fa-pencil"></i> </button></a>

                    <a href="#" id="" class="delbutton" title="Click to Delete Info"><button disabled="disabled" class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
    <footer class="sticky-footer" style="width: 1280px;">
      <div class="container">
        <div class="text-center">
          
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

  </div>
</body>

</html>

<script type="text/javascript">
          $("#user_management_text").css("color","red");
        </script>
<?php
        include 'security_layer.php';
?>