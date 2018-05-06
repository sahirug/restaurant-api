<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../../config/database.php';
include_once '../../models/order.php';
 
$database = new Database();
$db = $database->getConnection();

$order_id = '';
$order_type = '';

if(isset($_GET['order_id']) && isset($_GET['order_type'])){
    $order_id = $_GET['order_id'];
    $order_type = $_GET['order_type'];
}else{
    echo json_encode(['error' => 'Missing parameters']);
    die();
}

$order = new Order($db);
$order->get_meals($order_id, $order_type);

?>