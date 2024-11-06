<?php
   
    $product = wc_get_product($product_id);
    $api_url = $GLOBALS['authorSite'].'/getProductsById';

    $data = array(
        'public_key' => get_option('aplus_plugin_public_key'),
        'product_id' => $product_id,
    );

    $response = wp_remote_post($api_url, array(
        'method'    => 'POST',
        'body'      => json_encode($data),
        'headers'   => array(
            'Content-Type' => 'application/json',
        ),
    ));

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo "Something went wrong: $error_message";
        return;
    }else{
        $body = wp_remote_retrieve_body( $response );
        $data = json_decode( $body, true );
        $result = json_decode($data['data'], true);
    }

    $totalProducts = wc_get_products( array(
        'limit' => -1,
        'status' => 'publish',
    ) );

    $productAttributes = array();

    foreach ($totalProducts as $product2) {
        $productAttributes[] = array(
            'id' => $product2->get_id(),
            'name' => $product2->get_name(),
            'price' => $product2->get_price(),
            'sku' => $product2->get_sku(),
            'stock' => $product2->get_stock_quantity(),
            'permalink' => $product2->get_permalink(),
            'image' => wp_get_attachment_url($product2->get_image_id()), // Get the URL of the product image
            'short_description' => $product2->get_short_description(), // Get the short description
            'reviews' => array(
                'rating' => $product2->get_average_rating(), // Get the average rating
                'total_reviews' => $product2->get_review_count() // Get the total number of reviews
            )
        );
    }	

    foreach($result as $row){
       
        $module_id = $row['module_ids'];
        $module_id = explode(",",$module_id);
        $content_id = $row['id'];

        $uploads = wp_upload_dir();
		$upload_path = $uploads['baseurl'];
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <p class="h6">A+ Content Manager</p>
                </div>

                <form id="updateContentFormSubmit" enctype="multipart/form-data">
                    <div class="card-body">
                        <p class="h6">Selected Product</p>
                        <input type="text" class="form-control" value="<?php echo $product->get_name(); ?>" readonly>
                        <input type="hidden" value="<?php echo $content_id; ?>" name="content_id">
                        <input type="hidden" value="<?php echo $product_id; ?>" name="product_id">
                        <hr>
                        <p class="h6">Edit Content</p>
                        <div id="moduleContent">
                        <?php
                        $count = 1;
                        $flag1 = 0;
                        $flag2 = 0;
                        $flag3 = 0;
                        $flag4 = 0;
                        $flag5 = 0;
                        $flag6 = 0;
                        $flag7 = 0;
                        $flag8 = 0;
                        $flag9 = 0;
                        $flag10 = 0;

                        for($i=0; $i<count($module_id); $i++){
                            $u =  explode('.',$module_id[$i]);
                            if($u[0] == 1){
                                include "modules/module1.php";
                                $flag1 = $flag1 + 1;
                                $count++;
                            }else if($u[0] == 2){
                                include "modules/module2.php";
                                $flag2 = $flag2 + 1;
                                $count++;
                            }else if($u[0] == 3){
                                include "modules/module3.php";
                                $flag3 = $flag3 + 1;
                                $count++;
                            }else if($u[0] == 4){
                                include "modules/module4.php";
                                $flag4 = $flag4 + 1;
                                $count++;
                            }else if($u[0] == 5){
                                include "modules/module5.php";
                                $flag5 = $flag5 + 1;
                                $count++;
                            }else if($u[0] == 6){
                                include "modules/module6.php";
                                $flag6 = $flag6 + 1;
                                $count++;
                            }else if($u[0] == 7){
                                include "modules/module7.php";
                                $flag7 = $flag7 + 1;
                                $count++;
                            }else if($u[0] == 8){
                                include "modules/module8.php";
                                $flag8 = $flag8 + 1;
                                $count++;
                            }else if($u[0] == 9){
                                include "modules/module9.php";
                                $flag9 = $flag9 + 1;
                                $count++;
                            }else if($u[0] == 10){
                                include "modules/module10.php";
                                $flag10 = $flag10 + 1;
                                $count++;
                            }
                        }
                        
                        ?>
                        </div>

                        <div class="text-center border border-primary my-3" style="padding: 100px;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customTemplateModal">
                                Add Module
                            </button>
                        </div>
                        <div id="totalProducts" totalProducts='<?php echo json_encode($productAttributes); ?>'></div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
    }

?>

<div class="text-center" id="aplusloader" style="display: none;">
    <img src="<?php echo plugins_url('../img/Spinner-3.gif', __FILE__); ?>" alt="loader" class="img-fluid" width="100px" height="100px">
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
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card h-100 editor-page-module" moduleNumber="1" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Standard Image <span class="text-secondary">(Image size: 1440 px wide, 900 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <img src="<?php echo esc_url(plugins_url('../img/image2.jpg', __FILE__)); ?>" class="img-fluid" alt="Demo1" width="auto" height="auto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 editor-page-module" moduleNumber="8" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Logo <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="logo-container mx-auto text-center h-25 w-25">
                                        <img src="<?php echo esc_url(plugins_url('../img/single-left-image.jpg', __FILE__)); ?>" alt="" class="w-100 h-auto"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card editor-page-module" moduleNumber="2" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Three Columns with Images, Heading, and Description <span class="text-secondary">(Image size: 365 px wide, 240 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card">
                                                <img src="<?php echo esc_url(plugins_url('../img/image2.jpg', __FILE__)); ?>" class="card-img-top" alt="col1" width="100%" />
                                                <b>Heading 1</b>
                                                <p class="card-text">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card">
                                                <img src="<?php echo esc_url(plugins_url('../img/image 3.jpg', __FILE__)); ?>" class="card-img-top" alt="col2" width="100%" />
                                                <b>Heading 2</b>
                                                <p class="card-text">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card">
                                                <img src="<?php echo esc_url(plugins_url('../img/image 4.jpg', __FILE__)); ?>" class="card-img-top" alt="col3" width="100%" />
                                                <b>Heading 3</b>
                                                <p class="card-text">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
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
                            <div class="card editor-page-module" moduleNumber="3" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Single Right Image <span class="text-secondary">(Image size: 560 px wide, 420 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <div class="contant">
                                                <h3>Heading</h3>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s,  when an unknown printer took a galley of
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
                            <div class="card editor-page-module" moduleNumber="4" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Single Left Image <span class="text-secondary">(Image size: 560 px wide, 420 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <img src="<?php echo esc_url(plugins_url('../img/single-left-image.jpg', __FILE__)); ?>" class="w-100" alt="" />
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <div class="contant">
                                                <h3>Heading</h3>
                                                <p>
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text
                                                    ever since the 1500s,  when an unknown printer took a galley of
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
                            <div class="card editor-page-module" moduleNumber="5" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Slider <span class="text-secondary">(Image size: 1320-1650 px wide, 550-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
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
                            <div class="card editor-page-module" moduleNumber="6" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Video with Image <span class="text-secondary">(Image size: 555 px wide, 370 px tall. Image Formats: JPG, JPEG, PNG, WEBP. Video Formats: MP4, AVI, MKV.)</span></h6>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card editor-page-module" moduleNumber="7" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Hero Banner <span class="text-secondary">(Image size: 1320-1650 px wide, 385-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="container banner-section-one">
                                        <img src="<?php echo esc_url(plugins_url('../img/default-banner-img1.jpg', __FILE__)); ?>" class="img-fluid w-100" alt="..." />
                                    </div>
                                    <div class="container banner-section-two">
                                        <div class="row">
                                            <h1>Lorem Ipsum</h1>
                                            <p>
                                                Lorem Ipsum is simply dummy text of the printing and typesetting
                                                industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                since the 1500s, when an unknown printer took a galley of type and
                                                scrambled it to make a type specimen book. It has survived not only
                                                five centuries, but also the leap into electronic typesetting,
                                                remaining essentially unchanged. 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card editor-page-module" moduleNumber="9" style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Two Standard Cards <span class="text-secondary">(Image size: 550 px wide, 300 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <img src="<?php echo esc_url(plugins_url('../img/default-banner-img1.jpg', __FILE__)); ?>" class="w-100" alt="" />
                                            <b>Heading1</b>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolor minus magnam blanditiis quis, dolore eius ratione ipsum</p>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <img src="<?php echo esc_url(plugins_url('../img/slide1.jpg', __FILE__)); ?>" class="w-100" alt="" />
                                            <b>Heading2</b>
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolor minus magnam blanditiis quis, dolore eius ratione ipsum</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="moduleNo10">
                        <div class="col-md-12">
                            <div class="card editor-page-module" moduleNumber="10" totalProducts='<?php echo json_encode($productAttributes); ?>' style="cursor: pointer;">
                                <div class="card-header">
                                    <h6>Compare with similar items</h6>
                                </div>
                                <div class="card-body">
                                    <div class="col-12"  style="overflow-x:auto;">
                                        <table class="table  compare-table">
                                            <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">
                                                    <div class="related-product">
                                                        <img src="<?php echo esc_url(plugins_url('../img/compare-mod1.jpg', __FILE__)); ?>" alt="">
                                                        <p class="product-des">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, nisi?</p>
                                                    </div>
                                                </th>
                                                <th scope="col">
                                                    <div class="related-product">
                                                        <img src="<?php echo esc_url(plugins_url('../img/compare-2.jpg', __FILE__)); ?>" alt="">
                                                        <p class="product-des">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, nisi?</p>
                                                    </div>
                                                </th>
                                                <th scope="col">
                                                    <div class="related-product">
                                                        <img src="<?php echo esc_url(plugins_url('../img/compare-mod3.jpg', __FILE__)); ?>" alt="">
                                                        <p class="product-des">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, nisi?</p>
                                                    </div>
                                                </th>
                                                <th scope="col">
                                                    <div class="related-product">
                                                        <img src="<?php echo esc_url(plugins_url('../img/compare-4.jpg', __FILE__)); ?>" alt="">
                                                        <p class="product-des">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptates, nisi?</p>
                                                    </div>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">Price</th>
                                                <td><p><span class="text-danger fw-bold">-69%</span> ₹20,000</p><span>M.R.P: ₹18,999.00</span></td>
                                                <td><p><span class="text-danger fw-bold">-69%</span> ₹20,000</p><span>M.R.P: ₹18,999.00</span></td>
                                                <td><p><span class="text-danger fw-bold">-69%</span> ₹20,000</p><span>M.R.P: ₹18,999.00</span></td>
                                                <td><p><span class="text-danger fw-bold">-69%</span> ₹20,000</p><span>M.R.P: ₹18,999.00</span></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Breed Review</th>
                                                <td><div class="rating d-flex align-item-center justify-content-start text-warning"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star-half-stroke"></i></div></td>
                                                <td><div class="rating d-flex align-item-center justify-content-start text-warning"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star-half-stroke"></i></div></td>
                                                <td><div class="rating d-flex align-item-center justify-content-start text-warning"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star-half-stroke"></i></div></td>
                                                <td><div class="rating d-flex align-item-center justify-content-start text-warning"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star-half-stroke"></i></div></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Size</th>
                                                <td>3-4</td>
                                                <td>3-4</td>
                                                <td>3-4</td>
                                                <td>3-4</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kid Friendly</th>
                                                <td>5.0</td>
                                                <td>5.0</td>
                                                <td>5.0</td>
                                                <td>5.0</td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">Easy to Groom</th>
                                                <td>4.5</td>
                                                <td>4.5</td>
                                                <td>4.5</td>
                                                <td>4.5</td>
                                            
                                            </tr>
                                            <tr>
                                                <th scope="row">High Energy</th>
                                                <td>3-4</td>
                                                <td>3-4</td>
                                                <td>3-4</td>
                                                <td>3-4</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Good Health</th>
                                                <td>4.3</td>
                                                <td>4.3</td>
                                                <td>4.3</td>
                                                <td>4.3</td>
                                            
                                            </tr>
                                            </tbody>
                                        </table>
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

<script>
    jQuery(document).ready(function($) {

        var formSubmitted = false;

        // Set flag when a form is submitted
        $('form').on('submit', function() {
            formSubmitted = true;
        });

        // Handle beforeunload event
        $(window).on('beforeunload', function(e) {
            if (!formSubmitted) {
                // Display custom alert (Note: Alert is separate from beforeunload confirmation)
                alert("Are you sure you want to leave this page? Changes you made may not be saved.");
                
                // Return a message to show the native confirmation dialog
                var message = "Are you sure you want to leave this page? Changes you made may not be saved.";
                e.returnValue = message; // For most browsers
                return message; // For others
            }
        });
    });
</script>