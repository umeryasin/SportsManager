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
  include 'connect.php';
  //Start session
  include 'auth.php';
  ///////
  include 'conn.php';
  $ob=new conn;
 $id=$_GET['id'];

 $page_per = $_SESSION['SESS_TYPE_ID'];
/*$page_per = "0";
if (isset($_SESSION['SESS_TYPE_ID'])) {
  $page_per = $_SESSION['SESS_TYPE_ID'];

}*/
$cus_sql = "SELECT * FROM user_permission AS UP, usertype AS UT WHERE UP.User_Type_Id = UT.User_Type_Id AND UP.User_Type_Id = $page_per";
$query_cus = mysqli_query($ob->connect(),$cus_sql);

$run2 = mysqli_fetch_array($query_cus);

/*if ($query_cus) {
  $query_cus = 1;
}else{
  $query_cus = 0;
}*/

if($_SESSION['admin'] == "admin" && $run2['Products'] == 1)
    
    $counter = 1;
else{ 
  session_destroy();
  header("location: index.php");
}


 ?>
</head>
<body>
	 <!--Product Modal Start-->
<div class="modal fade" id="UpdateProductModal" tabindex="-1" role="dialog" aria-labelledby="UpdateProductModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ExpModalLabel"><i class="fa fa-pencil fa-large"></i> Update Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close" id="close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="update_product.php" method="post">
              <?php
              $sql_12="SELECT * FROM product_master, productcategory, productunit WHERE product_master.Product_Category_ID=productcategory.Product_Category_ID AND Barcode_ID=$id AND product_master.Product_Unit_Id=productunit.Product_Unit_Id";
              $run_12=mysqli_query($ob->connect(),$sql_12);
              while($row_12=mysqli_fetch_array($run_12))
              {

              ?>
              <label> Barcode</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-barcode"></i>
              </div>
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="text" name="barcode" placeholder="Barcode" class="form-control" required="required" value="<?php echo $row_12['Barcode_ID']; ?>">
            </div>
            <label id="send"> Product Name</label>
            <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-info"></i>
              </div>
            <input type="text" name="txt_product_name" placeholder="Product Name" class="form-control" required="required" value="<?php echo $row_12['Product_Name']; ?>" >
          </div>
              <label> Category</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-tags"></i>
              </div>
            
              <select name="select_category" class="form-control" onChange="changetextbox();" id="mfi_4_a_i" >
                <option selected="selected" value="<?php echo $row_12['Product_Category_ID']; ?>"><?php echo $row_12['Category_Name']; ?></option>
              </select>
            </div>
              <label> Product Unit</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-product-hunt"></i>
              </div>
              <select class="form-control" name="role">
        
                <option value="<?php echo $row_12['Product_Unit_Id']; ?>"><?php echo $row_12['Product_Unit']; ?></option>
              </select>
            </div>
            <?php
            $sql_pr="SELECT * FROM product_price WHERE Barcode_ID=$id ORDER BY Product_Price_ID DESC LIMIT 1";
                  $run_pr=mysqli_query($ob->connect(),$sql_pr);
                  $row_pr=mysqli_fetch_array($run_pr);
            ?>
            <label> Purchase Price</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-money"></i>
              </div>
              <input type="number" min="0" name="txt_wholesale_price" class="form-control" placeholder="Purchase Price" required="required" value="<?php echo $row_pr['Purchase_Price']; ?>">
            </div>
            <?php
            $sql_pr="SELECT * FROM product_price WHERE Barcode_ID=$id ORDER BY Product_Price_ID DESC LIMIT 1";
                  $run_pr=mysqli_query($ob->connect(),$sql_pr);
                  $row_pr=mysqli_fetch_array($run_pr);
            ?>
            <label> Retail Price</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-money"></i>
              </div>
              <input type="number" min="0" name="txt_retail_price" class="form-control" placeholder="Retail Price" required="required" value="<?php echo $row_pr['Retail_Price']; ?>">
            </div>
            <label> Discount</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-percent"></i>
              </div>
              <input type="number" min="0" name="txt_discount" class="form-control" placeholder="Discount" value="<?php echo $row_pr['Product_Discount']; ?>">
            </div>
           <?php
           $sql_s="SELECT SUM(Product_Quantity) AS Product_Quantity FROM product_stock WHERE Barcode_ID=$id GROUP BY Barcode_ID";
                  $run_s=mysqli_query($ob->connect(),$sql_s);
                  $row_s=mysqli_fetch_array($run_s);
                  $pro_qunatity=$row_s['Product_Quantity'];


                  $sql_ss="SELECT SUM(Quantity) AS Quantity FROM invoicedetails WHERE Barcode_ID=$id GROUP BY Barcode_ID";
                  $run_ss=mysqli_query($ob->connect(),$sql_ss);
                  $row_ss=mysqli_fetch_array($run_ss);
                  $pro_sale_quantity=$row_ss['Quantity'];

                  $sql_sss="SELECT SUM(Quantity) AS Quantity FROM sales_return_detail WHERE Barcode_ID=$id GROUP BY Barcode_ID";
                  $run_sss=mysqli_query($ob->connect(),$sql_sss);
                  $row_sss=mysqli_fetch_array($run_sss);
                  $return_q=$row_sss['Quantity'];

                  $net_quantity=$pro_qunatity-$pro_sale_quantity+$return_q;

           ?>
              <label> Existing Quantity in Stock</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-stack-overflow"></i>
              </div>
              <input type="text" name="txt_stock"  class="form-control" placeholder="Quantity Stock" required="required" value="<?php echo $net_quantity; ?>" disabled="disabled">
              <input type="hidden" name="txt_stock" value="">
            </div>
        
            <br>
            <?php
            break;
          }
            ?>
            <input type="hidden" name="charclass" value="<?php echo $row_12['Product_Unit_Id']; ?>">
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
    <!--Product Modal End-->
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
    $('#UpdateProductModal').modal({
  show: true
})

  </script>
  <script type="text/javascript">
  	$("#close").on("click",function(){
  		window.location='frm_product_info.php';
  	});
    $("#close1").on("click",function(){
      window.location='frm_product_info.php';
    });
  </script>
</body>
</html>