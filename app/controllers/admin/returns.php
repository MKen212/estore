<?php  // Admin Dashboard - Returns List/Edit
include_once "../app/models/returnsClass.php";
$returns = new Returns();

// Fix Returns InvoiceID Search if entered
$invoiceID = null;
if (isset($_POST["returnSearch"])) {
  $invoiceID = fixSearch($_POST["schReturn"]);
}
$_POST = [];

// Get List of returns
$returnsList = $returns->getList($invoiceID);

// Display Returns List View
include "../app/views/admin/returnsList.php";
?>