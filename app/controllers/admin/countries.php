<?php  // Admin Dashboard - Countries List/Edit
include_once "../app/models/countryClass.php";
$country = new Country();

// Get recordID if provided and process Status changes if hyperlinks clicked
$countryID = 0;
if (isset($_GET["id"])) {
  $countryID = cleanInput($_GET["id"], "int");

  if (isset($_GET["updStatus"])) {  // Status link was clicked
    $curStatus = cleanInput($_GET["cur"], "int");
    $newStatus = statusCycle("Status", $curStatus);
    // Update Country Status
    $updateStatus = $country->updateStatus($countryID, $newStatus);
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