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

    // if(is_array($jsonDecode)){
    //     foreach($jsonDecode as $key => $value){
    //         $_POST[$key] = $value;
    //     }
    // }
    
    if(@$_POST["fname"] && @$_POST["email"] && @$_POST["sphone"] && @$_POST["scourse"]){


        $dublicate = mysqli_query($conn, "SELECT * FROM students WHERE email='$_POST[email]'");
        if(mysqli_num_rows($dublicate) > 0){
            echo json_encode(array('action' => 'data not inserted','status'=>false,'data'=> [], 'errors'=>['email already exist','data'] ));
         }else{
                $sql = "INSERT INTO students(fullname, email, phone, course) VALUES ('{$_POST["fname"]}','{$_POST["email"]}','{$_POST["sphone"]}','{$_POST["scourse"]}')";
                mysqli_query($conn,$sql); 
                echo json_encode(array('action' => 'record inserted sucessfully','status'=>true,'data'=> [], 'errors'=>[]));
        }
    }else{
        echo json_encode(array('action' => 'data not inserted', 'status'=>false,'data'=> [],'errors'=>['you have to enter all filed']));
    }

}






















// header('Content-Type: application/json');
// header('Access-Control-Allow-Orgin: *');
// header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Header: Access-Control-Allow-Header,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');






// include 'config.php';
// $insert = new Student();
// $output=$insert->InsertInto();

// if($output==1)
// {
//     echo json_encode(array('action' => 'data not inserted','data'=> [], 'status'=>false,'errors'=>['email already exist','data'] ));   
// }
// elseif($output == 0){
//     echo json_encode(array('action' => 'data not inserted','data'=> [], 'status'=>false,'errors'=>['you have to enter all filed']));
// }
// else{
//     echo json_encode(array('action' => 'record inserted sucessfully','data'=> [$output], 'status'=>true,'errors'=>[]));
// }


































// die();
// $obj = new \stdClass();
// $obj->page

//   $literalObjectDeclared = (object) array(
//      'foo' => (object) array(
//           'bar' => 'baz',
//           'pax' => 'vax'
//       ),
//       'moo' => 'ui'
//    );
// print $literalObjectDeclared->foo->bar; 
// // outputs "baz"!






// $data = json_decode(file_get_contents("php://input"),true);
// $student_name = $data['fname'];
// $student_email = $data['email'];
// $student_phone = $data['sphone'];
// $student_course = $data['scourse'];
// $sql = "INSERT INTO students(fullname, email, phone, course) VALUES ('{$student_name}','{$student_email}','{$student_phone}','{$student_course}')";


// if(mysqli_query($conn,$sql)){
//     echo json_encode(array('message' => 'student record insert', 'status'=>true));
// }else{
//     echo json_encode(array('message' => 'no record inserted', 'status'=>false));

// }
?>