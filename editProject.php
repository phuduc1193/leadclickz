<?php
  require_once('class_lib.php');
  require_once('partials/header.php');
  require_once('partials/navbar.php');
?>
<?php if($_SESSION['user']['is_admin'] == 1){
  require_once('partials/sidebar.php');
  # Get client info
  if (isset($_GET['id']))
    $project = Project::find_by_id($_GET['id'])->fetch_array(MYSQL_ASSOC);
?>

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Projects
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $home_url; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active"><a href="<?php echo $home_url . "projects.php?process=viewProjects"; ?>">Projects</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="box box-primary">
          <div class="box-header">
            <i class="fa fa-users"></i><h3 class="box-title"><?php if ($_GET['process']=='addNewProject') echo 'New'; else echo 'Edit';?> Project</h3>
          </div>
          <!-- form start -->
          <form role="form" id="editProjectForm" class="form-horizontal" action="functions/projectHandler.php" method="POST">
            <div class="box-body">
              <div class="form-group">
                <label for="project_id" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="project_id" name="id" value="<?php echo $project['id']; ?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="project_title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="project_title" name="title" value="<?php echo $project['title']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="5" id="description" name="description"><?php echo $project['description']; ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="client" class="col-sm-2 control-label">Client</label>
                <div class="col-sm-10">
                  <select id="client" name="client" class="form-control">
                    <?php
                    if ($_GET['process'] == 'addNewProject'){
                      echo '<option disabled selected>Select Client...</option>';
                    } elseif ($_GET['process'] == 'editProject') {
                      $client = Client::find_by_id($project['client'])->fetch_array(MYSQL_ASSOC);
                      echo '<option value=' . $client['id'] . ' selected>' . $client['name'] . '</option>';
                    }
                    $clients = Client::find_all();
                    while ($client = $clients->fetch_array(MYSQL_ASSOC)){
                      echo '<option value=' . $client['id'] . '>' . $client['name'] . '</option>';
                    } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="service" class="col-sm-2 control-label">Service Type</label>
                <div class="col-sm-10">
                  <select id="service" name="service" class="form-control">
                    <?php
                    if ($_GET['process'] == 'addNewProject'){
                      echo '<option disabled selected>Select Service...</option>';
                    } elseif ($_GET['process'] == 'editProject') {
                      $service = Service::find_by_id($project['service'])->fetch_array(MYSQL_ASSOC);
                      echo '<option value=' . $service['id'] . ' selected>' . $service['name'] . '</option>';
                    }
                    $services = Service::find_all();
                    while ($service = $services->fetch_array(MYSQL_ASSOC)){
                      echo '<option value=' . $service['id'] . '>' . $service['name'] . '</option>';
                    } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="progress" class="col-sm-2 control-label">Progress</label>
                <div class="col-sm-10">
                  <input type="range" name="progress" min="0" max="100" value="<?php echo $project['progress']; ?>" step="5"/>
                </div>
              </div>
              <div class="form-group">
                <label for="project_opened_at" class="col-sm-2 control-label">Start Date</label>
                <div class="col-sm-10">
                  <div class="input-group date" id="project_opened_at" data-provide="datepicker">
                    <input type="text" class="form-control" name="opened_at" value="<?php echo date('m/d/Y', strtotime($project['opened_at'])); ?>">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="project_created_at" class="col-sm-2 control-label">Created At</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="project_created_at" placeholder="<?php echo $project['created_at']; ?>" disabled>
                </div>
              </div>
              <div class="form-group">
                <label for="project_updated_at" class="col-sm-2 control-label">Updated At</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="project_updated_at" placeholder="<?php echo $project['updated_at']; ?>" disabled>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-right">
              <a class="btn btn-default btn-md" href="<?php echo $home_url . "projects.php"; ?>">Back</a>
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