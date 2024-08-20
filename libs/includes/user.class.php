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
}
