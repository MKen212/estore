<?php  // Message Class
Class Message {
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
      $_SESSION["message"] = msgPrep("danger", "Error - Message/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * countMsgStat function - Get COUNT of message records with MessageStatus less than or equal to defined level
   * @param int $messageStatus  Message MessageStatus (Upper Limit)
   * @return int $result        Count of defined message records or False 
   */
  public function countMsgStat($messageStatus) {
    try {
      $sql = "SELECT COUNT(*) FROM `messages` WHERE `MessageStatus` <= '$messageStatus'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/countMsgStat Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * add function - Add Message Record
   * @param string $senderName   Senders Name
   * @param string $senderEmail  Senders Email
   * @param string $subject      Message Subject
   * @param string $body         Message Body
   * @param int $addedUserID     UserID who added message
   * @return int $newID          MessageID of added Message record or False
   */
  public function add($senderName, $senderEmail, $subject, $body, $addedUserID) {
    try {
      isset($_SESSION["userID"]) ? $editID = $_SESSION["userID"] : $editID = 0;
      $sql = "INSERT INTO `messages` (`SenderName`, `SenderEmail`, `Subject`, `Body`, `AddedTimestamp`, `AddedUserID`, `EditTimestamp`, `EditUserID`) VALUES ('$senderName', '$senderEmail', '$subject', '$body', CURRENT_TIMESTAMP(), '$addedUserID', CURRENT_TIMESTAMP(), '$editID')";
      $this->conn->exec($sql);
      $newID = $this->conn->lastInsertId();
      $_SESSION["message"] = msgPrep("success", "Message '$subject' submitted successfully.");
      return $newID;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/add Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getRefData function - Returns the AddedUserID & Status for the specific MessageID
   * @param int $messageID  Message ID for specific message
   * @return array $result  AddedUserID & Status for MessageID or False
   */
  public function getRefData($messageID) {
    try {
      $sql = "SELECT `AddedUserID`, `Status` FROM `messages` WHERE `MessageID` = '$messageID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/getRefData Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getList function - Get full list of Message records (and optionally by Sender Email or Subject)
   * @param string $search  Sender Email or Subject (Optional)
   * @return array $result  Details of all/selected Message Records (Descending ID order) or False
   */
  public function getList($search = null) {
    try {
      if ($search == null) {
        $sql = "SELECT * FROM `messages` ORDER BY `MessageID` DESC";
      } else {
        $sql = "SELECT * FROM `messages` WHERE (`SenderEmail` LIKE '%$search%' OR `Subject` LIKE '%$search%') ORDER BY `MessageID` DESC";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/getList Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getListByUser function - Get list of orders for a User (and optionally by status)
   * @param int $userID     User ID of message AddedUserID
   * @param int $status     Message Status (Optional)
   * @return array $result  Details of messages for User (Descending AddedTimestamp Order) or False
   */
  public function getListByUser($userID, $status = null) {
    try {
      if ($status == null) {
        $sql = "SELECT * FROM `messages` WHERE `AddedUserID` = '$userID' ORDER BY `AddedTimestamp` DESC";
      } else {
        $sql = "SELECT * FROM `messages` WHERE (`AddedUserID` = '$userID' AND `Status` = '$status') ORDER BY `AddedTimestamp` DESC";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/getListByUser Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * getRecord function - Retrieve single Message record
   * @param int $messageID  Message ID of required record
   * @return array $result  Returns selected Message (+Reply Username) record or False 
   */
  public function getRecord($messageID) {
    try {
      $sql = "SELECT `messages`.*, `users`.`Name` AS `ReplyUsername` FROM `messages` LEFT JOIN `users` ON `users`.`UserID` = `messages`.`ReplyUserID` WHERE `MessageID` = '$messageID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/getRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateReply function - Update Reply to an existing message record
   * @param int $messageID      Message ID of message being replied to
   * @param string $reply       Message Reply
   * @param int $replyUserID    User ID who replied to message
   * @param int $messageStatus  Updated Message MessageStatus
   * @return int $result        Number of records updated (=1) or False
   */
  public function updateReply($messageID, $reply, $replyUserID, $messageStatus) {
    try {
      $editID = $_SESSION["userID"];
      // Check if this is initial reply
      $sqlReplied = "SELECT `ReplyTimestamp` FROM `messages` WHERE `MessageID` = '$messageID'";
      $stmtReplied = $this->conn->query($sqlReplied, PDO::FETCH_ASSOC);
      $resultReplied = $stmtReplied->fetch();
      if ($resultReplied["ReplyTimestamp"] == "0000-00-00 00:00:00") {
        $sql = "UPDATE `messages` SET `Reply` = '$reply', `ReplyTimestamp` = CURRENT_TIMESTAMP(), `ReplyUserID` = '$replyUserID', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `MessageStatus` = '$messageStatus' WHERE `MessageID` = '$messageID'";
      } else {
        $sql = "UPDATE `messages` SET `Reply` = '$reply', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `MessageStatus` = '$messageStatus' WHERE `MessageID` = '$messageID'";
      }
      $result = $this->conn->exec($sql);
      if ($result == 1) {  // Only 1 record should be updated
        $_SESSION["message"] = msgPrep("success", "Reply to Message ID '$messageID' was successfully updated.");
      } else {
        throw new PDOException("0 or >1 record was updated.");
      }
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/updateReply Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing message record
   * @param int $messageID  Message ID of message being updated
   * @param int $status     New Message Record Status
   * @return int $result    Number of records updated (=1) or False
   */
  public function updateStatus($messageID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `messages` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `MessageID` = '$messageID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateMessageStatus function - Update MessageStatus field of an existing message record
   * @param int $messageID      Message ID of message being updated
   * @param int $messageStatus  New MessageStatus Status
   * @return int $result        Number of records updated (=1) or False
   */
  public function updateMessageStatus($messageID, $messageStatus) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `messages` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `MessageStatus` = '$messageStatus' WHERE `MessageID` = '$messageID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/updateMessageStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>