<?php
include_once("./config/ketnoi.php");
if (isset($_POST["submit"]) && $_POST["submit"])
{
    // $ProductID = $_POST["ProductID"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_Description = $_POST["product_Description"];
    // $product_status = $_POST["product_status"];
    $name = $_FILES['product_img']['name'];
    $temp_name = $_FILES['product_img']['tmp_name'];

    move_uploaded_file($temp_name,"uploads/".$name);

    $sql = "insert into Products (Product_Name,Product_Img,Product_Price) 
            values('$product_name','$name','$product_price')";
    $query = mysqli_query($conn,$sql);
    if ($query)
    {
        header("location: ProductManagement.php");
    }
    else
    {
        echo "Error";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 20px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 20px;
        }
        input[type="text"],
 textarea {
    font-family: Arial, sans-serif;
    font-size: 14px;
}

    </style>
</head>
<body>
    <h1>Add-Product</h1>
    <hr>
    <form action="" method="post" role="form" enctype="multipart/form-data">

    <label for="">Product Name :</label>
    <input type="text" name="product_name" id=""> <br>

        <label for="">Price :</label>
        <input type="text" name="product_price" id=""><br>

        <label for="">Image Product</label>
        <input type="file" name="product_img" id="">

        <label for="">Description :</label>
        <textarea name="product_Description" id="" cols="100" rows="10" ></textarea>

        <input type="submit" value="Submit" name="submit">

    </form>
</body>
</html>
