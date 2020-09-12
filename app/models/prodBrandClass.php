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
   * getBrands function - Retrieve all Product Brand records sorted by name
   * @return array $result  Returns all prod_brands records or False
   */
  public function getBrands() {
    try {
      $sql = "SELECT `ProdBrandID`, `Name` FROM prod_brands ORDER BY `Name`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ProdBrand/getCategories Failed: " . $err->getMessage());
    }
  }
}