<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->number) === '' || (float)$request->amount < 0)
  {
    return http_response_code(400);
  }

  // Sanitize.
  $number = mysqli_real_escape_string($con, trim($request->number));
  $amount = mysqli_real_escape_string($con, (int)$request->amount);

  $fname = mysqli_real_escape_string($con, trim($request->fname)); 
  $lname = mysqli_real_escape_string($con, trim($request->lname));
  $c_no = mysqli_real_escape_string($con, trim($request->c_no));
  $c_email = mysqli_real_escape_string($con, trim($request->c_email));
  $c_for = mysqli_real_escape_string($con, trim($request->c_for));
  $c_msg = mysqli_real_escape_string($con, trim($request->c_msg));
  // Create.
  $sql = "INSERT INTO `contacts`(`fname`,`lname`,`c_no`,`c_email`,`c_for`,`c_msg`) VALUES ('{$fname}','{$lname}','{$c_no}','{$c_email}','{$c_for}','{$c_msg}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $policy = [
      'fname' => $fname ,
      'lname' => $lname,
      'c_no' => $c_no,
      'c_email' => $c_email,
      'c_for' => $c_for,
      'c_msg' => $c_msg,
      // 'id'    => mysqli_insert_id($con)
    ];
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}