<h3>تنظیمات وب سرویس پست | GateWay</h3>

<form action="options.php" method="post">
<table class="form-table">

<tr>
<th><label for="postalcode">نام کاربری api</label></th>
    <td>
        <input type="text" name="gateway_username" id="gateway_code" value="<?php echo $GateWayUsername; ?>" class="regular-text digcon" /><br />
        
    </td>
</tr>



<tr>
<th><label for="packging_price">رمز عبور api</label></th>
    <td>
        <input type="password" name="gateway_password" id="packging_price" value="<?php echo $GateWayPassword; ?>" class="regular-text digcon" />
    </td>
</tr>

<tr>
<th><label for="packging_price_ratio_type">کلید امین </label></th>
    <td>
        <input type="password" name="gateway_secret_key" id="packging_price" value="<?php echo $GateWaySeceretKey; ?>" class="regular-text digcon" />
        <br>
        <span class='description'>
            کلیدی که از وب سرویس پست دریافت کرده اید را وارد کنید
        </span>
    </td>
</tr>

<th><label for="packging_price_ratio_type">مبلغ ثابت درصورت قطعی وب سرویس </label></th>
    <td>
        <input type="text" name="gateway_static_price" id="packging_price" value="<?php echo $GateWayDefaultPrice; ?>" class="regular-text digcon" />
        <br>
        <span class='description'>
            با تنظیم این مبلغ در صورت عدم دریافت پاسخ از طرف وب سرویس یک قیمت ثابت اعمال میشود (اختیاری)
        </span>
    </td>
</tr>

<?php do_action('gateway_seeting_add_fields'); ?>

<th><?php submit_button(); ?></th>
</form>