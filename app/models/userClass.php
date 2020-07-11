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
   * @param string $username     User Username
   * @param string $password     User Password
   * @param string $firstName    User Full Name
   * @param string $address1     User Address 1
   * @param string $address2     User Address 2
   * @param string $city         User City
   * @param string $region       User Region
   * @param string $countryCode  User Country Code
   * @param string $postcode     User Postcode
   * @param string $email        User Email Address
   * @param string $contactNo    User Contact Number
   * @return int lastInsertID    User ID of new user or False
   */
  public function register($username, $password, $fullName, $address1, $address2, $city, $region, $countryCode, $postcode, $email, $contactNo) {
    try {
      // Check Username does not exist
      $sql = "SELECT `UserID` FROM users WHERE `UserName` = '$username'";
      $stmt = $this->conn->query($sql, PDO::FETCH_ASSOC);
      $count = $stmt->rowCount();
    } catch (PDOException $err) {
      $_SESSION["message"] = "Error - User/register check Failed: " . $err->getMessage();
      return false;
    }
    if ($count == 0) {  // Username is unique
      try {
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        $sqlInsUser = "INSERT INTO users
          (`UserName`, `Password`, `FullName`, `Address1`, `Address2`, `City`, `Region`, `CountryCode`, `Postcode`, `Email`, `ContactNo`) VALUES
          ('$username', '$passwordHash', '$fullName', '$address1', '$address2', '$city', '$region', '$countryCode', '$postcode', '$email', '$contactNo')";
        $this->conn->exec($sqlInsUser);
        $newID = $this->conn->lastInsertId();
        $_SESSION["message"] = "Registration of '$username' was successful.";
        return $newID;
      } catch (PDOException $err) {
        $_SESSION["message"] = "Error - User/register Failed: " . $err->getMessage() . "<br />";
        return false;
      }
    } else {  // Username is not unique
      $_SESSION["message"] = "Error - Username '$username' is already taken!<br />Please try again.";
      return false;
    }
  }

  /**
   * login function - Check username & password & set Session
   * @param string $name      User Name
   * @param string $password  User Password
   * @return bool             True if Function success
   */
  public function login($username, $password) {
    try {
      $sql = "SELECT `UserID`, `Password`, `IsAdmin`, `Status` FROM users WHERE `UserName` = '$username'";
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
        $userID = $result["UserID"];
        $userIsAdmin = $result["IsAdmin"];
        $userStatus = $result["Status"];
        $result = null;
      } catch (PDOException $err) {
        $_SESSION["message"] = "Error - User/Login Failed: " . $err->getMessage();
        return false;
      }
      if ($passwordStatus == true) {  // Correct Password Entered
        if ($userStatus == true) {  // User is approved
          $_SESSION["userLogin"] = true;
          $_SESSION["userIsAdmin"] = $userIsAdmin;
          $_SESSION["userID"] = $userID;
          $_SESSION["userName"] = $username;
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