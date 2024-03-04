<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER['REQUEST_METHOD'];
include 'functions.php';

$callBackFunction = new callBackCrudFunctions();


if ($requestMethod == "DELETE"){

			$deleteCustomer = $callBackFunction -> deleteCustomer($_GET);
			echo $deleteCustomer;
	

	}

else{
	$data = [
		'status' => 405,
		'message' => $requestMethod.' method not alllowed',
		

	];
	header("HTTP/1.0 405 Method Not Allowed");
	echo json_encode($data);
}



  ?>
