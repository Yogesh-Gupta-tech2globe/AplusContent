<?php
list($products, $allowProduct) = Aplus_Content_Admin::getProducts();
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
                    <?php if(count($products) == 0): ?>
                        <option value="" selected>No product found, please add or publish a product</option>
                    <?php else: ?>
                        <option value="">Select Product</option>
                        <?php
                
                        foreach ($products as $product):
                            if($allowProduct != 0):
                        ?>
                            <option value="<?php echo $product->get_id(); ?>">
                                <?php echo $product->get_name(); ?>
                            </option>
                        <?php else: ?>
                            <option value="<?php echo $product->get_id(); ?>" disabled>
                                <?php echo $product->get_name(); ?> &#128274;
                            </option>
                        <?php
                            endif;
            
                        endforeach;
                        ?>
                    <?php endif; ?>
                </select>

                <hr>
                <p class="h6">Create Content</p>
             
                    <div id="moduleContent">

                        <div class="my-3 appended-content">
                            <div class="card">
                                <div class="card-header" style="cursor: move;">
                                    <h6>Logo <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" value="8.1" name="module_id[]">
                                    <div class="row">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module8logo[]" readonly>
                                            <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-3 appended-content">
                            <div class="card">
                                <div class="card-header" style="cursor: move;">
                                    <h6>Standard Image <span class="text-secondary">(Image size: 1440 px wide, 900 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" value="1.2" name="module_id[]">
                                    <div class="apluscontent-upload-box" onclick="document.getElementById('imageInput2').click()">
                                        <span>Click to upload an image</span>
                                        <input type="file" class="wp-media-file singleImage" id="imageInput2" accept="image/*">
                                        <img id="imagePreview2" src="" style="display: none;">
                                        <input type="hidden" name="module1Image[]" id="imageUrl2">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-3 appended-content">
                            <div class="card">
                                <div class="card-header" style="cursor: move;">
                                    <h6>Three Columns with Images, Heading, and Description <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" value="2.3" name="module_id[]">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card h-100">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image1[]" readonly>
                                                    <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                                </div>
                                                <div class="card-body">
                                                    <input type="text" class="form-control" required name="module2heading1[]" placeholder="Enter Heading">
                                                    <textarea class="form-control mt-2" required name="module2description1[]" placeholder="Enter Description" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card h-100">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image2[]" readonly>
                                                    <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                                </div>
                                                <div class="card-body">
                                                    <input type="text" class="form-control" required name="module2heading2[]" placeholder="Enter Heading">
                                                    <textarea class="form-control mt-2" required name="module2description2[]" placeholder="Enter Description" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="card h-100">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image3[]" readonly>
                                                    <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                                </div>
                                                <div class="card-body">
                                                    <input type="text" class="form-control" required name="module2heading3[]" placeholder="Enter Heading">
                                                    <textarea class="form-control mt-2" required name="module2description3[]" placeholder="Enter Description" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-3 appended-content">
                            <div class="card">
                                <div class="card-header" style="cursor: move;">
                                    <h6>Slider <span class="text-secondary">(Image size: 1320-1650 px wide, 550-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" value="5.4" name="module_id[]">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" placeholder="Upload Image for slider1" required name="module5Image1[]" readonly>
                                        <button class="btn btn-primary wp-media-file-slider" type="submit">Upload Image</button>
                                    </div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" placeholder="Upload Image for slider2" required name="module5Image2[]" readonly>
                                        <button class="btn btn-primary wp-media-file-slider" type="submit">Upload Image</button>
                                    </div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" placeholder="Upload Image for slider3" required name="module5Image3[]" readonly>
                                        <button class="btn btn-primary wp-media-file-slider" type="submit">Upload Image</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-3 appended-content">
                            <div class="card">
                                <div class="card-header" style="cursor: move;">
                                    <h6>Single Left Image <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" value="4.5" name="module_id[]">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Image" required name="module4Image[]" readonly>
                                                <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12">
                                            <div class="contant">
                                                <input type="text" class="form-control" required name="module4heading[]" placeholder="Enter Heading">
                                                <textarea class="form-control mt-2" required name="module4description[]" placeholder="Enter Description" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-3 appended-content">
                            <div class="card">
                                <div class="card-header" style="cursor: move;">
                                    <h6>Standard Image <span class="text-secondary">(Image size: 1440 px wide, 900 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span></h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" value="1.6" name="module_id[]">
                                    <div class="apluscontent-upload-box" onclick="document.getElementById('imageInput7').click()">
                                        <span>Click to upload an image</span>
                                        <input type="file" class="wp-media-file singleImage" id="imageInput7" accept="image/*">
                                        <img id="imagePreview7" src="" style="display: none;">
                                        <input type="hidden" name="module1Image[]" id="imageUrl7">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="my-3 appended-content">
                            <div class="card">
                                <div class="card-header" style="cursor: move;">
                                    <h6>Video with Image <span class="text-secondary">(Image Formats: JPG, JPEG, PNG, WEBP. Video Formats: MP4, AVI, MKV.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" value="6.7" name="module_id[]">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Image" required name="module6Image[]" readonly>
                                                <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" placeholder="Upload Video Thumbnail Image" required name="module6ThumbImage[]" readonly>
                                                <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Video" required name="module6video[]" readonly>
                                                <button class="btn btn-primary wp-media-file3" type="submit">Upload Image</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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

<div class="text-center" id="aplusloader" style="display: none;">
    <img src="<?php echo plugins_url('../img/Spinner-3.gif', __FILE__); ?>" alt="loader" class="img-fluid" width="100px" height="100px">
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


