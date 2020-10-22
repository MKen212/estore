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
   * getShippingCost function - Returns the Shipping Cost for the chosen band, type & weight
   * @param string $band      Shipping Band
   * @param string $type      Shipping Type
   * @param int $priceBandKG  Shipping Price Band up to KG
   * @return array $result    Shipping Cost or False
   */
  public function getShippingCost($band, $type, $priceBandKG) {
    try {
      $sql = "SELECT `PriceBandCost` FROM `shipping` WHERE `Band` = '$band' AND `Type` = '$type' AND `PriceBandKG` = '$priceBandKG'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Shipping/getShippingCost Failed: " . $err->getMessage();
      return false;
    }
  }

  /**
   * getPriceBandKGs function - Returns all the PriceBandKG levels for the chosen band & type in PriceBandKG order
   * @param string $band    Shipping Band
   * @param string $type    Shipping Type
   * @return array $result  Shipping PriceBandKGs or False
   */
  public function getPriceBandKGs($band, $type) {
    try {
      $sql = "SELECT `PriceBandKG` FROM `shipping` WHERE `Band` = '$band' AND `Type` = '$type' ORDER BY `PriceBandKG`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Shipping/getPriceBandKGs Failed: " . $err->getMessage();
      return false;
    }
  }
}