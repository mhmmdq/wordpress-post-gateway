<?php

if( !class_exists( "gateWay_Get_City_Code_Ajax" ) )
{
    class gateWay_Get_City_Code_Ajax {

        public function __construct()
        {
            add_action( 'wp_ajax_gateway_get_city_code', [ $this , 'update_user_meta' ] );
            add_action( 'wp_ajax_nopriv_gateway_get_city_code', [ $this , 'update_user_meta' ] );
        }

        public function getCityCode( $stateName , $cityName )
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'gateway_citise';
            $query = "SELECT * FROM $table_name WHERE state_name = '$stateName' AND city_name = '$cityName'";
            $result = $wpdb->get_results($query , ARRAY_A); 
            return $result[0]['city_code'];
        }

        public function update_user_meta() {
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            
                $state_name = $_POST['state_name'];
                $city_name = $_POST['city_name'];
                $city_code = $this->getCityCode( $state_name , $city_name );
                wp_send_json_success( $city_code );
                
            }

            exit;
        }

    }
}