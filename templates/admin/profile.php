<h3>تنظیمات وب سرویس پست | GateWay</h3>

<table class="form-table">

<tr>
<th><label for="postalcode">ایدی فروشگاه در وب سرویس پست</label></th>
    <td>
        <input type="text" name="gateway_code" id="gateway_code" value="<?php echo esc_attr( get_the_author_meta( 'gateway_code', $user->ID ) ); ?>" class="regular-text digcon" /><br />
        <span class="description">ایدی فروشگاه باید با ایدی ثبت شده در صفحه فروشگاها برابر باشد.</span>
    </td>
</tr>

<tr>
<th><label for="get_code_from_gateway_need">دریافت کد از وب سرویس</label></th>
    <td>
    <select id="get_code_from_gateway_need" name="get_code_from_gateway_need">
<option value="1" <?php if(esc_attr( get_the_author_meta( 'get_code_from_gateway_need', $user->ID )) == '1' ){echo 'selected="selected"';} ?>>فعال</option>
<option value="0" <?php if(esc_attr( get_the_author_meta( 'get_code_from_gateway_need', $user->ID ))== '0' ){echo 'selected="selected"';} ?>>غیرفعال</option>
    </select>
    </td>
</tr>

<tr>

<tr>
<th><label for="packging_price_ratio_type">نوع ضریب هزینه بسته بندی</label></th>
    <td>
    <select id="packging_price_ratio_type" name="packging_price_ratio_type">
            <option value="weight" <?php if(esc_attr( get_the_author_meta( 'packging_price_ratio_type', $user->ID ))=='weight'){echo 'selected="selected"';} ?>>وزن</option>
            <option value="quantity" <?php if(esc_attr( get_the_author_meta( 'packging_price_ratio_type', $user->ID ))=='quantity'){echo 'selected="selected"';} ?>>تعداد</option>
    </select>
    </td>
</tr>

<tr>
<th><label for="packging_price_ratio">رنج هزینه بسته بندی</label></th>
    <td>
        <input type="text" name="packging_price_ratio" id="packging_price_ratio" value="<?php echo esc_attr( get_the_author_meta( 'packging_price_ratio', $user->ID ) ); ?>" class="regular-text digcon" />
    </td>
</tr>

<tr>
<th><label for="packging_collect_price">هزینه جمع آور</label></th>
    <td>
        <input type="text" name="packging_collect_price" id="packging_collect_price" value="<?php echo esc_attr( get_the_author_meta( 'packging_collect_price', $user->ID ) ); ?>" class="regular-text digcon" />
    </td>
</tr>
<th><label for="extra_price">هزینه اضافه</label></th>
    <td>
        <input type="text" name="extra_price" id="extra_price" value="<?php echo esc_attr( get_the_author_meta( 'extra_price', $user->ID ) ); ?>" class="regular-text digcon" />
    </td>
</tr>


<tr>
<th><label for="packging_price_ratio_type">وضعیت هزینه ارسال</label></th>
    <td>
    <select id="deliver_price_free" name="deliver_price_free">
<option value="1" <?php if(esc_attr( get_the_author_meta( 'deliver_price_free', $user->ID ))=='1'){echo 'selected="selected"';} ?>>غیر رایگان</option>
<option value="0" <?php if(esc_attr( get_the_author_meta( 'deliver_price_free', $user->ID ))=='0'){echo 'selected="selected"';} ?>>رایگان</option>
    </select>
    </td>
</tr>

<tr>
<th><label for="is_need_to_collect">نیاز به جمع آور دارد</label></th>
    <td>
    <select id="is_need_to_collect" name="is_need_to_collect">
<option value="1" <?php if(esc_attr( get_the_author_meta( 'is_need_to_collect', $user->ID ))=='1'){echo 'selected="selected"';} ?>>دارد</option>
<option value="0" <?php if(esc_attr( get_the_author_meta( 'is_need_to_collect', $user->ID ))=='0'){echo 'selected="selected"';} ?>>ندارد</option>
    </select>
    </td>
</tr>

</table><hr />