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
}

?>