<?php
include 'connect.php';
include 'conn.php';
$ob=new conn;
  //Start session
  session_start();
  $current_date=date("Y-m-d");
  //echo $current_date;
  $sql_dt="SELECT * FROM `due_date` WHERE '$current_date' BETWEEN Issue_Date AND Exp_Date";
  $run_dt=mysqli_query($ob->connect(),$sql_dt);
  $row_dt=mysqli_fetch_assoc($run_dt);

  if($row_dt['Due_Date_ID']!=1)
  {
    session_start();
    session_destroy();
    header("location: timeout.php");
  }
  else
  {
  
  //Unset the variables stored in session
?>

<!DOCTYPE >
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>POS</title>
  <!-- Bootstrap core CSS-->
  <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="csss/sb-admin.css" rel="stylesheet">
  <style type="text/css">
      body {
        padding-top: 90px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
</head>

<body class="bg-dark" id="login" class="login" style="background: url(images/index.jpg) no-repeat center center fixed;
  -webkit-background-size: cover !important; 
  -moz-background-size: cover !important; 
  -o-background-size: cover !important; 
  background-size: cover !important;">
  <div class="container">
    
    <div align="center"><img style="width:250px; border-radius: 50%;" src="images/sports_logo.png"></div>
    <div class="card card-login mx-auto mt-5">
      <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
  foreach($_SESSION['ERRMSG_ARR'] as $msg) {
    echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
  }
  unset($_SESSION['ERRMSG_ARR']);
}
?>
      <div class="card-header"><i class="fa fa-lock fa-lg"></i> <span style="font-size:18px;"> Please Login</span></div>
      <div class="card-body">

        <form action="login.php" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input class="form-control" id="exampleInputEmail1" type="text" name="username"" aria-describedby="emailHelp" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" type="password" name="password" placeholder="Password">
          </div>
         
          <div class="qwe">
     <button class="btn btn-large btn-primary btn-block pull-right" href="dashboard.html" type="submit"><i class="icon-signin icon-large"></i> Login</button>
</div>
        </form>
      
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendors/jquery/jquery.min.js"></script>
  <script src="vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendors/jquery-easing/jquery.easing.min.js"></script>
  <script type="text/javascript">
    $("#exampleInputEmail1").focus();
  </script>
</body>

</html>

<?php
}
?>
