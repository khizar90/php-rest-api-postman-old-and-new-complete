<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Orgin: *');
header('Access-Control-Allow-Methods: GET');

$mysql = mysqli_connect("localhost","root","","testing") or die("connection failed");


if(@$_GET["page"] && @$_GET["row_per_page"]){

    $page = $_GET["page"];
    $row_per_page = $_GET["row_per_page"];
    $begin = $offset = ($page - 1) * $row_per_page;
        
    $sql= "SELECT *FROM students LIMIT {$offset},{$row_per_page}";
    $table_data = $mysql->query($sql);
    

    $data= array();

    while($row = $table_data->fetch_array(MYSQLI_ASSOC)){
        $data[]= $row;
        
    }
    if(count($data)> 0){
        echo json_encode(array('action'=> 'Data found','data'=>$data,'status'=>true,  'errors'=>[]));
    }else{
        echo json_encode(array('action' => 'no record found', 'data'=> [], 'status'=>false ,'error'=>[]));
    }

   
}else{
    echo json_encode(array('action' => 'invalid request', 'data'=> [], 'status'=>false ,'error'=>[]));
}

















// header('Content-Type: application/json');
// header('Access-Control-Allow-Orgin: *');
// require_once 'config.php';


// $pagination = new Student();
// $pagination->pagination();
?>
