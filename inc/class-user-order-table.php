<?php

if( !class_exists( "Mhmmdq_Post_GateWay_Create_Table_On_Order_Details_Page" ) )
{

    class Mhmmdq_Post_GateWay_Create_Table_On_Order_Details_Page {

        public function __construct()
        {
            add_action( 'woocommerce_order_details_after_order_table' , [ $this , 'create_table_on_order_details_page' ] );
        }

        public function create_table_on_order_details_page( $order )
        {
            global $woocommerce;
            global $wpdb;
            $order_id = $order->get_id();
            $products = $order->get_items();
            $order_details = [];
            $order_ids = dokan_get_suborder_ids_by( $order_id );
            
            if( @count($order_ids) == 0 )
            {
                foreach( $products as $product )
                {
                    $product_data = $product->get_data();
                    $product_id = $product_data['product_id'];
                    $store_id = get_post_field( 'post_author',  $product_data['product_id'] );
                    $store_name = get_user_meta( $store_id ,'nickname' ,true );
                    
                    // get barcode from database
                    @$barcode = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = {$order_id}" , ARRAY_A )[0]['barcode']; 

                    $order_details[$store_id] = [
                        'order_id' => $order_id,
                        'id' => $product_data['product_id'],
                        'store_id' => $store_id,
                        'store_name' => $store_name,
                        'barcode' => $barcode,
                    ];
                }

            }
            else
            {
                
                foreach( $order_ids as $order_id )
                {
                    $order_id = $order_id->ID;
                    $products = wc_get_order($order_id)->get_items();
                    foreach( $products as $product )
                    {
                        $product_data = $product->get_data();
                        $product_id = $product_data['product_id'];
                        $store_id = get_post_field( 'post_author',  $product_data['product_id'] );
                        $store_name = get_user_meta( $store_id ,'nickname' ,true );
                        
                        // get barcode from database
                        $barcode = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = {$order_id}" , ARRAY_A )[0]['barcode']; 

                        $order_details[$store_id] = [
                            'order_id' => $order_id,
                            'product_id' => $product_data['product_id'],
                            'store_id' => $store_id,
                            'store_name' => $store_name,
                            'barcode' => $barcode,
                        ];
                    }
                }
            }

            
            

            mhmmdq_gateway_post_view('user-order-table', [ 'order' => $order_details ]);
        }
    }
}