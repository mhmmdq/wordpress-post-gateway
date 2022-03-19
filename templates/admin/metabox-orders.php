<button class="mhmmdq_post_gateway_btn" id="mhmmdq_post_gateway_btn_show_factor">
    نمایش فاکتور
</button>
<button class="mhmmdq_post_gateway_btn" id="mhmmdq_post_gateway_btn_need_to_collect">
    آماده برای جمع اوری
</button>
<button class="mhmmdq_post_gateway_btn" id="mhmmdq_post_gateway_btn_suspended">
    معلق سازی در سرویس گیت وی
</button>
<button class="mhmmdq_post_gateway_btn" id="mhmmdq_post_gateway_btn_delete_from_web_service">
    حذف از وب سرویس پست
</button>
<style>
    .mhmmdq_post_gateway_btn {
        background: #0073aa;
        color: #fff;
        border: none;
        border-radius: 5px;
        margin: 5px auto;
        width: 90%;
        padding: 10px 15px;
        cursor: pointer;
        display: block;
    }
</style>

<script>

let mhmmdq_post_gateway_btn_show_factor = document.getElementById('mhmmdq_post_gateway_btn_show_factor');
let mhmmdq_post_gateway_btn_need_to_collect = document.getElementById('mhmmdq_post_gateway_btn_need_to_collect');
let mhmmdq_post_gateway_btn_delete_from_web_service = document.getElementById('mhmmdq_post_gateway_btn_delete_from_web_service');
let mhmmdq_post_gateway_btn_suspended = document.getElementById('mhmmdq_post_gateway_btn_suspended');
mhmmdq_post_gateway_btn_show_factor.addEventListener('click' , function(e){
    e.preventDefault();
    window.open("<?=admin_url("/print-order/?order-id={$order_id}&action=show")?>" , "MsgWindow" ,  "width=700,height=600");
});

mhmmdq_post_gateway_btn_delete_from_web_service.addEventListener('click' , function(e){
    e.preventDefault();
    window.open("<?=admin_url("/print-order/?order-id={$order_id}&action=remove")?>" , "MsgWindow" ,  "width=300,height=100");
});

mhmmdq_post_gateway_btn_need_to_collect.addEventListener('click' , function(e){
    e.preventDefault();
    window.open("<?=admin_url("/print-order/?order-id={$order_id}&action=needToCollect")?>" , "MsgWindow" ,  "width=300,height=100");
});
mhmmdq_post_gateway_btn_suspended.addEventListener('click' , function(e){
    e.preventDefault();
    window.open("<?=admin_url("/print-order/?order-id={$order_id}&action=suspended")?>" , "MsgWindow" ,  "width=300,height=100");
});
</script>