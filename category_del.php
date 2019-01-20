<?php
include("./header.php");
?>

<hr>
<form action="category_del.php" method="post" name="category_del">
    <p>Delete category</p>
    <br>
    Title: <input type="text" placeholder="Enter category title" title="title" max="100" name="title" required>
        <br>
    <input type="submit" name="submit" value="OK">
    <input type="reset" name="reset" value="Cencel">
</form>
<hr>

<?php
require_once("./is_admin.php");
require_once("./connect.php");
if (!is_admin()) {
    echo "You don't have admin permissions<br>";
    return;
}
$title =  $_POST['title'];
if ($_POST['submit'] && $_POST['submit'] == "OK" && $title) {
    $con = connect();
    if ($con) {
        $sql = "SELECT id FROM categories WHERE title='$title'";
        $retval = mysqli_query($con, $sql);
        $ret = mysqli_fetch_row($res);
        if (!$retval) {
            echo "DB error: ".mysqli_error($con)."<br>";
        }
        else {
            $sql = "DELETE FROM categories WHERE title='$title'";
            $ret = $ret[0];
            if (mysqli_query($con, $sql)) {
                $sql = "DELETE FROM listOfCategories WHERE product_id = '$ret'";
                mysqli_query($con, $sql);
                echo "Product deleted.<br>";
                header("Location: http://localhost:8100/");
            } else
                echo "DB error: ".mysqli_error($con)."<br>";
            echo "OK\n";
        }
        mysqli_close($con);
    }
} elseif (!$title) {
    echo "Please enter title.<br>";
} else {
    echo "Wrong form.<br>";
}
include("./footer.php");
?>
