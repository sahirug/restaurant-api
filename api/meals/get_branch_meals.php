<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../../config/database.php';
include_once '../../models/meal.php';
 
$database = new Database();
$db = $database->getConnection();

$branch_id = '';

if(isset($_GET['branch_id'])){
    $branch_id = $_GET['branch_id'];
}else{
    echo json_encode(['error' => 'No branch ID given']);
    die();
}

$meal = new Meal($db);
$meals = $meal->read($branch_id);

?>