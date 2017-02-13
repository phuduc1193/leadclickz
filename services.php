<?php require_once('class_lib.php'); ?>
<?php require_once('partials/header.php'); require_once('partials/navbar.php'); require_once('partials/sidebar.php'); ?>

<?php
if (!isset($_SESSION['user']))
  header('Location: ' . $home_url);

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
      <li class="active">Services</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
<?php if (isset($_SESSION['errors'])){
        echo '<div class="clearfix"></div><div class="col-md-10 col-md-offset-2">';
      foreach ($_SESSION['errors'] as $key => $message)
        echo '<p class="text-red pull-left">' . $message . '</p>';
      echo '</div>';
      } # End Errors
      unset($_SESSION['errors']); ?>
<?php if (isset($_SESSION['success'])){
        echo '<div class="clearfix"></div><div class="col-md-10 col-md-offset-2">';
      foreach ($_SESSION['success'] as $key => $message)
        echo '<p class="text-primary pull-left">' . $message . '</p>';
      echo '</div>';
      } # End Errors
      unset($_SESSION['success']); ?>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Client Services</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="services" class="table table-bordered table-striped table-responsive">
              <thead>
              <tr>
                <th class="hidden-xs">Client ID</th>
                <th>Client Name</th>
  <?php $services = Service::find_all();
  while($service = $services->fetch_array(MYSQLI_ASSOC)){
    if (!$service['name'] == '')
      echo '<th>' . $service['name'] . '</th>';
    } ?>
              </tr>
              </thead>
              <tbody>
  <?php $clients = Client::find_all();
  while($client = $clients->fetch_array(MYSQLI_ASSOC)){ 
              echo '<tr>';
                echo '<td class="hidden-xs">' . $client['id'] . '</td>';
                if ($client['name'] == "")
                  $client['name'] = 'Click to Edit';
                echo '<td><a href="editClientServices.php?process=editService&id=' . $client['id'] . '">' . $client['name'] . '</a></td>';
        $services = Service::find_all();
  while($service = $services->fetch_array(MYSQLI_ASSOC)){
    if (!$service['name'] == ''){
      $status = ClientServices::check_service_status($client['id'], $service['id'])->fetch_array(MYSQLI_ASSOC);
      if ($status['status'] == 1)
        echo '<td><i class="fa fa-check" aria-hidden="true"></i></td>';
      else echo '<td></td>';
    }
  }
              echo '</tr>';
    } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <button data-toggle="collapse" data-target="#servicesInfo" class="btn btn-success" style="margin-bottom: 1em;">Manage LeadClickz Services</button>
        <div class="box collapse" id="servicesInfo">
          <div class="box-header">
            <h3 class="box-title">LeadClickz Services</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="services" class="table table-bordered table-striped table-responsive">
              <thead>
              <tr>
                <th class="hidden-xs">ID</th>
                <th>Service Name</th>
                <th>Description</th>
              </tr>
              </thead>
              <tbody>
  <?php $services = Service::find_all();
  while($service = $services->fetch_array(MYSQLI_ASSOC)){ 
              echo '<tr>';
                echo '<td class="hidden-xs">' . $service['id'] . '</td>';
                if ($service['name'] == "")
                  $service['name'] = 'Click to Edit';
                echo '<td><a href="editService.php?process=editService&id=' . $service['id'] . '">' . $service['name'] . '</a></td>';
                echo '<td>' . $service['description'] . '</td>';
              echo '</tr>';
    } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="col-md-9 col-md-offset-3">
              <form action="editService.php" method="GET">
                <input type="hidden" name="process" value="addNewService">
                <button type="submit" class="btn btn-primary">Add new Service</button>
              </form>
            </div>
          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require_once('partials/footer.php');