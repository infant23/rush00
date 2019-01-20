<?php
$id = 9;
include('../connect.php');
$con = connect();
session_start();
include('../is_admin.php');
if (is_admin() && $con && $_POST['submit'] && $_POST['submit'] == 'OK'){
    $con = connect();
    $title = trim($_POST['title']);
    $image = trim($_POST['image']);
    $price = trim($_POST['price']);
    $description = $_POST['description'];
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($con, $sql);
    $cat_arr = array();
    $others = false;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $buf = $row['title'];
        if ($_POST[$buf]) {
            if ($_POST[$buf] == 'others')
                $others = true;
            array_push($cat_arr, $row['id']);
        }
    }
    if (!$others)
        array_push($cat_arr, 'others');
    $sql = "SELECT * FROM articles WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);
        if (!$row){
            echo "product with this id doesn't exist <br>";
            return;
        }
    preg_match("/^[0-9]+([.][0-9]([0-9])?)?$/", $price, $matches);
    if ($title && $image && $price && count($matches))
    {
        $sql = "UPDATE articles SET title='$title', image='$image', price='$price', description='$description' WHERE id='$id'";
        if (mysqli_query($con,$sql)) {
            echo "Product updated!<br>";
            foreach ($cat_arr as $item){
                $sql = "DELETE FROM listOfCategories WHERE product_id = $id";
                mysqli_query($con, $sql);
            }
            foreach ($cat_arr as $item){
                $sql = "INSERT INTO listOfCategories (product_id, category) VALUES('$id', '$item')";
                $result = mysqli_query($con, $sql);
            }
            header("Location: http://localhost:8100/");
        } else {
            echo "Error creating product: " . mysqli_error($con) . "<br>";
        }
    } else {
        echo "Fill all fields <br>";
    }
    mysqli_close($con);
}
?>
