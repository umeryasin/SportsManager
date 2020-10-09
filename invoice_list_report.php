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
          <br>
          <h5>Invoice List Report</h5>

          <div>
            <input type="text" placeholder="Search Invoice" class="form-control" style="width: 20%; float: left;margin-left: 21em;" id="myInput">
            <span style="float: left;margin-left: 15px; font-size: 18px;">Search By</span>
            <select class="form-control" style="width: 13%; float: left;margin-left: 15px;" id="search_by">
              <option value="0">--Select Criteria--</option>
              <option value="1">Invoice No</option>
              <option value="2">Customer Name</option>
              <option value="3">Date</option>
            </select>
          </div>

          <br><br>
            <div id="view">
            <table width="100%" style="line-height:40px;" cellspacing="0" border= "0" id="myTable">
              <thead>
                <tr style="border-bottom: 1px solid; border-top: 1px solid;">

                  <th>Sr. #</th>
                  <th> Invoice No</th>
                  <th> Invoice Type</th>
                  <th> Payment Mode</th>
                  <th> Customer</th>
                  <th> Total</th>
                  <th> Discount</th>
                  <th> Grand Total</th>
                  <th> Date</th>
                  <th> Time</th>

                </tr>
              </thead>

              <?php
              $sql_data="SELECT *, invoice_master.Discount AS DIS, date_format(Date, '%d/%m/%Y') AS Date FROM invoice_master, invoicetype, paymentmode, customer WHERE invoicetype.Invoice_Type_ID=invoice_master.Invoice_Type_ID AND paymentmode.Payment_Mode_ID=invoice_master.Payment_Mode_ID AND customer.Customer_ID=invoice_master.Customer_ID ORDER BY invoice_master.Invoice_No DESC";
              $run_data=mysqli_query($ob->connect(),$sql_data);
              $i=1;
              while($row1=mysqli_fetch_array($run_data))
              {

    ?>
      <tr id="sr" value="<?php echo $row1['Invoice_No']; ?>">
        <td><label><?php echo $i; ?></label></td>
        <td><label value="<?php echo $row1['Invoice_No']; ?>"><?php echo $row1['Invoice_No']; ?></label></td>
        <td><?php echo $row1['Invoice_Type_Name']; ?></td>
        <td><?php echo $row1['Payment_Mode']; ?></td>
        <td><?php echo $row1['Customer_Name']; ?></td>
        <td><?php echo $row1['Master_Total']; ?></td>
        <td><?php echo $row1['DIS']; ?></td>
        <td><?php echo $row1['GrandTotal']; ?></td>
        <td><?php echo $row1['Date']; ?></td>
        <td><?php echo $row1['Time']; ?></td>

      </tr>
      <?php
      $i++;
    }
      ?>
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
        $("#search_by").change(function(){
          search_val=$(this).val();
        });
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

    <script type="text/javascript">
      var get_val;
      $("tr").on("click",function(e){
        e.preventDefault();
        get_val = $(this).attr('value');
        
        $('#inv_modal').modal({ show: true });
        $.ajax({
          type:'POST',
          url:'inv_det_list.php',
          data:{inv_no:get_val},
          success: function(response){
            //console.log(response);
            $("#show_tab").html(response);
          }
        });

      });
    </script>
    <script type="text/javascript">
      $("#dup_bill").on("click",function(){
    window.location="print_duplicate_bill.php?inv=" + get_val;
  });
    </script>

  </div>
</body>
</html>