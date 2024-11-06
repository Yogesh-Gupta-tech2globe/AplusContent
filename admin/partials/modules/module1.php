<?php

$api_url = $GLOBALS['authorSite'].'/getModule1ById';
	
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

$item = $result[$flag1];
?>

<div class="my-3 appended-content">
    <div class="card">
        <div class="card-header">
            <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Standard Image <span class="text-secondary">(Image size: 1440 px wide, 900 px tall. Formats: JPG, JPEG, PNG, WEBP.)</span><?php if($i == count($module_id) - 1){ ?><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span><?php } ?></h6>
        </div>
        <div class="card-body">
            <input type="hidden" value="1.<?php echo $count; ?>" name="module_id[]">
            <div class="apluscontent-upload-box" onclick="document.getElementById('imageInput<?php echo $count; ?>').click()">
                <input type="file" class="wp-media-file singleImage" id="imageInput<?php echo $count; ?>" accept="image/*">
                <img id="imagePreview<?php echo $count; ?>" src="<?php echo esc_url($upload_path.$item['image']); ?>" style="display: block;">
                <input type="hidden" name="module1Image[]" id="imageUrl<?php echo $count; ?>" value="<?php echo esc_url($item['image']); ?>">
            </div>
        </div>
    </div>
</div>