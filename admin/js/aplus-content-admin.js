

jQuery(document).ready(function($){
    var clickCount = 0;
    $(".module").click(function (e) { 
        e.preventDefault();
        clickCount++;
    
        $('#myModal').modal('hide');
        var moduleNumber = $(this).attr('moduleNumber');
        var content = '';
    
        switch (moduleNumber) {
            case "1":
                content = '<div class="my-3"><div class="card"><div class="card-header"><h6>Standard Image</h6></div><div class="card-body"><input type="hidden" value="1.'+ clickCount +'" name="module_id[]"><div class="apluscontent-upload-box" onclick="document.getElementById(\'imageInput'+ clickCount +'\').click()"><span>Click to upload an image</span><input type="file" id="imageInput'+ clickCount +'" name="module1Image[]" accept="image/*" onchange="previewImage(event, '+ clickCount +')"><img id="imagePreview'+ clickCount +'" src=""></div></div></div></div>';
                break;
            case "2":
                content = '<div class="my-3"><div class="card"><div class="card-header"><h6>Standard Image Header With Text</h6></div><div class="card-body"><input type="hidden" value="2.'+ clickCount +'" name="module_id[]"><input type="file" name="module2Image[]" class="form-control" multiple /><input type="text" name="heading[]" class="form-control my-2" placeholder="Enter Heading"><input type="text" name="paragraph[]" class="form-control my-2" placeholder="Enter Text"></div></div></div>';
                break;
        }
    
        $('#moduleContent').append(content);
    });
    

    

    $('#file-5').change(function(event) {

        var file = event.target.files[0];

        var reader = new FileReader();



        reader.onload = function(e) {

            var image = $('<img>').attr('src', e.target.result);



            $(image).on('load', function() {

                $('#imageContainer').empty().append(image);

                $('#imageContainer').show();

                $('#file-5').hide();

            });

        };



        reader.readAsDataURL(file);

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