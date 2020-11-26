<?php  // Admin Dashboard - Countries List/Edit
include_once "../app/models/countryClass.php";
$country = new Country();

// Get code if provided and process Status changes if hyperlinks clicked
$code = null;
if (isset($_GET["code"])) {
  $code = cleanInput($_GET["code"], "string");

  if (isset($_GET["updStatus"])) {  // Status link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update Country Status
    $updateStatus = $country->updateStatus($code, $newStatus);
  }
}
$_GET = [];

// Fix Country Name Search if entered
$name = null;
if (isset($_POST["countrySearch"])) {
  $name = fixSearch($_POST["schName"]);
}
$_POST = [];

// Get List of countries
$countryList = $country->getList($name);

// Display Countries List View
include "../app/views/admin/countriesList.php";
?>