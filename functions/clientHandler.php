<?php
require_once('../class_lib.php');
if($_SESSION['user']['is_admin'] == true){
  $id = (is_numeric($_POST['id']) ? (int)$_POST['id'] : 0);
  $active = (is_numeric($_POST['active']) ? (int)$_POST['active'] : 0);
  $state = (is_numeric($_POST['state']) ? (int)$_POST['state'] : 43);
  $zip = (is_numeric($_POST['zip_code']) ? (int)$_POST['zip_code'] : 77002);
  $phone = (is_numeric($_POST['phone']) ? (int)$_POST['phone'] : '');
  if ($id == 0) { # New Client
    Client::add($_POST['name'], $_POST['logo'], $_POST['street'], $_POST['city'], $state, $zip_code, $phone, $_POST['email'], $active);
  } else {
    Client::edit($_POST['id'], $_POST['name'], $_POST['logo'], $_POST['street'], $_POST['city'], $state, $zip, $phone, $_POST['email'], $active);
  }
}
$home_url = substr($home_url, 0, -9);
header('Location: ' . $home_url . 'clients.php');
?>