<?php 

if( !class_exists('Mhmmdq_Post_GateWay_Product_Options') ) {

    class Mhmmdq_Post_GateWay_Product_Options {

        public function __construct()
        {
            add_action( 'woocommerce_product_options_general_product_data', [ $this, 'add_packing_price' ] );
            add_action('woocommerce_process_product_meta', [ $this, 'save_packing_price' ] );
        }

        public function add_packing_price()
        {
            global $woocommerce, $post;
            echo '<div class=" product_custom_field ">';
                woocommerce_wp_text_input(
                    [
                        'id' => '_mhmmdq_product_packing_price',
                        'placeholder' => '1:3000,5:50000',
                        'label' => __('رنج بسته بندی را مشخص کنید', 'woocommerce'),
                        'desc_tip' => 'true'
                    ]
                );
            echo '</div>';
        }

        public function save_packing_price( $post_id )
        {
            $packing_price = $_POST['_mhmmdq_product_packing_price'];
            update_post_meta( $post_id, '_mhmmdq_product_packing_price', esc_attr( $packing_price ) );
        }

    }

}