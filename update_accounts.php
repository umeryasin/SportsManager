<?php
// configuration
include('connect.php');

if (isset($_POST['update'])) {
// new data
$id = $_POST['account_title_id'];
$a = $_POST['Head_Of_Account_Title'];
$b = $_POST['Account_Title'];
$c = $_POST['Account_Code'];
$d = $_POST['Opening_Balance'];

// query
$sql = "UPDATE account_title
        SET Head_Of_Account_Title = '$a', Account_Title = '$b', Account_Code = '$c', Opening_Balance = 'd'
    WHERE Account_Title_ID = '$id'";

$query = mysqli_query($con,$sql);

?>
<script>
  window.location = 'frm_add_accounts.php';
</script>
<?php } ?>