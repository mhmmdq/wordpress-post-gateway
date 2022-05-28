<?php
use Mhmmdq\EcommerceApi\GateWay;
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'GateWay_Calculate_Shipping' ) ) {

    class GateWay_Calculate_Shipping extends WC_Shipping_Method {

        public function __construct() {

            $this->id = 'GateWay_Calculate_Shipping';
            $this->method_title  = __( 'حمل نقل با وب سرویس پست' );
            $this->method_description = __( 'محابه نرخ ارسال با وب سرویس پست' ); 
            $this->init();
            
        }

        public function init() {

            $this->init_form_fields();
            $this->init_settings();

            $this->enabled = $this->get_option( 'enabled' );
            $this->title = $this->get_option( 'title' );
            $this->extra_cost = $this->get_option( 'extra_cost' );
            $this->extra_cost_percent = $this->get_option( 'extra_cost_percent' );
            $this->source_state = $this->get_option( 'source_state' );
            $this->current_currency = get_woocommerce_currency();
            $this->current_weight_unit = get_option('woocommerce_weight_unit'); 

            add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
        }

        public function init_form_fields() {
            
            $this->form_fields = array(
                'enabled' => array(
                'title' => __( 'Enable/Disable', 'woocommerce' ),
                'type' => 'checkbox',
                'label' => __( 'فعال سازی محاسبه نرخ ارسال با وب سرویس وب سرویس پست', 'woocommerce' ),
                'default' => 'no',
                ),
                'title' => array(
                'title' => __( 'عنوان نمایشی برای کاربر', 'woocommerce' ),
                'type'  => 'text',
                'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
                'default' => __( 'پست سفارشی' ),
                'desc_tip' => true
                )
            );

        }

        public function getCityCode( $stateName , $cityName )
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'gateway_citise';
            $query = "SELECT * FROM $table_name WHERE state_name = '{$stateName}' AND city_name = '{$cityName}'";
            $result = $wpdb->get_results($query , ARRAY_A); 
            return $result[0]['city_code'];
        }

        public function calculate_shipping( $package = [] ) {
            global $woocommerce;
            global $GateWayDefaultPrice;
            global $GateWay;
            
            $price = 0;
            $weight = [];
            $stores = [];
            $extra_price = 0;
            $collect_price = 0;
            $packing_price = 0;
            $packging_price_ratio = 0;
            $package_total_price = [];
            $GateWayPrice = 0;
            
            foreach ($package['contents'] as $item_id => $values) {

                $_product = $values['data'];
                $store_id = get_post_field( 'post_author', $_product->get_id());

                if(!isset($package_total_price[$store_id])){
                    $package_total_price[$store_id] = 0;
                }

                if(!isset($weight[$store_id])){
                    $weight[$store_id] = 0;
                }

                $package_total_price[$store_id] +=  ($_product->get_price() * $values['quantity']);
                $weight[$store_id] += ($_product->get_weight() * $values['quantity']);

                $stores[$store_id] = [
                    'store_id' => $store_id,
                    'store_gateway_shop_id' => get_user_meta($store_id, 'gateway_code', true),
                    'store_packging_price' => get_user_meta($store_id, 'packging_price', true),
                    'store_packging_price_ratio_type' => get_user_meta($store_id, 'packging_price_ratio_type', true),
                    'store_packging_price_ratio' => get_user_meta($store_id, 'packging_price_ratio', true),
                    'store_packging_collect_price' => esc_attr( get_the_author_meta( 'packging_collect_price', $store_id ) ),
                    'store_extra_price' => get_user_meta($store_id, 'extra_price', true),
                    'store_deliver_price_free' => get_user_meta($store_id, 'deliver_price_free', true),
                    'store_active' => get_user_meta($store_id, 'get_code_from_gateway_need', true),
                    'weight' => $weight[$store_id]
                ];
                if(is_numeric($stores[$store_id]['store_packging_collect_price']) && $stores[$store_id]['store_active'] == 1) {
                    $collect_price += $stores[$store_id]['store_packging_collect_price'];
                }
                if(is_numeric($stores[$store_id]['store_extra_price']) && $stores[$store_id]['store_active'] == 1) {
                    $extra_price += $stores[$store_id]['store_extra_price'];
                }
                
                $packing_price_range_product = get_post_meta($_product->get_id(), '_mhmmdq_product_packing_price', true);
                if(!empty($packing_price_range_product)){
                    
                    $packing_price_range_product = explode(',', $packing_price_range_product);
                    foreach($packing_price_range_product as $packing_price_range){
                        $packing_price_range = explode(':', $packing_price_range);
                        
                        if( (( $_product->get_weight() ) * $values['quantity']) <= $packing_price_range[0] ){
                            $packging_price_ratio += $packing_price_range[1];
                            break;
                        }
                    }

                }
                else
                {
                    $paking_price_range = get_user_meta($store_id, 'packging_price_ratio', true);
                    $paking_price_range = explode(',', $paking_price_range);
                    foreach($paking_price_range as $packing_price_range){
                        $packing_price_range = explode(':', $packing_price_range);
                        
                        if( ($weight[$store_id]) <= $packing_price_range[0] ){
                            $packging_price_ratio += $packing_price_range[1];
                            break;
                        }
                    }
                }

                

            }
            $countries = new WC_Countries(); 
            $country_states = $countries->get_states( $package['destination']['country'] ); // Get the states array from a country code
            $state_name     = $country_states[$package['destination']['state']];
            $city_name = $package['destination']['city'];
            if($city_name == ''){
                return false;
            }
            // var_dump( $city_name );
            $free_stores = [];
            foreach($stores as $store_id => $store) {

                     $GateWayPriceJsonData = $GateWay->MakePrice($this->getCityCode($state_name , $city_name),
                     false, 1,$package_total_price[$store_id],1,false,$stores[$store_id]['store_gateway_shop_id'],
                     $stores[$store_id]['weight'] , true); 

                    if($store['store_deliver_price_free'] == 0) {
                        $free_stores[] = $store_id;
                    }
                    else
                    {
                        if( $store['store_active'] == '1' ) {
                            $res = $GateWay->GetPrice($GateWayPriceJsonData);
                            if( isset($res) && !empty($res) && !is_null($res) ) {
                                $res = json_decode($res, true);
                                $GateWayPrice = $res['TotalPrice'] / 10;
                            }else {
                               
                            }
                        }else {
                            $err = 0;
                        }
                        
                    }

            }

            $stores = apply_filters('Gatway_Calculate_Shipping_stores', $stores);

            $GateWayDefaultPrice = apply_filters('Gatway_Defualt_Price', $GateWayDefaultPrice);

            if(count($free_stores) == 0) {
                $price += $extra_price;
            }else {
                foreach($free_stores as $free_store) {
                    if(is_numeric($stores[$free_store]['store_extra_price'])) {
                        $packing_price += $stores[$free_store]['store_extra_price'];
                    }
                }
                $extra_price = 0;
                foreach($stores as $store)
                {
                    if(!in_array($store['store_id'], $free_stores))
                    {
                        $extra_price += $store['store_extra_price'];
                    }
                }

                $price += $extra_price;
            }



            if($packging_price_ratio > 0) {
                $packging_price_ratio = apply_filters('GateWay_Packing_Price' , $packging_price_ratio);
                $woocommerce->cart->add_fee('هزینه بسته بندی', $packging_price_ratio);
            }

            if($packing_price > 0) {
                $packing_price = apply_filters('GateWay_Collect_Price' , $packing_price);
                $woocommerce->cart->add_fee('هزینه جمع آور', $packing_price);
            }


                if($GateWayPrice == 0) {
                    
                    if(!isset($err))
                    {
                        $price += $GateWayDefaultPrice;
                    }else
                    {
                        $price = 1;
                    }

                }elseif ($GateWayPrice > 0) {
                    $price += $GateWayPrice;
                }


            $rate = array(
                'id'       => $this->id,
                'label'    => $this->title,
                'cost'     => $price,
                'calc_tax' => 'per_item',
                'package' => $package
            );

           
            $this->add_rate( $rate );


        }

    }
}

function GateWay_Shipping_Method_Init( $methods )
{
    $methods[] = 'GateWay_Calculate_Shipping';
    return $methods;
}

add_filter( 'woocommerce_shipping_methods', 'GateWay_Shipping_Method_Init' );



