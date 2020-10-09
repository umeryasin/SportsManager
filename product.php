<?php
include 'connect.php';
  //Start session
include 'auth.php';
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
        <li class="breadcrumb-item active">Products</li>
      </ol><br>
      <div style="margin-top: -19px; margin-bottom: 21px;">
<a  href="dashboard.php" class="btn btn-large btn-primary" style="float: left;"><i class="fa fa-arrow-left fa-large"></i> Back</a>
<a class="btn btn-large btn-primary pull-right" href="add_product.php" style="margin-right: 20px;" ><i class="fa fa-plus fa-large"></i> Add Product</a>
      <?php 
      
        $result = $con->prepare("SELECT * FROM products ORDER BY qty_sold DESC");
        $result->execute();
        $rowcount = $result->rowcount();
      ?>
      
      <?php 
      
        $result = $con->prepare("SELECT * FROM products where qty < 10 ORDER BY product_id DESC");
        $result->execute();
        $rowcount123 = $result->rowcount();

      ?>
        <div style="text-align:center;">
      Total Number of Products:  <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $rowcount;?>]</font>
      </div>
      
      <div style="text-align:center;">
      <font style="color:rgb(255, 95, 66);; font:bold 22px 'Aleo';">[<?php echo $rowcount123;?>]</font> Products are below QTY of 10 
      </div>
</div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Table Example</div>
        <div class="card-body">
         
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Item Code</th>
                  <th>Item Name</th>
                  <th>Category</th>
                  <th>Supplier</th>
                  <th>Date Received</th>
                  <th>Expiry Date</th>
                  <th>Original Price</th>
                  <th>Selling Price</th>
                  <th>QTY Left</th>
                  <th>Total</th>
                  <th >Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Item Code</th>
                  <th>Item Name</th>
                  <th>Category</th>
                  <th>Supplier</th>
                  <th>Date Received</th>
                  <th>Expiry Date</th>
                  <th>Original Price</th>
                  <th>Selling Price</th>
                  <th>QTY Left</th>
                  <th>Total</th>
                  <th >Action</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
      function formatMoney($number, $fractional=false) {
          if ($fractional) {
            $number = sprintf('%.2f', $number);
          }
          while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
              $number = $replaced;
            } else {
              break;
            }
          }
          return $number;
        }
        
        $result = $con->prepare("SELECT *, price * qty as total FROM products ORDER BY product_id DESC");
        $result->execute();
        for($i=0; $row = $result->fetch(); $i++){
        $total=$row['total'];
        $availableqty=$row['qty'];
        if ($availableqty < 10) {
        echo '';
        }
                               
                                $total=$row['total'];
        $expiredgood=$row['expiry_date'];
        if ($expiredgood < 'expiry_date') {
        echo '';
            
                                    
                                }
        else {
        echo '';
        }
      ?>
                <tr>
                  <td><?php echo $row['product_code']; ?></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><?php echo $row['gen_name']; ?></td>
                  <td><?php echo $row['supplier']; ?></td>
                  <td><?php echo $row['date_arrival']; ?></td>
                  <td><?php echo $row['expiry_date']; ?></td>
                  <td><?php
      $oprice=$row['o_price'];
      echo formatMoney($oprice, true);
      ?></td>
                  <td><?php
      $pprice=$row['price'];
      echo formatMoney($pprice, true);
      ?></td>
                  <td><?php echo $row['qty']; ?></td>
                  <td><?php
      $total=$row['total'];
      echo formatMoney($total, true);
      ?></td>
                  <td>
                    <a data-placement="left" id="" href="edit_pro.php?id=<?php echo $row['product_id']; ?>" title="Click to Edit" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i> </a>
      <a href="#" id="<?php echo $row['product_id']; ?>" class="delbutton" title="Click to Delete Product"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
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
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
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
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this Product ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_pro.php",
   data: info,
   success: function(){
   window.location = 'product.php';
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
    .animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
  </div>
</body>

</html>
