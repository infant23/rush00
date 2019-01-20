<?php
include "header.php";
require_once "connect.php";
include "add_to_basket.php";
include "remove_from_basket.php";
echo "
<!DOCTYPE html>
<html>
<head>
<link rel=\"stylesheet\" href=\"css/basket.css\">
</head>
<body>
<h1 align=\"center\">Basket</h1>
<table style='border: dotted; row;'>
  <tr>
    <th>Title</th>
    <th>Price of one</th>
    <th>Number</th>
    <th></th>
  </tr>
";
$con = connect();
$basket = $_SESSION['basket'];
$price = 0.0;
if ($con && $basket) {
	foreach ($basket as $k => $v) {
		$sql = "SELECT * FROM articles WHERE id ='$k'";
		$result = mysqli_query($con, $sql);
		if ($result) {
			$row = mysqli_fetch_row($result);
			if ($row) {
				echo "<tr>
            <td>$row[1]</td>
             <td>$row[3]</td>
             <td>$v</td>
             <td><form action='remove_from_basket.php' method='get' > <input type='hidden' name='id' value='$k'><input type='submit' name='remove' value='Remove' ></form></td>
            </tr>
        ";
				$price += $row[3] * $v;
			}
		}

	}
}

echo "</table><h2 align=\"right\">Total Price: $price</h2>
<form style='float: right' action='add_order.php' method='post'><input type='hidden' name = 'price' value='$price'><input align='right'
type='submit' id = 'buy' name='buy' value='Buy' ></form>";
include "bottom.php";
?>
