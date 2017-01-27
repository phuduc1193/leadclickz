<?php
  require_once('config.php');
  
  ###############################################################
  #####                     Class: User                     #####
  ###############################################################
  
  class User {
    public static function find_all (){
      global $db;
      $sql = "SELECT * FROM users;";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        return $result;
      }
      return false;
    }
    
    public static function find_by_id ($id){
      global $db;
      $sql = "SELECT * FROM users WHERE users.id = '{$id}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        return $result;
      }
      return false;
    }
    
    public static function find ($user){
      global $db;
      $sql = "SELECT * FROM users WHERE users.username = '{$user}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        return $result;
      }
      return false;
    }
    
    public static function add_user (){
      global $db;
      $sql = "INSERT INTO users (created_at, updated_at) VALUES (NOW(), NOW());";
      $result = $db->query($sql);
      if ($db->affected_rows > 0) {
        $_SESSION['success'] = array( 1 => "New User has been added." );
      } else {
        $_SESSION['errors'] = array( 1 => "Creating User process is jammed. Try to set the newest User first before starting create new user." );
      }
    }
    
    public static function login ($user, $pass){
      global $db;
      $sql = "SELECT * FROM users WHERE users.username = '{$user}' AND users.password = '{$pass}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        $_SESSION['user'] = $result->fetch_array(MYSQLI_ASSOC);
      }
      else {
        $_SESSION['errors'] = array( 1 => "Invalid password." );
        unset($_SESSION['user']);
      }
    }
    
    # only for admin user
    public static function edit_user ($id, $user, $pass, $is_admin, $client){
      global $db;
      if ($_SESSION['user']['is_admin'] == true){
        if ($client == '')
          $client = 'NULL';
        $sql = "UPDATE users SET users.username = '{$user}', users.password = '{$pass}', users.is_admin = '{$is_admin}', users.client = '{$client}' WHERE users.id = {$id};";
        $result = $db->query($sql);
        if ($db->affected_rows > 0) {
          $_SESSION['success'] = array( 1 => "All changes with the User has been saved." );
        } else {
          $_SESSION['errors'] = array( 1 => "Editing User process is jammed. Please contact the administrator for assistance." );
        }
      }
    }
  }
  
  ###############################################################
  #####                    Class: Client                    #####
  ###############################################################
  
  class Client {
    public static function find_all (){
      global $db;
      $sql = "SELECT * FROM clients;";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function find ($id){
      global $db;
      $sql = "SELECT * FROM clients WHERE clients.id = '{$id}';";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function register ($name, $logo, $street, $city, $state, $zip, $phone, $email){
      global $db;
      $sql = "INSERT INTO clients (name, logo, street, city, state, zip_code, phone, email, created_at, updated_at) VALUES ('{$name}', '{$logo}', '{$street}', '{$city}', '{$state}', '{$zip}', '{$phone}', '{$email}', 'NULL', 'NULL');";
      $result = $db->query($sql);
      if ($result->affected_rows > 0) {
        echo "The registration is successful.";
      } else echo "Failed Query: " . $db->error;
    }
  }
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/class_lib.php')
    header('Location: ' . $home_url);
?>