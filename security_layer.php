<script type="text/javascript">
            var business= " <?php echo $run_2['Business']; ?> ";
          if(business!=1)
            $("#business").css("display","none");

          var customer= " <?php echo $run_2['Customers']; ?> ";
          if(customer!=1)
            $("#customer").css("display","none");

          var vendor= " <?php echo $run_2['Vendors']; ?> ";
          if(vendor!=1)
            $("#vendor").css("display","none");

           var product= " <?php echo $run_2['Products']; ?> ";
          if(product!=1)
            $("#product").css("display","none");

          var product_received= " <?php echo $run_2['Product_Received']; ?> ";
          if(product_received!=1)
            $("#product_received").css("display","none");

          var new_invoice= " <?php echo $run_2['New_Invoice']; ?> ";
          if(new_invoice!=1)
            $("#new_invoice").css("display","none");

          var accounts= " <?php echo $run_2['Accounts']; ?> ";
          if(accounts!=1)
            $("#accounts").css("display","none");

          var sales_return= " <?php echo $run_2['Sales_Return']; ?> ";
          if(sales_return!=1)
            $("#sales_return").css("display","none");

           var exchange_item= " <?php echo $run_2['Exchange_Item']; ?> ";
          if(exchange_item!=1)
            $("#exchange").css("display","none");

          var reports= " <?php echo $run_2['Reports']; ?> ";
          if(reports!=1)
            $("#reports").css("display","none");

          var user_management= " <?php echo $run_2['User_Management']; ?> ";
          if(user_management!=1)
            $("#user_management").css("display","none");
</script>