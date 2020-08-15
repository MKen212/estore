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
      echo "Error - Order/DB Connection Failed: " . $err->getMessage() . "<br />";
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
      $_SESSION["message"] = "Error - Order/add Failed: " . $err->getMessage() . "<br />";
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
      $_SESSION["message"] = "Error - Order/addItems Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }

  public function getDetails($invoiceID) {
    try {
      // $sql = "SELECT `orders`.`Status`, `orders`.`ItemCount`, `orders`.`ProductCount`, `orders`.`SubTotal`, `orders`.`ShippingCost`, `orders`.`Total`, `orders`.`EditTimeStamp`, `paypal_orders`.`Shipping`, `orders`.`ShippingInstructions`, `orders`.`ShippingWeightKG`, `orders`.`ShippingType`, `orders`.`PpInvoiceID`, `paypal_orders`.`OrderID`, `paypal_orders`.`Status` as `ppOrderStatus`, `paypal_orders`.`PaymentStatus`, `paypal_orders`.`PaymentCurrency`, `paypal_orders`.`PaymentValue`, `paypal_orders`.`PayerID`, `paypal_orders`.`PayerName`, `paypal_orders`.`Capture Date/Time` FROM orders LEFT JOIN "
    $sql = "SELECT * FROM orders LEFT JOIN paypal_orders ON orders.InvoiceID = paypal_orders.PpInvoiceID WHERE orders.InvoiceID = '$invoiceID'";
    $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Order/getDetails Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }
}

?>