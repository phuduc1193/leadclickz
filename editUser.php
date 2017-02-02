<?php
  require_once('class_lib.php');
  if($_SESSION['user']['is_admin'] == true){
    if(isset($_POST['id'])){
      User::edit($_POST['id'], $_POST['username'], $_POST['password'], $_POST['is_admin'], $_POST['client']);
    }
    if($_POST['process'] == 'newUser'){
      User::add();
    }
  }
?>