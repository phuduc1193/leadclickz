<?php require_once('header.php');?>

<?php require_once('navbar.php');?>

<?php
    if (isset($_SESSION['user'])) {
      require_once('sidebar.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  </div>
  <!-- /.content-wrapper -->

<?php require_once('footer.php');
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
        <form id="login" class="form-horizontal" method="GET" action="login.php">
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
<?php } ?>
