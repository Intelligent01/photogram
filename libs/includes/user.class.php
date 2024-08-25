<?php

class User
{
    private $conn;

    public function __call($name, $arguments)
    {
        $property = preg_replace("/[^0-9A-Za-z]/", "", substr($name, 3));
        $property = strtolower(preg_replace("/\B([A-Z])/", "_$1", $property));


        if (substr($name, 0, 3) == 'get') {
            return $this->get_data($property);
        } elseif (substr($name, 0, 3) == 'set') {
            return $this->set_data($property, $arguments[0]);
        } else {
            throw new Exception("User::__call -> $name function does not exist");
        }

    }


    public function __construct($username)
    {
        if(!$this->conn) {
            $this->conn = Database::connect_db();
        }

        $this->id = null;
        $this->username = $username;
        $sql = "select id from auth where username = '$username' or email = '$username' or id= '$username'";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this-> id = $row['id'];

        } else {
            throw new Exception("invalid user name ,please use a correct user name");
        }

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

        $conn = Database::connect_db();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `auth` WHERE `username` = '$email' OR `email` = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                Session::set('username', $row['username']);
                return $row['username'];
            } else {
                $result = "invalid email or password";
                return false;

            }
            return false;
        }

    }


    private function get_data($key)
    {
        if (!$this->conn) {
            $this->conn = Database::connect_db();
        }
        $sql = "select $key from users where id = $this->id ";
        $result = $this->conn->query($sql);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            return $row[$key];
        } else {
            return false;
        }
    }


    private function set_data($key, $val)
    {
        if (!$this->conn) {
            $this->conn = Database::connect_db();
        }
        $sql = "update users set $key = '$val' where id = '$this->id'";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function getUsername()
    {
        return $this->username;
    }

}
