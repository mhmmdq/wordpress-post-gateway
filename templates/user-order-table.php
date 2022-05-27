<?php
if( !defined( 'ABSPATH' ) )
{
exit;
}
?>
<h2 class="woocommerce-order-details__title"> وضعیت پست </h2>
<table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

<thead>
<tr>
<th class="woocommerce-table__product-name product-name">فروشنده</th>
<th class="woocommerce-table__product-table product-total">کد رهگیری</th>
</tr>
</thead>

<tbody>
<?php

foreach( $order as $store_id => $data ):
?>
<tr class="woocommerce-table__line-item order_item">

    <td class="woocommerce-table__product-name product-name">
        <strong class="product-quantity"> <?php echo $data['store_name'] . '<br> <span style="font-weight: normal;"> شماره سفارش : ' .$data['order_id'].' </span>' ;  ?> </strong>
    </td>

    <td class="woocommerce-table__product-total product-total">
    
        <?php
            
            if( $data['barcode'] != null )
            {
                echo "<div class='barcode'> <span style='font-weight: bold;'>".$data['barcode']."</span> <span> <a target='_blank' href='https://tracking.post.ir/' class='button view'>کپی کد و رهگیری</a> </span> </div> ";
            }
            else
            {
                echo '<span class="woocommerce-Price-amount amount"> در انتظار گرفتن کد مرسوله </span>';
            }
        ?>

    </td>
</tr>
<?php
endforeach;
?>

</tbody>
</table>


<div class="mhmmdq_alert">
    <p>
        کد رهگیری در حافظه کلیبورد شما ذخیره شد و تا ثانیه هایی دیگر به وبسایت رهگیری پست منتقل خواهید شد
    </p>
</div>


<style>
    .barcode {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .mhmmdq_alert {
        position: fixed;
        bottom: 20px;
        left: 20px;
        width: 260px;
        background: #54d1b9;
        padding: 10px;
        border-radius: 3px;
        color: #fff;
        display: none;
    }
</style>

<script>
    function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    
    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        var msg = successful ? 'successful' : 'unsuccessful';
        console.log('Fallback: Copying text command was ' + msg);
    } catch (err) {
        console.error('Fallback: Oops, unable to copy', err);
    }

    document.body.removeChild(textArea);
    }
    function copyTextToClipboard(text) {
    if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
    }
    navigator.clipboard.writeText(text).then(function() {
        console.log('Async: Copying to clipboard was successful!');
    }, function(err) {
        console.error('Async: Could not copy text: ', err);
    });
    }
    document.querySelectorAll('.barcode').forEach(function(el){
        var barcode_text = el.querySelector('span:first-child').innerText;
        el.querySelector('a').addEventListener('click', function(e){
            e.preventDefault();
            copyTextToClipboard(barcode_text);
            var link = this.href;
            document.querySelector('.mhmmdq_alert').style.display = 'block';
            let timer = setInterval(function(){
                    document.querySelector('.mhmmdq_alert').style.display = 'none';
                    window.open(link, '_blank');
                    clearInterval(timer);
            }, 2000);
        });
    });
</script>
