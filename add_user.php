<?php
ob_start();
include_once("./config/ketnoi.php");
include_once("./function/myfunctions.php");

$error_config = ""; // Khởi tạo biến lỗi
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* CSS để căn giữa form */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        form {
            width: 350px; /* Độ rộng của form */
            padding: 20px; /* Khoảng cách giữa các phần tử bên trong form */
            border: 1px solid #ccc; /* Viền của form */
            border-radius: 5px; /* Bo tròn góc của form */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng cho form */
        }
        
        label {
            display: block; /* Hiển thị mỗi label trên một dòng */
            margin-bottom: 10px; /* Khoảng cách giữa các label */
        }
        
        input[type="text"], input[type="email"], input[type="password"],input[type="date"] {
            width: 100%; /* Mở rộng input để điền đầy phần tử cha */
            padding: 8px; /* Khoảng cách bên trong input */
            margin-bottom: 10px; /* Khoảng cách giữa các input */
            border: 1px solid #ccc; /* Viền của input */
            border-radius: 3px; /* Bo tròn góc của input */
            margin-left: 2px;
            box-sizing: border-box;
        }
        
        input[type="submit"] {
            width: 100%; /* Mở rộng input để điền đầy phần tử cha */
            padding: 10px; /* Khoảng cách bên trong input */
            border: none; /* Loại bỏ viền */
            background-color: #007bff; /* Màu nền */
            color: #fff; /* Màu chữ */
            border-radius: 3px; /* Bo tròn góc */
            cursor: pointer; /* Đổi hình con trỏ khi di chuột vào */
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3; /* Màu nền hover */
        }
    </style>
</head>
<body>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_name = $_POST["user_name"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $fullname = $_POST['Fullname'];
        $birth = $_POST['birth'];

        // Kiểm tra xem các trường user_name, password và email có được gửi đi hay không
        if (!empty($user_name) && !empty($password) && !empty($email)) {
            // Kiểm tra sự tồn tại của tài khoản
            $sql = "SELECT * FROM Accounts WHERE User_cus = '$user_name' AND Pass_cus = '$password' ";
            $query = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($query);

            if ($rows > 0) {
                $error_config = "Tài Khoản Hoặc Mật Khẩu Đã Tồn Tại !";
            ?>
                <div class="alert alert-danger" role="alert"> <?php echo $error_config; ?></div>
            <?php
            }
            else {
              // Chèn thông tin người dùng mới vào cơ sở dữ liệu
              $sql_insert = "INSERT INTO Accounts (FullName,User_cus,Pass_cus,Email,Birth) VALUES ('$fullname','$user_name', '$password', '$email','$birth')";
              if (mysqli_query($conn, $sql_insert)) {
                  // echo "Tạo tài khoản thành công!";
                  ?>
                  <div class="alert alert-success" role="alert"> Tạo Tài Khoản Thành Công</div>
                  <?php
              } else {
                  echo "Lỗi: " . $sql_insert . "<br>" . mysqli_error($conn);
              }
          }
        }
    }
    ?>
    <form id="myForm" method="post">
        <label for="">User Name:</label>
        <input type="text" name="user_name" id="user_name" required> <br> <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required><br><br>

        <label for="">Full Name:</label>
        <input type="text" name="Fullname" id="fullname" required> <br> <br>

        <label for="">Full Name:</label>
        <input type="date" name="birth" id="birth" required> <br> <br>    

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required> <br><br>

        <input type="submit" value="Submit">
    </form>
    
    <script>
        document.getElementById("myForm").addEventListener("submit", function(event) {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Mật khẩu không khớp!");
                event.preventDefault(); // Ngăn chặn việc submit form
            }
        });
    </script>

<!-- <div class="alert alert-danger" role="alert"> -->
</div>
</body>
</html>
