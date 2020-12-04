<!-- Product Brands List - Admin -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Product Brands</h2>
</div>

<div class="row">
  <!-- ProdBrands Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="post" name="schProdBrands">
      <div class="input-group">
        <input class="form-control" type="text" name="schName" placeholder="Search Name" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="prodBrandSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New Product Brand Button -->
  <div class="col-2">
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=prodBrandAdd">Add New Brand</a>
    </div>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- ProdBrands Table List -->
  <div class="table-responsive">
    <table class="table table-striped table-sm tableScrollable">
      <thead>
        <tr>
          <th style="width: 50%">Name</th>
          <th style="width: 35%">Last Edit</th>
          <th style="width: 15%">Status</th>
        </tr>
      </thead>
      <tbody><?php
        foreach($prodBrandList as $record) : ?>
          <tr><!-- Product Brands Record -->
            <td style="width: 50%"><a href="admin_dashboard.php?p=prodBrandDetails&id=<?= $record["ProdBrandID"] ?>"><?= $record["Name"] ?></a></td>
            <td style="width: 35%"><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"] ?></td>
            <td style="width: 15%"><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=prodBrands&id=" . $record["ProdBrandID"] . "&cur=" . $record["Status"] . "&updStatus")) ?></td>
          </tr><?php
        endforeach; ?>
      </tbody>
    </table>
  </div>
</div>