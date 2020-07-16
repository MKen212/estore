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
   * getShippingCosts function - Returns the Shipping Costs for the chosen band & weight
   * @param string $band      Shipping Band
   * @param int $priceBandKG  Shipping Price Band up to KG
   * @return array $result    Shipping Type and Cost or False
   */
  public function getShippingCosts($band, $priceBandKG) {
    try {
      $sql = "SELECT `Type`, `PriceBandCost` from shipping WHERE `Band` = '$band' AND `PriceBandKG` = '$priceBandKG'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Shipping/getShippingCost Failed: " . $err->getMessage();
      return false;
    }
  }
}