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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Account-Management</title>
    <style>
        fieldset {
            border-radius: 40px;
            margin: 10px;
        }

        legend {
            text-align: center;
            border: 1px solid rgb(107, 103, 103);
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            padding: 10px;
            border-radius: 40px;
        }

        .Pinp {
            display: flex;
            justify-content: space-around;
        }

        .Pinp>div {
            margin-top: 10px;
            margin-bottom: 30px;
        }

        label>input {
            padding: 10px;
        }

        table {
            margin: 0 auto;
        }

        th,
        td {
            padding: 20px;
        }

        /* i+i{
            margin-right: 10px;
        } */
        td>i {
            padding: 10px;
            margin-right: 10px;
        }

        i:hover {
            cursor: pointer;
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
                        <span class="title" style="font-size: 29px; font-family: 'Poppins', sans-serif;"> Wheystore
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


            <!--  tutu  -->
            <?php
            require("formAccounts.php")
            ?>
            <!--  -->
            <?php
            if (isset($_POST["sm_Search"])) {
                $fullname = $_POST["fullname"];
                $username = $_POST["username"];

                $sql_Search = "SELECT * FROM Accounts ";

                $where = "";

                if (!empty($fullname)) {
                    $where = "WHERE FullName LIKE '%$fullname%'";
                }
                if (!empty($username)) {
                    if (empty($where)) {
                        $where = "WHERE User_cus LIKE '%$username%'";
                    } else {
                        $where .= " AND User_cus LIKE '%$username%'";
                    }
                }

                $sql_Search .= $where;
                $result = mysqli_query($conn, $sql_Search);

                $row_Result = mysqli_num_rows($result);
                if ($row_Result > 0) { ?>
                <table border="1px">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>BirthDate</th>
                    <th>Status</th>
                    <th>Edit</th>
                </tr>
                <?php
                while ($row_pages = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?= $row_pages['ID_cus'] ?></td>
                        <td> <?= $row_pages['FullName'] ?> </td>
                        <td> <?= $row_pages['User_cus'] ?> </td>
                        <td> <?= $row_pages['Email'] ?></td>
                        <td> <?= $row_pages['Pass_cus'] ?> </td>
                        <td> <?= $row_pages['Birth'] ?> </td>
                        <td>
                            <?php 
                                if ($row_pages['Status_Cus']==0)
                                {
                                    echo '<p><a href="status.php?cID='.$row_pages['ID_cus'].'&status=1"> Enable </a></p>';
                                }
                                else
                                {
                                    echo '<p><a href="status.php?cID='.$row_pages['ID_cus'].'&status=0"> Disable </a></p>';
                                }
                            ?>
                        </td>
                        <td>
                            <a target="_blank" href="edit_cus.php?cID=<?php echo $row_pages['ID_cus'] ?>">Edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <!-- </td> -->
                </tr>
            </table>
            
              <?php  }
            else {
                echo '<span>Không Tìm Thấy Thông Tin Người Dùng.<br></span>';
            }
            }
            else
            {
                require("AcountRe.php");
            }
            ?>


            <!-- =========== Scripts =========  -->
            <script src="admin.js"></script>
            <script>
                function aSearch() {
                    alert("Success!!!!!");
                    location.assign("AccountManagement.php");
                }
            </script>

            <!-- ====== ionicons ======= -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

            <a href="./add_user.php"> <button style="padding: 10px; margin-top: 20px; margin-right:20px;"> Tạo Tài Khoản Mới </button></a>
            <!--  -->


</body>

</html>