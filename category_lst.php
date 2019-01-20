<?php
include("./header.php");
require_once("./connect.php");
echo "
    <table>
    <tr>
    <th>#</th>
    <th>Title</th>
    </tr>";
$con = connect();
if ($con) {
    $sql = "SELECT title FROM categories";
    $retval = mysqli_query($con,$sql);
    $i = 0;
    while ($ret = mysqli_fetch_array($retval)) {
        echo "<tr>";
        echo "<th>" . $i . "</td>";
        echo "<td>" . $ret['title'] . "</td>";
        echo "</tr>";
        $i++;
    }
    echo "</table>";
    mysqli_close($con);
}
include("./footer.php");
?>
