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
  "returnsAllowance" => 30,  // Number of Days after shipping user allowed to return items
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
      "text" => "Paid",  // NOTE: Used in sideBarBadges/orderDetails to show Orders To Send
      "badge" => "primary",
    ],
    2 => [
      "text" => "Shipped",
      "badge" => "success",
    ],
    3 => [
      "text" => "Cancelled",
      "badge" => "secondary",
    ],
  ],
  "IsShipped" => [  // order_items Table / IsShipped Field
    0 => [
      "text" => "No",
      "badge" => "danger",
    ],
    1 => [
      "text" => "Yes",
      "badge" => "success",
    ],
  ],
  "ReturnReason" => [  // return_items Table / ReturnReason Field
    0 => [
      "text" => "No Longer Needed",
      "badge" => "secondary",
    ],
    1 => [
      "text" => "Defective / Damaged",
      "badge" => "danger",
    ],
    2 => [
      "text" => "Wrong Item Sent",
      "badge" => "danger",
    ],
    3 => [
      "text" => "Incorrect Size",
      "badge" => "warning",
    ],
    4 => [
      "text" => "Incorrect Description",
      "badge" => "warning",
    ],
  ],
  "IsReceived" => [  // return_items Table / IsReceived Field
    0 => [
      "text" => "No",
      "badge" => "danger",
    ],
    1 => [
      "text" => "Yes",
      "badge" => "success",
    ],
  ],
  "IsAddedToStock" => [  // return_items Table / IsAddedToStock Field
    0 => [
      "text" => "No",
      "badge" => "secondary",
    ],
    1 => [
      "text" => "Yes",
      "badge" => "success",
    ],
  ],
];

define("STATUS_CODES", $statusCodes);

?>