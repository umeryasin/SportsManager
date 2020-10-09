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
  <link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
  <script src="src/facebox.js" type="text/javascript"></script>
  <?php
  include 'conn.php';
  $ob=new conn;
  
  $id=$_GET['id'];
  
  ?>
</head>
<body>
  <!-- Update Modal Start-->
    <div class="modal fade" id="CustomerUpdateModal" tabindex="-1" role="dialog" aria-labelledby="CustomerUpdateModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil fa-large"></i> Update Customer Info</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close" id="close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="update_customer.php" method="post">
              <?php
              $sql_edit_customer="SELECT * FROM customer, gender WHERE customer.Gender_ID = gender.Gender_ID AND Customer_ID=$id";
              $run_edit_customer=mysqli_query($ob->connect(),$sql_edit_customer);
              while($row_edit_customer=mysqli_fetch_array($run_edit_customer))
              {

              ?>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <label> Name</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-circle-o"></i>
              </div>
            <input type="text" class="form-control" name="txt_name" placeholder="Customer Name" required="required" value="<?php echo $row_edit_customer['Customer_Name']; ?>">
            </div>
            <label> Gender</label><br>
            <?php
            if($row_edit_customer['Gender_ID']==1)
              echo "<span><input type='radio' name='gender' value='1' checked='checked'>Male </span>".
                   "<span><input type='radio' name='gender' value='2'>Female </span>";
            if($row_edit_customer['Gender_ID']==2)
              echo "<span><input type='radio' name='gender' value='1'>Male </span>".
                   "<span><input type='radio' name='gender' value='2' checked='checked'>Female </span>";

            ?>
            <!--<input type="radio" name="gender" value="1"><span>Male</span>
            <input type="radio" name="gender" value="2"><span>Female</span>-->
            <br>
            <label>Email</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $row_edit_customer['Email']; ?>">
            </div>
            <label> Phone#</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-phone-square"></i>
              </div>
              <input type="text" name="phone" class="form-control" placeholder="Phone#" value="<?php echo $row_edit_customer['Contact_No']; ?>">
            </div>
            <label> CNIC</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-id-card"></i>
              </div>
              <input type="text" class="form-control" name="txt_nic" placeholder="National Identity Card" value="<?php echo $row_edit_customer['NIC']; ?>">
            </div>
            <label> Address</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-address-book"></i>
              </div>
              <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $row_edit_customer['Address']; ?>">
            </div>
            <label>Discount</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-percent"></i>
              </div>
              <input type="number" min="0" class="form-control" name="discount" placeholder="Discount" value="<?php echo $row_edit_customer['Discount']; ?>">
            </div>
            <?php
          }
            ?>
            <br>
            <div align="center">
              <button class="btn btn-success btn-large" name="save" style="width:100px;"><i class="fa fa-save fa-large"></i> Save</button>
              </div>
          </form>

          </div>
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
    <script src="js/jquery.js"></script>
      <script type="text/javascript">
    $('#CustomerUpdateModal').modal({
  show: true
})

  </script>
  <script type="text/javascript">
    $("#close").on("click",function(){
      window.location="frm_customers.php";
    });
    $("#close1").on("click",function(){
      window.location="frm_customers.php";
    });
  </script>
</body>
</html>