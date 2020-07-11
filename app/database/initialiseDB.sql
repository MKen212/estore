/* Database and Table Initialisation SQL Statements for estore*/

-- Create libraryms main database
CREATE DATABASE IF NOT EXISTS estore;

-- Use estore database
USE estore;

-- Create Countries table
CREATE TABLE IF NOT EXISTS countries (
  `Code` VARCHAR(2) NOT NULL UNIQUE,
  `Name` VARCHAR(50) NOT NULL
);
-- For Country Data see end of file...

-- Create users table
CREATE TABLE IF NOT EXISTS users (
  `UserID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Username` VARCHAR(40) NOT NULL UNIQUE,
  `Password` VARCHAR(100) NOT NULL,
  `FullName` VARCHAR(50) NOT NULL,
  `Address1` VARCHAR(50) NOT NULL,
  `Address2` VARCHAR(50) DEFAULT NULL,
  `City` VARCHAR(50) NOT NULL,
  `Region` VARCHAR(50) DEFAULT NULL,
  `CountryCode` VARCHAR(2) NOT NULL,
  `Postcode` VARCHAR(20) NOT NULL,
  `Email` VARCHAR (50),
  `ContactNo` VARCHAR(50),
  `IsAdmin` TINYINT(1) NOT NULL DEFAULT 0, -- 0=NotAdmin/1=Admin
  `Status` TINYINT(1) NOT NULL DEFAULT 0,  -- 0=Unapproved/1=Approved
  FOREIGN KEY (`CountryCode`) REFERENCES countries (`Code`)
);

-- Load initial test users - Better to use user-registration.php to ensure Password Hashing

-- Manually Update UserStatus and IsAdmin settings for test users
UPDATE users SET `Status` = "1" WHERE `UserID` = 1 OR `UserID` = 2;
UPDATE users SET `IsAdmin` = "1" WHERE `UserID` = 1;

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
  FOREIGN KEY (`EditUserID`) REFERENCES users (`UserID`)
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
  `OrderID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `OrderItems` INT(11) DEFAULT NULL,
  `OrderValue` DECIMAL(10, 2) DEFAULT NULL,
  `OrderStatus` TINYINT(1) NOT NULL DEFAULT 0,  -- 0=InProgress/1=Shipped
  `UserID` INT(11) DEFAULT NULL,
  `FullName` VARCHAR(50) NOT NULL,
  `Address1` VARCHAR(50) NOT NULL,
  `Address2` VARCHAR(50) DEFAULT NULL,
  `City` VARCHAR(50) NOT NULL,
  `Region` VARCHAR(50) DEFAULT NULL,
  `CountryCode` VARCHAR(2) NOT NULL,
  `Postcode` VARCHAR(20) NOT NULL,
  `Email` VARCHAR(50) NOT NULL,
  `ContactNo` VARCHAR(50) DEFAULT NULL,
  `ShipFullName` VARCHAR(50) NOT NULL,
  `ShipAddress1` VARCHAR(50) NOT NULL,
  `ShipAddress2` VARCHAR(50) DEFAULT NULL,
  `ShipCity` VARCHAR(50) NOT NULL,
  `ShipRegion` VARCHAR(50) DEFAULT NULL,
  `ShipCountryCode` VARCHAR(2) NOT NULL,
  `ShipPostcode` VARCHAR(20) NOT NULL,
  `ShipEmail` VARCHAR(50) NOT NULL,
  `ShipContactNo` VARCHAR(50) DEFAULT NULL,
  `ShipInstructions` VARCHAR(500) DEFAULT NULL,
  FOREIGN KEY (`UserID`) REFERENCES users (`UserID`),
  FOREIGN KEY (`BillCountryCode`) REFERENCES countries (`code`),
  FOREIGN KEY (`ShipCountryCode`) REFERENCES countries (`code`)
);

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

-- Countries data
INSERT INTO countries (`Code`, `Name`) VALUES
  ("AD","Andorra"),
  ("AE","United Arab Emirates"),
  ("AF","Afghanistan"),
  ("AG","Antigua and Barbuda"),
  ("AI","Anguilla"),
  ("AL","Albania"),
  ("AM","Armenia"),
  ("AO","Angola"),
  ("AQ","Antarctica"),
  ("AR","Argentina"),
  ("AS","American Samoa"),
  ("AT","Austria"),
  ("AU","Australia"),
  ("AW","Aruba"),
  ("AX","Åland"),
  ("AZ","Azerbaijan"),
  ("BA","Bosnia and Herzegovina"),
  ("BB","Barbados"),
  ("BD","Bangladesh"),
  ("BE","Belgium"),
  ("BF","Burkina Faso"),
  ("BG","Bulgaria"),
  ("BH","Bahrain"),
  ("BI","Burundi"),
  ("BJ","Benin"),
  ("BL","Saint Barthélemy"),
  ("BM","Bermuda"),
  ("BN","Brunei"),
  ("BO","Bolivia"),
  ("BQ","Bonaire"),
  ("BR","Brazil"),
  ("BS","Bahamas"),
  ("BT","Bhutan"),
  ("BV","Bouvet Island"),
  ("BW","Botswana"),
  ("BY","Belarus"),
  ("BZ","Belize"),
  ("CA","Canada"),
  ("CC","Cocos [Keeling] Islands"),
  ("CD","Democratic Republic of the Congo"),
  ("CF","Central African Republic"),
  ("CG","Republic of the Congo"),
  ("CH","Switzerland"),
  ("CI","Ivory Coast"),
  ("CK","Cook Islands"),
  ("CL","Chile"),
  ("CM","Cameroon"),
  ("CN","China"),
  ("CO","Colombia"),
  ("CR","Costa Rica"),
  ("CU","Cuba"),
  ("CV","Cape Verde"),
  ("CW","Curacao"),
  ("CX","Christmas Island"),
  ("CY","Cyprus"),
  ("CZ","Czech Republic"),
  ("DE","Germany"),
  ("DJ","Djibouti"),
  ("DK","Denmark"),
  ("DM","Dominica"),
  ("DO","Dominican Republic"),
  ("DZ","Algeria"),
  ("EC","Ecuador"),
  ("EE","Estonia"),
  ("EG","Egypt"),
  ("EH","Western Sahara"),
  ("ER","Eritrea"),
  ("ES","Spain"),
  ("ET","Ethiopia"),
  ("FI","Finland"),
  ("FJ","Fiji"),
  ("FK","Falkland Islands"),
  ("FM","Micronesia"),
  ("FO","Faroe Islands"),
  ("FR","France"),
  ("GA","Gabon"),
  ("GB","United Kingdom"),
  ("GD","Grenada"),
  ("GE","Georgia"),
  ("GF","French Guiana"),
  ("GG","Guernsey"),
  ("GH","Ghana"),
  ("GI","Gibraltar"),
  ("GL","Greenland"),
  ("GM","Gambia"),
  ("GN","Guinea"),
  ("GP","Guadeloupe"),
  ("GQ","Equatorial Guinea"),
  ("GR","Greece"),
  ("GS","South Georgia and the South Sandwich Islands"),
  ("GT","Guatemala"),
  ("GU","Guam"),
  ("GW","Guinea-Bissau"),
  ("GY","Guyana"),
  ("HK","Hong Kong"),
  ("HM","Heard Island and McDonald Islands"),
  ("HN","Honduras"),
  ("HR","Croatia"),
  ("HT","Haiti"),
  ("HU","Hungary"),
  ("ID","Indonesia"),
  ("IE","Ireland"),
  ("IL","Israel"),
  ("IM","Isle of Man"),
  ("IN","India"),
  ("IO","British Indian Ocean Territory"),
  ("IQ","Iraq"),
  ("IR","Iran"),
  ("IS","Iceland"),
  ("IT","Italy"),
  ("JE","Jersey"),
  ("JM","Jamaica"),
  ("JO","Jordan"),
  ("JP","Japan"),
  ("KE","Kenya"),
  ("KG","Kyrgyzstan"),
  ("KH","Cambodia"),
  ("KI","Kiribati"),
  ("KM","Comoros"),
  ("KN","Saint Kitts and Nevis"),
  ("KP","North Korea"),
  ("KR","South Korea"),
  ("KW","Kuwait"),
  ("KY","Cayman Islands"),
  ("KZ","Kazakhstan"),
  ("LA","Laos"),
  ("LB","Lebanon"),
  ("LC","Saint Lucia"),
  ("LI","Liechtenstein"),
  ("LK","Sri Lanka"),
  ("LR","Liberia"),
  ("LS","Lesotho"),
  ("LT","Lithuania"),
  ("LU","Luxembourg"),
  ("LV","Latvia"),
  ("LY","Libya"),
  ("MA","Morocco"),
  ("MC","Monaco"),
  ("MD","Moldova"),
  ("ME","Montenegro"),
  ("MF","Saint Martin"),
  ("MG","Madagascar"),
  ("MH","Marshall Islands"),
  ("MK","North Macedonia"),
  ("ML","Mali"),
  ("MM","Myanmar [Burma]"),
  ("MN","Mongolia"),
  ("MO","Macao"),
  ("MP","Northern Mariana Islands"),
  ("MQ","Martinique"),
  ("MR","Mauritania"),
  ("MS","Montserrat"),
  ("MT","Malta"),
  ("MU","Mauritius"),
  ("MV","Maldives"),
  ("MW","Malawi"),
  ("MX","Mexico"),
  ("MY","Malaysia"),
  ("MZ","Mozambique"),
  ("NA","Namibia"),
  ("NC","New Caledonia"),
  ("NE","Niger"),
  ("NF","Norfolk Island"),
  ("NG","Nigeria"),
  ("NI","Nicaragua"),
  ("NL","Netherlands"),
  ("NO","Norway"),
  ("NP","Nepal"),
  ("NR","Nauru"),
  ("NU","Niue"),
  ("NZ","New Zealand"),
  ("OM","Oman"),
  ("PA","Panama"),
  ("PE","Peru"),
  ("PF","French Polynesia"),
  ("PG","Papua New Guinea"),
  ("PH","Philippines"),
  ("PK","Pakistan"),
  ("PL","Poland"),
  ("PM","Saint Pierre and Miquelon"),
  ("PN","Pitcairn Islands"),
  ("PR","Puerto Rico"),
  ("PS","Palestine"),
  ("PT","Portugal"),
  ("PW","Palau"),
  ("PY","Paraguay"),
  ("QA","Qatar"),
  ("RE","Réunion"),
  ("RO","Romania"),
  ("RS","Serbia"),
  ("RU","Russia"),
  ("RW","Rwanda"),
  ("SA","Saudi Arabia"),
  ("SB","Solomon Islands"),
  ("SC","Seychelles"),
  ("SD","Sudan"),
  ("SE","Sweden"),
  ("SG","Singapore"),
  ("SH","Saint Helena"),
  ("SI","Slovenia"),
  ("SJ","Svalbard and Jan Mayen"),
  ("SK","Slovakia"),
  ("SL","Sierra Leone"),
  ("SM","San Marino"),
  ("SN","Senegal"),
  ("SO","Somalia"),
  ("SR","Suriname"),
  ("SS","South Sudan"),
  ("ST","São Tomé and Príncipe"),
  ("SV","El Salvador"),
  ("SX","Sint Maarten"),
  ("SY","Syria"),
  ("SZ","Swaziland"),
  ("TC","Turks and Caicos Islands"),
  ("TD","Chad"),
  ("TF","French Southern Territories"),
  ("TG","Togo"),
  ("TH","Thailand"),
  ("TJ","Tajikistan"),
  ("TK","Tokelau"),
  ("TL","East Timor"),
  ("TM","Turkmenistan"),
  ("TN","Tunisia"),
  ("TO","Tonga"),
  ("TR","Turkey"),
  ("TT","Trinidad and Tobago"),
  ("TV","Tuvalu"),
  ("TW","Taiwan"),
  ("TZ","Tanzania"),
  ("UA","Ukraine"),
  ("UG","Uganda"),
  ("UM","U.S. Minor Outlying Islands"),
  ("US","United States"),
  ("UY","Uruguay"),
  ("UZ","Uzbekistan"),
  ("VA","Vatican City"),
  ("VC","Saint Vincent and the Grenadines"),
  ("VE","Venezuela"),
  ("VG","British Virgin Islands"),
  ("VI","U.S. Virgin Islands"),
  ("VN","Vietnam"),
  ("VU","Vanuatu"),
  ("WF","Wallis and Futuna"),
  ("WS","Samoa"),
  ("XK","Kosovo"),
  ("YE","Yemen"),
  ("YT","Mayotte"),
  ("ZA","South Africa"),
  ("ZM","Zambia"),
  ("ZW","Zimbabwe");
