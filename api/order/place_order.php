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

$tot_cost = $request->tot_cost;
$app_user_id = $request->app_user_id;
$branch_id = $request->branch_id;

$order = new Order($db);
$order->order_date = date('Y-m-d');
$order->tot_cost = $tot_cost;
$order->app_user_id = $app_user_id;
$order->branch_id = $branch_id;
$order->get_order_id();
$order->add();

?>