<?php
  require_once('class_lib.php');
  require_once('partials/header.php');
  require_once('partials/navbar.php');
?>
<?php if($_SESSION['user']['is_admin'] == 1){
  require_once('partials/sidebar.php');
  # Get client info
  if (isset($_GET['id']))
    $service = Service::find_by_id($_GET['id'])->fetch_array(MYSQL_ASSOC);
?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Services
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $home_url; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo $home_url . "services.php"; ?>">Services</a></li>
      <li class="active">
        <?php if ($_GET['process']=='addNewService') echo 'New'; else echo 'Edit';?>
      </li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-users"></i><h3 class="box-title"><?php if ($_GET['process']=='addNewService') echo 'New'; else echo 'Edit';?> Service</h3>
          </div>
          <!-- form start -->
          <form role="form" id="editServiceForm" class="form-horizontal" action="functions/serviceHandler.php" method="POST">
            <div class="box-body">
              <div class="form-group">
                <label for="client_id" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_id" name="id" value="<?php echo $service['id']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="client_name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_name" name="name" value="<?php echo $service['name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="5" id="description" name="description"><?php echo $service['description']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="client_created_at" class="col-sm-2 control-label">Created At</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_created_at" placeholder="<?php echo $service['created_at']; ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="client_updated_at" class="col-sm-2 control-label">Updated At</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_updated_at" placeholder="<?php echo $service['updated_at']; ?>" disabled>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
              <a class="btn btn-default btn-md" href="<?php echo $home_url . "services.php?process=viewServices"; ?>">Back</a>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
<?php require_once('partials/footer.php');
} else { #Not admin
  header('Location: ' . $home_url);
}
?>