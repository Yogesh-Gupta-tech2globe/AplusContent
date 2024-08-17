

jQuery(document).ready(function($){

    // new DataTable('#aplusProductTable');
    
    var clickCount = 0;

    $(".module").click(function (e) { 
        e.preventDefault();
        clickCount++;
    
        // $('#customTemplateModal').fadeOut("slow");
        $('#customTemplateModal').modal("hide");
    
        var moduleNumber = $(this).attr('moduleNumber');
        var content = '';
    
        switch (moduleNumber) {
            case "1":
                content = `
                    <div class="my-3">
                        <div class="card">
                            <div class="card-header"><h6>Standard Image</h6></div>
                            <div class="card-body">
                                <input type="hidden" value="1.${clickCount}" name="module_id[]">
                                <div class="apluscontent-upload-box" onclick="document.getElementById('imageInput${clickCount}').click()">
                                    <span>Click to upload an image</span>
                                    <input type="file" class="wp-media-file" id="imageInput${clickCount}" accept="image/*">
                                    <img id="imagePreview${clickCount}" src="" style="display: none;">
                                    <input type="hidden" name="module1Image[]" id="imageUrl${clickCount}">
                                </div>
                            </div>
                        </div>
                    </div>`;
                break;
        }
    
        $('#moduleContent').append(content);
    });

    $('#customTemplateFormSubmit').on('submit', function(e) {
        e.preventDefault();
    
        var data = $(this).serialize();
    
        $.post(myAjax.ajaxurl, data + '&action=customTemplateFormSubmit_action', function(response) {
            if(response.success == true){
                let message = JSON.parse(response.data.body);
                console.log(message.message);
                alert(message.message);
                location.href = 'admin.php?page=a-plus-content';
            }else{
                alert("Something went wrong");
            }
            
        }).fail(function(xhr, status, error) {
            console.error('Error:', error); // Log any errors to the console
        });
    });

    $(".status-button").click(function (e) { 

        e.preventDefault();

        

        var content_id = $(this).attr("content-id");

        var status = $(this).attr("status");

        

        $.ajax({

            type: "post",

            url: ajaxurl,

            data: {

                action: 'my_ajax_status_action',

                content_id: content_id,

                status: status,

            },

            success: function (response) {

                if(response = true){

                    alert("Status Updated Successfully");

                    location.reload();

                }else{

                    alert("Something went wrong");

                } 

            },

            error: function(xhr, status, error) {

                // Handle errors

                console.log(xhr.responseText);

            }

        });

    });



    $(".delete-button").click(function (e) { 

        e.preventDefault();



        var content_id = $(this).attr("content-id");



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



                $.ajax({

                    type: "post",

                    url: ajaxurl,

                    data: {

                        action: 'my_ajax_delete_action',

                        content_id: content_id,

                    },

                    success: function (response) {

                        if(response = true){

                            Swal.fire({

                                title: "Deleted!",

                                text: "Your file has been deleted.",

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

                    },

                    error: function(xhr, status, error) {

                        // Handle errors

                        console.log(xhr.responseText);

                    }

                });

            }

        });

    });



    var selectInteracted = false;



    // Event listener for when the select element changes

    $('#product-selection').change(function() {

        selectInteracted = true;

    });



    // Event listener for beforeunload event

    $(window).on('beforeunload', function() {

        if (selectInteracted) {

            alert('You have unsaved changes. Are you sure you want to leave?');

        }

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
    $(document).on('click', 'input[type="file"].wp-media-file', function(e) {
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
});




