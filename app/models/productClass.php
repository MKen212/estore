<?php  // Product Class
class Product {
  private $conn;  // PDO database connection object

  /**
   * Construct function - Create the database connection object
   */
  public function __construct() {
    try {
      $connString = "mysql:host=" . DBSERVER["servername"] . ";dbname=" . DBSERVER["database"];
      $this->conn = new PDO($connString, DBSERVER["username"], DBSERVER["password"]);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * exists function - Check if Product Name already exists in DB
   * @param string $name  Product Name
   * @return int $count   Count of Product Records with selected Name or False
   */
  public function exists($name) {
    try {
      $sql = "SELECT `Name` FROM `products` WHERE `Name` = '$name'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      return $count;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/exists Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * count function - Get COUNT of product records (with optional conditions)
   * @param int $status       Product Status (Optional)
   * @param int $prodCatID    Product Category ID (Optional)
   * @param int $prodBrandID  Product Brand ID (Optional)
   * @return int $result      Returns count of defined product records or False 
   */
  public function count($status = null, $prodCatID = null, $prodBrandID = null) {
    try {
      if ($status == null && $prodCatID == null && $prodBrandID == null) {  // Count ALL records
        $sql = "SELECT COUNT(*) FROM `products`";
      } else {
        // Build WHERE clause
        $whereClause = "";
        if (!empty($status)) $whereClause .= "(`Status` = '$status')";
        if (!empty($prodCatID)) {
          if (!empty($whereClause)) $whereClause .= " AND ";
          $whereClause .= "(`ProdCatID` = '$prodCatID')";
        }
        if (!empty($prodBrandID)) {
          if (!empty($whereClause)) $whereClause .= " AND ";
          $whereClause .= "(`ProdBrandID` = '$prodBrandID')";
        }
        $sql = "SELECT COUNT(*) FROM `products` WHERE ($whereClause)";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/count Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * add function - Add Product record
   * @param string $name         Product Name
   * @param string $description  Product Description
   * @param int $prodCatID       Product Category ID
   * @param int $prodBrandID     Product Brand ID
   * @param float $price         Product Price
   * @param int $weightGrams     Product Shipping Weight in Grams
   * @param int $qtyAvail        Quantity of Product Available
   * @param string $imgFilename  Filename for Product Image
   * @param int $flag            Product Flag (Optional)
   * @param int $status          Product Status (Optional)
   * @return int $newID          Product ID of added product or False
   */
  public function add($name, $description, $prodCatID, $prodBrandID, $price, $weightGrams, $qtyAvail, $imgFilename, $flag = 0, $status = 1) {
    try {
      // Check Product Name does not already exist
      $count = $this->exists($name);
      if ($count != 0) {  // Name is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Product Name '$name' is already in use! Please try again.");
        return false;
      } else {  // Insert Product Record
        $editID = $_SESSION["userID"];
        $sql = "INSERT INTO `products` (`Name`, `Description`, `ProdCatID`, `ProdBrandID`, `Price`, `WeightGrams`, `QtyAvail`, `ImgFilename`, `EditTimestamp`, `EditUserID`, `Flag`, `Status`) VALUES ('$name', '$description', '$prodCatID', '$prodBrandID', '$price', '$weightGrams', '$qtyAvail', '$imgFilename', CURRENT_TIMESTAMP(), '$editID', '$flag', '$status')";
        $this->conn->exec($sql);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = "Product '$name' added successfully as Product ID '$newID'.";
        return $newID;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/add Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getPage function - Retrieve Page of product records (with optional conditions)
   * @param int $limit        Max number of records to return
   * @param int $offset       Offset of first record
   * @param int $status       Product Status (Optional)
   * @param int $prodCatID    Product Category ID (Optional)
   * @param int $prodBrandID  Product Brand ID (Optional)
   * @return array $result    Returns defined product records or False 
   */
  public function getPage($limit, $offset, $status = null, $prodCatID = null, $prodBrandID = null) {
    try {
      if ($status == null && $prodCatID == null && $prodBrandID == null) {  // Select ALL records
        $sql = "SELECT `ImgFilename`, `Price`, `Name`, `ProductID`, `Flag` FROM `products` LIMIT $limit OFFSET $offset";
      } else {
        // Build WHERE clause
        $whereClause = "";
        if (!empty($status)) $whereClause .= "(`Status` = '$status')";
        if (!empty($prodCatID)) {
          if (!empty($whereClause)) $whereClause .= " AND ";
          $whereClause .= "(`ProdCatID` = '$prodCatID')";
        }
        if (!empty($prodBrandID)) {
          if (!empty($whereClause)) $whereClause .= " AND ";
          $whereClause .= "(`ProdBrandID` = '$prodBrandID')";
        }
        $sql = "SELECT `ImgFilename`, `Price`, `Name`, `ProductID`, `Flag` FROM `products` WHERE ($whereClause) LIMIT $limit OFFSET $offset";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/getPage Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getCarousel function - Retrieve random set of product records with specified flag
   * @param int $limit      Max number of records to return
   * @param int $flag       Product Flag
   * @return array $result  Returns random flagged product records or False
   */
  public function getCarousel($limit, $flag) {
    try {
      $sql = "SELECT `ImgFilename`, `Price`, `Name`, `ProductID`, `Flag` FROM `products` WHERE `Flag` = '$flag' ORDER BY RAND() LIMIT $limit";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/getCarousel Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getList function - Get full list of product records using prod_uncoded_view
   * @param string $name    Product Name (Optional)
   * @return array $result  Details of all/selected products (Name order) or False
   */
  public function getList($name = null) {
    try {
      if ($name == null) {
        $sql = "SELECT * FROM `prod_uncoded_view` ORDER BY `Name`";
      } else {
        $sql = "SELECT * FROM `prod_uncoded_view` WHERE `Name` LIKE '%$name%' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/getList Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getRecordView function - Retrieve single product record using prod_uncoded_view
   * @param int $productID  Product ID of product required
   * @return array $result  Returns selected product record or False 
   */
  public function getRecordView($productID) {
    try {
      $sql = "SELECT * FROM `prod_uncoded_view` WHERE `ProductID` = '$productID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/getRecordView Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getRecord function - Retrieve single product record
   * @param int $productID  Product ID of product required
   * @return array $result  Returns selected product record or False 
   */
  public function getRecord($productID) {
    try {
      $sql = "SELECT * FROM `products` WHERE `ProductID` = '$productID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/getRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateRecord function - Update an existing product record
   * @param int $productID       Product ID of product being updated
   * @param string $name         Product Name
   * @param string $description  Product Description
   * @param int $prodCatID       Product Category ID
   * @param int $prodBrandID     Product Brand ID
   * @param float $price         Product Price
   * @param int $weightGrams     Product Shipping Weight in Grams
   * @param int $quantity        Quantity of Product Added
   * @param string $imgFilename  Filename for Product Image
   * @param int $editUserID      User ID who updated the product
   * @param int $flag            Product Flag
   * @param int $status          Product Status
   * @return int $result         Number of records updated (=1) or False
   */
  public function updateRecord($productID, $name, $description, $prodCatID, $prodBrandID, $price, $weightGrams, $qtyAvail, $imgFilename, $flag, $status) {
    try {
      // If updating name check new Name does not already exist
      $sqlName = "";
      if (!empty($name)) {
        $count = $this->exists($name);
        if ($count != 0) {  // Name is NOT unique
          $_SESSION["message"] = msgPrep("danger", "Error - Product Name '$name' is already in use! Please try again.");
          return false;
        } else {
          $sqlName = "`Name` = '$name', ";
        }
      }
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `products` SET {$sqlName}`Description` = '$description', `ProdCatID` = '$prodCatID', `ProdBrandID` = '$prodBrandID', `Price` = '$price', `WeightGrams` = '$weightGrams',  `QtyAvail` = '$qtyAvail', `ImgFilename` = '$imgFilename', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Flag` = '$flag', `Status` = '$status' WHERE `ProductID` = $productID";
      $result = $this->conn->exec($sql);
      if ($result == 1) {  // Only 1 record should be updated
        $_SESSION["message"] = "Update of Product ID '$productID' was successful.";
      } else {
        throw new PDOException("0 or >1 record was updated.");
      }
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/updateRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing product record
   * @param int $productID   Product ID of product being updated
   * @param int $status      New Product Status
   * @return int $result     Number of records updated (=1) or False
   */
  public function updateStatus($productID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `products` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `ProductID` = '$productID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateFlag function - Update Flag field of an existing product record
   * @param int $productID  Product ID of product being updated
   * @param int $flag       New Product Flag Status
   * @return int $result    Number of records updated (=1) or False
   */
  public function updateFlag($productID, $flag) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `products` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Flag` = '$flag' WHERE `ProductID` = '$productID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/updateFlag Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateQtyAvail function - Update Quantity Available for specific product record
   * @param int $productID    Product ID of product being updated
   * @param int $qtyAvailChg  (+/-)Quantity to change in QtyAvail field
   * @return int $result      Number of records updated or False
   */
  public function updateQtyAvail($productID, $qtyAvailChg) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `products` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `QtyAvail` = (`QtyAvail` + $qtyAvailChg) WHERE `ProductID` = '$productID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/updateQtyAvail Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>