

jQuery(document).ready(function($){
    
    var clickCount = 0;

    $(function () {
        // Initialize sortable functionality
        $("#moduleContent").sortable({
            handle: ".moveCardButton", // Only allow dragging by the card-header
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Standard Image <span class="text-secondary">(Image size: 1440 px wide, 900 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Three Columns with Images, Heading, and Description <br> <span class="text-secondary">(Image size: 365 px wide, 240 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 160 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="2.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card h-100">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image1[]" readonly>
                                                <button class="btn btn-primary wp-media-file-three" type="submit">Upload Image</button>
                                            </div>
                                            <div class="card-body">
                                                <input type="text" class="form-control" required name="module2heading1[]" placeholder="Enter Heading" maxlength="60">
                                                <textarea class="form-control mt-2" required name="module2description1[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card h-100">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image2[]" readonly>
                                                <button class="btn btn-primary wp-media-file-three" type="submit">Upload Image</button>
                                            </div>
                                            <div class="card-body">
                                                <input type="text" class="form-control" required name="module2heading2[]" placeholder="Enter Heading" maxlength="60">
                                                <textarea class="form-control mt-2" required name="module2description2[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card h-100">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image3[]" readonly>
                                                <button class="btn btn-primary wp-media-file-three" type="submit">Upload Image</button>
                                            </div>
                                            <div class="card-body">
                                                <input type="text" class="form-control" required name="module2heading3[]" placeholder="Enter Heading" maxlength="60">
                                                <textarea class="form-control mt-2" required name="module2description3[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Single Right Image <br> <span class="text-secondary">(Image size: 560 px wide, 420 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 460 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="3.${clickCount}" name="module_id[]">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="contant">
                                            <input type="text" class="form-control" required name="module3heading[]" placeholder="Enter Heading" maxlength="60">
                                            <textarea class="form-control mt-2" required name="module3description[]" placeholder="Enter Description" rows="5" maxlength="460"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module3Image[]" readonly>
                                            <button class="btn btn-primary wp-media-file-single" type="submit">Upload Image</button>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Single Left Image <br> <span class="text-secondary">(Image size: 560 px wide, 420 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 460 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="4.${clickCount}" name="module_id[]">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module4Image[]" readonly>
                                            <button class="btn btn-primary wp-media-file-single" type="submit">Upload Image</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="contant">
                                            <input type="text" class="form-control" required name="module4heading[]" placeholder="Enter Heading" maxlength="60">
                                            <textarea class="form-control mt-2" required name="module4description[]" placeholder="Enter Description" rows="5" maxlength="460"></textarea>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Slider <span class="text-secondary">(Image size: 1320-1650 px wide, 550-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span> <span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Video with Image <span class="text-secondary">(Image size: 555 px wide, 370 px tall. Image Formats: JPG, JPEG, PNG, WEBP. Video Formats: MP4, AVI, MKV.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="6.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module6Image[]" readonly>
                                            <button class="btn btn-primary wp-media-file-videoImage" type="submit">Upload Image</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" placeholder="Upload Thumbnail Image" required name="module6ThumbImage[]" readonly>
                                            <button class="btn btn-primary wp-media-file-videoImage" type="submit">Upload Thumbnail</button>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Video" required name="module6video[]" readonly>
                                            <button class="btn btn-primary wp-media-file3" type="submit">Upload Video</button>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Hero Banner <span class="text-secondary">(Image size: 1320-1650 px wide, 385-700 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 460 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
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
                                    <input type="text" class="form-control mb-2" placeholder="Enter Heading" required name="module7heading[]" maxlength="60">
                                    <textarea class="form-control mb-2" placeholder="Enter Description of Hero Banner" required name="module7description[]" rows="5" maxlength="460"></textarea>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Logo <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
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
            case "9":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Two Standard Cards <span class="text-secondary">(Image size: 550 px wide, 300 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 160 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="9.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module9Image1[]" readonly>
                                            <button class="btn btn-primary wp-media-file-twoCards" type="submit">Upload Image</button>
                                        </div>
                                        <input type="text" class="form-control" required name="module9heading1[]" placeholder="Enter Heading" maxlength="60">
                                        <textarea class="form-control mt-2" required name="module9description1[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module9Image2[]" readonly>
                                            <button class="btn btn-primary wp-media-file-twoCards" type="submit">Upload Image</button>
                                        </div>
                                        <input type="text" class="form-control" required name="module9heading2[]" placeholder="Enter Heading" maxlength="60">
                                        <textarea class="form-control mt-2" required name="module9description2[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
            case "10":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();
                var totalProducts = $(this).attr('totalProducts');
                totalProducts = JSON.parse(totalProducts);

                colNum = 4;
                rowNum = 5;

                // Create the new content with a close button inside the <h6> tag
                content += `
                <div class="my-3 appended-content">
                    <div class="card">
                        <div class="card-header">
                            <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Compare with similar items |
                            <label for="colSelect">Products:</label>
                            <select id="colSelect" class="form-control select-columns d-inline" style="width: 5%;">
                                <option value="2" ${colNum === 2 ? 'selected' : ''}>2</option>
                                <option value="3" ${colNum === 3 ? 'selected' : ''}>3</option>
                                <option value="4" ${colNum === 4 ? 'selected' : ''}>4</option>
                            </select>
                
                            <label for="rowSelect">Attributes:</label>
                            <select id="rowSelect" class="form-control select-rows d-inline" style="width: 5%;">
                                <option value="0" ${rowNum === 0 ? 'selected' : ''}>0</option>
                                <option value="1" ${rowNum === 1 ? 'selected' : ''}>1</option>
                                <option value="2" ${rowNum === 2 ? 'selected' : ''}>2</option>
                                <option value="3" ${rowNum === 3 ? 'selected' : ''}>3</option>
                                <option value="4" ${rowNum === 4 ? 'selected' : ''}>4</option>
                                <option value="5" ${rowNum === 5 ? 'selected' : ''}>5</option>
                            </select>
                            <span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="10.${clickCount}" name="module_id[]">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    Select Product
                                                </td>`;

                                                for (let i = 0; i < colNum; i++) {
                                                    content += `
                                                        <td>
                                                            <select class="form-control product-select" data-index="${i}" required name="module10product${i+1}id[]">
                                                                <option value="">Choose Product</option>`;

                                                            totalProducts.forEach(product => {
                                                                content += `<option value="${product.id}">${product.name}</option>`;
                                                            });

                                                    content += `</select>
                                                            
                                                        </td>`;
                                                }

                                    content += `</tr>
                                                <tr>
                                                    <td>
                                                        Image
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <img src="" class="product-image${i+1} img-fluid" alt="Product Image" style="display: none; width: 100%; height :150px;">
                                                                <input type="hidden" name="module10product${i+1}image[]" class="form-control product-image" required value="">
                                                            </td>`;
                                                    }

                                    content += `</tr>
                                                <tr>
                                                    <td>
                                                        Name
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <input type="text" name="module10product${i+1}name[]" class="form-control product-name" required value="" readonly> 
                                                            </td>`;
                                                    }

                                    content += `</tr>
                                                <tr>
                                                    <td>
                                                        Price
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <input type="number" name="module10product${i+1}price[]" class="form-control product-price" required value="" readonly> 
                                                            </td>`;
                                                    }

                                    content += `</tr>
                                                <tr>
                                                    <td>
                                                        Review
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <input type="number" name="module10product${i+1}review[]" class="form-control product-review" required value="" maxlength="1" readonly> 
                                                            </td>`;
                                                    }

                                    content += `</tr>`;
                                                
                                                for(let j=0; j < rowNum; j++){
                                                content += `<tr>
                                                    <td>
                                                        <input type="text" name="module10heading${j+1}[]" class="form-control" required placeholder="Enter Heading" maxlength="20">
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <input type="text" name="module10product${i+1}content${j+1}[]" class="form-control" required value=""> 
                                                            </td>`;
                                                    }

                                    content += `</tr>`;
                                                }
                            content += `</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;


                    break;
        }
                                    
        // Append the new content to the moduleContent
        $('#moduleContent').append(content);

        // Handle column and row changes dynamically
        $('.select-columns, .select-rows').on('change', function() {
            var newColNum = parseInt($('#colSelect').val()); // Get new column count
            var newRowNum = parseInt($('#rowSelect').val()); // Get new row count

            var table = $('#moduleContent .appended-content table');

            // Update rows
            var currentRows = table.find('tr').length - 5; // Subtract 1 for the first heading row
            if (newRowNum > currentRows) {
                // Add new rows if needed
                for (let r = currentRows; r < newRowNum; r++) {
                    let rowContent = `<tr>
                                        <td><input type="text" name="module10heading${r + 1}[]" class="form-control" required placeholder="Enter Heading" maxlength="20"></td>`;
                    for (let c = 0; c < newColNum; c++) {
                        rowContent += `<td>
                                            <input type="text" name="module10product${c + 1}content${r + 1}[]" class="form-control" required value="">
                                    </td>`;
                    }
                    rowContent += `</tr>`;
                    table.append(rowContent);
                }
            } else if (newRowNum < currentRows) {
                // Remove extra rows
                for (let r = currentRows; r > newRowNum; r--) {
                    table.find('tr:last').remove();
                }
            }

            // Update columns
            table.find('tr').each(function(rowIndex) {
                var currentCols = $(this).find('td').length - 1; // Subtract 1 for the first <td> in each row
                if (newColNum > currentCols) {
                    // Add new columns if needed
                    for (let i = currentCols; i < newColNum; i++) {
                        if (rowIndex === 0) {
                            // First row for select product
                            $(this).append(`<td>
                                <select class="form-control product-select" data-index="${i}" required name="module10product${i + 1}id[]">
                                    <option value="">Choose Product</option>
                                    ${totalProducts.map(product => `<option value="${product.id}">${product.name}</option>`).join('')}
                                </select>
                            </td>`);
                        }else if (rowIndex === 1) {
                            // Second row for image
                            $(this).append(`<td>
                                <img src="" class="product-image${i+1} img-fluid" alt="Product Image" style="display: none; width: 100%; height :150px;">
                                <input type="hidden" name="module10product${i+1}image[]" class="form-control product-image" required value="">
                            </td>`);
                        }else if (rowIndex === 2) {
                            // Third row for name
                            $(this).append(`<td>
                                <input type="text" name="module10product${i+1}name[]" class="form-control product-name" required value="" readonly> 
                            </td>`);
                        }else if (rowIndex === 3) {
                            // Fourth row for price
                            $(this).append(`<td>
                                <input type="number" name="module10product${i+1}price[]" class="form-control product-price" required value="" readonly> 
                            </td>`);
                        }else if (rowIndex === 4) {
                            // First row for review
                            $(this).append(` <td>
                                <input type="number" name="module10product${i+1}review[]" class="form-control product-review" required value="" maxlength="1" readonly> 
                            </td>`);
                        } else {
                            // Other rows for image, name, price, review, and additional content
                            $(this).append(`<td>
                                <input type="text" name="module10product${i + 1}content${rowIndex - 4}[]" class="form-control" required value="">
                            </td>`);
                        }
                    }
                } else if (newColNum < currentCols) {
                    // Remove extra columns
                    for (let i = currentCols; i > newColNum; i--) {
                        $(this).find('td:last').remove();
                    }
                }
            });
        });


        // Add event listener for dynamically added select elements
        $(document).on('change', '.product-select', function() {
            var selectedProductId = $(this).val();
            var index = $(this).data('index'); // Get the index of the current select
        
            // Dynamically find the corresponding elements using the index
            var productImage = $(`.product-image${index+1}`);
            var productImageInput = $(`input[name="module10product${index+1}image[]"]`);
            var productNameInput = $(`input[name="module10product${index+1}name[]"]`);
            var productPriceInput = $(`input[name="module10product${index+1}price[]"]`);
            var productReviewInput = $(`input[name="module10product${index+1}review[]"]`);
        
            if (selectedProductId) {
                var selectedProduct = totalProducts.find(product => product.id == selectedProductId);
        
                if (selectedProduct) {
                    var uploadIndex = selectedProduct.image.indexOf('/uploads/');
                    var relativePath = selectedProduct.image.substring(uploadIndex + 8);

                    // Populate product details in the corresponding fields
                    productImage.attr('src', selectedProduct.image).show(); // Show image
                    productImageInput.val(relativePath); // Set hidden input for image URL
                    productNameInput.val(selectedProduct.name); // Set product name
                    productPriceInput.val(selectedProduct.price); // Set product price
                    productReviewInput.val(`${selectedProduct.reviews.rating}`); // Set product review
                }
            } else {
                // Clear fields if no product is selected
                productImage.hide().attr('src', ''); // Hide and clear image
                productImageInput.val(''); // Clear hidden image input
                productNameInput.val(''); // Clear product name
                productPriceInput.val(''); // Clear product price
                productReviewInput.val(''); // Clear product review
            }
        }); 

    });

    $('#customTemplateFormSubmit').on('submit', function(e) {
        let isValid = true;
    
        // Check each input field
        $(this).find('input[type="text"], input[type="hidden"]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                return false;
            }
        });
    
        if (!isValid) {
            alert('Please fill out all fields.');
            e.preventDefault(); // Prevent form submission
        } else {
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
                    alert("Make Sure that you selected a Product and create at least one module with all filled data.");
                }
                
            }).fail(function(xhr, status, error) {
                console.error('Error:', error); // Log any errors to the console
            });
        }
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Standard Image <span class="text-secondary">(Image size: 1440 px wide, 900 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Three Columns with Images, Heading, and Description <br> <span class="text-secondary">(Image size: 365 px wide, 240 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 160 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="2.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card h-100">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image1[]" readonly>
                                                <button class="btn btn-primary wp-media-file-three" type="submit">Upload Image</button>
                                            </div>
                                            <div class="card-body">
                                                <input type="text" class="form-control" required name="module2heading1[]" placeholder="Enter Heading" maxlength="60">
                                                <textarea class="form-control mt-2" required name="module2description1[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card h-100">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image2[]" readonly>
                                                <button class="btn btn-primary wp-media-file-three" type="submit">Upload Image</button>
                                            </div>
                                            <div class="card-body">
                                                <input type="text" class="form-control" required name="module2heading2[]" placeholder="Enter Heading" maxlength="60">
                                                <textarea class="form-control mt-2" required name="module2description2[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="card h-100">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image3[]" readonly>
                                                <button class="btn btn-primary wp-media-file-three" type="submit">Upload Image</button>
                                            </div>
                                            <div class="card-body">
                                                <input type="text" class="form-control" required name="module2heading3[]" placeholder="Enter Heading" maxlength="60">
                                                <textarea class="form-control mt-2" required name="module2description3[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Single Right Image <br> <span class="text-secondary">(Image size: 560 px wide, 420 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 460 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="3.${clickCount}" name="module_id[]">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="contant">
                                            <input type="text" class="form-control" required name="module3heading[]" placeholder="Enter Heading" maxlength="60">
                                            <textarea class="form-control mt-2" required name="module3description[]" placeholder="Enter Description" rows="5" maxlength="460"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module3Image[]" readonly>
                                            <button class="btn btn-primary wp-media-file-single" type="submit">Upload Image</button>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Single Left Image <br> <span class="text-secondary">(Image size: 560 px wide, 420 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 460 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="4.${clickCount}" name="module_id[]">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module4Image[]" readonly>
                                            <button class="btn btn-primary wp-media-file-single" type="submit">Upload Image</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="contant">
                                            <input type="text" class="form-control" required name="module4heading[]" placeholder="Enter Heading" maxlength="60">
                                            <textarea class="form-control mt-2" required name="module4description[]" placeholder="Enter Description" rows="5" maxlength="460"></textarea>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Slider <span class="text-secondary">(Image size: 1320-1650 px wide, 550-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Video with Image <span class="text-secondary">(Image size: 555 px wide, 370 px tall. Image Formats: JPG, JPEG, PNG, WEBP. Video Formats: MP4, AVI, MKV.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="6.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module6Image[]" readonly>
                                            <button class="btn btn-primary wp-media-file-videoImage" type="submit">Upload Image</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" placeholder="Upload Thumbnail Image" required name="module6ThumbImage[]" readonly>
                                            <button class="btn btn-primary wp-media-file-videoImage" type="submit">Upload Thumbnail</button>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Upload Video" required name="module6video[]" readonly>
                                            <button class="btn btn-primary wp-media-file3" type="submit">Upload Video</button>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Hero Banner <span class="text-secondary">(Image size: 1320-1650 px wide, 385-700 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 460 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
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
                                    <input type="text" class="form-control mb-2" placeholder="Enter Heading" required name="module7heading[]" maxlength="60">
                                    <textarea class="form-control mb-2" placeholder="Enter Description of Hero Banner" required name="module7description[]" rows="5" maxlength="460"></textarea>
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
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Logo <span class="text-secondary">(Formats: JPG, JPEG, PNG, WEBP.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
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
            case "9":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();

                // Create the new content with a close button inside the <h6> tag
                content = `
                    <div class="my-3 appended-content">
                        <div class="card">
                            <div class="card-header">
                                <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Two Standard Cards <span class="text-secondary">(Image size: 550 px wide, 300 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 160 Char.)</span><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="9.${clickCount}" name="module_id[]">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module9Image1[]" readonly>
                                            <button class="btn btn-primary wp-media-file-twoCards" type="submit">Upload Image</button>
                                        </div>
                                        <input type="text" class="form-control" required name="module9heading1[]" placeholder="Enter Heading" maxlength="60">
                                        <textarea class="form-control mt-2" required name="module9description1[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" placeholder="Upload Image" required name="module9Image2[]" readonly>
                                            <button class="btn btn-primary wp-media-file-twoCards" type="submit">Upload Image</button>
                                        </div>
                                        <input type="text" class="form-control" required name="module9heading2[]" placeholder="Enter Heading" maxlength="60">
                                        <textarea class="form-control mt-2" required name="module9description2[]" placeholder="Enter Description" rows="5" maxlength="160"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                    break;
            case "10":
                // Remove the close button from the previous appended content's <h6> tag
                $('#moduleContent .appended-content .section-close-btn').remove();
                var totalProducts = $(this).attr('totalProducts');
                totalProducts = JSON.parse(totalProducts);

                colNum = 4;
                rowNum = 5;

                // Create the new content with a close button inside the <h6> tag
                content += `
                <div class="my-3 appended-content">
                    <div class="card">
                        <div class="card-header">
                            <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Compare with similar items |
                            <label for="colSelect">Products:</label>
                            <select id="colSelect" class="form-control select-columns d-inline" style="width: 5%;">
                                <option value="2" ${colNum === 2 ? 'selected' : ''}>2</option>
                                <option value="3" ${colNum === 3 ? 'selected' : ''}>3</option>
                                <option value="4" ${colNum === 4 ? 'selected' : ''}>4</option>
                            </select>
                
                            <label for="rowSelect">Attributes:</label>
                            <select id="rowSelect" class="form-control select-rows d-inline" style="width: 5%;">
                                <option value="0" ${rowNum === 0 ? 'selected' : ''}>0</option>
                                <option value="1" ${rowNum === 1 ? 'selected' : ''}>1</option>
                                <option value="2" ${rowNum === 2 ? 'selected' : ''}>2</option>
                                <option value="3" ${rowNum === 3 ? 'selected' : ''}>3</option>
                                <option value="4" ${rowNum === 4 ? 'selected' : ''}>4</option>
                                <option value="5" ${rowNum === 5 ? 'selected' : ''}>5</option>
                            </select>
                            <span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span></h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" value="10.${clickCount}" name="module_id[]">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    Select Product
                                                </td>`;

                                                for (let i = 0; i < colNum; i++) {
                                                    content += `
                                                        <td>
                                                            <select class="form-control product-select" data-index="${i}" required name="module10product${i+1}id[]">
                                                                <option value="">Choose Product</option>`;

                                                            totalProducts.forEach(product => {
                                                                content += `<option value="${product.id}">${product.name}</option>`;
                                                            });

                                                    content += `</select>
                                                            
                                                        </td>`;
                                                }

                                    content += `</tr>
                                                <tr>
                                                    <td>
                                                        Image
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <img src="" class="product-image${i+1} img-fluid" alt="Product Image" style="display: none; width: 100%; height :150px;">
                                                                <input type="hidden" name="module10product${i+1}image[]" class="form-control product-image" required value="">
                                                            </td>`;
                                                    }

                                    content += `</tr>
                                                <tr>
                                                    <td>
                                                        Name
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <input type="text" name="module10product${i+1}name[]" class="form-control product-name" required value="" readonly> 
                                                            </td>`;
                                                    }

                                    content += `</tr>
                                                <tr>
                                                    <td>
                                                        Price
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <input type="number" name="module10product${i+1}price[]" class="form-control product-price" required value="" readonly> 
                                                            </td>`;
                                                    }

                                    content += `</tr>
                                                <tr>
                                                    <td>
                                                        Review
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <input type="number" name="module10product${i+1}review[]" class="form-control product-review" required value="" maxlength="1" readonly> 
                                                            </td>`;
                                                    }

                                    content += `</tr>`;
                                                
                                                for(let j=0; j < rowNum; j++){
                                                content += `<tr>
                                                    <td>
                                                        <input type="text" name="module10heading${j+1}[]" class="form-control" required placeholder="Enter Heading" maxlength="20">
                                                    </td>`;

                                                    for (let i = 0; i < colNum; i++) {
                                                        content += `
                                                            <td>
                                                                <input type="text" name="module10product${i+1}content${j+1}[]" class="form-control" required value=""> 
                                                            </td>`;
                                                    }

                                    content += `</tr>`;
                                                }
                            content += `</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;


                    break;
        }

        // Append the new content to the moduleContent
        $('#moduleContent').append(content);

        // Handle column and row changes dynamically
        $('.select-columns, .select-rows').on('change', function() {
            var newColNum = parseInt($('#colSelect').val()); // Get new column count
            var newRowNum = parseInt($('#rowSelect').val()); // Get new row count

            var table = $('#moduleContent .appended-content table');

            // Update rows
            var currentRows = table.find('tr').length - 5; // Subtract 1 for the first heading row
            if (newRowNum > currentRows) {
                // Add new rows if needed
                for (let r = currentRows; r < newRowNum; r++) {
                    let rowContent = `<tr>
                                        <td><input type="text" name="module10heading${r + 1}[]" class="form-control" required placeholder="Enter Heading" maxlength="20"></td>`;
                    for (let c = 0; c < newColNum; c++) {
                        rowContent += `<td>
                                            <input type="text" name="module10product${c + 1}content${r + 1}[]" class="form-control" required value="">
                                    </td>`;
                    }
                    rowContent += `</tr>`;
                    table.append(rowContent);
                }
            } else if (newRowNum < currentRows) {
                // Remove extra rows
                for (let r = currentRows; r > newRowNum; r--) {
                    table.find('tr:last').remove();
                }
            }

            // Update columns
            table.find('tr').each(function(rowIndex) {
                var currentCols = $(this).find('td').length - 1; // Subtract 1 for the first <td> in each row
                if (newColNum > currentCols) {
                    // Add new columns if needed
                    for (let i = currentCols; i < newColNum; i++) {
                        if (rowIndex === 0) {
                            // First row for select product
                            $(this).append(`<td>
                                <select class="form-control product-select" data-index="${i}" required name="module10product${i + 1}id[]">
                                    <option value="">Choose Product</option>
                                    ${totalProducts.map(product => `<option value="${product.id}">${product.name}</option>`).join('')}
                                </select>
                            </td>`);
                        }else if (rowIndex === 1) {
                            // Second row for image
                            $(this).append(`<td>
                                <img src="" class="product-image${i+1} img-fluid" alt="Product Image" style="display: none; width: 100%; height :150px;">
                                <input type="hidden" name="module10product${i+1}image[]" class="form-control product-image" required value="">
                            </td>`);
                        }else if (rowIndex === 2) {
                            // Third row for name
                            $(this).append(`<td>
                                <input type="text" name="module10product${i+1}name[]" class="form-control product-name" required value="" readonly> 
                            </td>`);
                        }else if (rowIndex === 3) {
                            // Fourth row for price
                            $(this).append(`<td>
                                <input type="number" name="module10product${i+1}price[]" class="form-control product-price" required value="" readonly> 
                            </td>`);
                        }else if (rowIndex === 4) {
                            // First row for review
                            $(this).append(` <td>
                                <input type="number" name="module10product${i+1}review[]" class="form-control product-review" required value="" maxlength="1" readonly> 
                            </td>`);
                        } else {
                            // Other rows for image, name, price, review, and additional content
                            $(this).append(`<td>
                                <input type="text" name="module10product${i + 1}content${rowIndex - 4}[]" class="form-control" required value="">
                            </td>`);
                        }
                    }
                } else if (newColNum < currentCols) {
                    // Remove extra columns
                    for (let i = currentCols; i > newColNum; i--) {
                        $(this).find('td:last').remove();
                    }
                }
            });
        });


        // Add event listener for dynamically added select elements
        $(document).on('change', '.product-select', function() {
            var selectedProductId = $(this).val();
            var index = $(this).data('index'); // Get the index of the current select
        
            // Dynamically find the corresponding elements using the index
            var productImage = $(`.product-image${index+1}`);
            var productImageInput = $(`input[name="module10product${index+1}image[]"]`);
            var productNameInput = $(`input[name="module10product${index+1}name[]"]`);
            var productPriceInput = $(`input[name="module10product${index+1}price[]"]`);
            var productReviewInput = $(`input[name="module10product${index+1}review[]"]`);
        
            if (selectedProductId) {
                var selectedProduct = totalProducts.find(product => product.id == selectedProductId);
        
                if (selectedProduct) {
                    var uploadIndex = selectedProduct.image.indexOf('/uploads/');
                    var relativePath = selectedProduct.image.substring(uploadIndex + 8);

                    // Populate product details in the corresponding fields
                    productImage.attr('src', selectedProduct.image).show(); // Show image
                    productImageInput.val(relativePath); // Set hidden input for image URL
                    productNameInput.val(selectedProduct.name); // Set product name
                    productPriceInput.val(selectedProduct.price); // Set product price
                    productReviewInput.val(`${selectedProduct.reviews.rating}`); // Set product review
                }
            } else {
                // Clear fields if no product is selected
                productImage.hide().attr('src', ''); // Hide and clear image
                productImageInput.val(''); // Clear hidden image input
                productNameInput.val(''); // Clear product name
                productPriceInput.val(''); // Clear product price
                productReviewInput.val(''); // Clear product review
            }
        }); 
    });

    $('#updateContentFormSubmit').on('submit', function(e) {
        var isValid = true;
    
        // Check each input field
        $(this).find('input[type="text"], input[type="hidden"]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                return false; // Exit loop on first empty field
            }
        });
    
        if (!isValid) {
            alert('Please fill out all fields.');
            e.preventDefault(); // Prevent form submission
        } else {
            e.preventDefault();
            
            var data = $(this).serialize();
            $("#updateContentFormSubmit").hide();
            $("#aplusloader").show();
    
            $.post(myAjax.ajaxurl, data + '&action=updateContentFormSubmit_action', function(response) {
                if (response.success === true) {
                    let message = JSON.parse(response.data.body);
                    alert(message.message);
                    location.href = 'admin.php?page=a-plus-content';
                } else {
                    $("#customTemplateFormSubmit").show();
                    $("#aplusloader").hide();
                    alert("Make Sure that you create at least one module with all filled data.");
                }
            }).fail(function(xhr, status, error) {
                console.error('Error:', error); // Log any errors to the console
                $("#updateContentFormSubmit").show();
                $("#aplusloader").hide();
            });
        }
    });
    

    $('#paymentFormSubmit').on('submit', function(e) {
        e.preventDefault();
        var payAmount = $("#payAmount").val(); 

        if(payAmount == ''){
            alert('Please select an plan to proceed.');
            e.preventDefault();
            return false;
        }

        var data = $(this).serialize();

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
                        $.post(myAjax.ajaxurl, "payment_status=success&oid=" + orderID + "&rp_payment_id=" + paymentResponse.razorpay_payment_id + "&action=paymentStatus_action",function(response){
                            if(response.success == true){
                                window.location.replace("admin.php?page=upgrade-a-plus-content&payment-status=success&oid=" + orderID + "&rp_payment_id=" + paymentResponse.razorpay_payment_id);
                            }else{
                                alert("Something went wrong with payment");
                                window.location.replace("admin.php?page=upgrade-a-plus-content&payment-status=failed&oid=" + orderID + "&reason=Please contact our support team if amount is debited from you account." + "&paymentid=" + paymentResponse.razorpay_payment_id);
                            }
                        }).fail(function(xhr, status, error) {
                            console.error('Error:', error); // Log any errors to the console
                        });
                    },
                    "modal": {
                        "ondismiss": function(){
                            window.location.replace("admin.php?page=upgrade-a-plus-content&payment-status=cancelled&oid=" + orderID);
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
            $("#planContainer").show();
            $("#aplusloader").hide();
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
            var uploadIndex = attachment.url.indexOf('/uploads/');
            var relativePath = attachment.url.substring(uploadIndex + 8);
        
            previewImageFromURL(attachment.url, relativePath, clickCount, $inputField);
        });

        // Open the media library
        file_frame.open();
    });

    // Function to preview image from URL
    function previewImageFromURL(url, filename, clickCount, $inputField) {
        const img = new Image();
        img.src = url;
        img.filename = filename;

        img.onload = function() {
            const width = img.width;
            const height = img.height;

            if (width === 1440 && height === 900) {
                const $preview = $('#imagePreview' + clickCount);
                $preview.attr('src', url).show();

                // Hide the span within the closest .apluscontent-upload-box
                $inputField.closest('.apluscontent-upload-box').find('span').hide();

                // Set the URL in the hidden input field
                $('#imageUrl' + clickCount).val(filename);
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
                var uploadIndex = attachment.url.indexOf('/uploads/');
                var relativePath = attachment.url.substring(uploadIndex + 8);
                inputField.val(relativePath);
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
                var uploadIndex = attachment.url.indexOf('/uploads/');
                var relativePath = attachment.url.substring(uploadIndex + 8);
                inputField.val(relativePath);
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
                        var uploadIndex = attachment.url.indexOf('/uploads/');
                        var relativePath = attachment.url.substring(uploadIndex + 8);
                        inputField.val(relativePath);
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
                        var uploadIndex = attachment.url.indexOf('/uploads/');
                        var relativePath = attachment.url.substring(uploadIndex + 8);
                        inputField.val(relativePath);
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

    $(document).on('click', '.wp-media-file-twoCards', function(e) {
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
                    if (img.width == 550 && img.height == 300) {
                        var uploadIndex = attachment.url.indexOf('/uploads/');
                        var relativePath = attachment.url.substring(uploadIndex + 8);
                        inputField.val(relativePath);
                    } else {
                        alert('The image should have width: 550 px and height: 300 px.');
                    }
                };
            } else {
                alert('Only JPG, JPEG, PNG, and WEBP files are allowed.');
            }
        });
    
        frame.open();
    });
    
    $(document).on('click', '.wp-media-file-videoImage', function(e) {
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
                    if (img.width == 555 && img.height == 370) {
                        var uploadIndex = attachment.url.indexOf('/uploads/');
                        var relativePath = attachment.url.substring(uploadIndex + 8);
                        inputField.val(relativePath);
                    } else {
                        alert('The image should have width: 555 px and height: 370 px.');
                    }
                };
            } else {
                alert('Only JPG, JPEG, PNG, and WEBP files are allowed.');
            }
        });
    
        frame.open();
    });

    $(document).on('click', '.wp-media-file-single', function(e) {
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
                    if (img.width == 560 && img.height == 420) {
                        var uploadIndex = attachment.url.indexOf('/uploads/');
                        var relativePath = attachment.url.substring(uploadIndex + 8);
                        inputField.val(relativePath);
                    } else {
                        alert('The image should have width: 560 px and height: 420 px.');
                    }
                };
            } else {
                alert('Only JPG, JPEG, PNG, and WEBP files are allowed.');
            }
        });
    
        frame.open();
    });

    $(document).on('click', '.wp-media-file-three', function(e) {
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
                    if (img.width == 365 && img.height == 240) {
                        var uploadIndex = attachment.url.indexOf('/uploads/');
                        var relativePath = attachment.url.substring(uploadIndex + 8);
                        inputField.val(relativePath);
                    } else {
                        alert('The image should have width: 365 px and height: 240 px.');
                    }
                };
            } else {
                alert('Only JPG, JPEG, PNG, and WEBP files are allowed.');
            }
        });
    
        frame.open();
    });
    
    // Create a MutationObserver to monitor DOM changes
    const observer = new MutationObserver(function(mutationsList, observer) {
        mutationsList.forEach(function(mutation) {
            if ($('#colSelect').length) {
                $('#moduleNo10').hide();
            } else {
                $('#moduleNo10').show();
            }
        });
    });

    // Start observing the DOM
    observer.observe(document.body, {
        childList: true, // Watch for added or removed children
        subtree: true    // Monitor changes within the entire DOM tree
    });

     // Handle column and row changes dynamically
    $('.select-columns, .select-rows').on('change', function() {
        var totalProducts = $('#totalProducts').attr('totalProducts');
        totalProducts = JSON.parse(totalProducts);

        var newColNum = parseInt($('#colSelect').val()); // Get new column count
        var newRowNum = parseInt($('#rowSelect').val()); // Get new row count

        var table = $('#moduleContent .appended-content table');

        // Update rows
        var currentRows = table.find('tr').length - 5; // Subtract 1 for the first heading row
        if (newRowNum > currentRows) {
            // Add new rows if needed
            for (let r = currentRows; r < newRowNum; r++) {
                let rowContent = `<tr>
                                    <td><input type="text" name="module10heading${r + 1}[]" class="form-control" required placeholder="Enter Heading" maxlength="20"></td>`;
                for (let c = 0; c < newColNum; c++) {
                    rowContent += `<td>
                                        <input type="text" name="module10product${c + 1}content${r + 1}[]" class="form-control" required value="">
                                </td>`;
                }
                rowContent += `</tr>`;
                table.append(rowContent);
            }
        } else if (newRowNum < currentRows) {
            // Remove extra rows
            for (let r = currentRows; r > newRowNum; r--) {
                table.find('tr:last').remove();
            }
        }

        // Update columns
        table.find('tr').each(function(rowIndex) {
            var currentCols = $(this).find('td').length - 1; // Subtract 1 for the first <td> in each row
            if (newColNum > currentCols) {
                // Add new columns if needed
                for (let i = currentCols; i < newColNum; i++) {
                    if (rowIndex === 0) {
                        // First row for select product
                        $(this).append(`<td>
                            <select class="form-control product-select" data-index="${i}" required name="module10product${i + 1}id[]">
                                <option value="">Choose Product</option>
                                ${totalProducts.map(product => `<option value="${product.id}">${product.name}</option>`).join('')}
                            </select>
                        </td>`);
                    }else if (rowIndex === 1) {
                        // Second row for image
                        $(this).append(`<td>
                            <img src="" class="product-image${i+1} img-fluid" alt="Product Image" style="display: none; width: 100%; height :150px;">
                            <input type="hidden" name="module10product${i+1}image[]" class="form-control product-image" required value="">
                        </td>`);
                    }else if (rowIndex === 2) {
                        // Third row for name
                        $(this).append(`<td>
                            <input type="text" name="module10product${i+1}name[]" class="form-control product-name" required value="" readonly> 
                        </td>`);
                    }else if (rowIndex === 3) {
                        // Fourth row for price
                        $(this).append(`<td>
                            <input type="number" name="module10product${i+1}price[]" class="form-control product-price" required value="" readonly> 
                        </td>`);
                    }else if (rowIndex === 4) {
                        // First row for review
                        $(this).append(` <td>
                            <input type="number" name="module10product${i+1}review[]" class="form-control product-review" required value="" maxlength="1" readonly> 
                        </td>`);
                    } else {
                        // Other rows for image, name, price, review, and additional content
                        $(this).append(`<td>
                            <input type="text" name="module10product${i + 1}content${rowIndex - 4}[]" class="form-control" required value="">
                        </td>`);
                    }
                }
            } else if (newColNum < currentCols) {
                // Remove extra columns
                for (let i = currentCols; i > newColNum; i--) {
                    $(this).find('td:last').remove();
                }
            }
        });
    });


    // Add event listener for dynamically added select elements
    $(document).on('change', '.product-select', function() {
        var totalProducts = $('#totalProducts').attr('totalProducts');
        totalProducts = JSON.parse(totalProducts);

        var selectedProductId = $(this).val();
        var index = $(this).data('index'); // Get the index of the current select
    
        // Dynamically find the corresponding elements using the index
        var productImage = $(`.product-image${index+1}`);
        var productImageInput = $(`input[name="module10product${index+1}image[]"]`);
        var productNameInput = $(`input[name="module10product${index+1}name[]"]`);
        var productPriceInput = $(`input[name="module10product${index+1}price[]"]`);
        var productReviewInput = $(`input[name="module10product${index+1}review[]"]`);
    
        if (selectedProductId) {
            var selectedProduct = totalProducts.find(product => product.id == selectedProductId);
    
            if (selectedProduct) {
                var uploadIndex = selectedProduct.image.indexOf('/uploads/');
                var relativePath = selectedProduct.image.substring(uploadIndex + 8);

                // Populate product details in the corresponding fields
                productImage.attr('src', selectedProduct.image).show(); // Show image
                productImageInput.val(relativePath); // Set hidden input for image URL
                productNameInput.val(selectedProduct.name); // Set product name
                productPriceInput.val(selectedProduct.price); // Set product price
                productReviewInput.val(`${selectedProduct.reviews.rating}`); // Set product review
            }
        } else {
            // Clear fields if no product is selected
            productImage.hide().attr('src', ''); // Hide and clear image
            productImageInput.val(''); // Clear hidden image input
            productNameInput.val(''); // Clear product name
            productPriceInput.val(''); // Clear product price
            productReviewInput.val(''); // Clear product review
        }
    }); 

    $("#product-selection").select2();

});

