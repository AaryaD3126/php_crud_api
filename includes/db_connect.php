<?php
$localhost = "localhost";
$username = "root";
$password = "";
$database = "php_crud_api";

$connection = mysqli_connect($localhost, $username, $password, $database);

if ($connection) {
    $connection = true 
} else {
	$connection = false 
    echo "Connection error: " . mysqli_connect_error();
}
?>
