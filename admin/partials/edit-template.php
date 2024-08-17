<?php
   
    $product = wc_get_product($product_id);
    $api_url = 'http://127.0.0.1:8000/api/aplus-content/getProductsById';

    $data = array(
        'user_id' => 10,
        'product_id' => $product_id,
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

    foreach($result as $row){
       
        $module_id = $row['module_ids'];
        $module_id = explode(",",$module_id);
        $content_id = $row['id'];
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <p class="h6">A+ Content Editor</p>
                </div>

                <form id="updateContentFormSubmit" enctype="multipart/form-data">
                    <div class="card-body">
                        <p class="h6">Selected Product</p>
                        <input type="text" class="form-control" value="<?php echo $product->get_name(); ?>" readonly>
                        <input type="hidden" value="<?php echo $product_id; ?>">
                        <hr>
                        <p class="h6">Edit Content</p>
                        <?php
                        $flag1 = 0;
                        $flag2 = 0;

                        for($i=0; $i<count($module_id); $i++){
                            $u =  explode('.',$module_id[$i]);
                            if($u[0] == 1){
                                include "modules/module1.php";
                                $flag1 = $flag1 + 1;
                            }else if($u[0] == 2){
                                // include "module2.php";
                                $flag2 = $flag2 + 1;
                            }
                        }
                        
                        ?>
          
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="module_submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
    }

?>


          



