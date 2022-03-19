<?php

use Elementor\Core\Admin\Admin_Notices;

if( !class_exists('Mhmmdq_Post_GateWay_DataBase') ) {

    class Mhmmdq_Post_GateWay_DataBase {

        protected $tablename = 'mhmmdq_gateway_config';
        protected $sql = "CREATE TABLE `{prefix}mhmmdq_gateway_config` ( `id` INT NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `value` TEXT NOT NULL , PRIMARY KEY (`id`));";

        public function __construct()
        {
            if(!$this->table_exists())
                if(!$this->create_table())
                    $this->show_notic();
                else
                    $this->insert_defult_recordes();
        }

        protected function create_table()
        {
            global $wpdb;

            $wpdb->query( str_replace('{prefix}' , $wpdb->prefix , $this->sql) );

            return $this->table_exists();

        }

        protected function table_exists()
        {
            global $wpdb;
            $query = $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $wpdb->prefix . $this->tablename ) );
 
            if ( $wpdb->get_var( $query ) === $wpdb->prefix . $this->tablename ) 
            {
                return true;
            }
            
            return false;
        }

        protected function show_notic()
        {
            add_action( 'admin_notices', function() {
                $message = 'ساخت حدول پایگاه داده برای افزونه وب سرویس پست شکست خورد بدون وجود جدول تنظیمات امکان عملکرد صحیح وجود ندارد';
                $html_message = sprintf( '<div class="notice notice-error" style="padding:10px;"> %s </div>', $message);
                echo $html_message;
            });
        }

        protected function insert_defult_recordes()
        {
            global $wpdb;

            $wpdb->insert( $wpdb->prefix . $this->tablename , [
                'name' => 'gateway_username',
                'value' => ''
            ]);

            $wpdb->insert( $wpdb->prefix . $this->tablename , [
                'name' => 'gateway_password',
                'value' => ''
            ]);

            $wpdb->insert( $wpdb->prefix . $this->tablename , [
                'name' => 'gateway_secretkey',
                'value' => ''
            ]);

            $wpdb->insert( $wpdb->prefix . $this->tablename , [
                'name' => 'gateway_default_price',
                'value' => ''
            ]);
        }

        public static function getConfig( $name )
        {
            global $wpdb;
            return $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}mhmmdq_gateway_config` WHERE `name` = '{$name}'" )[0]->value;
        }

        public static function updateConfig( $name )
        {

        }

    }

}