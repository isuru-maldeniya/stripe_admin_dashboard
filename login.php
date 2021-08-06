<?php require_once("codeblocks/session.php"); ?>
<?php require_once('database/connection.php'); ?>
<?php require_once("codeblocks/functions.php"); ?>
<?php
  $usr_email = $usr_password = $error_data = "";
  if ($_SERVER['REQUEST_METHOD']=='POST'){
    if (!empty($_POST['usr_email'])){
      if (!empty($_POST['usr_password'])){
        $usr_password = base64_encode($_POST['usr_password']);
        // $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION,MYSQL_PORT);
        $conn=getConnection();
				if (!$conn){
					header('Location: offline.php');
					die();
				}
        $usr_email = mysqli_real_escape_string($conn, $_POST['usr_email']);
        $sql = "SELECT * FROM tblusers WHERE usr_email='$usr_email'";
        $result = mysqli_query($conn, $sql);
				mysqli_close($conn);
				if ($result){
					if (mysqli_num_rows($result) > 0) {
						$row = mysqli_fetch_assoc($result);
						if($usr_password == $row['usr_password']){
							// DB connection
							// $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
              $conn=getConnection();
							// Load data
              $_SESSION['iuni_usid'] = sysencode($row['usr_id']);
              $_SESSION['iuni_usnm'] = sysencode($row['usr_name']);
              $_SESSION['inui_type'] = $row['usr_type'];
							//Update login
							date_default_timezone_set('Asia/Colombo');
							$date = date('Y-m-d h:i:s A');
							$ip = $_SERVER['REMOTE_ADDR'];
							$sql = "UPDATE tblusers SET user_last_login='$date', user_last_ip='$ip' WHERE user_email='$usr_email'";
              mysqli_query($conn, $sql);
              // Load active year
              $sql = "SELECT * FROM tblyears WHERE yer_active=1";
              $result = mysqli_query($conn, $sql);
              if ($result){
                if(mysqli_num_rows($result) > 0){
                  $row = mysqli_fetch_assoc($result);
                  $_SESSION['iuni_year'] = $row['yer_id'];
                  $_SESSION['iuni_ylbl'] = $row['yer_year'];
                }else{
                  $_SESSION['iuni_year'] = $_SESSION['iuni_ylbl'] = '';
                }
              }else{
                $_SESSION['iuni_year'] = $_SESSION['iuni_ylbl'] = '';
              }
							mysqli_close($conn);
							header('Location: dashboard.php');
						}else{
							$error_data = 'Invalid Username or Password';
						}
					}else{
						$error_data = 'Invalid Username or Password';
					}
				}else{
					$error_data = 'Invalid Username or Password';
				}
      }else{
        $error_data = "Please enter password";
      }
    }else{
      $error_data = "Please enter your email";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("codeblocks/meta.php"); ?>

  <title>Login</title>
  <?php require_once("codeblocks/css.php"); ?>

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Email Address</label>
            <input class="form-control" name="usr_email" type="email" aria-describedby="emailHelp" placeholder="Enter Email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="usr_password" type="password" placeholder="Password">
          </div>
          <input type="submit" class="btn btn-primary btn-block" value="Login"/>
        </form>
        <div class="text-center">

        </div>
      </div>
    </div>
  </div>
  <?php require_once("codeblocks/javascript.php"); ?>
</body>

</html>
