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
                $_POST['ShopID'] = isset($_POST['ShopID']) ? $_POST['ShopID'] : "";
                $post = $GateWay->RegisterShop(
                    $_POST['ShopID'],
                    $_POST['ShopUsername'],
                    $_POST['Shopname'],
                    $_POST['Phone'],
                    $_POST['PostalCode'],
                    "" , 
                    "" ,
                    $_POST['ManagerNationalID'],
                    $_POST['ManagerNationalIDSerial'],
                    $_POST['ManagerBirthDate'],
                    $_POST['Mobile'],
                    "",
                    "",
                    "",
                    $_POST['StartDate'],
                    $_POST['EndDate'],
                    "",
                    $_POST['CityID'],
                    "",
                    "",
                    "",
                    $_POST['NeedToCollect']
                );
                header('Content-Type: application/json');
                $post = json_decode($post , true);
                if( isset($post['ShopID']) ) {
                    echo json_encode( [ 'status' => 'success' , 'message' => 'فروشگاه با موفقیت ویرایش شد.' , 'shop_id' => $post['ShopID'] ] );
                }
                else {
                    echo json_encode( [ 'status' => 'fail' , 'message' => $post['Message']] );
                }



            }

        exit;
        }

    }
}