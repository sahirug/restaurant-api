<?php
class Employee{
 
    private $conn;
 
    public $employee_id;
    public $name;
    public $branch_id;
    public $status;
    public $job;
    
 
    public function __construct($db){
        $this->conn = $db;
    }

    public function authenticate($employee_id, $password){   
        $sql = "SELECT * FROM employees WHERE employee_id = '$employee_id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $hash_password = $row['password'];
            if(password_verify($password, $hash_password)){
                if($row['status'] == 'inactive' || $row['job'] != 'Rider'){
                    echo json_encode(['error' => 'Invalid Account']);                                
                }else{
                    echo json_encode(['message' => 'User authenticated', 'id' => $row['employee_id'], 'name' => $row['name'] ]);                    
                }
            }else{
                echo json_encode(['error' => 'Incorrect credentials']);                
            }
        }else{
            echo json_encode(['error' => 'Incorrect credentials']);
        }

    }
}