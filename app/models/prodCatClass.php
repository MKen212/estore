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
}