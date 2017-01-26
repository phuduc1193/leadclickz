<?php
  require_once('header.php');
  require_once('class_lib.php');
  
  $user = User::find($_GET["username"]);
  
  if ($user != false){
    unset($_SESSION['errors']);
    $login_user = new User($_GET["username"], $_GET["password"]);
    $_SESSION['user'] = (array)$login_user;
    if (isset($_SESSION['errors'])){
      unset($_SESSION['user']);
      header('Location: ' . $home_url);
    } else header('Location: ' . $home_url);
  } else {
    $_SESSION['errors'] = array( 1 => "Invalid Username." );
    header('Location: ' . $home_url);
  }
?>