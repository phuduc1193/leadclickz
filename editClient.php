<?php
  require_once('class_lib.php');
  if($_SESSION['user']['is_admin'] == true){
    if(isset($_POST['id'])){
      Client::edit($_POST['id'], $_POST['name'], $_POST['logo'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip_code'], $_POST['phone'], $_POST['email'], $_POST['active']);
    }
    if($_POST['process'] == 'newClient'){
      Client::add();
    }
  }
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/editClient.php')
    header('Location: ' . $home_url);
?>