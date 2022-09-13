<?php
if(!isset($_SESSION))
{
    session_start();
}
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = $_SESSION['dbSelection'];
$link = mysqli_connect($db_host, $db_username, $db_password, $db_name);
$connect = new PDO("mysql:host=$db_host;dbname=$db_name", "$db_username", "$db_password");

if (!$link) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die(mysqli_error($link));
    // alternative way to display the error:
    // die(mysqli_connect_error());
}
?>