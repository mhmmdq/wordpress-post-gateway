<div class="wrap">
    <h1 class="wp-heading-inline">
        فروشگاه ها
    </h1>

    <a href="<?= admin_url('admin.php?page=gateway-post-api-shops-add') ?>" class="page-title-action">
        افزودن
    </a>

    <hr class="wp-header-end">
    <h2 class="screen-reader-text">
        پالایش فهرست کاربران
    </h2>
    <ul class="subsubsub">
        <li>
            <a href="<?= admin_url('admin.php?page=gateway-post-api-shops')?>" class="current">
                همه
                
            </a> |
        </li>
        <li>
            <a href="<?=admin_url('admin.php?page=gateway-post-api-shops&status=active')?>">
                فعال
               
            </a> |
        </li>
        <li>
            <a href="<?=admin_url('admin.php?page=gateway-post-api-shops&status=inactive')?>">
                غیرفعال
               
            </a>
        </li>
    </ul>
    <form method="get">
            <h2 class="screen-reader-text">فهرست کاربران</h2>
            <?php do_action('mhmmdq_post_gateway_before_shop_table');?>
            <table class="wp-list-table widefat fixed striped table-mhmmdq_gateway_post_view-list users">
            <thead>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">انتخاب همه</label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <th scope="col" id="username" class="manage-column column-username column-primary sortable desc">
                            <span>نام کاربری</span>
                    </th>
                    <th scope="col" id="name" class="manage-column column-name">
                        نام
                    </th>
                    <th scope="col" id="email" class="manage-column column-email sortable desc">
                            <span>شماره فروشگاه</span>
                    </th>
                    <th scope="col" id="role" class="manage-column column-role">وضعیت</th>
                    <th scope="col" id="posts" class="manage-column column-posts num">کد وضعیت</th>
                </tr>
            </thead>

            <tbody id="the-list" data-wp-lists="list:user">
            <?php
                apply_filters('mhmmdq_post_gateway_shop_list' , $shops);
                foreach( $shops as $shop ):
            ?>
            <tr>
                <th scope="row" class="check-column">
                    <label class="screen-reader-text" for="user_1">انتخاب <?php echo $shop['ShopUsername']; ?></label>
                    <input type="checkbox" name="users[]" id="user_1" class="administrator" value="1">
                </th>
                <td class="username column-username has-row-actions column-primary" data-colname="نام کاربری">
                    <strong>
                        <a href="http://wordpress.test/wp-admin/profile.php?wp_http_referer=%2Fwp-admin%2Fusers.php">
                            <?php echo $shop['ShopUsername']; ?>
                        </a>
                    </strong>
                    <br>
                    <div class="row-actions">
                        <span class="edit">
                            <a href="http://wordpress.test/wp-admin/profile.php?wp_http_referer=%2Fwp-admin%2Fusers.php">ویرایش</a> |
                        </span>
                        <span class="delete">
                            <a href="#delete">پاک کردن</a> |
                        </span>
                        <span class="mhmmdq_gateway_post_view">
                            <a href="http://wordpress.test/author/mhmmdq/">نمایش</a> 
                        </span>
                        
                    </div>
                    <button type="button" class="toggle-row">
                        <span class="screen-reader-text">نمایش جزئیات بیشتر</span>
                    </button>
                </td>
                <td class="name column-name" data-colname="نام">
                    <?php echo $shop['ShopName']; ?>
                </td>
                <td class="email column-email" data-colname="شماره فروشگاه">
                    <?php echo $shop['ShopID']; ?>
                </td>
                <td class="role column-role" data-colname="وضعیت">
                    <?php echo $shop['ShopStatus']; ?>
                </td>
                <td class="posts column-posts num" data-colname="کد وضعیت">
                    <a href="edit.php?author=1" class="edit">
                        <span aria-hidden="true">
                            <?php echo $shop['ShopStatusCode']; ?>
                        </span>
                    </a>
                </td>
            </tr>
            <?php
                endforeach;
            ?>

            

            </table>
            

        <div class="tablenav-pages one-page">
            <span class="displaying-num"><?php echo count($shops);?> مورد</span>
        <br class="clear">
        </div>

        <?php do_action('mhmmdq_post_gateway_after_shop_table');?>

    </form>

    <div class="clear"></div>
</div>