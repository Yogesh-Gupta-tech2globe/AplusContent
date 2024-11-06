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

<div class="container my-4">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-12">
            <div class="position-relative">
                <img src="<?php echo esc_url($upload_path.$item['module9Image1']); ?>" class="img-fluid w-100" style="object-fit: cover;" alt="" />
                <h3 class="mt-3"><?php echo mb_strimwidth(nl2br(stripslashes($item['module9heading1'])), 0, 60, '...'); ?></h3>
                <p><?php echo mb_strimwidth(nl2br(stripslashes($item['module9description1'])), 0, 160, '...'); ?></p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <div class="position-relative">
                <img src="<?php echo esc_url($upload_path.$item['module9Image2']); ?>" class="img-fluid w-100" style="object-fit: cover;" alt="" />
                <h3 class="mt-3"><?php echo mb_strimwidth(nl2br(stripslashes($item['module9heading2'])), 0, 60, '...'); ?></h3>
                <p><?php echo mb_strimwidth(nl2br(stripslashes($item['module9description2'])), 0, 160, '...'); ?></p>
            </div>
        </div>
    </div>
</div>
