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

<div class="container my-4 standard-single-right-image">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-12">
            <div class="contant">
                <h3><?php echo mb_strimwidth(nl2br(stripslashes($item['module3heading'])), 0, 60, '...'); ?></h3>
                <p>
                <?php echo mb_strimwidth(nl2br(stripslashes($item['module3description'])), 0, 460, '...'); ?>
                </p>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <img src="<?php echo esc_url($item['module3Image']); ?>" class="img-fluid" alt="" />
        </div>
    </div>
</div>

    