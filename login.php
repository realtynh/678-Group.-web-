<?php
include_once './config/ketnoi.php';
session_start();
ob_start();

if (isset($_POST["submit"]) && $_POST["submit"]) {
    $username_ad = $_POST["username"];
    $password_ad = $_POST["password"];
    
    if (isset($_POST["username"]) && isset($_POST["password"]))
    {
        $sql = "SELECT * FROM Admins WHERE User_admins = '$username_ad' AND Admin_password = '$password_ad'";
        $query = mysqli_query($conn,$sql);
        $rows = mysqli_num_rows($query);

        if ($rows > 0) {
            $_SESSION["username"]=$username_ad;
            $_SESSION["password"]=$password_ad;
            header("location: Admin.php");
        }
        else {
            echo '<div class="alert alert-danger text-center" style="position:absolute;top: 10px;;"> Tài Khoảng Không Tồn Tại Hoặc Không Có Quyền Truy Cập.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
		body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
}

input[type="text"],
input[type="password"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #4caf50;
    color: white;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
