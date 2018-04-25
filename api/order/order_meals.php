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

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$meal_id = $request->meal_id;
$order_id = $request->order_id;
$qty = $request->qty;

$order = new Order($db);
$order->meal_orders($meal_id, $order_id, $qty);

?>