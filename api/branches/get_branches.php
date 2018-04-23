<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../../config/database.php';
include_once '../../models/branch.php';
 
$database = new Database();
$db = $database->getConnection();
 
$branch = new Branch($db);
$branches = $branch->read();

?>