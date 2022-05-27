<?php
use Mhmmdq\EcommerceApi\BarCode;
use Mhmmdq\EcommerceApi\Factor;
if( !class_exists("Mhmmdq_Post_GateWay_Service") ) {
    
    class Mhmmdq_Post_GateWay_Service {

        public function getCityCode( $stateName , $cityName )
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'gateway_citise';
            $query = "SELECT * FROM $table_name WHERE state_name = '$stateName' AND city_name = '$cityName'";
            $result = $wpdb->get_results($query , ARRAY_A); 
            return $result[0]['city_code'];
        }

        public function addRequest( $order_id )
        {
            global $wpdb;
           
            $order = new WC_Order( $order_id );
            $customer = new WC_Customer( $order->get_customer_id() );
            $order_items = $order->get_items();

            $order_price = 0;
            $order_weight = 0;
            $order_name = '';
            $order_table = [];
            foreach( $order_items as $item ){

                $order_name = $order_name . '-' . $item['name'];
                $product = wc_get_product( $item['product_id'] );
                $store_id = get_post_field( 'post_author', $item['product_id']);
                $order_price += $item['total'] * 10;
                $order_weight += $product->get_weight() * $item['quantity'];
                
            }

            $customer_name = $customer->data['first_name'] . ' ' .  $customer->data['last_name'];
            $customer_family = $customer->data['last_name'];
            $customer_email = $customer->data['email'];
            $customer_phone = $customer->data['billing']['phone'];
            $customer_city = $customer->data['billing']['city'];
            $customer_state = $customer->data['billing']['state'];
            $customer_postcode = $customer->data['billing']['postcode'];
            $customer_address = $customer->data['billing']['address_1'] . ' ' . $customer->data['billing']['address_2'];

            $countries = new WC_Countries(); 
            $country_states = $countries->get_states( "IR" ); 
            $state_name     = $country_states[$customer_state];
            $city_name = $customer_city;


            $GateWay_Code = $wpdb->get_var("SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = '$order_id'");

            if ($GateWay_Code == NULL) {
				
				

				// var_dump($this->getCityCode($state_name , $city_name));

                global $GateWay;
                $GateWayPriceClass = $GateWay->MakePrice(
                    $this->getCityCode($state_name , $city_name),
                    false,
                    1,
                    $order_price,
                    1,
                    false,
                    get_user_meta($store_id, 'gateway_code', true),
                    $order_weight,
                    filter_var(get_user_meta($store_id, 'is_need_to_collect', true) , FILTER_VALIDATE_BOOLEAN),
                );
                $barcode = $GateWay->addRequest(
                    $order_id,
                    $GateWayPriceClass,
                    '',
                    $customer_name,
                    $customer_family,
                    $customer_phone,
                    $customer_email,
                    $customer_postcode,
                    $customer_address,
                    $order_name
                );

				
                

                $barcode = json_decode($barcode , true);
                
                if(isset($barcode['Message'])) {
                    echo "<h1 style='color:red;text-align:center;'> {$barcode['Message']} </h1>";
                    exit;
                }else {
                    $wpdb->insert( $wpdb->prefix . 'mhmmdq_gateway_factor' , [
                        'barcode' => $barcode['Barcode'],
                        'order_id' => $order_id,
                        'price' => $barcode['Info']['TotalPrice'],
                        'tax' => $barcode['Info']['Tax'],
                    ]);    
                }

                
                

            }
            
           

            
            $GateWay_Code = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = '$order_id'")[0];
            $vendor = new WP_User($store_id);
            $vendorState = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}gateway_citise WHERE state_name = '$vendor->billing_state' LIMIT 1")[0]->state_code;
            $order_parrent = new WC_Order($order->data['parent_id']);
            date_default_timezone_set('Asia/Tehran');
            $send_price = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = '{$order_id}'")[0]->price;
            foreach( $order_items as $item ) {
                
                $order_table[] = [
                    'product_name' => $item['name'],
                    'seller' => get_userdata($store_id)->display_name,
                    'quantity' => $item['quantity'],
                    'item_price' => $item['total'] * 10,
                    'send_price' => $send_price,
                    'price' => $item['total'],
                ];

            }
            $vendor = dokan_get_store_info($store_id);
            $date = jdate();
            $date = explode('-', $date);
            $date[2] = explode(' ', $date[2]);
            $date[2] = $date[2][0];
            $date = $date[2] . '-' . $date[1] . '-' . $date[0];
			$country_states = $countries->get_states( "IR" ); 
            $state_name_v     = $country_states[$vendor['address']['state']];
			
            new Factor(
                'ای تحفه',
                'https://etohfeh.com/wp-content/plugins/woocommerce-delivery-notes/templates/print-order/etohfeh-mini-logo.png',
                '07631013101',
                'etohfeh.com',
                'info@etohfeh.com',
                get_userdata($store_id)->display_name,
                $state_name_v,
                $vendor['address']['city'],
                $vendor['address']['street_1'],
                $order_id,
                $order_table , 
                $customer_name,
                $state_name,
                $city_name,
                $customer_address,
                $customer_phone,
                $order_parrent->customer_message,
                $customer_postcode,
                BarCode::make($GateWay_Code->barcode),
                $GateWay_Code->barcode,
                $order_weight,
                $date,
                date('H:i:s'),
                $GateWay_Code->price , 
                $GateWay_Code->tax,
                $vendorState
            );
           
           
        }

        public function needToCollect( $order_id )
        {
            global $wpdb;
            $barcode = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = '$order_id'")[0]->barcode;
            global $GateWay;
            echo $GateWay->ReadyToCollectRequests($barcode);
        }

        public function suspended( $order_id )
        {
            global $wpdb;
            $barcode = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = '$order_id'")[0]->barcode;
            global $GateWay;
            echo $GateWay->SuspendRequests($barcode);
        }

        public function remove( $order_id )
        {
            global $wpdb;
            $barcode = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = '$order_id'")[0]->barcode;
            
            global $GateWay;
            echo $GateWay->DeleteRequests($barcode);

            $wpdb->delete( $wpdb->prefix . 'mhmmdq_gateway_factor' , [
                'order_id' => $order_id
            ]);

        }

        public function add( $order_id )
        {
            global $wpdb;
            $GateWay_Code = $wpdb->get_var("SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = '$order_id'");
            if ($GateWay_Code == NULL) {
                $wpdb->insert( $wpdb->prefix . 'mhmmdq_gateway_factor' , [
                    'barcode' => $_REQUEST['barcode'],
                    'order_id' => $order_id,
                    'price' => $_REQUEST['price'] * 10,
                    'tax' => $_REQUEST['tax'],
                ]);
            }

            $order = new WC_Order( $order_id );
            $customer = new WC_Customer( $order->get_customer_id() );
            $order_items = $order->get_items();

            $order_price = 0;
            $order_weight = 0;
            $order_name = '';
            $order_table = [];
            foreach( $order_items as $item ){

                $order_name = $order_name . '-' . $item['name'];
                $product = wc_get_product( $item['product_id'] );
                $store_id = get_post_field( 'post_author', $item['product_id']);
                $order_price += $item['total'];
                $order_weight += $product->get_weight() * $item['quantity'];
                
            }

            $customer_name = $customer->data['first_name'];
            $customer_family = $customer->data['last_name'];
            $customer_email = $customer->data['email'];
            $customer_phone = $customer->data['billing']['phone'];
            $customer_city = $customer->data['billing']['city'];
            $customer_state = $customer->data['billing']['state'];
            $customer_postcode = $customer->data['billing']['postcode'];
            $customer_address = $customer->data['billing']['address_1'] . ' ' . $customer->data['billing']['address_2'];

            $countries = new WC_Countries(); 
            $country_states = $countries->get_states( "IR" ); 
            $state_name     = $country_states[$customer_state];
            $city_name = $customer_city;


            

           
           
            $vendor = new WP_User($store_id);
            $vendorState = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}gateway_citise WHERE state_name = '$vendor->billing_state' LIMIT 1")[0]->state_code;
            $order_parrent = new WC_Order($order->data['parent_id']);
            date_default_timezone_set('Asia/Tehran');
            $send_price = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}mhmmdq_gateway_factor WHERE order_id = '{$order_id}'")[0]->price;
            foreach( $order_items as $item ) {
                
                $order_table[] = [
                    'product_name' => $item['name'],
                    'seller' => get_userdata($store_id)->display_name,
                    'quantity' => $item['quantity'],
                    'item_price' => $item['total'] * 10,
                    'send_price' => $send_price,
                    'price' => $item['total'] * 10,
                ];

            }
            $date = jdate();
            $date = explode('-', $date);
            $date[2] = explode(' ', $date[2]);
            $date[2] = $date[2][0];
            $date = $date[2] . '-' . $date[1] . '-' . $date[0];

            new Factor(
                'ای تحفه',
                'https://etohfeh.com/wp-content/plugins/woocommerce-delivery-notes/templates/print-order/etohfeh-mini-logo.png',
                '07631013101',
                'etohfeh.com',
                'info@etohfeh.com',
                get_userdata($store_id)->display_name,
                $vendor->billing_state,
                $vendor->billing_address_1,
                $vendor->billing_postcode,
                $order_id,
                $order_table , 
                $customer_name,
                $state_name,
                $city_name,
                $customer_address,
                $customer_phone,
                $order_parrent->customer_message,
                $customer_postcode,
                BarCode::make($_REQUEST['barcode']),
                $_REQUEST['barcode'],
                $order_weight,
                $date,
                date('H:i:s'),
                $_REQUEST['price'] , 
                $_REQUEST['tax'],
                $vendorState
            );
        }


    }

}