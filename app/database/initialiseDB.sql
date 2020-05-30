/* Database and Table Initialisation SQL Statements for estore*/

-- Create libraryms main database
CREATE DATABASE IF NOT EXISTS estore;

-- Use estore database
USE estore;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
  UserID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Username VARCHAR(40) NOT NULL UNIQUE,
  Password VARCHAR(100) NOT NULL,
  FirstName VARCHAR(40),
  LastName VARCHAR (40),
  Email VARCHAR (40),
  ContactNo VARCHAR(40),
  IsAdmin TINYINT(1) NOT NULL DEFAULT 0, -- 0=NotAdmin/1=Admin
  UserStatus TINYINT(1) NOT NULL DEFAULT 0  -- 0=Unapproved/1=Approved
);

/*
-- Load initial test users - Better to use registration.php for Password Hashing
INSERT INTO users
  (UserName, UserPassword, FirstName, LastName, Email, ContactNo, IsAdmin, UserStatus) VALUES
  ("UserTest", "####", "User", "Test", "usertest@gmail.com", "12345", "0", "1"),
  ("AdminTest", "####", "Admin", "Test", "admintest@gmail.com", "98765", "1", "1");

-- Manually Update User and Admin Status for test users
UPDATE users SET UserStatus = "1" WHERE UserID = 1 OR UserID = 2;
UPDATE users SET IsAdmin = "1" WHERE UserID = 2;

-- Create books table
CREATE TABLE IF NOT EXISTS books (
  BookID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Title VARCHAR(40) NOT NULL,
  Author VARCHAR(40) NOT NULL,
  Publisher VARCHAR(40) NOT NULL,
  ISBN VARCHAR(40) DEFAULT NULL,
  PriceGBP DECIMAL(6, 2) DEFAULT 0.00,
  QtyTotal INT(11) NOT NULL DEFAULT 0,
  QtyAvail INT(11) NOT NULL DEFAULT 0,
  ImgFilename VARCHAR(40) DEFAULT NULL,
  AddedDate DATE DEFAULT NULL,
  UserID INT(11) NOT NULL,
  BookStatus TINYINT(1) NOT NULL DEFAULT 1, --0=Deleted/1=Active
  FOREIGN KEY (UserID) REFERENCES users (UserID)
);

-- Create books_issued table
CREATE TABLE IF NOT EXISTS books_issued (
  IssuedID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  BookID INT(11) NOT NULL,
  UserID INT(11) NOT NULL,
  IssuedDate DATE NOT NULL,
  ReturnDueDate DATE NOT NULL,
  ReturnedDate DATE DEFAULT NULL,
  FOREIGN KEY (BookID) REFERENCES books (BookID),
  FOREIGN KEY (UserID) REFERENCES users (UserID)
);

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
