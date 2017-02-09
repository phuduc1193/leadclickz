<?php require_once('class_lib.php');?>

<?php require_once('partials/header.php');?>

<?php require_once('partials/navbar.php');?>

<?php
    if (isset($_SESSION['user'])) {
      require_once('partials/sidebar.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $home_url; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
<?php if($_SESSION['user']['is_admin'] == 1) { #Admin View ?>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>10</h3>

          <h4>Clients</h4>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="clients.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>10<sup style="font-size: 20px"> active</sup></h3>

          <h4>Projects</h4>
        </div>
        <div class="icon">
          <i class="fa fa-tasks"></i>
        </div>
        <a href="projects.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>3<sup style="font-size: 20px"> unread</sup></h3>

          <h4>Message</h4>
        </div>
        <div class="icon">
          <i class="fa fa-commenting-o"></i>
        </div>
        <a href="messages.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<?php
} else { #Client View ?>
<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>Projects</h3>

          <h4>2 in progress</h4>
        </div>
        <div class="icon">
          <i class="fa fa-tasks"></i>
        </div>
        <a href="projects.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>Report</h3>

          <h4>report date</h4>
        </div>
        <div class="icon">
          <i class="fa fa-bar-chart"></i>
        </div>
        <a href="reports.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 col-xs-12">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3>Message</h3>

          <h4>3 unread</h4>
        </div>
        <div class="icon">
          <i class="fa fa-commenting-o"></i>
        </div>
        <a href="messages.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<?php } ?>
</div>
<!-- /.content-wrapper -->
<?php require_once('partials/footer.php'); //LoggedIn Users only
  } else { ?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <!-- Login Form -->
      <div class="box box-primary login-wrapper">
        <div class="box-header with-border text-center">
          <h3 class="box-title">Login</h3>
            <?php if (isset($_SESSION['errors'])){
              echo '<div class="clearfix"></div><div class="col-md-10 col-md-offset-2">';
            foreach ($_SESSION['errors'] as $err_key => $err_message)
              echo '<p class="text-red pull-left">' . $err_message . '</p>';
            echo '</div>';
            } # End Errors
            unset($_SESSION['errors']); ?>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form id="login" class="form-horizontal" method="GET" action="functions/login.php">
          <div class="box-body">
            <div class="form-group">
              <label for="username" class="col-sm-2 control-label">Username</label>
  
              <div class="col-sm-10">
                <input type="text" class="form-control" id="username" placeholder="Username" name="username">
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-2 control-label">Password</label>
  
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-primary pull-right">Sign in</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
<?php }?>
