<div class="n_side_section">
    <form class="userSettings" action="{base_url()}profile/save" enctype="multipart/form-data"
          method="post">
        <div class="n_top_data">
        <a href="#" id="menu_hide">Hide</a>

            {if $UserData->checked eq 0 && !empty($UserData->verification_code)}
                <a href="{site_url_multi('profile/account_confirmation')}" class="verify_acc full_width">Please confirm your account</a>
                
            {/if}

            <div class="n_profile_img img_fit">
                <img src="{$user_images}" alt="{$UserData->fullname}" id="n_profile_img_uploaded" />
                {if isset($active_menu) and $active_menu == 2}

                <button type="button" class="change_btn_n userphotos-change-dup"></button>
                {/if}


            </div><!-- /.n_profile_img -->
            <h2>
                {$UserData->fullname}
                <span>
                {if !empty($UserData->position)}{$UserData->position_name}{/if}
            </span>
            </h2>
            <hr>

            <ul class="full-width follow_li flex justify_between">
                <li {if isset($active_menu) and $active_menu == "followers"} class="active" {/if}>
                    <a href="{site_url_multi('/')}pages/{$UserData->slug_user}/followers" >
                        <span>{$user_followers}</span>
                        Followers
                    </a>
                </li>

                <li {if isset($active_menu) and $active_menu == "following"} class="active" {/if}>
                    
                    <a href="{site_url_multi('/')}pages/{$UserData->slug_user}/following">
                        <span>{$user_following}</span> 
                        Following
                    </a>
                </li>
            </ul>


        </div><!-- /.n_top_data -->



        <div class="n_navigation">

            <ul class="create_company_and_look_page not_hover">
                <li>
                    <a href="{site_url_multi('/')}profile/create-page" class="create_company_btn">Create Company</a>
                </li>
                <li>
                    <a target="_blank" class="see_my_page"  href="{site_url_multi('/')}users/{$UserData->slug_user}">
                        <span>See how my page looks</span>
                    </a>
                </li>
            </ul>


            <ul>
                <li>
                    <a href="{site_url_multi('/')}profile/" {if isset($active_menu) and $active_menu == 1} class="active" {/if}><img
                                src="{base_url('templates/default/assets/images/icons/pf_icon.png')}"/><span>Profile View</span></a>
                </li>
                <li>
                    <a href="javascript:" {if isset($active_menu) and $active_menu == 20} class="active" {/if}>
                        <img src="{base_url('templates/default/assets/images/icons/ms_icon.png')}"/><span>Chat</span></a>
                </li>

                <li class="has_sub_menu {if isset($active_menu) and $active_menu == 3} active {/if}">
                    <a href="javascript:" {if isset($active_menu) and $active_menu == 3} class="active" {/if}>
                        <img src="{base_url('templates/default/assets/images/icons/st_icon.png')}"/><span>Settings</span></a>
                    <ul class="full_width flex direction_column left_sub_menu">
                        <li><a href="{site_url_multi('/')}profile/notifications" class="{if isset($sub_menu) && $sub_menu==1} active {/if}" >Notifications</a> </li>
                        <li><a href="{site_url_multi('/')}profile/blocked_users?type=2" class="{if isset($sub_menu) && $sub_menu==2} active {/if}">Blocked list</a> </li>
                        <li><a href="javascript:">Subscription</a> </li>
                        <li><a href="javascript:">Payment System</a> </li>
                        <li><a href="{site_url_multi('/')}profile/account_confirmation" class="{if isset($sub_menu) && $sub_menu==5} active {/if}" >Account Confirmation</a> </li>
                    </ul>
                </li>


            </ul>





            {if !empty($user_page_and_roles)}
                <ul class="company_list_new not_hover">
                {foreach $user_page_and_roles as $page}
                    {$has_error=false}
                    {$error_message_list=[]}

                    {if empty($page->company_logo) || preg_match('/avatar-placeholder.png/', $page->company_logo)}
                        {$has_error=true}
                        {$error_message_list[]="Upload logo"}
                    {/if}

                    {if empty($page->company_banner) || preg_match('/avatar-placeholder.png/', $page->company_banner)}
                        {$has_error=true}
                        {$error_message_list[]="Upload banner"}
                    {/if}

                    {if empty($page->company_address)}
                        {$has_error=true}
                        {$error_message_list[]="Update adress"}
                    {/if}

                    {if empty($page->company_info)}
                        {$has_error=true}
                        {$error_message_list[]="Update info"}
                    {/if}

                    {if empty($page->standart)}
                        {$has_error=true}
                        {$error_message_list[]="Update standard"}
                    {/if}

                    
                    <!--
                    {if empty($page->website)}
                        {$has_error=true}
                        {$error_message_list[]="Update website"}
                    {/if}

                    {if empty($page->company_facebook)}
                        {$has_error=true}
                        {$error_message_list[]="Update facebook url"}
                    {/if}

                    {if empty($page->company_twitter)}
                        {$has_error=true}
                        {$error_message_list[]="Update twitter url"}
                    {/if}

                    {if empty($page->company_linkedin)}
                        {$has_error=true}
                        {$error_message_list[]="Update linkedin url"}
                    {/if}

                    {if empty($page->company_youtube)}
                        {$has_error=true}
                        {$error_message_list[]="Update youtube url"}
                    {/if}
                    -->

                    

                    {$company_url='javascript:'}

                    {if $page->role_id==1 && $page->approved==1}
                        {$company_url="{site_url_multi('/')}profile/pages/{{$page->company_link}}/edit-page"}
                    {elseif $page->approved==1}
                        {$company_url="{site_url_multi('/')}pages/{$page->company_link}"}
                    {/if}


                    <li class="my_company_li_{$page->company_id} {if $has_error && $page->create_company==1 } has_error direction_column align_start {/if} {if $page->approved==0 || $page->create_company==0}aplly_waiting{/if} "  >
                        <a href="{$company_url}" >
                            <div class="arrow_and_text">
                                <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.5017 6.0461H2.63347L6.78226 1.86149C6.97712 1.66418 6.97712 1.34478 6.78226 1.14798C6.58739 0.950674 6.27194 0.950674 6.07758 1.14798L1.14391 6.14299C0.95203 6.33728 0.95203 6.66222 1.14391 6.8565L6.07762 11.852C6.27248 12.0493 6.58793 12.0493 6.7823 11.852C6.97716 11.6547 6.97716 11.3353 6.7823 11.1385L2.63347 7.05527H16.5017C16.7768 7.05527 17 6.8292 17 6.55069C17 6.27218 16.7768 6.0461 16.5017 6.0461Z" fill="white" stroke="white" stroke-width="0.8"/>
                                </svg>

                                <span>{$page->company_name}</span>
                            </div>


                            {if $page->approved==1 && $page->create_company==1 && (!empty($error_message_list) || $page->checked eq 0) }
                                <div class="full_width flex direction_column page_error_list">
                                   {if !empty($error_message_list)}
                                        <p>Please fill all information <span></span></p>
                                   {/if}

                                   {if $page->checked eq 0 }
                                        <p>Please verify your account <span></span></p>
                                   {/if}
                                </div>
                            {elseif $page->approved==0 && $page->create_company==1}
                                <div class="full_width flex direction_column page_error_list">
                                    <p>Сonfirmation from
                                        administrator is awaiting</p>
                                </div>
                            {elseif $page->create_company==0}
                                <div class="full_width flex direction_column page_error_list">
                                    <p>Just workplace</p>
                                </div>
                            {/if}

                            

                        </a>

                        {if !$has_error && $page->role_id==1 && $page->approved==1}
                            {$notif_count=($page->user_id==$UserData->id) ? $page->page_notif_count : $page->page_user_count }

                            <div class="flex direction_column justify_between notif_and_count" data-id="{$page->company_id}" data-name="{$page->company_name}" data-logo="{$page->company_logo}" data-count="{$notif_count}">
                                <svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4875 4.8125C10.2048 4.8125 9.97502 4.59961 9.97502 4.33732C9.97502 3.0052 9.41563 1.75273 8.39984 0.810903C8.20005 0.625668 8.20005 0.325118 8.39984 0.139187C8.59962 -0.0467435 8.92396 -0.0460477 9.12449 0.139187C10.3339 1.26051 11 2.75161 11 4.33732C10.9992 4.59961 10.7702 4.8125 10.4875 4.8125Z" fill="white"/>
                                    <path d="M0.512439 4.8125C0.229772 4.8125 0 4.5996 0 4.3373C0 2.7515 0.666059 1.26032 1.87532 0.138934C2.07508 -0.0463112 2.39939 -0.0463112 2.5999 0.138934C2.80041 0.324179 2.79966 0.624745 2.5999 0.810686C1.58421 1.75257 1.02488 3.0051 1.02488 4.3373C1.02488 4.5996 0.795106 4.8125 0.512439 4.8125Z" fill="white"/>
                                    <path d="M10.0136 8.13867C9.28613 7.5238 8.86882 6.62432 8.86882 5.67215V4.33104C8.86882 2.63764 7.61071 1.23573 5.98146 1.00116V0.481461C5.98146 0.215177 5.76558 0 5.5 0C5.23442 0 5.01854 0.215177 5.01854 0.481461V1.00116C3.38858 1.23573 2.13118 2.63764 2.13118 4.33104V5.67286C2.13118 6.62503 1.71387 7.52381 0.981981 8.14308C0.795001 8.30327 0.6875 8.53642 0.6875 8.78262C0.6875 9.24681 1.06499 9.625 1.52988 9.625H9.47012C9.93431 9.625 10.3125 9.24751 10.3125 8.78262C10.3125 8.53642 10.205 8.30327 10.0136 8.13867Z" fill="white"/>
                                    <path d="M5.50041 11.6875C6.51676 11.6875 7.36721 11.0962 7.5625 10.3125H3.4375C3.63362 11.0962 4.48406 11.6875 5.50041 11.6875Z" fill="white"/>
                                </svg>

                                <span>{$notif_count}</span>

                            </div>
                        {/if}

                    </li>
                {/foreach}
                </ul>
            {/if}



            <span class="logout">
            	<a href="{base_url('/')}authentication/logout"><img
                            src="{base_url('templates/default/assets/images/icons/logout.png')}"/> <span>Logout</span></a>
            </span>
        </div><!-- /.n_navigation -->



    </form>

    <button type="button" class="go_up"></button>
</div><!-- /.n_side_section -->

{*
<div class="left-sidebar" id="my-affix">
    <div class="round-image userphotos-change" data-toggle="tooltip" data-placement="top" title="Image Upload">
        <img src="{$user_images}" alt="{$UserData->company_name}" class="avatar img-circle img-thumbnail">
    </div>
       <img src="{base_url('templates/default/assets/img/sys/photo-camera.svg')}" class="camera-icon" style="opacity:0;">

     {if isset($settings) && $settings == 1}
     <div class="text-center" style="margin-top:10px;">
         <h6>Upload and change photo.</h6>
     </div>
     <input type="file" class="text-center userphotos-change userphotos-change-dup" style="margin-top:10px;">
     {/if}

     <h4 class="usr-company-name">{$UserData->fullname}</h4>

    {if isset($settings) && $settings == 1}
     <div class="followers">
         <h4>FOLLOWERS: <a href="#" data-user-id="825" class="my_followers"><span>{$user_followers}</span></a> </h4>
         <h4>FOLLOWING: <a href="#" data-user-id="825" class="my_following"><span>{$user_following}</span></a> </h4>
     </div>
     {else}
    <div class="followers">
        <h4>FOLLOWING: <a href="#" data-user-id="{$UserData->id}" class="my_followers"><span>{$user_following}</span></a> </h4>
        <button type="button" name="follow" class="" style="background-color:#DCDCDC; font-size:12px; color:black;">Follow ({$user_followers})</button>
    </div>
    {/if}
    <div class="profile-menu">
        <ul>
            <li {if isset($active_menu) and $active_menu == 1} class="active" {/if}>
              <a href="{site_url_multi('/')}profile/">
                <img src="{base_url('templates/default/assets/img/sys/user.svg')}" alt="PROFILE VIEW">
                PROFILE VIEW
              </a>
            </li>
            <li {if isset($active_menu) and $active_menu == 2} class="active" {/if}>
              <a href="{site_url_multi('/')}profile/settings/">
                <img src="{base_url('templates/default/assets/img/sys/settings.svg')}" alt="SETTINGS">
                SETTINGS
              </a>
            </li>
            {if  $user['group_id']!= 6}
            <li {if isset($active_menu) and $active_menu == 3} class="active" {/if}> <a href="{site_url_multi('/')}profile/accounts/"> <img src="{base_url('templates/default/assets/img/sys/accounts.svg')}" alt="">EDIT NOTIFICATIONS</a> </li>
            {/if}

            <!---------------- -------------------->
            <li {if isset($active_menu) and $active_menu == 4} class="active" {/if}>
              <a href="{site_url_multi('/')}profile/interests/">
                <img src="{base_url('templates/default/assets/img/sys/lover.svg')}" alt="YOUR INTEREST">
                YOUR INTEREST
              </a>
            </li>
            {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
            
                <li>
                  <a href="{site_url_multi('/')}profile/products/">
                    <img src="{base_url('templates/default/assets/img/sys/product.svg')}" alt="PRODUCTS">
                    PRODUCTS
                  </a>
                </li>

                <li>
                  <a href="{site_url_multi('/')}profile/tenders/">
                    <img src="{base_url('templates/default/assets/img/sys/product.svg')}" alt="TENDERS">
                    TENDERS
                  </a>
                </li>
            
            {/if}


            <li {if isset($active_menu) and $active_menu == 5} class="active" {/if}>
                {if $UserData->page_created && $UserData->page_created == 1}
              <a href="{base_url('/')}profile/create-page">
                  <img src="{base_url('templates/default/assets/img/sys/pen.svg')}" alt="MANAGE PAGE">MANAGE PAGE
              </a>
                {elseif $UserData->page_created == 3}
                    <a href="#">
                        <img src="{base_url('templates/default/assets/img/sys/pen.svg')}" alt="VIEW PAGE">VIEW PAGE
                    </a>
                {/if}
            </li>
            <li>
                <a href="{base_url('/')}profile/chat">
                    <img src="{base_url('templates/default/assets/img/sys/chat.svg')}" alt="CHAT">CHAT
                </a>
            </li>
            <li>
              <a href="{base_url('/')}authentication/logout">
                <img src="{base_url('templates/default/assets/img/sys/logout.svg')}" alt=">LOG OUT">
                LOG OUT
              </a>
            </li>
        </ul>
    </div>
</div>

<!--------------- OLD ------------------------>
*}
<div id="viewCert" class="modal fade" role="dialog" style="z-index:9999999;">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Your Certificate</h4>
            </div>
            <div class="modal-body">
                {if isset($UserData->certificate)}
                    <div class="form-group">
                        <div class="img-st-profil" style="width:100%">
                            <a href="#" onclick="$('#comfirmAccount').modal();">
                                <img src="{base_url('uploads')}/catalog/certifcate/{$UserData->certificate}">
                                <div class="overlay"><i class="fa fa-edit"></i>replace image</div>
                            </a>
                        </div>
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>

{literal}

<script>
    $(document).ready(function () {
        $('.userphotos-change-dup').on('click', function (ev) {
            ev.preventDefault();
            $('.userphotos').trigger('click');
        })
    })
</script>
{/literal}
