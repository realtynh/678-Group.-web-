<?php 
$phantrang = 2;
$n_product = getAll("products");
$n_page = ceil(mysqli_num_rows($n_product) / $phantrang);
if (isset($_GET["sub_inp"]) && is_numeric($_GET["sub_inp"]) && $_GET["sub_inp"] >= 1 && $_GET["sub_inp"] <= $n_page) {
    $n_p = $_GET["sub_inp"];
} else {
    $n_p = 1;
}
// vi tri lay san pham
$posVT = ($n_p - 1) * $phantrang;
$query = "SELECT * FROM products LIMIT $posVT, $phantrang";
$query_run = mysqli_query($conn, $query);
?>

            <form action="" method="get">
    <select style="width:130px" class="form-select" aria-label="Default select example" name="sub_inp">
        <option>Chọn Số Trang</option>
        <?php for ($i = 1; $i <= $n_page; $i++) { ?>
            <option value="<?php echo $i ?>" <?php if ($i == $n_p) echo "selected"; ?>><?php echo $i ?></option>
        <?php } ?>
    </select>
    <input type="submit" id="sub_inp" value="Xác Nhận">
    <span style="float: right; margin-right: 20px;">Số Trang Hiện Có: <?php echo $n_page ?></span>
</form>
            <!--  -->
            <div class="tble1">
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>

                        <th>Change</th>
                    </tr>
                    <tr>
                        <!-- <td>1</td>
                        <td><img src="./assets/sina-piryae-bBzjWthTqb8-unsplash.jpg" alt="" style="width: 100px"></td>
                        <td>Sina Piryae</td>
                        <td>18.8$</td>
                        <td>
                            <button class="dlt" onclick="dltOnc()">Delete</button>
                            <button class="edi"id="showEdit" onclick="editPD()" >Edit</button>
                        </td> -->
                <?php
                // foreach($product as $key =>$value) {
                    while ($row_page=mysqli_fetch_array($query_run)) {
                    ?>
                    <tr>
                        <td><?php echo $row_page['ProductID'] ?></td>
                        <td><img  width="100px" src="./uploads/<?php echo $row_page['Product_Img']?>"></td>
                        <td><?php echo $row_page['Product_Name']?></td>
                        <td><?php echo number_format($row_page['Product_Price'],0,',',',').' VNĐ' ?></td>
                        <td>
                            <a onclick="return confirm('Bạn Muốn Xoá Sản Phẩm Này Đúng Chứ ?');" target="_blank" href="delete_product.php?ProductID=<?php echo $row_page['ProductID']  ?>"><button class="dlt" onclick="dltOnc()">Delete</button></a>
                            <a target="_blank" href="edit_product.php?pID=<?php echo $row_page['ProductID'] ?>"><button class="edi" id="showEdit" onclick="editPD()" >Edit</button></a>
                        </td>
                        
                    </tr>
                <?php
                }
                // xoa san pham
                ?>

                <?php
                    // if(isset())
                ?>
          
                </table>

                <!--  -->
            <div class="divFake" id="myDiv1">asdasdasd</div>
                <a href="./add_product.php" target="_blank"><button id="showFormBtn" style="height: 40px;margin-left: 10px; margin-top: 10px; background-color: rgb(50, 49, 49); color: rgb(220, 206, 206);">Add Product</button></a>
            </div>