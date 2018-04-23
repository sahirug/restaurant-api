<?php
class Database{
 
    private $localhost = "localhost";
    private $db_name = "restaurant1";
    private $username = "root";
    private $password = "";
    public $conn;
 
    public function getConnection(){
 
        $this->conn = null;

        // Create connection
        $conn = new mysqli($this->localhost, $this->username, $this->password, $this->db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn; 
    }
}
?>