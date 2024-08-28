

jQuery(document).ready(function($){

    // new DataTable('#aplusProductTable');
    
    var clickCount = 0;

    $(function () {
        // Initialize sortable functionality
        $("#moduleContent").sortable({
            handle: ".card-header", // Only allow dragging by the card-header
            update: function (event, ui) {
                // Update the order of module_id[] values based on new order
                $('#moduleContent .appended-content').each(function (index) {
                    var newOrder = index + 1;
                    $(this).find('input[type="hidden"][name="module_id[]"]').val(function(i, oldVal) {
                        return oldVal.split('.')[0] + '.' + newOrder;
                    });
                });
    
                // Ensure the close button is on the last appended content after dragging
                updateCloseButton();
            }
        }).disableSelection();
    
        // Use event delegation to handle the click event for dynamically added elements
        $('#moduleContent').on('click', '.section-close-btn', function () {
            $(this).closest('.appended-content').remove();
            clickCount--;
            
            // After removing an element, update the close button on the last remaining content
            updateCloseButton();
        });
    
        // Function to update the close button on the last appended content
        function updateCloseButton() {
            // Remove any existing close button from all content
            $('#moduleContent .section-close-btn').remove();
    
            // Add the close button to the last remaining content
            $('#moduleContent .appended-content').last().find('h6').append('<span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span>');
        }
    });
        
    

    $(".module").click(function (e) { 
        e.preventDefault();
        clickCount++;

        // Hide the modal
        $('#customTemplateModal').modal("hide");

        var moduleNumber = $(this).attr('moduleNumber');
        var content = '';

        switch (moduleNumber) {
            case "1":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Standard Image <span class="text-secondary">(Image size: 1440 px wide, 900 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="1.${clickCount}" name="module_id[]">
                                <div class="apluscontent-upload-box" onclick="document.getElementById('imageInput${clickCount}').click()">
                                    <span>Click to upload an image</span>
                                    <input type="file" class="wp-media-file singleImage" id="imageInput${clickCount}" accept="image/*">
                                    <img id="imagePreview${clickCount}" src="" style="display: none;">
                                    <input type="hidden" name="module1Image[]" id="imageUrl${clickCount}">
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
            case "2":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Three Columns with Images, Heading, and Description <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="2.${clickCount}" name="module_id[]">
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
                    </div>`;
                break;
            case "3":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Single Right Image <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="3.${clickCount}" name="module_id[]">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="contant">
                                            <input type="text" class="form-control" required name="module3heading[]" placeholder="Enter Heading">
                                            <textarea class="form-control mt-2" required name="module3description[]" placeholder="Enter Description" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module3Image[]" readonly>
                                            <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
            case "4":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Single Left Image <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="4.${clickCount}" name="module_id[]">
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
                    </div>`;
                    break;
            case "5":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Slider <span class="text-secondary">(Image size: 1320-1650 px wide, 550-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span> <span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="5.${clickCount}" name="module_id[]">
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
                    </div>`;
                    break;
            case "6":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Video with Image <span class="text-secondary">(Image Formats: JPG, JPEG, PNG, WEBP. Video Formats: MP4, AVI, MKV.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="6.${clickCount}" name="module_id[]">
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
                    </div>`;
                    break;
            case "7":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Hero Banner <span class="text-secondary">(Image size: 1320-1650 px wide, 385-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="7.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" placeholder="Upload Image" required name="module7Image[]" readonly>
                                        <button class="btn btn-primary wp-media-file-heroBanner" type="submit">Upload Image</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="text" class="form-control mb-2" placeholder="Enter Heading" required name="module7heading[]">
                                    <textarea class="form-control mb-2" placeholder="Enter Description of Hero Banner" required name="module7description[]" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
            case "8":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Logo <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="8.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" placeholder="Upload Image" required name="module8logo[]" readonly>
                                        <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
        }

        // Append the new content to the moduleContent
        $('#moduleContent').append(content);
    });

    $('#customTemplateFormSubmit').on('submit', function(e) {
        e.preventDefault();
    
        var data = $(this).serialize();
        $("#customTemplateFormSubmit").hide();
        $("#aplusloader").show();
    
        $.post(myAjax.ajaxurl, data + '&action=customTemplateFormSubmit_action', function(response) {
            if(response.success == true){
                let message = JSON.parse(response.data.body);
                alert(message.message);
                location.href = 'admin.php?page=a-plus-content';
            }else{
                $("#customTemplateFormSubmit").show();
                $("#aplusloader").hide();
                alert("Something went wrong");
            }
            
        }).fail(function(xhr, status, error) {
            console.error('Error:', error); // Log any errors to the console
        });
    });

    $('#customTemplateFormSubmitBtn1, #customTemplateFormSubmitBtn2').on('click', function() {
        var status = $(this).data('status');
        $('#customTemplateFormStatus').val(status);
    });

    $(".aplus-status-button").click(function (e) { 

        e.preventDefault();
        var content_id = $(this).attr("content-id");
        var product_id = $(this).attr("product-id");
        var status = $(this).attr("status");

        $.post(myAjax.ajaxurl, 'content_id=' + content_id + '&product_id=' + product_id + '&status=' + status + '&action=aplus_status_action', function(response) {
            if(response.success == true){
                let message = JSON.parse(response.data.body);
                alert(message.message);
                location.reload();
            }else{
                alert(response.data);
            }
            
        }).fail(function(xhr, status, error) {
            console.error('Error:', error); // Log any errors to the console
        });
    });

    $(".aplus-delete-button").click(function (e) { 

        e.preventDefault();
        var content_id = $(this).attr("content-id");
        var product_id = $(this).attr("product-id");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(myAjax.ajaxurl, 'content_id=' + content_id + '&product_id=' + product_id + '&action=aplus_delete_action', function(response) {
                    if(response.success == true){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your A+ Content has been deleted.",
                            icon: "success"
                          });
                        location.reload();
                    }else{
                        Swal.fire({
                            title: "Warning!",
                            text: "Something went wrong",
                            icon: "danger"
                        });
                    }
                    
                }).fail(function(xhr, status, error) {
                    console.error('Error:', error); // Log any errors to the console
                });
            }
        });
    });

    $(".editor-page-module").click(function (e) { 
        e.preventDefault();
        clickCount = $('#moduleContent .appended-content').length + 1;

        // Hide the modal
        $('#customTemplateModal').modal("hide");

        var moduleNumber = $(this).attr('moduleNumber');
        var content = '';

        switch (moduleNumber) {
            case "1":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Standard Image <span class="text-secondary">(Image size: 1440 px wide, 900 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="1.${clickCount}" name="module_id[]">
                                <div class="apluscontent-upload-box" onclick="document.getElementById('imageInput${clickCount}').click()">
                                    <span>Click to upload an image</span>
                                    <input type="file" class="wp-media-file singleImage" id="imageInput${clickCount}" accept="image/*">
                                    <img id="imagePreview${clickCount}" src="" style="display: none;">
                                    <input type="hidden" name="module1Image[]" id="imageUrl${clickCount}">
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
            case "2":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Three Columns with Images, Heading, and Description <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="2.${clickCount}" name="module_id[]">
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
                    </div>`;
                break;
            case "3":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Single Right Image <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="3.${clickCount}" name="module_id[]">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="contant">
                                            <input type="text" class="form-control" required name="module3heading[]" placeholder="Enter Heading">
                                            <textarea class="form-control mt-2" required name="module3description[]" placeholder="Enter Description" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module3Image[]" readonly>
                                            <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
            case "4":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Single Left Image <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="4.${clickCount}" name="module_id[]">
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
                    </div>`;
                    break;
            case "5":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Slider <span class="text-secondary">(Image size: 1320-1650 px wide, 550-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="5.${clickCount}" name="module_id[]">
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
                    </div>`;
                    break;
            case "6":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Video with Image <span class="text-secondary">(Image Formats: JPG, JPEG, PNG, WEBP. Video Formats: MP4, AVI, MKV.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="6.${clickCount}" name="module_id[]">
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
                    </div>`;
                    break;
            case "7":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Hero Banner <span class="text-secondary">(Image size: 1320-1650 px wide, 385-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="7.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" placeholder="Upload Image" required name="module7Image[]" readonly>
                                        <button class="btn btn-primary wp-media-file-heroBanner" type="submit">Upload Image</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <input type="text" class="form-control mb-2" placeholder="Enter Heading" required name="module7heading[]">
                                    <textarea class="form-control mb-2" placeholder="Enter Description of Hero Banner" required name="module7description[]" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
            case "8":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header" style="cursor: move;">
                                <h6>Logo <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="8.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="input-group my-3">
                                        <input type="text" class="form-control" placeholder="Upload Image" required name="module8logo[]" readonly>
                                        <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
        }

        // Append the new content to the moduleContent
        $('#moduleContent').append(content);
    });

    $('#updateContentFormSubmit').on('submit', function(e) {
        e.preventDefault();
    
        var data = $(this).serialize();
        $("#updateContentFormSubmit").hide();
        $("#aplusloader").show();
    
        $.post(myAjax.ajaxurl, data + '&action=updateContentFormSubmit_action', function(response) {
            if(response.success == true){
                let message = JSON.parse(response.data.body);
                alert(message.message);
                location.href = 'admin.php?page=a-plus-content';
            }else{
                $("#updateContentFormSubmit").show();
                $("#aplusloader").hide();
                alert("Something went wrong");
            }
            
        }).fail(function(xhr, status, error) {
            console.error('Error:', error); // Log any errors to the console
        });
    });

    $('#paymentFormSubmit').on('submit', function(e) {
        e.preventDefault();
        
        var data = $(this).serialize();

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to proceed payment?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Proceed!"
            }).then((result) => {
            if (result.isConfirmed) {
                $("#planContainer").hide();
                $("#aplusloader").show();

                $.post(myAjax.ajaxurl, data + '&action=paymentFormSubmit_action', function(response) {
                    $("#aplusloader").hide();
                    if(response.success && response.data.res == "success") {
                        var orderID = response.data.order_number;
                        var options = {
                            "key": response.data.razorpay_key, // Enter the Key ID generated from the Dashboard
                            "amount": response.data.userData.amount, // Amount is in currency subunits
                            "currency": "INR",
                            "name": "A+ Content Plugin", // Your business name
                            "description": response.data.userData.description,
                            "image": "https://www.tech2globe.com/images/new-page-images/tech2globe-logo.png",
                            "order_id": response.data.userData.rpay_order_id, // Pass the Razorpay order ID
                            "handler": function (paymentResponse){
                                $.post(myAjax.ajaxurl, "payment_status=success&oid=" + orderID + "&rp_payment_id=" + paymentResponse.razorpay_payment_id + "&rp_signature=" + paymentResponse.razorpay_signature + "&action=paymentStatus_action",function(response){
                                    if(response.success == true){
                                        window.location.replace("admin.php?page=upgrade-a-plus-content&payment-status=success&oid=" + orderID + "&rp_payment_id=" + paymentResponse.razorpay_payment_id);
                                    }else{
                                        alert("Something went wrong after successful payment");
                                    }
                                }).fail(function(xhr, status, error) {
                                    console.error('Error:', error); // Log any errors to the console
                                });
                            },
                            "modal": {
                                "ondismiss": function(){
                                    $.post(myAjax.ajaxurl, "payment_status=cancelled&oid=" + orderID  + "&action=paymentStatus_action",function(response){
                                        if(response.success == true){
                                            window.location.replace("admin.php?page=upgrade-a-plus-content&payment-status=cancelled&oid=" + orderID);
                                        }else{
                                            alert("Something went wrong after Cancelled payment");
                                        }
                                    }).fail(function(xhr, status, error) {
                                        console.error('Error:', error); // Log any errors to the console
                                    });
                                }
                            },
                            "prefill": {
                                "name": response.data.userData.name,
                                "email": response.data.userData.email,
                                "contact": '' // Provide the customer's phone number for better conversion rates
                            },
                            "notes": {
                                "address": "A+ Content"
                            },
                            "theme": {
                                "color": "#3399cc"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.on('payment.failed', function (paymentErrorResponse){
                            $.post(myAjax.ajaxurl, "payment_status=failed&oid=" + orderID + "&reason=" + paymentErrorResponse.error.description + "&paymentid=" + paymentErrorResponse.error.metadata.payment_id + "&action=paymentStatus_action",function(response){
                                if(response.success == true){
                                    window.location.replace("admin.php?page=upgrade-a-plus-content&payment-status=failed&oid=" + orderID + "&reason=" + paymentErrorResponse.error.description + "&paymentid=" + paymentErrorResponse.error.metadata.payment_id);
                                }else{
                                    alert("Something went wrong after failed payment");
                                }
                            }).fail(function(xhr, status, error) {
                                console.error('Error:', error); // Log any errors to the console
                            });
                        });
                        rzp1.open();
                        e.preventDefault();
                        
                    } else {
                        alert("Something went wrong");
                    }
                    
                }).fail(function(xhr, status, error) {
                    console.error('Error:', error); 
                    alert("Something went wrong");
                });
            }
        });
         
    });

});

// Craete A+ Content Modal On Click select the option 
document.addEventListener('DOMContentLoaded', function() {
    const options = document.querySelectorAll('.template-option');
    options.forEach(option => {
        option.addEventListener('click', function() {
            options.forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Set default selection
    if (options.length > 0) {
        options[0].classList.add('selected');
    }
});

jQuery(document).ready(function($) {
    // Handle the click event on the file input using event delegation
    $(document).on('click', 'input[type="file"].wp-media-file.singleImage', function(e) {
        e.preventDefault();

        var $inputField = $(this);
        var clickCount = $inputField.attr('id').replace('imageInput', ''); // Extract clickCount from input ID

        // Create a new media frame for each input click
        var file_frame = wp.media({
            title: 'Select or Upload Media',
            button: {
                text: 'Use this media',
            },
            multiple: false
        });

        // When an image is selected, handle the response
        file_frame.on('select', function() {
            var attachment = file_frame.state().get('selection').first().toJSON();
            previewImageFromURL(attachment.url, clickCount, $inputField);
        });

        // Open the media library
        file_frame.open();
    });

    // Function to preview image from URL
    function previewImageFromURL(url, clickCount, $inputField) {
        const img = new Image();
        img.src = url;

        img.onload = function() {
            const width = img.width;
            const height = img.height;

            if (width === 1440 && height === 900) {
                const $preview = $('#imagePreview' + clickCount);
                $preview.attr('src', url).show();

                // Hide the span within the closest .apluscontent-upload-box
                $inputField.closest('.apluscontent-upload-box').find('span').hide();

                // Set the URL in the hidden input field
                $('#imageUrl' + clickCount).val(url);
            } else {
                alert('Invalid dimensions. Only images with dimensions 1440x900 are allowed.');
            }
        };
    }

    // Function to preview image from file input
    window.previewImage = function(event, clickCount, element) {
        const file = event.target.files[0];
        const validExtensions = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

        if (file) {
            if (!validExtensions.includes(file.type)) {
                alert('Invalid file type. Only JPG, JPEG, PNG, and WEBP images are allowed.');
                event.target.value = ''; // Clear the file input
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function() {
                    const width = img.width;
                    const height = img.height;

                    if (width === 1440 && height === 900) {
                        const $preview = $('#imagePreview' + clickCount);
                        $preview.attr('src', e.target.result).show();

                        const $imageUrl = $('#imageUrl' + clickCount);
                        $imageUrl.val(e.target.result);

                        // Hide the span within the closest .apluscontent-upload-box
                        $(element).closest('.apluscontent-upload-box').find('span').hide();
                    } else {
                        alert('Invalid dimensions. Only images with dimensions 1440x900 are allowed.');
                        event.target.value = ''; // Clear the file input
                    }
                };
            };
            reader.readAsDataURL(file);
        }
    };

    //Code to open the wordpress  media uploader
    $(document).on('click', '.wp-media-file2', function(e) {
        e.preventDefault();
    
        var inputField = $(this).closest('.input-group').find('input[type="text"]'); // Find the associated input field
    
        var frame = wp.media({
            title: 'Select a file',
            button: {
                text: 'Select'
            },
            multiple: false
        });
    
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            var allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];
            var fileExtension = attachment.url.split('.').pop().toLowerCase();
    
            if (allowedTypes.includes(fileExtension)) {
                inputField.val(attachment.url); // Set the input value with the image URL
            } else {
                alert('Only JPG, JPEG, PNG, and WEBP files are allowed.');
            }
        });
    
        frame.open();
    });    

    $(document).on('click', '.wp-media-file3', function(e) {
        e.preventDefault();
    
        var inputField = $(this).closest('.input-group').find('input[type="text"]'); // Find the associated input field
    
        var frame = wp.media({
            title: 'Select a file',
            button: {
                text: 'Select'
            },
            multiple: false
        });
    
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            var allowedTypes = ['mp4', 'avi', 'mkv'];
            var fileExtension = attachment.url.split('.').pop().toLowerCase();
    
            if (allowedTypes.includes(fileExtension)) {
                inputField.val(attachment.url); // Set the input value with the image URL
            } else {
                alert('Only MP4, AVI, and MKV files are allowed.');
            }
        });
    
        frame.open();
    });

    //Code to open the wordpress  media uploader
    $(document).on('click', '.wp-media-file-slider', function(e) {
        e.preventDefault();
    
        var inputField = $(this).closest('.input-group').find('input[type="text"]'); // Find the associated input field
    
        var frame = wp.media({
            title: 'Select a file',
            button: {
                text: 'Select'
            },
            multiple: false
        });
    
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            var allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];
            var fileExtension = attachment.url.split('.').pop().toLowerCase();
    
            if (allowedTypes.includes(fileExtension)) {
                var img = new Image();
                img.src = attachment.url;
    
                img.onload = function() {
                    if (img.width >= 1320 && img.width <= 1650 && img.height >= 550 && img.height <= 700) {
                        inputField.val(attachment.url); // Set the input value with the image URL
                    } else {
                        alert('The image should have width between: 1320-1650 px and height between: 550-700 px.');
                    }
                };
            } else {
                alert('Only JPG, JPEG, PNG, and WEBP files are allowed.');
            }
        });
    
        frame.open();
    });

    $(document).on('click', '.wp-media-file-heroBanner', function(e) {
        e.preventDefault();
    
        var inputField = $(this).closest('.input-group').find('input[type="text"]'); // Find the associated input field
    
        var frame = wp.media({
            title: 'Select a file',
            button: {
                text: 'Select'
            },
            multiple: false
        });
    
        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            var allowedTypes = ['jpg', 'jpeg', 'png', 'webp'];
            var fileExtension = attachment.url.split('.').pop().toLowerCase();
    
            if (allowedTypes.includes(fileExtension)) {
                var img = new Image();
                img.src = attachment.url;
    
                img.onload = function() {
                    if (img.width >= 1320 && img.width <= 1650 && img.height >= 385 && img.height <= 700) {
                        inputField.val(attachment.url); // Set the input value with the image URL
                    } else {
                        alert('The image should have width between: 1320-1650 px and height between: 385-700 px.');
                    }
                };
            } else {
                alert('Only JPG, JPEG, PNG, and WEBP files are allowed.');
            }
        });
    
        frame.open();
    });
    
    
});

