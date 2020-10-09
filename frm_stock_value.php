<?php
include 'connect.php';
  //Start session
include 'auth.php';

include 'conn.php';
$ob=new conn;

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

if($_SESSION['admin'] == "admin" && $run2['Reports'] == 1)
    
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

  <title>Invoice List Report</title>
  <style type="text/css">
    #sr:hover{
      background-color: #efefef;
    }
  </style>

<style type="text/css">
  hr {
    color: black;
    background-color: black;
  }
</style>
<style>
      .table_footer{border:none;text-align:right;}
    </style>
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
 
  <div class="">
    <div class="container-fluid">
      
      <!-- Example DataTables Card-->
      <?php 
      $sql1 = "SELECT * FROM business_info";
      $query = mysqli_query($ob->connect(),$sql1);
      $row = mysqli_fetch_array($query);
      ?>
      <div align="center">
          
          <h5 align="center"><?php echo $row['Business_Name']; ?></h5>
          <h5 align="center"><?php echo $row['Contact_No']; ?></h5>
          <h5>Stock Value Report Report</h5>
          <div class="row" style="text-align: center; width: 35%; border: 2px solid black;">
              <div class="col-md-6">
                <h5>Total value of Stock</h5>
              </div>
              <div class="col-md-6">
                <h5 id="total_stock"></h5>
              </div>
          </div>
          <br>
            <div id="view">
              <table class="table">
                <thead>
                  <tr>
                    <th>Barcode/ID</th>
                    <th>Product</th>
                    <th>Stock</th>
                    <th>Stock Value</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sum_of_stock_price=0;
                  $sql_get_all="SELECT * FROM product_master";
                  $run_get_all=mysqli_query($ob->connect(),$sql_get_all);
                  while($row_get_all=mysqli_fetch_assoc($run_get_all))
                  {
                    ?>
                    <tr>
                      <td><?php echo $row_get_all['Barcode_ID']; ?></td>
                      <td><?php echo $row_get_all['Product_Name']; ?></td>
                      <td>
                        <?php
                          $br=$row_get_all['Barcode_ID'];
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
                          echo $net_quantity;
                        ?>
                      </td>
                      <td>
                        <?php
                         $sql_pr="SELECT * FROM product_price WHERE Barcode_ID=$br ORDER BY Product_Price_ID DESC LIMIT 1";
                          $run_pr=mysqli_query($ob->connect(),$sql_pr);
                          $row_pr=mysqli_fetch_array($run_pr);
                          $prc=$row_pr['Retail_Price'];
                          $stock_value=$net_quantity*$prc;
                          echo $stock_value;
                          echo " PKR";
                          $sum_of_stock_price=$sum_of_stock_price+$stock_value;
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
                <tfoot class="tfoot-dark" style="background-color: #808080;">
                  <tr>
                    <td colspan="2"></td>
                    <td><b>Total Stock Value</b></td>
                    <td id="total_stock_get"><b><?php echo $sum_of_stock_price; ?> PKR</b></td>
                  </tr>
                </tfoot>
              </table>
            </div>
        
      </div>
    </div>

    <!--Modal-->
    <div class="modal fade" id="inv_modal" tabindex="-1" role="dialog" aria-labelledby="inv_ModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="inv_ModalLabel">Invoice Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="show_tab">
           
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-large btn-primary" id="dup_bill"><i class="fa fa-print fa-large"></i> Print Duplicate Bill </button>
          </div>
        </div>
      </div>
    </div>
    <!--Modal-End-->
 
    <!-- /.content-wrapper-->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
<!-- JavaScript Libraries-->
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
      /////Variables
      var search_val=0;
    </script>


    <script type="text/javascript">
      
      $(document).ready(function(){
        var stock=$("#total_stock_get").text();
        $("#total_stock").text(stock);
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#myInput").on("keyup",function(){
          if(search_val==0)
            alert("Please Select Search Criteria !");
          else if(search_val==1)
          {
             var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
          }
          ///////
          else if(search_val==2)
          {
             var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
          }
          //////
           ///////
          else if(search_val==3)
          {
             var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[8];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
          }
          //////
        });
      })
    </script>
    

  </div>
</body>
</html>