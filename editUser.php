<?php
  require_once('class_lib.php');
  if($_SESSION['user']['is_admin'] == true){
    if(isset($_POST['id'])){
      User::edit_user($_POST['id'], $_POST['username'], $_POST['password'], $_POST['is_admin'], $_POST['client']);
    }
    if($_POST['process'] == 'newUser'){
      User::add_user();
    }
  }
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/editUser.php')
    header('Location: ' . $home_url);
?>