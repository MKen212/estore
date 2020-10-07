<?php  // InvoiceID Class
Class InvoiceID {
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
      echo "Error - InvoiceID/DB Connection Failed: " . $err->getMessage() . "<br />";
    }
  }

  /**
   * getInvoiceID function - Get the next value from the invoice_ID sequence
   * @return int $result  Next InvoiceID or False
   */
  public function getInvoiceID() {
    try {
      $sql = "SELECT NEXT VALUE FOR `invoice_ID`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - InvoiceID/getInvoiceID Failed: " . $err->getMessage();
      return false;
    }
  }
}
?>