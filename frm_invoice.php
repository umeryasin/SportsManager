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

if($_SESSION['admin'] == "admin" && $run_2['New_Invoice'] == 1)
    
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

  <title>Invoice</title>
  <style type="text/css">
  .typeahead, .tt-query,{

  }
.tt-hint {
  border: 2px solid #CCCCCC;
  border-radius: 8px;
  font-size: 14px;
  height: 30px;
  line-height: 30px;
  outline: medium none;
  padding: 8px 12px;
  width: 250px;
}
.typeahead {
  background-color: #FFFFFF;
}

}
.tt-query {
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
  color: #999999;
}
.tt-dropdown-menu {
  background-color: #FFFFFF;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  margin-top: 12px;
  padding: 8px 0;
  width: 200px;
}
.tt-suggestion {
  font-size: 14px;
  line-height: 24px;
  padding: 3px 20px;
}
.tt-suggestion.tt-is-under-cursor {
  background-color: #0097CF;
  color: #FFFFFF;
}
.tt-suggestion p {
  margin: 0;
}

@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    .mx-auto{
        width: 100%;
    }
}
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
  <?php include 'navbar.php'; ?>
  <?php include 'nav3.php'; ?>
 
  <!--Nav-End-->
  <br>
  <div style="margin-top: 94px;">
    <div class="container-fluid">

      <!-- Breadcrumbs-->
<div style="margin-top: -20px;" align="center">
<span style="font-size: 22px;"><img src="images/invoice.png" style="width: 50px; height: 50px;"> New Invoice</span> 
</div>
<br>
      <!-- Example DataTables Card-->

            <!-- Example DataTables Card-->
      <div class="mx-auto" style="width: 90%;">
        

          
            <label> Invoice No. : </label>
          <?php 
          $sql_inv="SELECT IFNULL(MAX(Invoice_No),0)+1 AS Invoice_No FROM invoice_master";
          $run_inv=mysqli_query($ob->connect(),$sql_inv);
          $new_inv=mysqli_fetch_array($run_inv);
          $new_inv2=$new_inv['Invoice_No'];
          $inv_num=sprintf('%02d',0);
          $p_inv=$inv_num.$new_inv2; 
          ?>
            &nbsp;&nbsp;
            INV- <input type="text" name="InvoiceNo" placeholder="Invoice No." readonly="readonly" value="<?php echo $p_inv; ?>" id="invoice_id" >
            
            <label style="margin-left: 30px;"> Invoice Type : </label>
            &nbsp;&nbsp;
            <select name="invoicetype" id="invoice_type_id">
               <?php $run_invt=mysqli_query($ob->connect(),"SELECT * FROM invoicetype");
              while($val=mysqli_fetch_array($run_invt))
              {
               ?>
               <option value="<?php echo $val['Invoice_Type_ID'] ?>"><?php echo $val['Invoice_Type_Name'] ?></option>
               <?php
             }
               ?>
            </select>
            
            <label style="margin-left: 50px;"> Payment Mode : </label>
            &nbsp;&nbsp;
            <select name="PaymentMode" id="payment_mode_id" id="payment_mode_id">
              <?php $run_payment=mysqli_query($ob->connect(),"SELECT * FROM paymentmode");
              while($val=mysqli_fetch_array($run_payment))
              {
               ?>
               <option value="<?php echo $val['Payment_Mode_ID'] ?>"><?php echo $val['Payment_Mode'] ?></option>
               <?php
             }
               ?>
        
            </select>

            <label style="margin-left: 50px;"> Date : </label>
            <input type="date" style="width: 150px;" name="Date" value='<?php echo date("Y-m-d"); ?>' id="invoice_date">
            <br><br>
            <label> Customer : </label>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <select name="CustomerName" id="customer_id">
               <?php $run_cus=mysqli_query($ob->connect(),"SELECT * FROM customer");
              while($val=mysqli_fetch_array($run_cus))
              {
               ?>
               <option value="<?php echo $val['Customer_ID'] ?>"><?php echo $val['Customer_Name'] ?></option>
               <?php
             }
               ?>
            </select>
            <button id="add_new_customer">Add New Customer</button>
            <button id="delete_customer">Delete</button>
            <div id="add_new_customer_tab">
              <span>Name: </span>
              <input type="text" id="customer_name_txt">
              <span>Phone# </span>
              <input type="text" id="customer_phone_no_txt">
                  <input type="radio" name="gender" value="1" id="male"><span>Male</span>
                  <input type="radio" name="gender" value="2" id="female"><span>Female</span>
              <input type="submit" value="Save" id="save_customer_data">
              <button id="hide_customer">Hide</button>
            </div>
            <div></div>

            <div style="float: left; margin-right: 10px;">
                <p> Barcode#</p>
                <input type="text" style="width: 150px;" id="mul_val" name="Barcode" placeholder="Barcode Scan" onkeyup="fun1()" autofocus="autofocus">
            </div>

            <div style="float: left; margin-right: 10px;">
                <p> Product Name</p>
                <input type="text" id="product_nme" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Search Product.." style="width: 300px;" onkeyup="fun2()">
            </div>

            <div style="float: left; margin-right: 10px;">
                <p id="Select_Cat"> Qty</p>
                <input type="text" min="0"  style="width: 70px;" name="Quantity" placeholder="Qty" id="input_val">
            </div>

            <div style="float: left; margin-right: 10px;">
                <p> Unit Price</p>
                <input type="text" style="width: 80px;" value="0.00" name="Price" placeholder="0.00" disabled="disabled" id="price">
                <input type="hidden" name="purchase_price" id="purchase_price">
            </div>
             <div style="float: left; margin-right: 10px;">
                <p> Discount</p>
                <input type="text" style="width: 40px;" value="0" name="individual_discount" placeholder="0" disabled="disabled" id="individual_discount"><input type="text" value="%" disabled="disabled" style="width: 20px;">
            </div>
            <div style="float: left; margin-right: 10px;">
                <p> Availble Stock</p>
                <input type="text" name="stock" disabled="disabled" style="width: 80px;" id="qty">
            </div>

            <div style="margin-top: 40px; float: left;">
                <label class="btn btn-success btn-sm" name="save" style="width:80px;" id="add_row"><i class="fa fa-plus-circle fa-large" id="btn"></i> Add</label>
                <label class="btn btn-info btn-sm" name="clear" style="width:80px;" id="clear_row"><i class="fa fa-eraser fa-large" id="btn"></i> Clear</label>
            </div>

            <br>
            <table class="table table-bordered" id="invoice_detail" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Product Code</th>
                  <th> Product Name</th>
                  <th> Unit Price</th>
                  <th> Discount</th>
                  <th> Quantity</th>
                  <th> Sub Total</th>
                  <th> Action</th>
                </tr>
              </thead>
              <tbody id="Show_Invoice_Detail">

              </tbody>
             
            </table>


            <br>
            <hr>
            <!--label> Total : </label>-->
            <input  id="Total" type="text" style="width: 150px;" min="0" name="Sub_Total" placeholder="Total" readonly="readonly">
            <!--Total-End-->
            <div style="float: left;">
              <label> Individual Discount: </label>
              <input id="Discount" type="text" style="width: 150px;" value="0" name="Discount" placeholder="Discount" disabled="disabled">
        	 </div>
        	<br><br>
          <div>
              <label> Manual Discount: </label>
              <input id="Manual_Discount" type="text" style="width: 150px;" value="0" name="Manual_Discount" placeholder="Manual Discount">
           </div>
        	<div style="margin-left: 60%;">
            <label> Grand Total : </label>
            <input id="GrandTotal" type="text" style="width: 150px;" value="0" name="GrandTotal" placeholder="Grand Total" readonly="readonly">
        	</div>


            <div align="center">
              <button class="btn btn-large btn-success" id="pay" ><i class="fa fa-save fa-large"></i> Pay</button>
              </div>
              <br>

          <!---Form-END-->
        
      </div>
      <!-- End Example DataTables Card-->
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
    <div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Search Product</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <center>
              <span><b>Search Item (By Code OR By Name)</b></span>
              <br>
          <input type="search" name="search_product" class="form-control" style="width: 70%;  height: 30px; margin-top: 5px;" id="myInput" onkeyup="myFunction();" autofocus="autofocus">
          </center>
          <br>
          <table class="table table-bordered" id="myTable" >
            <thead>
            <tr>
              <th>Product Code</th>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Unit Price</th>

            </tr>
          </thead>
          <tbody id = "table_body">
          <?php
          $sql="SELECT * FROM product";
          $run=mysqli_query($ob->connect(),$sql);

          while($row=mysqli_fetch_array($run))
          {

          ?>
          
            
            <tr class="container" id="searchable-container" onclick="myFunc()" data-dismiss="modal">
              <td><?php echo $row['Barcode_ID']; ?></td>
              <td><?php echo $row['Product_Name']; ?></td>
              <td><?php echo $row['Quantity']; ?></td>
            </tr>
                    
          <?php

          }
          ?>
          </tbody>
          </table>

          </div>
          <br><br><br><br><br><br>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
    <script src="typeahead.min.js"></script>

    <script>
    $(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 10
            });
        });
    </script>


        <script type="text/javascript">
      function fun1(){
        document.getElementById("input_val").innerHTML=1;

        var id= document.getElementById("mul_val").value;

        $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'id':id},
          success: function(response){
            //console.log(response);
            $("#product_nme").val(response);
            $("#product_nme").html(response);
            /////
            $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'p_name':id},
          success: function(data){
            //console.log(response);
            $("#qty").val(data);
            $("#qty").html(data);
          }
        });
            ////
            $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'retail_price':id},
          success: function(data){
            //console.log(response);
            $("#price").val(data);
            $("#price").html(data);
          }
        });
           ////
            $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'individual_discount':id},
          success: function(data){
            //console.log(response);
            $("#individual_discount").val(data);
            $("#individual_discount").html(data);
          }
        });
           ////
           $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'purchase_price':id},
          success: function(data){
            //console.log(response);
            $("#purchase_price").val(data);
            $("#purchase_price").html(data);
          }
        });
           ////

          }
        });
     
        
         $("#input_val").val("1");
            $("#input_val").html("1");
       }
    </script>



    <script type="text/javascript">
         function fun2()
      {
        var select_bar= document.getElementById("product_nme").value;
        $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'select_bar': select_bar},
          success: function(response){
            ////////////////
            $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'p_name':response},
          success: function(data){
            //console.log(response);
            $("#qty").val(data);
            $("#qty").html(data);
          }
        });
            $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'retail_price':response},
          success: function(data){
            //console.log(response);
            $("#price").val(data);
            $("#price").html(data);
          }
        });
             $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'individual_discount':response},
          success: function(data){
            //console.log(response);
            $("#individual_discount").val(data);
            $("#individual_discount").html(data);
          }
        });
        $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'purchase_price':response},
          success: function(data){
            console.log(response);
            $("#purchase_price").val(data);
            $("#purchase_price").html(data);
          }
        });
           ////

            ////////////////
            $("#mul_val").val(response);
            $("#mul_val").html(response);

          }
        });

         $("#input_val").val("1");
            $("#input_val").html("1");

      }
    </script>



    

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


<script>
function myFunction() {
  var input, filter, table, tr, td, td1, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[0];
    td = tr[i].getElementsByTagName("td")[1];
    if (td || td1) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>



<script type="text/javascript">
  var total=0;
  var Discount=0;
  var Manual_Discount=0;
  Manual_Discount=0;
  var GrandTotal=0;

	////
  var counter=0;
  var code_list=new Array();
  var name_list=new Array();
  var quantity_list=new Array();
  var purchase_price_list=new Array();
  var sale_price_list=new Array();
  var sub_total_list=new Array();
  var pro_discount_list=new Array();
  var sub_discount_list=new Array();
  var invoice_id=$("#invoice_id").val();
  var invoice_type_id=$("#invoice_type_id").val();
  var payment_mode_id=$("#payment_mode_id").val();
  var invoice_date=$("#invoice_date").val();
  var customer_id;

    $(document).ready(function () {
        $("#customer_id").change(function () {
            $("#ddSelectedItemText").val($('option:selected', $(this)).val());
            customer_id=$("#ddSelectedItemText").val();

            /*
            $.ajax({
              type:'POST',
              url:'inv_get_cus.php',
              data:{customer_id:customer_id},
              success: function(response){
                $("#cus_dis").val(response);
                Discount=(response * total) / 100;
                GrandTotal=total - Discount;
                $("#Total").val(total);
                $("#Discount").val(Discount);
                $("#GrandTotal").val(GrandTotal);
              }
            });*/
        });
    });

    $(document).ready(function(){
      $("#payment_mode_id").change(function(){
        payment_mode_id=$(this).val();
      });
    });

    $(document).ready(function(){
      $("#invoice_type_id").change(function(){
        invoice_type_id=$(this).val();
      });
    });

  //var total=$("#Total").val();
  //var discount=$("#Discount").val();
  //var grand_total=$("#GrandTotal").val();
   var productCode = 0;
    var productName = "";
    var unitPrice = 0;
    var Quantity = 0;
    var subTotal = 0;
    var stock=0;
    var newstock = 0;
    var bool=1;
    var pro_ind_discount=0;
    var discounted_price=0;
    var dis_only=0;

</script>

<script type="text/javascript">
  //Focus From Barcode to Input Quanity
  $("#mul_val").on("keyup",function(e){
    if(e.which==13 || e.keyCode==13)
    {
      $("#input_val").focus();
    }
  });
  //Focus From Product Name to Input Quantitty
   $("#product_nme").on("keyup",function(e){
    if(e.which==13 || e.keyCode==13)
    {
      $("#input_val").focus();
    }
  });
</script>
 
 
<input type='hidden' name='ddSelectedItemText' id='ddSelectedItemText' />
<input type="hidden" name="cus_dis" id="cus_dis" value="0">
 <script type="text/javascript">
 
  $('#input_val').on('keyup', function(e) {

    if(e.which==13 || e.keyCode==13)
    {
     stock=$("#qty").val(); 
     productCode = parseFloat($("#mul_val").val());
     productName = $("#product_nme").val();
     unitPrice = parseFloat($("#price").val());
     Quantity = parseFloat($("#input_val").val());
     subTotal = unitPrice * Quantity;
     purchasePrice=parseFloat($("#purchase_price").val());
     pro_ind_discount=parseFloat($("#individual_discount").val());
     dis_only=parseFloat($("#Discount").val());
     dis_only=dis_only + (((unitPrice * pro_ind_discount)/100) * Quantity);
     discounted_price=(unitPrice - ((unitPrice * pro_ind_discount)/100)) * Quantity;

     if(stock>=1)
     {
      stock=stock - Quantity;
      /////////////////////////////////////
      if(stock>=0)
      {

        for(var i=0; i<code_list.length; i++)
        {
          if(code_list[i]==productCode)
            bool=0;
        }

        if(bool==1)
        {
          code_list.push(productCode);
    ///
    
    name_list.push(productName);
    ///
    
    quantity_list.push(Quantity);
    ///

    pro_discount_list.push(pro_ind_discount);
    ///

    sub_discount_list.push(discounted_price);
    ///

    sub_total_list.push(subTotal);
    ///

    sale_price_list.push(unitPrice);
    ///

    purchase_price_list.push(purchasePrice);

    console.log(code_list);
    console.log(name_list);
    console.log(quantity_list);
    console.log(sale_price_list);
    console.log(purchase_price_list);
    console.log(pro_discount_list);
    console.log(sub_discount_list);
    console.log(sub_total_list);
    ///////
    console.log(invoice_id);
    console.log(invoice_type_id);
    console.log(payment_mode_id);
    console.log(invoice_date);
    console.log(customer_id);

    var string = "<tr><td>" + productCode + "</td><td>" + productName + "</td><td>" + unitPrice + "</td><td>" + pro_ind_discount + "%</td><td>" + Quantity + "</td><td>" + discounted_price + "</td><td>   <a><button class='btn btn-info' id='record' value='" +  +"'" + productCode + "'><i class='fa fa-edit'>Edit</i></button></a></td></tr>" ;
  

  //  console.log(string);
     $.ajax({
        url : "frm_invoice.php",
        type : "GET",
        datatype: "json",
        success : function(data) {
           $('#Show_Invoice_Detail').append(string); 
         //console.log(string);      
        },
        error : function() {
            //console.log('error');
        }
    });

      total=total+subTotal;

      $("#Discount").val(dis_only);

      $("#Total").val(total);

       Discount=$("#Discount").val();
       Manual_Discount=parseFloat($("#Manual_Discount").val());
       GrandTotal=total - Discount - Manual_Discount;
      $("#GrandTotal").val(GrandTotal);


      console.log(total);
      console.log(Discount);
      console.log(GrandTotal); 

      //Clear the input fields Start
      $("#mul_val").val('');
      $("#product_nme").val('');
      $("#input_val").val('');
      $("#price").val('');
      $("#individual_discount").val('');
      $("#qty").val('');
      //Clear the input fields End
      $("#mul_val").focus(); //Focus to Barcode Input


      }
        else
        {
          console.log('Item Already Added!');
          $("#mul_val").focus();
        }

       
    

      counter++; 
      bool=1;
      }
      //////////////////////////
      else
        alert("Insufficient Product");

     
     }

     /////////////////////
     else
     {
      alert("Insufficient Product");
     }
    
///////////////////////
    }
    
      
});
 </script>



  <script type="text/javascript">
  	
  	
  $('#add_row').on('click', function(e) {
         stock=$("#qty").val(); 
     productCode = parseFloat($("#mul_val").val());
     productName = $("#product_nme").val();
     unitPrice = parseFloat($("#price").val());
     Quantity = parseFloat($("#input_val").val());
     subTotal = unitPrice * Quantity;
     purchasePrice=parseFloat($("#purchase_price").val());
     pro_ind_discount=parseFloat($("#individual_discount").val());
     dis_only=parseFloat($("#Discount").val());
     dis_only=dis_only + (((unitPrice * pro_ind_discount)/100) * Quantity);
     discounted_price=(unitPrice - ((unitPrice * pro_ind_discount)/100)) * Quantity;

     if(stock>=1)
     {
      stock=stock - Quantity;
      /////////////////////////////////////
      if(stock>=0)
      {

        for(var i=0; i<code_list.length; i++)
        {
          if(code_list[i]==productCode)
            bool=0;
        }

        if(bool==1)
        {
          code_list.push(productCode);
    ///
    
    name_list.push(productName);
    ///
    
    quantity_list.push(Quantity);
    ///

    pro_discount_list.push(pro_ind_discount);
    ///

    sub_discount_list.push(discounted_price);
    ///

    sub_total_list.push(subTotal);
    ///

    sale_price_list.push(unitPrice);
    ///

    purchase_price_list.push(purchasePrice);

    console.log(code_list);
    console.log(name_list);
    console.log(quantity_list);
    console.log(sale_price_list);
    console.log(purchase_price_list);
    console.log(pro_discount_list);
    console.log(sub_discount_list);
    console.log(sub_total_list);
    ///////
    console.log(invoice_id);
    console.log(invoice_type_id);
    console.log(payment_mode_id);
    console.log(invoice_date);
    console.log(customer_id);

    var string = "<tr><td>" + productCode + "</td><td>" + productName + "</td><td>" + unitPrice + "</td><td>" + pro_ind_discount + "%</td><td>" + Quantity + "</td><td>" + discounted_price + "</td><td>   <a><button class='btn btn-info' id='record' value='" + productCode + "'><i class='fa fa-edit'>Edit</i></button></a></td></tr>" ;
  

  //  console.log(string);
     $.ajax({
        url : "frm_invoice.php",
        type : "GET",
        datatype: "json",
        success : function(data) {
           $('#Show_Invoice_Detail').append(string); 
         //console.log(string);      
        },
        error : function() {
            //console.log('error');
        }
    });

      total=total+subTotal;

      $("#Discount").val(dis_only);

      $("#Total").val(total);

       Manual_Discount=parseFloat($("#Manual_Discount").val());
       GrandTotal=total - Discount - Manual_Discount;
      $("#GrandTotal").val(GrandTotal);


      console.log(total);
      console.log(Discount);
      console.log(GrandTotal); 

      //Clear the input fields Start
      $("#mul_val").val('');
      $("#product_nme").val('');
      $("#input_val").val('');
      $("#price").val('');
      $("#individual_discount").val('');
      $("#qty").val('');
      //Clear the input fields End
      $("#mul_val").focus(); //Focus to Barcode Input


      }
        else
        {
          console.log('Item Already Added!');
          $("#mul_val").focus();
        }

       
    

      counter++; 
      bool=1;
      }
      //////////////////////////
      else
        alert("Insufficient Product");

     
     }

     /////////////////////
     else
     {
      alert("Insufficient Product");
     }
    
///////////////////////
});
 </script>



 <script type="text/javascript">
 	$('#pay').on('click',function(){
 		/////////
 		var dt = new Date();
          //var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
          var hours = dt.getHours();
            var minutes =  dt.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0'+minutes : minutes;
            var strTime = hours + ':' + minutes + ' ' + ampm;
 		////////
    Discount=Discount+Manual_Discount;
 		console.log("Pay Clicked");
 		$.ajax({
	          type: 'POST',
	          url: 'print_inv.php',
	          data: {invoice_id:invoice_id,
	      			 invoice_type_id:invoice_type_id,
	      			 payment_mode_id:payment_mode_id,
	      			 invoice_date:invoice_date,
	      			 customer_id:customer_id,
	      			 total: total,
	      			 discount:Discount,
	      			 grand_total: GrandTotal,
               strTime:strTime},
	      		

	          success: function(response){
	            console.log(response);
          }
        });	


 		  for(var i=0; i<code_list.length; i++)
 		  {
 		  	//console.log("One");
 		  	 $.ajax({
	          type: 'POST',
	          url: 'update_invoice_detail.php',
	          data: {code_list:code_list[i],
	      			 name_list:name_list[i],
	      			 quantity_list:quantity_list[i],
	      			 sub_total_list:sub_total_list[i],
	      			 invoice_id:invoice_id,
               purchase_price_list:purchase_price_list[i],
               sale_price_list:sale_price_list[i],
              pro_discount_list:pro_discount_list[i]},

	          success: function(response){
	            console.log(response);
          }
        });	
 		  }
      var inf = 'inv=' + invoice_id;
      var delay = 500; 
      setTimeout(function(){ window.location = 'print_bill.php?'+inf; }, delay);
 		  

 	});
 </script>

 <script type="text/javascript">

$(document).on("click", "#record", function() {

   var key=$(this).val();
      var save=-1;
      //console.log(key);
      for(var i=0; i<code_list.length; i++)
      {
        
        if(code_list[i] == key)
        {
          //console.log("IN If Statement");
          save=i;
          break;
        }
      }
      ////////
      //console.log(save);
      if(save>=0)
      {
        $("#mul_val").val(code_list[save]);

        ///////////////////////

        var id= document.getElementById("mul_val").value;

        $("#product_nme").val(name_list[save]);
       
        $.ajax({
          type: 'POST',
          url: 'update_bar_inv.php',
          data: {'p_name': id},
          success: function(response){
            //console.log(response);
            $("#qty").val(response);
            $("#qty").html(response);
          }
        });

        $("#price").val(sale_price_list[save]);
      
        $("#individual_discount").val(pro_discount_list[save]);
         
        $("#purchase_price").val(purchase_price_list[save]);
          
        


         $("#input_val").val(quantity_list[save]);
            $("#input_val").html(quantity_list[save]);
        //////////////////////

        total=total - sub_total_list[save];
        //dis_only=$("#Discount").val();
        dis_only=parseFloat($("#Discount").val());
        console.log(dis_only);
        dis_only=dis_only - ((sub_total_list[save] * pro_discount_list[save])/100);
        console.log("Target");
        console.log(sub_total_list[save]);
        console.log(pro_discount_list[save]);
        console.log(quantity_list[save]);
        $("#Discount").val(dis_only);
        //$("#Discount").val(($('#cus_dis').val() * total)/100);
      code_list.splice(save,1);
      name_list.splice(save,1);
      quantity_list.splice(save,1);
      purchase_price_list.splice(save,1);
      sale_price_list.splice(save,1);
      sub_total_list.splice(save,1);
      pro_discount_list.splice(save,1);
      sub_discount_list.splice(save,1); 
      
      
      console.log(code_list);
      console.log(name_list);
      console.log(quantity_list);
      console.log(purchase_price_list);
      console.log(sale_price_list);
      console.log(sub_total_list);
      console.log(pro_discount_list);
      console.log(sub_discount_list);

       $("#Total").val(total);

       Discount=$("#Discount").val();
       GrandTotal=total-Discount;
      $("#GrandTotal").val(GrandTotal);
      }

      $(this).parents('tr').remove();
      $("#input_val").focus();
 });

 </script>
 <script type="text/javascript">
   $("#clear_row").on("click",function(){
    $("#mul_val").val('');
    $("#input_val").val('');
    $("#product_nme").val('');
    $("#price").val('');
    $("#qty").val('');
    $("#individual_discount").val('');
    $("#mul_val").focus();
   });

 </script>

 <script>
/*function open_in_new_tab_and_reload(url)
{
  var inf = 'inv=' + invoice_id;
  //Open in new tab
  window.open('printbill.php?'+inf, '_blank');
  //focus to thet window
  window.focus();
  //reload current page
  location.reload();
}*/
</script>


        <script type="text/javascript">
          $("#new_invoice_text").css("color","red");
        </script>

        <script type="text/javascript">
          var customer_name_save='';
          var customer_phone_save='';
          var customer_gender=0;
        </script>

        <script type="text/javascript">
          $("#add_new_customer_tab").hide();
          $("#delete_customer").attr("disabled",true);
          /////////////
          $("#add_new_customer").on("click",function(){
            //console.log("Customer Clicked");
            $("#add_new_customer_tab").show();
            customer_name_save=$("#customer_name_txt").val();
            if(customer_name_save =='')
            {
              $("#save_customer_data").attr("disabled",true);
            }
          });

          $("#customer_name_txt").on("keyup",function(){
            //////
            customer_name_save=$("#customer_name_txt").val();
            if(customer_name_save=='')
            {
              $("#save_customer_data").attr("disabled",true);
            }
            else
            {
              $("#save_customer_data").attr("disabled",false);
            }
          });

        </script>
        <script type="text/javascript">
          $("#save_customer_data").on("click",function(){
            customer_phone_save=$("#customer_phone_no_txt").val();
            //console.log(customer_name_save);
            //console.log(customer_phone_save);
                if (document.getElementById('male').checked) {
                        customer_gender = document.getElementById('male').value;
                        }
                if (document.getElementById('female').checked) {
                        customer_gender = document.getElementById('female').value;
                        }
                //console.log(customer_gender);
                $.ajax({
                  type:'POST',
                  url:'inv_save_customer.php',
                  data:{customer_name_save:customer_name_save,
                        customer_phone_save:customer_phone_save,
                        customer_gender:customer_gender},
                  success: function(response){
                    //console.log(response);
                    $("#customer_name_txt").attr("disabled",true);
                    $("#customer_phone_no_txt").attr("disabled",true);
                    $("#male").attr("disabled",true);
                    $("#female").attr("disabled",true);
                    $("#save_customer_data").attr("disabled",true);
                    customer_id=response;
                    //console.log(customer_new_id);
                    $("#delete_customer").attr("disabled",false);
                    $("#add_new_customer").attr("disabled",true);
                    $("#hide_customer").attr("disabled",true);
                    $("#customer_id").attr("disabled",true);


                  }
                });            
              });
        </script>
        <script type="text/javascript">
          $("#hide_customer").on("click",function(){
            $("#add_new_customer_tab").hide();
          });
        </script>

        <script type="text/javascript">
           $("#delete_customer").on("click",function(){
            //console.log("Customer Clicked");
            $.ajax({
              type:'POST',
              url:'inv_del_customer.php',
              data:{customer_id:customer_id},
              success: function(response){
                console.log(response);
                    $("#customer_name_txt").attr("disabled",false);
                    $("#customer_phone_no_txt").attr("disabled",false);
                    $("#male").attr("disabled",false);
                    $("#female").attr("disabled",false);

                    $("#delete_customer").attr("disabled",true);
                    $("#add_new_customer").attr("disabled",false);
                    $("#hide_customer").attr("disabled",false);
                    $("#customer_id").attr("disabled",false);
                    $("#add_new_customer_tab").hide();
                    customer_id=0;
              }
            });
           
          });
        </script>

        <!---Manual-Discount--Script-->
        <script type="text/javascript">
          $("#Manual_Discount").on("keyup",function(){
            Discount=parseFloat($("#Discount").val());
            Manual_Discount=parseFloat($("#Manual_Discount").val());
            total=parseFloat($("#Total").val());
            console.log("Start")
            console.log(Discount);
            console.log(Manual_Discount);
            console.log(total);
            /*Manual Discount*/
            GrandTotal=total - Discount - Manual_Discount;
            console.log(GrandTotal);
            $("#GrandTotal").val(GrandTotal);
          });
        </script>
        <?php
        include 'security_layer.php';
        ?>
     
   </div>
</body>

</html>

