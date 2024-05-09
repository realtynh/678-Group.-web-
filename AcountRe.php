<?php
            $phantrang = 5;
            $n_product = getAll("accounts");
            $n_page = ceil(mysqli_num_rows($n_product) / $phantrang);
            if (isset($_GET["sub_inp"]) && is_numeric($_GET["sub_inp"]) && $_GET["sub_inp"] >= 1 && $_GET["sub_inp"] <= $n_page) {
                $n_p = $_GET["sub_inp"];
            } else {
                $n_p = 1;
            }
            // vi tri lay san pham
            $posVT = ($n_p - 1) * $phantrang;
            $query = "SELECT * FROM accounts LIMIT $posVT, $phantrang";
            $query_run = mysqli_query($conn, $query);
            ?>
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
                while ($row_page = mysqli_fetch_array($query_run)) {
                ?>
                    <tr>
                        <td><?= $row_page['ID_cus'] ?></td>
                        <td> <?= $row_page['FullName'] ?> </td>
                        <td> <?= $row_page['User_cus'] ?> </td>
                        <td> <?= $row_page['Email'] ?></td>
                        <td> <?= $row_page['Pass_cus'] ?> </td>
                        <td> <?= $row_page['Birth'] ?> </td>
                        <td>
                            <?php 
                                if ($row_page['Status_Cus']==0)
                                {
                                    echo '<p><a href="status.php?cID='.$row_page['ID_cus'].'&status=1"> Enable </a></p>';
                                }
                                else
                                {
                                    echo '<p><a href="status.php?cID='.$row_page['ID_cus'].'&status=0"> Disable </a></p>';
                                }
                            ?>
                        </td>
                        <td>
                            <a target="_blank" href="edit_cus.php?cID=<?php echo $row_page['ID_cus'] ?>">Edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <!-- </td> -->
                </tr>
            </table>
            