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

 
 <!-- Update Vendor Modal Start-->
    <div class="modal fade" id="UpdateVendorModal" tabindex="-1" role="dialog" aria-labelledby="UpdateVendorModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="UpdateModalLabel"><i class="fa fa-pencil fa-large"></i> Update Vendor Info</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close" id="close">
              <span aria-hidden="true">x</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="update_supplier.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <?php
              $sql_vendor_edit="SELECT * FROM vendor WHERE Vendor_ID=$id";
              $run_vendor_edit=mysqli_query($ob->connect(),$sql_vendor_edit);
              while($row=mysqli_fetch_array($run_vendor_edit))
              {


              ?>
               <label> Vendor Name</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-user-circle-o"></i>
              </div>
            <input type="text" class="form-control" name="txt_supplier_name" placeholder="Vendor Name" required="required" value="<?php echo $row['Vendor_Name']; ?>"></div>
            <label> Email</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $row['Email']; ?>">
            </div>
            <label> Phone#</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-phone-square"></i>
              </div>
              <input type="text" name="phone" class="form-control" placeholder="Phone#" value="<?php echo $row['Contact_No']; ?>">
            </div>
            <label> NTN / Reg. No.</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-id-card"></i>
              </div>
              <input type="text" class="form-control" name="txt_reg_no" placeholder="NTN / Reg. No." value="<?php echo $row['Reg_No']; ?>">
            </div>
            <label> Address</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-address-book"></i>
              </div>
              <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $row['Address']; ?>">
            </div>
            <label> Country</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-flag"></i>
              </div>
              <input type="text" class="form-control" name="txt_country" placeholder="Country" value="<?php echo $row['Country_Name']; ?>">
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
    $('#UpdateVendorModal').modal({
  show: true
})

  </script>
  <script type="text/javascript">
    $("#close").on("click",function(){
      window.location="frm_suppliers.php";
    });
    $("#close1").on("click",function(){
      window.location="frm_suppliers.php";
    });
  </script>
</body>
</html>