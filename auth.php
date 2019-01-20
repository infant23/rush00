<?php
require_once('./connect.php');
function auth($login, $passwd) {
    if (!$login || !$passwd) {
        return false;
    }
    $con = connect();
    if (!$con)
        return false;
    $sql = "SELECT id,login,password FROM users WHERE login='$login'";
    $retval = mysqli_query($con,$sql);
    $ret = mysqli_fetch_row($retval);
    mysqli_close($con);
    if ($ret[1] == $login && $ret[2] == hash("md5", $passwd)) {
        return $ret[0];
    }
    return false;
}
?>
