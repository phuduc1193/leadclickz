<?php
  require_once('config.php');
  
  # Class: User
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
        $_SESSION['errors'] = array( 1 => "Username is already used, please choose different username." );
        header('Location: ' . $home_url . 'user.php');
      }
      else {
        $sql = "INSERT INTO users (username, password, is_admin, created_at, updated_at) VALUES ('{$user}', '{$pass}', false, NOW(), NOW());";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
          $_SESSION['success'] = array( 1 => "The registration is successful." );
          header('Location: ' . $home_url . 'user.php');
        } else {
          $_SESSION['errors'] = array( 1 => "The registration is unsuccesful. Please contact the administrator for assistance." );
          header('Location: ' . $home_url . 'user.php');
        }
      }
    }
    
    public static function register_admin ($user, $pass, $admin) {
      global $db;
      if (User::find($user)){
        $_SESSION['errors'] = array( 1 => "Username is already used, please choose different username." );
        header('Location: ' . $home_url . 'user.php');
      }
      else {
        if ($admin == 'admin'){ $is_admin = true;}
        else {$is_admin = false;}
        $sql = "INSERT INTO users (username, password, is_admin, created_at, updated_at) VALUES ('{$user}', '{$pass}', {$is_admin}, NOW(), NOW());";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
          $_SESSION['success'] = array( 1 => "The registration is successful." );
          header('Location: ' . $home_url . 'user.php');
        } else {
          $_SESSION['errors'] = array( 1 => "The registration is unsuccesful. Please contact the administrator for assistance." );
          header('Location: ' . $home_url . 'user.php');
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
    
    public static function set_client ($is_admin, $user_id, $client_id){
      global $db;
      if ($is_admin == true){
        $db->query("UPDATE users SET users.client = '{$client_id}', users.updated_at = NOW() WHERE users.id = {$user_id};");
      }
    }
  }
  
  # Class: Client
  class Client {
    public function __construct ($id) 
    {
      global $db;
      $this->id = $id;
      $sql = "SELECT * FROM clients WHERE clients.id = '{$this->id}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        $this->name = $result['name'];
        $this->logo = $result['logo'];
        $this->street = $result['street'];
        $this->city = $result['city'];
        $this->state = $result['state'];
        $this->zipcode = $result['zip_code'];
        $this->address = $this->street . ', ' . $this->city . ', ' . $this->state . ' ' . $this->zipcode;
        $this->phone = $result['phone'];
        $this->email = $result['email'];
        if ($result['active'] == 0)
          $this->isActive = false;
        else $this->isActive = true;
      }
    }
    
    public static function find ($id){
      global $db;
      $sql = "SELECT username FROM clients WHERE clients.id = '{$id}';";
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