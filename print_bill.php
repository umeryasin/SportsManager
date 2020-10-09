<?php
include 'conn.php';
$ob=new conn;

$inv=$_GET['inv'];

$sql_b="SELECT * FROM business_info";
$run_b=mysqli_query($ob->connect(),$sql_b);
$row_b=mysqli_fetch_array($run_b);
?>

<?php
$sql_im="SELECT *, date_format(Date,'%d/%m/%Y') as Date FROM invoice_master WHERE Invoice_No='$inv'";
$run_im=mysqli_query($ob->connect(),$sql_im);
$row_im=mysqli_fetch_array($run_im);

$customer_id=$row_im['Customer_ID'];
$sel_customer_sql="SELECT * FROM customer WHERE Customer_ID=$customer_id";
$sel_customer_run=mysqli_query($ob->connect(),$sel_customer_sql);
$sel_customer_row=mysqli_fetch_array($sel_customer_run);
?>



<!DOCTYPE html>
<html>
<head>
	<title><?php echo $row_b['Business_Name']; ?> Print Invoice #:<?php echo $inv; ?></title>
		<style type="text/css">
			td,th{
				font-size: 15px;
			}
			@font-face {
font-family: "Petrona-Regular";
src: url("css/Font/Petrona-Regular.ttf");
}
body{
	font-family: monospace;
}
			
		</style>
</head>
<body id="body">

	<div align="center" style="border: 1px solid; width: 302px; margin: -5px auto;" id="main_wrapper">
	
					<h1 style="margin-top: 0px;"><?php echo $row_b['Business_Name']; ?></h1>
					<p style="line-height: 0px; font-size: 15px;">Phone# <?php echo $row_b['Contact_No']; ?></p>
					<p style="line-height: 0px; font-size: 15px; margin-bottom: -10px;"><?php echo $row_b['Address']; ?></p>
					<h3 style="border-top: 3px solid; border-bottom: 1px solid; background-color: black; color: white;">Sales Invoice</h3>
						
					<p style="line-height: 0px; font-size: 15px; margin-top: -7px;">Inv.# : <?php echo $inv;?></p>
				
					<span style="font-size: 15px; position: relative; right: 12px;">Date : <?php echo $row_im['Date'];?></span>

					<span style="font-size: 15px; position: relative; left: 13px;">Time : <?php echo $row_im['Time'];?></span>

					<div style="margin-top: -15px;">
						<h3 style="border-top: 1px solid; border-bottom: 1px solid; background-color: black; color: white;">Customer Information</h3>
						<p style="font-size: 15px; margin-top: -15px;"><b>Name: </b> <span><?php echo $sel_customer_row['Customer_Name']; ?></span></p>
						<p style="font-size: 15px; margin-top: -15px;"><b>Phone #: </b><span><?php echo $sel_customer_row['Contact_No']; ?></span></p>
					</div>

			<table style="border-collapse: collapse; width: 100%; margin-top: -14px;">
			<tr style="border-top: 1px solid; border-bottom: 1px solid;">
				<th style="border-right: 1px solid;"> Sr.</th>
				<th align="left" style="border-right: 1px solid;">Product</th>
				<th style="border-right: 1px solid;"> Rate</th>
				<th style="border-right: 1px solid;"> Dis</th>
				<th style="border-right: 1px solid;"> Qty</th>
				<th> Amt</th>
			</tr>
			<?php
			$sql_id="SELECT * FROM product_master,invoicedetails WHERE product_master.Barcode_ID=invoicedetails.Barcode_ID AND Invoice_No='$inv'";
				$run_id=mysqli_query($ob->connect(),$sql_id);
			$i=1;
			while($row_id=mysqli_fetch_array($run_id))
			{

				$dis_ind_total=$row_id['Detail_Total'] - ((($row_id['Sale_Price'] * $row_id['Invoice_Individual_Discount'])/100) * $row_id['Quantity']);

			?>
			<tr style="text-align:center;">
				<td style="border-right: 1px solid; border-top: 1px solid;"><?php echo $i; ?></td>
				<td align="left" style="border-right: 1px solid; border-top: 1px solid;"><?php echo $row_id['Product_Name']; ?></td>
				<td style="border-right: 1px solid; border-top: 1px solid;"><?php echo $row_id['Sale_Price']; ?></td>
				<td style="border-right: 1px solid; border-top: 1px solid;"><?php echo $row_id['Invoice_Individual_Discount']; ?>%</td>
				<td style="border-right: 1px solid; border-top: 1px solid;"><?php echo $row_id['Quantity']; ?></td>
				<td align="right" style="border-top: 1px solid;"><?php echo $dis_ind_total; ?></td>
			</tr>

			<?php
			$i++;
			}
			?>
			
			
			
			<tr>
				<td  style="border-top: 2px solid; border-bottom: 2px solid;" colspan=5><b>Grand Total : </b></td><td style="border-top: 2px solid;  border-bottom: 2px solid;" colspan=1 align="right"><b><?php echo $row_im['GrandTotal'];?> PKR</b></td>
			</tr>

			<tr>
				<td colspan=5 style="border-bottom: 2px solid;"><b>Discount : </b></td><td colspan=1 align="right" style="border-bottom: 2px solid;"><?php echo $row_im['Discount']; ?> PKR</td>
			</tr>

		</table>
		<div>
			<p style="font-size: 15px; margin-top: 1px;">Thank you For Shopping Here. We are very pleased to serve you and look forward to provide you an excellent service. Our values include Loyality | Trust | Integrity</p>
			<p style="font-size: 15px; margin-bottom: 1px; margin-top: -7px;"><b>Please bring Sales Invoice for any Refund and Exchange. Claimed within 1 week.</b></p>
		</div>
			<div style="border-top: 1px solid;">
				<p style="font-size: 13px; margin-top: 1px;"><b>Sports Manager</b></p>
				<p style="font-size: 10px; margin-top: -16px; margin-bottom: 0px;">Designed & Developed by UTS Experts</p>
				<p style="font-size: 10px; margin-top: -2px; margin-bottom: 0px;">Contact# 03070751826</p>
			</div>
		</div>
		<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
		<script type="text/javascript">
			$("#body").on("click",function(){
				window.location="frm_invoice.php";
			});
		</script>

		<script type="text/javascript">
			$(document).ready(function(){
				window.print();
			});
		</script>

</body>
</html>