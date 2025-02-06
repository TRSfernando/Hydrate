drop DATABASE if EXISTS hydrate;

CREATE DATABASE hydrate;

USE
    hydrate;
CREATE TABLE UserProfile(
    Username VARCHAR(20) PRIMARY KEY,
    Password VARCHAR(15),
    FullName VARCHAR(50),
    Email VARCHAR(50),
    PhoneNo VARCHAR(10),
    Address VARCHAR(100),
    ProfilePicture BLOB
); 

INSERT INTO UserProfile(Username, Password, FullName, Email, PhoneNo, Address, ProfilePicture) 
VALUES
	('admin', 'Admin@123','Admin' ,'admin@gmail.com', '0123456789', '321/1 Isuru Chathuranga Mawatha, Wattala', null),
	('raneesha', 'Raneesha@123','Raneesha' ,'raneesha@gmail.com', '0123456789', '72/2 Cinnamon Garden Road, Ja-Ela', null);
    
CREATE TABLE Product(
    ProductId CHAR(5) PRIMARY KEY,
    ProductName VARCHAR(50),
    Ingrediants VARCHAR(100),
    Flavor VARCHAR(20),
    Price FLOAT,
    ProductImage BLOB
); 

CREATE TABLE Cart(
    CartId CHAR(5) PRIMARY KEY,
    Username VARCHAR(20),
    FOREIGN KEY(Username) REFERENCES UserProfile(Username) ON DELETE CASCADE
); 

CREATE TABLE CartProduct(
    CartId CHAR(5),
    ProductId CHAR(5),
    Quantity INT,
    Toppings VARCHAR(100),
    TotalProductPrice FLOAT,
    PRIMARY KEY(CartId, ProductId),
    FOREIGN KEY(CartId) REFERENCES Cart(CartId) ON DELETE CASCADE,
    FOREIGN KEY(ProductId) REFERENCES Product(ProductId) ON DELETE CASCADE
); 

CREATE TABLE Orders(
    OrderId CHAR(5) PRIMARY KEY,
    Username VARCHAR(20),
    TotalOrderPrice FLOAT,
    FOREIGN KEY(Username) REFERENCES UserProfile(Username) ON DELETE CASCADE
); 

CREATE TABLE OrderProduct(
    OrderId CHAR(5),
    ProductId CHAR(5),
    TotalOrderPrice FLOAT,
    PRIMARY KEY(OrderId, ProductId),
    FOREIGN KEY(OrderId) REFERENCES Orders(OrderId) ON DELETE CASCADE,
    FOREIGN KEY(ProductId) REFERENCES CartProduct(ProductId) ON DELETE CASCADE
); 

CREATE TABLE Payment(
    PaymentId CHAR(5) PRIMARY KEY,
    OrderId CHAR(5),
    PaymentMethod VARCHAR(50),
    PaymentStatus VARCHAR(50),
    FOREIGN KEY(OrderId) REFERENCES Orders(OrderId) ON DELETE CASCADE
);

