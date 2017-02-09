<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo $home_url;?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>L</b>C</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Lead</b>Clickz</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
<?php if (isset($_SESSION['user'])) { ?>
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="assets/img/default-logo.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo strtoupper($_SESSION['user']['username']); ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="assets/img/default-logo.jpg" class="img-circle" alt="User Image">

              <p>
                <?php echo strtoupper($_SESSION['user']['username']); ?>
                <small>Member since <?php echo date('M. Y', strtotime($_SESSION['user']['created_at'])); ?></small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Friends</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="functions/logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
      <?php } #endif for login?>
  </nav>
</header>