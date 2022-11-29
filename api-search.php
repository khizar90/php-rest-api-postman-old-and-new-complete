<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Orgin: *');
header('Access-Control-Allow-Methods: POST');


$conn = mysqli_connect("localhost","root","","testing") or die("connection failed");


if(@$_POST["value"]){
    $search_value = $_POST["value"];
    $sql= "SELECT * FROM students  WHERE fullname like '%{$search_value}%'";
    $result = mysqli_query($conn,$sql) or die("query failed");

    if(mysqli_num_rows($result) > 0){
        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode(array('action' => 'Search record here','status'=>true,'data'=> [$output], 'error'=>[]));
    }else{
        echo json_encode(array('action' => 'Search record not found','status'=>false,'data'=> [], 'error'=>[]));
    
    }
}
else{
    echo json_encode(array('action' => 'no record found', 'status'=>false, 'data'=>[], 'error'=>['please enter search item']));
}

































// header('Content-Type: application/json');
// header('Access-Control-Allow-Orgin: *');

// include 'config.php';
// $search = new Student();
// $output = $search->searchfor();

// if($output==1){
//     echo json_encode(array('action' => 'no search result found ','data'=>[], 'status'=>false , 'error'=>[]));
// }else{
//     echo json_encode(array('action' => 'result found ','data'=>[$output], 'status'=>false , 'error'=>[]));
// }


























// $data = json_decode(file_get_contents("php://input"),true);
// $search_value = $data['value'];
// $search_value = isset($_GET['value'])  ? $_GET['value'] : die();

// $sql = "SELECT * FROM students  WHERE fullname like '%{$search_value}%'";
// $result = mysqli_query($conn,$sql) or die("query failed");


// if(mysqli_num_rows($result) > 0){
//     $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
//     echo json_encode($output);
// }else{
//     echo json_encode(array('message' => 'no search result found ', 'status'=>false));

// }
?>
