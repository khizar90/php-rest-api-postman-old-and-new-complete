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

    if(@$_POST["id"] && @$_POST["fname"] && @$_POST["email"] && @$_POST["sphone"] && @$_POST["scourse"]){

        $dublicate = mysqli_query($conn, "SELECT * FROM students WHERE email='$_POST[email]'");
        if(mysqli_num_rows($dublicate) > 0){
            echo json_encode(array('action' => 'data not update','status'=>false,'data'=> [], 'errors'=>['email already exist','data'] ));
         }else{
            $sql = "UPDATE  students set fullname='{$_POST["fname"]}', email='{$_POST["email"]}', phone='{$_POST["sphone"]}', course='{$_POST["scourse"]}' WHERE id='{$_POST["id"]}'";
            mysqli_query($conn,$sql); 
            echo json_encode(array('action' => 'record updated sucessfully','status'=>true,'data'=> [], 'errors'=>[]));
        }
    }else{
        echo json_encode(array('action' => 'data not update', 'status'=>false,'data'=> [],'errors'=>['you have to enter all filed']));
    }   
}



























// header('Content-Type: application/json');
// header('Access-Control-Allow-Orgin: *');
// header('Access-Control-Allow-Methods: PUT');
// header('Access-Control-Allow-Header: Acess-Control-Allow-Header,Content-Type,Acess-Control-Allow-Methods,Authorization,X-Requested-With');



// include 'config.php';
// $update = new Student();
// $output = $update->updateinto();

// if($output == 0){
//     echo json_encode(array('action' => 'record not update','data'=>[], 'status'=>false,'error'=>['email already exiist']));
// }elseif($output == 1){
//     echo json_encode(array('action' => 'record not update', 'status'=>false , 'error'=>['please fill all field']));
// }else{
//     echo json_encode(array('action' => 'record uupdate sucessfully', 'data'=>[$output], 'status'=>true,'error'=>[]));
// }
























// $data = json_decode(file_get_contents("php://input"),true);
// $id = $data['sid'];
// $student_name = $data['fname'];
// $student_email = $data['email'];
// $student_phone = $data['sphone'];
// $student_course = $data['scourse'];


// $sql = "UPDATE  students set fullname='{$student_name}', email='{$student_email}', phone='{$student_phone}', course='{$student_course}' WHERE id='{$id}'";


// if(mysqli_query($conn,$sql)){
//     echo json_encode(array('message' => 'student record updated', 'status'=>true));
// }else{
//     echo json_encode(array('message' => 'no record updates', 'status'=>false));

// }
?>