<div class="wrap">
    <h1 class="wp-heading-inline">
        پیگیری بسته ها
    </h1>
    <p>
        با وارد کردن کد مرسوله وضعیت فعلی بسته های خود را پیگیری کنید.
    </p>
    
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">
        
    </h2>
    <ul class="subsubsub">

    </ul>
    <form action="" method="get">
    <table class="form-table">

    <tr>
    <th><label for="postalcode">کد مرسوله را وارد کنید</label></th>
        <td>
            <input type="hidden" name='page' value="gateway-post-api-tracking-packages">
            <input type="text" name="gateway_barcode" class="regular-text digcon" /><br />
            <span class="description">ایدی فروشگاه باید با ایدی ثبت شده در صفحه فروشگاها برابر باشد.</span>
        </td>
    </tr>

    </table>

    <?php submit_button( 'بررسی' ); ?>

    </form>

    <?php

        if(isset($pakage_status))
        {
            echo 'ok';
        }

    ?>

    <div class="clear"></div>
</div>