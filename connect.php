<?php
function connect() {
    $hostname = "localhost";
    $username = "root";
    $passoword = "qwerty";
    $db = "rushshop";
    $con=mysqli_connect($hostname,$username,$passoword, $db);
    if (!$con){
        echo "DB error: ".mysqli_connect_error()."<br>";
    }
    return ($con);
}
?>
