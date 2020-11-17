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
   * @param int $status     Return Item Status 
   * @return array $result  Return Items for specified return or False
   */
  public function getItemsByReturn($returnID, $status = null) {
    try {
      if ($status == null) {
        $sql= "SELECT * FROM `ret_ord_items_view` WHERE `ReturnID` = '$returnID' ORDER BY `ReturnItemID`";
      } else {
        $sql= "SELECT * FROM `ret_ord_items_view` WHERE ((`ReturnID` = '$returnID') AND (`Status` = '$status')) ORDER BY `ReturnItemID`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/getItemsByReturn Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing return_item record
   * @param int $returnItemID  ReturnItem ID of return item being updated
   * @param int $status        New ReturnItem Record Status
   * @return int $result       Number of records updated (=1) or False
   */
  public function updateStatus($returnItemID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `return_items` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `ReturnItemID` = '$returnItemID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateIsReceived function - Update IsReceived (and ReceivedDate) fields of an existing return_item record
   * @param int $returnItemID  ReturnItemID of return item being updated
   * @param int $isReceived    New IsReceived Status
   * @return int $result       Number of records updated (=1) or False
   */
  public function updateIsReceived($returnItemID, $isReceived) {
    try {
      $editID = $_SESSION["userID"];
      if ($isReceived == 1) {  // Item Received {HARD CODED!}
        $sql = "UPDATE `return_items` SET `ReceivedDate` = CURRENT_DATE(), `ReceivedUserID` = '$editID', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsReceived` = '$isReceived' WHERE `ReturnItemID` = '$returnItemID'";
      } else {  // Not Received
        $sql = "UPDATE `return_items` SET `ReceivedDate` = '0000-00-00', `ReceivedUserID` = '0', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsReceived` = '$isReceived' WHERE `ReturnItemID` = '$returnItemID'";
      }
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/updateIsReceived Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateIsActioned function - Update IsActioned (and ActionedDate) fields of an existing return_item record
   * @param int $returnItemID  ReturnItemID of return item being updated
   * @param int $isActioned    New IsActioned Status
   * @return int $result       Number of records updated (=1) or False
   */
  public function updateIsActioned($returnItemID, $isActioned) {
    try {
      $editID = $_SESSION["userID"];
      if ($isActioned == 1) {  // Item Actioned {HARD CODED!}
        $sql = "UPDATE `return_items` SET `ActionedDate` = CURRENT_DATE(), `ActionedUserID` = '$editID', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsActioned` = '$isActioned' WHERE `ReturnItemID` = '$returnItemID'";
      } else {  // Not Received
        $sql = "UPDATE `return_items` SET `ActionedDate` = '0000-00-00', `ActionedUserID` = '0', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsActioned` = '$isActioned' WHERE `ReturnItemID` = '$returnItemID'";
      }
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/updateIsActioned Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateProcessedDates function - Update ReceivedDate (and IsReceived), ActionedDate (and IsActioned) fields of an existing return_item record
   * @param int $returnItemID        ReturnItemID of return item being updated
   * @param string $newReceivedDate  New Received Date in format (YYYY-MM-DD)
   * @param string $newActionedDate  New Actioned Date in format (YYYY-MM-DD)
   * @return int $result             Number of records updated (=1) or False
   */
  public function updateProcessedDates($returnItemID, $newReceivedDate, $newActionedDate) {
    try {
      $editID = $_SESSION["userID"];
      $sqlReceived = "";
      $sqlActioned = "";
      if ($newReceivedDate == "0000-00-00" || empty($newReceivedDate)) {
        $sqlReceived = "`ReceivedDate` = '0000-00-00', `ReceivedUserID` = '0', `IsReceived` = '0'";
      } else {
        $sqlReceived = "`ReceivedDate` = '$newReceivedDate', `ReceivedUserID` = '$editID', `IsReceived` = '1'";
      }
      if ($newActionedDate == "0000-00-00" || empty($newActionedDate)) {
        $sqlActioned = "`ActionedDate` = '0000-00-00', `ActionedUserID` = '0', `IsActioned` = '0'";
      } else {
        $sqlActioned = "`ActionedDate` = '$newActionedDate', `ActionedUserID` = '$editID', `IsActioned` = '1'";
      }
      $sql = "UPDATE `return_items` SET $sqlReceived, $sqlActioned, `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID' WHERE `ReturnItemID` = '$returnItemID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/updateReceivedDate Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>