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
    $description = $_POST['description'];
    $buf = $_POST['category'];
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        print_r($row);
        if ($buf == $row['title']) {
            $category = $row['id'];
        }
    }
    $sql = "SELECT * FROM articles";
    $result = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if ($row['title'] == $title){
            echo "Title exists.<br>";
            return;
        }
    }
    preg_match("/^[0-9]+([.][0-9]([0-9])?)?$/", $price, $matches);
    if ($title && $image && $price && count("$matches"))
    {
        $sql = "INSERT INTO articles".
            "(title, image, category, price, description)".
            " VALUES('$title', '$image', '$category', '$price', '$description')";
        if (mysqli_query($con, $sql)) {
            echo "Product created!<br>";
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
