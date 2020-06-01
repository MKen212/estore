<?php
/**
 * Global Configuration Details
 */

/* Database Connection */
$connDetails = parse_ini_file("/var/www/privnet/inifiles/mariaDBCon.ini");
$connDetails["database"] = "estore";

define("DBSERVER", $connDetails);

/* Default Values */
$defaultValues = [
  "maxUploadSize" => 2000000,  // Maximum PHP upload file size in bytes - see phpInfo
  "productsImgPath" => "../../uploads/imgProducts/",  // Path to product images
/* Rest not used yet
  "noImgUploaded" => "../config/noImage.jpg" ,  // Default Image if no image file uploaded
  "booksDisplayCols" => 3,  // Number of Columns for Books Display
  "returnDuration" => 14,  // Issued Book Return Duration
  "userAdminUserID" => 2,  // UserID for User Management Administrator
  */
];

define("DEFAULTS", $defaultValues);

/**
 * cleanInput function - Used to clean all Form data entered
 * @param string $input   Original Input
 * @param string $type    Input Type (string, int, float, email, password)
 * @return string $input  Cleaned Input
 */
function cleanInput($input, $type) {
  // Clean all with htmlspecialchars
  $input = htmlspecialchars($input);
  if ($type == "string") {
    $input = trim($input);
    $input = stripslashes($input);
    $input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_LOW);
  } else if ($type == "int") {
    $input = filter_var($input, FILTER_SANITIZE_NUMBER_INT);
  } else if ($type == "float") {
    $input = filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  } else if ($type = "email") {
    $input = filter_var($input, FILTER_SANITIZE_EMAIL);
  }
  return $input;
}

?>