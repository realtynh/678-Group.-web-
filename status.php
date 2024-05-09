<?php

include_once('./config/ketnoi.php');
ob_start();
session_start();

$id = $_GET['cID'];
$status = $_GET['status'];

$q = "UPDATE Accounts set  Status_Cus = $status where ID_cus = $id";
mysqli_query($conn,$q);
header('location: AccountManagement.php');
?>