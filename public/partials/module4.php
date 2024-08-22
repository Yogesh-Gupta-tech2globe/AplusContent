<?php

$api_url = $GLOBALS['authorSite'].'/getModule4ById';
	
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

<div class="container my-4 standard-single-left-image">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-12">
            <img src="<?php echo esc_url($item['module4Image']); ?>" class="w-100" alt="" />
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <div class="contant">
                <h3><?php echo esc_html($item['module4heading']); ?></h3>
                <p>
                <?php echo esc_html($item['module4description']); ?>
                </p>
            </div>
        </div>
    </div>
</div>
    