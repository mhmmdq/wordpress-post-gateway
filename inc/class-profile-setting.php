<?php

if( !class_exists('GatwWay_Profile_Setting') ) {

    class Mhmmdq_Post_GateWay_Profile_Setting {

        public function __construct()
        {
            add_action( 'show_user_profile', [ $this, 'user_profile_template' ] );
            add_action( 'edit_user_profile', [ $this, 'user_profile_template' ] );
            
            add_action( 'personal_options_update', [ $this, 'save_extra_user_profile_fields' ] );
            add_action( 'edit_user_profile_update', [ $this, 'save_extra_user_profile_fields' ] );
        }

        public function user_profile_template( $user )
        {
            mhmmdq_gateway_post_view('admin.profile' , [ 'user' => $user ]);
        }

        public function save_extra_user_profile_fields( $user_id )
        {
            if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
                return;
            }
            
            if ( !current_user_can( 'edit_user', $user_id ) ) { 
                return false; 
            }
            update_user_meta( $user_id, 'gateway_code', $_POST['gateway_code'] );
            update_user_meta( $user_id, 'packging_price_ratio_type', $_POST['packging_price_ratio_type'] );
            update_user_meta( $user_id, 'packging_price_ratio', $_POST['packging_price_ratio'] );
            update_user_meta( $user_id, 'packging_collect_price', $_POST['packging_collect_price'] );
            update_user_meta( $user_id, 'extra_price', $_POST['extra_price'] );
            update_user_meta( $user_id, 'deliver_price_free', $_POST['deliver_price_free'] );
            update_user_meta( $user_id, 'is_need_to_collect', $_POST['is_need_to_collect'] );
            update_user_meta( $user_id , 'get_code_from_gateway_need' , $_POST['get_code_from_gateway_need']);
        }

    }

}