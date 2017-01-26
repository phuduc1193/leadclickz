<?php
  require_once('config.php');
  
  # Class: User
  class User {
    public $id;
    public $username;
    public $password;
    public $isAdmin;
    public $client;
    public $created_at;
    public $updated_at;
    
    public function __construct ($user, $pass) 
    {
      global $db;
      $sql = "SELECT * FROM users WHERE users.username = '{$user}' AND users.password = '" . sha1($user.$pass) . "';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        $this->username = $user;
        $this->password = $pass;
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $this->id = $row['id'];
        $this->username = $row['username'];
        if ($row['is_admin'] == 1){
          $isAdmin = true;
          $client = null;
        } else {$isAdmin = false;
          $client = Client::find($row['client']);
        }
        $this->created_at = $row['created_at'];
        $this->updated_at = $row['updated_at'];
      }
      else {
        $_SESSION['errors'] = array( 1 => "Invalid password." );
      }
      
    }
    
    public static function find ($user){
      global $db;
      $sql = "SELECT username FROM users WHERE users.username = '{$user}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        return $result;
      }
      return false;
    }
    
    public static function register ($user, $pass, $admin) {
      global $db;
      if (User::find($user)){
        $_SESSION['errors'] = array( 1 => "Username is already used, please choose different username." );
        header('Location: ' . $home_url . 'user.php');
      }
      else {
        $hashedpassword = sha1($user.$pass);
        if ($admin == 'admin'){ $is_admin = true;}
        else {$is_admin = false;}
        $sql = "INSERT INTO users (username, password, is_admin, created_at, updated_at) VALUES ('{$user}', '{$hashedpassword}', {$is_admin}, 'NULL', 'NULL');";
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
    
    static function __setstate(array $array) {
      $tmp = new User($array['username'], $array['password']);
      $tmp->id = $array['id'];
      $tmp->username = $array['username'];
      $tmp->isAdmin = $array['isAdmin'];
      $tmp->client = $array['client'];
      $tmp->created_at = $array['created_at'];
      $tmp->updated_at = $array['updated_at'];
      return $tmp;
    }
  }
  
  # Class: Client
  class Client {
    public $id;
    public $name;
    public $logo;
    public $street;
    public $city;
    public $state;
    public $zipcode;
    public $address;
    public $phone;
    public $email;
    public $isActive;
    
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