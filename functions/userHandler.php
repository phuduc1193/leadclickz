<?php
require_once('../class_lib.php');
var_dump($_SESSION);
echo '<br><br>';
var_dump($_POST);
echo '<br><br>';
if($_SESSION['user']['is_admin'] == true){
  $id = (is_numeric($_POST['id']) ? (int)$_POST['id'] : 0);
  $is_admin = (is_numeric($_POST['is_admin']) ? (int)$_POST['is_admin'] : 0);
  $client = (is_numeric($_POST['client']) ? (int)$_POST['client'] : null);
  if ($id == 0) { # New User
    User::add($_POST['username'], $_POST['password'], $is_admin, $client);
  } else {
    User::edit($id, $_POST['username'], $_POST['password'], $is_admin, $client);
  }
}
$home_url = substr($home_url, 0, -9);
header('Location: ' . $home_url . 'clients.php');
?>