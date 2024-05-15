<?php
$phantrang = 3;
$n_product = getAll("orders");
$n_page = ceil(mysqli_num_rows($n_product) / $phantrang);
if (isset($_GET["sub_inp"]) && is_numeric($_GET["sub_inp"]) && $_GET["sub_inp"] >= 1 && $_GET["sub_inp"] <= $n_page) {
    $n_p = $_GET["sub_inp"];
} else {
    $n_p = 1;
}
// vi tri lay san pham
$posVT = ($n_p - 1) * $phantrang;
$query = "SELECT * FROM orders LIMIT $posVT, $phantrang";
$query_run = mysqli_query($conn, $query);
$result_pro = mysqli_fetch_array($query_run);
$id_order = $result_pro['Orders_ID'];
?>
<!-- choon trang  thuc hien phan trang -->
<form action="" method="get">
    <select class="form-select" aria-label="Default select example" name="sub_inp">
        <option>Chọn Số Trang</option>
        <?php for ($i = 1; $i <= $n_page; $i++) { ?>
            <option value="<?php echo $i ?>" <?php if ($i == $n_p) echo "selected"; ?>><?php echo $i ?></option>
        <?php } ?>
    </select>
    <input type="submit" id="sub_inp" value="Xác Nhận">
    <span style="float: right; margin-right: 20px;">Số Trang Hiện Có: <?php echo $n_page ?></span>
</form>

<table style="text-align: center;" border="1">
    <tr>
        <th>Mã Đơn</th>
        <th>Tên Khách Hàng</th>
        <th>Tổng Tiền</th>
        <th>Trạng Thái</th>
        <th>Chỉnh Sửa Trạng Thái</th>
    </tr>
    <?php
    $sql_join_Order_OrderDetail = " SELECT *, CONCAT(FORMAT( SUM(products.Product_Price * orders_detail.Quantity),0),' VNĐ') as TotalPrice 
                                    FROM orders
                                    JOIN orders_detail ON orders.Orders_ID = orders_detail.Orders_ID
                                    JOIN products ON products.ProductID = orders_detail.ProductID
                                    WHERE orders.Orders_ID = $id_order";


    $query_orderdetail = mysqli_query($conn, $sql_join_Order_OrderDetail);
    while ($result_Orders = mysqli_fetch_array($query_orderdetail)) {
    ?>
        <tr>
            <td><?= $result_pro['Orders_ID'] ?></td>
            <td> <?php
                    $id_cus_name = $result_pro['ID_cus'];
                    $sql_name = "SELECT * FROM Accounts WHERE ID_cus = $id_cus_name ";
                    $qu_name = mysqli_query($conn, $sql_name);
                    $result_name = mysqli_fetch_assoc($qu_name);
                    echo $result_name["FullName"] ?></td>
            <td><?=  $result_Orders['TotalPrice'] ?> </td>
            <td>
                <?php
                if ($result_pro["status_Orders"] == 0) {
                    echo '<span> Chưa Xử Lý </span>';
                } else if ($result_pro["status_Orders"] == 1) {
                    echo '<span> Đã Xử Lý </span>';
                } else if ($result_pro["status_Orders"] == 2) {
                    echo '<span> Đã Giao </span>';
                } else {
                    echo '<span> Đã Huỷ Đơn </span>';
                }
                ?>
            </td>
            <td>
                <a href="edit_statusOrder.php/?id_order=<?php echo $result_pro["Orders_ID"] ?>" target="_blank">Chỉnh Sửa</a>
            </td>
        </tr>
    <?php
    }
    ?>
</table>