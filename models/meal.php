<?php
class Meal{
 
    // database connection and table name
    private $conn;
    private $table_name = "meals";
 
    // object properties
    // public $id;
    // public $name;
    // public $description;
    // public $price;
    // public $category_id;
    // public $category_name;
    // public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read($branch_id){
 
        $sql = "SELECT * FROM meals WHERE branch_id = '$branch_id' AND status = 'available' ";
        $result = $this->conn->query($sql);
        $num = $result->num_rows;
        $data = [];
        if($num>0){
            while($row = $result->fetch_assoc()){
                array_push($data, $row);
            }
            echo json_encode($data);
        }else{
            echo json_encode(array("error" => "No meals found."));
        }
    }
}