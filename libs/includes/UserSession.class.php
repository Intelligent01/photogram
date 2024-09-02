<?php

class UserSession
{
    public function __construct($token)
    {
        $this->conn = Database::connect_db();
        $this->token = $token;
        $this->data = null;

        $sql = "select * from session where token = '$this->token' ";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $this->data = $row;
            $this->uid = $row['uid'];
        } else {
            throw new Exception("session time out ");
        }

    }

    // this funcc
    public static function authenticate($user, $pass)
    {


        $username = User::login($user, $pass);
        $user = new User($username);

        if ($username) {
            $conn = Database::connect_db();
            $ip = $_SERVER['REMOTE_ADDR'];
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $token = md5(rand(0, 999999).$ip.$agent.time());
            $sql = "INSERT INTO `session` (`uid`, `login_time`, `token`, `ip`, `user_agent`, `active`)
                    VALUES ('$user->id', now(), '$token', '$ip', '$agent', '1');";
            if ($conn->query($sql)) {
                Session::set("session_token", $token);
                return $token;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function authorization($token)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $agent = $_SERVER['HTTP_USER_AGENT'];

        try {
            $session = new UserSession($token);

            if (isset($ip) && isset($agent)) {
                if ($session->is_activate() && $session->is_valid()) {
                    if ($ip == $session->get_ip()) {
                        if ($agent == $session->get_user_agent()) {
                            return true;
                        } else {
                            throw new Exception("wrong user_agent");
                        }
                    } else {
                        throw new Exception("wrong IP address");
                    }
                } else {
                    throw new Exception("this is not at active anymore");
                }
            } else {
                throw new Exception("IP and user agent is null ");
            }

        } catch (Exception $e) {
            return false;
        }

    }

    public function getUser()
    {
        return new User($this->uid);
    }

    public function is_valid()
    {

        if (isset($this->data['login_time'])) {
            $login_time = strtotime($this->data['login_time']);
            if ((time() - $login_time) > 120) {
                return false;
            } else {
                return true;
            }
        } else {
            throw new Exception("login time is null");
        }


    }

    public function get_ip()
    {
        return $this->data['ip'];

    }

    public function get_user_agent()
    {
        return $this->data['user_agent'];
    }

    public function is_activate()
    {
        return $this->data['active'];
    }

    public function deactivate()
    {
        return $this->data['active'] = 0;
    }

    public function extend_login()
    {
        if (!$this->conn) {
            $this->conn = Database::connect_db();
        }
        $sql = "update session set login_time = now() where uid = '$this->uid'";
        $result = $this->conn->query($sql);
        return $result;
    }


    public function remove_session()
    {
        if (isset($this->data['id'])) {
            if (!$this->conn) {
                $this->conn = Database::connect_db();
            }
            $id = $this->data['id'];
            $sql = "DELETE FROM `session`WHERE ((`id` = '$id'));";
            $result = $this->conn->query($sql);
            return $result ? true : false;
        } else {
            throw new Exception("id is not in date_add");
        }
    }

}
