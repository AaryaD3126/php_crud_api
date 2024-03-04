<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER['REQUEST_METHOD'];
include 'functions.php';

$callBackFunction = new callBackCrudFunctions();


if ($requestMethod == "GET"){


	if(isset($_GET['id'])){
			$customer = $callBackFunction -> getCustomer($_GET);
			echo $customer;
	}else{
			$customerList = $callBackFunction -> getCustomerList();
echo $customerList;

	}

}else{
	$data = [
		'status' => 405,
		'message' => $requestMethod.' method not alllowed',
		

	];
	header("HTTP/1.0 405 Method Not Allowed");
	echo json_encode($data);
}



  ?>
