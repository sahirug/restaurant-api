<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/employee.php';

$database = new Database();
$db = $database->getConnection();

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$employee_id = $request->empID;
$password = $request->password;

$rider = new Employee($db);
$rider->authenticate($employee_id, $password);

?>