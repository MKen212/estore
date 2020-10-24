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
      $_SESSION["message"] = msgPrep("danger", "Error - Country/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * exists function - Check if Country Code already exists in DB
   * @param string $countryCode  Country Code
   * @return int $count          Count of countries records with selected code or False
   */
  public function exists($countryCode) {
    try {
      $sql = "SELECT `Code` FROM `countries` WHERE `Code` = '$countryCode'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      return $count;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/exists Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * add function - Add Country Record
   * @param string $countryCode   Country Code
   * @param string $name          Country Name
   * @param string $shippingBand  Country Shipping Band
   * @param int $status           Country Status (Optional)
   * @return int $result          Number of records added (=1) or False
   */
  public function add($countryCode, $name, $shippingBand, $status = 1) {
    try {
      // Check Country Code does not already exist
      $count = $this->exists($countryCode);
      if ($count !=0) {  // Country Code is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Country Code '$countryCode' is already in use! Please try again.");
        return false;
      } else {  // Insert Country Record
        $editID = $_SESSION["userID"];
        $sql = "INSERT INTO `countries` (`Code`, `Name`, `ShippingBand`, `EditTimestamp`, `EditUserID`, `Status`) VALUES ('$countryCode', '$name', '$shippingBand', CURRENT_TIMESTAMP(), '$editID', '$status')";
        $result = $this->conn->exec($sql);
        $_SESSION["message"] = msgPrep("success", "Country '$countryCode - $name' added successfully.");
        return $result;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/add Failed: " . $err->getMessage());
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
        $sql = "SELECT `Code`, `Name` FROM `countries` WHERE `Status` = '$status' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/getCountries Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getShippingCode function - Retrieve the Shipping Band for a specified Country
   * @param string $countryCode  Code for Country to search
   * @return string $result      Returns the Shipping Band or False
   */
  public function getShippingBand($countryCode) {
    try {
      $sql = "SELECT `ShippingBand` FROM `countries` WHERE `Code` = '$countryCode'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchColumn();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/getShippingBand Failed: " . $err->getMessage());
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
        $sql = "SELECT * FROM `countries` WHERE `Name` LIKE '%$name%' ORDER BY `Name`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/getList Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getRecord function - Retrieve single Country record
   * @param int $countryCode  Country Code of required record
   * @return array $result    Returns selected Country record or False 
   */
  public function getRecord($countryCode) {
    try {
      $sql = "SELECT * FROM `countries` WHERE `Code` = '$countryCode'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/getRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateRecord function - Update an existing Country record
   * @param int $countryCode      Country Code of record being updated
   * @param int $updCode          Updated Country Code
   * @param string $name          Country Name
   * @param string $shippingBand  Country Shipping Band
   * @param int $status           Country Status
   * @return int $result          Number of records updated (=1) or False
   */
  public function updateRecord($countryCode, $updCode, $name, $shippingBand, $status) {
    try {
      // If updating Country Code check new Code does not already exist
      $sqlCode = "";
      $msgCode = "";
      if (!empty($updCode)) {
        $count = $this->exists($updCode);
        if ($count != 0) {  // Updated Country Code is NOT unique
          $_SESSION["message"] = msgPrep("danger", "Error - Country Code '$updCode' is already in use! Please try again.");
          return false;
        } else {
          $sqlCode = "`Code` = '$updCode', ";
          $msgCode = " to '$updCode'";
        }
      }
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `countries` SET {$sqlCode}`Name` = '$name', `ShippingBand` = '$shippingBand', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `Code` = '$countryCode'";
      $result = $this->conn->exec($sql);
      if ($result == 1) {  // Only 1 record should be updated
        $_SESSION["message"] = msgPrep("success", "Update of Country Code '$countryCode'$msgCode was successful.");
      } else {
        throw new PDOException("0 or >1 record was updated.");
      }
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/updateRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing Country record
   * @param int $countryCode  Country Code of record being updated
   * @param int $status       New Country Code Status
   * @return int $result      Number of records updated (=1) or False
   */
  public function updateStatus($countryCode, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `countries` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `Code` = '$countryCode'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - Country/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }  
}
?>