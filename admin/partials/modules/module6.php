<?php

$api_url = $GLOBALS['authorSite'].'/getModule6ById';
	
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

$item = $result[$flag6];
?>

<div class="my-3 appended-content">
    <div class="card">
        <div class="card-header" style="cursor: move;"><h6>Video with Image <span class="text-secondary">(Image Formats: JPG, JPEG, PNG, WEBP. Video Formats: MP4, AVI, MKV.)</span><?php if($i == count($module_id) - 1){ ?><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span><?php } ?></h6></div>
        <div class="card-body">
            <input type="hidden" value="6.<?php echo $count; ?>" name="module_id[]">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Upload Image" required name="module6Image[]" readonly value="<?php echo esc_url($item['module6Image']); ?>">
                        <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" placeholder="Upload Video Thumbnail Image" required name="module6ThumbImage[]" readonly value="<?php echo esc_url($item['module6ThumbImage']); ?>">
                        <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Upload Video" required name="module6video[]" readonly value="<?php echo esc_url($item['module6video']); ?>">
                        <button class="btn btn-primary wp-media-file3" type="submit">Upload Image</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>