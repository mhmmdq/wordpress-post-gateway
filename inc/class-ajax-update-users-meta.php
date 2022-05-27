<?php

if( !class_exists( "GateWay_Update_Users_Meta_Ajax" ) )
{
    class GateWay_Update_Users_Meta_Ajax {

        public function __construct()
        {
            add_action( 'wp_ajax_gateway_update_user_meta', [ $this , 'update_user_meta' ] );
            add_action( 'wp_ajax_nopriv_gateway_update_user_meta', [ $this , 'update_user_meta' ] );
        }

        public function update_user_meta() {
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            
                $user_id = intval( $_POST['user_id'] );
                unset( $_POST['user_id'] );
                $user_meta = $_POST;
                foreach( $user_meta as $key => $value ) {
                    update_user_meta( $user_id, $key, $value );
                }
                wp_send_json_success( 'با موفقیت بروزرسانی شد' );
            }

            exit;
        }

    }
}