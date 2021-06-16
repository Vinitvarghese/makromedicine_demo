<div class="n_side_section color_change">
<div class="userSettings">
    <div class="n_top_data">
    <a href="#" id="menu_hide">Hide</a>
        {if $get_confirm_status eq false}
            {if $UserData->status eq 0}
                <span class="verify_acc full_width">Verify Your Account <i>!</i></span>
                <div class="ad_pro_n full_width mb_30">
                    <a href="#" class="red_verify" id="verify_account_modal">Verify Account</a>
                </div>
                <!-- /.ad_pro -->
            {/if}
        {/if}
        <div class="n_profile_img img_fit">
            {if $UserData->company_logo}
                <img src="{$company_logo}"/>
            {else}
                <img src="{base_url('templates/default/assets/images/bloomberg.png')}" alt="img"/>
            {/if}
            {if $get_confirm_status eq false}
                {if $UserData->status gt 0}
                    {*                    //$('#comfirmAccount').modal();*}
                    <a href="#" class="n_pro_tick"><img
                                src="{base_url('templates/default/assets/images/icons/tck_.png')}"/></a>
                {/if}
            {/if}
        </div><!-- /.n_profile_img -->
        <h2>{$UserData->company_name}</h2>
        {if $get_confirm_status eq false}
            {if $UserData->status gt 0}
                <h3><span>Verified</span></h3>
            {else}
                <h3><span>Not Verified</span></h3>
            {/if}
        {else}
            <h3><span>Not Verified</span></h3>
        {/if}
        {*        <span class="rate_only"><img src="{base_url('templates/default/assets/images/icons/star_n.png')}" /></span>*}
        <!--<hr>-->
        <!--<h4>Give Rate:<span class="rate"><img src="images/icons/star_n.png" /></span></h4>-->
        <hr>
        <h6>{$user_following}<span>Followers</span></h6>
        <h6>{$user_followers}<span>Following</span></h6>
        <hr>
        {if $user.id && $user.id == $UserData->id}
            <div class="ad_pro_n full_width">
                <a href="{base_url('/product')}">Add Products</a>
            </div>
            <!-- /.ad_pro -->
        {/if}

        <!--<span class="verify_acc full_width">Verify Your Account <i>!</i></span>
        <div class="ad_pro_n full_width">
            <a href="#" class="red_verify">Verify Account</a>
            <a href="#">Add Products</a>
        </div>--><!-- /.ad_pro -->

    </div><!-- /.n_top_data -->


    <div class="n_navigation">
        <ul>
            <li><a {if isset($active_menu) and $active_menu == 1} class="active" {/if}
                        href="{site_url_multi('/')}pages/{$UserData->slug}"><img
                            src="{base_url('templates/default/assets/images/icons/comp_n.png')}"/><span>Company Information</span></a>
            </li>
            <li><a {if isset($active_menu) and $active_menu == 2} class="active" {/if}
                        href="{base_url('/')}pages/{$UserData->slug}/news"><img
                            src="{base_url('templates/default/assets/images/icons/news_icon.png')}"/><span>News</span></a>
            </li>
            <li><a {if isset($active_menu) and $active_menu == 3} class="active" {/if}
                        href="{site_url_multi('/')}pages/{$UserData->slug}/interests"><img
                            src="{base_url('templates/default/assets/images/icons/interest.png')}"/><span>Interest</span></a>
            </li>
            <li><a {if isset($active_menu) and $active_menu == 4} class="active" {/if}
                        href="{site_url_multi('/')}pages/{$UserData->slug}/products"><img
                            src="{base_url('templates/default/assets/images/icons/prod_n.png')}"/><span>Product</span></a>
            </li>
            <li><a {if isset($active_menu) and $active_menu == 5} class="active" {/if} href="#"><img
                            src="{base_url('templates/default/assets/images/icons/tender.png')}"/><span>Tender</span></a>
            </li>
            <li><a {if isset($active_menu) and $active_menu == 6} class="active" {/if} href="#"><img
                            src="{base_url('templates/default/assets/images/icons/ms_icon.png')}"/><span>Chat</span></a>
            </li>
            <li><a {if isset($active_menu) and $active_menu == 7} class="active" {/if}
                        href="{base_url('/')}pages/{$UserData->slug}/people"><img
                            src="{base_url('templates/default/assets/images/icons/pf_icon.png')}"/><span>Employees </span></a>
            </li>
            <li><a {if isset($active_menu) and $active_menu == 8} class="active" {/if}
                        href="{base_url('/')}profile/edit-page"><img
                            src="{base_url('templates/default/assets/images/icons/st_icon.png')}"/><span>Settings</span></a>
            </li>
        </ul>
        {*<span class="create_btn">
            	<a href="#">Follow</a>
            </span><!-- /.create_btn -->*}

        <span class="personal-account full_width">
            	<a href="{site_url_multi('/')}profile"><img src="{base_url('templates/default/assets/images/icons/personal_arrow.png')}"/>PERSONAL ACCOUNT</a>
            </span>
        <span class="logout">
            	<a href="{base_url('/')}authentication/logout"><img
                            src="{base_url('templates/default/assets/images/icons/logout.png')}"/> <span>Logout</span></a>
            </span>
    </div><!-- /.n_navigation -->
    </div>
</div><!-- /.n_side_section -->
{*

<div class="col-md-3 col-sm-3 col-xs-12 user-profil-part pull-left">
    <style>
        .right-content {
            margin-top: auto;
            background-color: #f1f1f1;
        }
        .image-section {
            padding: 0px;
        }
        .image-section img {
            width: 100%;
            height: 250px;
            position: relative;
        }
        .user-image {
            position: absolute;
            margin-top: -50px;
        }
        .user-left-part {
            margin: 0px;
        }
    </style>
    <div class="row ">
        <div class="col-md-12 col-md-12-sm-12 col-xs-12 user-image text-center">
            {if $UserData->company_logo}
                <img src="{$company_logo}" class="circle" />
            {else}
                <img class="circle" src="https://picsum.photos/250/250"/>
            {/if}
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 user-detail-section1 text-center" style="margin-top: 120px">
            <div class="profile-menu">
                <div class="progress">
                    {$c=0}
                    {foreach $UserData as $key=>$value}
                        {if $value == NULL}
                            {$c=$c+1}
                        {/if}
                    {/foreach}
                    <div
                            class="progress-bar"
                            role="progressbar"
                            aria-valuenow="{math equation="(x/y)*100" x=$c y=58 format="%.0f"}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            style="width:{math equation="(x/y)*100" x=$c y=58 format="%.0f"}%"
                    >
                        <span>{math equation="(x/y)*100" x=$c y=58 format="%.0f"}% Complete</span>
                    </div>
                </div>
                <ul>
                    <li {if isset($active_menu) and $active_menu == 1} class="active" {/if}>
                        <a href="{site_url_multi('/')}pages/{$UserData->slug}">
                            <img src="{base_url('templates/default/assets/img/sys/user.svg')}" alt="INFO"/>
                            INFO
                        </a>
                    </li>
                    <li {if isset($active_menu) and $active_menu == 2} class="active" {/if}>
                        <a href="{base_url('/')}pages/{$UserData->slug}/news">
                            <img src="{base_url('templates/default/assets/img/sys/news.svg')}" alt="NEWS"/>
                            NEWS
                        </a>
                    </li>
                    <li {if isset($active_menu) and $active_menu == 3} class="active" {/if}>
                        <a href="{site_url_multi('/')}pages/{$UserData->slug}/interests">
                            <img
                                    src="{base_url('templates/default/assets/img/sys/lover.svg')}"
                                    alt="YOUR INTEREST"
                            />INTEREST</a
                        >
                    </li>
                    <li {if isset($active_menu) and $active_menu == 4} class="active" {/if}>
                        <a href="{site_url_multi('/')}pages/{$UserData->slug}/products">
                            <img
                                    src="{base_url('templates/default/assets/img/sys/product.svg')}"
                                    alt="PRODUCT"
                            />
                            PRODUCT
                        </a>
                    </li>
                    <li {if isset($active_menu) and $active_menu == 5} class="active" {/if}>
                        <a href="#">
                            <img
                                    src="{base_url('templates/default/assets/img/sys/tender.svg')}"
                                    alt="TENDER"
                            />
                            TENDER
                        </a>
                    </li>
                    <li {if isset($active_menu) and $active_menu == 6} class="active" {/if}>
                        <a href="#">
                            <img src="{base_url('templates/default/assets/img/sys/chat.svg')}" alt="CHAT"/>
                            CHAT</a
                        >
                    </li>
                    <li {if isset($active_menu) and $active_menu == 7} class="active" {/if}>
                        <a href="{base_url('/')}pages/{$UserData->slug}/people">
                            <img src="{base_url('templates/default/assets/img/sys/people.svg')}" alt="PEOPLE" /> PEOPLE
                        </a>
                    </li>
                    <li {if isset($active_menu) and $active_menu == 8} class="active" {/if}>
                        <a href="{base_url('/')}profile/create-page">
                            <img
                                    src="{base_url('templates/default/assets/img/sys/settings.svg')}"
                                    alt="SETTINGS"
                            />
                            SETTINGS
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

*}


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
{/literal}