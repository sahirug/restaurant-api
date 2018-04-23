<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/branch.php';

$database = new Database();
$db = $database->getConnection();
// Required field names
$required = array('branchID', 'location', 'lat', 'lng');

$postdata = file_get_contents("php://input");

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  if (!isset($_POST[$field])) {
    $error = true;
  }
}

if ($error) {
    echo '{';
        echo '"error": "Complete all fields."';
    echo '}';    
} else {
    $branch = new Branch($db);
    $branch->branch_id = $_POST['branchID'];
    $branch->location = $_POST['location'];
    $branch->lat = $_POST['lat'];
    $branch->lng = $_POST['lng'];
    $branch->add();
}









// create the product
// if($product->create()){
//     echo '{';
//         echo '"message": "Product was created."';
//     echo '}';
// }
 
// // if unable to create the product, tell the user
// else{
//     echo '{';
//         echo '"message": "Unable to create product."';
//     echo '}';
// }
?>