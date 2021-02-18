<?php
$hostname = "192.168.56.108";
$username = "root";
$pass = "";
$db = "member";

$conn = mysqli_connect($hostname, $username, $pass, $db);
mysqli_set_charset($conn, "utf8");
?>