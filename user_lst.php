<?php
include("./header.php");
require_once("./is_admin.php");
if (!is_admin()) {
    echo "You don't have admin permissions<br>";
    return;
}
require_once("./connect.php");
echo "
    <table>
    <tr>
    <th>#</th>
    <th>Login</th>
    <th>Password</th>
    <th>Role</th>
    </tr>";
$con = connect();
if ($con) {
    $sql = "SELECT login, password, role FROM users";
    $retval = mysqli_query($con,$sql);
    $i = 0;
    while ($ret = mysqli_fetch_array($retval)) {
        echo "<tr>";
        echo "<th>" . $i . "</td>";
        echo "<td>" . $ret['login'] . "</td>";
        echo "<td>" . $ret['password'] . "</td>";
        echo "<td>" . $ret['role'] . "</td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    mysqli_close($con);
}
include("./footer.php");
?>
