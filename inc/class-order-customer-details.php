<?php

if(!class_exists('Mhmmdq_Post_GateWay_Order_Customer_Box')) {

    class Mhmmdq_Post_GateWay_Order_Customer_Box {

        public function __construct() {

            add_action( 'add_meta_boxes', [ $this, 'gateway_box_customer' ] );

        }

        public function gateway_box_customer( $post ) {

            add_meta_box(
                'gateway_box_customer',
                'اطلاعات ارسالی به سمت سرویس پست - مشتری',
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
            $user_id = $order->get_user_id();
            $user_meta = get_user_meta($user_id);
            if(count($stores) > 1) {
                echo '<p>برای سفارش های چند فروشنده امکان ثبت فاکتور وجود ندارد</p>';
                return;
            }else
            {
                mhmmdq_gateway_post_view('admin.customer-meta-box' , [
                    'order_id' => $post->ID,
                    'user_meta' => $user_meta,
                    'user_id' => $user_id
                ]);
            }

        }

    }

}