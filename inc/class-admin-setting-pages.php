<?php
use Mhmmdq\EcommerceApi\GateWay;
if( !class_exists('GateWay_Admin_Pages') )
{

    abstract class GateWay_Admin_Pages {

        private function is_data_complated()
        {
            global $GateWayUsername;
            global $GateWayPassword;
            global $GateWaySeceretKey;
            return (!empty($GateWayUsername) && !empty($GateWayPassword) && !empty($GateWaySeceretKey));
            
        }

        public function gateway_setting_page()
        {
            global $GateWayUsername;
            global $GateWayPassword;
            global $GateWaySeceretKey;
            global $GateWayDefaultPrice;
            
                mhmmdq_gateway_post_view('admin.setting' , [
                    'GateWayUsername' => $GateWayUsername,
                    'GateWayPassword' => $GateWayPassword,
                    'GateWaySeceretKey' => $GateWaySeceretKey,
                    'GateWayDefaultPrice' => $GateWayDefaultPrice
                ]);
        }

        public function gateway_shop_list_page()
        {
            global $GateWayUsername;
            global $GateWayPassword;
            global $GateWaySeceretKey;

            if($this->is_data_complated())
            {
                $GateWay = new GateWay($GateWayUsername , $GateWayPassword , $GateWaySeceretKey);
                $shops = json_decode($GateWay->GetShopList() , true);
                
                if(isset($_GET['status']))
                {
                   
                    if($_GET['status'] == 'active')
                    {
                        $shops = array_filter($shops , function($shop) {
                            return $shop['ShopStatus'] == 'فعال';
                        });
                    }
                    else if($_GET['status'] == 'inactive')
                    {
                        $shops = array_filter($shops , function($shop) {
                            return $shop['ShopStatus'] != 'فعال';
                        });
                    }

                }

                mhmmdq_gateway_post_view('admin.shops' , [ 'shops' => $shops ]);
            }
            else
            {
                echo "<h5>قبل از ورود به بخش دیگر باید اطلاعات را تکمیل کنید</h5>";
                $this->gateway_setting_page();
                echo "<h5>توجه داشته باشید پس از ثبت صفحه را پایان بارگزاری کامل نبندید نرم افزار شروع به ذخیره لیست شهر های ایران میکند امکان دارد کمی زمان بر باشد</h5>";

            }
        }

        

        public function gateway_page()
        {
            if($this->is_data_complated())
            {
                mhmmdq_gateway_post_view('admin.info');
            }
            else
            {
                echo "<h5>قبل از ورود به بخش دیگر باید اطلاعات را تکمیل کنید</h5>";
                $this->gateway_setting_page();
                echo "<h5>توجه داشته باشید پس از ثبت صفحه را پایان بارگزاری کامل نبندید نرم افزار شروع به ذخیره لیست شهر های ایران میکند امکان دارد کمی زمان بر باشد</h5>";
            }
        }

        public function add_jquery()
        {
            wp_enqueue_script(
                array('jquery')
            );
        }

        public function gateway_shop_create() {
            add_action( 'wp_enqueue_scripts', [$this , 'add_jquery'] );
            mhmmdq_gateway_post_view('admin.create-new-shop');
        }

    }

}