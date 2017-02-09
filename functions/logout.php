<?php
  require_once('../config.php');
  session_destroy();
  ob_flush();
  header('Location: ' . substr($home_url, 0, -9));
?>