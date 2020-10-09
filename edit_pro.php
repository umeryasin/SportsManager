<?php
include 'connect.php';
  //Start session
include 'auth.php';
?>
<?php
  
  $id=$_GET['id'];
  $result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
  $result->bindParam(':userid', $id);
  $result->execute();
  for($i=0; $row = $result->fetch(); $i++){
?>
<!DOCTYPE>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>POS</title>
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
<script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php include 'navbar.php' ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item "><a href="product.php">Products</a></li>
        <li class="breadcrumb-item active"> Add Products</li>
      </ol><br>
      <div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="product.php" class="btn btn-large btn-primary" style="float: left;"><i class="fa fa-arrow-left fa-large"></i> Back</a>

      
</div><br><br>

      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <h5><i class="fa fa-plus"></i> Add Products</h5></div>
        <div class="card-body">
          
            <form action="save_edit_pro.php" method="post">
              
                Item Code :&nbsp;&nbsp;
                <input type="text" class="" id="focusedinput" style="width: 180px; height:30px;" name="code" value="<?php echo $row['product_code']; ?>" placeholder="Item Code">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Item Name :&nbsp;&nbsp;
                <input type="text" class="" id="focusedinput" value="<?php echo $row['product_name']; ?>" style="width: 180px; height:30px;" name="name" placeholder="Item Name">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Category :&nbsp;&nbsp;
                <select name="gen" class="chzn-select" style="width:180px; height:30px;">
                  
                  <option><?php echo $row['gen_name']; ?></option>
                  <?php
  $result = $db->prepare("SELECT * FROM category");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row1 = $result->fetch(); $i++){
  ?>
    <option><?php echo $row1['name']; ?></option>
  <?php
  }
  ?>
                </select>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Date Arrival :&nbsp;&nbsp;
              <input type="date" class="" id="focusedinput" value="<?php echo $row['date_arrival']; ?>" style="width: 180px; height:30px;" name="name" placeholder="">
              <br><br>
              Date Expiry :&nbsp;
              <input type="date" name="exdate" value="<?php echo $row['expiry_date']; ?>" style="width:180px; height:30px;">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Original Price :&nbsp;&nbsp;
              <input type="number" name="o_price" value="<?php echo $row['o_price']; ?>" id="txt2" onkeyup="sum();" style="width:160px; height:30px;">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Selling Price :&nbsp;
              <input type="number" name="price" value="<?php echo $row['price']; ?>" id="txt1" onkeyup="sum();" style="width:170px; height:30px;">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Profit :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="number" name="profit" value="<?php echo $row['profit']; ?>" id="txt3" style="width:150px; height:30px;" readonly><br><br>
                Supplier :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="supplier" class="chzn-select" style="width:180px; height:30px;">
                  <option><?php echo $row['supplier']; ?></option>
                  <?php
  $result = $db->prepare("SELECT * FROM supliers");
    $result->bindParam(':userid', $res);
    $result->execute();
    for($i=0; $row2 = $result->fetch(); $i++){
  ?>
    <option><?php echo $row2['suplier_name']; ?></option>
  <?php
  }
  ?>
                </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Quantity :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="number" min="0" id="txt11" onkeyup="sum();" name="qty" value="<?php echo $row['qty']; ?>" style="width:150px; height:30px;">
              <input type="hidden" style="width:265px; height:30px;" id="txt22" name="qty_sold" Required ><br><br><br>
              <div align="center">
              <button class="btn btn-success btn-large" style="width:100px;"><i class="fa fa-edit fa-large"></i> Update</button>
              </div>
            </form>
          <?php
}
?>
        </div>
        
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2017</small>
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
            <a class="btn btn-primary" href="login.html">Logout</a>
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
  </div>
</body>

</html>
