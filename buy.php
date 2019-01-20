<?php
require_once("add_to_basket.php");
session_start();
$number =  $_POST['number'];
$product_id = $_POST['product_id'];
if ($_POST['submit'] && $_POST['submit'] == "BUY" && $number && $product_id) {
    add_to_basket(intval($product_id), intval($number));
}
else {
    echo "ERROR 3\n";
}
header("Location: http://localhost:8100/basket.php");
?>
