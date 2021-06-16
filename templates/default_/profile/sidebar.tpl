<div class="n_side_section">
    <form class="userSettings" action="{base_url()}profile/save" enctype="multipart/form-data"
          method="post">
        <div class="n_top_data">
        <a href="#" id="menu_hide">Hide</a>
            <div class="n_profile_img img_fit">
                <img src="{$user_images}" alt="{$UserData->fullname}" id="n_profile_img_uploaded" />
                {if isset($active_menu) and $active_menu == 2}
                <span class="over_n"></span>
                <a href="#" class="n_pro_close"><img
                            src="{base_url('templates/default/assets/images/icons/n_close.png')}"></a>
                <a href="#" class="change_btn_n userphotos-change-dup">Change</a>
                {/if}
            </div><!-- /.n_profile_img -->
            <h2>
                {$UserData->fullname}
                <span>
                {if !empty($UserData->position)}{$UserData->position_name}{/if}
            </span>
            </h2>
            <hr>
            {if isset($settings) && $settings == 1}
                <h6>{$user_followers}<span>Followers</span></h6>
                <h6>{$user_following}<span>Following</span></h6>
            {else}
                <h6>{$user_followers}<span>Followers</span></h6>
                <h6>{$user_following}<span>Following</span></h6>
                {* Add Like button *}
            {/if}
        </div><!-- /.n_top_data -->

        <div class="n_navigation">
            <ul>
                <li>
                    <a href="{site_url_multi('/')}profile/" {if isset($active_menu) and $active_menu == 1} class="active" {/if}><img
                                src="{base_url('templates/default/assets/images/icons/pf_icon.png')}"/><span>Profile View</span></a>
                </li>
                <li>
                    <a href="{site_url_multi('/')}profile/settings/" {if isset($active_menu) and $active_menu == 20} class="active" {/if}>
                        <img src="{base_url('templates/default/assets/images/icons/ms_icon.png')}"/><span>Chat</span></a>
                </li>
                <li>
                    <a href="{site_url_multi('/')}profile/accounts/" {if isset($active_menu) and $active_menu == 2} class="active" {/if}>
                        <img src="{base_url('templates/default/assets/images/icons/st_icon.png')}"/><span>Settings</span></a>
                </li>
            </ul>
            {if $UserData->page_created == 0 && empty($UserData->company_name)}
                <span class="create_btn">
                <a href="{base_url('/')}profile/create-page">Create Company</a>
            </span>
                <!-- /.create_btn -->
            {elseif $UserData->page_created == 3}
                <span class="create_btn"><a href="{base_url('/')}profile/create-page">{$UserData->company_name}</a></span>
                <!-- /.create_btn -->
            {elseif !empty($UserData->company_name)}
                <span class="create_btn"><a href="{site_url_multi('/')}pages/{$UserData->slug}">{$UserData->company_name}</a></span>
                <!-- /.create_btn -->
            {/if}

            {*
            {if $get_confirm_status eq false}
                {if $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
                    {if $user['status'] eq 0}
                        <span class="create_btn">
                        <a onclick="$('#comfirmAccount').modal();" href="#">Create/Manage Company</a>
                    </span>
                        <!-- /.create_btn -->
                    {/if}
                {/if}
            {else}
                {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
                    {if $user['status'] eq 0}
                        <span class="create_btn">
                        <a href="#" onclick="$('#viewCert').modal();">Create/Manage Company</a>
                    </span>
                        <!-- /.create_btn -->
                    {/if}
                {/if}
            {/if}
            *}
            <span class="logout">
            	<a href="{base_url('/')}authentication/logout"><img
                            src="{base_url('templates/default/assets/images/icons/logout.png')}"/> <span>Logout</span></a>
            </span>
        </div><!-- /.n_navigation -->
    </form>
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


$(document).scroll(function() {
var top_offset1 = 72;
var top_offset2 = 107;
var top_offset3 = 242;
var top_offset33 = 247;
var y = $(this).scrollTop();
var w = $(window).width();

if (w >= 768 && !$('.add-product').hasClass('in')) {
if (y > top_offset1) {
    $(".header .bottom-menu:first-child").addClass("is-fixed");
} else {
    $(".header .bottom-menu:first-child").removeClass("is-fixed");
}

 if (y > top_offset2) {
    $(".header .bottom-menu.advanced-menu").addClass("is-fixed");
} else {
    $(".header .bottom-menu.advanced-menu").removeClass("is-fixed");
}

 if ((y > top_offset33 && !$(".header .bottom-menu.advanced-menu").hasClass('is-shown')) || (y > top_offset3 && $(".header .bottom-menu.advanced-menu").hasClass('is-shown'))) {
    $('.searchTable #example thead').addClass("is-fixed");
    $('.searchTable #example tbody').css('border-top','35px solid #ddd');
   if($(".header .bottom-menu.advanced-menu").css('display') != 'none') {
     $('.searchTable #example thead').css('top','70px');
      $(".header .bottom-menu.advanced-menu").css('top','35px');
    }
} else {
    $('.searchTable #example thead').removeClass("is-fixed");
    $('.searchTable #example tbody').css('border-top','none');
    $('.searchTable #example thead').css('top','35px');
      $(".header .bottom-menu.advanced-menu").css('top','35px');
}


}
});
</script>
<script>
    $(document).ready(function () {
        $('.userphotos-change-dup').on('click', function (ev) {
            ev.preventDefault();
            $('.userphotos').trigger('click');
        })
    })
</script>
{/literal}