<?php
/**
 * Global Configuration Details
 */

/* Database Connection */
$connDetails = parse_ini_file("../inifiles/mariaDBCon.ini");
$connDetails["database"] = "estore";

define("DBSERVER", $connDetails);

/* Default Values */
$defaultValues = [
  "maxUploadSize" => 2000000,  // Maximum PHP upload file size in bytes - see phpInfo
  "productsImgPath" => "uploads/imgProducts/",  // Path to product images
  "noImgUploaded" => "images/home/noImage.jpg" ,  // Default Image if no image file uploaded
  "countryCode" => "CH",  // Default Country Code
  "localCurrency" => "CHF",  // Local Currency Code / Symbol
  "productsPerPage" => 6,  // Total Number of products displayed per page
  "paginationItems" => 5,  // Max Number of Pagination Items to display
];

define("DEFAULTS", $defaultValues);

?>