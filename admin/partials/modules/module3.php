<?php

$api_url = $GLOBALS['authorSite'].'/getModule3ById';
	
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

$item = $result[$flag3];
?>

<div class="my-3 appended-content">
    <div class="card">
        <div class="card-header" style="cursor: move;"><h6>Single Right Image <?php if($i == count($module_id) - 1){ ?><span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span><?php } ?></h6></div>
        <div class="card-body">
        <input type="hidden" value="3.<?php echo $count; ?>" name="module_id[]">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12 col-12">
                <div class="contant">
                    <input type="text" class="form-control" required name="module3heading[]" placeholder="Enter Heading" value="<?php echo esc_html($item['module3heading']); ?>">
                    <textarea class="form-control mt-2" required name="module3description[]" placeholder="Enter Description" rows="5"><?php echo esc_html($item['module3description']); ?></textarea>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Upload Image" required name="module3Image[]" readonly value="<?php echo esc_url($item['module3Image']); ?>">
                    <button class="btn btn-primary wp-media-file2" type="submit">Upload Image</button>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>