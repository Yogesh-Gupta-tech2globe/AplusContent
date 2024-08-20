<?php
   
    $product = wc_get_product($product_id);
    $api_url = $GLOBALS['authorSite'].'/getProductsById';

    $data = array(
        'public_key' => get_option('aplus_plugin_public_key'),
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
                        <input type="hidden" value="<?php echo $content_id; ?>" name="content_id">
                        <hr>
                        <p class="h6">Edit Content</p>
                        <div id="moduleContent">
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

                        <div class="text-center border border-primary my-3" style="padding: 100px;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customTemplateModal">
                                Add Module
                            </button>
                        </div>
          
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
    }

?>


<div class="modal fade" id="customTemplateModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Module</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card editor-page-module" moduleNumber="1">
                                <div class="card-header">
                                    <h6>Standard Image</h6>
                                </div>
                                <div class="card-body">
                                    <img src="<?php echo esc_url(plugins_url('../img/module1.jpeg', __FILE__)); ?>" alt="Demo1" width="auto" height="200px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


          



