<div class="n_side_section color_change">
<div class="userSettings">
    <div class="n_top_data">
    <a href="#" id="menu_hide">Hide </a>



        {if $get_confirm_status eq false}

                <span class="verify_acc full_width">Verify Your Account <i>!</i></span>
                <div class="ad_pro_n full_width mb_30">
                    <a href="#" class="red_verify" id="verify_account_modal">Verify Account</a>
                </div>
                <!-- /.ad_pro -->

        {/if}

        <div class="n_profile_img img_fit">
            {if $UserData->company_logo}
                <img src="{site_url()}uploads/catalog/users/{str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $UserData->company_logo)}"/>
            {else}
                <img src="{base_url('templates/default/assets/images/bloomberg.png')}" alt="img"/>
            {/if}

            {if isset($get_confirm_status) && !empty($get_confirm_status)}
                {if $get_confirm_status->status == 1}
                    <a href="#" class="n_pro_tick"><img
                                src="{base_url('templates/default/assets/images/icons/tck_.png')}"/></a>
                {/if}
            {/if}

        </div><!-- /.n_profile_img -->
        <h2>{$UserData->company_name}</h2>

        {if  isset($get_confirm_status) && !empty($get_confirm_status)}
            {if $get_confirm_status->status == 1}
                <h3>Company status: <span>Verified</span></h3>
            {else}
                <h3>Company status: <span>Verify pending</span></h3>
            {/if}
        {else}
            <h3>Company status: <span>Not Verified</span></h3>
        {/if}
        <br/>
        <hr>
        <br/>

        {if $UserData->id!=$UserData->admin_id}
            <span class="rate_only {if $company_rate >= 1} rated {else} not_rated {/if}">
            {if $is_loggedin }
                <button type="button" class="rating_start give_rating_btn_1 {if $is_loggedin && $company_rate >= 1 } active {/if} {if $company->id!=$UserData->id} give_rating_btn {/if}" {if $is_loggedin} data-id="1"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>

                <button type="button" class="rating_start give_rating_btn_2 {if $is_loggedin && $company_rate >= 2 } active {/if} {if $company->id!=$UserData->id } give_rating_btn {/if}"  {if $is_loggedin}data-id="2"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>

                <button type="button" class="rating_start give_rating_btn_3 {if $is_loggedin && $company_rate >= 3 } active {/if} {if $company->id!=$UserData->id } give_rating_btn {/if}"  {if $is_loggedin} data-id="3"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>

                <button type="button" class="rating_start give_rating_btn_4 {if $is_loggedin && $company_rate >= 4 } active {/if} {if $company->id!=$UserData->id} give_rating_btn {/if}"  {if $is_loggedin} data-id="4"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>

                <button type="button" class="rating_start give_rating_btn_5 {if $is_loggedin && $company_rate >= 5 } active {/if} {if $company->id!=$UserData->id } give_rating_btn {/if}"  {if $is_loggedin} data-id="5"  data-profile_id="{$company->id}" data-user_id="{$UserData->id}" {/if} >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>
            {else}
                <button type="button" class="rating_start {if $company_star_rate_count >= 1 } active {/if}   triggerSignup" >
                   <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>

                <button type="button" class="rating_start {if $company_star_rate_count >= 2 } active {/if} triggerSignup" >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>

                <button type="button" class="rating_start {if $company_star_rate_count >= 3 } active {/if} triggerSignup" >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>

                <button type="button" class="rating_start {if $company_star_rate_count >= 4 } active {/if} triggerSignup" >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>

                <button type="button" class="rating_start {if $company_star_rate_count >= 5 } active {/if} triggerSignup " >
                    <svg  role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" ><path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z" class=""></path></svg>
                </button>
            {/if}
        </span>
        {/if}


        <p style="color: #fff; margin-bottom: 10px;">
            {$company_rate_total} votes
            {if $is_loggedin }
                ( {$company_star_rate_count}/5 )
            {/if}
        </p>
        <hr>

        {if $UserData->id!=$UserData->admin_id}
            <ul class="full-width follow_li flex justify_between">
                <li {if isset($active_menu) and $active_menu == "followers"} class="active" {/if}>
                    <span>{$user_following}</span>
                    <a href="{site_url_multi('/')}pages/{$UserData->slug}/followers" >Followers</a>
                </li>

                <li {if isset($active_menu) and $active_menu == "following"} class="active" {/if}>
                    <span>{$user_followers}</span>
                    <a href="{site_url_multi('/')}pages/{$UserData->slug}/following">Following</a>
                </li>
            </ul>
        {/if}
        <hr>


        {if $permission_list[4]->add == 1}
            <div class="ad_pro_n full_width">
                <a href="{site_url_multi('/product')}/{$UserData->slug}">Add Products</a>
            </div>
            <!-- /.ad_pro -->
        {/if}


    </div><!-- /.n_top_data -->


    <div class="n_navigation">

        <ul class="create_company_and_look_page not_hover">
            <li><a target="_blank" class="see_my_page" {if isset($active_menu) and $active_menu == 9} class="active" {/if}
                   href="{site_url_multi('/')}companies/{$UserData->slug}"> <span>Public view</span></a>
            </li>
        </ul>

        <ul>

            <li><a {if isset($active_menu) and $active_menu == 1} class="active" {/if}
                        href="{site_url_multi('/')}pages/{$UserData->slug}"><img
                            src="{base_url('templates/default/assets/images/icons/comp_n.png')}"/><span>Company Information</span></a>
            </li>

            {if $permission_list[2]->view == 1}
                <li><a {if isset($active_menu) and $active_menu == 2} class="active" {/if}
                            href="{site_url_multi('/')}pages/{$UserData->slug}/news"><img
                                src="{base_url('templates/default/assets/images/icons/news_icon.png')}"/><span>News</span></a>
                </li>
            {/if}

            {if $permission_list[3]->view == 1}
                <li><a {if isset($active_menu) and $active_menu == 3} class="active" {/if}
                            href="{site_url_multi('/')}pages/{$UserData->slug}/interests"><img
                                src="{base_url('templates/default/assets/images/icons/interest.png')}"/><span>Interest</span></a>
                </li>
            {/if}

            {if $permission_list[4]->view == 1}
                <li><a {if isset($active_menu) and $active_menu == 4} class="active" {/if}
                            href="{site_url_multi('/')}pages/{$UserData->slug}/products"><img
                                src="{base_url('templates/default/assets/images/icons/prod_n.png')}"/><span>Product</span></a>
                </li>
            {/if}

            {if  $permission_list[5]->view == 1}
                <li><a {if isset($active_menu) and $active_menu == 5} class="active" {/if} href="#"><img
                                src="{base_url('templates/default/assets/images/icons/tender.png')}"/><span>Tender</span></a>
                </li>
            {/if}

            {if $permission_list[6]->view == 1}
                <li><a {if isset($active_menu) and $active_menu == 6} class="active" {/if} href="#"><img
                                src="{base_url('templates/default/assets/images/icons/ms_icon.png')}"/><span>Chat</span></a>
                </li>
            {/if}

            {if $permission_list[7]->view == 1}
                <li><a {if isset($active_menu) and $active_menu == 7} class="active" {/if}
                            href="{site_url_multi('/')}pages/{$UserData->slug}/people"><img
                                src="{base_url('templates/default/assets/images/icons/pf_icon.png')}"/><span>Employees</span></a>
                </li>
            {/if}

            {if $permission_list[8]->view == 1}
                <li><a {if isset($active_menu) and $active_menu == 8} class="active" {/if}
                            href="{site_url_multi('/')}profile/pages/{$UserData->slug}/edit-page"><img
                                src="{base_url('templates/default/assets/images/icons/st_icon.png')}"/><span>Settings</span></a>
                </li>
            {/if}




        </ul>

        <span class="personal-account full_width">
            	<a href="{site_url_multi('/')}profile">
                    <img src="{base_url('templates/default/assets/images/icons/personal_arrow.png')}"/>
                    PERSONAL ACCOUNT</a>
            </span>
        <span class="logout">
            	<a href="{base_url('/')}authentication/logout"><img
                            src="{base_url('templates/default/assets/images/icons/logout.png')}"/> <span>Logout</span></a>
            </span>
    </div><!-- /.n_navigation -->
    </div>
</div><!-- /.n_side_section -->

<div class="all_modals">
    {*{if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}*}
    {if $get_confirm_status eq false}
        {if $UserData->status eq 0}
            <div id="comfirmAccount" class="modal fade forGot" role="dialog"
                 style="z-index:999999999999999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="comfirmAccount" enctype="multipart/form-data" action="{base_url()}profile/comfirmAccount"  method="post">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><img src="{base_url('templates/default/assets/images/icons/close_n.png')}" /></span></button>
                            </div>
                            <div class="modal-body data-response confirm_account_body">
                                <h3>Account Verification</h3>
                                <p>Введите необходимые документы, для подтверждения подлинности
                                    компании. Ваш аккаунт будет верифицирован после подтверждения модераторами.</p>

                                <div class="mod_center_inp change_pss">

                                    <div class="form-group upload_file_box" >
                                        <div class="upload_file_btn" >
                                            <input type="file" name="certifcate" required  />
                                            <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 18C2.46694 18 0 15.477 0 12.375V4.5C0 4.08595 0.328577 3.75005 0.733289 3.75005C1.13813 3.75005 1.46671 4.08595 1.46671 4.5V12.375C1.46671 14.6497 3.27583 16.5 5.5 16.5C7.72417 16.5 9.53329 14.6497 9.53329 12.375V4.12495C9.53329 2.67751 8.38199 1.50005 6.96671 1.50005C5.55129 1.50005 4.4 2.67751 4.4 4.12495V11.625C4.4 12.2452 4.89347 12.75 5.5 12.75C6.10653 12.75 6.6 12.2452 6.6 11.625V4.5C6.6 4.08595 6.92858 3.75005 7.33329 3.75005C7.73813 3.75005 8.06671 4.08595 8.06671 4.5V11.625C8.06671 13.0725 6.91528 14.25 5.5 14.25C4.08472 14.25 2.93329 13.0725 2.93329 11.625V4.12495C2.93329 1.85023 4.74241 0 6.96671 0C9.19088 0 11 1.85023 11 4.12495V12.375C11 15.477 8.53306 18 5.5 18Z" fill="white"/>
                                            </svg>
                                        </div>
                                        <textarea name="info" class="form-control " required placeholder="You can write something…" minlength="10"></textarea>
                                    </div>
                                </div>
                                <div class="mod_center_inp_textarea">
                                    <button type="button" class="close close_modal_btn" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="yes_modal_btn">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        {/if}
    {/if}
</div>

<script>

    $("#verify_account_modal").on('click', function(){
        $('#comfirmAccount').modal();
    });

    $(document).on('submit', '.comfirmAccount', function (e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url: site_url + 'profile/comfirmAccount/',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.type == 'success') {
                    $('#comfirmAccount').modal('hide');
                    $('.left-button-area button').removeAttr('onclick').addClass('send-us-certifcate').text('Send your information');
                    toastr.success(obj.message);
                } else {
                    toastr.error(obj.message);
                }
            }
        });
        e.preventDefault();
        return false;
    });
</script>
