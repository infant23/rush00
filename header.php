<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rushshop</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/menu.css">
</head>
<body>
<?php
include("navbar.php");
session_start();
$cooke = $_SESSION['loggued_on_user'];
if ($cooke)
	echo 'You are logged in as '.$cooke.'<br><hr>';
?>
