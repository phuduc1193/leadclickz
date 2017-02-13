<?php
  require_once('class_lib.php');
  require_once('partials/header.php');
  require_once('partials/navbar.php');
?>
<?php if($_SESSION['user']['is_admin'] == 1){
  require_once('partials/sidebar.php');
  # Get client info
  if (isset($_GET['id']))
    $client = Client::find_by_id($_GET['id'])->fetch_array(MYSQL_ASSOC);
?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Client Services
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $home_url; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo $home_url . "clients.php"; ?>">Services</a></li>
      <li class="active">Edit Services</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-gears"></i><h3 class="box-title">Edit Service for <?php echo $client['name']; ?></h3>
          </div>
          <!-- form start -->
          <form role="form" id="editClientForm" class="form-horizontal" action="functions/clientHandler.php" method="POST">
            <input type="hidden" name="process" value="addClientServices">
            <div class="box-body">
              <div class="form-group">
                <label for="client_id" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_id" name="id" value="<?php echo $client['id']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="client_name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_name" name="name" value="<?php echo $client['name']; ?>" readonly>
                </div>
              </div>
                <label for="client_name" class="col-sm-2 control-label">Services</label>
                <div class="col-sm-10">
                  <?php $services = Service::find_all();
                  $clientServicesResults = ClientServices::find_all()->fetch_all();

                  while($service = $services->fetch_array(MYSQLI_ASSOC)){
                    if (!$service['name'] == ''){
                      $status = ClientServices::check_service_status($client['id'], $service['id'])->fetch_array(MYSQLI_ASSOC);
                      if (!$service['name'] == '')
                        echo '<label class="checkbox-inline"><input type="checkbox" name="services[]" value="' . $service['id'] . '" ';
                        if ($status['status'] == 1) echo 'checked ';
                        echo '>' . $service['name'] . '</label>';
                    }
                  } ?>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
              <a class="btn btn-default btn-md" href="<?php if($_GET['process'] == 'editServiceFromClients') echo $home_url . "clients.php"; else echo $home_url . "services.php"; ?>">Back</a>
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