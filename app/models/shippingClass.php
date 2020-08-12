<?php  // Shipping Class
Class Shipping {
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
      echo "Error - Shipping/DB Connection Failed: " . $err->getMessage() . "<br />";
    }
  }

  /**
   * getDistinct function - Returns the DISTINCT (Unique) values of a field
   * @param string $field   Name of Field from table
   * @return array $result  Distinct Values from the selected field or False
   */
  public function getDistinct($field) {
    try {
      $sql = "SELECT DISTINCT `$field` FROM shipping";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Shipping/getDistinct Failed: " . $err->getMessage();
      return false;
    }
  }

  /**
   * getShippingCost function - Returns the Shipping Cost for the chosen band, type & weight
   * @param string $band      Shipping Band
   * @param string $type      Shipping Type
   * @param int $priceBandKG  Shipping Price Band up to KG
   * @return array $result    Shipping Cost or False
   */
  public function getShippingCost($band, $type, $priceBandKG) {
    try {
      $sql = "SELECT `PriceBandCost` FROM shipping WHERE `Band` = '$band' AND `Type` = '$type' AND `PriceBandKG` = '$priceBandKG'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Shipping/getShippingCost Failed: " . $err->getMessage();
      return false;
    }
  }
}