<!-- Countries List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Shipping Countries</h2>
</div>

<div class="row">
  <!-- Countries Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="post" name="schCountry">
      <div class="input-group">
        <input class="form-control" type="text" name="schName" placeholder="Search Name" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="countrySearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New Country Button -->
  <div class="col-2">
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=countryAdd">Add New Country</a>
    </div>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- Countries Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr>
          <th style="width: 6%">Code</th>
          <th style="width: 44%">Name</th>
          <th style="width: 16%">Shipping Band</th>
          <th style="width: 25%">Last Edit</th>
          <th style="width: 9%">Status</th>
        </tr>
      </thead>
      <tbody><?php
        foreach($countryList as $record) : ?>
          <tr><!-- Country Record -->
            <td style="width: 6%"><?= $record["Code"] ?></td>
            <td style="width: 44%"><a href="admin_dashboard.php?p=countryDetails&id=<?= $record["CountryID"] ?>"><?= $record["Name"] ?></a></td>
            <td style="width: 16%"><?= $record["ShippingBand"] ?></td>
            <td style="width: 25%"><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"] ?></td>
            <td colspan="2" style="width: 9%"><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=countries&id=" . $record["CountryID"] . "&cur=" . $record["Status"] . "&updStatus")) ?></td>
          </tr><?php
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>