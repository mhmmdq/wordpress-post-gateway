
<?php

$shop_name = '';
$shop_username = '';
$shop_phone = '';
$shop_email = '';
$shop_post_code = '';
$shop_address = '';
$shop_admin_code_meli = '';
$shop_admin_code_meli_serial = '';
$shop_admin_b_day = '';
$shop_admin_phone = '';
$shop_start_day = '';
$shop_end_day = '';
$shop_city_code = '';
$is_need_to_collect = '';

if(isset($_GET['shop_id']) && !empty($_GET['shop_id'])) {
    global $GateWay;
    $shop_id = $_GET['shop_id'];
    $shops = json_decode($GateWay->GetShopFullList());
    foreach($shops as $shop) {
        if($shop->ShopID == $shop_id) {
            
            $shop_name = $shop->Shopname;
            $shop_username = $shop->ShopUsername;
            $shop_phone = $shop->Phone;
            $shop_email = $shop->Email;
            $shop_post_code = $shop->PostalCode;
            $shop_address = $shop->Address;
            $shop_admin_code_meli = $shop->ManagerNationalID;
            $shop_admin_code_meli_serial = $shop->ManagerNationalIDSerial;
            $shop_admin_b_day = $shop->ManagerBirthDate;
            $shop_admin_phone = $shop->Mobile;
            $shop_start_day = $shop->StartDate;
            $shop_end_day = $shop->EndDate;
            $shop_city_code = $shop->CityID;
            $is_need_to_collect = $shop->NeedToCollect;
        }
    }

    echo "<h3>ویرایش فروشگاه</h3>";

}else {
    echo '<h3>ثبت فروشگاه جدید در وب سرویس پست</h3>';
}


?>




<table class="form-table">

<tr>
<th><label for="postalcode">نام کاربری فروشگاه</label></th>
    <td>
        <input type="text" id="shop_username" value="<?php echo $shop_username;?>"  class="regular-text digcon" /><br />
        <br>
        <span class='description'>
         نام کاربری که شما وارد میکنید در سرویس پست ثبت خواهد شد
        </span>
    </td>
</tr>



<tr>
<th><label for="packging_price">نام فروشگاه</label></th>
    <td>
        <input type="text"  id="shop_name" value="<?php echo $shop_name;?>"  class="regular-text digcon" />
    </td>
</tr>

<tr>
<th><label for="packging_price_ratio_type"> تلفن فروشگاه </label></th>
    <td>
        <input type="text" id="shop_phone" value="<?php echo $shop_phone;?>" class="regular-text digcon" />
       
    </td>
</tr>

<th><label for="packging_price_ratio_type"> کد پستی </label></th>
    <td>
        <input type="text"  id="shop_post_code" value="<?php echo $shop_post_code;?>" class="regular-text digcon" />
       
    </td>
</tr>

<th><label for="packging_price_ratio_type"> کد ملی مدیر </label></th>
    <td>
        <input type="text"  id="shop_admin_code_meli" value="<?php echo $shop_admin_code_meli;?>" class="regular-text digcon" />
        
    </td>
</tr>

<th><label for="packging_price_ratio_type"> سریال کد ملی </label></th>
    <td>
        <input type="text"  id="shop_admin_code_meli_serial" value="<?php echo $shop_admin_code_meli_serial;?>" class="regular-text digcon" />
        
    </td>
</tr>

<th><label for="packging_price_ratio_type"> تاریخ تولد </label></th>
    <td>
        <input type="text"  id="shop_admin_b_day" value="<?php echo $shop_admin_b_day;?>" class="regular-text digcon" />
        <br>
        <span class='description'>
             تاریخ را با فرمت (روز/ماه/سال) وارد کنید مثال : 1370/05/16
        </span>
    </td>
</tr>

<th><label for="packging_price_ratio_type"> تلفن همراه </label></th>
    <td>
        <input type="text"  id="shop_admin_phone" value="<?php echo $shop_admin_phone;?>" class="regular-text digcon" />
        
    </td>
</tr>

<th><label for="packging_price_ratio_type"> تاریخ شروع </label></th>
    <td>
        <input type="text"  id="shop_start_day" value="<?php echo $shop_start_day;?>" class="regular-text digcon" />
        <br>
        <span class='description'>
        تاریخ را با فرمت (روز/ماه/سال) وارد کنید مثال : 1370/05/16
        </span>
    </td>
</tr>

<th><label for="packging_price_ratio_type"> تاریخ پایان</label></th>
    <td>
        <input type="text"  id="shop_end_day" value="<?php echo $shop_end_day;?>" class="regular-text digcon" />
        <br>
        <span class='description'>
        تاریخ را با فرمت (روز/ماه/سال) وارد کنید مثال : 1370/05/16
        </span>
    </td>
</tr>

<th><label for="packging_price_ratio_type"> کد شهر </label></th>
    <td>
        <input type="text"  id="shop_city_code" class="regular-text digcon" value="<?php echo $shop_city_code;?>" />
        <br>
        
    </td>
</tr>

<th><label for="packging_price_ratio_type"> نیاز به جمع آور دارد؟ </label></th>
    <td>
    <select id="is_need_to_collect">
        <option value="0">دارد</option>
        <option value="1">ندارد</option>
    </select> 
    </td>
</tr>

<th>
    <?php submit_button('افزودن فروشگاه'); ?>
</th>


<script>

    document.getElementById('submit').addEventListener('click' , function(e) {
        e.preventDefault();
        let $ = (selector) => {
            let elemets = document.querySelectorAll(selector);
             if(elemets.length > 1) {
                 return elemets;
             }else {
                 return elemets[0];
             }
        };
        let haveError = false;


        if( haveError !== true )
        {
           let data = {
                <?php
                    if(isset($_GET['shop_id'])) {
                        echo '"ShopID" : '.$_GET['shop_id'].',';
                    }
                ?>
                'action' : 'post_gateway_create_shop',
                'ShopUsername' : $('#shop_username').value,
                'Shopname' : $('#shop_name').value,
                'Phone' : $('#shop_phone').value,
                'PostalCode' : $('#shop_post_code').value,
                'ManagerNationalID' : $('#shop_admin_code_meli').value,
                'ManagerNationalIDSerial' : $('#shop_admin_code_meli_serial').value,
                'ManagerBirthDate' : $('#shop_admin_b_day').value,
                'Mobile' : $('#shop_admin_phone').value,
                'StartDate' : $('#shop_start_day').value,
                'EndDate' : $('#shop_end_day').value,
                'CityID' : $('#shop_city_code').value,
                'NeedToCollect' : $('#is_need_to_collect').value
            };
            jQuery.post(ajaxurl , data , function(response) {
                alert('درخواست شما انجام شد نتیجه را در اسرع وقت بررسی کنید');
            });
        }

    });

</script>