<?php
/*
Plugin Name: ارتباط با وب سرویس پست
Plugin URI: https://github.com/mhmmdq/wordpress-ecommerce-api-plugin
Description: برای مدیریت api ورژن هفت وب سرویس اداره پست
Author: Mhmmdq
Version: 0.0.5
Author URI: https://github.com/mhmmdq
*/

use Mhmmdq\EcommerceApi\GateWay;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once 'vendor/autoload.php';
include_once 'inc/functions.php';

define( 'QPGWT_URL' , plugins_url( __FILE__ ) );
define( 'QPGWT_BASEPATH' , __DIR__ . '/' );
define( 'QPGWT_VERSION' , '1.0.0' );



include_once 'inc/class-database.php';
new Mhmmdq_Post_GateWay_DataBase;

$GateWayUsername = Mhmmdq_Post_GateWay_DataBase::getConfig('gateway_username');
$GateWayPassword = Mhmmdq_Post_GateWay_DataBase::getConfig('gateway_password');
$GateWaySeceretKey = Mhmmdq_Post_GateWay_DataBase::getConfig('gateway_secretkey');
$GateWayDefaultPrice = Mhmmdq_Post_GateWay_DataBase::getConfig('gateway_default_price');



include_once 'inc/class-admin-setting-pages.php';
include_once 'inc/class-admin-setting.php';
new Mhmmdq_Post_GateWay_Admin_Setting;


if( !empty($GateWayUsername) && !empty($GateWayPassword) && !empty($GateWaySeceretKey) )
{
	$GateWay = new GateWay($GateWayUsername, $GateWayPassword, $GateWaySeceretKey);

	include_once 'inc/class-profile-setting.php';
	include_once 'inc/class-gateway.php';
	include_once 'inc/class-states-cities-database.php';
	include_once 'inc/class-states-cities.php';
	include_once 'inc/class-factor-databse.php';
	include_once 'inc/class-tracking-packages.php';
	include_once 'inc/class-order-post-box.php';
	include_once 'inc/class-admin-routes.php';
	include_once 'inc/class-product-opations.php';
	include_once 'inc/class-user-order-table.php';
	include_once 'inc/class-custom-order-status.php';
	include_once 'inc/class-order-post-box-add-manual.php';
	include_once 'inc/class-order-customer-details.php';
	include_once 'inc/class-create-new-shop-ajax.php';
	include_once 'inc/class-ajax-update-users-meta.php';
	include_once 'inc/class-ajax-get-city-code.php';

	new Mhmmdq_Post_GateWay_Profile_Setting;
	new Mhmmdq_Post_GateWay_Service;
	new Mhmmdq_Post_Mhmmdq_Post_GateWay_States_Cities_Database;
	new Mhmmdq_Post_GateWay_States_Cities;
	new Mhmmdq_Post_GateWay_Factors_Databse;
	new Mhmmdq_Post_GateWay_Tracking_Packages;
	new Mhmmdq_Post_GateWay_Order_Post_Box;
	new Mhmmdq_Post_GateWay_Admin_Routes;
	new Mhmmdq_Post_GateWay_Product_Options;
	new Mhmmdq_Post_GateWay_Create_Table_On_Order_Details_Page;
	new Mhmmdq_Custom_Order_Status;
	new Mhmmdq_Post_GateWay_Order_Post_Box_Manual;
	new Mhmmdq_Post_GateWay_Order_Customer_Box;
	new GateWay_Create_New_Shop_Ajax;
	new GateWay_Update_Users_Meta_Ajax;
	new GateWay_Get_City_Code_Ajax;

	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		function gateway_load_shipping_method() {
			include 'inc/class-calculate-shipping-method.php';
		}
		add_action('woocommerce_shipping_init' , 'gateway_load_shipping_method');
	}
}





