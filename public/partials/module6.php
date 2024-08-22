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

<div class="container my-4 video-section">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-12">
            <img src="<?php echo esc_url($item['module6Image']); ?>" class="w-100" alt="" />
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <video width="100%" controls>
                                <source src="<?php echo esc_url($item['module6video']); ?>" type="video/mp4">
                            </video>
                        </div>

                    </div>
                </div>
            </div>

            <a class="position-relative" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><img
                    class="w-100" src="<?php echo esc_url($item['module6ThumbImage']); ?>" alt="">
                <div class="play-icon position-absolute top-50 start-50 translate-middle"><i
                        class="fa-regular fa-circle-play fs-1 text-light"></i></div>
            </a>
        </div>
    </div>
</div>