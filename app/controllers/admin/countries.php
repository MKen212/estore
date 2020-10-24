<?php  // Admin Dashboard - Countries List/Edit
if (isset($_GET["updStatus"])) {  // Status link was clicked
  $code = $_GET["code"];
  $current = $_GET["cur"];
  $_GET = [];
  $newStatus = statusCycle("Status", $current);
  // Update Country Status
  include_once "../app/models/countryClass.php";
  $country = new Country();
  $updateStatus = $country->updateStatus($code, $newStatus);
}
?>

<!-- Main Section - Country List -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Shipping Countries</h2>
</div>

<div class="row">
  <!-- Countries Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schCountry">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schName" placeholder="Search Name" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="countrySearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New Country Button -->
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=countryAdd">Add New Country</a>
    </div>
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Countries Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr><!-- Countries Table Header -->        
          <th style="width:10%">Code</th>
          <th style="width:30%">Name</th>
          <th style="width:20%">Shipping Band</th>
          <th style="width:25%">Last Edit</th>
          <th style="width:15%">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_POST["countrySearch"])) {
          $search = fixSearch($_POST["schName"]);
          $_POST = [];
        } else {
          $search = null;
        }
        include_once "../app/models/countryClass.php";
        $country = new Country();
        foreach(new RecursiveArrayIterator($country->getList($search)) as $record) {
          include "../app/views/admin/countryListItem.php";
        }
        ?>      
      </tbody>
    </table>
  </div>
</div>