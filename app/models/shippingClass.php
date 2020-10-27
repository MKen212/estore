<?php  // Shipping Class
Class Shipping {
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
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * exists function - Check if Shipping Band-Type-PriceBandKG combination already exists in DB
   * @param string $band      Shipping Band
   * @param string $type      Shipping Type
   * @param int $priceBandKG  Shipping Price Band up to KG
   * @return int $count       Count of shipping records with selected Band-Type-PriceBandKG combination or False
   */
  public function exists($band, $type, $priceBandKG) {
    try {
      $sql = "SELECT `Band`, `Type`, `PriceBandKG` FROM `shipping` WHERE (`Band` = '$band' AND `Type` = '$type' AND `PriceBandKG` = '$priceBandKG')";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      return $count;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/exists Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * add function - Add Shipping Record
   * @param string $band          Shipping Band
   * @param string $type          Shipping Type
   * @param int $priceBandKG      Shipping Price Band up to KG
   * @param float $priceBandCost  Shipping Price Band Cost
   * @param int $status           Shipping Status (Optional)
   * @return int $newID           ShippingID of added Shipping record or False
   */
  public function add($band, $type, $priceBandKG, $priceBandCost, $status = 1) {
    try {
      // Check Shipping record does not already exist
      $count = $this->exists($band, $type, $priceBandKG);
      if ($count !=0) {  // Band-Type-PriceBandKG combination is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Shipping Rate for '$band-$type-$priceBandKG' combination is already in use! Please try again.");
        return false;
      } else {  // Insert Shipping Record
        $editID = $_SESSION["userID"];
        $sql = "INSERT INTO `shipping` (`Band`, `Type`, `PriceBandKG`, `PriceBandCost`, `EditTimestamp`, `EditUserID`, `Status`) VALUES ('$band', '$type', '$priceBandKG', '$priceBandCost', CURRENT_TIMESTAMP(), '$editID', '$status')";
        $this->conn->exec($sql);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = msgPrep("success", "Shipping Rate for '$band-$type-$priceBandKG' combination added successfully as ID '$newID'.");
        return $newID;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/add Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getPriceBandKGs function - Returns all the PriceBandKG levels for the chosen band & type (& optionally status) in PriceBandKG order
   * @param string $band    Shipping Band
   * @param string $type    Shipping Type
   * @param int $status     Shipping Status (Optional)
   * @return array $result  Shipping PriceBandKGs or False
   */
  public function getPriceBandKGs($band, $type, $status = null) {
    try {
      if ($status == null) {
        $sql = "SELECT `PriceBandKG` FROM `shipping` WHERE ((`Band` = '$band') AND (`Type` = '$type')) ORDER BY `PriceBandKG`";
      } else {
        $sql = "SELECT `PriceBandKG` FROM `shipping` WHERE ((`Band` = '$band') AND (`Type` = '$type') AND (`Status` = '$status')) ORDER BY `PriceBandKG`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/getPriceBandKGs Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getShippingCost function - Returns the Shipping Cost for the chosen band, type & weight
   * @param string $band      Shipping Band
   * @param string $type      Shipping Type
   * @param int $priceBandKG  Shipping Price Band up to KG
   * @return array $result    Shipping Cost or False
   */
  public function getShippingCost($band, $type, $priceBandKG) {
    try {
      $sql = "SELECT `PriceBandCost` FROM `shipping` WHERE `Band` = '$band' AND `Type` = '$type' AND `PriceBandKG` = '$priceBandKG'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/getShippingCost Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getList function - Get full list of Shipping records
   * @param string $search  Shipping Band or Type (Optional)
   * @return array $result  Details of all/selected Shipping Records (Band/Type Descending/PriceBandKG order) or False
   */
  public function getList($search = null) {
    try {
      if ($search == null) {
        $sql = "SELECT * FROM `shipping` ORDER BY `Band`, `Type` DESC, `PriceBandKG`";
      } else {
        $sql = "SELECT * FROM `shipping` WHERE (`Band` LIKE '%$search%' OR `Type` LIKE '%$search%') ORDER BY `Band`, `Type` DESC, `PriceBandKG`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/getList Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getRecord function - Retrieve single Shipping record
   * @param int $shippingID  Shipping ID of required record
   * @return array $result   Returns selected Shipping record or False 
   */
  public function getRecord($shippingID) {
    try {
      $sql = "SELECT * FROM `shipping` WHERE `ShippingID` = '$shippingID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/getRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateRecord function - Update an existing Shipping record
   * @param int $shippingID       Shipping ID of record being updated
   * @param string $band          Shipping Band
   * @param string $type          Shipping Type
   * @param int $priceBandKG      Shipping Price Band up to KG
   * @param float $priceBandCost  Shipping Price Band Cost
   * @param int $status           Shipping Status
   * @return int $result          Number of records updated (=1) or False
   */
  public function updateRecord($shippingID, $band, $type, $priceBandKG, $priceBandCost, $status) {
    try {
      // If updating band/type/priceBandKG check new Band-Type-PriceBandKG combination does not already exist
      $sqlBTP = "";
      if (!empty($band) && !empty($type) && !empty($priceBandKG)) {
        $count = $this->exists($band, $type, $priceBandKG);
        if ($count != 0) {  // Band-Type-PriceBandKG combination is NOT unique
          $_SESSION["message"] = msgPrep("danger", "Error - Shipping Rate for '$band-$type-$priceBandKG' combination is already in use! Please try again.");
          return false;
        } else {
          $sqlBTP = "`Band` = '$band', `Type` = '$type', `PriceBandKG` = '$priceBandKG', ";
        }
      }
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `shipping` SET {$sqlBTP}`PriceBandCost` = '$priceBandCost', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `ShippingID` = '$shippingID'";
      $result = $this->conn->exec($sql);
      if ($result == 1) {  // Only 1 record should be updated
        $_SESSION["message"] = msgPrep("success", "Update of Shipping ID '$shippingID' was successful.");
      } else {
        throw new PDOException("0 or >1 record was updated.");
      }
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/updateRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing Shipping record
   * @param int $shippingID   Shipping ID of record being updated
   * @param int $status       New Shipping Status
   * @return int $result      Number of records updated (=1) or False
   */
  public function updateStatus($shippingID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `shipping` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `ShippingID` = '$shippingID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Shipping/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}