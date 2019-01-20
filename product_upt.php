<?php
require_once("./is_admin.php");
require_once("./connect.php");
if (!is_admin()) {
    echo "You don't have admin permissions<br>";
    return;
}
$con = connect();
if ($con && $_POST['submit'] && $_POST['submit'] == 'OK'){
    $title = trim($_POST['title']);
    $image = trim($_POST['image']);
    $price = trim($_POST['price']);
    $description = htmlspecialchars($_POST['description']);
    $buf = $_POST['category'];
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($buf == $row['title']) {
            $category = $row['id'];
        }
    }
    $sql = "SELECT * FROM articles WHERE title='$title'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_row($result);
    if (!$row){
        echo "product with this id doesn't exist <br>";
        return;
    }
    preg_match("/^[0-9]+([.][0-9]([0-9])?)?$/", $price, $matches);
    if ($title && $image && $price && count("$matches"))
    {
        $sql = "UPDATE articles SET title='$title', image='$image', price='$price', description='$description' WHERE title='$title'";
        if (mysqli_query($con, $sql)) {
            echo "Product updated!<br>";
            header("Location: http://localhost:8100/");
        } else {
            echo "DB error: " . mysqli_error($con) . "<br>";
        }
    } else {
        echo "Fill all fields.<br>";
    }
mysqli_close($con);
}
?>
