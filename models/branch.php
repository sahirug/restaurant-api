<?php
class Branch{
 
    // database connection and table name
    private $conn;
    private $table_name = "branches";
 
    // object properties
    public $branch_id;
    public $location;
    public $lat;
    public $lng;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){ 
        $sql = "SELECT * FROM branches";
        $result = $this->conn->query($sql);
        $num = $result->num_rows;
        $data = [];
        if($num>0){
            while($row = $result->fetch_assoc()){
                array_push($data, $row);
            }
            echo json_encode($data);
        }else{
            echo json_encode(array("error" => "No branches found."));
        }
    }

    public function add(){
        $sql = "INSERT INTO branches(branch_id, location, lat, lng) 
                VALUES ('$this->branch_id', '$this->location',
                 $this->lat, $this->lng)";

        if ($this->conn->query($sql) === TRUE) {
            echo '{';
                echo '"message": "Branch was added."';
            echo '}';
        } else {
            echo '{';
                echo '"error": "'. $this->conn->error .'"';
            echo '}';
        }
    }
}