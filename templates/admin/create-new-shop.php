<h3>ثبت فروشگاه جدید در وب سرویس پست</h3>

<table class="form-table">

<tr>
<th><label for="postalcode">نام کاربری فروشگاه</label></th>
    <td>
        <input type="text" id="shop_username"  class="regular-text digcon" /><br />
        <br>
        <span class='description'>
         نام کاربری که شما وارد میکنید در سرویس پست ثبت خواهد شد
        </span>
    </td>
</tr>



<tr>
<th><label for="packging_price">نام فروشگاه</label></th>
    <td>
        <input type="text"  id="shop_name"  class="regular-text digcon" />
    </td>
</tr>

<tr>
<th><label for="packging_price_ratio_type"> تلفن فروشگاه </label></th>
    <td>
        <input type="text" id="shop_phone" class="regular-text digcon" />
       
    </td>
</tr>

<th><label for="packging_price_ratio_type"> کد پستی </label></th>
    <td>
        <input type="text"  id="shop_post_code" class="regular-text digcon" />
       
    </td>
</tr>

<th><label for="packging_price_ratio_type"> کد ملی مدیر </label></th>
    <td>
        <input type="text"  id="shop_admin_code_meli" class="regular-text digcon" />
        
    </td>
</tr>

<th><label for="packging_price_ratio_type"> سریال کد ملی </label></th>
    <td>
        <input type="text"  id="shop_admin_code_meli_serial" class="regular-text digcon" />
        
    </td>
</tr>

<th><label for="packging_price_ratio_type"> تاریخ تولد </label></th>
    <td>
        <input type="text"  id="shop_admin_b_day" class="regular-text digcon" />
        <br>
        <span class='description'>
             تاریخ را با فرمت (روز/ماه/سال) وارد کنید مثال : 1370/05/16
        </span>
    </td>
</tr>

<th><label for="packging_price_ratio_type"> تلفن همراه </label></th>
    <td>
        <input type="text"  id="shop_admin_phone" class="regular-text digcon" />
        
    </td>
</tr>

<th><label for="packging_price_ratio_type"> تاریخ شروع </label></th>
    <td>
        <input type="text"  id="shop_start_day" class="regular-text digcon" />
        <br>
        <span class='description'>
        تاریخ را با فرمت (روز/ماه/سال) وارد کنید مثال : 1370/05/16
        </span>
    </td>
</tr>

<th><label for="packging_price_ratio_type"> تاریخ پایان</label></th>
    <td>
        <input type="text"  id="shop_end_day" class="regular-text digcon" />
        <br>
        <span class='description'>
        تاریخ را با فرمت (روز/ماه/سال) وارد کنید مثال : 1370/05/16
        </span>
    </td>
</tr>

<th><label for="packging_price_ratio_type"> کد شهر </label></th>
    <td>
        <input type="text"  id="shop_city_code" class="regular-text digcon" />
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
        for(input_index in $('input')) {
            if($('input')[input_index].value == '')   {
                alert('لطفا تمام فیلد ها را تکمیل کنید');
                haveError = true;
                break;
            }
        }

        if( haveError !== true )
        {
            
        }

    });

</script>