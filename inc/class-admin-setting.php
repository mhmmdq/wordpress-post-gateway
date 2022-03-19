<?php

if( !class_exists('Mhmmdq_Post_GateWay_Admin_Setting') ) {

    class Mhmmdq_Post_GateWay_Admin_Setting extends GateWay_Admin_Pages {

        public function __construct()
        {
            add_action( 'admin_menu', [ $this, 'admin_menu' ] );
        }

        public function admin_menu()
        {
            add_menu_page(
                'تنظیمات GateWay',
                'وب سرویس پست',
                'edit_posts',
                'gateway-post-api',
                [ $this, 'gateway_page' ],
                "https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/18/ffffff/external-link-business-and-management-kiranshastry-lineal-kiranshastry.png" 
		        , 1
            );

            $submenus = [
                10 => [
                    'title' => 'پیکربندی',
                    'capability' => 'edit_posts' ,
                    'slug' => 'gatewat-post-api-setting',
                    'callback' => [ $this, 'gateway_setting_page' ]
                ],
                20 => [
                    'title'      => 'فروشگاه ها',
                    'capability' => 'edit_posts',
                    'slug'       => 'gateway-post-api-shops',
                    'callback'   => [ $this, 'gateway_shop_list_page' ],
                ],
                25 => [
                    'title'      => 'ثبت فروشگاه جدید',
                    'capability' => 'edit_posts',
                    'slug'       => 'gateway-post-api-shops-add',
                    'callback'   => [ $this, 'gateway_shop_create' ],
                ]
            ];
            
            $submenus = apply_filters('gateway_submenu' , $submenus );

            foreach( $submenus as $submenu ) {
                add_submenu_page(
                    'gateway-post-api',
                    $submenu['title'],
                    $submenu['title'],
                    $submenu['capability'],
                    $submenu['slug'],
                    $submenu['callback']
                );
            }

        }


    }

}