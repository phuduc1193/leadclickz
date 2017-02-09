<?php
  require_once('../class_lib.php');
  global $db;
  $username = mysqli_real_escape_string($db, $_GET["username"]);
  $password = mysqli_real_escape_string($db, $_GET["password"]);
  
  $user = User::find($username);
  
  if ($user != false){
    unset($_SESSION['errors']);
    User::login($username, $password);
    header('Location: ' . substr($home_url, 0, -9));
  } else {
    $_SESSION['errors'] = array( 1 => "Invalid Username." );
    header('Location: ' . substr($home_url, 0, -9));
  }
?>