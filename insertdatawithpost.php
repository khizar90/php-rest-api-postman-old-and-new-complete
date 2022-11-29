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

    if(is_array($jsonDecode)){
        foreach($jsonDecode as $key => $value){
            $_POST[$key] = $value;
        }
    }
    if(@$_POST["fname"] && @$_POST["email"] && @$_POST["sphone"] && @$_POST["scourse"]){

        $dublicate = mysqli_query($conn, "SELECT * FROM students WHERE email='$_POST[email]'");
        if(mysqli_num_rows($dublicate) > 0){
            echo json_encode(array('action' => 'data not inserted','data'=> [], 'status'=>false,'errors'=>['email already exist','data'] ));
         }else{
                $sql = "INSERT INTO students(fullname, email, phone, course) VALUES ('{$_POST["fname"]}','{$_POST["email"]}','{$_POST["sphone"]}','{$_POST["scourse"]}')";
                mysqli_query($conn,$sql); 
                echo json_encode(array('action' => 'record inserted sucessfully','data'=> [], 'status'=>true,'errors'=>[]));
        }
    }else{
        echo json_encode(array('action' => 'data not inserted','data'=> [], 'status'=>false,'errors'=>['you have to enter all filed']));
    }

}


?>