<?php

if( !class_exists( 'Mhmmdq_Custom_Order_Status' ) )
{
    class Mhmmdq_Custom_Order_Status {

        public function __construct()
        {
            add_filter('init', [ $this, 'register_status' ] );
            add_filter( 'wc_order_statuses' , [ $this, 'add_status' ] );
        }

        public function register_status() {

            register_post_status( 'wc-add-in-panel', array(
                'label'                     => 'ثبت دستی شده',
                'public'                    => true,
                'exclude_from_search'       => false,
                'show_in_admin_all_list'    => true,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop( 'Approved (%s)', 'Approved (%s)', 'text_domain' )
            ) );

        }

        public function add_status( $order_statuses ) {

            $order_statuses['wc-add-in-panel'] = 'ثبت دستی شده';
            return $order_statuses;

        }

    }
}