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
      echo "Error - User/DB Connection Failed: " . $err->getMessage() . "<br />";
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
      // Check Email does not already exist
      $sql = "SELECT `Email` FROM users WHERE `Email` = '$email'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - User/register check Failed: " . $err->getMessage();
      return false;
    }
    if ($count == 0) {  // Email is unique
      try {
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        $sqlInsUser = "INSERT INTO users
          (`Email`, `Password`, `Name`) VALUES
          ('$email', '$passwordHash', '$name')";
        $this->conn->exec($sqlInsUser);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = "Registration of '$email' was successful.";
        return $newID;
      } catch (PDOException $err) {
        $_SESSION["message"] = "Error - User/register Failed: " . $err->getMessage() . "<br />";
        return false;
      }
    } else {  // Email is not unique
      $_SESSION["message"] = "Error - Email Address '$email' is already in use!<br />Please try again.";
      return false;
    }
  }

  /**
   * login function - Check email & password & set Session
   * @param string $email     User Email
   * @param string $password  User Password
   * @return bool             True if Function success
   */
  public function login($email, $password) {
    try {
      $sql = "SELECT `UserID`, `Password`, `Name`, `IsAdmin`, `Status` FROM users WHERE `Email` = '$email'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - User/login Check Failed: " . $err->getMessage();
      return false;
    }
    if ($count != 1) {  // Username not found
      $_SESSION["message"] = "Incorrect Username or Password entered!";
      return false;
    } else {
      try {
        $result = $stmt->fetch();
        $passwordStatus = password_verify($password, $result["Password"]);
        $userStatus = $result["Status"];
      } catch (PDOException $err) {
        $_SESSION["message"] = "Error - User/Login Failed: " . $err->getMessage();
        return false;
      }
      if ($passwordStatus == true) {  // Correct Password Entered
        if ($userStatus == true) {  // User is approved
          $_SESSION["userLogin"] = true;
          $_SESSION["userIsAdmin"] = $result["IsAdmin"];
          $_SESSION["userID"] = $result["UserID"];
          $_SESSION["userName"] = $result["Name"];
          $result = null;
          return true;
        } else {  // User is unapproved
          $_SESSION["message"] = "Error - User not yet approved!";
          return false;
        }
      } else {
        // Password invalid
        $_SESSION["message"] = "Incorrect Username or Password entered!";
        return false;
      }
    }
  }

  /**
   * logout function - Logout user
   * @return bool  True if function success
   */
  public function logout() {
    $_SESSION["message"] = "Thanks for using eStore.";
    $_SESSION["userLogin"] = false;
    return true;
  }

  /**
   * getRecord function - Retrive single user record
   * @param int $userID    User ID of User required
   * @param array $result  Returns selected User record or False
   */
  public function getRecord($userID) {
    try {
      $sql = "SELECT `FullName`, `Address1`, `Address2`, `City`, `Region`, `CountryCode`, `Postcode`, `Email`, `ContactNo` FROM users WHERE `UserID` = '$userID'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $result = $stmt->fetch();
      return $result;
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - User/getRecord Failed: " . $err->getMessage() . "<br />";
      return false;
    }
  }
}
?>