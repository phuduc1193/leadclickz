<?php
  require_once('class_lib.php');
  require_once('partials/header.php');
  require_once('partials/navbar.php');
?>
<?php if($_SESSION['user']['is_admin'] == 1){
  require_once('partials/sidebar.php');
  # Get client info
  if (isset($_GET['id']))
    $user = User::find_by_id($_GET['id'])->fetch_array(MYSQL_ASSOC);
?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      User Login
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $home_url; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo $home_url . "clients.php"; ?>">User Login</a></li>
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
            <i class="fa fa-users"></i><h3 class="box-title"><?php if ($_GET['process']=='addNewUser') echo 'New'; else echo 'Edit';?> User Login</h3>
          </div>
          <!-- form start -->
          <form role="form" id="editClientForm" class="form-horizontal" action="functions/userHandler.php" method="POST">
            <div class="box-body">
              <div class="form-group">
                <label for="client_id" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_id" name="id" value="<?php echo $user['id']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="client_name" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_name" name="username" value="<?php echo $user['username']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="is_admin" class="col-sm-2 control-label">Admin Status</label>
                <div class="col-sm-2">
                  <select id="active" name="is_admin" class="form-control">
                    <?php
                          if($_GET['process'] == "addNewUser") $user['is_admin'] = 0; # Active new record
                          if ($user['is_admin']==1){ ?>
                              <option value=1>YES</option>
                              <option value=0>No</option>
                    <?php } else { ?>
                              <option value=0>No</option>
                              <option value=1>Yes</option>
                    <?php } ?>
                  </select>
                </div>
                <label for="client" class="col-sm-2 control-label">Client</label>
                <div class="col-sm-6">
                  <select id="client" name="client" class="form-control">
                    <?php
                      if($_GET['process'] == "addNewUser") $user['client'] = 0; # Active new record
                      if($user['client'] == 0) echo '<option selected hidden>No Client</option>';

                      $clients = Client::find_all();
                      while($client = $clients->fetch_array(MYSQLI_ASSOC)){ 
                        echo '<option value= "' . $client['id'] . '">' . $client['name'] . '</option>';
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="client_created_at" class="col-sm-2 control-label">Created At</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_created_at" placeholder="<?php echo $user['created_at']; ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="client_updated_at" class="col-sm-2 control-label">Updated At</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="client_updated_at" placeholder="<?php echo $user['updated_at']; ?>" disabled>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
              <a class="btn btn-default btn-md" href="<?php echo $home_url . "clients.php?process=viewLoginInfo"; ?>">Back</a>
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
var_dump($_SESSION);
echo '<br><br>';
var_dump($_GET);
?>