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
   * @param string $username    User Username
   * @param string $password    User Password
   * @param string $firstName   User First Name
   * @param string $lastName    User Last Name
   * @param string $email       User Email Address
   * @param string $contactNo   User Contact Number
   * @return int lastInsertID   User ID of new user or False
   */
  public function register($username, $password, $firstName, $lastName, $email, $contactNo) {
    try {
      // Check Username does not exist
      $sql = "SELECT UserID FROM users WHERE UserName = '$username'";
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
          (UserName, Password, FirstName, LastName, Email, ContactNo) VALUES
          ('$username', '$passwordHash', '$firstName', '$lastName', '$email', '$contactNo')";
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
      $sql = "SELECT UserID, Password, IsAdmin, Status FROM users WHERE UserName = '$username'";
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

}
?>