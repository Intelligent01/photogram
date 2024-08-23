<?php

class User
{
    private $conn;
    public function __construct()
    {

    }
    public static function signup($username, $email, $password, $phone)
    {

        $conn = Database::connect_db();
        $password = password_hash($password, PASSWORD_ARGON2I, ['cost' => 10]);
        if($conn === null) {
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

        // $password = password_hash($password, PASSWORD_ARGON2I, ['cost' => 10]);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "<p class=bg-primary>".$password."</p><br>";
        echo "<p class=bg-primary>".$password."</p><br>";
        echo "<p class=bg-primary>".$password."</p><br>";


        $sql = "SELECT * FROM `auth` WHERE `username` = '$email' OR `email` = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return $row['username'];
                echo $row['password'];
            } else {
                $result = "invalid email or password";
                echo $password."<br>";
                echo $row['password'];
                return false;

            }
            return false;
        }


    }



}
