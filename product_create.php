<?php
include("./header.php");
require_once("./is_admin.php");
require_once("./connect.php");
if (!is_admin()) {
    echo "You don't have admin permissions<br>";
    return;
}
$con = connect();
if ($con) {
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($con, $sql);
    echo '
    <form action="product_add.php" method="post" name="product">
        Title: <input type="text" placeholder="Enter product title" title="title" name="title" required>
        <br>
        Image: <input type="url" placeholder="Enter image url" title="image" name="image">
        <br>
        Description: <textarea title="description" name="description" placeholder="Description"></textarea>
        <br>
        Price: <input type="number"min="0.00" max="1000000.00" step="0.01" name="price" placeholder="Enter price">
        <br>
        Categories:
        <br>';
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $buf = $row['title'];
        echo "$buf <input type='radio' title='$buf' value='$buf' name='category'><br>";
    }
    mysqli_free_result($result);
    echo '
        <br>
        <input type="submit" name="submit" title="submit" value="OK">
    </form>';
    mysqli_close($con);
}
include("./footer.php");
?>
