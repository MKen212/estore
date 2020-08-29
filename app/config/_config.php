<?php
/**
 * Global Configuration Details
 */

/* Database Connection */
$connDetails = parse_ini_file("../inifiles/mariaDBCon.ini");
$connDetails["database"] = "estore";

define("DBSERVER", $connDetails);

/* PayPal API Configuration Details */
$ppAPIDetails = parse_ini_file("../inifiles/paypalAPI.ini");

define("PAYPALAPI", $ppAPIDetails);

/* Default Values */
$defaultValues = [
  "maxUploadSize" => 2000000,  // Maximum PHP upload file size in bytes - see phpInfo
  "productsImgPath" => "uploads/imgProducts/",  // Path to product images
  "noImgUploaded" => "images/home/noImage.jpg" ,  // Default Image if no image file uploaded
  "countryCode" => "CH",  // Default Country Code
  "currency" => "CHF",  // Default Currency
  "productsPerPage" => 6,  // Total Number of products displayed per page
  "paginationItems" => 5,  // Max Number of Pagination Items to display
];

define("DEFAULTS", $defaultValues);

/* Status Codes */
$statusCodes = [
  "Status" => [ // All Tables / Status Field
    0 => [
      "text" => "Inactive",
      "badge" => "danger",
    ],
    1 => [
      "text" => "Active",
      "badge" => "success",
    ],
  ],
  "IsAdmin" => [  // users Table / IsAdmin Field
    0 => [
      "text" => "No",
      "badge" => "secondary",
    ],
    1 => [
      "text" => "Yes",
      "badge" => "primary",
    ],
  ],
];

define("STATUS_CODES", $statusCodes);

?>