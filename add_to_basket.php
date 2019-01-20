<?php
require_once('connect.php');
function add_to_basket($product_id, $number){
    $con = connect();
    session_start();
    if ($con && $product_id && $number && intval($number) > 0)
    {
        if (!$_SESSION['basket'])
            $_SESSION['basket'] = array();
        $basket =  $_SESSION['basket'];
        $sql = "SELECT id FROM articles WHERE id='$product_id'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $row = mysqli_fetch_row($result);
            if ($row) {
                $flag = false;
                foreach ($basket as $id => $n) {
                    if ($id == $product_id){
                        $basket[$id] += $number;
                        $flag = true;
                        break;
                    }
                }
                if (!$flag){
                    $basket[$product_id] = $number;
                }
                $_SESSION['basket'] = $basket;
            } else {
                echo "Wrong product id<br>";
            }
        } else {
            echo "Product doesn't exist";
        }
        mysqli_close($con);
    } else {
        echo "Error".mysqli_error($con);
    }
}
