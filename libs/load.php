<?php


include_once "includes/db.class.php";
include_once "includes/user.class.php";


function load_template($name)
{
    include_once $_SERVER['DOCUMENT_ROOT']."/_templates/_".$name.".php";
}

function credentials($email, $password)
{
    if($email == "test@gmail.com" && $password == "1234") {
        return true;
    } else {
        return false;
    }
}

function get_css()
{
    echo "css/".basename($_SERVER['PHP_SELF'], ".php").".css";
}



function login($email, $password)
{
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
    $sql = "select * from auth where email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row['password'] === $password) {
            echo $row['password'];
            return false;
        }
        else {
            $result = "invalid email or password";
        }
        return $result;
    }


}

// }
