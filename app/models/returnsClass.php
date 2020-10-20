<?php  // Returns Class
Class Returns {
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
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * countRetStat function - Get COUNT of returns records by ReturnStatus
   * @param int $returnStatus  Returns ReturnStatus
   * @return int $result       Count of defined order records or False 
   */
  public function countRetStat($returnStatus) {
    try {
      $sql = "SELECT COUNT(*) FROM `returns` WHERE `ReturnStatus` = '$returnStatus'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/countRetStat Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * add function - Add Returns Record
   * @param string $fields  List of fields for $values
   * @param string $values  List of values to be inserted
   * @return int $newID     ReturnID of added return record or False
   */
  public function add($fields, $values) {
    try {
      $sql = "INSERT INTO `returns` $fields VALUES $values";
      $this->conn->exec($sql);
      $newID = $this->conn->lastInsertId();
      return $newID;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/add Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getRefData function - Returns the OwnerUserID & InvoiceID for the specific ReturnID
   * @param int $returnID   ReturnID for specific order
   * @return array $result  OwnerUserID & InvoiceID for ReturnID or False
   */
  public function getRefData($returnID) {
    try {
      $sql = "SELECT `OwnerUserID`, `InvoiceID` FROM `returns` WHERE `ReturnID` = '$returnID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/getRefData Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getList function - Get full list of returns (and optionally by InvoiceID)
   * @param int $invoiceID  Invoice ID (Optional)
   * @return array $result  Details of all returns (Descending Order) or False
   */
  public function getList($invoiceID = null) {
    try {
      if ($invoiceID == null) {
        $sql = "SELECT `ReturnID`, `InvoiceID`, `ItemCount`, `ProductCount`, `RefundTotal`, `AddedTimestamp`, `OwnerUserID`, `ReturnStatus`, `Status` FROM `returns` ORDER BY `ReturnID` DESC";
      } else {
        $sql = "SELECT `ReturnID`, `InvoiceID`, `ItemCount`, `ProductCount`, `RefundTotal`, `AddedTimestamp`, `OwnerUserID`, `ReturnStatus`, `Status` FROM `returns` WHERE `InvoiceID` LIKE '%$invoiceID%' ORDER BY `ReturnID` DESC";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/getList Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getListByUser function - Get list of returns for a User (and optionally by status)
   * @param int $userID     User ID of Returns OwnerUserID
   * @param int $status     Returns Status (Optional)
   * @return array $result  Details of returns for User (Descending Order) or False
   */
  public function getListByUser($userID, $status = null) {
    try {
      if ($status == null) {
        $sql = "SELECT `ReturnID`, `InvoiceID`, `ItemCount`, `ProductCount`, `AddedTimestamp`, `RefundTotal`, `ReturnStatus` FROM `returns` WHERE `OwnerUserID` = '$userID' ORDER BY `InvoiceID` DESC, `ReturnID` DESC";
      } else {
        $sql = "SELECT `ReturnID`, `InvoiceID`, `ItemCount`, `ProductCount`, `AddedTimestamp`, `RefundTotal`, `ReturnStatus` FROM `returns` WHERE (`OwnerUserID` = '$userID' AND `Status` = '$status') ORDER BY `InvoiceID` DESC, `ReturnID` DESC";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/getListByUser Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getDetails function - Get combined returns record for a ReturnID using ret_paypal_view
   * @param int $returnID   Return ID for specific order
   * @return array $result  All details of return for ReturnID or False
   */
  public function getDetails($returnID) {
    try {
      $sql = "SELECT * FROM `ret_paypal_view` WHERE ReturnID = '$returnID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/getDetails Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing returns record
   * @param int $returnID  Return ID of return being updated
   * @param int $status    New Return Record Status
   * @return int $result   Number of records updated (=1) or False
   */
  public function updateStatus($returnID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `returns` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `ReturnID` = '$returnID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateReturnStatus function - Update ReturnStatus field of an existing returns record
   * @param int $returnID      Return ID of return being updated
   * @param int $returnStatus  New ReturnStatus Status
   * @return int $result       Number of records updated (=1) or False
   */
  public function updateReturnStatus($returnID, $returnStatus) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `returns` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `ReturnStatus` = '$returnStatus' WHERE `ReturnID` = '$returnID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Returns/updateReturnStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>