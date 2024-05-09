<?php
include("./config/ketnoi.php");
function getAll($table) {
    global $conn;
    $query = "SELECT * FROM $table";
    $query_run = mysqli_query($conn,$query);
    return $query_run;
}
function total_price($mangtien)
{
    $total_price = 0 ;
    foreach ($mangtien as $key1 => $values1)
    {
        
    $total_price += $values1["Quantity"] * $values1["Product_Price"];
}
return $total_price;
}
?>