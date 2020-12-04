<?php  // Product Categories Class
Class ProdCat {
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
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/DB Connection Failed: {$err->getMessage()}");
    }
  }

  /**
   * exists function - Check if Product Category Name already exists in DB
   * @param string $name     Product Category Name
   * @return int $prodCatID  ProdCatID of record with selected Name or False
   */
  public function exists($name) {
    try {
      $sql = "SELECT `ProdCatID` FROM `prod_categories` WHERE `Name` = '{$name}'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $prodCatID = $stmt->fetchColumn();
      return $prodCatID;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/exists Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * add function - Add Product Category Record
   * @param string $name  Product Category Name
   * @param int $status   Product Category Status (Optional)
   * @return int $newID   ProdCatID of added Product Category or False
   */
  public function add($name, $status = 1) {
    try {
      // Check Product Category Name does not already exist
      $exists = $this->exists($name);
      if (!empty($exists)) {  // Name is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Product Category Name '{$name}' is already in use! Please try again.");
        return false;
      } else {  // Insert Product Category Record
        $editID = $_SESSION["userID"];
        $sql = "INSERT INTO `prod_categories` (`Name`, `EditTimestamp`, `EditUserID`, `Status`) VALUES ('{$name}', CURRENT_TIMESTAMP(), '{$editID}', '{$status}')";
        $this->conn->exec($sql);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = msgPrep("success", "Product Category '{$name}' added successfully as ID '{$newID}'.");
        return $newID;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/add Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * getCategories function - Retrieve all Product Category records sorted by name
   * @param int $status     Product Category Status (Optional)
   * @return array $result  Returns all prod_categories records or False
   */
  public function getCategories($status = null) {
    try {
      if ($status == null) {
        $sql = "SELECT `ProdCatID`, `Name` FROM `prod_categories` ORDER BY `Name`";
      } else {
        $sql = "SELECT `ProdCatID`, `Name` FROM `prod_categories` WHERE `Status` = '{$status}' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/getCategories Failed: {$err->getMessage()}");
    }
  }

  /**
   * getList function - Get full list of Product Category records
   * @param string $name    Product Category Name (Optional)
   * @return array $result  Details of all/selected Product Categories (Name order) or False
   */
  public function getList($name = null) {
    try {
      if ($name == null) {
        $sql = "SELECT * FROM `prod_categories` ORDER BY `Name`";
      } else {
        $sql = "SELECT * FROM `prod_categories` WHERE `Name` LIKE '%{$name}%' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/getList Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * getRecord function - Retrieve single Product Category record
   * @param int $prodCatID  Product Category ID of required record
   * @return array $result  Returns selected Product Category record or False 
   */
  public function getRecord($prodCatID) {
    try {
      $sql = "SELECT * FROM `prod_categories` WHERE `ProdCatID` = '{$prodCatID}'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/getRecord Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * updateRecord function - Update an existing Product Category record
   * @param int $prodCatID  Product Category ID of record being updated
   * @param string $name    Product Category Name
   * @param int $status     Product Category Status
   * @return int $result    Number of records updated (=1) or False
   */
  public function updateRecord($prodCatID, $name, $status) {
    try {
      // Check new Name does not already exist (other than in current record)
      $exists = $this->exists($name);
      if (!empty($exists) && $exists != $prodCatID) {  // Name is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Product Category Name '{$name}' is already in use! Please try again.");
        return false;
      } else {
        $editID = $_SESSION["userID"];
        $sql = "UPDATE `prod_categories` SET `Name` = '{$name}', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '{$editID}', `Status` = '{$status}' WHERE `ProdCatID` = {$prodCatID}";
        $result = $this->conn->exec($sql);
        if ($result == 1) {  // Only 1 record should be updated
          $_SESSION["message"] = msgPrep("success", "Update of Product Category ID '{$prodCatID}' was successful.");
        } else {
          throw new PDOException("0 or >1 record was updated.");
        }
        return $result;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/updateRecord Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing Product Category record
   * @param int $prodCatID   Product Category ID of record being updated
   * @param int $status      New Product Category Status
   * @return int $result     Number of records updated (=1) or False
   */
  public function updateStatus($prodCatID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `prod_categories` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '{$editID}', `Status` = '{$status}' WHERE `ProdCatID` = '{$prodCatID}'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/updateStatus Failed: {$err->getMessage()}");
      return false;
    }
  }
}
?>