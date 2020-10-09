<?php
include 'connect.php';
  //Start session
include 'auth.php';

error_reporting(0);
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

if($_SESSION['admin'] == "admin" && $run_2['Sales_Return'] == 1)
    
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

  <title>Sales Return</title>
  
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendors/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <script src="vendors/jquery/jquery.min.js"></script>

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
        <span style="font-size: 22px;"><img src="images/return.png" style="width: 50px; height: 50px;"> Sales Return </span>
      </div>
<br>
      <!-- Example DataTables Card-->
      <div style="margin-left: 50px;">
        <?php
           $inv_no=$_GET['InvoiceNo'];
           $sql_inv_type="SELECT *, date_format(Date, '%d/%m/%Y') as Date FROM sales_master,invoicetype WHERE sales_master.Invoice_Type_ID=invoicetype.Invoice_Type_ID AND Invoice_No='$inv_no' ";
           $run_inv_type=mysqli_query($ob->connect(),$sql_inv_type);
           $row_inv_type=mysqli_fetch_array($run_inv_type);
           

           $sql_cus="SELECT * FROM invoice_master,customer WHERE invoice_master.Customer_ID=customer.Customer_ID AND Invoice_No=$inv_no";
           $run_cus=mysqli_query($ob->connect(),$sql_cus);
           $row_cus=mysqli_fetch_array($run_cus);

           ?>

           <script type="text/javascript">
            var barcode_list=new Array();
            var product_name_list=new Array();
            var unit_price_list=new Array();
            var quantity_list=new Array();
            var rqun_list=new Array();
            var sub_total_list=new Array();
          </script>
        
        <form method="get" action="frm_sales_return.php">
          
            <label> Invoice No. : </label>
            &nbsp;&nbsp;

            <input type="text" style="width: 150px;" name="InvoiceNo" placeholder="Invoice No." id="invoice_no" autofocus="autofocus">

            <input type="hidden" name="inv_copy" id="inv_copy" value="<?php echo $row_inv_type['Invoice_No']; ?>">
            <button class="btn btn-success btn-sm" id="go" name="go" style="margin-bottom: 4px;"><i class="fa fa-search"></i> Search</button>
            <label style="margin-left: 50px;"> Invoice Type : </label>
            &nbsp;&nbsp;

            

            <select name="InvoiceType" id="inv_type">
              <option value="<?php echo $row_inv_type['Invoice_Type_ID']; ?>"><?php echo $row_inv_type['Invoice_Type_Name']; ?></option>
            </select>
            <label> Payment Mode : </label>
            &nbsp;&nbsp;
            <select name="PaymentMode" id="payment_mode_id">
              <?php
              $inv=$row_inv_type['Invoice_No'];
               $run_payment=mysqli_query($ob->connect(),"SELECT * FROM paymentmode,invoice_master WHERE Invoice_No='$inv' AND paymentmode.Payment_Mode_ID=invoice_master.Payment_Mode_ID");
               $fet=mysqli_fetch_array($run_payment);

               ?>
               <option value="<?php echo $fet['Payment_Mode_ID']; ?>" ><?php echo $fet['Payment_Mode']; ?></option>
            </select>
            
            <label style="margin-left: 50px;"> Date : </label>
            <input type="text" style="width: 150px;" name="Date" value="<?php echo $row_inv_type['Date']; ?>" readonly="readonly">
            <br><br>
            <label> Customer : </label>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <select name="CustomerName">
              <option id="customer" value="<?php echo $row_cus['Customer_ID'] ?>"><?php echo $row_cus['Customer_Name']; ?></option>
            </select>
            <br><br>

             <div style="float: left; margin-right: 20px;">
                <p> Barcode</p>
                <input type="text" style="width: 150px;" name="Barcode" placeholder="Product Info" disabled="disabled" id="txt_barcode">
            </div>
            <div style="float: left; margin-right: 20px;">
                <p> Product</p>
                <input type="text" style="width: 250px;" name="Products" placeholder="Product Info" disabled="disabled" id="txt_product">
            </div>


            <div style="float: left; margin-right: 20px;">
                <p> Return Quantity</p>
                <input type="text" min="0" style="width: 100px;" name="RQuantity" placeholder="Qty" id="txt_rqty" disabled="disabled">
                <input type="hidden" name="qun" id="qun">
            </div>


            <div style="float: left; margin-right: 20px;">
                <p> Remaining Quantity</p>
                <input type="text" min="0" style="width: 100px;" name="Quantity" placeholder="Qty" id="txt_qty" disabled="disabled">
            </div>

            <div style="float: left; margin-right: 20px;">
                <p> Unit Price</p>
                <input type="text" style="width: 100px;" value="0.00" name="Price" placeholder="0.00" disabled id="price">
            </div>

            <div style="float: left; margin-right: 20px;">
                <p> Sub Total</p>
                <input type="text" style="width: 100px;" value="0.00" name="sub_tot" placeholder="0.00" disabled id="sub_tot">
            </div>

            <div style="margin-top: 40px;">
                <label class="btn btn-success btn-sm" name="save" style="width:100px;" id="add_row"><i class="fa fa-plus-circle fa-large"></i> Add</label>
                <label class="btn btn-info btn-sm" name="save" style="width:100px;" id="clear"><i class="fa fa-eraser fa-large"></i> Clear</label>
            </div>

            <br><br>
            <table class="table table-bordered" id="" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Product Code</th>
                  <th> Product Name</th>
                  <th> Unit Price</th>
                  <th> Discount</th>
                  <th id="name_quantity"> Purchase Quantity</th>
                  <th> Return Quantity</th>
                  <th> Sub Total</th>
                  <th> Action</th>
                </tr>
              </thead>

              <tbody id="Show_Invoice_Detail">
              	<?php
              	$i_no=$row_inv_type['Invoice_No'];
              	$sql_tab="SELECT * FROM product_master,sales_detail WHERE sales_detail.Barcode_ID=product_master.Barcode_ID AND Sales_No='$i_no' ";
              	$run_tab=mysqli_query($ob->connect(),$sql_tab);


           
              	while($row=mysqli_fetch_array($run_tab))
              	{


              	?>
              	<tr>
              		<td><?php echo $row['Barcode_ID']; ?></td>
              		<td><?php echo $row['Product_Name']; ?></td>
              		<td><?php echo $row['Sale_Price']; ?></td>
                  <td><?php echo $row['Sales_Individual_Discount']; ?>%</td>
              		<td><?php echo $row['Quantity']; ?></td>
                  <td><?php echo $row['Return_Quantity']; ?></td>
              		<td><?php echo $row['Detail_Total']; ?></td>
              		<td><label class="btn btn-info btn-sm" id="edit_row" value="<?php echo $row['Barcode_ID']; ?>"><?php echo $row['Barcode_ID']; ?></label></td>
              	</tr>
                <?php
                $bar_co=$row['Barcode_ID'];
                $pro_n=$row['Product_Name'];
                $rp=$row['Sale_Price'];
                $qun=$row['Quantity'];
                $rqun=$row['Return_Quantity'];
                $sub_t=$row['Detail_Total'];
                ?>
                <script type="text/javascript">
                  var product="<?php echo $bar_co; ?>";
                 //console.log(product);
                  var name="<?php echo $pro_n; ?>";
                  //console.log(name);
                  var price="<?php echo $rp; ?>";
                  //console.log(price);
                  var quantity="<?php echo $qun; ?>";
                  //console.log(quantity);
                  var rqun=0;
                  //console.log(rqun);
                  var sub_total="<?php echo $sub_t; ?>";
                  //console.log(sub_total);

                  barcode_list.push(product);
                  product_name_list.push(name);
                  unit_price_list.push(price);
                  quantity_list.push(quantity);
                  rqun_list.push(rqun);
                  sub_total_list.push(sub_total);

                  console.log(barcode_list);
                  console.log(product_name_list);
                  console.log(unit_price_list);
                  console.log(quantity_list);
                  console.log(rqun_list);
                  console.log(sub_total_list);

                </script>


              	<?php

              	}
              	?>
              </tbody>
            </table>
            <br>
            <label style="margin-left: 697px;"> Total : </label>
            &nbsp;
            <input type="text" style="width: 150px;" name="Total" placeholder="Total" disabled value="<?php echo $row_inv_type['Master_Total']; ?>" id="total">
            <br>
            <label style="margin-left: 670px;"> Discount : </label>
            &nbsp;
            <input type="text" style="width: 150px;" name="Discount" placeholder="Discount" value="<?php echo $row_inv_type['Discount']; ?>" id="discount">
            <br>
            <label style="margin-left: 650px;"> Grand Total : </label>
            &nbsp;
            <input type="text" style="width: 150px;" name="GrandTotal" placeholder="Grand Total" id="grand_total" disabled value="<?php echo $row_inv_type['GrandTotal']; ?>">

            <br>
            <label style="margin-left: 612px;"> Customer Return : </label>
            &nbsp;
            <input type="text" style="width: 150px;" name="CustomerReturn" placeholder="Customer Return" id="customer_return" disabled>

            
            <br><br>
            <div align="center">
              <label class="btn btn-large btn-primary" id="dup_bill"><i class="fa fa-print fa-large"></i> Duplicate Bill </label>
              <label class="btn btn-large btn-success" id="return"><i class="fa fa-arrow-circle-o-left fa-large"></i> Return </label>
              </div>

           </form>
           
        
      </div>

      <!-- End Example DataTables Card-->



    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
   <?php include('footer.php'); ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

<!-- Update Modal Start-->
    <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil fa-large"></i> Update Account</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="updates_account_info.php" method="post">
          
            <label> Account Name :</label>
            <input type="text" class="form-control" style="width: 200px;" name="txt_account_name" placeholder="Account Name" required>
           <br>
            <label>Account Type :</label>&nbsp;
            <br>
            <select class="form-control" style="width: 200px;" name="select_head_of_accounts">
              <option>Slect 1</option>
            </select>
            <br>
            
            <br>        
            <label>Balance Type :</label><br>
            <select class="form-control" style="width: 200px;" name="select_balance_type_info">
              <option>Slect 1</option>
            </select>
            <br>
            <label> Description :</label>
            <textarea name="txt_description" style="width: 250px;" class="form-control"></textarea>
            <br>
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
<!--Update Modal End-->
    
    <!-- Logout Modal-->
    <div class="modal fade" id="CustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus fa-large"></i> Add New Customer</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="#" method="post">
          
            <label> Name</label>
            <input type="text" class="form-control" name="txt_name" placeholder="Customer Name" required="required">
            <label> Gender</label><br>
            <input type="radio" name="gender" value="Male"><span> Male</span>&nbsp;
            <input type="radio" name="gender" value="Female"><span> Female</span>
            <br>
            <label>Email</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </div>
              <input type="text" name="email" placeholder="Email" class="form-control">
            </div>
            <label> Phone#</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-phone-square"></i>
              </div>
              <input type="text" name="phone" class="form-control" placeholder="Phone#">
            </div>
            <label> NIC</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-id-card"></i>
              </div>
              <input type="text" class="form-control" name="txt_nic" placeholder="National Identity Card">
            </div>
            <label> Address</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-address-book"></i>
              </div>
              <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
            <label>Discount</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-percent"></i>
              </div>
              <input type="number" class="form-control" name="discount" value="0.0" placeholder="Discount">
            </div>
            <br>
            <div align="center">
              <button class="btn btn-success btn-large" name="save" style="width:100px;"><i class="fa fa-save fa-large"></i> Save</button>
              </div>
          </form>

          </div>
          <div class="modal-footer" >
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-remove fa-large"></i> Close</button>
            
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



 <script type="text/javascript">
  $(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});
 </script>





 <script type="text/javascript">
   var total=0;
   total=$("#total").val();

   var org_total=0;
   var discount=0;
   discount=$("#discount").val();
   var grand_total=0;
   grand_total=$("#grand_total").val();
   var stock;
   var return_to_cus=0;
   $("#return_to_cus").val(return_to_cus);
   var org_grand_total=$("#grand_total").val();
   
   
 </script>

<?php
$inv_nnn=$row_inv_type['Invoice_No'];
$sql="SELECT Sales_Return_No FROM sales_return_master WHERE Invoice_No='$inv_nnn'";
$run=mysqli_query($ob->connect(),$sql);
$new=mysqli_fetch_array($run);
$sales_no=$new['Sales_Return_No'];
$sales_new=$sales_no;
?>




 <script type="text/javascript">
   $(document).on("click", "#edit_row", function() {
    $("#name_quantity").html("Remaining Product");
    $("#txt_rqty").removeAttr('disabled');
    $("#txt_rqty").focus();

   var key=$(this).html();
   console.log(key);
     
      var save=-1;
      for(var i=0; i<barcode_list.length; i++)
      {
        
        if(barcode_list[i] == key)
        {
         // console.log("IN If Statement");
          save=i;
          break;
        }
      }
      ////////
      //console.log(save);
      if(save>=0)
      {

var inv_nn="<?php echo $row_inv_type['Invoice_No']; ?>";
        $.ajax({
          type: 'POST',
          url: 'sales_get.php',
          data: {'Name': key},
          success: function(response){
            //console.log(response);
            $("#txt_barcode").val(response);
            $("#txt_barcode").html(response);
          }
        });

        $.ajax({
          type: 'POST',
          url: 'sales_get.php',
          data: {'Name_n': key},
          success: function(response){
            //console.log(response);
            $("#txt_product").val(response);
            $("#txt_product").html(response);
          }
        });

        $.ajax({
          type: 'POST',
          url: 'sales_get.php',
          data: {Qty: key,
            inv_nn:inv_nn},
          success: function(response){
           // console.log(response);
            $("#txt_qty").val(response);
            $("#txt_qty").html(response);
          }
        });

        $.ajax({
          type: 'POST',
          url: 'sales_get.php',
          data: {Qty_Q: key,
            inv_nn:inv_nn},
          success: function(response){
            //console.log(response);
            $("#qun").val(response);
            $("#qun").html(response);
            console.log($("#qun").val());
          }
        });

        $.ajax({
          type: 'POST',
          url: 'sales_get.php',
          data: {Unit_Price: key,
            inv_nn:inv_nn},
          success: function(response){
            //console.log(response);
            $("#price").val(response);
            $("#price").html(response);
          }
        });

        
        $.ajax({
          type: 'POST',
          url: 'sales_get.php',
          data: {Sub_Tot: key,
                  inv_nn: inv_nn},
          success: function(response){
            //console.log(response);
            $("#sub_tot").val(response);
            $("#sub_tot").html(response);
          }
        });


       
     
        
        //////////////////////

      total=total - sub_total_list[save];
      return_to_cus=return_to_cus + sub_total_list[save];
      $("#return_to_cus").val(return_to_cus);


      org_total=org_total + parseInt(sub_total_list[save]);
      //alert(org_total);

      barcode_list.splice(save,1);
      product_name_list.splice(save,1);
      unit_price_list.splice(save,1);
      quantity_list.splice(save,1);
      rqun_list.splice(save,1);
      sub_total_list.splice(save,1);

      
      console.log(barcode_list);
      console.log(product_name_list);
      console.log(unit_price_list);
      console.log(quantity_list);
      console.log(rqun_list);
      console.log(sub_total_list);

       $("#total").val(total);

       Discount=$("#discount").val();
       grand_total=total - discount;
      $("#grand_total").val(grand_total);

      $("#customer_return").val(org_grand_total - grand_total);
      }

      $(this).parents('tr').remove();
 });
 </script>

 <script type="text/javascript">
   $("#discount").keyup(function(){
    discount=$("#discount").val();
    grand_total=total - discount;
    $("#grand_total").val(grand_total);


    $("#customer_return").val(org_grand_total - grand_total);

   });
 </script>




  <script type="text/javascript">
    
    
  $('#add_row').on('click', function(e) {


    var save=-1;
    var keys=$("#txt_product").val();

    var stock=$("#txt_qty").val();
    var rqty=$("#txt_rqty").val();
    var qty=$("#qun").val();
    
   
      if(rqty <= stock)
      {


 /*
         var barcode_list=new Array();
            var product_name_list=new Array();
            var unit_price_list=new Array();
            var quantity_list=new Array();
            var sub_total_list=new Array();
        */

    barcode_list.push($("#txt_barcode").val());
    ///
    
    product_name_list.push($("#txt_product").val());
    ///
    
    unit_price_list.push($("#price").val());
    //alert($("#price").val());
    ///
    quantity_list.push($("#qun").val());
    ///
    rqun_list.push($("#txt_rqty").val());
    ///

    var sub= $("#sub_tot").val() - ( $("#price").val() * $("#txt_rqty").val() );
    sub_total_list.push(sub);

    return_to_cus=return_to_cus - sub;
    $("#return_to_cus").val(return_to_cus);

    console.log(barcode_list);
    console.log(product_name_list);
    console.log(unit_price_list);
    console.log(quantity_list);
    console.log(rqun_list);
    console.log(sub_total_list);

  

     var string = "<tr><td>" + $('#txt_barcode').val() + "</td><td>" + $('#txt_product').val() + "</td><td>" + $('#price').val() + " </td><td> " + $('#txt_qty').val() + "</td><td>" + $('#txt_rqty').val() + "</td><td>" + sub +   "</td><td><a><button id='edit_row' class='btn btn-info btn-sm'>" + $('#txt_barcode').val() + "</button></a></td></tr>" ;
  


  //  console.log(string);  
  
     $.ajax({
        url : "frm_sales_return.php",
        type : "GET",
        datatype: "json",
        success : function(data) {
           $('#Show_Invoice_Detail').append(string); 
         //console.log(string);      
        },
        error : function() {
            console.log('error');
        }
    });

     total=total + sub;
     $("#total").val(total);
     discount=$("#discount").val();
      grand_total=total - discount;
    $("#grand_total").val(grand_total);

    $("#txt_barcode").val('');
    $("#txt_product").val('');
    $("#price").val('');
    $("#txt_qty").val('');
    $("#txt_rqty").val('');
    $("#sub_tot").val('');

    $("#txt_rqty").attr('disabled','disabled');  

    $("#customer_return").val(org_grand_total - grand_total);
    org_total=org_total - sub;
    //alert(org_total);     
    
      }
      //////////////////////////
      else
        alert("You Returned Extra Products!");
    
});
 </script>

  <script type="text/javascript">

    var inv_nn="<?php echo $row_inv_type['Invoice_No']; ?>";
    var inv_ty_id="<?php echo $row_inv_type['Invoice_Type_ID']; ?>";
    var payment_mode_id="<?php echo $fet['Payment_Mode_ID']; ?>";
    var customer_id="<?php echo $row_cus['Customer_ID'] ?>";
    var date="<?php echo $row_inv_type['Date'];?>";
    var sales_new="<?php echo $sales_new; ?>";
    //// total
    //// grand_total
    //// discount


  $('#return').on('click',function(){
    console.log("Return Clicked");
     console.log(inv_nn);
     console.log(inv_ty_id);
     console.log(payment_mode_id);
     console.log(customer_id);
     console.log(date);
     console.log(total);
     console.log(grand_total);
     console.log(discount);

     /////////
    console.log(date);
    $.ajax({
            type: 'POST',
            url: 'sales_master.php',
            data: {inv_nn:inv_nn,
              inv_ty_id:inv_ty_id,
              payment_mode_id:payment_mode_id,
              customer_id:customer_id,
              date:date,
              total:total,
              grand_total:grand_total,
              discount:discount},
            success: function(response){
              console.log(response);
          }
        }); 

 /*
         var barcode_list=new Array();
            var product_name_list=new Array();
            var unit_price_list=new Array();
            var quantity_list=new Array();
            var sub_total_list=new Array();
        */
        
      for(var i=0; i<barcode_list.length; i++)
      {
        //console.log("One");
         $.ajax({
            type: 'POST',
            url: 'update_sales_detail.php',
            data: {barcode_list:barcode_list[i],
              quantity_list:quantity_list[i],
              return_list:rqun_list[i],
              sub_total_list:sub_total_list[i],
            inv_nn:inv_nn,
            sales_new:sales_new},            
            success: function(response){
              //console.log(response);
          }
        }); 
      }

      window.location='frm_sales_return.php';
  });
 </script>
 <script type="text/javascript">
   $("#clear").on("click",function(){
    $("#txt_barcode").val('');
    $("#txt_product").val('');
    $("#price").val('');
    $("#txt_qty").val('');
    $("#txt_rqty").val('');
    $("#sub_tot").val('');
   });
 </script>
<script type="text/javascript">
  $(document).ready(function(){
    var new_id = "<?php echo $inv_no; ?>"
    $("#invoice_no").val(new_id);

    $("#dup_bill").on("click",function(){
    window.location="print_duplicate_bill.php?inv="+inv_nn;
  });

  });
</script>
<?php
        include 'security_layer.php';
?>

        <script type="text/javascript">
          $("#sales_return_text").css("color","red");
        </script>



  </div>
</body>
</html>