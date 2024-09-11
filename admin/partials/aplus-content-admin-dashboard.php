<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/Yogesh-Gupta-tech2globe
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

$products = wc_get_products( array(
    'limit' => -1,
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
                                                <span class="h2 font-weight-bold mb-0"><?php echo count($productData); ?></span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $totalProducts = count($products);
                                        $aplusProducts = count($productData);
                                        if($totalProducts != 0){
                                        $percentage = ($aplusProducts / $totalProducts)*100;
                                        ?>
                                        <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-danger mr-2"><?php echo round($percentage,2); ?>%</span>
                                            <span class="text-nowrap">of total products</span>
                                        </p>
                                        <?php
                                        }
                                        ?>
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

                <div class="col-md-4 mt-2">
                    <!-- Recent Activity -->
                    <div class="recent-activity mb-2">
                        <h4>Recent Activity</h4>
                        <ol class="activity-feed m-0 mt-2">
                            <ul class="recent-activity" style="max-height: 200px; overflow-y: auto;"> <!-- Add scroll -->
                                <?php
                                if ($logs) {
                                    foreach ($logs as $log) {
                                        $product = wc_get_product($log->product_id);
                                        $user = get_userdata($log->user_id);
                                        $role = !empty($user->roles) ? implode(', ', $user->roles) : 'No role assigned';
                                        ?>
                                        <li class="feed-item">
                                            <time class="date" datetime="<?= date('Y-m-d', strtotime($log->log_time)) ?>"><?= date('Y-m-d', strtotime($log->log_time)) ?></time>
                                            <span class="text"><?= esc_html($log->operation) ?> A+ content for product <a href="<?php echo esc_url(site_url() . "/product/" . $product->get_slug()); ?>" target="_blank"><?= esc_html($product->get_name()); ?></a> by <?= esc_html($user->display_name) . " (" . esc_html($role) . ")"; ?></span>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </ol>
                    </div>
                </div>

            </div>

            <div id="productsTableSection" class="row">
                <!-- <div class="text-end p-0"><i class="fa-solid fa-grip-vertical grabbable"></i></div> -->
                <h4>Products A+ Content Status</h4>
                <div class="table-responsive mt-3">
                    <table id="aplusProductTable" class="table table-primary table-hover table-stripped" border="">
                        <thead>
                            <tr>
                                <th class="text-center">Product ID</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Updated At</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ( is_array( $productData ) && ! empty( $productData ) ) {
                                foreach ( $productData as $key => $row ) {
                                    $product = wc_get_product($row['product_id']);

                                    // Filter the array
                                    $filtered = array_filter($logs, function($item) use ($row) {
                                        return $item->product_id == $row['product_id'] && strtolower($item->operation) == 'create';
                                    });

                                    // Sort by id in descending order
                                    usort($filtered, function($a, $b) {
                                        return $b->id <=> $a->id;
                                    });

                                    // Get the user_id of the first element
                                    if (!empty($filtered)) {
                                        $userData = get_userdata($filtered[0]->user_id);
                                    } else {
                                        $userData = "NO USER";
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo esc_html( $row['product_id'] ); ?></td>
                                        <td class="text-center"><?php echo $product->get_name(); ?></td>
                                        <td class="text-center"><?php echo date('d-m-Y',strtotime($row['created_at']))."<br>".date('h:m:s',strtotime($row['created_at'])); ?> </td>
                                        <td class="text-center"><?php echo date('d-m-Y',strtotime($row['updated_at']))."<br>".date('h:m:s',strtotime($row['updated_at'])); ?></td>
                                        <td class="text-center"><?php echo esc_html($userData->display_name); echo "<br> (".implode(', ', $user->roles).")"; ?></td>
                                        <?php if($product->get_status() == "draft"){ ?>
                                            <td class="text-center"><a href="<?php echo site_url()."/?post_type=product&p=".$product->get_id()."&preview=true" ?>" target="_blank">Preview(D)</a></td>
                                        <?php }else{ ?>
                                        <?php if($row['status'] == 1){ ?>
                                            <td class="text-center"><a href="<?php echo site_url()."/product/".$product->get_slug(); ?>" target="_blank">View</a></td>
                                        <?php } else { ?>
                                            <td class="text-center"><a href="<?php echo site_url()."/product/".$product->get_slug()."/?preview=true" ?>" target="_blank">Preview</a></td>
                                        <?php } }?>
                                        <td class="text-center">
                                            <button class="btn <?php if($product->get_status() == "draft"){ echo 'disabled'; } ?> <?php if($row['status'] == 1){ echo 'btn-success'; }else{ echo 'btn-warning'; } ?> aplus-status-button" status="<?php echo $row['status']; ?>" content-id="<?php echo $row['id']; ?>" product-id="<?= $row['product_id'] ?>">
                                                <i class="fa-solid <?php if($row['status'] == 1){ echo 'fa-toggle-on'; }else{ echo 'fa-toggle-off'; } ?>"></i>
                                            </button>
                                            <?php if(current_user_can('administrator')){ ?>
                                            <button class="btn btn-danger aplus-delete-button" content-id="<?php echo $row['id']; ?>" product-id="<?= $row['product_id'] ?>">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <?php } ?>
                                            <a href="<?= admin_url("admin.php?page=create-a-plus-content&action=edit&product_id=".$row['product_id']."") ?>" class="btn btn-primary">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } 
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row my-5">
                <h4>Products A+ Content (Deleted)</h4>
                <div class="table-responsive mt-3">
                    <table id="aplusDelProductTable" class="table table-secondary table-hover table-stripped" border="">
                        <thead>
                            <tr>
                                <th class="text-center">Product ID</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Updated At</th>
                                <th class="text-center">Created By</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ( is_array( $delProductData ) && ! empty( $delProductData ) ) {
                                foreach ( $delProductData as $key => $row ) {
                                    $product = wc_get_product($row['product_id']);

                                    if($product->get_status() != "trash"){
                                    // Filter the array
                                    $filtered = array_filter($logs, function($item) use ($row) {
                                        return $item->product_id == $row['product_id'] && strtolower($item->operation) == 'create';
                                    });

                                    // Sort by id in descending order
                                    usort($filtered, function($a, $b) {
                                        return $b->id <=> $a->id;
                                    });

                                    // Get the user_id of the first element
                                    if (!empty($filtered)) {
                                        $userData = get_userdata($filtered[0]->user_id);
                                    } else {
                                        $userData = "NO USER";
                                    }
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo esc_html( $row['product_id'] ); ?></td>
                                        <td class="text-center"><?php echo $product->get_name(); ?></td>
                                        <td class="text-center"><?php echo date('d-m-Y',strtotime($row['created_at']))."<br>".date('h:m:s',strtotime($row['created_at'])); ?> </td>
                                        <td class="text-center"><?php echo date('d-m-Y',strtotime($row['updated_at']))."<br>".date('h:m:s',strtotime($row['updated_at'])); ?></td>
                                        <td class="text-center"><?php echo esc_html($userData->display_name); echo "<br> (".implode(', ', $userData->roles).")"; ?></td>
                                        <?php if($product->get_status() == "draft"){ ?>
                                            <td class="text-center"><a href="<?php echo site_url()."/?post_type=product&p=".$product->get_id()."&preview=true" ?>" target="_blank">Preview(D)</a></td>
                                        <?php }else{ ?>
                                        <?php if($row['status'] == 1){ ?>
                                            <td class="text-center"><a href="<?php echo site_url()."/product/".$product->get_slug(); ?>" target="_blank">View</a></td>
                                        <?php } else { ?>
                                            <td class="text-center"><a href="<?php echo site_url()."/product/".$product->get_slug()."/?preview=true" ?>" target="_blank">Preview</a></td>
                                        <?php } }?>
                                        <td class="text-center">
                                            <a href="https://www.tech2globe.com/contact-us" class="btn btn-success" target="_blank">Contact Support</a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js"></script>
<script>
    jQuery(document).ready(function($){
        $("#aplusProductTable").DataTable({  
        });
        $("#aplusDelProductTable").DataTable({  
        });
    });
</script>