<?php

include_once "libs/load.php";
echo "<h1> login page </h1> <br>";


$result = null;

print_r($_SESSION);




if (isset($_GET['logout'])) {
    if (Session::get('session_token')) {
        $session = new UserSession(Session::get('session_token'));
        if ($session->remove_session()) {
            Session::unset();
            Session::destroy();
            echo "your session is removed in db ";
        } else {
            echo "your session is not removed ";
        }
    } else {
        throw new Exception("invalid session already logouted");
    }
} elseif (Session::isset('session_token')) {
    $session = new UserSession(Session::get('session_token'));

    if (UserSession::authorization(Session::get('session_token'))) {
        echo $session->extend_login();
        echo "welcome ";
    } else {

        print_r($_SESSION);
        $session->remove_session();
        Session::destroy();
        echo "invalid session you  are loggout";
    }

} else {

    $username = "loko";
    $password = isset($_GET['pass']) ? $_GET['pass'] : '';
    if (!empty($username) && !empty($password)) {

        UserSession::authenticate($username, $password);
        if (Session::isset('session_token')) {
            echo "login Successful";
        } else {
            echo "login failed";
        }
    } else {
        echo "you need to login <a href=?pass=loki>login Here </a>";
    }
}
