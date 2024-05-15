<?php
include_once("./function/myfunctions.php");
include_once("./config/ketnoi.php");
if (isset($_GET["id_order"]))
{
    $id_orders = $_GET["id_order"];
    $query = mysqli_query($conn,"SELECT * FROM Orders WHERE Orders_ID = $id_orders");
    $result = mysqli_fetch_assoc($query);
    $id_cus = $result["ID_cus"];
    $Account_query = mysqli_query($conn,"SELECT * FROM Accounts WHERE ID_cus = $id_cus");
    $name_result = mysqli_fetch_assoc($Account_query);

    $product  = mysqli_query($conn,"SELECT orders_detail.Orders_ID,orders_detail.ProductID, orders_detail.Quantity, products.Product_Img , products.Product_Name,products.Product_Price
                            FROM orders_detail JOIN  products ON orders_detail.ProductID = products.ProductID WHERE orders_detail.Orders_ID=$id_orders");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #pro_show{
            display: flex;
        }
        #pro_show > div{
            flex: 1;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div>
    <div class="alert alert-success"> Thông Tin Khách Hàng</div>
        <ul>
            <li>Tên Người Nhận: <?php echo $name_result["FullName"] ?></li>
            <li>Số Điện Thoại: <?php echo "0".$result['number_Ship'] ?> </li>
            <li>Địa Chỉ Nhận: <?php echo $result["address_Ship"]  ?></li>
             <li>Trạng Thái :<?php if ($result["status_Orders"]==0)
             {
                echo "Chưa Xử Lý";
             }
             else if ($result["status_Orders"]==1)
             {
                echo "Đã Xử Lý";
             }
             else if ($result["status_Orders"]==2)
             {
                echo "Đã Giao Thành Công";
             }
             else {
                echo "Đã Huỷ";
             } ?></li>
        </ul>
    </div>
    <!--  echo $result["status_Orders"] -->

    <div class="alert alert-info" id="pro_show"> Sản Phẩm Đã Mua : </div>
    <?php 
    {
        foreach ($product as $key => $values)
        { ?>

                    <div> Thứ Tự :
                        <?php echo $key + 1 ?>
                    </div>

                    <div>
                        Tên Sản Phẩm : <?php echo $values["Product_Name"];
                         ?>
                    </div>

                    <div>
                        <img src="../uploads/<?php echo $values["Product_Img"] ?>" alt="" style="width: 150px;">
                    </div>
                    <div>
                        Số Lượng : <?php echo $values["Quantity"] ?>
                    </div>
                    <div>
                        Giá : <?php echo number_format($values["Product_Price"],0,',',',').' VNĐ' ?>
                    </div><hr>
        <?php
        }
    }
    ?>
    <div class="alert alert-danger" >Tổng Tiền : <?php echo number_format(total_price($product),0,',',',').' VNĐ' ?></div>
    <form action="" method="post" role="form">
    <select name="status" id="">
        <option value="0">Chưa Xử Lý</option>
        <option value="1">Đã Xử Lý</option>
        <option value="2">Đã Giao Thành Công</option>
        <option value="3">Huỷ Đơn</option>
    </select>
    <button type="submit">Xac Nhan</button> 
    </form>

    <?php
        if (isset($_POST["status"]) && $_POST["status"])
        {
            $status = $_POST["status"];
            mysqli_query($conn,"UPDATE Orders SET status_Orders =$status where Orders_ID=$id_orders");
            header("Location: ../orderManagement.php");
        }
    ?>
</body>
</html>