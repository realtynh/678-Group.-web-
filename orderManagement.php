<?php
session_start();
ob_start();
include_once("./function/myfunctions.php");
include_once("./config/ketnoi.php");
global $conn;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order-Management</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="./css/order.css">
    <style>
        .fs1 {
            border: 2px solid rgb(117, 116, 116);
            border-radius: 40px;
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
            margin: 0 10px;
        }

        .fs1>div {
            margin: 15px 0;
            position: relative;
            width: calc(50% - 20px);
        }

        div>input,
        #st1 {
            width: 100%;
            padding: 15px;
            border-radius: 40px;
            border: 1px solid rgb(111, 107, 107);
            box-sizing: border-box;
        }

        fieldset+fieldset {
            margin: 10px;
        }

        legend {
            text-align: center;
        }

        table {
            margin: 10px 0;
            border: none;
            width: 100%;
        }

        th,
        td {
            padding: 20px;
        }

        th {
            text-decoration: underline;
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 600px) {
            fieldset>div {
                width: 100%;
                /* Full width on smaller screens */
            }
        }

        /*  */
        .fs2 {
            display: flex;
            justify-content: space-between;
            margin: 10px;
        }

        .fs2>.opd1 {
            border-right: 1px dashed black;
            border-left: 1px dashed black;
        }

        .inf1 {
            flex: 1;

        }

        div>h4 {
            text-align: center;
            text-decoration: underline;
        }

        .ul1>.li1 {
            list-style: none;
            padding: 0;
        }

        .li1 {
            margin: 10px;
        }

        .opd1 {
            flex: 2;
        }

        .st1 {
            flex: 1;
        }

        .form-select {
            padding: 10px;
            text-align: center;
            box-sizing: border-box;
            margin: 0 10px 10px 10px;
            border-radius: 4rem;
            box-shadow: inset 0 0 10px #000000;
        }

        #sub_inp {
            padding: 10px;
            box-sizing: border-box;
            background-color: rgb(99, 99, 99);
            color: white;
            border-radius: 4px;
        }

        #sub_inp:hover {
            cursor: pointer;
        }

        .kh_nek {
            display: flex;
            flex: 2;
            justify-content: space-between;
            width: 100%;
        }

        .kh_nek>div {
            flex: 1;
            text-align: center;
            border-bottom: 1px solid gray;

            font-family: Georgia, 'Times New Roman', Times, serif;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title" style="font-size: 29px; font-family: 'Poppins', sans-serif;"> WheyStore
                        </span>
                    </a>
                </li>

                <li>
                    <a href="Admin.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li class="orderLi">
                    <a href="">
                        <span class="icon">

                            <ion-icon name="reorder-three-outline"></ion-icon>
                        </span>
                        <span class="title">Order Management</span>
                    </a>
                </li>

                <li>
                    <a href="ProductManagement.php">
                        <span class="icon">
                            <ion-icon name="cube-outline"></ion-icon>
                        </span>
                        <span class="title">Product Management</span>
                    </a>
                </li>

                <li>
                    <a href="AccountManagement.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Account Management</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="password.php">
                        <span class="icon">
                            <ion-icon name="lock-open"></ion-icon>
                        </span>
                        <span class="title"> Password</span>
                    </a>
                </li> -->
                <li>
                    <a href="login.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
            </div>
            <!-- Methods -->

            <?php
            require("content.php");
            //    require("content2.php")
            ?>
            <br>


            <?php
            if (isset($_POST["searchOr"])) {
                $nameCus = $_POST["nameCus"];
                // $dateOr = $_POST["dateOr"];
                $status = $_POST["status"];
                // orders_detail.ProductID,accounts.Fullname, orders.Orders_date, orders.status_Orders ,accounts.ID_cus,Orders.Orders_ID
                $sqlSearch = "SELECT * , SUM(orders_detail.Quantity * products.Product_Price ) AS TotalAmount
                  FROM orders
                  JOIN accounts ON Orders.ID_cus = accounts.ID_cus
                  JOIN orders_detail ON orders_detail.Orders_ID = orders.Orders_ID
                  JOIn products ON products.ProductID = orders_detail.ProductID
                  ";

                $where = "";
                if (!empty($nameCus)) {
                    $where = "WHERE accounts.FullName LIKE '%$nameCus%'";
                }
                if ($status != -1) {
                    if (empty($where)) {
                        $where = "WHERE orders.status_Orders = '$status'";
                    } else {
                        $where .= "AND orders.status_Orders = '$status'";
                    }
                }

                $sqlSearch .= $where;
                $qr = mysqli_query($conn, $sqlSearch);
                $countSearch = mysqli_num_rows($qr);

                if ($countSearch <= 0) {
                    echo "Không tìm thấy sản phẩm";
                    // printf($nameCus);
                    // printf($status);
                } else { ?>
                    <!-- ====================================== -->
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
                    $query = "SELECT * FROM Orders LIMIT $posVT, $phantrang";
                    $query_run = mysqli_query($conn, $query);
                    ?>
                    <!-- choon trang  thuc hien phan trang -->
                    <form action="" method="get">
                        <select class="form-select" aria-label="Default select example" name="sub_inp">
                            <option>Chọn Số Trang</option>
                            <?php for ($i = 1; $i <= $n_page; $i++) { ?>
                                <option selected value="<?php echo $i ?>" <?php if ($i == $n_p) echo "selected"; ?>><?php echo $i ?></option>
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
                        while ($row_page1 = mysqli_fetch_array($qr)) {
                        ?>
                            <tr>
                                <td><?= $row_page1['Orders_ID'] ?></td>
                                <td> <?php
                                        $id_cus_name1 = $row_page1['ID_cus'];
                                        $sql_name1 = "SELECT * FROM accounts WHERE ID_cus = '$id_cus_name1'";
                                        $qu_name1 = mysqli_query($conn, $sql_name1);
                                        $result_name1 = mysqli_fetch_array($qu_name1);
                                        // echo $result_name1["FullName"] ;
                                        if ($result_name1)
                                        {
                                            echo $result_name1["FullName"] ;
                                        }
                                        else
                                        {
                                            echo "Không Có Dữ Liệu Được Tìm Thấy";
                                            continue;
                                        }
                                         ?></td>
                                <td><?= number_format($row_page1['TotalAmount'],0,',',',').' VNĐ' ?> </td>
                                <td>
                                    <?php
                                    if ($row_page1["status_Orders"] == 0) {
                                        echo '<span> Chưa Xử Lý </span>';
                                    } else if ($row_page1["status_Orders"] == 1) {
                                        echo '<span> Đã Xử Lý </span>';
                                    } else if ($row_page1["status_Orders"] == 2) {
                                        echo '<span> Đã Giao </span>';
                                    } else {
                                        echo '<span> Đã Huỷ Đơn </span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="edit_statusOrder.php/?id_order=<?php echo $row_page1["Orders_ID"] ?>" target="_blank">Chỉnh Sửa </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>




                    <!-- ======================================== -->

            <?php  }
            } else {
                require("ordersRe.php");
            }
            ?>


            <!-- PHP -->

            <!-- require("ordersRe.php") -->




            <!-- =========== Scripts =========  -->
            <script src="admin.js"></script>

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>