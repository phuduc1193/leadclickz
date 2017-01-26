<?php
  require_once('header.php');
  require_once('class_lib.php');
  
  $user = User::find($_GET["username"]);
  
  if ($user != false){
    unset($_SESSION['errors']);
    User::login($_GET["username"], $_GET["password"]);
    header('Location: ' . $home_url);
  } else {
    $_SESSION['errors'] = array( 1 => "Invalid Username." );
    header('Location: ' . $home_url);
  }
?>