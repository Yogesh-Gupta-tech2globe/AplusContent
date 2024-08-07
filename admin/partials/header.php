<header class="card mb-2">
  <div class="card-body d-md-flex justify-content-between align-items-center">
    <!-- Logo and Version Info -->
    <div class="header-info d-flex align-items-center mb-2 mb-md-0">
      <img src="<?php echo plugins_url('../img/logo.png', __FILE__); ?>" alt="Logo" class="img-fluid rounded">
      <h1>A+ Content</h1>
      <span class="text-muted d-none d-lg-block"><em>v1.0.0</em></span>
      <button type="button" class="btn btn-outline-secondary ms-3"><i class="fa-solid fa-crown text-warning"></i> Free Plan</button>
    </div>
    <!-- Support and Button -->
    <div class="header-support d-flex align-items-center">
      <a href="#feedback" class="link-dark"><i class="fas fa-comment-dots"></i> Feedback</a>
      <a href="#help" class="link-dark"><i class="fas fa-question-circle"></i> Help</a>
      <button type="button" class="btn btn-warning">Upgrade Now</button>
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
        <a class="nav-link" href="#settings">Settings</a>
        <a class="nav-link" href="#upgrade">Upgrade</a>
      </div>
    </div>
  </nav>
</header>