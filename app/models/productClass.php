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
      echo "Error - Database Connection Failed: " . $err->getMessage() . "<br />";
    }
  }

  /**
   * addProduct function - Add Product record
   * @param string $name         Product Name
   * @param string $description  Product Description
   * @param string $category     Product Category 
   * @param string $priceCHF     Product Price in CHF
   * @param int $quantity        Quantity of Product Added
   * @param string $imgFilename  Filename for Product Image
   * @param int $editUserID      User ID who added product
   * @return int $newID          Product ID of added product or False
   */
  public function addProduct($name, $description, $category, $priceCHF, $quantity, $imgFilename, $editUserID) {
    try {
      $sql = "INSERT INTO products (Name, Description, Category, PriceCHF, QtyAvail, ImgFilename, EditUserID) VALUES ('$name', '$description', '$category', '$priceCHF', '$quantity', '$imgFilename', '$editUserID')";
      $this->conn->exec($sql);
      $newID = $this->conn->lastInsertId();
      $_SESSION["message"] = "Product '$name' added successfully.";
      return $newID;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Add Product Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }

  /**
   * getProductsActive function - Retrieve all ACTIVE product records
   * @return array $result  Returns all active product records or False 
   */
  public function getProductsActive() {
    try{
      $sql = "SELECT ProductID, Name, Description, Category, PriceCHF, QtyAvail, ImgFilename FROM products WHERE status = '1'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Get Products Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }
}
?>