<?php include 'header.php'; ?>
<html>
<head>
<title>
Inventory System
</title>
<?php
	require_once('auth.php');
?>
 <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">


<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<!--sa poip up-->
<script src="jeffartagame.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>

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

 <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
//<!-- Begin
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}
function showtime () {
var now = new Date();
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds()
var timeValue = "" + ((hours >12) ? hours -12 :hours)
if (timeValue == "0") timeValue = 12;
timeValue += ((minutes < 10) ? ":0" : ":") + minutes
timeValue += ((seconds < 10) ? ":0" : ":") + seconds
timeValue += (hours >= 12) ? " P.M." : " A.M."
document.clock.face.value = timeValue;
timerID = setTimeout("showtime()",1000);
timerRunning = true;
}
function startclock() {
stopclock();
showtime();
}
window.onload=startclock;
// End -->
</SCRIPT>	


</head>

<body>
<?php include('navfixed.php');?>
<div class="container-fluid">
      <div class="row-fluid">
	
	<div class="contentheader">
			<i class="icon-copy" style="color: green;"></i> <span style="font-size: 20px;">Receipt & Payment Voucher</span>
			</div>
			<ul class="breadcrumb">
			<li><a href="index.php">Dashboard</a></li> /
			<li class="active">Receipt & Payment Voucher</li>
			</ul>

<div style="">
<a  href="index.php"><button class="btn btn-info btn-large" style="float: left;"><i class="icon icon-circle-arrow-left icon-large"></i> Back</button></a>
<a  href="rp_list.php"><button class="btn btn-info btn-large" style="float: right;"><i class="icon icon-copy icon-large"></i> Vouchers List</button></a>
<a  href="coa.php"><button class="btn btn-info btn-large" style="float: right; margin-right: 20px;"><i class="icon icon-bar-chart icon-large"></i> Chart Of Accounts</button></a>
</div>

<div class="span10" style="">
	<center><h3><img width="90px;" height="90px;" src="images/monogram.png"> Research And Solution </h3><br>
	<center><h3><i class="icon-copy icon-large" style="color: green;"></i> Receipt & Payment Voucher</h3></center>
  <hr>
  <form action="save_rp.php" method="post">
  <label><b style="float: left;">Transaction Date</b><b style="float: left; margin-left: 210px;">Transaction Number</b><b style="float: left ;margin-left: 180px;">Is Adjustment</b>
  	<b style="margin-right: 140px;">Memo</b></label>
<input type="date" name="trans_date" class="" value="" style="height:35px; color:#222; width:250px; float: left;" />

<input type="text" name="trans_no" value="" placeholder="Transaction Number" style="height:35px; color:#222; width:250px; float: left; margin-left: 60px;" />
<input type="checkbox" style="margin-left: 140px; float: left;" value="Yes" name="adj">
<input type="text" name="memo" value="" placeholder="Memo" style="height:35px; color:#222; width:250px; float: left; margin-left: 250px;" />
<br>

<table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th > ACCOUNT </th>
			<th > DEBITS </th>
			<th > CREDITS </th>
			<th > DESCRIPTION </th>

		</tr>
	</thead>
	<tbody>
		
			
			<tr class="record">
			<td><select name="accnt"  style="width:265px; height:30px; margin-left:-5px;" >
<option>Select Option</option>
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM category");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option><?php echo $row['name']; ?></option>
	<?php
	}
	?>
</select></td>
			<td><input type="number" name="debit" id="txt1" onkeyup="sum();" style="width: 180px; height: 35px;"></td>
			<td><input type="number" name="credit" style="width: 180px; height: 35px;"></td>
			<td><input type="text" name="descrp" style="width: 650px; height: 35px;"></td>
			
			</tr>
			<tr class="record">
			<td><select name="accnts"  style="width:265px; height:30px; margin-left:-5px;" >
<option>Select Option</option>
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM category");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option><?php echo $row['name']; ?></option>
	<?php
	}
	?>
</select></td>
			<td><input type="number" name="debits" style="width: 180px; height: 35px;"></td>
			<td><input type="number" name="credits" id="txt2" onkeyup="sum();" style="width: 180px; height: 35px;"></td>
			<td><input type="text" name="descrption" style="width: 650px; height: 35px;"></td>
			
			</tr>
			
		
		
		
			<tr>
				<th><strong style="font-size: 20px; color: #222222;">SUM:</strong></th>
				<th></th>
				<th></th>
				<th></th>
				
			</tr>
				
			<tr>
				<th colspan="1"><strong style="font-size: 20px; color: #222222;">Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <input type="number" name="total" id="txt3" readonly style="width: 150px; height: 35px;"></td></strong></th>
				<th colspan="3"><strong style="font-size: 13px; color: #222222;">
				
				</strong></th>
				
			</tr>
		
		
		
		
		
	</tbody>
</table><br>

			<button class="btn btn-info btn-large" style="margin-left: 400px;"><i class="icon icon-save icon-large"></i> Save</button>
</form>
</div>
<div class="clearfix"></div>

</div>
</div>
<script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delebutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Are you sure want to delete?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_exp.php",
   data: info,
   success: function(){
   window.location = 'exp.php';
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
</body>
<?php include('footer.php');?>

</html>