<!DOCTYPE html>
<html>
<head>
<?php require_once ('auth.php');?>
<title>
POS
</title>
 <link href="css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
  
  <link rel="stylesheet" href="css/font-awesome.min.css">
    <style type="text/css">
    
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=800, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 800px; font-size: 13px; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>





 <script language="javascript" type="text/javascript">
/* Visit http://www.yaldex.com/ for full source code
and get more free JavaScript, CSS and DHTML scripts! */
<!-- Begin
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
<body>

<?php include('navfixed.php');?>
	
	<div class="container-fluid">
      <div class="row-fluid">
	
		
	<div class="span10">
	<a href="rp_list.php"><button class="btn btn-default"><i class="icon-arrow-left"></i> Back</button></a>

<div class="content" id="content">
<div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
	<div style="width: 100%; height: 190px;" >
	<div>
	<center><div style="font:bold 28px 'Aleo'; margin-left: 200px;"><img width="70px;" height="70px;" src="images/monogram.png"> Research And Solution</div><br>
		<center><div style="font:bold 25px 'Aleo'; margin-left: 200px;">Receipt And Payment Voucher</div>
	
	</center>
	
	</div>
	
	</div><br><br>
	<?php
				include('../connect.php');
					$id=$_GET['id'];
					$result = $db->prepare("SELECT * FROM voucher WHERE voucher_id= :userid");
					$result->bindParam(':userid', $id);
					$result->execute();
					for($i=0; $row = $result->fetch(); $i++){
				?>
	<div style="width: 1200px; margin-top:-70px;">
		
Date :
<input type="text" value="<?php echo $row['trans_date']; ?>" style="height:25px; color:#222; width:150px;" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Transaction No. :
<input type="text" value="<?php echo $row['trans_no']; ?>" placeholder="" style="height:25px; color:#222; width:180px;" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Is Adjustment :
<input type="text" value="<?php echo $row['adj']; ?>" placeholder="" style="height:25px; color:#222; width:80px;" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Memo :
<input type="text" value="<?php echo $row['memo']; ?>" placeholder="" style="height:25px; color:#222; width:180px;" >
<br><br>
<?php
					}
				?>
	<table border="1" cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12px;	text-align:left;" width="100%">
		<thead>
			<tr>
			<th style="font-size: 14px;" width="20%"> ACCOUNT </th>
			<th style="font-size: 14px;"> DEBITS </th>
			<th style="font-size: 14px;"> CREDITS </th>
			<th style="font-size: 14px;"> DESCRIPTION </th>

		</tr>
		</thead>
		<tbody>
			
				<?php
				include('../connect.php');
					$id=$_GET['id'];
					$result = $db->prepare("SELECT * FROM voucher WHERE voucher_id= :userid");
					$result->bindParam(':userid', $id);
					$result->execute();
					for($i=0; $row = $result->fetch(); $i++){
						
				?>
				<tr class="record" style="text-align: center;">
				<td style="font-size: 17px;"><?php echo $row['accnt']; ?></td>
				<td style="font-size: 17px;"><?php echo $row['debit']; ?></td>
				<td style="font-size: 17px;"><?php echo $row['credit']; ?></td>
				<td style="font-size: 17px;"><?php echo $row['descrp']; ?></td>
				</tr>
				<tr class="record" style="text-align: center;">
				<td style="font-size: 17px;"><?php echo $row['accnts']; ?></td>
				<td style="font-size: 17px;"><?php echo $row['debits']; ?></td>
				<td style="font-size: 17px;"><?php echo $row['credits']; ?></td>
				<td style="font-size: 17px;"><?php echo $row['descrption']; ?></td>
				</tr>
				
			
				<tr>
				<th><b style="font-size: 14px; color: #222222;">SUM:</b></th>
				<th align="center"><b style="font-size: 14px; color: #222222;"><?php echo $row['debit']; ?></b></th>
				<th align="center"><b style="font-size: 14px; color: #222222;"><?php echo $row['credits']; ?></b></th>
				<th></th>
				
			</tr>
				
			<tr>
				<th colspan="1"><b style="font-size: 14px; color: #222222;">Total:
					<span style="float: right;"><?php echo $row['total']; ?></span>
				 </td></b></th>
				<th colspan="3"><b style="font-size: 13px; color: #222222;">
				
				</b></th>
				
			</tr>
			<?php
					}
				?>

		</tbody>
	</table>
	<br><br><br>
				<b>Inwards :</b> _________________________________________________________________________________________________________________________
	<br><br><br>

	<b>Prepared By :</b><b style="margin-left: 250px;">Checked By :</b><b style="margin-left: 250px;">Verified By :</b>

	</div>
	</div>
	</div>
	</div>
<div class="pull-right" style="margin-right:100px;">
		<a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success btn-large"><i class="icon-print"></i> Print</button></a>
		</div>	
</div>
</div>


