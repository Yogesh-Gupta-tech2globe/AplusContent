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
// Get the current user object
$current_user = wp_get_current_user();
$user_name = !empty($current_user->display_name) ? $current_user->display_name : $current_user->user_login;
require_once plugin_dir_path(__FILE__) . '..\class-aplus-content-products-table.php';

$products = wc_get_products( array(
    'limit' => -1,
    'status' => 'publish',
) );
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
                <!-- <div class="text-end p-0"><i class="fa-solid fa-grip-vertical grabbable"></i></div> -->

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
                                                <span class="h2 font-weight-bold mb-0"><?php echo count($products); ?></span>
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
                                                <span class="h2 font-weight-bold mb-0"><?php echo count($data); ?></span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $totalProducts = count($products);
                                        $aplusProducts = count($data);
                                        $percentage = ($aplusProducts / $totalProducts)*100;
                                        ?>
                                        <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-danger mr-2"><?php echo $percentage; ?>%</span>
                                            <span class="text-nowrap">of total products</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="card card-stats mb-4 mb-xl-0 p-0 mt-0 h-100">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted">A+ Content Conversion Rate</h5>
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
                            </div> -->

                            <!-- <div class="col-lg-6">
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
                            </div> -->
                        </div>

                    </div>
                </div>

                <div class="col-md-4 mt-2"> <!-- Recent Activity -->
                    <!-- <div class="recent-activity mb-2">
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
                    </div> -->
                </div>
            </div>

            <div id="productsTableSection" class="row">
                <!-- <div class="text-end p-0"><i class="fa-solid fa-grip-vertical grabbable"></i></div> -->
                <h4>Products A+ Content Status</h4>
                <div class="responsive-table mt-3">
                    <table id="aplusProductTable" class="table table-primary table-stripped" border="">
                        <thead>
                            <tr>
                                <th class="text-center">Product ID</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Updated At</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ( is_array( $data ) && ! empty( $data ) ) {
                                foreach ( $data as $key => $row ) {
                                    $product = wc_get_product($row['product_id']);
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo esc_html( $row['product_id'] ); ?></td>
                                        <td class="text-center"><?php echo $product->get_name(); ?></td>
                                        <td class="text-center"><a href="<?php echo site_url()."/product/".$product->get_slug(); ?>" target="_blank">View</a></td>
                                        <td class="text-center"><?php echo date('Y-m-d',strtotime($row['created_at'])); ?></td>
                                        <td class="text-center"><?php echo date('Y-m-d',strtotime($row['updated_at'])); ?></td>
                                        <td class="text-center">
                                            <button class="btn <?php if($row['status'] == 1){ echo 'btn-success'; }else{ echo 'btn-danger'; } ?> status-button" status="<?php echo $row['status']; ?>" content-id="<?php echo $row['id']; ?>">
                                                <i class="fa-solid <?php if($row['status'] == 1){ echo 'fa-toggle-on'; }else{ echo 'fa-toggle-off'; } ?>"></i>
                                            </button>
                                            <button class="btn btn-danger delete-button" content-id="<?php echo $row['id']; ?>">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <a href="<?= admin_url("admin.php?page=create-a-plus-content&action=edit&product_id=".$row['product_id']."") ?>" class="btn btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo 'No data available or data is not an array.';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
