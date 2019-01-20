<?php
include("./header.php");
require_once("./is_admin.php");
if (!is_admin()) {
    echo "You don't have admin permissions<br>";
    return;
}
require_once("./connect.php");
echo '
    <p>All orders</p>
    <br>
    <table>
    <tr>
    <th>Order_id</th>
    <th>User_id</th>
    <th>Price</th>
    <th>Date</th>
    </tr>';
$con = connect();
if ($con) {
    $sql = "SELECT * FROM orders";
    $retval = mysqli_query($con, $sql);
    $i = 0;
    while ($ret = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<th>" . $ret['id'] . "</td>";
        echo "<td>" . $ret['user_id'] . "</td>";
        echo "<td>" . $ret['price'] . "</td>";
        echo "<td>" . $ret['datetime'] . "</td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    mysqli_close($con);
}
include("./footer.php");
?>
