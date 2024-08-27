<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://github.com/Yogesh-Gupta-tech2globe
 * @since      1.0.0
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/admin/partials
 */
if(isset($_GET['template'])){
    $templateId = $_GET['template'];
}else{
    $templateId = '';
}

if(isset($_GET['action']) && isset($_GET['product_id'])){
    $action = $_GET['action'];
    $product_id = $_GET['product_id'];
}else{
    $action = '';
    $product_id = '';
}
?>

<div class="wrap">
    <div class="container">

        <?php include('header.php'); ?>
        
        <?php
        if($templateId == 1){
            include('templates/template1.php');
        }else if($templateId == 2){
            include('templates/template2.php');
        }else if($templateId == 3){
            include('templates/template3.php');
        }else if($templateId == "custom"){
            include('custom-template.php');
        }else if($action == "edit" && !empty($product_id)){
            include('edit-template.php');
        }else{
            include('aplus-content-admin-templates.php');
        }
        ?>
    </div>
</div>
