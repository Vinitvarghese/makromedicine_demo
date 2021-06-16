<style>
    .n_top_data h3 span { padding-bottom: 0;}
    .create_btn_a {
        margin: 15px auto;
        color: rgba(33, 135, 197, 1);
        font-size: 16px;
        text-align: center;
        min-width: 171px;
        max-width: 171px;
        height: 38px;
        display: block;
        background: rgba(246, 246, 246, 1);
        border-radius: 18px;
        padding: 12px 15px;
    }
</style>


<div class="n_side_section color_change_green">
<div class="userSettings">
    <div class="n_top_data">
        <a href="#" id="menu_hide">Hide</a>
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

        {if $UserData->id!=$UserData->admin_id }
            {if $check_follow > 0}
                <a id="follow-button" user-id="{$company->id}" {if $is_loggedin eq false} follow-status="0" {else} follow-status="1" {/if} class="create_btn_a">Following</a>
            {else}
                <a id="follow-button" class="create_btn_a {if $is_loggedin eq false} triggerSignup{/if}" user-id="{$company->id}" {if $is_loggedin eq false} follow-status="0" {else} follow-status="1" {/if} >+ Follow</a>
            {/if}
        {/if}

        <br/>
        <hr>
        <br/>

        {if $UserData->id!=$UserData->admin_id }
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
        <h6>{$user_following}<span>Followers</span></h6>
        <hr>

    </div><!-- /.n_top_data -->


    <div class="n_navigation">
        <ul>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}" {if isset($active_menu) and $active_menu == 1} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/comp_n.png')}"/><span>Company Information</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}/news" {if isset($active_menu) and $active_menu == 2} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/news_icon.png')}"/><span>News</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}/interests" {if isset($active_menu) and $active_menu == 3} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/interest.png')}"/><span>Interest</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}/products" {if isset($active_menu) and $active_menu == 4} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/prod_n.png')}"/><span>Product</span></a>
            </li>
            <li><a href="{site_url_multi('/')}companies/{$company->slug}/tenders" {if isset($active_menu) and $active_menu == 5} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/tender.png')}"/><span>Tender</span></a>
            </li>
            <li><a href="{site_url_multi('/')}companies/{$company->slug}/chats" {if isset($active_menu) and $active_menu == 6} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/ms_icon.png')}"/><span>Chat</span></a>
            </li>
            <li>
                <a href="{site_url_multi('/')}companies/{$company->slug}/people" {if isset($active_menu) and $active_menu == 7} class="active" {/if}><img
                            src="{base_url('templates/default/assets/images/icons/pf_icon.png')}"/><span>Employees </span></a>
            </li>
            {*            <li><a href="#"><img src="images/icons/st_icon.png" /><span>Settings</span></a></li>*}
        </ul>

        {if isset($user)}
            <span class="logout">
            	<a href="{base_url('/')}authentication/logout"><img
                            src="{base_url('templates/default/assets/images/icons/logout.png')}"/> <span>Logout</span></a>
            </span>
        {/if}
    </div><!-- /.n_navigation -->
    </div>
</div><!-- /.n_side_section -->



