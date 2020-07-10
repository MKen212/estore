<?php  // Country Class
Class Country {
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
      echo "Error - User/DB Connection Failed: " . $err->getMessage() . "<br />";
    }
  }

  /**
   * getCountries function - Retrieve all country records sorted by name
   * @return array $result  Returns all country records or False
   */
  public function getCountries() {
    try {
      $sql = "SELECT `Code`, `Name` FROM countries ORDER BY `Name`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - Country/getCountries Failed: " . $err->getMessage();
      return false;
    }
  }
}
?>