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
  public function getItemsByOrder($orderID) {
    try {
      $sql= "SELECT * FROM order_items WHERE `OrderID` = '$orderID' ORDER BY `OrderItemID`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - OrderItem/getItems Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /** getReturnsAvailByOrder function - Get list of order items available for return for an order (and optionally by status) using ord_items_view
   * @param int $orderID     Order ID of items required
   * @param int $itemStatus  Order Item Status (Optional)
   * @return array $result   Order Items available for return for specified user or False
   */
  public function getReturnsAvailByOrder($orderID, $itemStatus = null) {
    try {
      if ($itemStatus == null) {
        $sql = "SELECT * FROM ord_items_view WHERE ((DATEDIFF(NOW(), `ShippedTimestamp`) <= '" . DEFAULTS["returnsAllowance"] . "') AND (`QtyAvailForRtn` > '0') AND (`OrderID` = '$orderID')) ORDER BY `OrderItemID`";
      } else {
        $sql = "SELECT * FROM ord_items_view WHERE ((DATEDIFF(NOW(), `ShippedTimestamp`) <= '" . DEFAULTS["returnsAllowance"] . "') AND (`QtyAvailForRtn` > '0') AND (`OrderID` = '$orderID') AND (`ItemStatus` = '$itemStatus')) ORDER BY `OrderItemID`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - OrderItem/getReturnsAvailByOrder Failed: " . $err->getMessage() . "<br />");
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
   * updateIsShipped function - Update IsShipped field of an existing order_item record
   * @param int $orderItemID  OrderItem ID of order item being updated
   * @param int $isShipped    New IsShipped Status
   * @return int $result      Number of records updated (=1) or False
   */
  public function updateIsShipped($orderItemID, $isShipped) {
    try {
      $editID = $_SESSION["userID"];
      if ($isShipped == 1) {  // Item Shipped {HARD CODED!}
        $sql = "UPDATE order_items SET `ShippedTimestamp` = CURRENT_TIMESTAMP(), `ShippedUserID` = '$editID', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsShipped` = '$isShipped' WHERE `OrderItemID` = '$orderItemID'";
      } else {  // Not Shipped
        $sql = "UPDATE order_items SET `ShippedTimestamp` = '0000-00-00 00:00:00', `ShippedUserID` = '0', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsShipped` = '$isShipped' WHERE `OrderItemID` = '$orderItemID'";
      }
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - OrderItem/updateIsShipped Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>