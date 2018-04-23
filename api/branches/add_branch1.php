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
// $request = json_decode($postdata);
// echo $request->message;
if(isset($postdata)){
    $request = json_decode($postdata);
    $branch = new Branch($db);
    $branch->branch_id = $request->branchID;
    $branch->location = $request->location;
    $branch->lat = $request->lat;
    $branch->lng = $request->lng;
    $branch->add();
}else{
    echo '{';
        echo '"error": "Product was not created."';
    echo '}';
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