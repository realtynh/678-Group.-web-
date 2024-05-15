<?php
include_once('./config/ketnoi.php');
$id = $_GET['ProductID'];

$sql = "SELECT * FROM products WHERE ProductID = '$id'";
$query = mysqli_query($conn,$sql);
$result = mysqli_num_rows($query);

$sql_join = "SELECT * FROM orders 
            JOIN orders_detail ON orders_detail.Orders_ID = orders.Orders_ID
            WHERE orders_detail.ProductID = '$id'";

            $query_order = mysqli_query($conn,$sql_join);
            $getInformORder = mysqli_fetch_array($query_order);

            

if ($getInformORder > 0)
{
    $sql_dlt = "UPDATE products SET status_product = 1 WHERE ProductID = $id";
    $runSQL = mysqli_query($conn,$sql_dlt);
    // header('location: ProductManagement.php');   
    // print_r($getInformORder);
    echo "Sản Phẩm Này Đang Còn Tồn Tại Trong Đơn Hàng Của Khách Hàng. <br> Ẩn Sản Phẩm Sẽ Được Ẩn Đi.";
}
else
{
    $sql_dlt = "DELETE FROM products WHERE ProductID=$id";
    $runSQL = mysqli_query($conn,$sql_dlt);
    header('location: ProductManagement.php');
}
?>