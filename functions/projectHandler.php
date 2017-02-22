<?php
require_once('../class_lib.php');
if($_SESSION['user']['is_admin'] == true){
  # Admin logics
  $id = (is_numeric($_POST['id']) ? (int)$_POST['id'] : 0);
  $client = (is_numeric($_POST['client']) ? (int)$_POST['client'] : 0);
  $service = (is_numeric($_POST['service']) ? (int)$_POST['service'] : 0);
  $progress = (is_numeric($_POST['progress']) ? (int)$_POST['progress'] : 0);
  $open = strtotime("{$_POST['opened_at']}");
  if ($open < 0)
    $open = 0;
  if ($id == 0) { # New User
    Project::add($client, $service, $_POST['title'], $_POST['description']);
  } else {
    Project::edit($id, $_POST['title'], $_POST['description'], $progress, $open);
  }
  
} elseif (isset($_SESSION['user'])){
  # Normal user logics
}

$home_url = substr($home_url, 0, -9);
header('Location: ' . $home_url . 'projects.php?process=viewProjects');
?>