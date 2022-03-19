<input type="text" value="<?=$barcode->barcode?>" id="gateway_code_order" placeholder="کد مرسوله را وارد کنید">
<div class="inputs">
<input type="text" value="<?=$barcode->price?>" id="gateway_code_order_price" placeholder="قیمت">
<input type="text" value="<?=$barcode->tax?>" id="gateway_code_order_tax" placeholder="مالیات">
</div>
<button class="mhmmdq_post_gateway_btn" id="btn_barcode_order_and_show_factor">
    <?php
        if(empty($barcode))
            echo 'ثبت و نمایش فاکتور';
        else
            echo 'نمایش فاکتور';
    ?>
</button>
<style>
    .inputs {
        display: flex;
        width: 90%;
        margin: 5px auto;
    }
    .inputs input {
        width: 50%;
    }
    #gateway_code_order {
        margin: 5px auto;
        display: block;
        width: 90%;

    }
    .mhmmdq_post_gateway_btn {
        background: #0073aa;
        color: #fff;
        border: none;
        border-radius: 5px;
        margin: 5px auto;
        width: 90%;
        text-align: center;
        padding: 10px 15px;
        cursor: pointer;
        display: block;
    }
</style>

<script>
    document.querySelector('#btn_barcode_order_and_show_factor').addEventListener('click' , function(e) {
        e.preventDefault();
        let barcode = document.querySelector('#gateway_code_order').value;
        let barcode_price = document.querySelector('#gateway_code_order_price').value;
        let barcode_tax = document.querySelector('#gateway_code_order_tax').value;

        if( barcode === '' || barcode_price === '' || barcode_tax === '' )
        {
            alert('برای ثبت کد مرسوله تمامی فیلد ها را تکمیل کنید');
        }
        else
        {
            window.open('<?=admin_url("/print-order/?order-id={$order_id}&action=add&barcode='+barcode+'&price='+barcode_price+'&tax='+barcode_tax")?> , "MsgWindow" ,  "width=700,height=600");
        }
        
    });
</script>
