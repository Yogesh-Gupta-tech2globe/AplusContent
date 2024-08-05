<?php



global $wpdb, $table_prefix;



if(isset($_POST['module_submit'])){



    global $wpdb;



    $product_id = $_POST['product_id'];

    $module_id = $_POST['module_id'];



    $implodedModule_id = implode(',',$module_id);



    $query = "INSERT INTO `wp_apluscontent`(`product_id`, `module_id`) VALUES ('$product_id','$implodedModule_id')";

    $query_run = $wpdb->query($query);



    $latest_id = $wpdb->get_var("SELECT ID FROM wp_apluscontent ORDER BY ID DESC LIMIT 1");



    $i = 0;

    $k = 0;



    for($j=0; $j<count($module_id); $j++){



        $a = $module_id[$j];

        $u =  explode('.',$a);



        if($u[0] == 1){



            $heading = $_POST['heading'][$i];

            $paragraph = $_POST['paragraph'][$i];



            if($_FILES['module1Image']){

                $file_name = $_FILES['module1Image']['name'][$i];

                $info = pathinfo($file_name); // Get file info

                $ext = empty($info['extension']) ? '' : '.' . $info['extension']; // Get file extension

                $newname = "aplus-" . uniqid() . $ext; // Generate a unique name with a custom prefix

                $file_tmp = $_FILES['module1Image']['tmp_name'][$i];

                

                // Move the uploaded file to a custom directory

                $upload_dir = WP_CONTENT_DIR . '/uploads/apluscontent_uploads/'; // Path to WordPress uploads directory



                // Create the destination folder if it doesn't exist

                if (!file_exists($upload_dir)) {

                    mkdir($upload_dir, 0777, true); // Create the folder recursively

                }

                move_uploaded_file($file_tmp, $upload_dir . $newname);

            }



            $query2 = "INSERT INTO `wp_aplusmodule1`(`content_id`, `Image`, `Heading`, `Text`, `status`) VALUES ('$latest_id','$newname','$heading','$paragraph',1)";

            $query2_run = $wpdb->query($query2);



            $i = $i+1;



        }else if($u[0] == 2){



            if($_FILES['module2Image']){

                $file_name = $_FILES['module2Image']['name'][$k];

                $info = pathinfo($file_name); // Get file info

                $ext = empty($info['extension']) ? '' : '.' . $info['extension']; // Get file extension

                $newname2 = "aplus-" . uniqid() . $ext; // Generate a unique name with a custom prefix

                $file_tmp = $_FILES['module2Image']['tmp_name'][$k];

                

                // Move the uploaded file to a custom directory

                $upload_dir = WP_CONTENT_DIR . '/uploads/apluscontent_uploads/'; // Path to WordPress uploads directory



                // Create the destination folder if it doesn't exist

                if (!file_exists($upload_dir)) {

                    mkdir($upload_dir, 0777, true); // Create the folder recursively

                }



                move_uploaded_file($file_tmp, $upload_dir . $newname2);

            } 



            $query2 = "INSERT INTO `wp_aplusmodule2`(`content_id`, `image_name`, `status`) VALUES ('$latest_id','$newname2',1)";

            $query2_run = $wpdb->query($query2);



            $k = $k+1;

            

        }

    }



    $redirectionPage = admin_url("admin.php?page=a-plus-content");



    if($query2_run){

        echo "<script>alert('A+ Content Added Succsesfully.'); window.location.href='".$redirectionPage."'; </script>";

    }else{

        echo "<script>alert('Something went wrong.'); window.location.href='".$redirectionPage."'; </script>";

    }



}



//Listing of Products not having A+ Content
global $wpdb;

// Fetch excluded product IDs from the custom table
$excluded_product_ids = $wpdb->get_col("SELECT product_id FROM wp_apluscontent");

// Convert the array of excluded product IDs to a comma-separated string
$excluded_product_ids_string = implode(',', $excluded_product_ids);

// Query to fetch all products except those with IDs present in the excluded_product_ids
$args = array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post__not_in'   => $excluded_product_ids, // Exclude the specified product IDs
);

$products = new WC_Product_Query( $args );

$products = $products->get_products();

?>



<div class="wrap">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <p><span class="h4 fw-bold">A+ Content Editor</span></p>

                    </div>

                    <div class="card-body">

                        <div class="container">

                            <div class="row">

                                <div class="col-md-12">

                                    <form method="post" enctype="multipart/form-data">

                                        <h5>Select Product</h5>

                                        <select class="form-select" name="product_id" id="product-selection" required>

                                            <option value="">Select Product</option>

                                            <?php

                                            foreach($products as $product):

                                            ?>

                                            <option value="<?php echo $product->get_id(); ?>"><?php echo $product->get_name(); ?></option>

                                            <?php

                                            endforeach;

                                            ?>

                                        </select>



                                        <hr>



                                        <h5>Create Content</h5>



                                        <div id="moduleContent">



                                        </div>

                                        

                                        <div class="text-center border border-primary my-3" style="padding: 100px;">

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">

                                                Add Module

                                            </button>

                                        </div>          

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button type="submit" name="module_submit" class="btn btn-primary">Submit</button>

                    </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

    

</div>



<div class="modal fade" id="myModal">

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

                    <div class="card module" moduleNumber="1">

                        <div class="card-header">

                            <h6>Standard Image Header With Text</h6>

                        </div>

                        <div class="card-body">

                            <img src="<?php echo esc_url( plugins_url( '../img/module-demo-img1.jpeg', __FILE__ ) ); ?>" alt="Demo1">

                        </div>

                        <div class="card-footer">

                            <h6>This is a demo Heading</h6>

                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when...</p>

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="card module" moduleNumber="2">

                        <div class="card-header">

                            <h6>Standard Image</h6>

                        </div>

                        <div class="card-body">

                            <img src="<?php echo esc_url( plugins_url( '../img/module-demo-img2.jpg', __FILE__ ) ); ?>" alt="Demo2" width="auto" height="200px">

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



<script type="text/javascript" src="https://tympanus.net/Tutorials/CustomFileInputs/js/custom-file-input.js"></script>

