<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Orgin: *');
header('Access-Control-Allow-Methods: GET');


$mysql = mysqli_connect("localhost","root","","testing") or die("connection failed");


if(@$_GET["id"]){
    $id = $_GET["id"];
    $sql= "SELECT *FROM students WHERE id = {$id}";
    $result = mysqli_query($mysql,$sql) or die("query failed");
    if(mysqli_num_rows($result) > 0){
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode(array('action' => 'read record by id','status'=>true,'data'=> [$output], 'error'=>[]));
    }
    else{
        echo json_encode(array('action' => 'no record found','status'=>false,'data'=> [], 'error'=>['record does not exist']));
    
    }

}
else{
    echo json_encode(array('action' => 'no record found', 'status'=>false , 'data'=>[],'error'=>['please enter id']));
}









// include 'config.php';

// $fetchsingle = new Student();
// $output = $fetchsingle->fetchSingleById();
// if($output == 0)
// echo json_encode(array('action' => 'no record found', 'data'=> [], 'status'=>false, 'error'=>[]));
// else
// echo json_encode(array('action'=> 'Read users','data'=>$output, 'status'=>true, 'errors'=>[]));





























// $data = json_decode(file_get_contents("php://input"),true);
// // $student_id = $data['sid']; 
// $sql = "SELECT * FROM students  WHERE id={$student_id}";
// $result = mysqli_query($conn,$sql) or die("query failed");


// if(mysqli_num_rows($result) > 0){
//     $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
//     echo json_encode($output);
// }else{
//     echo json_encode(array('message' => 'no record found', 'status'=>false));

// }
?>
