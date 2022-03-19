<?php
use Mhmmdq\EcommerceApi\BarCode;
use Mhmmdq\EcommerceApi\Factor;
if(!class_exists("GateWay_Admin_Ajax")) {

    class Mhmmdq_Post_GateWay_Admin_Routes extends Mhmmdq_Post_GateWay_Service {


        public function __construct()
        {
	        include_once QPGWT_BASEPATH . 'inc/class-custom-route.php';
            $router = new GateWay_CustomRoutes;
            $router->addRoute(
                "^wp-admin/print-order/?",
                [$this, 'print_order']
            );
        }


        public function print_order()
        {
            if( !empty($_REQUEST['order-id']) && !empty($_REQUEST['action']) )
            {
                
                switch($_REQUEST['action'])
                {
                    case "show":
                        $this->addRequest( $_REQUEST['order-id'] );
                        break;
                    case "needToCollect":
                        $this->needToCollect( $_REQUEST['order-id'] );
                        break;
                    case "suspended":
                        $this->suspended( $_REQUEST['order-id'] );
                        break;
                    case "remove":
                        $this->remove( $_REQUEST['order-id'] );
                        break;
                    case "add":
                        echo $this->add( $_REQUEST['order-id'] );
                        break;

                }

            }
        }

    }

}