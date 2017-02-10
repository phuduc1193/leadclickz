<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="assets/img/default-logo.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo strtoupper($_SESSION['user']['username']); ?></p>
      </div>
    </div>

    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview">
        <a href="index.php">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
<?php if ($_SESSION['user']['is_admin'] == true) {?>
      <li>
        <a href="clients.php">
          <i class="fa fa-users"></i>
          <span>Clients</span>
        </a>
      </li>
<?php } ?>
      <li>
        <a href="projects.php">
          <i class="fa fa-suitcase"></i>
          <span>Projects</span>
        </a>
      </li>
      <li>
        <a href="accounts.php">
          <i class="fa fa-database"></i>
          <span>Username and Password</span>
        </a>
      </li>
<?php if ($_SESSION['user']['is_admin'] == true) {?>
      <li>
        <a href="services.php">
          <i class="fa fa-cogs"></i>
          <span>Services</span>
        </a>
      </li>
<?php } ?>
      <li>
        <a href="mailbox.php">
          <i class="fa fa-envelope"></i> <span>Mailbox</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-yellow">12</small>
          </span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>