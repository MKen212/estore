<?php  // Order Class, which also handles order_items
Class Order {
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
      $_SESSION["message"] = msgPrep("danger", "Error - Order/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * count function - Get COUNT of order records by OrderStatus
   * @param int $orderStatus  Order OrderStatus
   * @return int $result      Returns count of defined order records or False 
   */
  public function count($orderStatus) {
    try {
      $sql = "SELECT COUNT(*) FROM orders WHERE `OrderStatus` = '$orderStatus'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Order/count Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * add function - Add Order Record
   * @param string $fields  List of fields for $values
   * @param string $values  List of values to be inserted
   * @return int $newID     OrderID of added order or False
   */
  public function add($fields, $values) {
    try {
      $sql = "INSERT INTO orders $fields VALUES $values";
      $this->conn->exec($sql);
      $newID = $this->conn->lastInsertId();
      return $newID;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Order/add Failed: " . $err->getMessage() . "<br />");
      return false;
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
      $_SESSION["message"] = msgPrep("danger", "Error - Order/addItems Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getOwner function - Returns the OwnerUserID for the specific OrderID
   * @param int $orderID  Order ID for specific order
   * @return int $result  OwnerUserID for OrderID or False
   */
  public function getOwner($orderID) {
    try {
      $sql = "SELECT `OwnerUserID` FROM orders WHERE `OrderID` = '$orderID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Order/getOwner Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getList function - Get full list of orders using ord_paypal_view
   * @param int invoiceID   Invoice ID (Optional)
   * @return array $result  Details of all orders (Descending Order) or False
   */
  public function getList($invoiceID = null) {
    try {
      if ($invoiceID == null) {
        $sql = "SELECT `OrderID`, `InvoiceID`, `ItemCount`, `ProductCount`, `ShippingCountry`, `ShippingType`, `Total`,`PaymentStatus`, `PayerName`, `AddedTimestamp`, `OrderStatus`, `Status` FROM ord_paypal_view ORDER BY `InvoiceID` DESC";
      } else {
        $sql = "SELECT `OrderID`, `InvoiceID`, `ItemCount`, `ProductCount`, `ShippingCountry`, `ShippingType`, `Total`,`PaymentStatus`, `PayerName`, `AddedTimestamp`, `OrderStatus`, `Status` FROM ord_paypal_view WHERE `InvoiceID` LIKE '%$invoiceID%' ORDER BY `InvoiceID` DESC";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Order/getList Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getListByUser function - Get list of orders for a User using ord_paypal_view
   * @param int $userID     User ID of Orders' OwnerUserID
   * @return array $result  Details of orders for User (Descending Order) or False
   */
  public function getListByUser($userID) {
    try {
      $sql = "SELECT `OrderID`, `InvoiceID`, `ItemCount`, `ProductCount`, `AddedTimestamp`, `Total`,`PaymentStatus`, `OrderStatus` FROM ord_paypal_view WHERE OwnerUserID = '$userID' ORDER BY `InvoiceID` DESC";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Order/getListByUser Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getDetails function - Get combined order record for an OrderID using ord_paypal_view
   * @param int $orderID    Order ID for specific order
   * @return array $result  All details of order for OrderID or False
   */
  public function getDetails($orderID) {
    try {
      $sql = "SELECT * FROM ord_paypal_view WHERE OrderID = '$orderID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Order/getDetails Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /** getItems function - Retrieve order items for an orderID
   * @param int $orderID    Order ID of items required
   * @return array $result  Order Items for specified order or False
   */
  public function  getItems($orderID) {
    try {
      $sql= "SELECT `ItemID`, `ProductID`, `Name` ,`Price`, `QtyOrdered`, `ImgFilename`, `ShippedTimestamp`, `ShippedUserID`, `OrderItemStatus`, `Status` FROM order_items WHERE `OrderID` = '$orderID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Order/getItems Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>