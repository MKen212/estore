<?php  // Return Item Class
Class ReturnItem {
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
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * addItems function - Add Return Items Record(s)
   * @param string $fields  List of fields for $values
   * @param string $values  List of values to be inserted
   * @return int $result    True if items added or False
   */
  public function addItems($fields, $values) {
    try {
      $sql = "INSERT INTO `return_items` $fields VALUES $values";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/addItems Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /** getItemsByReturn function - Retrieve return items for a ReturnID using ret_ord_items_view
   * @param int $returnID   Return ID of items required
   * @return array $result  Return Items for specified return or False
   */
  public function getItemsByReturn($returnID) {
    try {
      $sql= "SELECT * FROM `ret_ord_items_view` WHERE `ReturnID` = '$returnID' ORDER BY `ReturnItemID`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/getItemsByReturn Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

}
?>