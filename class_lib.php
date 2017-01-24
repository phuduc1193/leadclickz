<?php
  require_once('config.php');
  
  # Class: User
  class User {
    protected $_username;    // using protected so they can be accessed
    protected $_password; // and overidden if necessary
    protected $_isAdmin;
    protected $_client;
    
    public function __construct ($username, $password) 
    {
      global $db;
      $this->_username = $username;
      $this->_password = sha1($username.$password);
      $sql = "SELECT * FROM users WHERE users.username = '{$this->_username}' AND users.password = '{$this->_password}';";
      $result = $db->query($sql);
      if ($result['client']) {
        $_isAdmin = false;
      } else $_isAdmin = true;
      $_client = new Client($result['client']);
    }
    
    public static function find ($username){
      global $db;
      $sql = "SELECT username FROM users WHERE users.username = '{$username}';";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function register ($username, $password, $client = null) {
      if (User::find($username)){
        echo "Username is already used, please choose different username.";
      }
      else {
        $password = sha1($username.$password);
        $sql = "INSERT INTO users (client, username, password, created_at, updated_at) VALUES ('{$client}', '{$username}', '{$password}', 'NULL', 'NULL');";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
          echo "The registration is successful.";
        } else echo "Failed Query: " . $db->error;
      }
    }
  }
  
  # Class: Client
  class Client {
    protected $_id;
    protected $_name;
    protected $_logo;
    protected $_street;
    protected $_city;
    protected $_state;
    protected $_zipcode;
    protected $_address;
    protected $_phone;
    protected $_email;
    protected $_isActive;
    
    public function __construct ($id) 
    {
      global $db;
      $this->_id = $id;
      $sql = "SELECT * FROM clients WHERE clients.id = '{$this->_id}';";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        $this->_name = $result['name'];
        $this->_logo = $result['logo'];
        $this->_street = $result['street'];
        $this->_city = $result['city'];
        $this->_state = $result['state'];
        $this->_zipcode = $result['zip_code'];
        $this->_address = $this->_street . ', ' . $this->_city . ', ' . $this->_state . ' ' . $this->_zipcode;
        $this->_phone = $result['phone'];
        $this->_email = $result['email'];
        if ($result['active'] == 0)
          $this->_isActive = false;
        else $this->_isActive = true;
      }
    }
    
    public static function find ($id){
      global $db;
      $sql = "SELECT username FROM clients WHERE clients.id = '{$id}';";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function register ($name, $logo, $street, $city, $state, $zip, $phone, $email){
      $sql = "INSERT INTO clients (name, logo, street, city, state, zip_code, phone, email, created_at, updated_at) VALUES ('{$name}', '{$logo}', '{$street}', '{$city}', '{$state}', '{$zip}', '{$phone}', '{$email}', 'NULL', 'NULL');";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {
        echo "The registration is successful.";
      } else echo "Failed Query: " . $db->error;
    }
  }
?>