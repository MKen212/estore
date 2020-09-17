/* Database and Table Initialisation SQL Statements for estore*/

-- Create estore main database
CREATE DATABASE IF NOT EXISTS estore;

-- Use estore database
USE estore;

-- Create Countries table
CREATE TABLE IF NOT EXISTS countries (
  `Code` VARCHAR(2) NOT NULL UNIQUE PRIMARY KEY,
  `Name` VARCHAR(50) NOT NULL,
  `ShippingBand` VARCHAR(50) NOT NULL,
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `Status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=Inactive, 1=Active"
);
-- For Country Initial Data see initialData.sql...

-- Create Shipping table
CREATE TABLE IF NOT EXISTS shipping (
  `ShippingID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Band` VARCHAR(50) NOT NULL,
  `Type` VARCHAR(50) NOT NULL,
  `PriceBandKG` INT(11) DEFAULT 0,
  `PriceBandCost` DECIMAL(10, 2) DEFAULT 0.00,
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `Status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=Inactive, 1=Active"
);
-- For Shipping Initial Data see see initialData.sql...

-- Create Product Categories table
CREATE TABLE IF NOT EXISTS prod_categories (
  `ProdCatID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` VARCHAR(40) NOT NULL UNIQUE,
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `Status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=Inactive, 1=Active"
);
-- For Product Category Initial Data see initialData.sql...

-- Create Product Brands table
CREATE TABLE IF NOT EXISTS prod_brands (
  `ProdBrandID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` VARCHAR(40) NOT NULL UNIQUE,
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `Status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=Inactive, 1=Active"
);
-- For Product Brand Initial Data see initialData.sql...

-- Create users table
CREATE TABLE IF NOT EXISTS users (
  `UserID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Email` VARCHAR (50) NOT NULL UNIQUE,
  `Password` VARCHAR(100) NOT NULL,
  `Name` VARCHAR(50) NOT NULL,
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `LoginTimestamp` TIMESTAMP DEFAULT 0,
  `IsAdmin` TINYINT(1) NOT NULL DEFAULT 0 COMMENT "0=No, 1=Yes",
  `Status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=Inactive, 1=Active"
);

-- Load initial test users using admin.php?p=register to ensure Password Hashing

-- Manually Update IsAdmin Status for test user(s)
UPDATE users SET `IsAdmin` = "1" WHERE `UserID` = 1;

-- Create products table
CREATE TABLE IF NOT EXISTS products (
  `ProductID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` VARCHAR(40) NOT NULL UNIQUE,
  `Description` VARCHAR(500) NOT NULL,
  `ProdCatID` INT(11) NOT NULL,
  `ProdBrandID` INT(11) NOT NULL,
  `Price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `WeightGrams` INT(11) NOT NULL DEFAULT 0,
  `QtyAvail` INT(11) NOT NULL DEFAULT 0,
  `ImgFilename` VARCHAR(40) DEFAULT NULL,
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `Flag` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=None, 1=New, 2=Sale",
  `Status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=Inactive, 1=Active",
  FOREIGN KEY (`ProdCatID`) REFERENCES prod_categories (`ProdCatID`),
  FOREIGN KEY (`ProdBrandID`) REFERENCES prod_brands (`ProdBrandID`)
);

-- Create products uncoded view
CREATE VIEW IF NOT EXISTS prod_uncoded_view AS SELECT
  `products`.`ProductID` AS `ProductID`,
  `products`.`Name` AS `Name`,
  `products`.`Description` AS `Description`,
  `prod_categories`.`Name` AS `Category`,
  `prod_brands`.`Name` AS `Brand`,
  `products`.`Price` AS `Price`,
  `products`.`WeightGrams` AS `WeightGrams`,
  `products`.`QtyAvail` AS `QtyAvail`,
  `products`.`ImgFilename` AS `ImgFilename`,
  `products`.`EditTimestamp` AS `EditTimestamp`,
  `products`.`EditUserID` AS `EditUserID`,
  `products`.`Flag` AS `Flag`,
  `products`.`Status` AS `Status`
  FROM products
  LEFT JOIN prod_categories ON `products`.`ProdCatID` = `prod_categories`.`ProdCatID`
  LEFT JOIN prod_brands ON `products`.`ProdBrandID` = `prod_brands`.`ProdBrandID`;

-- Create invoice_ID Sequence
CREATE SEQUENCE `invoice_ID` start with 16980 maxvalue 99999999999 increment by 1;

-- Create PayPal Orders table
CREATE TABLE IF NOT EXISTS paypal_orders (
  `PpInvoiceID` INT(11) NOT NULL PRIMARY KEY,
  `PpOrderID` VARCHAR(20) NOT NULL,
  `PpOrderStatus` VARCHAR(20) NOT NULL,
  `CurrencyCode` VARCHAR(5) NOT NULL,
  `Value` DECIMAL(10, 2) NOT NULL,
  `Shipping` VARCHAR(200),
  `PaymentID` VARCHAR(20),
  `PaymentStatus` VARCHAR(20),
  `PaymentCurrency` VARCHAR(5),
  `PaymentValue` DECIMAL(10, 2),
  `PayerID` VARCHAR(20),
  `PayerEmail` VARCHAR(100),
  `PayerName` VARCHAR(100),
  `CreateTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `CreateDebugID` VARCHAR(20),
  `CaptureTimestamp` TIMESTAMP DEFAULT 0,
  `CaptureDebugID` VARCHAR(20)
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
  `OrderID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `InvoiceID` INT(11) NOT NULL,
  `ItemCount` INT(11) DEFAULT 0,
  `ProductCount` INT(11) DEFAULT 0,
  `ShippingInstructions` VARCHAR(500) DEFAULT NULL,
  `ShippingWeightKG` DECIMAL(10,2) DEFAULT 0.00,
  `ShippingPriceBandKG` INT(11) DEFAULT 0,
  `ShippingCountry` VARCHAR(2) NOT NULL,
  `ShippingType` VARCHAR(50) NOT NULL,
  `SubTotal` DECIMAL(10, 2) DEFAULT 0.00,
  `ShippingCost` DECIMAL(10, 2) DEFAULT 0.00,
  `Total` DECIMAL(10, 2) DEFAULT 0.00,
  `AddedTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `OwnerUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `OrderStatus` TINYINT(1) NOT NULL DEFAULT 0 COMMENT "0=UnPaid, 1=Paid, 2=Shipped, 3=Returned, 4=Refunded, 5=Cancelled",
  `Status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=Inactive, 1=Active",
  FOREIGN KEY (`InvoiceID`) REFERENCES paypal_orders (`PpInvoiceID`)
);

-- Create order_items table
CREATE TABLE IF NOT EXISTS order_items (
  `OrderItemID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `OrderID` INT(11) NOT NULL,
  `ItemID` INT(11) NOT NULL,
  `ProductID` INT(11) NOT NULL,
  `Name` VARCHAR(40) NOT NULL,
  `Price` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
  `WeightGrams` INT(11) NOT NULL DEFAULT 0,
  `QtyOrdered` INT(11) NOT NULL DEFAULT 0,
  `ImgFilename` VARCHAR(40) DEFAULT NULL,
  `AddedToCartTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `ShippedTimestamp` TIMESTAMP DEFAULT 0,
  `ShippedUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL DEFAULT 0 COMMENT "0=Initial Creation",
  `OrderItemStatus` TINYINT(1) NOT NULL DEFAULT 0 COMMENT "0=UnSent, 1=Sent, 2=Returned",
  `Status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT "0=Inactive, 1=Active",
  FOREIGN KEY (`OrderID`) REFERENCES orders (`OrderID`),
  FOREIGN KEY (`ProductID`) REFERENCES products (`ProductID`)
);

-- Create orders with paypal view
CREATE VIEW IF NOT EXISTS ord_paypal_view AS
  SELECT * FROM orders
  LEFT JOIN paypal_orders ON `orders`.`InvoiceID` = `paypal_orders`.`PpInvoiceID`;


/*

-- Create messages table
CREATE TABLE IF NOT EXISTS messages (
  MessageID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  SenderID INT(11) NOT NULL,
  ReceiverID INT(11) NOT NULL,
  Subject VARCHAR(40) NOT NULL,
  Body VARCHAR(500) NOT NULL,
  MsgTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  MsgRead TINYINT(1) NOT NULL DEFAULT 0 COMMENT "0=Unread, 1=Read",
  FOREIGN KEY (SenderID) REFERENCES users (UserID),
  FOREIGN KEY (ReceiverID) REFERENCES users (UserID)
);

*/
