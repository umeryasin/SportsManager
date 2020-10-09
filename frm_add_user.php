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

  <title>Add Users</title>
  
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

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px;"><img src="images/add_user.png" style="width: 40px; height: 40px;"> <a href="frm_add_user.php" style="color: red;">Add User</a></span>

<span style="font-size: 18px; padding-left: 15px; padding-right: 15px;"><img src="images/rights.png" style="width: 40px; height: 40px;"><a href="frm_user_right.php"> User Rights</a></span>
    <hr style="width: 70%;">
</div>
<div align="right">
  <a data-toggle="modal" data-target="#UserModal" class="btn btn-large btn-primary" style="color: white;"><i style="color: white;" class="fa fa-plus fa-large"></i> Add New User</a>
</div><br>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> User Information</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                
                  <th> Full Name</th>
                  <th> User Name</th>
                  <th style="width: 200px;"> Password</th>
                  <th> User Type</th>
                  <th> Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql_user="SELECT * FROM user,usertype WHERE user.User_Type_Id=usertype.User_Type_Id AND id > 0";
                $run_user=mysqli_query($ob->connect(),$sql_user);
                while($row_user=mysqli_fetch_array($run_user))
                {
                ?>
                <tr>
                  
                  <td><?php echo $row_user['name']; ?></td>
                  <td><?php echo $row_user['username']; ?></td>
                  <td> <input class="rec" type="password" value="<?php echo $row_user['password']; ?>" disabled="disabled"> </td>
                  <td><?php echo $row_user['User_Type']; ?></td>
                  <td>
                    <a class="editbutton" data-placement="left" id="<?php echo $row_user['id']; ?>" href="edit_user.php?id=<?php echo $row_user['id']; ?>" title="Click to Edit"><button class="btn btn-success"><i class="fa fa-pencil"></i> </button></a>

                    <a href="#" id="<?php echo $row_user['id']; ?>" class="delbutton" title="Click to Delete Info"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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

      <!-- End Example DataTables Card-->

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
   <?php include('footer.php'); ?>
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
          
            <label> Name :</label>
            <input type="text" class="form-control" style="width: 200px;" name="txt_su" placeholder="Supplier Name" required="required">
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
    <div class="modal fade" id="UserModal" tabindex="-1" role="dialog" aria-labelledby="UserModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="UserModalLabel"><i class="fa fa-user-plus fa-large"></i> Add User</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">

            <form action="controler_add_user.php" method="post">
              <label> User Type : </label>&nbsp;

            <select name="UserType" class="select_user_type">
               <?php
            $sql_get_user_type="SELECT * FROM usertype";
                      $run_get_user_type=mysqli_query($ob->connect(),$sql_get_user_type);
                      while($row_get_user_type=mysqli_fetch_array($run_get_user_type))
                      {
            ?>

            <option value="<?php echo $row_get_user_type['User_Type_Id']; ?>"><?php echo $row_get_user_type['User_Type']; ?></option>

            <?php
                      }
            ?>
            </select><br>

            <label>Full Name</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" name="name" placeholder="Full Name" class="form-control">
            </div>

            <label>User Name</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-circle-o"></i>
              </div>
              <input type="text" name="UserName" placeholder="User Name" class="form-control">
            </div>
            <label> Password</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-key"></i>
              </div>
              <input type="password" name="Password" class="form-control" placeholder="Password">
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
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this User ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_user.php",
   data: info,
   success: function(){
    console.log("Deleted");
   window.location = 'frm_add_user.php';
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
          $("#user_management_text").css("color","red");
        </script>
  </div>
</body>
</html>