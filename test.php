<pre>


<?php
include "libs/load.php";
// print_r($_SERVER);
// print_r($_GET);
// print_r($_POST);

Session::start();
setcookie("name", "poorna", time() + 10, "/");
print_r($_SESSION);


if (Session::isset('a')) {
    echo "session is already created value : ".Session::get('a');
} else {

    Session::set('a', time());
    echo "session is  created value : ".Session::get('a');
}

if (isset($_COOKIE['a'])) {
    echo "session is already created value : $_COOKIE[a]";
} else {

    $_COOKIE["a"] = time();
    echo "session is  created value : $_COOKIE[a]";
}


print_r(password_algos());
$password_hash = password_hash("hello", PASSWORD_DEFAULT, ["cost" => 11]);

echo $password_hash.'<br>';
print_r(password_get_info($password_hash));

?>
</pre>