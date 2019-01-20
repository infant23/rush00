<?php
include("./header.php");
require_once("./connect.php");
$con = connect();
session_start();
if ($con && $_POST['buy'] && $_POST['buy'] == 'Buy'){
    $basket =  $_SESSION['basket'];
    date_default_timezone_set('Europe/Kiev');
    $d=strtotime("now");
    $time = date("Y-m-d H:i:s", $d);
    $user_id = $_SESSION['user_id'];
    $total_price = trim($_POST['price']);
    $sql = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);
    if (!$row) {
        echo "User doesn't exist!";
        header("Location: http://localhost:8100/login.php");
        return;
    }
    preg_match("/^[0-9]+([.][0-9]([0-9])?)?$/", $total_price, $matches);
    if (count($matches)){
        $sql = "INSERT INTO orders(user_id, price, datetime) VALUES('$user_id','$total_price','$time')";
        $result = mysqli_query($con, $sql);
        if ($result) {
            echo "Order added <br/>";
            $sql = "SELECT id FROM orders WHERE datetime='$time' AND user_id='$user_id'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            if ($row && $basket) {
                $g = $row[0];
                foreach ($basket as $k=>$v) {
                    $sql = "INSERT INTO productsInOrders(order_id, product_id, amount) VALUES('$g','$k', '$v')";
                    $result = mysqli_query($con, $sql);
                    if (!$result)
                        echo mysqli_error($con)."<br>";
                }
            }
        } else {
            echo "Error".mysqli_error($con);
        }
    } else {
        echo "Wrong price";
    }
    mysqli_close($con);
}
include("./footer.php");
?>
