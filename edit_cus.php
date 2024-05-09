<?php
include_once('./config/ketnoi.php');
session_start();
ob_start();

$ID_cus = $_GET['cID'];

$runQuery = mysqli_query($conn,"SELECT * FROM Accounts WHERE ID_cus=$ID_cus");
$result = mysqli_fetch_assoc($runQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Chỉnh Sửa Tài Khoản Người Dùng</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        width: 400px;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .container h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #555;
    }

    .form-group input[type="text"],
    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="date"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .form-group input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Chỉnh Sửa Tài Khoản Người Dùng</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="ID">ID</label>
            <input disabled type="text" name="ID" id="ID" value="<?php echo $ID_cus ?>">
        </div>
        <div class="form-group">
            <label for="FullName">Họ Và Tên</label>
            <input type="text" name="new_name" id="FullName" value="<?php echo $result['FullName'] ?>">
        </div>
        <div class="form-group">
            <label for="User_cus">Tài Khoản Người Dùng</label>
            <input type="text" name="User_cus" id="User_cus" value="<?php echo $result['User_cus'] ?>">
        </div>
        <div class="form-group">
            <label for="Pass_cus">Mật Khẩu</label>
            <input type="text" name="Pass_cus" id="Pass_cus" value="<?php echo $result['Pass_cus'] ?>">
        </div>
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="email" name="Email" id="Email" value="<?php echo $result['Email'] ?>">
        </div>
        <div class="form-group">
            <label for="Birth">Ngày Sinh</label>
            <input type="date" name="Birth" id="Birth" value="<?php echo $result['Birth'] ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Lưu">
        </div>
    </form>
</div>
<?php
$ID_cus = $_GET['cID'];
    if(isset($_POST['submit']) && $_POST['submit'])
    {
        $new_name = $_POST['new_name'];
$User_cus = $_POST['User_cus'];
$Pass_cus = $_POST['Pass_cus'];
$Email = $_POST['Email'];
$Birth = $_POST['Birth'];


$sql = "UPDATE Accounts SET FullName='$new_name',User_cus='$User_cus',Pass_cus='$Pass_cus',Email='$Email',Birth='$Birth' WHERE ID_cus=$ID_cus";
$query = mysqli_query($conn,$sql);
if ($query)
{
    header('location: AccountManagement.php');
}
else
{
    echo "<div style='float:left;'> Error </div>" ;
}
    }
?>

</body>
</html>
