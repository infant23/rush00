<?php
session_start();
if ($_GET['submit'] && $_GET['submit'] == "Logout") {
	$_SESSION['loggued_on_user'] = "";
	$_SESSION['user_id'] = "";
    $_SESSION['basket'] = "";
}
header("Location: http://localhost:8100");
?>
