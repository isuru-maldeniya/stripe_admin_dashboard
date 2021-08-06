<?php require_once("codeblocks/session.php"); ?>
<?php require_once('database/connection.php'); ?>
<?php require_once("codeblocks/login.php"); ?>
<?php require_once("codeblocks/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("codeblocks/meta.php"); ?>

  <title>Dashboard</title>
  <?php require_once("codeblocks/css.php"); ?>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <?php require_once("codeblocks/navigation.php"); ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
      </ol>
      <div class="row">
        <div class="col-12">
          <h1>Welcome</h1>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-12">
          <div class="card mb-12">
            <div class="card-body">
              <p>Please use navigation menu to access functions in the Dashboard.</p>
            </div>
          </div>
        </div>
      </div>
      <br>
    </div>

    <?php require_once("codeblocks/footer.php"); ?>

    <?php require_once("codeblocks/javascript.php"); ?>
  </div>
</body>

</html>
