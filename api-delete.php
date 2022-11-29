<?php


header('Content-Type: application/json');
header('Access-Control-Allow-Orgin: *');
header('Access-Control-Allow-Methods: POST');


$conn = mysqli_connect("localhost","root","","testing") or die("connection failed");

if($conn->connect_error){
    echo "connection failed";

}else{
    $jsonData = json_decode(file_get_contents("php://input"),true);
    $jsonDecode = json_decode($jsonData,true);

    if($_POST["id"] ){
        $checkid = mysqli_query($conn, "SELECT * FROM students WHERE id='{$_POST["id"]}'");
        if(mysqli_num_rows($checkid) == 'id'){
            echo json_encode(array('action' => 'data not delete','data'=>[] , 'status'=>false , 'error'=>['this record does not exist']));
        }
        else{
            $sql = "DELETE FROM students where id= '{$_POST["id"]}'";
            mysqli_query($conn,$sql);
            echo json_encode(array('action' => 'data  deleted','status'=>true,'data'=> [], 'errors'=>[] ));
        }
        }else{
            echo json_encode(array('action' => 'data  not deleted','status'=>false,'data'=> [], 'errors'=>["inavlid request"] ));
        }
        
}
      






























// header('Content-Type: application/json');
// header('Access-Control-Allow-Orgin: *');
// header('Access-Control-Allow-Methods: DELETE');
// header('Access-Control-Allow-Header: Acess-Control-Allow-Header,Content-Type,Acess-Control-Allow-Methods,Authorization,X-Requested-With');

// include 'config.php';
// $insert = new Student ();
//  $output = $insert->deleteid();
// if($output == 0){
//     echo json_encode(array('action' => 'data not delete','data'=>[] , 'status'=>false , 'error'=>['this record does not exist']));
// }
// elseif($output == 1){
//     echo json_encode(array('action' => 'data not delete','data'=>[] ,'status'=>false, 'error'=>['please enetr id to delete']));
// }
// else{
//     echo json_encode(array('action' => 'record delted suceessfully','data'=> ['id'=>$output], 'status'=>true, 'error'=>[]));
// }






















// $data = json_decode(file_get_contents("php://input"),true);
// $student_id = $data['sid'];
// $sql = "DELETE FROM students  WHERE id={$student_id}";


// if(mysqli_query($conn,$sql)){
//     echo json_encode(array('message' => 'record delete', 'status'=>true));
// }else{
//     echo json_encode(array('message' => 'reound not delete', 'status'=>false));

// }
?>
