<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

require_once 'functions.php';

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
  $inputData = json_decode(file_get_contents("php://input"), true);
  if (empty($inputData)) {
    echo $_POST['name'];
  } else {
    echo $inputData['name'];
  }
} else {
  $data = [
    'status' => 405,
    'message' => $requestMethod . ' Method Not Allowed',
  ];
  header("HTTP/1.0 405 Method Not Allowed");
  echo json_encode($data);
}
