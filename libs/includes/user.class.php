<?php

class user
{
    private $conn;
    public function __construct()
    {

    }
    public static function signup($username, $email, $password, $phone)
    {

        $conn = Database::connect_db();

        if($conn === null){
            echo "connection failed";
        }
   
        $sql = "INSERT INTO `auth` (`username`, `email`, `password`, `phone`, `blocked`, `active`)
                        VALUES ('$username', '$email', '$password', '$phone', '0', '1');";

        $error = false;
        try {
            if ($conn->query($sql) === true) {
                $error = false;
            }
        } catch(Exception $e) {
            $error = $conn->error;
        }
        return $error;
    }

    public static function login($email, $password)
{

    // Create connection
    $conn = Database::connect_db();

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "select * from auth where email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($row['password'] === $password) {
            return false;
        }
        else {
            $result = "invalid email or password";
        }
        return $result;
    }


}



}
