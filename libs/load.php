<?php


include_once "includes/db.class.php";
include_once "includes/user.class.php";


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



function login($email,$password){
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
    $sql = "select username from auth where email = '$email' and password = '$password'";
    $error=false;
    try {
        if ($conn->query($sql) === true) {
            $error = false;
        }
    } catch(Exception $e) {
        $error = $conn->error;
        echo "--------->success<--------------";
    }
    return $error;


}

// }
?>