<?php
include("header.php");
require_once("./connect.php");
session_start();
$category = $_GET['category'];
if ($category) {
    echo "<table border='1'>
    <tr>
    <th>#</th>
    <th>Title</th>
    <th>Image</th>
    <th>Price</th>
    <th>Description</th>
    </tr>";
    $con = connect();
    if (!$con) {
        echo "ERROR 1\n";
        return;
    }
    else {
        $sql = "SELECT id, title, image, price, description FROM articles INNER JOIN listofcategories ON articles.id=listofcategories.product_id WHERE listofcategories.category='$category'";
        $retval = mysqli_query($con,$sql);
        $i = 0;
        while ($ret = mysqli_fetch_array($retval)) {
            echo "<tr>";
            echo "<th>" . $i . "</td>";
            echo "<td>" . $ret['title'] . "</td>";
            echo "<td>" . "<img src=\"" . $ret['image'] . "\" width=\"320\" height=\"240\" onerror=\"this.src='default-image.jpg';\" alt=\"" . $ret['title'] . "\">". "</td>";
            echo "<td>" . $ret['price'] . "</td>";
            echo "<td>" . $ret['description'] . "</td>";
            echo "<td>";
            $product = $ret['id'];
            echo "<form action=\"./buy.php\" method=\"post\" name=\"buy\">
            <p>buy</p>
            <br>
            Amount: <input type=\"number\" name=\"number\" placeholder=\"1\" step=\"1\" value=\"1\" />
            <br>
            <input type=\"hidden\" name=\"product_id\" value=\"$product\" />
            <input type=\"submit\" name=\"submit\" value=\"BUY\" />
            <input type=\"reset\" name=\"reset\" value=\"Cencel\" />
            </form>";
            echo "</td>";
            echo "</tr>";
            $i++;
        }
        echo "</table>";
        mysqli_close($con);
    }
}
include("./footer.php");
?>
