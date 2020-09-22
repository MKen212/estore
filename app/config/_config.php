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
  "noImgUploaded" => "images/shared/noImage.jpg" ,  // Default Image if no image file uploaded
  "countryCode" => "CH",  // Default Country Code
  "currency" => "CHF",  // Default Currency
  "productsPerPage" => 6,  // Total Number of products displayed per page
  "paginationItems" => 5,  // Max Number of Pagination Items to display
  "orderStatusToSend" => 1,  // Orders OrderStatus for orders to be sent
  "orderStatusToRefund" => 3,  // Orders OrderStatus for orders to be refunded
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
  "Flag" => [  // products Table / Flag Field
    0 => [
      "text" => "None",
      "badge" => "secondary",
    ],
    1 => [
      "text" => "New",
      "badge" => "danger",
    ],
    2 => [
      "text" => "Sale",
      "badge" => "success",
    ],
  ],
  "OrderStatus" => [  // orders Table / OrderStatus Field
    0 => [
      "text" => "UnPaid",
      "badge" => "danger",
    ],
    1 => [
      "text" => "Paid",
      "badge" => "primary",
    ],
    2 => [
      "text" => "Shipped",
      "badge" => "success",
    ],
  ],
  "IsShipped" => [  // order_items Table / IsShipped Field
    0 => [
      "text" => "UnSent",
      "badge" => "danger",
    ],
    1 => [
      "text" => "Sent",
      "badge" => "success",
    ],
  ],
];

define("STATUS_CODES", $statusCodes);

?>