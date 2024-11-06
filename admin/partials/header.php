<header class="card mb-2">
  <div class="card-body d-md-flex justify-content-between align-items-center">
    <!-- Logo and Version Info -->
    <div class="header-info d-flex align-items-center mb-2 mb-md-0">
      <img src="<?php echo plugins_url('../img/logo.png', __FILE__); ?>" alt="Logo" class="img-fluid rounded">
      <h1>A+ Content</h1>
      <span class="text-muted d-none d-lg-block"><em>v1.0.0</em></span>
      <button type="button" class="btn btn-outline-secondary ms-3"><i class="fa-solid fa-crown text-warning"></i> <?php echo get_option('aplus_plugin_plan'); ?> Plan</button>
    </div>
    <!-- Support and Button -->
    <div class="header-support d-flex align-items-center">
      <a href="mailto:info@tech2globe.com" class="link-dark"><i class="fas fa-comment-dots"></i> Feedback</a>
      <a href="#" class="link-dark"><i class="fas fa-question-circle"></i> Help</a>
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#upgradeModal">Our Plans</button>
    </div>
  </div>
  <hr>
  <!-- Navigation -->

  <?php $page = $_GET['page'];?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <div class="navbar-nav">
        <a class="nav-link <?php if($page == 'a-plus-content'){ echo 'active'; } ?>" href="<?= admin_url("admin.php?page=a-plus-content") ?>">Dashboard</a>
        <a class="nav-link <?php if($page == 'create-a-plus-content'){ echo 'active'; } ?>" href="<?= admin_url("admin.php?page=create-a-plus-content") ?>">Create A+</a>
        <a class="nav-link <?php if($page == 'archive-a-plus-content'){ echo 'active'; } ?>" href="<?= admin_url("admin.php?page=archive-a-plus-content") ?>">Archive A+</a>
        <a class="nav-link <?php if($page == 'upgrade-a-plus-content'){ echo 'active'; } ?>" href="<?= admin_url("admin.php?page=upgrade-a-plus-content") ?>">Upgrade</a>
      </div>
    </div>
  </nav>
</header>

<!-- The Modal -->
<!-- Modal Structure -->
<div class="modal fade" id="upgradeModal" tabindex="-1" aria-labelledby="upgradeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="upgradeModalLabel">Our Plans</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <?php $current_plan = get_option('aplus_plugin_plan'); ?>
      <!-- Modal Body -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4">
            <div class="plan-card">
              <label for="basicPlanModal">
                  <div class="plan-title">
                  <?php
                  if($current_plan == "Free"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                  ?>   
                  Free Plan
                  <?php
                  if($current_plan == "Free"){
                      echo "<span class='text-center form-text'>(Current Plan)</span>";
                  }
                  ?>
                  </div>
                  <div class="plan-price">$0</div>
                  <p class="form-text">For 1 Product.</p>
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="plan-card">
              <label for="basicPlanModal">
                  <div class="plan-title">
                  <?php
                  if($current_plan == "Basic"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                  ?>   
                  Basic Plan
                  <?php
                  if($current_plan == "Basic"){
                      echo "<span class='text-center form-text'>(Current Plan)</span>";
                  }
                  ?>
                  </div>
                  <div class="plan-price">$20</div>
                  <p class="form-text">For 2-10 Products.</p>
              </label>
            </div>
          </div>
          <div class="col-md-4">
            <div class="plan-card">
              <label for="premiumPlanModal">
                  <div class="plan-title">
                  <?php
                  if($current_plan == "Premium"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                  ?>   
                  Premium Plan
                  <?php
                  if($current_plan == "Premium"){
                      echo "<span class='text-center form-text'>(Current Plan)</span>";
                  }
                  ?>
                  </div>
                  <div class="plan-price">$40</div>
                  <p class="form-text">For 11-50 Products.</p>
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="plan-card">
              <label for="proPlanModal">
                  <div class="plan-title">
                  <?php
                  if($current_plan == "Pro"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                  ?>  
                  Pro Plan
                  <?php
                  if($current_plan == "Pro"){
                      echo "<span class='text-center form-text'>(Current Plan)</span>";
                  }
                  ?>
                  </div>
                  <div class="plan-price">$99</div>
                  <p class="form-text">For 51-200 Products.</p>
              </label>
            </div>
          </div>
          <div class="col-md-6">
            <div class="plan-card">
              <label for="proPlusPlanModal">
                  <div class="plan-title">
                  <?php
                  if($current_plan == "Pro Plus"){ echo '<i class="fa-solid fa-circle-check text-success"></i>';}
                  ?>   
                  Pro+ Plan
                  <?php
                  if($current_plan == "Pro Plus"){
                      echo "<span class='text-center form-text'>(Current Plan)</span>";
                  }
                  ?>
                  </div>
                  <div class="plan-price">$499</div>
                  <p class="form-text">For Unlimited Products.</p>
              </label>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <a href="<?= admin_url("admin.php?page=upgrade-a-plus-content") ?>" type="button" class="btn btn-primary">Want To Upgrade</a>
      </div>

    </div>
  </div>
</div>

