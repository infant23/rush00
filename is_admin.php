<?php
require_once("./connect.php");
function is_admin() {
    session_start();
    $cooke = $_SESSION['loggued_on_user'];
    if (!$cooke || $cooke == "") {
        return false;
    }
    else {
        $con = connect();
        if (!$con) {
            return false;
        }
        else {
            $sql = "SELECT role FROM users WHERE login='$cooke'";
            $retval = mysqli_query($con,$sql);
            $ret = mysqli_fetch_row($retval);
            mysqli_close($con);
            if ($ret[0] != 'admin') {
                return false;
            }
        }
        return true;
    }
}
?>
