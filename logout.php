<?php
  require_once('config.php');
  session_destroy();
  ob_flush();
  header('Location: ' . $home_url);
?>