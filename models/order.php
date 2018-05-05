<?php
class Order{
 
    private $conn;
 
    public $order_id;
    public $order_date;
    public $tot_cost;
    public $app_user_id;
    public $branch_id;
    public $lat;
    public $lng;
    public $status = 'unpaid';
 
    public function __construct($db){
        $this->conn = $db;
    }

    public function add(){
        $sql = "INSERT INTO app_orders(order_id, order_date, tot_cost, app_user_id, branch_id, status, lat, lng) 
        VALUES('$this->order_id', '$this->order_date', $this->tot_cost, '$this->app_user_id', 
        '$this->branch_id', '$this->status', $this->lat, $this->lng)";
        if ($this->conn->query($sql) === TRUE) {
            echo json_encode(['message' => 'Order added!', 'order_id' => $this->order_id]);
        } else {
            echo json_encode(['error' => $this->conn->error]);
        }
    }

    public function meal_orders($meal_id, $order_id, $qty){
        //table name = meals_app_order
        $sql = "INSERT INTO meals_app_order(order_id, meal_id, qty) 
        VALUES('$order_id', '$meal_id', $qty)";
        if ($this->conn->query($sql) === TRUE) {
            echo json_encode(['message' => 'Meal added to order!']);
        } else {
            echo json_encode(['error' => $this->conn->error]);
        }
    }

    public function get_order_id(){
        $sql = "SELECT COUNT(*) AS 'count' FROM app_orders WHERE branch_id = '$this->branch_id' ";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            $count++;
            $this->order_id = 'ORD-'.$this->branch_id.'-'.str_pad($count, 3, '0', STR_PAD_LEFT);
        } else {
            return false;
        }
    }

    public function get_order_for_user($id){
        $sql = "SELECT *, COUNT(*) as 'count' FROM app_orders WHERE app_user_id = $id AND status = 'unpaid'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        if($row['count'] > 0){
            echo json_encode($row);
        }else{
            echo json_encode(['message' => 'No orders']);
        }
    }

    public function get_rider_orders($employee_id){
        $sql = "SELECT * FROM app_orders WHERE rider = '$employee_id' AND status = 'unpaid'";
        $result = $this->conn->query($sql);
        $orders = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($orders, $row);
            }
            echo json_encode($orders);
        }else{
            echo json_encode(['error' => 'no orders', 'status' => 404]);
        }    
    }

    public function get_phone_orders($employee_id){
        $sql = "SELECT * FROM phone_orders WHERE rider_id = '$employee_id' AND status = 'unpaid'";
        $result = $this->conn->query($sql);
        $orders = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($orders, $row);
            }
            echo json_encode($orders);
        }else{
            echo json_encode(['error' => 'no orders', 'status' => 404]);
        }    
    }
    
}