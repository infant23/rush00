<?php
session_start();
include('../connect.php');
$con = connect();
include('../is_admin.php');

if (is_admin() && $con) {
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($con, $sql);
    echo '
<html><head>
	<meta charset="UTF-8">
	<title>Rushshop</title>
	<link rel="stylesheet" href="menu.css">
</head><body>';
    include("../navbar.php");
    echo'
<form action="check_update.php" method="post" style="border:1px solid #ccc">
    Title<input type="text" placeholder="Enter product title" title="title" name="title" required>
    <br />
    Image<input type="url" placeholder="Enter image url" title="image" name="image">
    <br />
    <textarea style="resize: none" rows="4" cols="50">Description</textarea>
    <br />
    Price<input type="number"min="0.00" max="1000000.00" step="0.01" name="price" placeholder="Enter price">
    <br />
    Categories
    <br/>
    others<input type="checkbox" name = "others" value="others" title="others"><br/>
';
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $buf = $row['title'];
        echo "$buf<input type='checkbox' title='$buf' value='$buf' name='$buf'><br/>";
    }
    mysqli_free_result($result);
    echo '
    <br>
    <input type="submit" name="submit" title="submit" value="OK" />
</form>
</body></html>';
    mysqli_close($con);
}
?>
