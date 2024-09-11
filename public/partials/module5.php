<?php

$api_url = $GLOBALS['authorSite'].'/getModule5ById';
	
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

$item = $result[$flag5];
?>

<style>
    .carousel-indicators button {
        background-color: #333 !important; /* Color of the dots */
        width: 10px !important;
        height: 10px !important;
        border-radius: 50% !important;
        border: none !important;
    }

    .carousel-indicators button.active {
        background-color: #fff; /* Color of the active dot */
        width: 12px;
        height: 12px;
    }

    .carousel-indicators button:focus {
        outline: none; /* Remove the focus outline */
    }

</style>

<div class="container my-4 slider-section">
    <div id="carouselExampleIndicators<?php echo $flag5; ?>" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators<?php echo $flag5; ?>" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators<?php echo $flag5; ?>" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators<?php echo $flag5; ?>" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?php echo esc_url($item['module5Image1']); ?>" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="<?php echo esc_url($item['module5Image2']); ?>" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="<?php echo esc_url($item['module5Image3']); ?>" class="d-block w-100" alt="..." />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?php echo $flag5; ?>"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?php echo $flag5; ?>"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
    