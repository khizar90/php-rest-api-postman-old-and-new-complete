<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Orgin: *');
require_once 'config.php';

$read = new Student();
$output = $read->read();
if($output == 0)
echo json_encode(array('action' => 'no record found', 'data'=> [], 'status'=>false ,'error'=>[]));
else
echo json_encode(array('status'=>true,'data'=>$output, 'action'=> 'Read users', 'errors'=>[]));


























// $sql = "SELECT * FROM students";
// $result = mysqli_query($conn,$sql) or die("query failed");


// if(mysqli_num_rows($result) > 0){
//     $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
//     echo json_encode($output);
// }else{
//     echo json_encode(array('message' => 'no record found', 'status'=>false));
// }
?>