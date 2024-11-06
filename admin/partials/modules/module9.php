<?php

$api_url = $GLOBALS['authorSite'].'/getModule9ById';
	
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

$item = $result[$flag9];
?>

<div class="my-3 appended-content">
    <div class="card">
        <div class="card-header">
            <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Two Standard Cards <span class="text-secondary">(Image size: 550 px wide, 300 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 160 Char.)</span> <?php if($i == count($module_id) - 1){ ?><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span><?php } ?></h6>
        </div>
        <div class="card-body">
            <input type="hidden" value="9.<?php echo $count; ?>" name="module_id[]">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" placeholder="Upload Image" required name="module9Image1[]" readonly value="<?php echo esc_url($item['module9Image1']); ?>">
                        <button class="btn btn-primary wp-media-file-twoCards" type="submit">Upload Image</button>
                    </div>
                    <input type="text" class="form-control" required name="module9heading1[]" placeholder="Enter Heading" value="<?php echo stripslashes($item['module9heading1']); ?>" maxlength="60">
                    <textarea class="form-control mt-2" required name="module9description1[]" placeholder="Enter Description" rows="5" maxlength="160"><?php echo stripslashes($item['module9description1']); ?></textarea>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" placeholder="Upload Image" required name="module9Image2[]" readonly value="<?php echo esc_url($item['module9Image2']); ?>">
                        <button class="btn btn-primary wp-media-file-twoCards" type="submit">Upload Image</button>
                    </div>
                    <input type="text" class="form-control" required name="module9heading2[]" placeholder="Enter Heading" value="<?php echo stripslashes($item['module9heading2']); ?>" maxlength="60">
                    <textarea class="form-control mt-2" required name="module9description2[]" placeholder="Enter Description" rows="5" maxlength="160"><?php echo stripslashes($item['module9description2']); ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>