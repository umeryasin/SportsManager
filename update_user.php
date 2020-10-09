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
<?php } } ?>