<?php

if( !class_exists( "GateWay_Create_New_Shop_Ajax" ) )
{
    class GateWay_Create_New_Shop_Ajax {

        public function __construct()
        {
            add_action( 'wp_ajax_post_gateway_create_shop', [ $this , 'create_new_shop' ] );
            add_action( 'wp_ajax_nopriv_post_gateway_create_shop', [ $this , 'create_new_shop' ] );
        }

        public function create_new_shop() {
            if( $_SERVER['REQUEST_METHOD'] == 'get' ) {
                echo json_encode([
                    'status' => 'success',
                ]);
        }
        exit;
        }

    }
}