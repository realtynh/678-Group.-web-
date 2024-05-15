<?php
include_once("./config/ketnoi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin Page</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="./css/admin.css">
    <style>
        .dashboard {
            background-color: grey;
            height: 500px;
            width: 500px;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title" style="font-size: 29px; font-family: 'Poppins', sans-serif;">WheyStore</span>
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

                <li>
                    <a href="orderManagement.php">
                        <span class="icon">

                            <ion-icon name="reorder-three-outline"></ion-icon>
                        </span>
                        <span class="title">Order Management</span>
                    </a>
                </li>

                <li>
                    <a href="./ProductManagement.php">
                        <span class="icon">
                            <ion-icon name="cube-outline"></ion-icon>
                        </span>
                        <span class="title">Product Management</span>
                    </a>
                </li>

                <li>
                    <a href="./AccountManagement.php">
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
                    <a href="./login.php">
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
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="./assets/customer01.jpg" alt="">
                </div>
            </div>
            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2 style="border: 1px solid; padding:10px">THỐNG KÊ</h2>
                        <!-- <a href="" class="btn">View All</a> -->
                        <!-- FORM THONG KE -->
                        <form action="" method="post">
                            <label for=""><b>Số Lượng Khách Hàng</b> </label>
                            <input style="padding:10px;margin-bottom:10px; border:none;border-bottom:1px solid;text-align:center" type="number" id="soluong" name="soluong" min="1" value="0" required><br>
                            <label for=""><b>Từ Ngày : </b></label>
                            <input type="datetime-local" class="form-control" id="from_date" name="from_date" required>
                            <label for=""><b>Đến Ngày : </b></label>
                            <input type="datetime-local" class="form-control" id="to_date" name="to_date" required>
                            <br>
                            <input style="padding:5px 10px;margin-top:10px" type="submit" name="oke_sb" value="Xac Nhan">
                        </form>
                    </div>
                    <?php
                    $soluong = "";
                    if (isset($_POST["oke_sb"])) {
                        $soluong = $_POST["soluong"];
                        $start_date = $_POST["from_date"];
                        $end_date = $_POST["to_date"];
// DSSTINCT Trade_id option khác.
                        $sql_thongke = "SELECT *, SUM(products.Product_Price * orders_detail.Quantity) AS total_spent
                        FROM accounts
                        INNER JOIN orders ON accounts.ID_cus = orders.ID_cus
                        INNER JOIN orders_detail ON orders.Orders_ID = orders_detail.Orders_ID
                        INNER JOIN products ON orders_detail.ProductID = products.ProductID
                        WHERE orders.Orders_date BETWEEN '$start_date' AND '$end_date'
                        GROUP BY accounts.ID_cus
                        ORDER BY total_spent DESC
                        LIMIT $soluong";
                        $query_trade = mysqli_query($conn,$sql_thongke);
                    ?>
                    <h4>Thống kê giao dịch <?php echo ($soluong !== "") ? "$soluong khách hàng có lượng giao dịch lớn nhất từ ngày $start_date đến $end_date:" : "   không có dữ liệu được gửi";?></h4>
                    <table>
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Tên Khách Hàng</td>
                                <td> Tổng Mua</td>
                                <td>Đơn Hàng</td>
                                <td>Chi Tiết Đơn</td>
                            </tr>
                        </thead>
                    
                    <?php
                        $i = 0;
                        while($row_trade_arr = mysqli_fetch_array($query_trade)) {
                            $khachhang_id = $row_trade_arr['ID_cus'];
                            $sql_select_khachhang = mysqli_query($conn,"SELECT * FROM Accounts WHERE ID_cus='$khachhang_id'");

                            // $sql_select_tongso = mysqli_query($conn,"SELECT SUM(Quantity) FROM ")
                            if(mysqli_num_rows($sql_select_khachhang) > 0){
                                $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
                                $tenkhachhang = $row_khachhang['FullName'];
                            } else {
                                $tenkhachhang = "Không xác định";
                            }
                            $tongmua = number_format($row_trade_arr['total_spent'],0,',',','). 'VNĐ';
                            $id_product = $row_trade_arr['Orders_ID'];
			                $i++; ?>
                            <tr>
                                <td> <?php echo $i ?></td>
                                <td> <?php echo $tenkhachhang ?> </td>
                                <td> <?php echo $tongmua ?></td>
                                <td> <?php echo $id_product ?></td>
                                <td> <a href="edit_statusOrder.php/?id_order=<?php echo$id_product  ?>"> Chi Tiết</a></td>
                            </tr>
                            
                       <?php }
                    ?>
                    </table>

                    <?php 
                    }
                    else
                    {
                        require("table_thongke.php");
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>



    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>