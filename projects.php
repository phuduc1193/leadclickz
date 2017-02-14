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
      Projects
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $home_url; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Projects</li>
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
            <h3 class="box-title">Project Info</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="clients" class="table table-bordered table-striped table-responsive">
              <thead>
              <tr>
                <th class="hidden-xs">ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Client Name</th>
                <th>Service Type</th>
                <th>Progress</th>
                <th class="hidden-xs">Start Date</th>
                <th class="hidden-xs">Create Date</th>
              </tr>
              </thead>
              <tbody>
  <?php $projects = Project::find_all();
  while($project = $projects->fetch_array(MYSQLI_ASSOC)){ 
              echo '<tr>';
                echo '<td class="hidden-xs">' . $project['id'] . '</td>';
                echo '<td><a href="editProject.php?process=editProject&id=' . $project['id'] . '">' . $project['title'] . '</a></td>';
                echo '<td>' . $project['description'] . '</td>';
                $project['client'] = (Client::find_by_id($project['client'])->fetch_array(MYSQL_ASSOC));
                echo '<td>' . $project['client']['name'] . '</td>';
                $project['service'] = (Service::find_by_id($project['service'])->fetch_array(MYSQL_ASSOC));
                echo '<td>' . $project['service']['name'] . '</td>';
  ?>
  <td>
    <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $project['progress']; ?>%; color: #141414" >
      <?php echo $project['progress']; ?>%
    </div>
  </div></td>
  <?php
                if (!$project['opened_at'] == '0000-00-00 00:00:00')
                  echo '<td class="hidden-xs">' . date('j M, Y', strtotime($project['opened_at'])) . '</td>';
                else echo '<td class="hidden-xs"></td>';
                echo '<td class="hidden-xs">' . date('j M, Y', strtotime($project['created_at'])) . '</td>';
              echo '</tr>';
  } ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="col-md-9 col-md-offset-3">
              <form action="editProject.php" method="GET">
                <input type="hidden" name="process" value="addNewService">
                <button type="submit" class="btn btn-primary">Add new Project</button>
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