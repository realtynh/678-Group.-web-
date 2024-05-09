USING Ecommercials;

CREATE TABLE Accounts (
ID_cus int NOT NULL,
FullName varchar(255),
  User_cus varchar(255),
  Pass_cus varchar(255),
  Birth date,
  Status TINYINT(1) DEFAULT 0,
 PRIMARY KEY (ID_cus)
  
);

CREATE TABLE Admins (
ID_ad int not NULL,
  Admin_name varchar(255),
  Admin_password varchar(255),
  Reg_date datetime,
  User_admins varchar(255),
    PRIMARY KEY (ID_ad)
);
CREATE TABLE Products (
  ProductID int not NULL,
  Product_Name varchar(255),
  Product_Img varchar(255),
  Product_Price int,
  status_product TINYINT(1) DEFAULT 0,
  PRIMARY KEY (ProductID)
  );
  CREATE TABLE Orders (
   Orders_ID int NOT NULL,
   ProductID int,
   Orders_date date,
   FOREIGN KEY (ProductID) REFERENCES Products(ProductID),
  );
  CREATE TABLE Orders_detail(
  	Orders_ID int,
    ProductID int,
    Quantity int,
    foreign KEY (Orders_ID) REFERENCES Orders(Orders_ID),
    foreign KEY (ProductID) REFERENCES Products(ProductID),
  
  );
  CREATE TABLE Categories (
    CategoryID int NOT NULL,
    CategoryName varchar(255),
    Description varchar(255),
  );