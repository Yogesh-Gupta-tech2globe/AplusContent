<?php

$api_url = $GLOBALS['authorSite'].'/getModule2ById';
	
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

$item = $result[$flag2];
?>

    <div class="container my-4 banner-section-three">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card h-100">
                    <img src="<?php echo esc_url($item['module2Image1']); ?>" class="card-img-top" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo esc_html($item['module2heading1']); ?></h5>
                        <p class="card-text">
                        <?php echo esc_html($item['module2description1']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card h-100">
                    <img src="<?php echo esc_url($item['module2Image2']); ?>" class="card-img-top" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo esc_html($item['module2heading2']); ?></h5>
                        <p class="card-text">
                        <?php echo esc_html($item['module2description2']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card h-100">
                    <img src="<?php echo esc_url($item['module2Image3']); ?>" class="card-img-top" alt="" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo esc_html($item['module2heading3']); ?></h5>
                        <p class="card-text">
                        <?php echo esc_html($item['module2description3']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    