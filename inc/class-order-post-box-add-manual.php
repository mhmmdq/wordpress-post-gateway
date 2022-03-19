<?php

if(!class_exists('Mhmmdq_Post_GateWay_Order_Post_Box_Manual')) {

    class Mhmmdq_Post_GateWay_Order_Post_Box_Manual {

        public function __construct() {

            add_action( 'add_meta_boxes', [ $this, 'gateway_box' ] );

        }

        public function gateway_box( $post ) {

            add_meta_box(
                'gateway_box_manual',
                'سرویس پست ثبت دستی',
                [ $this, 'gateway_box_html' ],
                'shop_order',
                'side',
                'high'
            );

        }

        public function gateway_box_html( $post )
        {
            global $wpdb;
            $order = new WC_Order( $post->ID );
            $stores = [];
            foreach($order->get_items() as $item) {
                $stores[get_post_field( 'post_author', $item['product_id'])] = get_post_field( 'post_author', $item['product_id']);
            }

            if(count($stores) > 1) {
                echo '<p>برای سفارش های چند فروشنده امکان ثبت فاکتور وجود ندارد</p>';
                return;
            }else
            {
                $get_code_from_gateway_need = get_user_meta( get_post_field( 'post_author' , $item['product_id'] ) , 'get_code_from_gateway_need' , true );
                if( !empty($get_code_from_gateway_need) )
                {
                    if( $get_code_from_gateway_need == '1' )
                    {
                        $gateway_code = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}mhmmdq_gateway_factor` WHERE `order_id` = '{$post->ID}'");
                        mhmmdq_gateway_post_view('admin.metabox-orders-gateway-code' , ['barcode' => $gateway_code[0] , 'order_id' => $post->ID]);
                    }
                    else
                    {
                        echo '<p style="font-weight: bold;">برای این فروشنده باید به صورت دستی کد را ثبت کنید</p>';
                        $gateway_code = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}mhmmdq_gateway_factor` WHERE `order_id` = '{$post->ID}'");
                        mhmmdq_gateway_post_view('admin.metabox-orders-gateway-code' , ['barcode' => $gateway_code[0] , 'order_id' => $post->ID]);
                    }
                }
                else
                {
                    mhmmdq_gateway_post_view('admin.metabox-orders' , [
                        'order_id' => $post->ID
                    ]);
                }
                
            }

        }

    }

}