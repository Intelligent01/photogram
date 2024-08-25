<?php

include_once "libs/load.php";
echo "<h1> login page </h1> <br>";


$username = "loko";
$password = isset($_GET['pass']) ? $_GET['pass'] : '';
$result = null;

if (isset($_GET['logout'])) {
    Session::destroy();
    die("Session destroyd ,<a href=login.php>Login Here</a>");
}

if (Session::get("is_loggin")) {
    $username = Session::get('session_user');
    $userobj = new User($username);
    echo "weclome , ".$userobj->getUsername();
    // $userobj->setBio("what is your name");
    echo "<br>". $userobj->getBio() ;
    $userobj->setBio("welcome");
    echo "<br>". $userobj->getBio() ;
    echo "<br>". $userobj->getDob() ;
    $userobj->setDob("2024-07-23");
    echo "<br>". $userobj->getDob() ;
    

} else {
    echo "no session found , try to login <br>";
    $result = User::login($username, $password);
    echo $result;

    print_r($_SESSION);
    echo Session::get("username");

    if ($result) {
        echo "yout ar e loggined <br>";
        $userobj = new User($username);
        echo "login as , ".$userobj->getUsername();
        Session::set("is_loggin", true);
        Session::set('session_user', $result);
        print_r($_SESSION);
        echo $userobj->id;
    }
}
