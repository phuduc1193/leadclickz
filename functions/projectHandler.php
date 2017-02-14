<?php
require_once('../class_lib.php');
if($_SESSION['user']['is_admin'] == true){
  var_dump($_POST);
  echo date("jS F, Y", strtotime($_POST['opened_at']));
} elseif (isset($_SESSION['user'])){
  
}

$home_url = substr($home_url, 0, -9);
#header('Location: ' . $home_url . 'projects.php?process=viewProjects');
?>