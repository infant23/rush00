<?php
$hostname = "localhost";
$username = "root";
$passoword = "qwerty";
$database = "rushshop";

$con=mysqli_connect($hostname,$username,$passoword);
if (!$con){
    echo "Connection error ".mysqli_connect_error()."<br>";
    return;
}
$sql="CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($con,$sql)) {
    echo "Database $database connected successfully<br>";
    mysqli_select_db($con,$database);
} else {
    echo "Error connecting database: " .mysqli_error($con);
    echo "<br>";
}
$tablename = "users";
$sql= "CREATE TABLE $tablename(".
    "id INT(10) AUTO_INCREMENT PRIMARY KEY,".
    "login CHAR(30) UNIQUE NOT NULL,".
    "password CHAR(60) NOT NULL,".
    "role VARCHAR(5) DEFAULT 'user')";
if (mysqli_query($con,$sql)) {
    echo "Table $tablename successfully created!\n";
} else {
    echo "Error creating table $tablename: " . mysqli_error($con) . "<br>";
}
$sql = "SELECT login FROM users WHERE login='admin'";
$retval = mysqli_query($con,$sql);
$ret = mysqli_fetch_row($retval);
if (!$ret || !$ret[0]){
    $psswd = hash('md5', 'admin');
    $sql = "INSERT INTO $tablename".
        "(login, password, role)".
        " VALUES('admin', '$psswd', 'admin')";
    if (mysqli_query($con,$sql)) {
        echo "Admin user created!<br>";
    } else {
        echo "Error creating admin: " . mysqli_error($con) . "<br>";
    }
} else {
    echo "Admin's login is 'admin'<br>";
}
$tablename = "articles";
$sql = "CREATE TABLE $tablename(".
    "id INT(10) AUTO_INCREMENT PRIMARY KEY,".
    "title CHAR(250) NOT NULL,".
    "image TEXT,".
    "category TEXT NOT NULL,".
    "price FLOAT NOT NULL,".
    "description TEXT)";
if (mysqli_query($con,$sql)) {
    echo "Table $tablename successfully created!<br>";
} else {
    echo "Error creating table $tablename: " . mysqli_error($con) . "<br>";
}
$tablename = "categories";
$sql = "CREATE TABLE $tablename(".
    "id INT(10) AUTO_INCREMENT PRIMARY KEY,".
    "title CHAR(100) NOT NULL)";
if (mysqli_query($con,$sql)) {
    echo "Table $tablename successfully created!<br>";
} else {
    echo "Error creating table $tablename: " . mysqli_error($con) . "<br>";
}
$tablename = "orders";
$sql = "CREATE TABLE $tablename(".
    "id INT(10) AUTO_INCREMENT PRIMARY KEY,".
    "user_id INT(10),".
    "price FLOAT,".
    "datetime DATE".
    ")";
if (mysqli_query($con,$sql)) {
    echo "Table $tablename successfully created!<br>";
} else {
    echo "Error creating table $tablename: " . mysqli_error($con) . "<br>";
}
$tablename = "productsInOrders";
$sql = "CREATE TABLE $tablename(".
    "order_id INT(10),".
    "product_id INT(10),".
    "amount INT(3),".
    "price FLOAT".
    ")";
if (mysqli_query($con,$sql)) {
    echo "Table $tablename successfully created!<br>";
} else {
    echo "Error creating table $tablename: " . mysqli_error($con) . "<br>";
}
mysqli_close($con);
?>
