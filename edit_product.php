<?php
include_once("./config/ketnoi.php");
$id = $_GET['pID'];


$sql = "SELECT * FROM Products WHERE ProductID=$id";


$query = mysqli_query($conn,$sql);
$result_query =mysqli_fetch_assoc($query)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
            resize: vertical;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<form method="post" enctype="multipart/form-data" >
    <div>
        <label for="Product_ID">ID : <?php echo $result_query['ProductID'] ?></label>
        <div>
            <input type="file" name="img_pro">
            <label for="">Image :</label>
            <img style="width:400px;" src="./uploads/<?php echo $result_query['Product_Img'] ?>" alt="">
            <input type="text" disabled name="" id="" value="<?php echo $result_query['Product_Img'] ?>">
        </div>
    </div>

    <div>
        <label for="Product_Name">Name :</label>
        <input type="text" name="Product_Name" id="Product_Name" value="<?php echo $result_query['Product_Name'] ?>">
    </div>

    <div>
        <label for="Product_Price">Price :</label>
        <input type="text" name="Product_Price" id="Product_Price" value="<?php echo $result_query['Product_Price']?>">
    </div>

    <div>
        <label for="description_product">Description :</label>
        <textarea name="description_product" id="description_product" cols="30" rows="10"><?php echo $result_query['descriptions'] ?></textarea>
    </div>

    <div>
        <input type="submit" value="Submit" name="submit">
    </div>
</form>
<?php
if (isset($_POST['submit']) && $_POST['submit'])
{
    $id1 = $_GET['pID'];
    $new_Name = $_POST['Product_Name'];
    $new_Price = $_POST['Product_Price'];
    $new_Description = $_POST['description_product'];

        $new_namePic = $_FILES['img_pro']['name'];
        $name_tmp = $_FILES['img_pro']['tmp_name'];

        $sql_product = "SELECT * from Products where ProductID =$id ";
        $query_up = mysqli_query($conn,$sql_product);
        $row_up = mysqli_fetch_assoc($query_up);
        if ($_FILES['img_pro']['name']=='')
        {
            $new_namePic = $row_up['Product_Img'];
        }
        else
        {
            $new_namePic = $_FILES['img_pro']['name'];
            $name_tmp = $_FILES['img_pro']['tmp_name'];
            move_uploaded_file($name_tmp,"uploads/".$new_namePic);
        }
    
        $sql_1 = "UPDATE Products 
        SET Product_Name='$new_Name', Product_Price='$new_Price', descriptions='$new_Description', Product_Img='$new_namePic'
        WHERE ProductID =$id1";

        $query1 = mysqli_query($conn,$sql_1);

        if($query)
        {
            header("location: ProductManagement.php");
        }
        else
        {
            echo "Error";
        }
}
?>

</body>
</html>
