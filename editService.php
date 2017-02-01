<?php
  require_once('class_lib.php');
  if($_SESSION['user']['is_admin'] == true){
    if(isset($_POST['id'])){
      Service::edit($_POST['id'], $_POST['name']);
    }
    if($_POST['process'] == 'newService'){
      Service::add();
    }
  }
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/editService.php')
    header('Location: ' . $home_url);
?>