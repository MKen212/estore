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
  "testing" => true,  // Flag to set whether to show test information
  "maxUploadSize" => 2000000,  // Maximum PHP upload file size in bytes - see phpInfo
  "productsImgPath" => "uploads/imgProducts/",  // Path to product images
  "noImgUploaded" => "images/shared/noImage.jpg" ,  // Default Image if no image file uploaded
  "countryCode" => "CH",  // Default Country Code
  "currency" => "CHF",  // Default Currency
  "productsPerPage" => 6,  // Total Number of products displayed per page
  "paginationItems" => 5,  // Max Number of Pagination Items to display
  "returnsAllowance" => 30,  // Number of Days after shipping user allowed to return items
  "returnsAddress" => "Returns Dept, E-Store SA, Rue de Montreux 1, Lausanne 1000, Switzerland",  // Returns Address
  "contactAddress" => "E-Store SA, Rue de Montreux 1, Lausanne 1000, Switzerland",
  "contactPhone" => "+41 21 123 4567",
  "contactEmail" => "info@example.com",
];

define("DEFAULTS", $defaultValues);

/* Shipping Values */
$shippingValues = [
  "Bands" => [  // Shipping Bands
    "Domestic",  // Default
    "Europe",
    "Rest of World",
  ],
  "Types" => [  // Shipping Types
    "Standard",  // Default
    "Fast",
    "Express",
  ],
];

define("SHIPPING_VALUES", $shippingValues);

/* Shop Product Sort Options */
$prodSortOptions = [
  0 => [  // Default
    "text" => "Default",
    "sortSQL" => "`Flag` DESC, `EditTimeStamp` DESC",
  ],
  1 => [
    "text" => "Newest First",
    "sortSQL" => "`ProductID` DESC",
  ],
  2 => [
    "text" => "Price, Low to High",
    "sortSQL" => "`Price`",
  ],
  3 => [
    "text" => "Price, High to Low",
    "sortSQL" => "`Price` DESC",
  ],
];

define("PROD_SORT_OPTIONS", $prodSortOptions);

/* Status Codes */
$statusCodes = [
  "Status" => [  // All Tables / Status Field
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
  "MessageStatus" => [  // messages Table / MessageStatus Field
    0 => [
      "text" => "Unread",
      "badge" => "danger",
    ],
    1 => [
      "text" => "Read",  // NOTE: Used in admin/sideBarBadges.php to show Messages To Respond
      "badge" => "warning",
    ],
    2 => [
      "text" => "Replied",  // NOTE: Used in admin/messageDetails.php to set MessageStatus
      "badge" => "success",
    ],
    3 => [
      "text" => "Cancelled",
      "badge" => "secondary",
    ],
  ],
  "OrderStatus" => [  // orders Table / OrderStatus Field
    0 => [
      "text" => "UnPaid",
      "badge" => "danger",
    ],
    1 => [
      "text" => "Paid",  // NOTE: Used in admin/sideBarBadges.php to show Orders To Process
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
  "ReturnStatus" => [  // returns Table / ReturnStatus Field
    0 => [
      "text" => "Submitted",
      "badge" => "primary",
    ],
    1 => [
      "text" => "Returned",  // NOTE: Used in admin/sideBarBadges.php to show Returns To Process
      "badge" => "warning",
    ],
    2 => [
      "text" => "Processed",
      "badge" => "success",
    ],
    3 => [
      "text" => "Cancelled",
      "badge" => "secondary",
    ],
  ],
  "ReturnReason" => [  // return_items Table / ReturnReason Field
    0 => [
      "text" => "No Longer Needed",
      "badge" => "info",
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
  "ReturnAction" => [  // return_items Table / ReturnAction Field
    0 => [
      "text" => "Replace",  // NOTE: Used in shop/returnConfirmation.php to update item price to zero if item being replaced
      "badge" => "warning",
    ],
    1 => [
      "text" => "Refund",
      "badge" => "danger",
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
  "IsActioned" => [  // return_items Table / IsActioned Field
    0 => [
      "text" => "No",
      "badge" => "danger",
    ],
    1 => [
      "text" => "Yes",
      "badge" => "success",
    ],
  ],
];

define("STATUS_CODES", $statusCodes);

?>