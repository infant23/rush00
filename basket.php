<?php
include("./header.php");
include "./add_to_basket.php";
include "./remove_from_basket.php";
require_once("./connect.php");
echo '
    <p>Basket</p>
    <br>
    <table>
    <tr>
    <th>Title</th>
    <th>Price of one</th>
    <th>Number</th>
    <th></th>
    </tr>';
$con = connect();
$basket = $_SESSION['basket'];
if ($con && $basket) {
    foreach ($basket as $k => $v) {
        $sql = "SELECT * FROM articles WHERE id ='$k'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $ret = mysqli_fetch_row($result);
            if ($ret) {
                echo "<tr>";
                echo "<th>" . $ret[1] . "</td>";
                echo "<td>" . $ret[3] . "</td>";
                echo "<td>" . $v . "</td>";
                echo "<td>
                        <form action='remove_from_basket.php' method='get'>
                            <input type='hidden' name='id' value='".$k."'>
                            <input type='submit' name='remove' value='Remove'>
                        </form>
                    </td>";
                echo "</tr>";
                $price += $row[3] * $v;
            }
        }

    }
}
echo "</table>
        <h2>Total Price: $price
        <form style='float: right' action='add_order.php' method='post'>
            <input type='hidden' name = 'price' value='$price'>
            <input align='right' type='submit' id='buy' name='buy' value='Buy' >
        </form></h2>";
include("./footer.php");
?>
