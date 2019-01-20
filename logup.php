<?php
include("./header.php");
?>
    <form action="logup.php" method="post" name="logup">
        <p>Sign up</p>
        <br>
        Username: <input type="text" name="login" value="" maxlength="30" />
        <br>
        Password: <input type="password" name="passwd" value="" maxlength="60"/>
        <br>
        <input type="submit" name="submit" value="OK" />
        <input type="reset" name="reset" value="Cencel" />
    </form>
    <hr>
<?php
require_once("./connect.php");
$login =  $_POST['login'];
$passwd = $_POST['passwd'];
if ($_POST['submit'] && $_POST['submit'] == "OK" && $login && $passwd && strlen($login) <= 30 && strlen($passwd) <= 60) {
    $con = connect();
    if ($con) {
        $hash_passwd = hash("md5", $passwd);
        $sql = "INSERT INTO users".
                 "(login, password, role)".
                " VALUES('$login', '$hash_passwd', 'user')";
        $retval = mysqli_query($con,$sql);
        if (!$retval) {
            echo "DB error: ".mysqli_error($con)."<br>";
        }
        else {
            echo "OK\n";
        }
    }
    mysqli_close($con);
} elseif (!$login || !$passwd) {
    echo "Please enter login and passwords.<br>";
} else {
    echo "Wrong form.<br>";
}
include("./footer.php");
?>
