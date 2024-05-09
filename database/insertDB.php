<?php

$servername = "localhost"; // Thay đổi nếu cần
$username = "root"; // Thay đổi tên đăng nhập cơ sở dữ liệu
$password = ""; // Thay đổi mật khẩu cơ sở dữ liệu
$database = "Ecommercial"; // Thay đổi tên cơ sở dữ liệu nếu cần

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Câu lệnh SQL
$sql = "
    CREATE TABLE Accounts (
        ID_cus int AUTO_INCREMENT NOT NULL,
        FullName varchar(255),
        User_cus varchar(255),
        Pass_cus varchar(255),
        Birth date,
        Email varchar(255),
        Status_Cus TINYINT(1) DEFAULT 0,
        PRIMARY KEY (ID_cus)
    );

    CREATE TABLE Admins (
        ID_ad int AUTO_INCREMENT not NULL,
        Admin_name varchar(255),
        Admin_password varchar(255),
        Reg_date datetime,
        User_admins varchar(255),
        PRIMARY KEY (ID_ad)
    );

    CREATE TABLE Products (
        ProductID int AUTO_INCREMENT not NULL,
        Product_Name varchar(255),
        Product_Img varchar(255),
        Product_Price int,
        status_product TINYINT(1) DEFAULT 0,
        descriptions varchar(255),
        PRIMARY KEY (ProductID)
    );

    CREATE TABLE Orders (
        Orders_ID int AUTO_INCREMENT NOT NULL,
        ProductID int,
        ID_cus int;
        Orders_date date,
        FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
        FOREIGN KEY (ID_cus) REFERENCES Accounts(ID_cus),
        PRIMARY KEY (Orders_ID)
    );

    CREATE TABLE Orders_detail(
        Orders_ID int,
        ProductID int,
        Quantity int,
        foreign KEY (Orders_ID) REFERENCES Orders(Orders_ID),
        foreign KEY (ProductID) REFERENCES Products(ProductID)
    );

    CREATE TABLE Categories (
        CategoryID int AUTO_INCREMENT NOT NULL,
        CategoryName varchar(255),
        Description varchar(255),
        PRIMARY KEY (CategoryID)
    );
";

// Thực thi câu lệnh SQL
if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created successfully";
} else {
    echo "Error creating tables: " . $conn->error;
}

// Đóng kết nối
$conn->close();

?>
