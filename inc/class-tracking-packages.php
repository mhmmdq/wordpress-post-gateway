<?php

if(!class_exists("Mhmmdq_Post_GateWay_Tracking_Packages")) {

    class Mhmmdq_Post_GateWay_Tracking_Packages {

        public function __construct()
        {
            add_filter('gateway_submenu' , [ $this , 'add_tracking_packages_submenu' ] );
        }

        public function add_tracking_packages_submenu( $submenus )
        {
            $submenus[50] = [
                'title'      => 'پیگیری بسته ها',
                'capability' => 'edit_posts',
                'slug'       => 'gateway-post-api-tracking-packages',
                'callback'   => [ $this, 'Mhmmdq_Post_GateWay_Tracking_Packages_page' ],
            ];

            return $submenus;
        }

        public function get_tracking_packages( $gateway_barcode )
        {
            global $GateWay;
            // $GateWay->GetParcelTrace()
        }

        public function Mhmmdq_Post_GateWay_Tracking_Packages_page()
        {
            $data = [];

            if(isset($_GET['gateway_barcode']))
            {
                $gateway_barcode = $_GET['gateway_barcode'];

                $data = $this->get_tracking_packages($gateway_barcode);
            }

            mhmmdq_gateway_post_view('admin.tracking-packages' , $data);
        }

    }

}