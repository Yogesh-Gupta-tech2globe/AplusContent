<?php

$api_url = $GLOBALS['authorSite'].'/getModule2ById';
	
$data = array(
    'public_key' => get_option('aplus_plugin_public_key'),
    'content_id' => $content_id,
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

$item = $result[$flag2];
?>

<div class="my-3 appended-content">
    <div class="card">
        <div class="card-header" style="cursor: move;">
            <h6>Three Columns with Images, Heading, and Description <?php if($i == count($module_id) - 1){ ?><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span><?php } ?></h6>
        </div>
        <div class="card-body">
            <input type="hidden" value="2.<?php echo $count; ?>" name="module_id[]">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image1[]" readonly value="<?php echo esc_url($item['module2Image1']); ?>">
                            <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" required name="module2heading1[]" placeholder="Enter Heading" value="<?php echo esc_html($item['module2heading1']); ?>">
                            <textarea class="form-control mt-2" required name="module2description1[]" placeholder="Enter Description" rows="5"><?php echo esc_html($item['module2description1']); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image2[]" readonly value="<?php echo esc_url($item['module2Image2']); ?>">
                            <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" required name="module2heading2[]" placeholder="Enter Heading" value="<?php echo esc_html($item['module2heading2']); ?>">
                            <textarea class="form-control mt-2" required name="module2description2[]" placeholder="Enter Description" rows="5"><?php echo esc_html($item['module2description2']); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card h-100">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Upload Image" required name="module2Image3[]" readonly value="<?php echo esc_url($item['module2Image3']); ?>">
                            <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" required name="module2heading3[]" placeholder="Enter Heading" value="<?php echo esc_html($item['module2heading3']); ?>">
                            <textarea class="form-control mt-2" required name="module2description3[]" placeholder="Enter Description" rows="5"><?php echo esc_html($item['module2description3']); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>