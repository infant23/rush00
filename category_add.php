<?php
include("./header.php");
?>
    <form action="category_add.php" method="post">
        Title: <input type="text" placeholder="Enter category title" title="title" max="100" name="title" required>
        <br>
        <input type="submit" name="submit" title="submit" value="OK">
    </form>
    <hr>
<?php
require_once("./is_admin.php");
require_once("./connect.php");
if (!is_admin()) {
    echo "You don't have admin permissions<br>";
    return;
}
$title = $_POST['title'];
if ($_POST['submit'] && $_POST['submit'] == "OK" && $title && $title == "others") {
    echo "You couldn't name category others.<br>";
} elseif ($_POST['submit'] && $_POST['submit'] == "OK" && $title && strlen($title) <= 100) {
    $con = connect();
    if ($con) {
        $sql = "SELECT * FROM categories WHERE title='$title'";
        $retval = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($retval);
        if ($row) {
            echo "Category exist.<br>";
        } else {
            $sql = "INSERT INTO categories(title) VALUES ('$title')";
            $retval = mysqli_query($con, $sql);
            if (!$retval) {
                echo "DB error: ".mysqli_error($con)."<br>";
            }
            else {
                echo "OK\n";
                header("Location: http://localhost:8100/");
            }
        }
    mysqli_close($con);
    }
} elseif ($_POST['submit'] && $_POST['submit'] == "OK" && $title) {
    echo "Too long title.<br>";
} elseif (!$title) {
    echo "Please enter title.<br>";
} else {
    echo "Wrong form.<br>";
}
include("./footer.php");
?>
