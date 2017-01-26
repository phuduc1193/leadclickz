<?php
   ob_start();
   session_start();
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);

  define('DB_SERVER', getenv('IP'));
  define('DB_USERNAME', getenv('C9_USER'));
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'c9');
  define('DB_PORT', 3306);
  $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
   
  if ($db->connect_error) {
    die("Connection failed. Please check your connection again or report to the administrator.");
  }
  
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/config.php')
    header('Location: ' . $home_url);
?>