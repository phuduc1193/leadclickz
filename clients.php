<?php require_once('class_lib.php'); ?>
<?php require_once('partials/header.php'); require_once('partials/navbar.php'); require_once('partials/sidebar.php'); ?>

<?php
if (!isset($_SESSION['user']))
  header('Location: ' . $home_url);

$clients = Client::find_all();
$clientCount = $clients->num_rows;
$users = User::find_all();
$userCount = $users->num_rows;
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
      <li class="active">Clients</li>
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
            <h3 class="box-title"><?php if($_GET['process'] == 'viewClients') echo 'Client Info'; elseif($_GET['process'] == 'viewLoginInfo') echo 'Login Info <small>for LeadClickz management site</small>'; ?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?php if($_GET['process'] == 'viewClients') { ?>
            <table id="clients" class="table table-bordered table-striped table-responsive">
              <thead>
              <tr>
                <th class="hidden-xs">ID</th>
                <th>Client Name</th>
                <th>Logo</th>
                <th>Services</th>
                <th class="hidden-xs">Active</th>
                <th>Email</th>
                <th>Phone</th>
                <th class="hidden-xs">Address</th>
              </tr>
              </thead>
              <tbody>
  <?php 
  while($client = $clients->fetch_array(MYSQLI_ASSOC)){ 
              echo '<tr>';
                echo '<td class="hidden-xs">' . $client['id'] . '</td>';
                if ($client['name'] == "")
                  $client['name'] = 'N/A';
                echo '<td><a href="editClient.php?process=editClient&id=' . $client['id'] . '">' . $client['name'] . '</a></td>';
                echo '<td>' . $client['logo'] . '</td>';
                $listOfServices = '';
                $servicesList = ClientServices::find_active_by_client ($client['id']);
                while($serviceInList = $servicesList->fetch_array(MYSQL_ASSOC)){
                  $serviceNameInList = Service::find_by_id($serviceInList['service'])->fetch_array(MYSQL_ASSOC);
                  $listOfServices .= $serviceNameInList['name'] . ', ';
                }
                $listOfServices = substr($listOfServices, 0, -2);
                echo '<td>' . $listOfServices . '</td>';
                echo '<td class="hidden-xs">';
                  if ($client['active'] == '1')
                    echo 'YES';
                  else echo 'NO';
                echo '</td>';
                # Client Email
                if ($client['email'] == '')
                  echo '<td>No Email</td>';
                else echo '<td><a href="mailto:' . $client['email'] . '">' . $client['email'] . '</a></td>';
                # Client Phone
                if ($client['phone'] == '')
                  echo '<td>No Phone</td>';
                else echo '<td><a href="tel: +1' . $client['phone'] . '">' . format_phone($client['phone']) . '</a></td>';
                # Client Address
                $state = (State::find_by_id($client['state'])->fetch_array(MYSQLI_ASSOC));
                $client['address'] = $client['street'] . ' ' . $client['city'] . ', ' . $state['name'] . ' ' . $client['zip_code'];
                if ($client['street'] == '')
                  echo '<td class="hidden-xs">No Address</td>';
                else echo '<td class="hidden-xs">' . $client['address'] . '</td>';
                
              echo '</tr>';
    } ?>
              </tbody>
            </table>
            <?php } elseif ($_GET['process'] == 'viewLoginInfo') { ?>
            <table id="users" class="table table-bordered table-hover table-responsive">
              <thead>
              <tr>
                <th class="hidden-xs">ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Admin</th>
                <th>Client</th>
              </tr>
              </thead>
              <tbody>
  <?php 
  while($user = $users->fetch_array(MYSQLI_ASSOC)){ 
              echo '<tr>';
                echo '<td class="hidden-xs">' . $user['id'] . '</td>';
                if ($user['username'] == "")
                  $user['username'] = 'N/A';
                echo '<td><a href="editUser.php?process=editUser&id=' . $user['id'] . '">' . $user['username'] . '</a></td>';
                echo '<td>' . $user['password'] . '</td>';
                echo '<td>';
                  if ($user['is_admin'] == '1')
                    echo 'YES';
                  else echo 'NO';
                echo '</td>';
                if ($user['client'] == NULL or $user['client'] == '0')
                  $user['client'] = 'No Client';
                else {
                  $tempClient = Client::find_by_id($user['client'])->fetch_array(MYSQLI_ASSOC);
                  $user['client'] = $tempClient['name'];
                }
                echo '<td>' . $user['client'] . '</td>';
              echo '</tr>';
    } ?>
              </tbody>
            </table>
            <?php } ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="col-md-3 col-md-offset-3">
              Total Clients: <?php echo $clientCount; ?>
            </div>
            <div class="col-md-6">
              Total LeadClickz Logins: <?php echo $clientCount; ?>
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