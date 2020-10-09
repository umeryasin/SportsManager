<?php
include 'connect.php';
  //Start session
include 'auth.php';
include 'class_product_info.php';
$ob = new product_info;

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

if($_SESSION['admin'] == "admin" && $run_2['Products'] == 1)
    
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

  <title>Products Information</title>
  
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">


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
<span style="font-size: 22px;"><img src="images/products.png" style="width: 50px; height: 50px;"> Products Information</span>      
</div>
<div align="right">
  <a data-toggle="modal" data-target="#ProductModal" class="btn btn-large btn-primary" style="color: white;"><i style="color: white;" class="fa fa-plus fa-large"></i> Add New Product</a>
</div>
<br>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Products Information</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  
                  <th> Barcode</th>
                  <th> Product Name</th>
                  <th> Brand</th>
                  <th> Category</th>
                  <th> Size</th>
                  <th> Color</th>
                  <th> Purchase Price</th>
                  <th> Retail Price</th>
                  <th> Discount</th>
                  <th> Quantity</th>
                  
                  <th> Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql_product="SELECT * FROM product_master, productcategory WHERE product_master.Product_Category_ID=productcategory.Product_Category_ID";

                $run=mysqli_query($ob->connect(),$sql_product);
                while($row=mysqli_fetch_array($run))
                {
                  
                ?>


                <?php 
                  $br=$row['Barcode_ID'];
                  $sql_s="SELECT SUM(Product_Quantity) AS Product_Quantity FROM product_stock WHERE Barcode_ID=$br GROUP BY Barcode_ID";
                  $run_s=mysqli_query($ob->connect(),$sql_s);
                  $row_s=mysqli_fetch_array($run_s);
                  $pro_qunatity=$row_s['Product_Quantity'];


                  $sql_ss="SELECT SUM(Quantity) AS Quantity FROM invoicedetails WHERE Barcode_ID=$br GROUP BY Barcode_ID";
                  $run_ss=mysqli_query($ob->connect(),$sql_ss);
                  $row_ss=mysqli_fetch_array($run_ss);
                  $pro_sale_quantity=$row_ss['Quantity'];

                  $sql_sss="SELECT SUM(Quantity) AS Quantity FROM sales_return_detail WHERE Barcode_ID=$br GROUP BY Barcode_ID";
                  $run_sss=mysqli_query($ob->connect(),$sql_sss);
                  $row_sss=mysqli_fetch_array($run_sss);
                  $return_q=$row_sss['Quantity'];

                  $net_quantity=$pro_qunatity-$pro_sale_quantity+$return_q;
                ?>

                 <?php 
                  $sql_pr="SELECT * FROM product_price WHERE Barcode_ID=$br ORDER BY Product_Price_ID DESC LIMIT 1";
                  $run_pr=mysqli_query($ob->connect(),$sql_pr);
                  $row_pr=mysqli_fetch_array($run_pr);
                ?>

                <tr>
                  <td><?php echo $row['Barcode_ID']; ?></td>
                  <td><?php echo $row['Product_Name']; ?></td>
                  <td><?php echo $row['product_brand']; ?></td>
                  <td><?php echo $row['Category_Name'] ?></td>
                  <td>
                    <?php 
                      $size_id=$row['pro_size_id'];
                      $sql_get_size="SELECT * FROM `product_size` WHERE pro_size_id=$size_id";
                      $result_get_size=mysqli_query($ob->connect(),$sql_get_size);
                      $row_get_size=mysqli_fetch_array($result_get_size);
                      echo $row_get_size['pro_size_name']; 
                    ?>   
                  </td>
                  <td>
                    <?php 
                    $color_id=$row['pro_color_id'];
                    $sql_get_color="SELECT * FROM `product_color` WHERE pro_color_id=$color_id";
                    $result_get_color=mysqli_query($ob->connect(),$sql_get_color);
                    $row_get_color=mysqli_fetch_array($result_get_color);
                    echo $row_get_color['pro_color_name']; 
                    ?>   
                  </td>
                  <td> <?php echo $row_pr['Purchase_Price']; ?> Rs</td>
                  <td> <?php echo $row_pr['Retail_Price']; ?> Rs</td>
                  <td> <?php echo $row_pr['Product_Discount']; ?>%</td>
                  <td> <?php echo $net_quantity; ?></td>
                  
                  <td>
                    <a data-placement="left" id="<?php echo $row['Barcode_ID']; ?>" href="edit_product.php?id=<?php echo $row['Barcode_ID']; ?>" title="Click to Edit"><button class="btn btn-success"><i class="fa fa-pencil"></i> </button></a>

                    <a data-placement="left" id="<?php echo $row['Barcode_ID']; ?>" href="delete_product_info.php?id=<?php echo $row['Barcode_ID']; ?>" title="Click to Delete"><button class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>
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


      <!--Product Modal Start-->
<div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="ProductModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ExpModalLabel"><i class="fa fa-plus fa-large"></i> Add New Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="controler_product_info.php" method="post">
              <label> Barcode</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-barcode"></i>
              </div>
              <input type="text" name="barcode" placeholder="Barcode" class="form-control" required="required">
            </div>
            <label id="send"> Product Name</label>
            <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-info"></i>
              </div>
            <input type="text" name="txt_product_name" placeholder="Product Name" class="form-control" required="required" >
          </div>
          <label id="send"> Brand Name</label>
            <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-info"></i>
              </div>
            <input type="text" name="txt_product_brand" placeholder="Brand Name" class="form-control" required="required" >
          </div>

              <label> Category</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-tags"></i>
              </div>
              <select name="pro_category_id" class="form-control" id="category">
                <option>--Select Category--</option>
                <?php
                $sql_select_category="SELECT * FROM `productcategory`";
                $run=mysqli_query($ob->connect(),$sql_select_category);
                while($row=mysqli_fetch_array($run))
                {
                ?>
                <option value="<?php echo $row['Product_Category_ID']; ?>"><?php echo $row['Category_Name']; ?></option>
                <?php
              }
                ?>
              </select>
            </div>

             <label> Color</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-product-hunt"></i>
              </div>
              <select name="select_pro_color" class="form-control" id="select_pro_color">
                <option value="0">--Select Color--</option>
                <?php
                $sql_select_col="SELECT * FROM `product_color`";
                $run_select_col=mysqli_query($ob->connect(),$sql_select_col);
                while($row=mysqli_fetch_array($run_select_col))
                {
                ?>
                <option value="<?php echo $row['pro_color_id']; ?>"><?php echo $row['pro_color_name']; ?></option>
                <?php
              }
                ?>
              </select>
            </div>

             <label> Size</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-product-hunt"></i>
              </div>
              <select name="select_pro_size" class="form-control" id="select_pro_size">
                <option value="0">--Select Size--</option>
                <?php
                $sql_select_size="SELECT * FROM `product_size`";
                $run_select_size=mysqli_query($ob->connect(),$sql_select_size);
                while($row=mysqli_fetch_array($run_select_size))
                {
                ?>
                <option value="<?php echo $row['pro_size_id']; ?>"><?php echo $row['pro_size_name']; ?></option>
                <?php
              }
                ?>
              </select>
            </div>

               <label> Product Unit</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-product-hunt"></i>
              </div>
              <select class="form-control"  id="product_unit" name="product_unit">
                <?php
                  $sql_sel_sub_c="SELECT * FROM productunit";
                  $run_sel_sub_c=mysqli_query($ob->connect(),$sql_sel_sub_c);
                  while($row_sel_sub_c=mysqli_fetch_array($run_sel_sub_c))
                  {
                    ?>
                    <option value="<?php echo $row_sel_sub_c['Product_Unit_Id'];?>"><?php echo $row_sel_sub_c['Product_Unit']; ?></option>
                    <?php
                  }
                  ?>
              </select>
            </div>
          
            <label> Purchase Price</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-money"></i>
              </div>
              <input type="number" min="0" name="txt_wholesale_price" class="form-control" placeholder="Purchase Price" required="required">
            </div>
            <label> Retail Price</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-money"></i>
              </div>
              <input type="number" min="0" name="txt_retail_price" class="form-control" placeholder="Retail Price" required="required">
            </div>
            <label> Discount</label>
              <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-percent"></i>
              </div>
              <input type="number" min="0" name="txt_discount" class="form-control" placeholder="Discount" value="0.0">
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
    <!--Product Modal End-->


    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
	<?php include('footer.php'); ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>





          </div>
        </div>
      </div>
    </div>
<!--Product Modal End-->
    
    <!-- Product Update Modal-->
    
    <!--Product Update Model End-->

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
 if(confirm("Sure you want to delete this Product ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_product_info.php",
   data: info,
   success: function(){
   window.location = 'frm_product_info.php';
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
          $("#product_text").css("color","red");
        </script>




  </div>
</body>
</html>
