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
      $_SESSION["message"] = msgPrep("danger", "Error - Country/DB Connection Failed: {$err->getMessage()}");
    }
  }

  /**
   * exists function - Check if Country Code already exists in DB
   * @param string $code     Country Code
   * @return int $countryID  CountryID of record with selected Country Code or False
   */
  public function exists($code) {
    try {
      $sql = "SELECT `CountryID` FROM `countries` WHERE `Code` = '{$code}'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $countryID = $stmt->fetchColumn();
      return $countryID;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/exists Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * add function - Add Country Record
   * @param string $code          Country Code
   * @param string $name          Country Name
   * @param string $shippingBand  Country Shipping Band
   * @param int $status           Country Status (Optional)
   * @return int $newID           CountryID of added Country or False
   */
  public function add($code, $name, $shippingBand, $status = 1) {
    try {
      // Check Country Code does not already exist
      $exists = $this->exists($code);
      if (!empty($exists)) {  // Country Code is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Country Code '{$code}' is already in use! Please try again.");
        return false;
      } else {  // Insert Country Record
        $editID = $_SESSION["userID"];
        $sql = "INSERT INTO `countries` (`Code`, `Name`, `ShippingBand`, `EditTimestamp`, `EditUserID`, `Status`) VALUES ('{$code}', '{$name}', '{$shippingBand}', CURRENT_TIMESTAMP(), '{$editID}', '{$status}')";
        $this->conn->exec($sql);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = msgPrep("success", "Country '{$code} - {$name}' added successfully as ID '{$newID}'.");
        return $newID;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/add Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * getCountries function - Retrieve all country records sorted by name
   * @param int $status     Country Status (Optional)
   * @return array $result  Returns all country records or False
   */
  public function getCountries($status = null) {
    try {
      if ($status == null) {
        $sql = "SELECT `Code`, `Name` FROM `countries` ORDER BY `Name`";
      } else {
        $sql = "SELECT `Code`, `Name` FROM `countries` WHERE `Status` = '{$status}' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/getCountries Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * getShippingCode function - Retrieve the Shipping Band for a specified Country
   * @param string $code     Code for Country to search
   * @return string $result  Returns the Shipping Band or False
   */
  public function getShippingBand($code) {
    try {
      $sql = "SELECT `ShippingBand` FROM `countries` WHERE `Code` = '{$code}'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/getShippingBand Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * getList function - Get full list of Country records
   * @param string $name  Country Name (Optional)
   * @return array $result  Details of all/selected Countries (Name order) or False
   */
  public function getList($name = null) {
    try {
      if ($name == null) {
        $sql = "SELECT * FROM `countries` ORDER BY `Name`";
      } else {
        $sql = "SELECT * FROM `countries` WHERE `Name` LIKE '%{$name}%' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/getList Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * getRecord function - Retrieve single Country record
   * @param int $countryID    Country ID of required record
   * @return array $result    Returns selected Country record or False 
   */
  public function getRecord($countryID) {
    try {
      $sql = "SELECT * FROM `countries` WHERE `CountryID` = '{$countryID}'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/getRecord Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * updateRecord function - Update an existing Country record
   * @param int $countryID        Country ID of record being updated
   * @param int $code             Country Code of record being updated
   * @param string $name          Country Name
   * @param string $shippingBand  Country Shipping Band
   * @param int $status           Country Status
   * @return int $result          Number of records updated (=1) or False
   */
  public function updateRecord($countryID, $code, $name, $shippingBand, $status) {
    try {
      // Check new Country Code does not already exist (other than in current record)
      $exists = $this->exists($code);
      if (!empty($exists) && $exists != $countryID) {  // Code is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Country Code '{$code}' is already in use! Please try again.");
        return false;
      } else {
        $editID = $_SESSION["userID"];
        $sql = "UPDATE `countries` SET `Code` = '{$code}', `Name` = '{$name}', `ShippingBand` = '{$shippingBand}', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '{$editID}', `Status` = '{$status}' WHERE `CountryID` = '{$countryID}'";
        $result = $this->conn->exec($sql);
        if ($result == 1) {  // Only 1 record should be updated
          $_SESSION["message"] = msgPrep("success", "Update of Country ID '{$countryID}' was successful.");
        } else {
          throw new PDOException("0 or >1 record was updated.");
        }
        return $result;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/updateRecord Failed: {$err->getMessage()}");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing Country record
   * @param int $countryID    Country ID of record being updated
   * @param int $status       New Country Code Status
   * @return int $result      Number of records updated (=1) or False
   */
  public function updateStatus($countryID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `countries` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '{$editID}', `Status` = '{$status}' WHERE `CountryID` = '{$countryID}'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/updateStatus Failed: {$err->getMessage()}");
      return false;
    }
  }  
}
?>