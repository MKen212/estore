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
      $editID = $_SESSION["userID"];
      $sql = "INSERT INTO `messages` (`SenderName`, `SenderEmail`, `Subject`, `Body`, `AddedTimestamp`, `AddedUserID`, `EditTimestamp`, `EditUserID`) VALUES ('$senderName', '$senderEmail', '$subject', '$body', CURRENT_TIMESTAMP(), '$addedUserID', CURRENT_TIMESTAMP(), '$editID')";
      $this->conn->exec($sql);
      $newID = $this->conn->lastInsertId();
      $_SESSION["message"] = msgPrep("success", "Message added successfully. We will reply shortly.");
      return $newID;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Message/add Failed: " . $err->getMessage());
      return false;
    }
  }




}
?>