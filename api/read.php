<?php
/**
 * Returns the list of policies.
 */
require 'database.php';

$policies = [];
$sql = "SELECT id,fname,lname,c_no,c_email,c_for,c_msg FROM contacts";

if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $policies[$i]['id']    = $row['id'];
    $policies[$i]['fname'] = $row['fname'];
    $policies[$i]['lname'] = $row['lname'];
    $policies[$i]['c_no'] = $row['c_no'];
    $policies[$i]['c_email'] = $row['c_email'];
    $policies[$i]['c_for'] = $row['c_for'];
    $policies[$i]['c_msg'] = $row['c_msg'];
    $i++;
  }

  echo json_encode($policies);
}
else
{
  http_response_code(404);
}