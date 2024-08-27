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
      <a href="#feedback" class="link-dark"><i class="fas fa-comment-dots"></i> Feedback</a>
      <a href="#help" class="link-dark"><i class="fas fa-question-circle"></i> Help</a>
      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#upgradeModal">Upgrade Now</button>
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
        <!-- <a class="nav-link" href="#settings">Settings</a> -->
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

      <!-- Modal Body -->
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <div class="plan-card">
              <input type="radio" name="plan" id="basicPlanModal" value="basic">
              <label for="basicPlanModal">
                  <div class="plan-title">Basic Plan</div>
                  <div class="plan-price">$20</div>
                  <p class="form-text">For 2-10 Products.</p>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="plan-card">
              <input type="radio" name="plan" id="premiumPlanModal" value="premium">
              <label for="premiumPlanModal">
                  <div class="plan-title">Premium Plan</div>
                  <div class="plan-price">$40</div>
                  <p class="form-text">For 11-50 Products.</p>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="plan-card">
              <input type="radio" name="plan" id="proPlanModal" value="pro">
              <label for="proPlanModal">
                  <div class="plan-title">Pro Plan</div>
                  <div class="plan-price">$99</div>
                  <p class="form-text">For 51-200 Products.</p>
              </label>
            </div>
          </div>
          <div class="col-md-3">
            <div class="plan-card">
              <input type="radio" name="plan" id="proPlusPlanModal" value="proPlus">
              <label for="proPlusPlanModal">
                  <div class="plan-title">Pro Plus Plan</div>
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
        <a href="<?= admin_url("admin.php?page=upgrade-a-plus-content") ?>" type="button" class="btn btn-primary">Proceed</a>
      </div>

    </div>
  </div>
</div>

