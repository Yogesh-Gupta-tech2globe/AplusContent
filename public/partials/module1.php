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

<div class="inner-apluscontent-content-container my-4">
    <div class="apluscontent-inner-card">
        <img src="<?php echo esc_url($upload_path.$item['image']); ?>" class="img-fluid">
    </div>
</div>

    