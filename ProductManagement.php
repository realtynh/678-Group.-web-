<?php
include_once("./config/ketnoi.php");
session_start();
ob_start();
include_once("./function/myfunctions.php");
$product = mysqli_query($conn, "select * from Products");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/product.css">
    <title>Product-Management</title>
    <style>
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

        fieldset {
            display: flex;
            justify-content: space-between;
            border-radius: 40px;
            padding-bottom: 20px;
        }

        fieldset>div {
            margin: 10px 0;
        }

        legend {
            text-align: center;
            border: 1px solid rgb(130, 125, 125);
            padding: 15px;
            border-radius: 40px;
        }

        .box1 {
            flex: 1;
        }

        .box2 {
            flex: 1;
            text-align: center;
        }

        .box3 {
            flex: 1;
            text-align: center;
        }

        .srch {
            width: 40%;
        }

        select {
            width: 30%;
        }

        .prce,
        select,
        .srch {
            padding: 15px;
        }

        .tble1 {
            display: flex;
            justify-content: center;
        }

        th,
        td {
            padding: 40px;
        }

        button {
            padding: 10px;
            border-radius: 40px;
            border: none;
        }

        .dlt {
            background-color: red;
        }

        .edi {
            background-color: rgba(0, 255, 30, 0.774);

        }

        .edi:hover {
            background-color: gray;
            cursor: pointer;
        }

        .dlt:hover {
            background-color: gray;
            cursor: pointer;
        }

        #formContainer {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            /* Màu nền của form */
            padding: 20px;
            border: 1px solid #ccc;
            /* Viền của form */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Đổ bóng form */
            z-index: 2;
            /* Đặt z-index để form hiển thị trên phần còn lại của trang */
            box-sizing: border-box;
        }

        /*  */

        label>input {
            border: none;
            border-bottom: 1px solid black;
        }

        label>select {
            border: none;
            border-bottom: 1px solid black;
        }

        /* Ẩn form và overlay ban đầu */
        body.modal-open #formContainer,
        body.modal-open #overlay {
            display: block;
        }

        /*  */
        /* Ẩn input file */
        input[type="file"] {
            display: none;
        }

        /* Thiết lập giao diện tùy chỉnh */
        .custom-file-input {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btnSend {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .divFake {
            display: none;
            /* Ẩn div ban đầu */
            /* Các thuộc tính CSS khác cho div khi ẩn đi */
            background-color: lightgray;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
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
                        <span class="title" style="font-size: 29px; font-family: 'Poppins', sans-serif;"> WheyStore</span>
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
                    <a href="orderManagement.php">
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

            <!--  -->

            <form action="" method="post">
                <fieldset>
                    <legend>Product</legend>
                    <div class="box3">
                        <label for="">Name : </label>
                        <input class="prce" type="text" placeholder="Name Product" name="namePro">
                    </div>
                    <div class="box2">
                        <input type="submit" name="sm_reseach" class="srch" value="Search" onclick="loaddingPage()">
                    </div>
                </fieldset>
            </form>
            <br>
            <hr>
            <br>


            <!--  -->
            <?php
            if (isset($_POST["sm_reseach"])) {
                $namePro = $_POST["namePro"];

                $where = "SELECT * FROM products WHERE Product_Name LIKE '%$namePro%'";

                $result_se = mysqli_query($conn, $where);
                if ($result_se) { ?>
                    <div class="tble1">
                        <table border="1">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <!-- <th>Description</th> -->
                                <th>Change</th>
                            </tr>
                            <?php
                            while ($row_page11 = mysqli_fetch_array($result_se)) {
                            ?>
                                <tr>
                                    <td><?php echo $row_page11['ProductID'] ?></td>
                                    <td><img width="100px" src="./uploads/<?php echo $row_page11['Product_Img'] ?>"></td>
                                    <td><?php echo $row_page11['Product_Name'] ?></td>
                                    <td><?php echo number_format($row_page11['Product_Price'],0,',',',').' VNĐ' ?></td>

                                    <td>
                                        <a onclick="return confirm('Bạn Muốn Xoá Sản Phẩm Này Đúng Chứ ?');" target="_blank" href="delete_product.php?ProductID=<?php echo $row_page11['ProductID']  ?>"><button class="dlt" onclick="dltOnc()">Delete</button></a>
                                        <a target="_blank" href="edit_product.php?pID=<?php echo $row_page11['ProductID'] ?>"><button class="edi" id="showEdit" onclick="editPD()">Edit</button></a>
                                    </td>

                                </tr>
                            <?php
                            }
                            // xoa san pham
                            ?>

                        </table>
                    <?php  }

                    
                    ?>
                <?php }
                 else
                 {
                      require("productRe.php");
                 } ?>

                <!-- table -->

                <!-- require("productRe.php"); -->

                <!-- <button id="showFormBtn" style="margin-left: 10px; margin-top: 10px; background-color: rgb(50, 49, 49); color: rgb(220, 206, 206);">Add Product</button> -->
                <!--  -->
                <!-- =========== Scripts =========  -->
                <script src="admin.js"></script>

                <!-- ====== ionicons ======= -->
                <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
</body>

</html>