<?php

function load_template($name){
    include_once $_SERVER['DOCUMENT_ROOT']."/_templates/_".$name.".php";
}
?>