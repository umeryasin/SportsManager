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

$run_2 = mysqli_fetch_array($query_cus);

/*if ($query_cus) {
  $query_cus = 1;
}else{
  $query_cus = 0;
}*/

if($_SESSION['admin'] == "admin" && $run_2['Reports'] == 1)
    
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
  <title>Reports</title>
  <link rel="stylesheet" type="text/css" href="css/style_report.css">
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <style type="text/css">
    img{
      width: 40px; height: 40px;
    }
  </style>
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

<body class="fixed-nav sticky-footer bg-white" id="page-top">
  <!-- Navigation-->
  <?php include 'navbar.php'; ?>
  <?php include 'nav3.php'; ?>
  
  <!--Nav-End-->
  <br>
  <div style="margin-top: 94px;" align="center">
    <div class="container-fluid">
      <div style="" align="center">
      <span style="font-size: 22px;"><img src="images/report.png" style="width: 50px; height: 50px;"> Reports</span>  
  </div>
<br>
      <!-- Breadcrumbs-->
      <table align="center" cellpadding="20">
      <div style="">
        <tr class="img">
              <td title="Busines info Report">
                <div class="report">
                  <span><img src="images/smallbusiness.png" ></span>
                  &nbsp;
                  <span><a href="business_info_report.php" target="_blank">Busines info Report</a></span>
                </div>
              </td>
              <td title="Vendors info Report">
                <div class="report">
                  <span><img src="images/business-man.png" ></span>
                  &nbsp;
                  <span><a href="vendors_info_report.php" target="_blank">Vendors info Report</a></span>
                </div>
              </td>
              <td title="Customers Info Report">
                <div class="report">
                  <span><img src="images/Strategy.png" ></span>
                  &nbsp;
                  <span><a href="customer_info_report.php" target="_blank">Customers Info Report</a></span>
                </div>
              </td>
              <td title="Highest Valued Customers List">
                <div class="report">
                  <span><img src="images/Highest_Valued_Customers_List.jpg" ></span>
                  &nbsp;
                  <span><a href="high_value_customers_report.php" target="_blank">Highest Valued Customers List</a></span>
                </div>
              </td>

      </tr>
      <tr>
              <td title="Product Quantity Report">
                <div class="report">
                  <span><img src="images/product_quantity_report.png" ></span>
                  &nbsp;
                  <span><a href="product_quantity_report.php" target="_blank">Product Quantity Report</a></span>
                </div>
              </td>
              <td title="Product List Report">
                <div class="report">
                  <span><img src="images/product_report.jpg" ></span>
                  &nbsp;
                  <span><a href="product_list_report.php" target="_blank">Product List Report</a></span>
                </div>
              </td>
              <td title="Product Type Report">
                <div class="report">
                  <span><img src="images/product_type_report.png" ></span>
                  &nbsp;
                  <span><a href="product_type_report.php" target="_blank">Product Type Report</a></span>
                </div>
              </td>
              <!--
              <td title="Products By Vendors">
                <div class="report">
                  <span><img src="images/size.png" ></span>
                  &nbsp;
                  <span><a href="" target="_blank">Products By Vendors</a></span>
                </div>
              </td>
              -->
              <td title="Stock value">
                <div class="report">
                  <span><img src="images/stock_value.png" ></span>
                  &nbsp;
                  <span><a href="frm_stock_value.php" target="_blank">Stock Value</a></span>
                </div>
              </td>
      </tr>
      <tr>
        <td title="General Journal">
                <div class="report">
                  <span><img src="images/journal.png" ></span>
                  &nbsp;
                  <span><a href="frm_general_journal.php" target="_blank">General Journals</a></span>
                </div>
              </td>
              <td title="General Ledger">
                <div class="report">
                  <span><img src="images/ledger.png" ></span>
                  &nbsp;
                  <span><a href="frm_general_ledger.php" target="_blank">General Ledger</a></span>
                </div>
              </td>
              <td title="Trial Balance Sheet">
                <div class="report">
                  <span><img src="images/Trail_Balance_Sheet.png" ></span>
                  &nbsp;
                  <span><a href="save_trial_balance.php">Trial Balance Sheet</a></span>
                </div>
              </td>
        <td title="Income Statement">
                <div class="report">
                  <span><img src="images/income.png" ></span>
                  &nbsp;
                  <span><a href="frm_income_statement.php" target="_blank">Income Statement</a></span>
                </div>
              </td>
      </tr>
      <tr>
        <td title="Balance Sheet">
          <div class="report">
          <span><img src="images/balance.jpg" ></span>
          &nbsp;
          <span><a href="frm_balance_sheet.php" target="_blank">Balance Sheet</a></span>
          </div>
        </td>
        <td title="Date-Wise Quantity List">
          <div class="report">
          <span><img src="images/balance.jpg" ></span>
          &nbsp;
          <span><a href="frm_datewise_quantity.php" target="_blank">Date-Wise Quantity List</a></span>
          </div>
        </td>
        <td title="Date-Wise Price List">
          <div class="report">
          <span><img src="images/Pricelist.png" ></span>
          &nbsp;
          <span><a href="frm_datewise_price.php" target="_blank">Date-Wise Price List</a></span>
          </div>
        </td>
        <td title="Sales Return Invoices">
          <div class="report">
          <span><img src="images/return.png" ></span>
          &nbsp;
          <span><a href="frm_sales_return_report.php" target="_blank">Sales Return Invoices</a></span>
          </div>
        </td>
      </tr>
      <tr>
      	<td title="Date-Wise Inventory">
          <div class="report">
          <span><img src="images/inventory.png" ></span>
          &nbsp;
          <span><a href="frm_date_wise_inventory.php" target="_blank">Date_Wise Inventory</a></span>
          </div>
        </td>
        <td title="Invoice List Report">
          <div class="report">
          <span><img src="images/invoice_list.png" ></span>
          &nbsp;
          <span><a href="invoice_list_report.php" target="_blank">Invoice List Report</a></span>
          </div>
        </td>
        <td title="Profit By Date">
          <div class="report">
          <span><img src="images/profit_ico.png" ></span>
          &nbsp;
          <span><a href="profit_by_date.php" target="_blank">Profit By Date</a></span>
          </div>
        </td>
      </tr>
    </div>
  </table>
    <br>
</div><br>
      <!-- Example DataTables Card-->
      <!---New-->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
	<?php include('footer.php'); ?>
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
 if(confirm("Sure you want to delete this Country Info ?"))
      {

 $.ajax({
   type: "GET",
   url: "delete_country_info.php",
   data: info,
   success: function(){
   window.location = 'frm_country_info.php';
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
          $("#reports_text").css("color","red");
        </script>
  </div>
</body>
</html>
