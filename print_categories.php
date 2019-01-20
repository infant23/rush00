<?php
include("./header.php");
require_once("./connect.php");
echo "<table border='1'>
<tr>
<th>#</th>
<th>Title</th>
</tr>";
$con = connect();
if (!$con) {
    echo "ERROR 1\n";
    return;
}
else {
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
include("./bottom.php");
?>
