<?php
require_once('../class_lib.php');
if($_SESSION['user']['is_admin'] == true){
  $id = (is_numeric($_POST['id']) ? (int)$_POST['id'] : 0);
  if ($id == 0) { # New User
    Service::add($_POST['name'], $_POST['description']);
  } else {
    Service::edit($id, $_POST['name'], $_POST['description']);
  }
}
$home_url = substr($home_url, 0, -9);
header('Location: ' . $home_url . 'services.php?process=viewServices');
?>