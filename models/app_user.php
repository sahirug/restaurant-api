<?php
class App_User{
 
    private $conn;
 
    public $email;
    public $name;
    public $password;
 
    public function __construct($db){
        $this->conn = $db;
    }

    public function add(){
        $password = password_hash($this->password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO app_users(name, email, password) VALUES ('$this->name', '$this->email',
                 '$password')";

        if ($this->conn->query($sql) === TRUE) {
            // echo '{';
            //     echo '"message": "User was added."';
            // echo '}';
            echo json_encode(['message' => 'User was added']);
        } else {
            echo json_encode(['error' => $this->conn->error]);
        }         
    }

    public function authenticate($email, $password){   
        $sql = "SELECT COUNT(*) as 'COUNT', password, id, name FROM app_users WHERE email = '$email'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $hash_password = $row['password'];
            if(password_verify($password, $hash_password)){
                echo json_encode(['message' => 'User authenticated', 'id' => $row['id'], 'name' => $row['name'] ]);
            }else{
                echo json_encode(['error' => 'Incorrect credentials']);                
            }
        }

    }
}