<?php
require '../includes/db_connect.php';

class callBackCrudFunctions
{
    public function getCustomerList()
    {
        global $connection;

        $query = "SELECT * FROM customers";
        $queryRun = mysqli_query($connection, $query);

        if ($queryRun) {
            if (mysqli_num_rows($queryRun) > 0) {
                $res = mysqli_fetch_all($queryRun, MYSQLI_ASSOC);
                $data = [
                    'status' => 200,
                    'message' => 'Customer data fetched',
                    'data' => $res,
                ];
                header("HTTP/1.1 200 OK");
                header('Content-Type: application/json');
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'No customers found',
                ];
                header("HTTP/1.1 404 Not Found");
                header('Content-Type: application/json');
                echo json_encode($data);
            }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal server error',
            ];
            header("HTTP/1.1 500 Internal Server Error");
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }

    public function error422($message)
    {
        $data = [
            'status' => 422,
            'message' => $message,
        ];
        header("HTTP/1.0 422 Unprocessable Entity");
        echo json_encode($data);
    }

    public function storeCustomer($customerInput)
    {
        global $connection;

        $name = mysqli_real_escape_string($connection, $customerInput['name']);
        $email = mysqli_real_escape_string($connection, $customerInput['email']);
        $phone = mysqli_real_escape_string($connection, $customerInput['phone']);

        if (empty(trim($name))) {
            return $this->error422('Enter your name');
        } elseif (empty(trim($email))) {
            return $this->error422('Enter your email');
        } elseif (empty(trim($phone))) {
            return $this->error422('Enter your phone');
        } else {
            $query = "INSERT INTO customers (name, email, phone) VALUES ('$name', '$email', '$phone')";
            $runQuery = mysqli_query($connection, $query);

            if ($runQuery) {
                $data = [
                    'status' => 201,
                    'message' => 'Customer created!',
                ];
                header("HTTP/1.0 201 Created");
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal server error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                echo json_encode($data);
            }
        }
    }


    public function getCustomer($customerParams){

        global $connection;

        if ($customerParams['id'] == null) {
            return $this->error422('Enter your customer ID');

    }
    $customerID = mysqli_real_escape_string($connection, $customerParams['id']);
    $query = "SELECT * FROM customers WHERE id='$customerID' LIMIT 1";
    $runQuery = mysqli_query($connection, $query);
    if($runQuery){
    if(mysqli_num_rows($runQuery) > 0){
        $res = mysqli_fetch_all($runQuery, MYSQLI_ASSOC);

        $data = [
            'status' => 200,
            'message' => 'Customer data fetched',
            'data' => $res,
        ];
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        return json_encode($data);
    }else{
        $data = [
            'status' => 404,
            'message' => 'Customer data not found',
        ];
        header("HTTP/1.1 404 customer data not found");
        header('Content-Type: application/json');
        return json_encode($data);
    }
    
}else{
    $data = [
        'status' => 500,
        'message' => 'internal server error',
    ];
    header("HTTP/1.1 500 internal server error");
    header('Content-Type: application/json');
    return json_encode($data);
}
}

public function updateCustomer($customerInput, $customerParams){
    global $connection;

        if(!isset($customerParams['id'])){
            return $this->error422('customer id not found');

        }elseif($customerParams['id'] == null){
            return $this->error422('Enter customer ID');
        }

      $customerID = mysqli_real_escape_string($connection, $customerParams['id']);  

        $name = mysqli_real_escape_string($connection, $customerInput['name']);
        $email = mysqli_real_escape_string($connection, $customerInput['email']);
        $phone = mysqli_real_escape_string($connection, $customerInput['phone']);

        if (empty(trim($name))) {
            return $this->error422('Enter your name');
        } elseif (empty(trim($email))) {
            return $this->error422('Enter your email');
        } elseif (empty(trim($phone))) {
            return $this->error422('Enter your phone');
        } else {
            $query = "UPDATE customers SET name='$name', email='$email', phone='$phone' WHERE id='$customerID'";
            $runQuery = mysqli_query($connection, $query);

            if ($runQuery) {
                $data = [
                    'status' => 201,
                    'message' => 'Customer updated!',
                ];
                header("HTTP/1.0 200 success");
                echo json_encode($data);
            } else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal server error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                echo json_encode($data);
            }
        }

}

public function deleteCustomer($customerParams){
    global $connection;

    if(!isset($customerParams['id'])){
        return $this->error422('customer id not found');

    }elseif($customerParams['id'] == null){
        return $this->error422('Enter customer ID');
    }

  $customerID = mysqli_real_escape_string($connection, $customerParams['id']);  

  $query = "DELETE FROM customers WHERE id='$customerID' LIMIT 1";
  $res = mysqli_query($connection, $query);

  if($res){
    $data = [
        'status' => 200,
        'message' => 'customer deleted!',
    ];
    header("HTTP/1.0 200 ok");
    echo json_encode($data);
  }else
  {
    $data = [
        'status' => 500,
        'message' => 'Internal server error',
    ];
    header("HTTP/1.0 500 Internal Server Error");
    echo json_encode($data);
  }

}

}
?>
