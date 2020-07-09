/* Database and Table Initialisation SQL Statements for estore*/

-- Create libraryms main database
CREATE DATABASE IF NOT EXISTS estore;

-- Use estore database
USE estore;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
  `UserID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Username` VARCHAR(40) NOT NULL UNIQUE,
  `Password` VARCHAR(100) NOT NULL,
  `FirstName` VARCHAR(40),
  `LastName` VARCHAR (40),
  `Email` VARCHAR (40),
  `ContactNo` VARCHAR(40),
  `IsAdmin` TINYINT(1) NOT NULL DEFAULT 0, -- 0=NotAdmin/1=Admin
  `Status` TINYINT(1) NOT NULL DEFAULT 0  -- 0=Unapproved/1=Approved
);

/*
-- Load initial test users - Better to use user-registration.php to ensure Password Hashing
INSERT INTO users
  (UserName, UserPassword, FirstName, LastName, Email, ContactNo, IsAdmin, UserStatus) VALUES
  ("AdminTest", "98765", "Admin", "Test", "admintest@gmail.com", "98765", "1", "1"),
  ("UserTest", 12345", "User", "Test", "usertest@gmail.com", "12345", "0", "1");
*/
-- Manually Update UserStatus and IsAdmin settings for test users
UPDATE users SET Status = "1" WHERE UserID = 1 OR UserID = 2;
UPDATE users SET IsAdmin = "1" WHERE UserID = 1;

-- Create products table
CREATE TABLE IF NOT EXISTS products (
  `ProductID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` VARCHAR(40) NOT NULL,
  `Description` VARCHAR(500) NOT NULL,
  `Category` VARCHAR(40) NOT NULL,
  `PriceLocal` DECIMAL(10, 2) DEFAULT 0.00,
  `QtyAvail` INT(11) NOT NULL DEFAULT 0,
  `ImgFilename` VARCHAR(40) DEFAULT NULL,
  `EditTimestamp` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  `EditUserID` INT(11) NOT NULL,
  `Status` TINYINT(1) NOT NULL DEFAULT 1,  -- 0=Inactive/1=Active
  FOREIGN KEY (EditUserID) REFERENCES users (UserID)
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
  `OrderID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `BillFullName` VARCHAR(50) NOT NULL,
  `BillAddress1` VARCHAR(50) NOT NULL,
  `BillAddress2` VARCHAR(50),
  `BillCity` VARCHAR(50) NOT NULL,
  `BillRegion` VARCHAR(50),
  `BillCountry` VARCHAR(50) NOT NULL,
  `BillPostcode` VARCHAR(20) NOT NULL,
  `BillEmail` VARCHAR(50) NOT NULL,
  `BillContact` VARCHAR(50) NOT NULL,


-- UP TO HERE SORTING ORDERS TABLE, ADDRESS STANDARDS, COUNTRY CODES, etc.

)

/*
-- Create messages table
CREATE TABLE IF NOT EXISTS messages (
  MessageID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  SenderID INT(11) NOT NULL,
  ReceiverID INT(11) NOT NULL,
  Subject VARCHAR(40) NOT NULL,
  Body VARCHAR(500) NOT NULL,
  MsgTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
  MsgRead TINYINT(1) NOT NULL DEFAULT 0,  --0=Unread/1=Read
  FOREIGN KEY (SenderID) REFERENCES users (UserID),
  FOREIGN KEY (ReceiverID) REFERENCES users (UserID)
);

*/
