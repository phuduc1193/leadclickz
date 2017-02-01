<?php
  require_once('class_lib.php');
  global $db;
  if($_POST['process'] == 'editUser'){
    if($_POST['user_id']) {
      $user_id = mysqli_real_escape_string($db, $_POST['user_id']); //escape string
      $user = User::find_by_id($user_id)->fetch_array(MYSQLI_ASSOC);
?>

            <!----------------->
            <!--- EDIT USER --->
            <!----------------->

<!-- form start -->
<form role="form" id="editUserForm" class="form-horizontal" onsubmit="return editUser();">
  <div class="box-body">
    <div class="form-group">
      <label for="user_id" class="col-sm-2 control-label">ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="user_id" value="<?php echo $user['id']; ?>" disabled>
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="username" class="col-sm-2 control-label">Username</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $user['username']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-sm-2 control-label">Password</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $user['password']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="is_admin" class="col-sm-2 control-label">Admin</label>
      <div class="col-sm-10">
        <select name="is_admin" class="form-control">
<?php if ($user['is_admin']==1){ ?>
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
      <label for="client" class="col-sm-2 control-label">Client</label>
      <div class="col-sm-10">
        <select name="client" class="form-control">
<?php $clients = Client::find_all();
      while($client = $clients->fetch_array(MYSQLI_ASSOC)){ 
        echo '<option value= "' . $client['id'] . '">' . $client['name'] . '</option>';
      } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="user_created_at" class="col-sm-2 control-label">Created At</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="user_created_at" placeholder="<?php echo $user['created_at']; ?>" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="user_updated_at" class="col-sm-2 control-label">Updated At</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="user_updated_at" placeholder="<?php echo $user['updated_at']; ?>" disabled>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
  </div>
  <!-- /.box-footer -->
</form>
<?php }
  }




if($_POST['process'] == 'editClient'){
    if($_POST['client_id']) {
      $client_id = mysqli_real_escape_string($db, $_POST['client_id']); //escape string
      $client = Client::find_by_id($client_id)->fetch_array(MYSQLI_ASSOC);
?>

            <!----------------->
            <!-- EDIT CLIENT -->
            <!----------------->

<!-- form start -->
<form role="form" id="editClientForm" class="form-horizontal" onsubmit="return editClient();">
  <div class="box-body">
    <div class="form-group">
      <label for="client_id" class="col-sm-2 control-label">ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="client_id" value="<?php echo $client['id']; ?>" disabled>
        <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="client_name" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="client_name" name="name" placeholder="Name" value="<?php echo $client['name']; ?>">
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
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?php echo $client['phone']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="email" class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $client['email']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="active" class="col-sm-2 control-label">Active</label>
      <div class="col-sm-10">
        <select id="active" name="active" class="form-control">
<?php if ($client['active']==1){ ?>
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
        <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="<?php echo $client['street']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="city" class="col-sm-2 control-label">City</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $client['city']; ?>">
      </div>
      <label for="state" class="col-sm-2 control-label">State</label>
      <div class="col-sm-2">
        <select id="state" name="state" class="form-control">
          <?php $this_state = State::find_by_id($client['state'])->fetch_array(MYSQLI_ASSOC); ?>
          <option value="<?php echo $this_state['id']; ?>"><?php echo $this_state['name'] . " (" . $this_state['us_ansi'] . ")"; ?></option>
          <?php $states =  State::find_all_except($client['state']);
          while($state = $states->fetch_array(MYSQLI_ASSOC)){ 
        echo '<option value= "' . $state['id'] . '">' . $state['name'] . ' (' . $state['us_ansi'] . ')</option>';
      } ?>
        </select>
      </div><label for="zip_code" class="col-sm-2 control-label">Zipcode</label>
      <div class="col-sm-2">
        <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Zipcode" value="<?php echo $client['zip_code']; ?>">
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
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
  </div>
  <!-- /.box-footer -->
</form>
<?php }
  }
  
  

  if($_POST['process'] == 'editService'){
    if($_POST['service_id']) {
      $service_id = mysqli_real_escape_string($db, $_POST['service_id']); //escape string
      $service = Service::find_by_id($service_id)->fetch_array(MYSQLI_ASSOC);
?>

            <!------------------>
            <!-- EDIT SERVICE -->
            <!------------------>

<!-- form start -->
<form role="form" id="editServiceForm" class="form-horizontal" onsubmit="return editService();">
  <div class="box-body">
    <div class="form-group">
      <label for="service_id" class="col-sm-2 control-label">ID</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="service_id" value="<?php echo $service['id']; ?>" disabled>
        <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="service_name" class="col-sm-2 control-label">Service Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Service" value="<?php echo $service['name']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="service_created_at" class="col-sm-2 control-label">Created At</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="service_created_at" placeholder="<?php echo $service['created_at']; ?>" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="service_updated_at" class="col-sm-2 control-label">Updated At</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="service_updated_at" placeholder="<?php echo $service['updated_at']; ?>" disabled>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer text-right">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
  </div>
  <!-- /.box-footer -->
</form>
<?php }
  }

?>