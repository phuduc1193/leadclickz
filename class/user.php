<?php
  require_once('../config.php');
  require_once('client.php');
  
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
      $sql = "SELECT * FROM users WHERE users.username = '{$this->_username}' AND users.password = '{$this->_password}'";
      $result = $db->query($sql);
      if ($result['client']) {
        $_isAdmin = false;
      } else $_isAdmin = true;
      $_client = new Client($result['client']);
    }
    
    public static function find ($username){
      global $db;
      $sql = "SELECT username FROM users WHERE users.username = '{$username}'";
      $result = $db->query($sql);
      return $result;
    }
    
    public static function register ($username, $password, $client = null) {
      if (User::find($username)){
        echo "Username is already used, please choose different username.";
      }
      else {
        $password = sha1($username.$password);
        $sql = "INSERT INTO users (client, username, password, created_at, updated_at) VALUES ('{$client}', '{$username}', '{$password}', 'NULL', 'NULL')";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
          echo "The registration is successful.";
        }
      }
    }
  }
?>