<?php

$api_url = $GLOBALS['authorSite'].'/getModule7ById';
	
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

$item = $result[$flag7];
?>

<div class="my-3 appended-content">
    <div class="card">
        <div class="card-header">
            <h6><span class="btn btn-warning moveCardButton"><i class="fa-solid fa-arrows-up-down-left-right"></i></span> Hero Banner <span class="text-secondary">(Image size: 1320-1650 px wide, 385-700 px tall. Formats: JPG, JPEG, PNG, WEBP. Heading: 60 Char. Description: 460 Char.)</span><?php if($i == count($module_id) - 1){ ?><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span><?php } ?></h6>
        </div>
        <div class="card-body">
            <input type="hidden" value="7.<?php echo $count; ?>" name="module_id[]">
            <div class="row">
                <div class="input-group my-3">
                    <input type="text" class="form-control" placeholder="Upload Image" required name="module7Image[]" readonly value="<?php echo esc_url($item['module7Image']); ?>">
                    <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                </div>
            </div>
            <div class="row">
                <input type="text" class="form-control mb-2" placeholder="Enter Heading" required name="module7heading[]" value="<?php echo stripslashes($item['module7heading']); ?>" maxlength="60">
                <textarea class="form-control mb-2" placeholder="Enter Description of Hero Banner" required name="module7description[]" rows="5" maxlength="460"><?php echo stripslashes($item['module7description']); ?></textarea>
            </div>
        </div>
    </div>
</div>