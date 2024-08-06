<?php
if ( ! class_exists('WP_List_Table') ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class A_PLUS_CONTENT_PRODUCTS_TABLE extends WP_List_Table {

    public function __construct() {
        parent::__construct(array(
            'singular' => 'product',
            'plural'   => 'products',
            'ajax'     => false,
        ));
    }

    public function get_columns() {
        return array(
            'product_id'                => 'Product ID',
            'product_name'              => 'Product Name',
            'aplus_content_created'     => 'A+ Content Created',
        );
    }

    public function get_sortable_columns() {
        return array(
            'product_id'        => array('product_id', false),
            'product_name'      => array('product_name', false),
            'aplus_content_created' => array('aplus_content_created', false),
        );
    }

    public function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = array();
        $sortable = $this->get_sortable_columns();
        
        $this->_column_headers = array($columns, $hidden, $sortable);

        $per_page = $this->get_items_per_page('products_per_page', 5);
        $current_page = $this->get_pagenum();

        $search_term = !empty($_REQUEST['s']) ? sanitize_text_field($_REQUEST['s']) : '';

        // Example data - replace with real data from WooCommerce
        $data = array(
            array('product_id' => '101', 'product_name' => 'Product One', 'aplus_content_created' => 'Yes'),
            array('product_id' => '102', 'product_name' => 'Product Two', 'aplus_content_created' => 'No'),
            array('product_id' => '103', 'product_name' => 'Product Three', 'aplus_content_created' => 'Yes'),
            array('product_id' => '104', 'product_name' => 'Product Four', 'aplus_content_created' => 'No'),
            array('product_id' => '105', 'product_name' => 'Product Five', 'aplus_content_created' => 'Yes'),
            array('product_id' => '105', 'product_name' => 'Product Six', 'aplus_content_created' => 'Yes'),
        );

        // Apply search filter
        if ($search_term) {
            $data = array_filter($data, function($item) use ($search_term) {
                return strpos($item['product_name'], $search_term) !== false;
            });
        }

        // Handle sorting
        $orderby = !empty($_REQUEST['orderby']) ? sanitize_key($_REQUEST['orderby']) : 'product_id';
        $order = !empty($_REQUEST['order']) ? sanitize_key($_REQUEST['order']) : 'asc';

        usort($data, function($a, $b) use ($orderby, $order) {
            if ($order == 'asc') {
                return strcmp($a[$orderby], $b[$orderby]);
            } else {
                return strcmp($b[$orderby], $a[$orderby]);
            }
        });

        // Pagination
        $total_items = count($data);
        $data = array_slice($data, (($current_page-1) * $per_page), $per_page);

        $this->items = $data;
        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil($total_items / $per_page),
        ));
    }

    protected function column_default($item, $column_name) {
        switch ($column_name) {
            case 'product_id':
            case 'product_name':
                return $item[$column_name];
            case 'aplus_content_created':
                if ($item[$column_name] === 'Yes') {
                    return '<span class="text-success">●</span> Yes';
                } else {
                    return '<span class="text-danger">●</span> No';
                }
            default:
                return print_r($item, true);
        }
    }

    protected function column_product_name($item) {
        return $item['product_name'];
    }
}
