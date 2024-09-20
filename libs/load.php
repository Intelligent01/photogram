<?php


include_once "includes/db.class.php";
include_once "includes/user.class.php";
include_once "includes/sessions.class.php";
include_once "includes/UserSession.class.php";

Session::start();

function load_template($name)
{
    include_once $_SERVER['DOCUMENT_ROOT'].get_config('base_path')."/_templates/_".$name.".php";
}

function credentials($email, $password)
{
    if($email == "test@gmail.com" && $password == "1234") {
        return true;
    } else {
        return false;
    }
}

function get_config($data){
    $json_config = file_get_contents($_SERVER['DOCUMENT_ROOT']."/../photogram.conf.json");
    $config = json_decode($json_config,true);
    return $config[$data];
}

function get_css()
{
    echo "css/".basename($_SERVER['PHP_SELF'], ".php").".css";
}



// }
