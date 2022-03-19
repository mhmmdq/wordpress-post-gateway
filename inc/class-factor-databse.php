<?php

if( !class_exists('Mhmmdq_Post_GateWay_Factors_Databse') )
{
    class Mhmmdq_Post_GateWay_Factors_Databse
    {
        protected $tablename = 'mhmmdq_gateway_factor';
        protected $sql = "CREATE TABLE `{prefix}mhmmdq_gateway_factor` ( `id` INT NOT NULL AUTO_INCREMENT , `order_id` TEXT NOT NULL , `barcode` TEXT NOT NULL , `time` TEXT NULL , `date` TEXT NULL , `price` TEXT NOT NULL , `tax` TEXT NOT NULL , PRIMARY KEY (`id`));";

        public function __construct()
        {
            if(!$this->table_exists())
                if(!$this->create_table())
                    $this->show_notic();
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

        public static function AddFactor( $order_id , $code)
        {
            global $wpdb;
            $wpdb->insert(
                $wpdb->prefix . 'mhmmdq_gateway_factor',
                [
                    'order_id' => $order_id,
                    'gateway_code' => $code,
                    'date' => date('Y-m-d'),
                    'time' => date('H:i:s'),
                ]
            );
        }

        public function GenerateFactorNumber()
        {

        }
    }
}