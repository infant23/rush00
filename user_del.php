<?php
include("./header.php");
?>

<hr>
<form action="user_del.php" method="post" name="user_del">
    <p>Delete user</p>
    <br>
    Username: <input type="text" name="login" value="" maxlength="30" />
    <br>
    <input type="submit" name="submit" value="OK" />
    <input type="reset" name="reset" value="Cencel" />
</form>
<hr>

<?php
require_once("./is_admin.php");
require_once("./connect.php");
if (!is_admin()) {
    echo "You don't have admin permissions<br>";
    return;
}
$login =  $_POST['login'];
if ($_POST['submit'] && $_POST['submit'] == "OK" && $login && strlen($login) <= 30) {
    $con = connect();
    if ($con) {
        $hash_passwd = hash("md5", $passwd);
        $sql = "DELETE FROM users WHERE login='$login'";
        $retval = mysqli_query($con,$sql);
        if (!$retval) {
            echo "DB error: ".mysqli_error($con)."<br>";
        }
        else {
            echo "OK\n";
        }
    }
    mysqli_close($con);
} elseif (!$login) {
    echo "Please enter login.<br>";
} else {
    echo "Wrong form.<br>";
}
include("./footer.php");
?>
