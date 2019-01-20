<?php
if(isset($_GET['remove'])){
    remove_from_basket($_GET['id']);
}
function remove_from_basket($product_id){
    session_start();
    $basket =  $_SESSION['basket'];
    if ($basket){
        unset($basket[$product_id]);
        var_dump($basket);
        $_SESSION['basket'] = $basket;
    }
    header("Location: http://localhost:8100/basket.php");
}
