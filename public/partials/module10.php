<?php

$api_url = $GLOBALS['authorSite'].'/getModule10ById';
	
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

$item = $result[$flag10];
?>


    <div class="container my-4">
        <div class="compare-heading-container ">
            <h3>Compare with similar items</h3>
            <hr>
        </div>
        <div class="row">
            <div class="col-12"  style="overflow-x:auto;">
            
                  <table class="table  compare-table">
                    <thead>
                      <tr>
                        <th scope="col"></th>
                        <th scope="col">
                            <div class="related-product">
                                <div style="height: 200px;" class="d-flex justify-content-center align-items-center">
                                    <img src="<?php echo esc_url($upload_path.$item['module10product1image']); ?>" class="h-100" alt="" style="object-fit: contain;">
                                </div>
                                <p class="product-des"><?php echo esc_html($item['module10product1name']); ?></p>
                            </div>
                        </th>
                        <?php if(!empty($item['module10product2image'])): ?>
                        <th scope="col">
                            <div class="related-product">
                                <div style="height: 200px;" class="d-flex justify-content-center align-items-center">
                                    <img src="<?php echo esc_url($upload_path.$item['module10product2image']); ?>" class="h-100" alt="" style="object-fit: contain;">
                                </div>
                                <p class="product-des"><?php echo esc_html($item['module10product2name']); ?></p>
                            </div>
                        </th>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product3image'])): ?>
                        <th scope="col">
                            <div class="related-product">
                                <div style="height: 200px;" class="d-flex justify-content-center align-items-center">
                                    <img src="<?php echo esc_url($upload_path.$item['module10product3image']); ?>" class="h-100" alt="" style="object-fit: contain;">
                                </div>
                                <p class="product-des"><?php echo esc_html($item['module10product3name']); ?></p>
                            </div>
                        </th>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product4image'])): ?>
                        <th scope="col">
                            <div class="related-product">
                                <div style="height: 200px;" class="d-flex justify-content-center align-items-center">
                                    <img src="<?php echo esc_url($upload_path.$item['module10product4image']); ?>" class="h-100" alt="" style="object-fit: contain;">
                                </div>
                                <p class="product-des"><?php echo esc_html($item['module10product4name']); ?></p>
                            </div>
                        </th>
                        <?php endif; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Price</th>
                        <td><span>M.R.P: <?php echo get_woocommerce_currency_symbol().esc_html( $item['module10product1price'] ); ?></span></td>
                        <?php if(!empty($item['module10product2image'])): ?>
                        <td><span>M.R.P: <?php echo get_woocommerce_currency_symbol().esc_html( $item['module10product2price'] ); ?></span></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product3image'])): ?>
                        <td><span>M.R.P: <?php echo get_woocommerce_currency_symbol().esc_html( $item['module10product3price'] ); ?></span></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product4image'])): ?>
                        <td><span>M.R.P: <?php echo get_woocommerce_currency_symbol().esc_html( $item['module10product4price'] ); ?></span></td>
                        <?php endif; ?>
                      </tr>
                      <tr>
                        <th scope="row">Review</th>
                        <td><div class="rating d-flex align-item-center justify-content-start text-warning"><?php if($item['module10product1review'] == 0): echo '<i class="fa-regular fa-star"></i>'; else : for($i = 0; $i < $item['module10product1review']; $i++): echo '<i class="fa fa-star"></i>'; endfor; endif; ?></div></td>
                        <?php if(!empty($item['module10product2image'])): ?>
                        <td><div class="rating d-flex align-item-center justify-content-start text-warning"><?php if($item['module10product2review'] == 0): echo '<i class="fa-regular fa-star"></i>'; else : for($i = 0; $i < $item['module10product2review']; $i++): echo '<i class="fa fa-star"></i>'; endfor; endif; ?></div></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product3image'])): ?>
                        <td><div class="rating d-flex align-item-center justify-content-start text-warning"><?php if($item['module10product3review'] == 0): echo '<i class="fa-regular fa-star"></i>'; else : for($i = 0; $i < $item['module10product3review']; $i++): echo '<i class="fa fa-star"></i>'; endfor; endif; ?></div></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product4image'])): ?>
                        <td><div class="rating d-flex align-item-center justify-content-start text-warning"><?php if($item['module10product4review'] == 0): echo '<i class="fa-regular fa-star"></i>'; else : for($i = 0; $i < $item['module10product4review']; $i++): echo '<i class="fa fa-star"></i>'; endfor; endif; ?></div></td>
                        <?php endif; ?>
                      </tr>
                      <?php if(!empty($item['module10heading1'])): ?>
                      <tr>
                        <th scope="row"><?php echo esc_html( $item['module10heading1'] ); ?></th>
                        <td><?php echo esc_html( $item['module10product1content1'] ); ?></td>
                        <?php if(!empty($item['module10product2image'])): ?>
                        <td><?php echo esc_html( $item['module10product2content1'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product3image'])): ?>
                        <td><?php echo esc_html( $item['module10product3content1'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product4image'])): ?>
                        <td><?php echo esc_html( $item['module10product4content1'] ); ?></td>
                        <?php endif; ?>
                      </tr>
                      <?php endif; ?>
                      <?php if(!empty($item['module10heading2'])): ?>
                      <tr>
                        <th scope="row"><?php echo esc_html( $item['module10heading2'] ); ?></th>
                        <td><?php echo esc_html( $item['module10product1content2'] ); ?></td>
                        <?php if(!empty($item['module10product2image'])): ?>
                        <td><?php echo esc_html( $item['module10product2content2'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product3image'])): ?>
                        <td><?php echo esc_html( $item['module10product3content2'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product4image'])): ?>
                        <td><?php echo esc_html( $item['module10product4content2'] ); ?></td>
                        <?php endif; ?>
                      </tr>
                      <?php endif; ?>
                      <?php if(!empty($item['module10heading3'])): ?>
                      <tr>
                        <th scope="row"><?php echo esc_html( $item['module10heading3'] ); ?></th>
                        <td><?php echo esc_html( $item['module10product1content3'] ); ?></td>
                        <?php if(!empty($item['module10product2image'])): ?>
                        <td><?php echo esc_html( $item['module10product2content3'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product3image'])): ?>
                        <td><?php echo esc_html( $item['module10product3content3'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product4image'])): ?>
                        <td><?php echo esc_html( $item['module10product4content3'] ); ?></td>
                        <?php endif; ?>
                      </tr>
                      <?php endif; ?>
                      <?php if(!empty($item['module10heading4'])): ?>
                      <tr>
                        <th scope="row"><?php echo esc_html( $item['module10heading4'] ); ?></th>
                        <td><?php echo esc_html( $item['module10product1content4'] ); ?></td>
                        <?php if(!empty($item['module10product2image'])): ?>
                        <td><?php echo esc_html( $item['module10product2content4'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product3image'])): ?>
                        <td><?php echo esc_html( $item['module10product3content4'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product4image'])): ?>
                        <td><?php echo esc_html( $item['module10product4content4'] ); ?></td>
                        <?php endif; ?>
                      </tr>
                      <?php endif; ?>
                      <?php if(!empty($item['module10heading5'])): ?>
                      <tr>
                        <th scope="row"><?php echo esc_html( $item['module10heading5'] ); ?></th>
                        <td><?php echo esc_html( $item['module10product1content5'] ); ?></td>
                        <?php if(!empty($item['module10product2image'])): ?>
                        <td><?php echo esc_html( $item['module10product2content5'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product3image'])): ?>
                        <td><?php echo esc_html( $item['module10product3content5'] ); ?></td>
                        <?php endif; ?>
                        <?php if(!empty($item['module10product4image'])): ?>
                        <td><?php echo esc_html( $item['module10product4content5'] ); ?></td>
                        <?php endif; ?>
                      </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
