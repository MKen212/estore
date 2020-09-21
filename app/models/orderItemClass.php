<?php // Order Item Class
Class OrderItem {
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
      $_SESSION["message"] = msgPrep("danger", "Error - OrderItem/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * addItems function - Add Order Items Record(s)
   * @param string $fields  List of fields for $values
   * @param string $values  List of values to be inserted
   * @return int $result    True if items added or False
   */
  public function addItems($fields, $values) {
    try {
      $sql = "INSERT INTO order_items $fields VALUES $values";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - OrderItem/addItems Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /** getItemsByOrder function - Retrieve order items for an orderID
   * @param int $orderID    Order ID of items required
   * @return array $result  Order Items for specified order or False
   */
  public function  getItemsByOrder($orderID) {
    try {
      $sql= "SELECT * FROM order_items WHERE `OrderID` = '$orderID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - OrderItem/getItems Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing order_item record
   * @param int $orderItemID  OrderItem ID of order item being updated
   * @param int $status       New OrderItem Record Status
   * @return int $result      Number of records updated (=1) or False
   */
  public function updateStatus($orderItemID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE order_items SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `OrderItemID` = '$orderItemID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - OrderItem/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateItemStatus function - Update OrderItemStatus field of an existing order_item record
   * @param int $orderItemID  OrderItem ID of order item being updated
   * @param int $itemStatus   New OrderItem Status
   * @param bool $shipped     True/False if item was shipped (Optional)
   * @return int $result      Number of records updated (=1) or False
   */
  public function updateItemStatus($orderItemID, $itemStatus, $shipped = false) {
    try {
      $editID = $_SESSION["userID"];
      if ($shipped == true) {
        $sql = "UPDATE order_items SET `ShippedTimestamp` = CURRENT_TIMESTAMP(), `ShippedUserID` = '$editID', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `OrderItemStatus` = '$itemStatus' WHERE `OrderItemID` = '$orderItemID'";
      } else {
        $sql = "UPDATE order_items SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `OrderItemStatus` = '$itemStatus' WHERE `OrderItemID` = '$orderItemID'";
      }      
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - OrderItem/updateItemStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>