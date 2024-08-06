<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://github.com/Yogesh-Gupta-tech2globe
 * @since      1.0.0
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
// global $wpdb, $table_prefix;
// global $product;
// $query = "SELECT wp_apluscontent.*, wp_wc_product_meta_lookup.sku, wp_wc_product_meta_lookup.product_id FROM wp_apluscontent LEFT JOIN wp_wc_product_meta_lookup ON wp_apluscontent.product_id = wp_wc_product_meta_lookup.product_id  WHERE 1 ORDER BY wp_apluscontent.ID DESC";
// $data = $wpdb->get_results($query);
?>
<?php
// Get the current user object
$current_user = wp_get_current_user();
$user_name = !empty($current_user->display_name) ? $current_user->display_name : $current_user->user_login;
require_once plugin_dir_path(__FILE__) . '..\class-aplus-content-products-table.php';
?>

<div class="wrap">
    <div class="container">
        <!-- Dismissible alert -->
        <div class="alert welcome-alert alert-dismissible fade show" role="alert">
            <strong>Welcome, <?php echo esc_html($user_name); ?>!</strong> We're excited to have you using the A+ Content Plugin. If you need any assistance or have questions, don't hesitate to reach out. Enjoy enhancing your content!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <?php include('header.php'); ?>
        <div id="draggableContainer" class="row mt-3">
            <div id="overViewSection" class="row mt-3">
                <div class="text-end p-0"><i class="fa-solid fa-grip-vertical grabbable"></i></div>

                <div class="col-md-8 mt-2"><!-- Summary and Statistics -->
                    <div class="dashboard-summary mb-2">
                        <h4>Overview</h4>
                        <div class="row g-2 mt-2">
                            <div class="col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0 p-0 mt-0 h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted">Total Products</h5>
                                                <span class="h2 font-weight-bold mb-0">150</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                    <i class="fas fa-box"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0 p-0 mt-0 h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted">Products with A+ Content</h5>
                                                <span class="h2 font-weight-bold mb-0">3</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-danger mr-2">2%</span>
                                            <span class="text-nowrap">of total products</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0 p-0 mt-0 h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted">A+ Content Conversion Rate</h5> <!-- Updated stat -->
                                                <span class="h2 font-weight-bold mb-0">45%</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                                    <i class="fas fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0 p-0 mt-0 h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted">A+ Content Engagement Rate</h5>
                                                <span class="h2 font-weight-bold mb-0">72%</span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                    <i class="fas fa-chart-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-4 mt-2"> <!-- Recent Activity -->
                    <div class="recent-activity mb-2">
                        <h4>Recent Activity</h4>
                        <ol class="activity-feed m-0 mt-2">
                            <ul class="recent-activity p-0">
                                <li class="feed-item">
                                    <time class="date" datetime="2024-08-05">Aug 5</time>
                                    <span class="text">Deleted A+ content from product <a href="#">“Premium TWS”</a></span>
                                </li>
                                <li class="feed-item">
                                    <time class="date" datetime="2024-08-04">Aug 4</time>
                                    <span class="text">Modified A+ content for product <a href="#">“Smart Watch”</a></span>
                                </li>
                                <li class="feed-item">
                                    <time class="date" datetime="2024-08-03">Aug 3</time>
                                    <span class="text">Created A+ content to product <a href="#">“Premium TWS"</a></span>
                                </li>
                                <li class="feed-item">
                                    <time class="date" datetime="2024-08-03">Aug 3</time>
                                    <span class="text">Created A+ content to product <a href="#">“Smart Watch”</a></span>
                                </li>
                                <li class="feed-item">
                                    <time class="date" datetime="2024-08-02">Aug 2</time>
                                    <span class="text">Installed plugin and started on Free plan</span>
                                </li>
                            </ul>
                        </ol>
                    </div>
                </div>
            </div>

            <div id="productsTableSection" class="row">
                <div class="text-end p-0"><i class="fa-solid fa-grip-vertical grabbable"></i></div>
                <h4>Products A+ Content Status</h4>
                <form method="get">
                    <?php
                    // Render the search box
                    $table = new A_PLUS_CONTENT_PRODUCTS_TABLE();
                    $table->search_box('Search Products', 'search');
                    $table->prepare_items();
                    $table->display();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>

<!-- Script to save order in local storage -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var container = document.getElementById('draggableContainer');

        // Initialize Sortable
        var sortable = Sortable.create(container, {
            animation: 150,
            handle: '.grabbable',
            onEnd: function(evt) {
                saveOrder();
            }
        });

        // Function to save order in local storage
        function saveOrder() {
            var items = container.children;
            var order = [];
            for (var i = 0; i < items.length; i++) {
                order.push(items[i].id);
            }
            localStorage.setItem('aPlusContentDashboardSectionOrder', JSON.stringify(order));
        }

        // Function to load order from local storage
        function loadOrder() {
            var order = JSON.parse(localStorage.getItem('aPlusContentDashboardSectionOrder'));
            if (order) {
                var fragment = document.createDocumentFragment();
                for (var i = 0; i < order.length; i++) {
                    var item = document.getElementById(order[i]);
                    fragment.appendChild(item);
                }
                container.appendChild(fragment);
            }
        }

        // Load order when the page loads
        loadOrder();
    });
</script>