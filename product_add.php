<?php
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
                echo $_POST[$row['title'] . "<br>"];
                array_push($cat_arr, $row['id']);
            }
        }
        if (!$others)
            array_push($cat_arr, 'others');
        $sql = "SELECT * FROM articles";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if ($row['title'] == $title){
                echo "title exists <br>";
                return;
            }
        }
        preg_match("/^[0-9]+([.][0-9]([0-9])?)?$/", $price, $matches);
        if ($title && $image && $price && count("$matches"))
        {
            $sql = "INSERT INTO articles".
                "(title, image, price, description)".
                " VALUES('$title', '$image', '$price', '$description')";
            if (mysqli_query($con,$sql)) {
                echo "Product created!<br>";
                $sql = "SELECT * FROM articles WHERE title='$title'";
                $retval = mysqli_query($con,$sql);
                $ret = mysqli_fetch_row($retval);
                $ret = $ret[0];
                foreach ($cat_arr as $item){
                    $sql = "INSERT INTO listOfCategories (product_id, category) VALUES('$ret', '$item')";
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
