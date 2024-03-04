<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include 'functions.php';

$callBackFunction = new callBackCrudFunctions();

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "PUT") {

    $inputData = json_decode(file_get_contents("php://input"), true);

    if (empty($inputData)) {
        $updateCustomer = $callBackFunction -> updateCustomer($_POST, $_GET);
    } else {
        $updateCustomer = $callBackFunction -> updateCustomer($inputData, $_GET);
    }

    echo $updateCustomer;

} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . ' method not allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>
