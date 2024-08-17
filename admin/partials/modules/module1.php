<?php

$api_url = 'http://127.0.0.1:8000/api/aplus-content/getModule1ById';
	
$data = array(
    'user_id' => 10,
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

<div class="my-3">
    <div class="card">
        <div class="card-header"><h6>Standard Image</h6></div>
        <div class="card-body">
            <input type="hidden" value="1.<?php echo $flag1+1; ?>" name="module_id[]">
            <div class="apluscontent-upload-box" onclick="document.getElementById('imageInput<?php echo $flag1+1; ?>').click()">
                <input type="file" class="wp-media-file" id="imageInput<?php echo $flag1+1; ?>" accept="image/*">
                <img id="imagePreview<?php echo $flag1+1; ?>" src="<?php echo esc_url($item['image']); ?>" style="display: block;">
                <input type="hidden" name="module1Image[]" id="imageUrl<?php echo $flag1+1; ?>">
            </div>
        </div>
    </div>
</div>