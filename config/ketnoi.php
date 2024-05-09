<?php
$dbHost = "localhost";
$dbUser = "root";
$dbpass = "";
$dbName = "Ecommercial";

$conn = mysqli_connect($dbHost,$dbUser,$dbpass,$dbName);
if (isset($conn)) {
    $setLanguage=mysqli_query($conn,"SET NAMES 'utf8'");
}
else {
    die("Kết Nối Thất Bại!".mysqli_connect_error());
}
?>