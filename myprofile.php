<?php require_once("codeblocks/session.php"); ?>
<?php require_once("database/connection.php"); ?>
<?php require_once("codeblocks/login.php"); ?>
<?php require_once("codeblocks/functions.php"); ?>
<?php
  $usr_email = $usr_name = $error_data = "";
  $usr_id = sysdecode($_SESSION['iuni_usid']);
  $conn = mysqli_connect(MYSQL_SERVER, MYSQL_ADMIN, MYSQL_TOCKEN, MYSQL_LOCATION);
	$sql = "SELECT * FROM tblusers WHERE usr_id='$usr_id'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$usr_name = $row['usr_name'];
  $usr_email = $usr_old_email = $row['usr_email'];
  mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("codeblocks/meta.php"); ?>

  <title>My Profile</title>
  <?php require_once("codeblocks/css.php"); ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php require_once("codeblocks/navigation.php"); ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        <li class="breadcrumb-item active">My Profile</li>
      </ol>
      <div class="row">
        <div class="col-12">
          <h1>Update Details</h1>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12">
          <div class="card mb-12">
            <div class="card-header">Your Details</div>
            <div class="card-body">
              <form class="form-horizontal" id="formDetails" method="POST">
                <div class="form-group row">
                  <label class="control-label col-sm-2">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="usr_email" class="form-control" value="<?php echo $usr_email; ?>" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="usr_name" class="form-control" value="<?php echo $usr_name; ?>" required>
                    <input type="text" name="usr_id" class="form-control" value="<?php echo $usr_id; ?>" hidden>
                    <input type="text" name="usr_old_email" class="form-control" value="<?php echo $usr_old_email; ?>" hidden>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-12 float-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12">
          <div class="card mb-12">
            <div class="card-header">Change Password</div>
            <div class="card-body">
              <form class="form-horizontal" id="formChangePassword" method="POST">
                <div class="form-group row">
                  <label class="control-label col-sm-2">Current Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="usr_old_password" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">New Password</label>
                  <div class="col-sm-10">
                  <input type="password" name="usr_password" class="form-control" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-2">Confirm Password</label>
                  <div class="col-sm-10">
                  <input type="password" name="usr_cpassword" class="form-control" required>
                    <input type="text" name="usr_id" class="form-control" value="<?php echo $usr_id; ?>" hidden>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-12 float-right">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once("codeblocks/footer.php"); ?>

    <?php require_once("codeblocks/javascript.php"); ?>

    <script type="text/javascript">
      $('#formDetails').submit(function(event) {
				var formData = $(this).serialize();
				$.ajax({
					type        : 'POST',
					url         : 'serverscripts/users/updateprofile.php', 
					data        : formData,
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
					showToast(data.status, data.msg);
				}).fail(function(data) {
					console.error(data);
				});
        event.preventDefault();
      });
      $('#formChangePassword').submit(function(event) {
				var formData = $(this).serialize();
				$.ajax({
					type        : 'POST',
					url         : 'serverscripts/users/changepassword.php', 
					data        : formData,
					dataType    : 'json', 
					encode      : true
				}).done(function(data) {
					showToast(data.status, data.msg);
				}).fail(function(data) {
					console.error(data);
				});
        event.preventDefault();
        $('#formChangePassword').each(function(){
					this.reset();
				});
			});
    </script>
  </div>
</body>

</html>
