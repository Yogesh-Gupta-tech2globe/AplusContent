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

<div class="container my-4 banner-section-one">
    <img src="<?php echo esc_url($upload_path.$item['module7Image']); ?>" class="img-fluid" alt="..." />
</div>
<div class="container my-4 banner-section-two">
    <div class="row">
        <h1><?php echo mb_strimwidth(nl2br(stripslashes($item['module7heading'])), 0, 60, '...'); ?></h1>
        <p>
        <?php echo mb_strimwidth(nl2br(stripslashes($item['module7description'])), 0, 460, '...'); ?>
        </p>
    </div>
</div>