<?php
$api_url = $GLOBALS['authorSite'].'/getProducts';

$data = array(
    'public_key' => get_option('aplus_plugin_public_key'),
);

$response = wp_remote_post($api_url, array(
    'method'    => 'POST',
    'body'      => json_encode($data),
    'headers'   => array(
        'Content-Type' => 'application/json',
    ),
));

if (is_wp_error($response)) {
    $error_message = $response->get_error_message();
    echo "Something went wrong: $error_message";
    return;
} else {
    $body = wp_remote_retrieve_body($response);
    $decodedData = json_decode($body, true);

    if (isset($decodedData['data']) && !empty($decodedData['data'])) {
        $data = json_decode($decodedData['data'], true);
    } else {
        $data = [];
    }
}

$aplusProduct = array();
foreach ($data as $key => $row) {
    $productID = $row['product_id'];
    array_push($aplusProduct, $productID);
}

// Query to fetch all products except those with IDs present in the excluded_product_ids
$args = array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post__not_in'   => $aplusProduct,
);

$products = new WC_Product_Query($args);
$products = $products->get_products();
?>

<div class="row">
    <div class="col-md-12">
        <div class="card-header">
            <p class="h6">A+ Content Custom Editor</p>
        </div>

        <form id="customTemplateFormSubmit" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <p class="h6">Select Product</p>
                <select class="form-control" name="product_id" id="product-selection" required>
                    <option value="">Select Product</option>
                    <?php
                    foreach ($products as $product) :
                    ?>
                        <option value="<?php echo $product->get_id(); ?>"><?php echo $product->get_name(); ?></option>
                    <?php
                    endforeach;
                    ?>
                </select>
                <hr>
                <p class="h6">Create Content</p>
                <div id="moduleContent"></div>

                <div class="text-center border border-primary my-3" style="padding: 100px;">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customTemplateModal">
                        Add Module
                    </button>
                </div>
            </div>

            <div class="card-footer">
                <input type="hidden" name="status" id="customTemplateFormStatus" value="">
                <button type="submit" id="customTemplateFormSubmitBtn1" data-status="0" class="btn btn-warning">Draft</button>
                <button type="submit" id="customTemplateFormSubmitBtn2" data-status="1" class="btn btn-primary">Publish</button>
            </div>
        </form>
    </div>
</div>



<div class="modal fade" id="customTemplateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Module</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card module" moduleNumber="1">
                                <div class="card-header">
                                    <h6>Standard Image</h6>
                                </div>
                                <div class="card-body">
                                    <img src="<?php echo esc_url(plugins_url('../img/module1.jpeg', __FILE__)); ?>" alt="Demo1" width="auto" height="200px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



