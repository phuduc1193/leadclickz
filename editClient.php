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
      Clients
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $home_url; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo $home_url . "clients.php"; ?>">Clients</a></li>
      <li class="active">
        <?php if ($_GET['process']=='addNewClient') echo 'New'; else echo 'Edit';?>
      </li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-users"></i><h3 class="box-title"><?php if ($_GET['process']=='addNewClient') echo 'New'; else echo 'Edit';?> Client</h3>
          </div>
          <!-- form start -->
          <form role="form" id="editClientForm" class="form-horizontal" action="functions/clientHandler.php" method="POST">
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
                  <input type="text" class="form-control" id="client_name" name="name" value="<?php echo $client['name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="logo" class="col-sm-2 control-label">Logo</label>
                <div class="col-sm-10">
                  <?php echo $client['logo']; ?>
                  <span class="btn btn-default btn-file">
                    Upload new Logo <input type="file" id="fileToUpload" disabled>
                    <input type="hidden" name="logo" value="<?php echo $client['logo']; ?>">
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $client['phone']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="email" value="<?php echo $client['email']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="active" class="col-sm-2 control-label">Active</label>
                <div class="col-sm-10">
                  <select id="active" name="active" class="form-control">
                    <?php
                          if($_GET['process'] == "addNewClient") $client['active'] = 1; # Active new record
                          if ($client['active']==1){ ?>
                              <option value=1>YES</option>
                              <option value=0>No</option>
                    <?php } else { ?>
                              <option value=0>No</option>
                              <option value=1>Yes</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="street" class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="street" name="street" value="<?php echo $client['street']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="city" name="city" value="<?php echo $client['city']; ?>">
                </div>
                <label for="state" class="col-sm-1 control-label">State</label>
                <div class="col-sm-3">
                  <select id="state" name="state" class="form-control">
                    <?php 
                      if($_GET['process'] == "addNewClient") $client['state'] = 43; #Place TX for new record

                      $this_state = State::find_by_id($client['state'])->fetch_array(MYSQLI_ASSOC);
                    ?>
                    <option value="<?php echo $this_state['id']; ?>"><?php echo $this_state['name']; ?></option>
                    <?php
                      $states =  State::find_all_except($client['state']);
                      while($state = $states->fetch_array(MYSQLI_ASSOC)){ 
                        echo '<option value= "' . $state['id'] . '">' . $state['name'] . '</option>';
                      }
                    ?>
                  </select>
                </div><label for="zip_code" class="col-sm-1 control-label">Zipcode</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php echo $client['zip_code']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Services</label>
                <div class="col-sm-10">
                  <?php if($_GET['process'] == 'addNewClient'){
                    $services = Service::find_all();
                    while($service = $services->fetch_array(MYSQLI_ASSOC)){
                      if (!$service['name'] == '')
                        echo '<label class="checkbox-inline"><input type="checkbox" name="services[]" value="' . $service['id'] . '">' . $service['name'] . '</label>';
                    }
                  } else {
                    $services = Service::find_all();
                    $clientServicesResults = ClientServices::find_all()->fetch_all();
    
                    while($service = $services->fetch_array(MYSQLI_ASSOC)){
                      if (!$service['name'] == ''){
                        $status = ClientServices::check_service_status($client['id'], $service['id'])->fetch_array(MYSQLI_ASSOC);
                        if (!$service['name'] == '')
                          echo '<label class="checkbox-inline"><input type="checkbox" name="services[]" value="' . $service['id'] . '" ';
                          if ($status['status'] == 1) echo 'checked ';
                          echo '>' . $service['name'] . '</label>';
                      }
                    }
                  }
                  ?>
                </div>
              </div>
              <div class="form-group">
                <label for="client_created_at" class="col-sm-2 control-label">Created At</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_created_at" placeholder="<?php echo $client['created_at']; ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="client_updated_at" class="col-sm-2 control-label">Updated At</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_updated_at" placeholder="<?php echo $client['updated_at']; ?>" disabled>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
              <a class="btn btn-default btn-md" href="<?php echo $home_url . "clients.php?process=viewClients"; ?>">Back</a>
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