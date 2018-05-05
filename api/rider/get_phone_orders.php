<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/order.php';

$database = new Database();
$db = $database->getConnection();

$employee_id = '';

if(isset($_GET['id'])){
    $employee_id = $_GET['id'];
}else{
    die(json_encode(['error' => 'ID not found']));
}

$order = new Order($db);
$order->get_phone_orders($employee_id);

?>