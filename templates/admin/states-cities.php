<div class="wrap">
    <h1 class="wp-heading-inline">
       لیست شهر و استان ها
    </h1>

    <p>
        لیست شهر ها در پایگاه داده ثبت شده است.تعداد کل ۲۵۰۴ شهر ثبت شده اما به اختصار ۲۰ شهر در این بخش به نمایش در می آید(در ورژن بعدی تمام لیست شهر ها با قابلیت صفحه بندی اضافه خواهد شد)
    </p>
    <hr class="wp-header-end">
    <h2 class="screen-reader-text">
       
    </h2>
    <ul class="subsubsub">
    </ul>
    <form method="get">
            <h2 class="screen-reader-text">فهرست کاربران</h2>
            <table class="wp-list-table widefat fixed striped table-mhmmdq_gateway_post_view-list users">
            <thead>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">انتخاب همه</label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <th scope="col" id="username" class="manage-column column-username column-primary sortable desc">
                            <span>نام شهر</span>
                    </th>
                    <th scope="col" id="email" class="manage-column column-email sortable desc">
                            <span>نام استان</span>
                    </th>
                    <th scope="col" id="role" class="manage-column column-role">کد استان</th>
                    <th scope="col" id="posts" class="manage-column column-posts num">کد شهر</th>
                </tr>
            </thead>

            <tbody id="the-list" data-wp-lists="list:user">
            <?php 
                foreach($cities as $city):
            ?>
            <tr>
                <th scope="row" class="check-column">
                    <label class="screen-reader-text" for="user_1">انتخاب </label>
                    <input type="checkbox" name="users[]" id="user_1" class="administrator" value="1">
                </th>
                <td class="username column-username has-row-actions column-primary" data-colname="نام شهر">
                    <strong>
                        <a href="http://wordpress.test/wp-admin/profile.php?wp_http_referer=%2Fwp-admin%2Fusers.php">
                            <?php echo $city['city_name']; ?>
                        </a>
                    </strong>
                    <br>
                    <div class="row-actions">
                        
                        
                    </div>
                    <button type="button" class="toggle-row">
                        <span class="screen-reader-text">نمایش جزئیات بیشتر</span>
                    </button>
                </td>
                <td class="email column-email" data-colname="نام استان">
                    <?php echo $city['state_name']; ?>
                </td>
                <td class="role column-role" data-colname="کد استان">
                    <?php echo $city['state_code']; ?>
                </td>
                <td class="posts column-posts num" data-colname="کد شهر">
                   
                        <span aria-hidden="true">
                            <?php echo $city['city_code']; ?>
                        </span>
                
                </td>
            </tr>
            <?php
                endforeach;
            ?>

 

            </table>


        <div class="tablenav-pages one-page">
            
        <br class="clear">
        </div>
    </form>

    <div class="clear"></div>
</div>