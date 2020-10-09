<!DOCTYPE html>
<html>
<head>
	<title></title>
<!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <?php
  include 'conn.php';
  $ob=new conn;
  
  $id=$_GET['id'];
  
  ?>
</head>
<body>
  <?php
              include('connect.php');
              $result1 = $con->prepare("SELECT * FROM user AS U, usertype AS UT WHERE U.User_Type_Id = UT.User_Type_Id AND id= :userid");
              $result1->bindParam(':userid', $id);
              $result1->execute();
              for($i=0; $row1 = $result1->fetch(); $i++){
              if (isset($_POST['update'])) {
// new data
$id                   = $_POST['id'];
$User_Type_Id         = $_POST['User_Type_Id'];
$name                 = $_POST['name'];
$username             = $_POST['username'];
$password             = $_POST['password'];
// query
$sql = $con->prepare("UPDATE user
        SET User_Type_Id = '$User_Type_Id', name = '$name', username = '$username', password = '$password'
    WHERE id = '$id'");
$sql->execute();
?>
<script>
  window.location = 'frm_add_user.php';
</script>
<?php } ?>
  <!-- Update Modal Start-->
    <div class="modal fade" id="UserUpdateModal" tabindex="-1" role="dialog" aria-labelledby="CustomerUpdateModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil fa-large"></i> Update User Info</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close" id="close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="#" method="post">
              <?php
                $sql_edit_user="SELECT * FROM user AS U, usertype AS UT WHERE U.User_Type_Id = UT.User_Type_Id AND id=$id";
                $run_edit_user=mysqli_query($ob->connect(),$sql_edit_user);
                while($row_edit_user=mysqli_fetch_array($run_edit_user))
                {
              ?>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <label> User Type</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-circle-o"></i>
              </div>
            <select name="User_Type_Id" class="select_user_type" class="chzn-select">
              <option value="<?php echo $row_edit_user['User_Type_Id']; ?>"><?php echo $row_edit_user['User_Type']; ?></option>
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
            </select>
            </div>
            <label>Full Name</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user"></i>
              </div>
              <input type="text" name="name" value="<?php echo $row_edit_user['name']; ?>" placeholder="Full Name" class="form-control">
            </div>
            <label>User Name</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-circle-o"></i>
              </div>
              <input type="text" name="username" value="<?php echo $row_edit_user['username']; ?>" placeholder="User Name" class="form-control">
            </div>
            <label> Password</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-key"></i>
              </div>
              <input type="password" name="password" value="<?php echo $row_edit_user['password']; ?>" class="form-control" placeholder="Password" id="myinput">
            </div>
            <input type="checkbox" name="show_pass" onclick="myFunction()"><span>Show Password</span>
            
            <br>
            <div align="center">
              <button class="btn btn-success btn-large" name="update" style="width:100px;"><i class="fa fa-edit fa-large"></i> Update</button>
              </div>
          </form>

          </div>
            <?php
                } }
            ?>
          <div class="modal-footer">
            <button class="btn btn-danger" type="button" data-dismiss="modal" id="close1"><i class="fa fa-remove fa-large"></i> Close</button>
            
          </div>
        </div>
      </div>
    </div>
<!--Update Modal End-->

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
    $('#UserUpdateModal').modal({
  show: true
})

  </script>
  <script type="text/javascript">
  function myFunction() {
    var x = document.getElementById("myinput").value;
    console.log(x);

    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
} 
</script>

<script type="text/javascript">
   $("#close").on("click",function(){
      window.location="frm_add_user.php";
    });
    $("#close1").on("click",function(){
      window.location="frm_add_user.php";
    });
</script>
</body>
</html>