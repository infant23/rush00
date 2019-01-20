<?php
include("./header.php");
session_start();
require_once('./connect.php');
$con = connect();
echo '<table style=\'border: dotted; row;\'>  <tr>
    <th>Order_id</th>
    <th>User_id</th>
    <th>Price</th>
     <th>Date</th>
    <th></th>
  </tr>';
if ($con){
    $sql = "SELECT * FROM orders";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $id = $row['id'];
        $user_id = $row['user_id'];
        $price= $row['price'];
        $datetime= $row['datetime'];
            echo "<tr>
             <td>$id</td>
              <td>$user_id</td>
                <td>$price</td>
            <td>$datetime</td>
             </tr>";
    }
    echo "</table>";
}
include("./bottom.php");
?>
