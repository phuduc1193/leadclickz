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
      $id = mysqli_real_escape_string($db, $id);
      $sql = "SELECT * FROM users WHERE users.id = '{$id}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        return $result;
      }
      return false;
    }
    
    public static function find ($user){
      global $db;
      $user = mysqli_real_escape_string($db, $user);
      $sql = "SELECT * FROM users WHERE users.username = '{$user}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        return $result;
      }
      return false;
    }
    
    public static function add (){
      global $db;
      $sql = "INSERT INTO users (created_at, updated_at) VALUES (NOW(), NOW());";
      $result = $db->query($sql);
      if ($db->affected_rows > 0) {
        $_SESSION['success'] = array( 1 => "New User has been added." );
      } else {
        $_SESSION['errors'] = array( 1 => "Creating User process is jammed. Try to set the newest User first before starting create new one." );
      }
    }
    
    public static function login ($user, $pass){
      global $db;
      $user = mysqli_real_escape_string($db, $user);
      $pass = mysqli_real_escape_string($db, $pass);
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
    public static function edit ($id, $user, $pass, $is_admin, $client){
      global $db;
      $id = mysqli_real_escape_string($db, $id);
      $user = mysqli_real_escape_string($db, $user);
      $pass = mysqli_real_escape_string($db, $pass);
      $is_admin = mysqli_real_escape_string($db, $is_admin);
      $client = mysqli_real_escape_string($db, $client);
      if ($_SESSION['user']['is_admin'] == true){
        if ($client == '')
          $client = 'NULL';
        $sql = "UPDATE users SET users.username = '{$user}', users.password = '{$pass}', users.is_admin = {$is_admin}, ";
        $sql .= "users.client = '{$client}' WHERE users.id = {$id};";
        $result = $db->query($sql);
        if ($db->affected_rows > 0) {
          $_SESSION['success'] = array( 1 => "All changes with the User has been saved." );
        } else {
          $_SESSION['errors'] = array( 1 => "No changes are made. Please contact the Administration for further assistance if needed." );
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

    public static function find_by_id ($id){
      global $db;
      $id = mysqli_real_escape_string($db, $id);
      $sql = "SELECT * FROM clients WHERE clients.id = '{$id}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        return $result;
      }
      return false;
    }

    public static function add ($name, $logo, $street, $city, $state, $zip, $phone, $email, $active){
      global $db;
      $name = mysqli_real_escape_string($db, $name);
      $logo = mysqli_real_escape_string($db, $logo);
      $street = mysqli_real_escape_string($db, $street);
      $city = mysqli_real_escape_string($db, $city);
      $state = mysqli_real_escape_string($db, $state);
      $zip = mysqli_real_escape_string($db, $zip);
      $phone = mysqli_real_escape_string($db, $phone);
      $email = mysqli_real_escape_string($db, $email);
      $active = mysqli_real_escape_string($db, $active);
      $sql = "INSERT INTO clients (name, logo, street, city, state, zip_code, phone, email, active, created_at, updated_at) ";
      $sql .= "VALUES ('{$name}', '{$logo}', '{$street}', '{$city}', {$state}, '{$zip}', '{$phone}', '{$email}', {$active}, NOW(), NOW());";
      $result = $db->query($sql);
      if ($db->affected_rows > 0) {
        $_SESSION['success'] = array( 1 => "New Client has been added." );
      } else {
        $_SESSION['errors'] = array( 1 => "Creating Client process is jammed. Contact the Administrator for more assistance.");
      }
    }
    
    # only for admin user
    public static function edit ($id, $name, $logo, $street, $city, $state, $zip, $phone, $email, $active){
      global $db;
      $id = mysqli_real_escape_string($db, $id);
      $name = mysqli_real_escape_string($db, $name);
      $logo = mysqli_real_escape_string($db, $logo);
      $street = mysqli_real_escape_string($db, $street);
      $city = mysqli_real_escape_string($db, $city);
      $state = mysqli_real_escape_string($db, $state);
      $zip = mysqli_real_escape_string($db, $zip);
      $phone = mysqli_real_escape_string($db, $phone);
      $email = mysqli_real_escape_string($db, $email);
      $active = mysqli_real_escape_string($db, $active);
      $sql = "UPDATE clients SET name='{$name}', logo='{$logo}', street='{$street}', city='{$city}', state={$state}, zip_code='{$zip}', phone='{$phone}', email='{$email}', active={$active} WHERE id={$id};";
      $result = $db->query($sql);
      if ($db->affected_rows > 0) {
        $_SESSION['success'] = array( 1 => "All changes with the Client has been saved." );
      } else {
        $_SESSION['errors'] = array( 1 => "No changes are made. Contact the Administrator for more assistance." . $db->error);
      }
    }
  }
  
  ###############################################################
  #####                    Class: State                     #####
  ###############################################################
  
  class State {
    public static function find_all (){
      global $db;
      $sql = "SELECT * FROM states;";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function find_by_id ($id){
      global $db;
      $id = mysqli_real_escape_string($db, $id);
      $sql = "SELECT * FROM states WHERE states.id = '{$id}';";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function find_all_except ($id){
      global $db;
      $id = mysqli_real_escape_string($db, $id);
      $sql = "SELECT * FROM states WHERE NOT states.id = '{$id}';";
      $result = $db->query($sql);
      return $result;
    }
  }

  ###############################################################
  #####                  Class: Service                     #####
  ###############################################################
  
  class Service {
    public static function find_all (){
      global $db;
      $sql = "SELECT * FROM services;";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function find_by_id ($id){
      global $db;
      $id = mysqli_real_escape_string($db, $id);
      $sql = "SELECT * FROM services WHERE services.id = '{$id}';";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function add (){
      global $db;
      $sql = "INSERT INTO services (created_at, updated_at) VALUES (NOW(), NOW());";
      $result = $db->query($sql);
      if ($db->affected_rows > 0) {
        $_SESSION['success'] = array( 1 => "New Service has been added." );
      } else {
        $_SESSION['errors'] = array( 1 => "Creating Service process is jammed. Try to set the newest Service first before starting create new one." );
      }
    }
    
    # only for admin user
    public static function edit ($id, $name){
      global $db;
      $id = mysqli_real_escape_string($db, $id);
      $name = mysqli_real_escape_string($db, $name);
      if ($_SESSION['user']['is_admin'] == true){
        $sql = "UPDATE services SET services.name = '{$name}' WHERE services.id = {$id};";
        $result = $db->query($sql);
        if ($db->affected_rows > 0) {
          $_SESSION['success'] = array( 1 => "All changes with the Service has been saved." );
        } else {
          $_SESSION['errors'] = array( 1 => $db->error );
        }
      }
    }
  }
?>

<?php
  if ($_SERVER[REQUEST_URI] == '/class_lib.php')
    header('Location: ' . $home_url);
?>