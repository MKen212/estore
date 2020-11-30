<!-- Product Categories List - ADMIN -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Product Categories</h2>
</div>

<div class="row">
  <!-- ProdCats Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schProdCats">
      <div class="input-group">
        <input class="form-control" type="text" name="schName" placeholder="Search Name" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="prodCatSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <!-- New Product Category Button -->
  <div class="col-2">
    <div class="input-group">
      <a class="btn btn-primary" href="admin_dashboard.php?p=prodCatAdd">Add New Category</a>
    </div>
  </div>
  <!-- System Messages -->
  <div class="col-6"><?php
    msgShow(); ?>
  </div>
</div>

<div class="row">
  <!-- ProdCat Table List -->
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
        foreach($prodCatList as $record) : ?>
          <tr><!-- Product Categories Record-->
            <td style="width: 50%"><a href="admin_dashboard.php?p=prodCatDetails&id=<?= $record["ProdCatID"]; ?>"><?= $record["Name"]; ?></a></td>
            <td style="width: 35%"><?= date("d/m/Y @ H:i", strtotime($record["EditTimestamp"])) . " by " . $record["EditUserID"]; ?></td>
            <td style="width: 15%"><?= statusOutput("Status", $record["Status"], ("admin_dashboard.php?p=prodCats&id=" . $record["ProdCatID"] . "&cur=" . $record["Status"] . "&updStatus")); ?></td>
          </tr><?php
        endforeach ; ?>
      </tbody>
    </table>
  </div>
</div>