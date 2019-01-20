<?php
include("./header.php");
?>
    <hr>
    <p>Singin</p>
    <form action="login.php" method="get" name="login">
        <br>
        Username: <input type="text" name="login" value="" maxlength="30">
        <br>
        Password: <input type="password" name="passwd" value="" maxlength="60">
        <br>
        <input type="submit" name="submit" value="OK">
        <input type="reset" name="reset" value="Cencel">
    </form>
    <hr>
<?php
require_once("./auth.php");
require_once("./connect.php");
session_start();
$login = $_GET['login'];
$passwd = $_GET['passwd'];
if ($_GET['submit'] && $_GET['submit'] == "OK" && $login && $passwd && auth($login, $passwd))
{
    $con = connect();
    $_SESSION['loggued_on_user'] = $login;
    if ($con) {
        $sql = "SELECT id,login,password FROM users WHERE login='$login'";
        $retval = mysqli_query($con,$sql);
        if ($retval){
            $ret = mysqli_fetch_row($retval);
            if ($ret)
                $_SESSION['user_id'] = $ret[0];
        }
    }
    header("Location: http://localhost:8100");
} elseif (!$login || !$passwd) {
    echo "Please enter login and password.<br>";
} else {
    echo "Wrong form.<br>";
    $_SESSION['loggued_on_user'] = "";
    $_SESSION['user_id'] = "";
}
include("./footer.php");
?>
