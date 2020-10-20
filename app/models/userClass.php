<?php  // User Class
class User {
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
      $_SESSION["message"] = msgPrep("danger", "Error - User/DB Connection Failed: " . $err->getMessage() . "<br />");
    }
  }

  /**
   * exists function - Check if User Email already exists in DB
   * @param string $email  User Email
   * @return int $count    Count of User Records with selected Email or False
   */
  public function exists($email) {
    try {
      $sql = "SELECT `Email` FROM `users` WHERE `Email` = '$email'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      return $count;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/exists Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * register function - Register a new user
   * @param string $email     User Email Address
   * @param string $password  User Password
   * @param string $name      User Name
   * @param int $isAdmin      User is Admin (Optional)
   * @param int $status       User Status (Optional)
   * @return int $newID       User ID of new user or False
   */
  public function register($email, $password, $name, $isAdmin = 0, $status = 1) {
    try {
      // Check User does not already exist
      $count = $this->exists($email);
      if ($count != 0) {  // Email is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Email Address '$email' is already in use! Please try again.");
        return false;
      } else {  // Insert User Record
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        $sql = "INSERT INTO `users` (`Email`, `Password`, `Name`, `IsAdmin`, `Status`) VALUES
          ('$email', '$passwordHash', '$name', '$isAdmin', '$status')";
        $this->conn->exec($sql);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = msgPrep("success", "Registration of '$email' was successful.");
        return $newID;
      }
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/register Failed: " . $err->getMessage() . "<br />");
      return false;      
    }
  }

  /**
   * login function - Check email & password & set Session
   * @param string $email     User Email
   * @param string $password  User Password
   * @return bool             True if Function success or False
   */
  public function login($email, $password) {
    try {
      // Check User exists
      $count = $this->exists($email);
      if ($count != 1) {  // User does not exist
        $_SESSION["message"] = "Incorrect Username or Password entered!";
        return false;
      } else {  // Confirm Password
        $sql = "SELECT `UserID`, `Password`, `Name`, `IsAdmin`, `Status` FROM `users` WHERE `Email` = '$email'";
        $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        $passwordStatus = password_verify($password, $result["Password"]);
        $userStatus = $result["Status"];
        if ($passwordStatus == true) {  // Correct Password Entered
          if ($userStatus == 1) {  // User is active so Login
            $_SESSION["userLogin"] = true;
            $_SESSION["userIsAdmin"] = $result["IsAdmin"];
            $_SESSION["userID"] = $result["UserID"];
            $userID = $result["UserID"];
            $_SESSION["userName"] = $result["Name"];
            $result = null;
            // Record Login Timestamp
            $sqlLogin = "UPDATE `users` SET `LoginTimestamp` = CURRENT_TIMESTAMP() WHERE `UserID` = $userID";
            $this->conn->exec($sqlLogin);
            return true;
          } else {  // User is inactive
            $_SESSION["message"] = "Error - User Account Inactive!";
            return false;
          }
        } else {
          // Password invalid
          $_SESSION["message"] = "Incorrect Username or Password entered!";
          return false;
        }
      }  
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - User/Login Failed: " . $err->getMessage();
      return false;
    }
  }

  /**
   * logout function - Logout user
   * @return bool  True if function success or False
   */
  public function logout() {
    $_SESSION["message"] = "Thanks for using eStore.";
    $_SESSION["userLogin"] = false;
    return true;
  }

  /**
   * getList function - Get list of user records
   * @param string $email   User Email (Optional)
   * @return array $result  Details of all/selected users (Email order) or False
   */
  public function getList($email = null) {
    try {
      if ($email == null) {
        $sql = "SELECT `UserID`, `Email`, `Name`, `EditTimestamp`, `EditUserID`, `LoginTimestamp`, `IsAdmin`, `Status` FROM `users` ORDER BY `Email`";
      } else {
        $sql = "SELECT `UserID`, `Email`, `Name`, `EditTimestamp`, `EditUserID`, `LoginTimestamp`, `IsAdmin`, `Status` FROM `users` WHERE `Email` LIKE '%$email%' ORDER BY `Email`";
      }
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/getList Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getRecord function - Retrive single user record
   * @param string $userID  ID of User record required
   * @return array $result  Returns selected User record or False
   */
  public function getRecord($userID) {
    try {
      $sql = "SELECT `Email`, `Name`, `IsAdmin`, `Status` FROM `users` WHERE `UserID` = '$userID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/getRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateRecord function - Update an existing user record
   * @param int $userID        User ID of user being update
   * @param string $email      User Email Address
   * @param string $password   User Password
   * @param string $name       User Name
   * @param int $isAdmin       User is Admin
   * @param int $status        User Status
   * @return int $result       Number of records updated (=1) or False
   */
  public function updateRecord($userID, $email, $password, $name, $isAdmin, $status) {
    try {
      // If updating email check new Email does not already exist
      $sqlEmail = "";
      if (!empty($email)) {
        $count = $this->exists($email);
        if ($count != 0) {  // Email is NOT unique
          $_SESSION["message"] = msgPrep("danger", "Error - Email Address '$email' is already in use! Please try again.");
          return false;
        } else {
          $sqlEmail = "`Email` = '$email', ";
        }
      }
      // Only hash password if new one provided
      $sqlPassword = "";
      if (!empty($password)) {
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        $sqlPassword = "`Password` = '$passwordHash', ";
      }
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `users` SET {$sqlEmail}{$sqlPassword}`Name` = '$name', `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsAdmin` = '$isAdmin', `Status` = '$status' WHERE `UserID` = '$userID'";
      $result = $this->conn->exec($sql);
      if ($result == 1) {  // Only 1 record should be updated
        $_SESSION["message"] = msgPrep("success", "Update of User ID: '$userID' was successful.");
        if ($userID == $editID) {  // User has updated own record
          // $_SESSION["userIsAdmin"] = $isAdmin;  // Don't change this until next login
          $_SESSION["userName"] = $name;
        }
      } else {
        throw new PDOException("0 or >1 record was updated.");
      }
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/updateRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateStatus function - Update Status field of an existing user record
   * @param int $userID   User ID of user being updated
   * @param int $status   New User Status
   * @return int $result  Number of records updated (=1) or False
   */
  public function updateStatus($userID, $status) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `users` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `Status` = '$status' WHERE `UserID` = '$userID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/updateStatus Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateIsAdmin function - Update IsAdmin field of an existing user record
   * @param int $userID   User ID of user being updated
   * @param int $isAdmin  New User IsAdmin Status
   * @return int $result  Number of records updated (=1) or False
   */
  public function updateIsAdmin($userID, $isAdmin) {
    try {
      $editID = $_SESSION["userID"];
      $sql = "UPDATE `users` SET `EditTimestamp` = CURRENT_TIMESTAMP(), `EditUserID` = '$editID', `IsAdmin` = '$isAdmin' WHERE `UserID` = '$userID'";
      $result = $this->conn->exec($sql);
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/updateIsAdmin Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }
}
?>