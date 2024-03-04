<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'functions.php';

$callBackFunction = new callBackCrudFunctions();

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "POST") {

    $inputData = json_decode(file_get_contents("php://input"), true);

    if (empty($inputData)) {
        $storeCustomer = $callBackFunction -> storeCustomer($_POST);
    } else {
        $storeCustomer = $callBackFunction -> storeCustomer($inputData);
    }

    echo $storeCustomer;

} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' method not allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>
