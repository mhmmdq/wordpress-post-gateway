<?php

if(!class_exists('Mhmmdq_Post_GateWay_States_Cities')) {

    class Mhmmdq_Post_GateWay_States_Cities {

        public function __construct()
        {
            add_filter('gateway_submenu' , [ $this , 'add_states_citis_submenu' ] );
        }

        public function add_states_citis_submenu( $submenus )
        {
            $submenus[40] = [
                'title'      => 'استان ها و شهر ها',
                'capability' => 'edit_posts',
                'slug'       => 'gateway-post-api-states-cities',
                'callback'   => [ $this, 'Mhmmdq_Post_GateWay_States_Cities_page' ],
            ];

            return $submenus;
        }

        public function Mhmmdq_Post_GateWay_States_Cities_page()
        {
            // get result form wordpress database
            global $wpdb;
            $cities = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}gateway_citise LIMIT 0,20" , ARRAY_A);

            mhmmdq_gateway_post_view('admin.states-cities' , ['cities' => $cities]);
        }

    }

}