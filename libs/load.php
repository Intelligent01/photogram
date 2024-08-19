<?php

function load_template($name){
    include_once $_SERVER['DOCUMENT_ROOT']."/_templates/_".$name.".php";
}

function credentials($email,$password){
    if($email == "test@gmail.com" && $password == "1234" ){
        return true;
    }else return false;
}

?>