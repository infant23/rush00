<?php
include("./header.php");
?>
    <hr>
    <p>Change password</p>
    <form action="modif.php" method="post" name="modif">
        <br>
        Old password: <input type="password" name="oldpw" value="" maxlength="60">
        <br>
        New password: <input type="password" name="newpw" value="" maxlength="60">
        <br>
        <input type="submit" name="submit" value="OK">
        <input type="reset" name="reset" value="Cencel">
    </form>
    <hr>
<?php
require_once("connect.php");
require_once("auth.php");
session_start();
$login = $_SESSION['loggued_on_user'];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];
echo $login.', '.$oldpw.', '.$newpw.', '.$_POST['submit'].', '.auth($login, $oldpw).'\n';
if ($_POST['submit'] && $_POST['submit'] == "OK" &&  $login && $oldpw && $newpw && strlen($newpw) <= 60 && auth($login, $oldpw)) {
    $con = connect();
    if (!$con) {
        echo "ERROR 1\n";
        return;
    }
    else {
        $hash_newpw = hash("md5", $newpw);
        $sql = "UPDATE users SET password='$hash_newpw' WHERE login='$login'";
        $retval = mysqli_query($con,$sql);
        if (!$retval) {
            echo "ERROR 2\n";
        }
        else {
            echo "OK\n";
        }
    }
    mysqli_close($con);
} elseif (!$login || !$oldpw || !$newpw) {
    echo "Please enter both old and new passwords.\n";
} else {
    echo "ERROR 3\n";
}
include("./footer.php");
?>
