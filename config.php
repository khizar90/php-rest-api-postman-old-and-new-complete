<?php

class Student{

    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $db_name = "testing";
    public $conn;
   

    //connection//
    public function __construct(){
        $this->conn = mysqli_connect($this->host,$this->user,$this->password,$this->db_name) or die("connection faield");
        if (mysqli_connect_errno($this->conn)){
             echo "Failed to connect to MySQL:" . mysqli_connect_error();
            }
    }


    //read all data//
    public function read(){
        $sql = "SELECT * FROM students";
        $result = mysqli_query($this->conn,$sql) or die("query failed");
        if(mysqli_num_rows($result) > 0){
            return $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
            return 0;
        }   
        
    }


    //read sigle data by id//
    public function fetchSingleById(){
        $data = json_decode(file_get_contents("php://input"),true);

        $student_id = $data['sid']; 
        $sql = "SELECT * FROM students  WHERE id={$student_id}";
        $result = mysqli_query($this->conn,$sql) or die("query failed");
        if(mysqli_num_rows($result) > 0){
            return $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }else{
            return 0;
        
        }
    }


    //insert data into do//
    public function InsertInto(){
        $data = json_decode(file_get_contents("php://input"),true);
        $student_name = $data['fname'];
        $student_email = $data['email'];
        $student_phone = $data['sphone'];
        $student_course = $data['scourse'];
        $all = array(
            'name'=>$student_name, 'email'=>$student_email,'phone'=>$student_phone,'course'=>$student_course
  
          );


        if($student_name !=null &&  $student_email !=null && $student_phone != null && $student_course != null ){

            $dublicate = mysqli_query($this->conn, "SELECT * FROM students WHERE email='$student_email'");


           if(mysqli_num_rows($dublicate) > 0){
            return 1;
            
              }
              else{
                $sql = "INSERT INTO students(fullname, email, phone, course) VALUES ('{$student_name}','{$student_email}','{$student_phone}','{$student_course}')";
                mysqli_query($this->conn,$sql); 
                return $all;
              }

         }
         else{
            return 0;
        }
    }


    //update data//
    public function updateinto(){
        $data = json_decode(file_get_contents("php://input"),true);
        $id = $data['sid'];
        $student_name = $data['fname'];
        $student_email = $data['email'];
        $student_phone = $data['sphone'];
        $student_course = $data['scourse'];
        $all = array(
          'id'=> $id, 'name'=>$student_name, 'email'=>$student_email,'phone'=>$student_phone,'course'=>$student_course

        );
        if($id != null && $student_name !=null &&  $student_email !=null && $student_phone != null && $student_course != null ){
                    $dublicate = mysqli_query($this->conn, "SELECT * FROM students WHERE email='$student_email'");
                    if(mysqli_num_rows($dublicate) > 0){
                        return 0;
              }
              else{
                $sql = "UPDATE  students set fullname='{$student_name}', email='{$student_email}', phone='{$student_phone}', course='{$student_course}' WHERE id='{$id}'";
                mysqli_query($this->conn,$sql);
                return $all;
               
              }

       }else{
        return 1;
           
        
        }
    }


    //delete data//
    
    public function deleteid(){
        $data = json_decode(file_get_contents("php://input"),true);
        $student_id = $data['sid'];
        
        if( $student_id != null){
        $checkid = mysqli_query($this->conn, "SELECT * FROM students WHERE id='$student_id'");
        if(mysqli_num_rows($checkid) == 'sid'){
        
                return 0;
            
        }else{
            $sql = "DELETE FROM students  WHERE id={$student_id}";
            mysqli_query($this->conn,$sql);
            return  $student_id;
        }
        }
        else{
            return 1;
        
        }
    }

    //search data//
    public function searchfor(){
        $data = json_decode(file_get_contents("php://input"),true);
        $search_value = $data['value'];
        $sql = "SELECT * FROM students  WHERE fullname like '%{$search_value}%'";
        $result = mysqli_query($this->conn,$sql) or die("query failed");

        if(mysqli_num_rows($result) > 0){
            $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
            return $output;
        }else{
            return 1;
        
        }
    }

    //pagination//
    public function pagination(){
        $data = json_decode(file_get_contents("php://input"),true);
        $page = $data['page'];
        $limit_per_page = $data['limit_per_page'];
        $offset = ($page - 1) * $limit_per_page;
        
        $sql= "SELECT *FROM students LIMIT {$offset},{$limit_per_page}";
        $result= mysqli_query($this->conn,$sql) or die("query failder");

        if(mysqli_num_rows($result) > 0){
            echo json_encode(array('message' => ' All record are here ', 'status'=>true));
            $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            echo json_encode($output);
        }else{
            echo json_encode(array('message' => 'no result found ', 'status'=>false));
        
        }
        
    }
}



























// $conn = mysqli_connect("localhost","root","","testing") or die("connection faield");

?>
