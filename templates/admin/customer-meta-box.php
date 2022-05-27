<?php
$countries = new WC_Countries(); 
$country_states = $countries->get_states( "IR" ); 
$state_name     = !empty($country_states[$user_meta['shipping_state'][0]]) ? $country_states[$user_meta['shipping_state'][0]] : $user_meta['shipping_state'][0];
?>
<div class="inputs">
<input type="text" id="gateway_shipping_state" value="<?php echo $state_name; ?>" placeholder="استان">
<input type="text" placeholder="شهر" id="gateway_shipping_city" value="<?php echo $user_meta['shipping_city'][0];?>">
</div>
<div class="inputs">
<input type="text" id="gateway_shipping_address_1" value="<?php echo $user_meta['shipping_address_1'][0];?>" placeholder="آدرس">
<input type="text" id="gateway_billing_phone" placeholder="شماره تماس" value="<?php echo $user_meta['billing_phone'][0];?>">
</div>
<div class="inputs">
<input type="text" id="gateway_shipping_postcode" placeholder="کد پستی" value="<?php echo $user_meta['shipping_postcode'][0];?>">

</div>
<button class="mhmmdq_post_gateway_btn" id="gateway_update_customer">
    بروزرسانی
</button>

<script>

document.querySelector('#gateway_update_customer').addEventListener('click' , function(e) {
    e.preventDefault();
    var data = {
        'action': 'mhmmdq_post_gateway_update_customer',
        'user_id': <?php echo $user_id;?>,
        'shipping_state': document.querySelector('#gateway_shipping_state').value,
        'shipping_city': document.querySelector('#gateway_shipping_city').value,
        'shipping_address_1': document.querySelector('#gateway_shipping_address_1').value,
        'billing_phone': document.querySelector('#gateway_billing_phone').value,
        'shipping_postcode': document.querySelector('#gateway_shipping_postcode').value,

    };
    jQuery.post(ajaxurl, data, function(response) {
        alert('با موفقیت بروزرسانی شد');
    });

});

</script>