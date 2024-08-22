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
                            <div class="card module" moduleNumber="1" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Standard Image</h6>
                                </div>
                                <div class="card-body">
                                    <img src="<?php echo esc_url(plugins_url('../img/image2.jpg', __FILE__)); ?>" alt="Demo1" width="auto" height="200px">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card module" moduleNumber="2" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Three Columns with Images, Heading, and Description</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card">
                                                <img src="<?php echo esc_url(plugins_url('../img/image2.jpg', __FILE__)); ?>" class="card-img-top" alt="col1" width="100%" />
                                                <b>Heading 1</b>
                                                <p class="card-text">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card">
                                                <img src="<?php echo esc_url(plugins_url('../img/image 3.jpg', __FILE__)); ?>" class="card-img-top" alt="col2" width="100%" />
                                                <b>Heading 2</b>
                                                <p class="card-text">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card">
                                                <img src="<?php echo esc_url(plugins_url('../img/image 4.jpg', __FILE__)); ?>" class="card-img-top" alt="col3" width="100%" />
                                                <b>Heading 3</b>
                                                <p class="card-text">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card module" moduleNumber="3" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Single Right Image</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <div class="contant">
                                                <h3>Dog at Work</h3>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s,  when an unknown printer took a galley of
                                                    type and scrambled it to make a type specimen book. It has
                                                    survived not only five centuries, but also the leap into
                                                    electronic typesetting, remaining essentially unchanged. It was
                                                    popularised in the 1960s with the release of Letraset sheets
                                                    containing Lorem
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <img src="<?php echo esc_url(plugins_url('../img/single-right-image.jpg', __FILE__)); ?>" class="w-100" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card module" moduleNumber="4" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Single Left Image</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <img src="<?php echo esc_url(plugins_url('../img/single-left-image.jpg', __FILE__)); ?>" class="w-100" alt="" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <div class="contant">
                                                <h3>Cat at Work</h3>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s,  when an unknown printer took a galley of
                                                    type and scrambled it to make a type specimen book. It has
                                                    survived not only five centuries, but also the leap into
                                                    electronic typesetting, remaining essentially unchanged. It was
                                                    popularised in the 1960s with the release of Letraset sheets
                                                    containing Lorem
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card module" moduleNumber="5" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Slider</h6>
                                </div>
                                <div class="card-body">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                                                aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                                aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                                aria-label="Slide 3"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="<?php echo esc_url(plugins_url('../img/slide1.jpg', __FILE__)); ?>" class="d-block w-100" alt="..." />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="<?php echo esc_url(plugins_url('../img/slide1.jpg', __FILE__)); ?>" class="d-block w-100" alt="..." />
                                            </div>
                                            <div class="carousel-item">
                                                <img src="<?php echo esc_url(plugins_url('../img/slide1.jpg', __FILE__)); ?>" class="d-block w-100" alt="..." />
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                            data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card module" moduleNumber="6" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Video with Image</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <img src="<?php echo esc_url(plugins_url('../img/video-section-image.jpg', __FILE__)); ?>" class="w-100" alt="" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <a class="position-relative" href="" role="button"><img
                                                    class="w-100" src="<?php echo esc_url(plugins_url('../img/video-thumbnail.jpg', __FILE__)); ?>" alt="">
                                                <div class="play-icon position-absolute top-50 start-50 translate-middle"><i
                                                        class="fa-regular fa-circle-play fs-1 text-light"></i></div>
                                            </a>
                                        </div>
                                    </div>
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



