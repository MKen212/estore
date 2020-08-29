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
   * register function - Register a new user
   * @param string $email      User Email Address
   * @param string $password   User Password
   * @param string $name       User Name
   * @return int lastInsertID  User ID of new user or False
   */
  public function register($email, $password, $name) {
    try {
      // Check User does not already exist
      $count = $this->exists($email);
      if ($count != 0) {  // Email is NOT unique
        $_SESSION["message"] = msgPrep("danger", "Error - Email Address '$email' is already in use! Please try again.");
        return false;
      } else {  // Insert User Record
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        $sql = "INSERT INTO users (`Email`, `Password`, `Name`) VALUES
          ('$email', '$passwordHash', '$name')";
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
        $_SESSION["message"] = msgPrep("danger", "Incorrect Username or Password entered!");
        return false;
      } else {  // Confirm Password
        $sql = "SELECT `UserID`, `Password`, `Name`, `IsAdmin`, `Status` FROM users WHERE `Email` = '$email'";
        $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        $passwordStatus = password_verify($password, $result["Password"]);
        $userStatus = $result["Status"];
        if ($passwordStatus == true) {  // Correct Password Entered
          if ($userStatus == 1) {  // User is active
            $_SESSION["userLogin"] = true;
            $_SESSION["userIsAdmin"] = $result["IsAdmin"];
            $_SESSION["userID"] = $result["UserID"];
            $_SESSION["userName"] = $result["Name"];
            $result = null;
            return true;
          } else {  // User is inactive
            $_SESSION["message"] = msgPrep("danger", "Error - User Account Inactive!");
            return false;
          }
        } else {
          // Password invalid
          $_SESSION["message"] = msgPrep("danger", "Incorrect Username or Password entered!");
          return false;
        }
      }  
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/Login Failed: " . $err->getMessage());
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
   * getList function - Get full list of user records
   * @return array $result  Details of all users (Email Order) or False
   */
  public function getList() {
    try {
      $sql = "SELECT * FROM users ORDER BY `Email`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/getList Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getListByEmail function - Get list of user records by Email
   * @param string $email   User Email
   * @return array $result  Details of users for $email or False
   */
  public function getListByEmail($email) {
    try {
      $sql = "SELECT * FROM users WHERE `Email` LIKE '%$email%' ORDER BY `Email`";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetchAll();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/getListByEmail Failed: " . $err->getMessage());
      return false;
    }
  }

  /**
   * getRecord function - Retrive single user record
   * @param string $userID  ID of User record required
   * @return array $result   Returns selected User record or False
   */
  public function getRecord($userID) {
    try {
      $sql = "SELECT * FROM users WHERE `UserID` = '$userID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/getRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * updateRecord function - Updates an existing record
   * @param int $userID        User ID
   * @param string $email      User Email Address
   * @param string $password   User Password
   * @param string $name       User Name
   * @param bool $isAdmin      User is Admin
   * @param bool $statis       User Status
   * @return bool              True if Function success or False
   */
  public function updateRecord($userID, $email, $password, $name, $isAdmin, $status) {
    try {
      $sqlEmail = "";
      $sqlPassword = "";
      // If updating email check new Email does not already exist
      if (!empty($email)) {
        $count = $this->exists($email);
        if ($count != 0) {  // Email is NOT unique
          $_SESSION["message"] = msgPrep("danger", "Error - Email Address '$email' is already in use! Please try again.");
          return false;
        } else {
          $sqlEmail = "`Email` = '$email', ";
        }
      }
      // Email is unique or empty (not being updated)
      if (!empty($password)) {  // Only hash password if new one provided
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        $sqlPassword = "`Password` = '$passwordHash', ";
      }
      $sql = "UPDATE users SET {$sqlEmail}{$sqlPassword}`Name` = '$name', `IsAdmin` = '$isAdmin', `Status` = '$status' WHERE `UserID` = '$userID'";
      $result = $this->conn->exec($sql);
      $_SESSION["message"] = msgPrep("success","Update of User ID: '$userID' was successful.");
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/updateRecord Failed: " . $err->getMessage() . "<br />");
      return false;
    }
  }

  /**
   * exists function - Check if User Email already exists in DB
   * @param string $email  User Email
   * @return int $count    Count of User Records with selected Email or False
   */
  public function exists($email) {
    try {
      $sql = "SELECT `Email` FROM users WHERE `Email` = '$email'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
      return $count;
    } catch (PDOException $err) {
      $_SESSION["message"] = msgPrep("danger", "Error - User/exists Failed: " . $err->getMessage());
      return false;
    }
  }
}
?>