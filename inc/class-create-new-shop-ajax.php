<?php

if( !class_exists( "GateWay_Create_New_Shop_Ajax" ) )
{
    class GateWay_Create_New_Shop_Ajax {

        public function __construct()
        {
            add_action( 'wp_ajax_post_gateway_create_shop', [ $this , 'create_new_shop' ] );
            add_action( 'wp_ajax_nopriv_post_gateway_create_shop', [ $this , 'create_new_shop' ] );
        }

        public function create_new_shop() {
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                global $GateWay;
                $_POST['ShopID'] = isset($_POST['ShopID']) ? $_POST['ShopID'] : null;
                $post = $GateWay->RegisterShop(
                    $_POST['ShopID'],
                    $_POST['ShopUsername'],
                    $_POST['Shopname'],
                    $_POST['Phone'],
                    $_POST['PostalCode'],
                    null , 
                    null ,
                    $_POST['ManagerNationalID'],
                    $_POST['ManagerNationalIDSerial'],
                    $_POST['ManagerBirthDate'],
                    $_POST['Mobile'],
                    null,
                    null,
                    null,
                    $_POST['StartDate'],
                    $_POST['EndDate'],
                    null,
                    $_POST['CityID'],
                    null,
                    null,
                    null,
                    $_POST['NeedToCollect']
                );
                
                echo json_encode( [ 'status' => 'success' , 'post' => $post ] );

            }

        exit;
        }

    }
}