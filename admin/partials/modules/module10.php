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
} else {
    $body = wp_remote_retrieve_body( $response );
    $data = json_decode( $body, true );
    $result = json_decode($data['data'], true);
}

$item = $result[$flag10];

$colNum = 0;
$rowNum = 0;

for($a = 1; $a < 5; $a++){
    if(!empty($item['module10product'.$a.'id'])){
        $colNum++;
    }
}

for($b = 1; $b < 6; $b++){
    if(!empty($item['module10heading'.$b])){
        $rowNum++;
    }
}
?>

<div id="totalProducts" totalProducts='<?php echo json_encode($productAttributes); ?>'></div>
<div class="my-3 appended-content">
    <div class="card">
        <div class="card-header" style="cursor: move;">
            <h6>Compare with similar items | 
            <label for="colSelect">Products:</label>
            <select id="colSelect" class="form-control select-columns d-inline" style="width: 5%;">
                <option value="2" <?php echo ($colNum == 2) ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo ($colNum == 3) ? 'selected' : ''; ?>>3</option>
                <option value="4" <?php echo ($colNum == 4) ? 'selected' : ''; ?>>4</option>
            </select>

            <label for="rowSelect">Attributes:</label>
            <select id="rowSelect" class="form-control select-rows d-inline" style="width: 5%;">
                <option value="0" <?php echo ($rowNum == 0) ? 'selected' : ''; ?>>0</option>
                <option value="1" <?php echo ($rowNum == 1) ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo ($rowNum == 2) ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo ($rowNum == 3) ? 'selected' : ''; ?>>3</option>
                <option value="4" <?php echo ($rowNum == 4) ? 'selected' : ''; ?>>4</option>
                <option value="5" <?php echo ($rowNum == 5) ? 'selected' : ''; ?>>5</option>
            </select>
            
            <?php if($i == count($module_id) - 1){ ?>
                <span class="btn btn-danger float-end section-close-btn"><i class="fa-solid fa-xmark"></i></span>
            <?php } ?>
            </h6>
        </div>
        <div class="card-body">
            <input type="hidden" value="10.<?php echo $count; ?>" name="module_id[]">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Select Product</td>
                                <?php for ($i = 0; $i < $colNum; $i++) : ?>
                                    <td>
                                        <select class="form-control product-select" data-index="<?php echo $i; ?>" required name="module10product<?php echo $i+1; ?>id[]">
                                            <option value="">Choose Product</option>
                                            <?php foreach ($productAttributes as $product) : ?>
                                                <option value="<?php echo $product['id']; ?>" <?php echo ($product['id'] == $item['module10product'.($i+1).'id']) ? 'selected' : ''; ?> ><?php echo $product['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <?php for ($i = 0; $i < $colNum; $i++) : ?>
                                    <td>
                                        <img src="<?php echo esc_url( $item['module10product'.($i+1).'image'] ) ?>" class="product-image<?php echo $i+1; ?> img-fluid" alt="Product Image" style="width: 100%; height :150px;">
                                        <input type="hidden" name="module10product<?php echo $i+1; ?>image[]" class="form-control product-image" required value="<?php echo esc_url( $item['module10product'.($i+1).'image'] ) ?>">
                                    </td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <?php for ($i = 0; $i < $colNum; $i++) : ?>
                                    <td>
                                        <input type="text" name="module10product<?php echo $i+1; ?>name[]" class="form-control product-name" required value="<?php echo esc_html( $item['module10product'.($i+1).'name'] ) ?>" readonly>
                                    </td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <?php for ($i = 0; $i < $colNum; $i++) : ?>
                                    <td>
                                        <input type="number" name="module10product<?php echo $i+1; ?>price[]" class="form-control product-price" required value="<?php echo esc_html( $item['module10product'.($i+1).'price'] ) ?>" readonly>
                                    </td>
                                <?php endfor; ?>
                            </tr>
                            <tr>
                                <td>Review</td>
                                <?php for ($i = 0; $i < $colNum; $i++) : ?>
                                    <td>
                                        <input type="number" name="module10product<?php echo $i+1; ?>review[]" class="form-control product-review" required value="<?php echo esc_html( $item['module10product'.($i+1).'review'] ) ?>" maxlength="1" readonly>
                                    </td>
                                <?php endfor; ?>
                            </tr>

                            <?php for ($j = 0; $j < $rowNum; $j++) : ?>
                                <tr>
                                    <td><input type="text" name="module10heading<?php echo $j+1; ?>[]" class="form-control" required placeholder="Enter Heading" maxlength="20" value="<?php echo esc_html( $item['module10heading'.($j+1)] ) ?>"></td>
                                    <?php for ($i = 0; $i < $colNum; $i++) : ?>
                                        <td><input type="text" name="module10product<?php echo $i+1; ?>content<?php echo $j+1; ?>[]" class="form-control" required value="<?php echo esc_html( $item['module10product'.($i+1).'content'.($j+1)] ) ?>"></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endfor; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
