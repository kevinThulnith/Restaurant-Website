<?php
require_once "../php/DbConnect.php";

function getCustomerList()
{
  global $conn;
  $query_run = mysqli_query($conn, "SELECT user_id, name, address, dob, is_active FROM user WHERE is_customer = 1;");
  if ($query_run) {
    if (mysqli_num_rows($query_run) > 0) {
      $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
      $data = [
        'status' => 200,
        'message' => 'Customer List, Fetched Successfully',
        'data' => $res,
      ];
      header("HTTP/1.0 200 Customer List Fetched Successfully");
      return json_encode($data);
    } else {
      $data = [
        'status' => 404,
        'message' => 'No Customer Found',
      ];
      header("HTTP/1.0 404 No Customer Found");
      return json_encode($data);
    }
  } else {
    $data = [
      'status' => 500,
      'message' => 'Internal server error',
    ];
    header("HTTP/1.0 500 Internal Server Error");
    return json_encode($data);
  }
}
