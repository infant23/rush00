<?php
include("./header.php");
include('./connect.php');
$con = connect();
session_start();
include('./is_admin.php');

if (is_admin() && $con && $_POST['submit'] && $_POST['submit'] == 'OK' && $_POST['title']){
    $tl = $_POST['title'];
    $sql = "SELECT id FROM articles WHERE title='$tl'";
    $res = mysqli_query($con, $sql);
    $ret = mysqli_fetch_row($res);
    if ($res){
        $sql = "DELETE FROM articles WHERE title = '$tl'";
        $ret = $ret[0];
        if (mysqli_query($con, $sql)){
            $sql = "DELETE FROM listOfCategories WHERE product_id = $ret";
            mysqli_query($con, $sql);
            echo "Product deleted";
            header("Location: http://localhost:8800/");
        } else
            echo "Error:".mysqli_error($con);
    } else
        echo "There are no product with this title";
    mysqli_close($con);
}
?>
<form action="remove_product.php" method="POST">
    Enter product title<input type = "text" name="title" required>
    <br />
    <input type="submit" name="submit" value="OK" />
    <br />
    <a href="../index.php">Back to index page</a>
</form>
<?php
include("./bottom.php");
?>