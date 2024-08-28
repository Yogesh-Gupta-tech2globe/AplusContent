<?php

$api_url = $GLOBALS['authorSite'].'/getModule5ById';
	
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

$item = $result[$flag4];
?>

<div class="my-3 appended-content">
    <div class="card">
        <div class="card-header" style="cursor: move;">
            <h6>Slider <span class="text-secondary">(Image size: 1320-1650 px wide, 550-700 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><?php if($i == count($module_id) - 1){ ?><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span><?php } ?></h6>
        </div>
        <div class="card-body">
            <input type="hidden" value="5.<?php echo $count; ?>" name="module_id[]">
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Upload Image for slider1" required name="module5Image1[]" readonly value="<?php echo esc_url($item['module5Image1']); ?>">
                <button class="btn btn-primary wp-media-file-slider" type="submit">Upload Image</button>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Upload Image for slider2" required name="module5Image2[]" readonly value="<?php echo esc_url($item['module5Image2']); ?>">
                <button class="btn btn-primary wp-media-file-slider" type="submit">Upload Image</button>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control" placeholder="Upload Image for slider3" required name="module5Image3[]" readonly value="<?php echo esc_url($item['module5Image3']); ?>">
                <button class="btn btn-primary wp-media-file-slider" type="submit">Upload Image</button>
            </div>
        </div>
    </div>
</div>