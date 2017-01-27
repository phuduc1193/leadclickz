<?php
  require_once('class_lib.php');
  global $db;
  if($_POST['process'] == 'setClient'){
    if($_POST['user_id']) {
        $user_id = mysqli_real_escape_string($db, $_POST['user_id']); //escape string
        $user = User::find_by_id($user_id)->fetch_array(MYSQLI_ASSOC);?>

<!-- form start -->
<form role="form" id="editUserForm" method="POST" action="editUser.php" class="form-horizontal">
  <div class="box-body">
    <div class="form-group">
      <label for="id" class="col-sm-2 control-label">ID</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="id" value="<?php echo $user['id']; ?>" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="username" class="col-sm-2 control-label">Username</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $user['username']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="password" class="col-sm-2 control-label">Password</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="password" placeholder="Password" value="<?php echo $user['password']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label for="is_admin" class="col-sm-2 control-label">Admin</label>
      <div class="col-md-10">
        <select name="is_admin" class="form-control">
<?php if ($user['is_admin']==1){?>
          <option value=1>YES</option>
          <option value=0>No</option>
<?php } else {?>
          <option value=0>No</option>
          <option value=1>Yes</option>
<?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="client" class="col-sm-2 control-label">Client</label>
      <div class="col-md-10">
        <select name="client" class="form-control">
<?php $clients = Client::find_all();
      while($client = $clients->fetch_array(MYSQLI_ASSOC)){ 
        echo '<option value= "' . $client['id'] . '">' . $client['name'] . '</option>';
      } ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="created_at" class="col-sm-2 control-label">Created At</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="created_at" placeholder="<?php echo $user['created_at']; ?>" disabled>
      </div>
    </div>
    <div class="form-group">
      <label for="updated_at" class="col-sm-2 control-label">Updated At</label>
      <div class="col-md-10">
        <input type="text" class="form-control" id="updated_at" placeholder="<?php echo $user['updated_at']; ?>" disabled>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</form>

<?php }
  }
?>