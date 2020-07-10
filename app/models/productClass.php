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
      echo "Error - Product/DB Connection Failed: " . $err->getMessage() . "<br />";
    }
  }

  /**
   * add function - Add Product record
   * @param string $name         Product Name
   * @param string $description  Product Description
   * @param string $category     Product Category 
   * @param float $priceLocal   Product Price in Local currency
   * @param int $quantity        Quantity of Product Added
   * @param string $imgFilename  Filename for Product Image
   * @param int $editUserID      User ID who added product
   * @return int $newID          Product ID of added product or False
   */
  public function add($name, $description, $category, $priceCHF, $quantity, $imgFilename, $editUserID) {
    try {
      $sql = "INSERT INTO products (`Name`, `Description`, `Category`, `PriceLocal`, `QtyAvail`, `ImgFilename`, `EditUserID`) VALUES ('$name', '$description', '$category', '$priceCHF', '$quantity', '$imgFilename', '$editUserID')";
      $this->conn->exec($sql);
      $newID = $this->conn->lastInsertId();
      $_SESSION["message"] = "Product '$name' added successfully.";
      return $newID;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Product/add Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }

  /**
   * count function - Get COUNT of product records
   * @param bool $status    Product Status (0=Inactive/1=Active/2=Both)
   * @return array $result  Returns count of defined product records or False 
   */
  public function count($status) {
    try {
      if ($status == 2) {
        $sql = "SELECT COUNT(*) FROM products";  
      } else {
        $sql = "SELECT COUNT(*) FROM products WHERE status = '$status'";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Product/count Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }

  /**
   * getPage function - Retrieve Page of product records
   * @param bool $status    Product Status (0=Inactive/1=Active/2=Both)
   * @param int $limit      Max number of records to return
   * @param int $offset     Offset of first record
   * @return array $result  Returns defined product records or False 
   */
  public function getPage($status, $limit, $offset) {
    try {
      if ($status == 2) {
        $sql = "SELECT `ProductID`, `Name`, `Description`, `Category`, `PriceLocal`, `QtyAvail`, `ImgFilename` FROM products LIMIT $limit OFFSET $offset";  
      } else {
        $sql = "SELECT `ProductID`, `Name`, `Description`, `Category`, `PriceLocal`, `QtyAvail`, `ImgFilename` FROM products WHERE `Status` = '$status' LIMIT $limit OFFSET $offset";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Product/getPage Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }

  /**
   * getRecord function - Retrieve single product record
   * @param bool $productID  Product ID of product required
   * @return array $result   Returns selected product record or False 
   */
  public function getRecord($productID) {
    try {
      $sql = "SELECT `ProductID`, `Name`, `Description`, `Category`, `PriceLocal`, `QtyAvail`, `ImgFilename` FROM products WHERE `ProductID` = '$productID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Product/getRecord Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }
}
?>