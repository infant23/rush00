<?php
include("./header.php");
?>
    <form action="category_upt.php" method="post">
        <p>Update category</p>
        <br>
        Old title: <input type="text" placeholder="Choose category title" title="old_title" max="100" name="old_title" required>
        <br>
        Title: <input type="text" placeholder="Enter new category title" title="title" max="100" name="title" required>
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
$old_title = $_POST['old_title'];
$title = $_POST['title'];
if ($_POST['submit'] && $_POST['submit'] == "OK" && $title && $title == "others") {
    echo "You couldn't name category others.<br>";
} elseif ($_POST['submit'] && $_POST['submit'] == "OK" && $old_title && $title && strlen($title) <= 100) {
    $con = connect();
    if ($con) {
        $sql = "SELECT * FROM categories WHERE title='$old_title'";
        $retval = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($retval);
        if (!$row) {
            echo "Category doesn't exist.<br>";
        } else {
            $sql = "SELECT * FROM categories WHERE title='$title'";
            $retval = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($retval);
            if ($row) {
                echo "Category exist.<br>";
            } else {
                $sql = "UPDATE categories SET title='$title' WHERE title='$old_title'";
                $retval = mysqli_query($con, $sql);
                if (!$retval) {
                    echo "DB error: ".mysqli_error($con)."<br>";
                }
                else {
                    echo "OK\n";
                    header("Location: http://localhost:8100/");
                }
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
