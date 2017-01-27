<?php
  require_once('header.php');
  if($_SESSION['user']['is_admin'] == true){
    if($_POST['id']){
      User::edit_user($_POST['id'], $_POST['username'], $_POST['password'], $_POST['is_admin'], $_POST['client']);
      header('Location: ' . $home_url);
    } else header('Location: ' . $home_url);
  } else header('Location: ' . $home_url);
?>