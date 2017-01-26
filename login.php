<?php
  require_once('header.php');
  global $db;
  $username = mysqli_real_escape_string($db, $_GET["username"]);
  $password = mysqli_real_escape_string($db, $_GET["password"]);
  
  $user = User::find($username);
  
  if ($user != false){
    unset($_SESSION['errors']);
    User::login($username, $password);
    header('Location: ' . $home_url);
  } else {
    $_SESSION['errors'] = array( 1 => "Invalid Username." );
    header('Location: ' . $home_url);
  }
?>