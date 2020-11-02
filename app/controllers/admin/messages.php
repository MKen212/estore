<?php  // Admin Dashboard - Messages List/Edit


?>

<!-- Main Section - Messages List -->
<div class="pt-3 pb-2 mb-3 border-bottom">
  <h2>Messages</h2>
</div>

<div class="row">
  <!-- Messsages Table Search -->
  <div class="col-4 mb-3">
    <form action="" method="POST" name="schMessages">
      <!-- Search -->
      <div class="input-group">
        <input class="form-control" type="text" name="schNameorSubj" placeholder="Search Name or Subject" autocomplete="off" />
        <div class="input-group-append">
          <button class="btn btn-secondary" type="submit" name="messageSearch"><span data-feather="search"></span></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-2">
    <!-- New Message Button ** NOT REQUIRED - Messages only added in Shop** -->
  </div>
  <div class="col-6">
    <!-- System Messages -->
    <?php msgShow(); ?>
  </div>
</div>