<?php require_once('class_lib.php'); ?>

<link rel="stylesheet" href="assets/css/dataTables.min.css">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Service
    <small>Control Service</small>
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
          <h3 class="box-title">Services <small>we offer wide range of services</small></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="users" class="table table-bordered table-hover table-responsive">
            <thead>
            <tr>
              <th>ID</th>
              <th>Service Name</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Edit</th>
            </tr>
            </thead>
            <tbody>
<?php $services = Service::find_all();
while($service = $services->fetch_array(MYSQLI_ASSOC)){ 
            echo '<tr>';
              echo '<td>' . $service['id'] . '</td>';
              echo '<td>' . $service['name'] . '</td>';
              echo '<td>' . $service['created_at'] . '</td>';
              echo '<td>' . $service['updated_at'] . '</td>';
              echo '<td><a role="button" data-toggle="modal" data-target="#editServiceModal" title="Click to edit" data-id="'. $service['id'] .'">Click Here</a></td>';
            echo '</tr>';
  } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="col-md-9 col-md-offset-3">
            <button id="btnAddUser" class="btn btn-primary" onclick="addEmptyService();">Add new Service</button>
          </div>
        </div>
      </div>
      <!-- /.box -->

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Client Info</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="clients" class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
              <th>ID</th>
              <th>Client Name</th>
              <th>Logo</th>
              <th>Active</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Edit</th>
            </tr>
            </thead>
            <tbody>
<?php $clients = Client::find_all();
while($client = $clients->fetch_array(MYSQLI_ASSOC)){ 
            echo '<tr>';
              echo '<td>' . $client['id'] . '</td>';
              echo '<td>' . $client['name'] . '</td>';
              echo '<td>' . $client['logo'] . '</td>';
              echo '<td>';
                if ($client['active'] == '1')
                  echo 'YES';
                else echo 'NO';
              echo '</td>';
              $client['address'] = $client['street'] . ' ' . $client['city'] . ', ' . $client['state'] . ' ' . $client['zip_code'];
              if ($client['street'] == '')
                echo '<td>No Address</td>';
              else echo '<td>' . $client['address'] . '</td>';
              if ($client['phone'] == '')
                echo '<td>No Phone</td>';
              else echo '<td><a href="tel: +1' . $client['phone'] . '">' . $client['phone'] . '</a></td>';
              if ($client['email'] == '')
                echo '<td>No Email</td>';
              else echo '<td>' . $client['email'] . '</td>';
              echo '<td>' . $client['created_at'] . '</td>';
              echo '<td>' . $client['updated_at'] . '</td>';
              echo '<td><a role="button" data-toggle="modal" data-target="#editClientModal" title="Click to edit" data-id="'. $client['id'] .'">Click Here</a></td>';
            echo '</tr>';
  } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div class="col-md-9 col-md-offset-3">
            <button id="btnAddUser" class="btn btn-primary" onclick="addEmptyClient();">Add new Client</button>
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


<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editModalTitle">Edit Service</h4>
      </div>
      <div class="modal-body">
        <div class="fetched-data"></div>
      </div>
    </div>
  </div>
</div>