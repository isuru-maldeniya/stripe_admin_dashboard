<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php">Xplomate : Admin Panel</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-tachometer-alt"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Universities">
          <a class="nav-link" href="universities.php">
            <i class="fa fa-fw fa-university"></i>
            <span class="nav-link-text">SAMPLE PAGE</span>
          </a>
        </li>
        <?php
          if($_SESSION['inui_type'] == 1){
            echo '
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
              <a class="nav-link" href="users.php">
                <i class="fa fa-fw fa-newspaper"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
            ';
          }
        ?>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="myprofile.php"><i class="fa fa-fw fa-user"></i>My Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fa fa-fw fa-sign-out-alt"></i>Logout</a></li>
      </ul>
    </div>
  </nav>