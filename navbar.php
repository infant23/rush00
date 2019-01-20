<hr>
<ul class="navbar">
	<li><a href="http://localhost:8100">Main</a></li>
	<li class="dropdown-button"><a href="http://localhost:8100/print_products.php">All articles</a>
		<ul class="dropdown-content">

<?php
require_once("./connect.php");
$con = connect();
if (!$con) {
    echo "ERROR";
}
else {
	$sql = "SELECT title FROM categories";
	$retval = mysqli_query($con,$sql);
		while ($ret = mysqli_fetch_array($retval)) {
			echo "<li><a href=\"http://localhost:8100/print_c_products.php?category=".$ret['title']."\">".$ret['title']."</a></li>";
		}
}
?>

		</ul>
	</li>
	<li><a href="http://localhost:8100/basket.php">Basket</a></li>

<?php
require_once("./is_admin.php");
session_start();
$cooke = $_SESSION['loggued_on_user'];
if (!$cooke || $cooke == "") {
	echo "<li><a href=\"http://localhost:8100/login.php\">Login</a></li>";
	echo "<li><a href=\"http://localhost:8100/logup.php\">Sign up</a></li>";
}
else {
	echo "<li><a href=\"http://localhost:8100/modif.php\">Change password</a>";
	echo "<li><a href=\"http://localhost:8100/logout.php?submit=Logout\">Logout</a>";
	if (is_admin()) {
		echo "<li class=\"dropdown-button\"><a href=\"http://localhost:8100/admin\">Admin</a>
				<ul class=\"dropdown-content\">
					<li><a href=\"http://localhost:8100/get_orders.php\">Get orders</a></li>
					<li><a href=\"http://localhost:8100/print_categories.php\">Print categories</a></li>
					<li><a href=\"http://localhost:8100/create_category.php\">Create category</a></li>
					<li><a href=\"http://localhost:8100/update_category.php\">Update category</a></li>
					<li><a href=\"http://localhost:8100/remove_category.php\">Remove category</a></li>
					<li><a href=\"http://localhost:8100/print_products.php\">Print products</a></li>
					<li><a href=\"http://localhost:8100/create_product.php\">Create product</a></li>
					<li><a href=\"http://localhost:8100/update_product.php\">Update product</a></li>
					<li><a href=\"http://localhost:8100/remove_product.php\">Remove product</a></li>
					<li><a href=\"http://localhost:8100/user_lst.php\">Print users</a></li>
					<li><a href=\"http://localhost:8100/user_add.php\">Create user</a></li>
					<li><a href=\"http://localhost:8100/user_upt.php\">Update user</a></li>
					<li><a href=\"http://localhost:8100/user_del.php\">Remove user</a></li>
				</ul>
			</li>";
		}
}
?>

</ul>
<hr>
