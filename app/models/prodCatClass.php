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
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * exists function - Check if Product Category Name already exists in DB
   * @param string $name  Product Category Name
   * @return int $count   Count of prod_categories records with selected Name or False
   */
  public function exists($name) {
    try {
      $sql = "SELECT `Name` FROM `prod_categories` WHERE `Name` = '$name'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      return $count;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/exists Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getCategories function - Retrieve all Product Category records sorted by name
   * @return array $result  Returns all prod_categories records or False
   */
  public function getCategories() {
    try {
      $sql = "SELECT `ProdCatID`, `Name` FROM `prod_categories` ORDER BY `Name`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/getCategories Failed: " . $err->getMessage());
    }
  }

  /**
   * getList function - Get list of Product Category records
   * @param string $name    Product Category Name (Optional)
   * @return array $result  Details of all/selected product categories (Name order) or False
   */
  public function getList($name = null) {
    try {
      if ($name == null) {
        $sql = "SELECT * FROM `prod_categories` ORDER BY `Name`";
      } else {
        $sql = "SELECT * FROM `prod_categories` WHERE `Name` LIKE '%$name%' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/getList Failed: " . $err->getMessage());
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
      $sql = "SELECT * FROM `prod_categories` WHERE `ProdCatID` = '$prodCatID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/getRecord Failed: " . $err->getMessage() . "<br />");
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
      $sql = "UPDATE `prod_categories` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `ProdCatID` = '$prodCatID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdCat/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}