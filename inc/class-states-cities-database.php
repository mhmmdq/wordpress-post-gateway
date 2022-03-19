<?php

use Elementor\Core\Admin\Admin_Notices;

if( !class_exists('Mhmmdq_Post_Mhmmdq_Post_GateWay_States_Cities_Database') ) {

    class Mhmmdq_Post_Mhmmdq_Post_GateWay_States_Cities_Database {

        protected $tablename = 'gateway_citise';
        protected $sql = "CREATE TABLE `{prefix}gateway_citise` ( `id` INT NOT NULL AUTO_INCREMENT , `state_name` TEXT NOT NULL , `city_name` TEXT NOT NULL , `state_code` VARCHAR(10) NOT NULL , `city_code` TEXT NOT NULL , PRIMARY KEY (`id`));";

        public function __construct()
        {
            if(!$this->table_exists())
                if(!$this->create_table())
                    $this->show_notic();
                else
                    $this->insert_rows_from_gateway_web_service();
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


        public function insert_rows_from_gateway_web_service()
        {
            global $GateWay;
            global $wpdb;
            
                //set time limit to unlimited
                set_time_limit(0);
            
                $states = json_decode($GateWay->GetStates() , true);

                foreach( $states as $state )
                {

                    $cities = json_decode($GateWay->GetStateCities($state['StateID']) , true);

                    foreach($cities as $city) {
                        $wpdb->insert( $wpdb->prefix . $this->tablename , [
                            'state_name' => $state['StateName'],
                            'state_code' => $state['StateID'],
                            'city_name' => $city['CityName'],
                            'city_code' => $city['CityID']
                        ]);
                    }
                }

                $this->fix_typing_rows();
            
            

        }

        public function fix_typing_rows()
        {
            global $wpdb;
            $query_cities = "UPDATE {$wpdb->prefix}{$this->tablename} set city_name = REPLACE(city_name , 'ي' , 'ی')";
            $query_states = "UPDATE {$wpdb->prefix}{$this->tablename} set state_name = REPLACE(state_name , 'ي' , 'ی')";

            $wpdb->query($query_cities);
            $wpdb->query($query_states);

        }

    }

}