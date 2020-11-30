<?php  // Product Brands Class
Class ProdBrand {
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
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * exists function - Check if Product Brand Name already exists in DB
   * @param string $name       Product Brand Name
   * @return int $prodBrandID  ProdBrandID of record with selected Name or False
   */
  public function exists($name) {
    try {
      $sql = "SELECT `ProdBrandID` FROM `prod_brands` WHERE `Name` = '$name'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $prodBrandID = $stmt->fetchColumn();
      return $prodBrandID;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/exists Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * add function - Add Product Brand Record
   * @param string $name  Product Brand Name
   * @param int $status   Product Brand Status (Optional)
   * @return int $newID   ProdBrandID of added Product Brand or False
   */
  public function add($name, $status = 1) {
    try {
      // Check Product Brand Name does not already exist
      $exists = $this->exists($name);
      if (!empty($exists)) {  // Name is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Product Brand Name '$name' is already in use! Please try again.");
        return false;
      } else {  // Insert Product Brand Record
        $editID = $_SESSION["userID"];
        $sql = "INSERT INTO `prod_brands` (`Name`, `EditTimestamp`, `EditUserID`, `Status`) VALUES ('$name', CURRENT_TIMESTAMP(), '$editID', '$status')";
        $this->conn->exec($sql);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = msgPrep("success", "Product Brand '$name' added successfully as ID '$newID'.");
        return $newID;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/add Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getBrands function - Retrieve all Product Brand records sorted by name
   * @param int $status     Product Brand Status (Optional)
   * @return array $result  Returns all prod_brands records or False
   */
  public function getBrands($status = null) {
    try {
      if ($status == null) {
        $sql = "SELECT `ProdBrandID`, `Name` FROM `prod_brands` ORDER BY `Name`";
      } else {
        $sql = "SELECT `ProdBrandID`, `Name` FROM `prod_brands` WHERE `Status` = '$status' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/getBrands Failed: " . $err->getMessage());
    }
  }

  /**
   * getList function - Get full list of Product Brand records
   * @param string $name    Product Brand Name (Optional)
   * @return array $result  Details of all/selected Product Brands (Name order) or False
   */
  public function getList($name = null) {
    try {
      if ($name == null) {
        $sql = "SELECT * FROM `prod_brands` ORDER BY `Name`";
      } else {
        $sql = "SELECT * FROM `prod_brands` WHERE `Name` LIKE '%$name%' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/getList Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getRecord function - Retrieve single Product Brand record
   * @param int $prodBrandID  Product Brand ID of required record
   * @return array $result    Returns selected Product Brand record or False 
   */
  public function getRecord($prodBrandID) {
    try {
      $sql = "SELECT * FROM `prod_brands` WHERE `ProdBrandID` = '$prodBrandID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/getRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateRecord function - Update an existing Product Brand record
   * @param int $prodBrandID  Product Brand ID of record being updated
   * @param string $name      Product Brand Name
   * @param int $status       Product Brand Status
   * @return int $result      Number of records updated (=1) or False
   */
  public function updateRecord($prodBrandID, $name, $status) {
    try {
      // Check new Name does not already exist (other than in current record)
      $exists = $this->exists($name);
      if (!empty($exists) && $exists != $prodBrandID) {  // Name is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Product Brand Name '$name' is already in use! Please try again.");
        return false;
      } else {
        $editID = $_SESSION["userID"];
        $sql = "UPDATE `prod_brands` SET `Name` = '$name', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `ProdBrandID` = $prodBrandID";
        $result = $this->conn->exec($sql);
        if ($result == 1) {  // Only 1 record should be updated
          $_SESSION["message"] = msgPrep("success", "Update of Product Brand ID '$prodBrandID' was successful.");
        } else {
          throw new PDOException("0 or >1 record was updated.");
        }
        return $result;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/updateRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing Product Brand record
   * @param int $prodBrandID   Product Brand ID of record being updated
   * @param int $status        New Product Brand Status
   * @return int $result       Number of records updated (=1) or False
   */
  public function updateStatus($prodBrandID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `prod_brands` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `ProdBrandID` = '$prodBrandID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>