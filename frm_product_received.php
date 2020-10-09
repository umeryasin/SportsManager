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

if($_SESSION['admin'] == "admin" && $run_2['Product_Received'] == 1)
    
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

  <title>Product Received</title>
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
<span style="font-size: 22px;"><img src="images/Receivable-money.png" style="width: 50px; height: 50px;"> Product Received</span> 
</div>
<br>
      <!-- Example DataTables Card-->

            <!-- Example DataTables Card-->
      <div class="mx-auto" style="width: 90%;">
        <div class="row">
          <div>
            <span>Select Vendor:</span>
            <select style="width: 150px;" id="select_vendor">
              <?php
              $sq_ven="SELECT * FROM vendor";
              $run_ven=mysqli_query($ob->connect(),$sq_ven);
              while($row_ven=mysqli_fetch_assoc($run_ven))
              {
              ?>
                <option value="<?php echo $row_ven['Vendor_ID'] ?>"><?php echo $row_ven['Vendor_Name'] ; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <p> Barcode#</p>
                <input type="text" style="width: 150px;" id="product_barcode_id" name="Barcode" placeholder="Barcode Scan" autofocus="autofocus">
            </div>

            <div class="col-md-2">
                <p> Product Name</p>
                <input type="text" id="product_name_id" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Search Product.." style="width: 300px;">
            </div>

            <div class="col-md-2" style="margin-left: 10%;">
                <p id="Select_Cat"> Qty</p>
                <input type="text" min="0"  style="width: 70px;" name="Quantity" placeholder="Qty" id="input_val">
            </div>

            <div class="col-md-2">
                <p> Purchase Price</p>
                <input type="text" style="width: 80px;" value="0.00" name="Price" placeholder="0.00" disabled="disabled" id="price">
                <input type="hidden" name="purchase_price" id="purchase_price">
            </div>

            <div class="col-md-2" style="margin-top: 40px;">
                <label class="btn btn-success btn-sm" name="save" style="width:80px;" id="add_row"><i class="fa fa-plus-circle fa-large" id="btn"></i> Add</label>
                <label class="btn btn-info btn-sm" name="clear" style="width:80px;" id="clear_row"><i class="fa fa-eraser fa-large" id="btn"></i> Clear</label>
            </div>
        </div>

            <br>
            <table class="table table-bordered" id="invoice_detail" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th> Product Code</th>
                  <th> Product Name</th>
                  <th> Purchase Price</th>
                  <th> Quantity</th>
                  <th> Action</th>
                
                </tr>
              </thead>
              <tbody id="Show_Invoice_Detail">

              </tbody>
             
            </table>


            <br>
            <hr>

            <div align="center">
              <button class="btn btn-large btn-success" id="add_to_stock" ><i class="fa fa-plus-circle fa-large"></i> Add to Stock</button>
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
     <script src="typeahead.min.js"></script> <!---Live Search Lib-->
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
      var vendor_id=1;
      $(document).ready(function(){
        $("#select_vendor").change(function(){
          vendor_id=$("#select_vendor").val();
          //alert(vendor_id);
        });
      });
    </script>

    <script type="text/javascript">
      var barcode_no;
      var pro_name_no;
      var pro_price_no;
    </script>

    <script type="text/javascript">
      $("#product_barcode_id").on("keyup",function(){
        var barcode_id=$("#product_barcode_id").val();
        barcode_no=barcode_id;
        ////
           $.ajax({
          type: 'POST',
          url: 'product_received_search.php',
          data: {'pro_name':barcode_id},
          success: function(data){
            $("#product_name_id").val(data);
            pro_name_no=data;
               ////

           $.ajax({
          type: 'POST',
          url: 'product_received_search.php',
          data: {'purchase_price':barcode_id},
          success: function(data1){
            $("#price").val(data1);
            pro_price_no=data1;
          }
        });
        ////

          }
        });
     
      });

      //////////////////
      $("#product_name_id").on("keyup",function(){
        var product_name=$("#product_name_id").val();
        pro_name_no=product_name;
        //////////
        $.ajax({
          type: 'POST',
          url: 'product_received_search.php',
          data: {'pro_id':product_name},
          success: function(data){
             $("#product_barcode_id").val(data);
             barcode_no=data;
            ///////

             $.ajax({
          type: 'POST',
          url: 'product_received_search.php',
          data: {'purchase_price':data},
          success: function(data1){
            $("#price").val(data1);
            pro_price_no=data1;
          }
        });
            /////////
          }
        });
        ////
        /////////
      });
    </script>
    <script type="text/javascript">
      $("#product_barcode_id").keyup(function(event) {
        if(event.which==13 || event.keyCode==13)
          $("#input_val").focus();
      });
      $("#product_name_id").keyup(function(event) {
        if(event.which==13 || event.keyCode==13)
          $("#input_val").focus();
      });
    </script>

    <script type="text/javascript">
    var stock=0;
    var code_list=new Array();
    var name_list=new Array();
    var pro_price_list=new Array();
    var quantity_list=new Array();
    var bool=1;
    </script>

    <script type="text/javascript">
      $('#input_val').on('keyup', function(e) {
        if(e.which==13 || e.keyCode==13)
        {

          //Start
          stock=$("#input_val").val();
          if(stock>0)
          {
            for(var i=0; i<code_list.length; i++)
        {
          if(code_list[i]==barcode_no)
            bool=0;
        }

        if(bool==1)
        {
          ////
               code_list.push(barcode_no);
            name_list.push(pro_name_no);
            pro_price_list.push(parseFloat(pro_price_no));
            quantity_list.push(parseFloat(stock));

            console.log(code_list);
            console.log(name_list);
            console.log(pro_price_list);
            console.log(quantity_list);

            var string="<tr><td>" + barcode_no + "</td><td>" + pro_name_no + "</td><td>" + pro_price_no + "</td><td>" + stock + "</td><td><button class='btn btn-info' id='record' value='" + barcode_no + "'><i class='fa fa-edit'>Edit</i></button></td></tr>";
            //  console.log(string);
     $.ajax({
        url : "frm_product_received.php",
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
     $("#product_barcode_id").focus();

      $("#product_barcode_id").val("");
      $("#product_name_id").val("");
      $("#input_val").val("");
      $("#price").val("");
          ////
           /*Check List Start*/
      if(code_list.length==0)
      {
        $("#add_to_stock").attr("disabled",true);
      }
      else
      {
        $("#add_to_stock").attr("disabled",false);
      }
      /*Check List End*/
        }
        else
        {
          alert("already Added");
          $("#product_barcode_id").focus();
          bool=1;
        }
          }
          //End


        }
      });
    </script>

    <script type="text/javascript">
      $("#add_row").on("click",function(){
         //Start
          stock=$("#input_val").val();
          if(stock>0)
          {
            for(var i=0; i<code_list.length; i++)
        {
          if(code_list[i]==barcode_no)
            bool=0;
        }

        if(bool==1)
        {
          ////
               code_list.push(barcode_no);
            name_list.push(pro_name_no);
            pro_price_list.push(parseFloat(pro_price_no));
            quantity_list.push(parseFloat(stock));

            console.log(code_list);
            console.log(name_list);
            console.log(pro_price_list);
            console.log(quantity_list);

            var string="<tr><td>" + barcode_no + "</td><td>" + pro_name_no + "</td><td>" + pro_price_no + "</td><td>" + stock + "</td><td><button class='btn btn-info' id='record' value='" + barcode_no + "'><i class='fa fa-edit'>Edit</i></button></td></tr>";
            //  console.log(string);
     $.ajax({
        url : "frm_product_received.php",
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
     $("#product_barcode_id").focus();

      $("#product_barcode_id").val("");
      $("#product_name_id").val("");
      $("#input_val").val("");
      $("#price").val("");
          ////
           /*Check List Start*/
      if(code_list.length==0)
      {
        $("#add_to_stock").attr("disabled",true);
      }
      else
      {
        $("#add_to_stock").attr("disabled",false);
      }
      /*Check List End*/
        }
        else
        {
          alert("already Added");
          $("#product_barcode_id").focus();
          bool=1;
        }
          }
          //End
      })
    </script>

    <script type="text/javascript">
      $(document).on("click", "#record", function() {
        //Start
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
        //alert("Got It");
        $("#product_barcode_id").val(code_list[save]);
        $("#product_name_id").val(name_list[save]);
        $("#input_val").val(quantity_list[save]);
        $("#price").val(pro_price_list[save]);

        code_list.splice(save,1);
        name_list.splice(save,1);
        quantity_list.splice(save,1);
        pro_price_list.splice(save,1);

        console.log(code_list);
        console.log(name_list);
        console.log(quantity_list);
        console.log(pro_price_list);

        ////////
        $(this).parents('tr').remove();
        $("#input_val").focus();
         /*Check List Start*/
      if(code_list.length==0)
      {
        $("#add_to_stock").attr("disabled",true);
      }
      else
      {
        $("#add_to_stock").attr("disabled",false);
      }
      /*Check List End*/
      }
        //End
      });
    </script>

    <script type="text/javascript">
      $("#clear_row").on("click",function(){
        $("#product_barcode_id").val('');
        $("#product_name_id").val('');
        $("#input_val").val('');
        $("#price").val('');

        $("#product_barcode_id").focus();
      });
    </script>

    <script type="text/javascript">
      /*Check List Start*/
      if(code_list.length==0)
      {
        $("#add_to_stock").attr("disabled",true);
      }
      else
      {
        $("#add_to_stock").attr("disabled",false);
      }
      /*Check List End*/
    </script>

    <script type="text/javascript">
      /*Add Stock in DB Start*/
      $("#add_to_stock").on("click",function(){
        //Add Customer Info
        //alert("Added");
        for(var i=0; i<code_list.length; i++)
        {
          $.ajax({
            type:'POST',
            url:'save_pro_receive.php',
            data:{vendor_id:vendor_id,
                  code_list:code_list[i],
                  name_list:name_list[i],
                  pro_price_list:pro_price_list[i],
                  quantity_list:quantity_list[i]},
            success: function(response){
              console.log(response);
            }
          });
        }

      var delay = 500; 
      setTimeout(function(){ location.reload(); }, delay);

      })
      /*Add Stock in DB End*/ 
    </script>

    <?php
        include 'security_layer.php';
    ?>

    <script type="text/javascript">
          $("#product_received_text").css("color","red");
    </script>