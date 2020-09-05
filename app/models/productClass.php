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
   * exists function - Check if Product Name already exists in DB
   * @param string $name  Product Name
   * @return int $count   Count of Product Records with selected Name or False
   */
  public function exists($name) {
    try {
      $sql = "SELECT `Name` FROM products WHERE `Name` = '$name'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      return $count;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/exists Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * add function - Add Product record
   * @param string $name         Product Name
   * @param string $description  Product Description
   * @param string $prodCatID    Product Category ID
   * @param float $price         Product Price
   * @param int $weightGrams     Product Shipping Weight in Grams
   * @param int $quantity        Quantity of Product Added
   * @param string $imgFilename  Filename for Product Image
   * @param int $editUserID      User ID who added product
   * @param int $isOnSale        Product is On Sale (Optional)
   * @param int $status          Product Status (Optional)
   * @return int $newID          Product ID of added product or False
   */
  public function add($name, $description, $prodCatID, $price, $weightGrams, $quantity, $imgFilename, $editUserID, $isOnSale = 0, $status = 1) {
    try {
      // Check Product Name does not already exist
      $count = $this->exists($name);
      if ($count != 0) {  // Name is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Product Name '$name' is already in use! Please try again.");
        return false;
      } else {  // Insert Product Record
        $sql = "INSERT INTO products (`Name`, `Description`, `ProdCatID`, `Price`, `WeightGrams`, `QtyAvail`, `ImgFilename`, `EditUserID`, `IsOnSale`, `Status`) VALUES ('$name', '$description', '$prodCatID', '$price', '$weightGrams', '$quantity', '$imgFilename', '$editUserID', '$isOnSale', '$status')";
        $this->conn->exec($sql);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = "Product '$name' added successfully.";
        return $newID;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Product/add Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * count function - Get COUNT of product records
   * @param bool $status  Product Status (0=Inactive/1=Active/2=Both)
   * @return int $result  Returns count of defined product records or False 
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
        $sql = "SELECT `ProductID`, `Name`, `Description`, `Category`, `Price`, `WeightGrams`, `QtyAvail`, `ImgFilename` FROM products LIMIT $limit OFFSET $offset";  
      } else {
        $sql = "SELECT `ProductID`, `Name`, `Description`, `Category`, `Price`, `WeightGrams`, `QtyAvail`, `ImgFilename` FROM products WHERE `Status` = '$status' LIMIT $limit OFFSET $offset";
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
   * @param int $productID  Product ID of product required
   * @return array $result  Returns selected product record or False 
   */
  public function getRecord($productID) {
    try {
      $sql = "SELECT `Name`, `Description`, `Category`, `Price`, `WeightGrams`, `QtyAvail`, `ImgFilename` FROM products WHERE `ProductID` = '$productID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Product/getRecord Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }

  /**
   * updateQtyAvail function - Update Quantity Available for specific product
   * @param int $productID    Product ID of product to update
   * @param int $qtyAvailChg  (+-)Quantity to change in QtyAvail field
   * @return bool $result     Returns True if update success or False
   */
  public function updateQtyAvail($productID, $qtyAvailChg) {
    try {
      $sql = "UPDATE products SET `QtyAvail` = `QtyAvail` + $qtyAvailChg WHERE `ProductID` = '$productID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Product/updateQtyAvail Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }
}
?>