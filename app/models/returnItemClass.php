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
   * updateIsReceived function - Update IsReceived field of an existing return_item record
   * @param int $returnItemID  ReturnItemID of return item being updated
   * @param int $isReceived    New IsReceived Status
   * @return int $result       Number of records updated (=1) or False
   */
  public function updateIsReceived($returnItemID, $isReceived) {
    try {
      $editID = $_SESSION["userID"];
      if ($isReceived == 1) {  // Item Received {HARD CODED!}
        $sql = "UPDATE `return_items` SET `ReceivedTimestamp` = CURRENT_TIMESTAMP(), `ReceivedUserID` = '$editID', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsReceived` = '$isReceived' WHERE `ReturnItemID` = '$returnItemID'";
      } else {  // Not Received
        $sql = "UPDATE `return_items` SET `ReceivedTimestamp` = '0000-00-00 00:00:00', `ReceivedUserID` = '0', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsReceived` = '$isReceived' WHERE `ReturnItemID` = '$returnItemID'";
      }
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/updateIsReceived Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateIsActioned function - Update IsActioned field of an existing return_item record
   * @param int $returnItemID  ReturnItemID of return item being updated
   * @param int $isActioned    New IsActioned Status
   * @return int $result       Number of records updated (=1) or False
   */
  public function updateIsActioned($returnItemID, $isActioned) {
    try {
      $editID = $_SESSION["userID"];
      if ($isActioned == 1) {  // Item Actioned {HARD CODED!}
        $sql = "UPDATE `return_items` SET `ActionedTimestamp` = CURRENT_TIMESTAMP(), `ActionedUserID` = '$editID', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsActioned` = '$isActioned' WHERE `ReturnItemID` = '$returnItemID'";
      } else {  // Not Received
        $sql = "UPDATE `return_items` SET `ActionedTimestamp` = '0000-00-00 00:00:00', `ActionedUserID` = '0', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsActioned` = '$isActioned' WHERE `ReturnItemID` = '$returnItemID'";
      }
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - ReturnItem/updateIsActioned Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>