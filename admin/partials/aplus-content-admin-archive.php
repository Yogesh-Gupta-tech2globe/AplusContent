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

<div class="wrap">
    <div class="container">

        <?php include('header.php'); ?>
        
        <div class="row my-5">
            <h4>Archived A+ Content Products</h4>
            <div class="table-responsive mt-3">
                <table id="aplusDelProductTable" class="table table-secondary table-hover table-stripped" border="">
                    <thead>
                        <tr>
                            <th class="text-center">S.No.</th>
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
                        $a = 1;
                        foreach ( $delProductData as $key => $row ) {
                            $product = wc_get_product($row['product_id']);

                            // Check if $product is a valid object
                            if ( $product && is_object( $product ) && $product->get_status() != "trash" ) {
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
                                    <td class="text-center"><?php echo esc_html( $a ); ?></td>
                                    <td class="text-center"><?php echo esc_html( $row['product_id'] ); ?></td>
                                    <td class="text-center"><?php echo $product->get_name(); ?></td>
                                    <td class="text-center"><?php echo date('d-m-Y',strtotime($row['created_at']))."<br>".date('h:m:s',strtotime($row['created_at'])); ?> </td>
                                    <td class="text-center"><?php echo date('d-m-Y',strtotime($row['updated_at']))."<br>".date('h:m:s',strtotime($row['updated_at'])); ?></td>
                                    <td class="text-center"><?php echo is_object($userData) ? esc_html($userData->display_name) . "<br> (" . ucfirst(implode(', ', $userData->roles)) . ")" : 'NO USER'; ?></td>
                                    <?php if($product->get_status() == "draft"){ ?>
                                        <td class="text-center"><a href="<?php echo site_url()."/?post_type=product&p=".$product->get_id()."&preview=true" ?>" target="_blank">Preview(D)</a></td>
                                    <?php } else { ?>
                                        <?php if($row['status'] == 1){ ?>
                                            <td class="text-center"><a href="<?php echo site_url()."/product/".$product->get_slug(); ?>" target="_blank">View</a></td>
                                        <?php } else { ?>
                                            <td class="text-center"><a href="<?php echo site_url()."/product/".$product->get_slug()."/?preview=true" ?>" target="_blank">Preview</a></td>
                                        <?php } ?>
                                    <?php } ?>
                                    <td class="text-center">
                                        <a href="https://www.web2globe.com/contact-us/" class="btn btn-success" target="_blank">Contact Support</a>
                                    </td>
                                </tr>
                    <?php
                            $a++;
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

<script>
    jQuery(document).ready(function($){
        $("#aplusDelProductTable").DataTable({  
        });
    });
</script>