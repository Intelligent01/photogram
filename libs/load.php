<?php

function load_template($name){
    include_once $_SERVER['DOCUMENT_ROOT']."/_templates/_".$name.".php";
}

function credentials($email,$password){
    if($email == "test@gmail.com" && $password == "1234" ){
        return true;
    }else return false;
}

function get_css(){
    echo "css/".basename($_SERVER['PHP_SELF'],".php").".css";
}
// function db(){
function signup($username,$email,$password,$phone){
    $servername = "mysql.selfmade.ninja";
    $db_username = "captain";
    $db_password = "Captain@123";
    $database = "captain_ecom";
    
    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);
    
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `auth` (`username`, `email`, `password`, `phone`, `blocked`, `active`)
                    VALUES ('$username', '$email', '$password', '$phone', '0', '1');";

    $error=false;
    try{
        if ($conn->query($sql) === TRUE) {
             $error=false;
    }
    }catch(Exception $e){
     $error=$conn->error;
    }
    return $error;
}

// }
?>