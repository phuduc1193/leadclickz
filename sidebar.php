<?php
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
  if ($_SERVER[REQUEST_URI] == '/sidebar.php'){
    header('Location: ' . $home_url);
  }
?>

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
        <a href="dashboard" onClick="event.preventDefault(); renderDashboard();">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
<?php if ($_SESSION['user']['is_admin'] == true) {?>
      <li>
        <a href="users" onClick="event.preventDefault(); renderUsers();">
          <i class="fa fa-users"></i>
          <span>Users</span>
        </a>
      </li>
<?php } ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-gears"></i>
          <span>Services</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="accounts" onClick="event.preventDefault(); renderProjects();"><i class="fa fa-circle-o"></i> List of Projects</a></li>
          <li><a href="services" onClick="event.preventDefault(); renderServices();"><i class="fa fa-circle-o"></i> List of Services</a></li>
          <li><a href="accounts" onClick="event.preventDefault(); renderAccounts();"><i class="fa fa-circle-o"></i> Account Managements</a></li>
        </ul>
      </li>
      <li>
        <a href="pages/mailbox/mailbox.html">
          <i class="fa fa-envelope"></i> <span>Mailbox</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-yellow">12</small>
            <small class="label pull-right bg-green">16</small>
            <small class="label pull-right bg-red">5</small>
          </span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>