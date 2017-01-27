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
    
    public static function register ($user, $pass) {
      global $db;
      if (User::find($user)){
        unset($_SESSION['success']);
        $_SESSION['errors'] = array( 1 => "Username is already used, please choose different username." );
      }
      else {
        $sql = "INSERT INTO users (username, password, is_admin, created_at, updated_at) VALUES ('{$user}', '{$pass}', false, NOW(), NOW());";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
          unset($_SESSION['errors']);
          $_SESSION['success'] = array( 1 => "The registration is successful." );
        } else {
          unset($_SESSION['success']);
          $_SESSION['errors'] = array( 1 => "The registration is unsuccesful. Please contact the administrator for assistance." );
        }
      }
    }
    
    public static function register_admin ($user, $pass, $admin) {
      global $db;
      if (User::find($user)){
        $_SESSION['errors'] = array( 1 => "Username is already used, please choose different username." );
      }
      else {
        if ($admin == 'admin'){ $is_admin = true;}
        else {$is_admin = false;}
        $sql = "INSERT INTO users (username, password, is_admin, created_at, updated_at) VALUES ('{$user}', '{$pass}', {$is_admin}, NOW(), NOW());";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
          unset($_SESSION['errors']);
          $_SESSION['success'] = array( 1 => "The registration is successful." );
        } else {
          unset($_SESSION['success']);
          $_SESSION['errors'] = array( 1 => "The registration is unsuccesful. Please contact the administrator for assistance." );
        }
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
        $db->query("UPDATE users SET users.username = '{$user}', users.password = '{$pass}', users.is_admin = '{$is_admin}', users.client = '{$client}', users.updated_at = NOW() WHERE users.id = {$id};");
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
          unset($_SESSION['errors']);
          $_SESSION['success'] = array( 1 => "The User has been edited." );
        } else {
          unset($_SESSION['success']);
          $_SESSION['errors'] = array( 1 => "Editing User process is jammed. Please contact the administrator for assistance." );
          header('Location: ' . $home_url . 'user.php');
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
      if ($result->num_rows > 0) {
        echo "The registration is successful.";
      } else echo "Failed Query: " . $db->error;
    }
  }
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/class_lib.php')
    header('Location: ' . $home_url);
?>