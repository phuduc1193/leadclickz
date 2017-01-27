<?php
  require_once('class_lib.php');
  if($_SESSION['user']['is_admin'] == true){
    if($_POST['is_admin'] == true){
      User::register_admin($_POST['username'], $_POST['password']);
    } else User::register($_POST['username'], $_POST['password']);
  }
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/createUser.php')
    header('Location: ' . $home_url);
?>