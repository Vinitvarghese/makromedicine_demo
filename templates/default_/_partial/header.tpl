<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>{$title}</title>
    <meta charset="{$meta_charset}">
    <meta http-equiv="Content-Type" content="{$meta_content_type}">
    <meta name="keywords" content="{$meta_keyword}"/>
    <meta name="description" content="{$meta_description}">
    <meta name="robots" content="{$meta_robots}"/>
    <meta name="DC.title" content="{$meta_title}"/>
    <meta property="fb:app_id" content="{$meta_facebook_app_id}"/>
    <meta property="og:url" content="{$meta_facebook_url}"/>
    <meta property="og:type" content="{$meta_facebook_type}"/>
    <meta property="og:title" content="{$meta_title}"/>
    <meta property="og:description" content="{$meta_description}"/>
    <meta property="og:image" content="{$current_img}"/>
    <meta property="og:image:width" content="{$meta_facebook_width}"/>
    <meta property="og:image:height" content="{$meta_facebook_height}"/>
    <meta property="og:site_name" content="{$meta_facebook_site_name}"/>
    <meta name="twitter:card" content="{$meta_twitter_card}"/>
    <meta name="twitter:site" content="{$meta_twitter_site}"/>
    <meta name="twitter:creator" content="{$meta_twitter_creator}"/>
    <meta name="googlebot" content="{$meta_googlebot}"/>
    <meta name="msnbot" content="{$meta_msnbot}"/>
    <meta name="dmozbot" content="{$meta_dmozbot}"/>
    <meta name="revisit-after" content="{$meta_revisit_after}"/>
    <meta name="copyright" content="Makromedicine.com"/>
    <meta name="google-signin-scope" content="{$meta_google_signin_scope}">
    <meta name="google-signin-client_id" content="{$meta_google_signin_client_id}">
    <meta name="viewport" content="{$meta_viewport}"/>
    <meta name="yandex-verification" content="48ee9eab27f4d2f5"/>
    <!-- STYLESEET -->
    <link rel="image_src" href="{$current_img}"/>
    <!--   <link rel="canonical" href="{$link_canonical}"/> -->
    <link rel="shortcut icon" type="image/png" href="{$link_shortcut_icon}"/>
    <link rel="shortcut icon" type="image/x-icon" href="{$link_shortcut_icon}">
    {if isset($new_page) && $new_page == 1}
        <link rel="stylesheet" href="{base_url('templates/default/assets/css/custom.css')}" media="all">
    {/if}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/main.css?v=20092019')}" media="all">

    <link rel="stylesheet" href="{base_url('templates/default/assets//emoji/emojionearea.css?v=')}{time()}" media="all">
    {if !isset($smarty.get.demo)}
        {if isset($new_page) && $new_page == 1}
            <link rel="stylesheet" href="{base_url('templates/default/assets/css/style_new.css')}" media="all">
        {else}
        <link rel="stylesheet" href="{base_url('templates/default/assets/css/style.css?v=')}{uniqid()}" media="all">
        {/if}
        <link rel="stylesheet" href="{base_url('templates/default/assets/audio-player/dist/css/green-audio-player.css?v=')}{uniqid()}" media="all">
    {else}
        <link rel="stylesheet" href="{base_url('templates/default/assets/css/style-demo.css?v=')}{uniqid()}"
              media="all">
    {/if}
    <link rel="stylesheet" href="{base_url('templates/default/assets/css/responsive.css?v=20092019')}" media="all">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"></script>

    {$css}

    {literal}

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function (m, e, t, r, i, k, a) {
                m[i] = m[i] || function () {
                    (m[i].a = m[i].a || []).push(arguments)
                };
                m[i].l = 1 * new Date();
                k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
            })
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(53617480, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true
            });
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/53617480" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>
        <!-- /Yandex.Metrika counter -->

    {/literal}

    <!-- JAVASCRIPT 1 -->
    <script>
        ci_custom_home_url = "{base_url()}";
    </script>
    <script charset="utf-8" type="text/javascript"
            src="{base_url('templates/default/assets/js/plugins.js?v=8')}"></script>
    <script charset="utf-8" type="text/javascript"
            src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script charset="utf-8" type="text/javascript"
            src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script charset="utf-8" type="text/javascript" src="https://apis.google.com/js/platform.js?onload=onLoad" async
            defer></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script src="{base_url('templates/default/assets//emoji/emojionearea.js?v=')}{time()}"></script>
    <script type="text/javascript"> var site_url = "{base_url()}"; </script>
    {$js}
    <script>
        {if isset($UserData->country_code) && $UserData->country_code!=''}

        $('.dial-codes').val('{$UserData->country_code}');
        $('.dial-code').val('{$UserData->country_code}');

        {else}

        {literal}
        /* COUNTRY SELECTED */


        $.ajax({
            type: 'POST',
            url: site_url + 'home/this_country/',
            data: false,
            cache: false,
            success: function (data) {
                var obj = jQuery.parseJSON(data);
                var valid = $('.company-country option[data-name="' + obj.country_code + '"]');
                $('.dial-codes').val(obj.country_code);
                $('.dial-code').val(obj.country_code);
            }
        });

        {/literal}

        {/if}

        {literal}

        /* GOOGLE PLUS LOGIN */
        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                console.log('User signed out.');
            });
        }

        function onLoad() {
            gapi.load('auth2', function () {
                gapi.auth2.init();
            });
        }

        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            var email = profile.getEmail();
            var password = profile.getId();
            var fullname = profile.getName();
            var imgurl = profile.getImageUrl();
            var country = $('.dial-codes').val();
            $.ajax({
                type: 'POST',
                url: site_url + 'authentication/google/',
                data: {
                    'email': email,
                    'password': password,
                    'fullname': fullname,
                    'imgurl': imgurl,
                    'country': country
                },
                cache: false,
                success: function (data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj[0].login == 'success') {
                        if (obj[0].type == 'success') {
                            $.each(obj, function (key, value) {
                                toastr.success(value.message);
                            });
                            window.location = site_url + 'profile/settings/';
                        } else {
                            $.each(obj, function (key, value) {
                                toastr.error(value.message);
                            });
                        }
                    } else {
                        if (obj[0].type == 'error') {
                            $.each(obj, function (key, value) {
                                toastr.error(value.message);
                            });
                        } else {
                            $.each(obj, function (key, value) {
                                toastr.success(value.message);
                            });
                        }
                    }
                }
            }).done(function (data) {
                var auth2 = gapi.auth2.getAuthInstance();
                auth2.signOut();
            });
        }

        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
                console.log('User signed out.');
            });
        }
        {/literal}
        /* FACEBOOK LOGIN */
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function statusChangeCallback(response) {
            if (response.status === 'connected') {
                testAPI(response);
            }
        }

        function checkLoginState() {
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '459567871231062',
                cookie: false,
                xfbml: true,
                version: 'v2.8'
            });
            FB.getLoginStatus(function (response) {
                statusChangeCallback(response);
            });
        };

        function generatePass(str) {
            if (str) {
                var res = '';
                for (var i = 0; i < 8; i++) {
                    res += str.charAt(i);
                }
                return res;
            } else {
                return false;
            }
        }
    </script>
    {if $is_loggedin eq false}
        <script>
            function testAPI(response) {
                if (response.status === 'connected') {
                    FB.api('/me/?fields=id,name,email,picture.width(800).height(800),friends',
                        function (response) {
                            var id = response.id;
                            var fullname = response.name;
                            var email = response.email;
                            var password = generatePass(id);
                            var imgurl = response.picture.data.url;
                            var country = $('.dial-codes').val();
                            {literal}
                            $.ajax({
                                type: 'POST',
                                url: site_url + 'authentication/facebook/',
                                data: {
                                    'email': email,
                                    'password': password,
                                    'fullname': fullname,
                                    'imgurl': imgurl,
                                    'country': country
                                },
                                cache: false,
                                success: function (data) {
                                    var obj = jQuery.parseJSON(data);
                                    if (obj[0].login == 'success') {
                                        if (obj[0].type == 'success') {
                                            $.each(obj, function (key, value) {
                                                toastr.success(value.message);
                                            });
                                            window.location = site_url + 'profile/settings/';
                                        } else {
                                            $.each(obj, function (key, value) {
                                                toastr.error(value.message);
                                            });
                                        }
                                    } else {
                                        if (obj[0].type == 'error') {
                                            $.each(obj, function (key, value) {
                                                toastr.error(value.message);
                                            });
                                        } else {
                                            $.each(obj, function (key, value) {
                                                toastr.success(value.message);
                                            });
                                        }
                                    }
                                }
                            });
                            {/literal}
                        });
                }
            }
        </script>
    {else}
        <script>
            function testAPI(response) {
                if (response.status === 'connected') {
                    FB.logout(function (response) {});
                }
            }
        </script>
    {/if}


    {literal}
        <!--
        <script src="https://www.googletagmanager.com/gtag/js?id=UA-77518171-4"></script>
        <script type="text/javascript">
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', 'UA-77518171-4');
        </script>-->
        <script type="text/javascript">window.$crisp = [];
            window.CRISP_WEBSITE_ID = "e0515cb9-356e-4ac5-a67f-79b638480a01";
            (function () {
                d = document;
                s = d.createElement("script");
                s.src = "https://client.crisp.chat/l.js";
                s.async = 1;
                d.getElementsByTagName("head")[0].appendChild(s);
            })();</script>
        <script async defer type="text/javascript"
                src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5814eeb8a5c788a2"></script>
    {/literal}
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8703899176773088",
            enable_page_level_ads: true
        });
    </script>
    <style>
        .company-name-dropdown {
            font-family: 'GothamBold', Arial, sans-serif !important;
            display: block;
            padding: 3px 20px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333;
            white-space: inherit !important;
        }
    </style>
</head>
<body>
<div class="s-overlay" id="s-overlay"></div>
<header class="header">
    <div class="top-menu">
        <div class="container">
            <div class="row main-head-row">
                {if $is_loggedin eq false}

                <div class="col-md-3 col-xs-12">
                    {else}

                    <div class="col-md-3 col-xs-12">
                        {/if}

                        <div class="logo">
                            <a href="{site_url_multi('/')}"><img
                                        src="{base_url('templates/default/assets/img/logo/logo-makromedicine.png')}"
                                        alt=""></a>
                        </div>
                    </div>
                    {if $is_loggedin eq false}
                        <div class="col-md-7 col-xs-12">
                            {if $menu_items}
                                <div class="topnav" id="myTopnav">
                                    {foreach $menu_items as $key=>$menu_item}
                                        <a href="{site_url_multi('/')}{$menu_item->slug}"
                                           class="active">{$menu_item->name}</a>
                                    {/foreach}

                                    <a href="javascript:void(0);" class="icon" onclick="hamburger()">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                            {/if}

                        </div>
                    {else}
                        <div class="col-md-5 col-xs-12" style="padding: 0;">
                            {if $menu_items}
                                <div class="topnav" id="myTopnav">
                                    {foreach $menu_items as $key=>$menu_item}{if $key <= 5}
                                        <a href="{site_url_multi('/')}{$menu_item->slug}"
                                           class="active {if $key == 1} has-submenu {/if}">{$menu_item->name}</a>
                                    {/if}{/foreach}
                                    <a href="javascript:void(0);" class="icon" onclick="hamburger()">
                                        <i class="fa fa-bars"></i>
                                    </a>


                                    <a href="#" data-toggle="dropdown" class="hidden-xs"> <i class="fa fa-bars"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        {foreach $menu_items as $key=>$menu_item}{if $key > 5}
                                            <li><a href="{site_url_multi('/')}{$menu_item->slug}"
                                                   class="active">{$menu_item->name}</a></li>
                                        {/if}{/foreach}
                                    </ul>

                                </div>
                            {/if}

                        </div>
                    {/if}
                    {if $is_loggedin neq false}
                        <div class="col-md-1 col-xs-4 no-padding">
                            <div class="menu-hamburger pull-right">
                                <ul class="dropdown">

                                    <li class="logged-menu notify-list">
                                        {if $check_notify}
                                            <div class="simple_counter">{count($check_notify)}</div>
                                        {/if}
                                        <a class="notify_href" href="#" data-toggle="dropdown">
                                            <img src="{base_url('templates/default/assets/img/sys/notification.svg')}"
                                                 style="width: 25px;" alt="">
                                        </a>
                                        <ul class="dropdown-menu">
                                            {if $get_notify}{foreach $get_notify as $key=>$value}
                                                <li data-target="{$value->id}" data-sender="{$value->sender}"
                                                    data-status="{$value->status}" data-type="{$value->type}"
                                                    {if $value->status eq 1}class="actives"{/if}>
                                                    <a href="{site_url_multi('/notify/')}{$value->id}">
                                                        {if $value->sender eq 0}
                                                            <i class="fa fa-star"></i>
                                                        {else}
                                                            <i class="fa fa-star-o"></i>
                                                        {/if}
                                                        {$value->title}
                                                    </a>
                                                </li>
                                            {/foreach}
                                            {else}
                                                <span style="color: #333;font-family: 'GothamBook', Arial, sans-serif;font-size: 11px;text-align: center;padding: 10px;display: block;">No notifications</span>
                                            {/if}
                                        </ul>
                                    </li>
                                    <li class="logged-menu message-list">
                                        {if $check_msg > 0}
                                            <div class="simple_counter">{$check_msg}</div>
                                        {/if}
                                        <a href="{base_url('messages/index')}"> <img
                                                    src="{base_url('templates/default/assets/img/sys/email.svg')}"
                                                    style="width: 25px;" alt=""> </a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    {/if}
                    {if $is_loggedin eq false}
                    <div class="col-md-2 col-xs-12 sign-up-responsive">
                        {else}
                        <div class="col-md-3 col-xs-8">
                            {/if} {if $is_loggedin eq false}
                                <!--  <div class="language">
                       <select class="selectpicker lang_top select_top">
                          {if $languages}{foreach $languages as $key=>$value}
                          <option style="background-image:url({base_url('templates/default/assets/img/country/lang')}/{$value->slug}.png);" data-slug="{$value->slug}" {if $current_lang_id eq $value->id} selected="selected"{/if}>{$value->slug}</option>
                          {/foreach}{/if}
                       </select>
                    </div> -->
                                <button class="mybutton" id="signUpToggle">Sign Up</button>
                                <button class="mybutton" id="signInToggle">Sign In</button>
                            {else}
                                {if is_object($user)}
                                    {$user_arr = get_object_vars($user) }
                                    <div class="profile-thump">
                                    <div class="left-profile-thump">
                                        <div>
                                            <button type="button" class="btn btn-default dropdown-toggle btn-profile"
                                                    data-toggle="dropdown">
                                                <!-- {if  $user_arr['user_groups_id'] eq 2 ||  $user_arr['user_groups_id'] eq 3 ||  $user_arr['user_groups_id'] eq 4}
                                }
{*                                                {if  $user_arr->user_groups_id eq 2 ||  $user_arr->user_groups_id eq 3 ||  $user_arr->user_groups_id eq 4}*}
                                                    <p>{mb_substr($user_arr.company_name,0, 15, 'UTF-8')}</p>
                                                {else}
                                                    <p>{$user_arr.fullname}</p>
                                                {/if} -->
                                                <p>{$current_loggedin_user['fullname']}</p>
                                                <!-- {get_group_name($user_arr['user_groups_id'])} -->
                                                {if !empty($UserData->position)}{$UserData->position_name}{/if}
                                                <span class="caret btn-caret"></span>
                                            </button>
                                            <ul class="dropdown-menu profile-dropdown" role="menu">
                                                <li><a href="{site_url_multi('/')}profile/">Profile view</a></li>
                                                <li><a href="{site_url_multi('/')}profile/settings/">Settings</a></li>
                                                <li><a href="{site_url_multi('/')}profile/accounts/">Account
                                                        Settings</a></li> 
                                                <li><a href="#" onclick="$('#forgetPasswordAuth').modal();">Forgot Password</a>
                                                </li>
                                                {if ($user_arr['user_groups_id'] eq 2 ||  $user_arr['user_groups_id'] eq 3 ||  $user_arr['user_groups_id'] eq 4) && strlen($user_arr['company_name']) > 2 }
                                                    <li class="divider"></li>
                                                    <li><span class="company-name-dropdown">
                                                        {$current_loggedin_user['company_name']}
                                                    </span></li>
                                                    <li><a href="{site_url_multi('/')}profile/products/">Products</a></li>
                                                    <li><a href="{site_url_multi('/')}profile/interests/">Interests</a></li>
                                                    <li class="divider"></li>
                                                {/if}
                                                <li><a href="{base_url('/')}authentication/logout/"
                                                       onclick="signOut();">Logout</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="right-profile-thump">
                                        <a href="{site_url_multi('/')}profile">
                                            <img src="{$user_images}" alt="{$UserData->company_name}">
                                        </a>
                                    </div>
                                </div>
                                {else}
                                    <div class="profile-thump">
                                        <div class="left-profile-thump">
                                            <div>
                                                <button type="button" class="btn btn-default dropdown-toggle btn-profile"
                                                        data-toggle="dropdown">
                                                    <!-- {if  $user_arr['user_groups_id'] eq 2 ||  $user_arr['user_groups_id'] eq 3 ||  $user_arr['user_groups_id'] eq 4}
{*                                                {if  $user_arr->user_groups_id eq 2 ||  $user_arr->user_groups_id eq 3 ||  $user_arr->user_groups_id eq 4}*}
                                                    <p>{mb_substr($user_arr.company_name,0, 15, 'UTF-8')}</p>
                                                {else}
                                                    <p>{$user_arr.fullname}</p>
                                                {/if} -->
                                                {* <p>{$user.fullname}</p> *}
                                                <p>{$current_loggedin_user['fullname']}</p>
                                                <!-- {get_group_name($user_arr['user_groups_id'])} -->
                                                {if !empty($UserData->position)}{$UserData->position_name}{/if}
                                                    <span class="caret btn-caret"></span>
                                                </button>
                                                <ul class="dropdown-menu profile-dropdown" role="menu">
                                                    <li><a href="{site_url_multi('/')}profile/">Profile view</a></li>
                                                    <li><a href="{site_url_multi('/')}profile/settings/">Settings</a></li>
                                                    <li><a href="{site_url_multi('/')}profile/accounts/">Account
                                                            Settings</a></li>
                                                    
                                                    </li>
                                                    <li><a href="#" onclick="$('#forgetPasswordAuth').modal();">Forgot Password</a>
                                                    {if ($user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4) && strlen($user['company_name']) > 2}
                                                        <li class="divider"></li>
                                                        <li><span class="company-name-dropdown" href="#">{$current_loggedin_user['company_name']}</span></li>
                                                        <li><a href="{site_url_multi('/')}profile/products/">Products</a></li>
                                                        <li><a href="{site_url_multi('/')}profile/interests/">Interests</a></li>
                                                        <li class="divider"></li>
                                                    {/if}
                                                    <li><a href="{base_url('/')}authentication/logout/"
                                                           onclick="signOut();">Logout</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="right-profile-thump">
                                            <a href="{site_url_multi('/')}profile">
                                                <img src="{$user_images}" alt="{$UserData->company_name}">
                                            </a>
                                        </div>
                                    </div>
                                {/if}
                            {/if}

                        </div>

                        {if ($is_loggedin eq false)}
                            <div class="col-md-5 col-xs-12 login-box-cont" id="signInBox">
                                <div class="loginbox" style="min-height: 300px">
                                    <div class="tab-content loginbox-main">
                                        <i class="fa fa-times visible-xs" aria-hidden="true"
                                           onclick="document.getElementById('signInBox').style.display='none'"></i>
                                        <div id="login" class="tab-pane fade in active">
                                            <div class="form">
                                                <div class="social-block">
                                                    <div class="social-login facebook">
                                                        <fb:login-button scope="public_profile,email"
                                                                         onlogin="checkLoginState();"
                                                                         class="fb-login-button"
                                                                         data-width="135px" data-size="medium"
                                                                         data-max-rows="1" data-size="large"
                                                                         data-button-type="continue_with"
                                                                         data-show-faces="false"
                                                                         data-auto-logout-link="false"
                                                                         data-use-continue-as="false">
                                                        </fb:login-button>
                                                    </div>
                                                    <div class="social-login">
                                                        <div class="g-signin2" data-width="191px" data-height="29px"
                                                             data-longtitle="true"
                                                             data-onsuccess="onSignIn"
                                                             style="margin-left:20px;border-radius:4px;"></div>
                                                    </div>
                                                </div>
                                                <form id="validateForm" action="{base_url()}/authentication/login/"
                                                      method="post">
                                                    <div class="form-group">
                                                        <input type="email" name="email" id="email"
                                                               class="myinput icon-input email"
                                                               placeholder="E-mail" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="password" id="password"
                                                               class="myinput icon-input password"
                                                               placeholder="Password" autocomplete="off" required/>
                                                    </div>
                                                    <div class="form-group">
                                                        <p style="padding-left: 10px; padding-top: 15px;">
                                                            <input type="checkbox" id="forget-me" value="1"/>
                                                            <label for="forget-me">Remember me</label>
                                                            <a href="#" data-toggle="modal"
                                                               data-target="#forgetPassword" class="forget-password">Forget
                                                                password?</a>
                                                        </p>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="button" class="mybutton">SIGN IN
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-xs-12 login-box-cont in-middle" id="signUpBox">
                                <div class="loginbox">
                                    <div class="signup-left hidden">
                                        {if isset($banner_popup)}
                                            <a href="{$banner_popup->slug}" target="_blank">
                                                <img src="{(base_url('uploads/'))}{$banner_popup->images}" alt=""
                                                     style="width: 100%;height: 390px;object-fit: cover;">
                                            </a>
                                        {else}
                                            <iframe width="404" height="390"
                                                    src="https://www.youtube.com/embed/6sT604EHm0o?rel=0"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen style="width: 100%"></iframe>
                                        {/if}
                                    </div>
                                    <div class="tab-content loginbox-main">
                                        <i class="fa fa-times visible-xs" aria-hidden="true"
                                           onclick="document.getElementById('signUpBox').style.display='none';document.getElementById('s-overlay').style.display='none';$('#signUpBox').removeClass('in-middle')"></i>
                                        <div id="register" class="tab-pane fade in active">
                                            <div class="form">
                                                <h3 class="hidden">Sign Up</h3>
                                                <form id="validateRegister"
                                                      action="{base_url()}/authentication/register/" method="post">
                                                    <div class="col-md-6 no-padding-left">
                                                        <div class="form-group">
                                                            <input type="text" name="fristname" id="fristname"
                                                                   class="myinput icon-input fristname"
                                                                   placeholder="First name" autocomplete="off"
                                                                   required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 no-padding">
                                                        <div class="form-group">
                                                            <input type="text" name="lastname" id="lastname"
                                                                   class="myinput icon-input lastname"
                                                                   placeholder="Last name" autocomplete="off" required/>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-6 no-padding-left">
                                                        <div class="form-group">
                                                            <input type="email" name="email" id="emails"
                                                                   class="myinput icon-input email" placeholder="E-mail"
                                                                   autocomplete="off" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 no-padding">
                                                        <div class="form-group">
                                                            <input type="hidden" name="dial_code" value="0"
                                                                   class="dial-code"/>
                                                            <input type="phone" name="phone" id="phone"
                                                                   class="myinput icon-input inputmask phone"
                                                                   placeholder="Phone number" autocomplete="off"
                                                                   required/>
                                                            <input type="hidden" name="type" value="6">
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    {*<div class="col-md-6 no-padding-left">
                                                        <div class="form-group">
                                                            <select name="type" id="type"
                                                                    class="myinput icon-input type" required>
                                                                {if $groups}{foreach $groups as $key=>$value}
                                                                    <option value="{$value->id}"
                                                                            {if $value->id == 2}selected="selected"{/if}>{$value->name}</option>
                                                                {/foreach}{/if}

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 no-padding">
                                                        <div class="form-group">
                                                            <input type="text" name="company_name" id="company_name"
                                                                   class="myinput icon-input company_name"
                                                                   autocomplete="off" placeholder="Company Name"/>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>*}
                                                    <div class="col-md-6 no-padding-left">
                                                        <div class="form-group">
                                                            <input type="password" name="password" id="passwords"
                                                                   class="myinput icon-input password"
                                                                   autocomplete="off" placeholder="Password" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 no-padding">
                                                        <div class="form-group">
                                                            <input type="password" name="repassword" id="repassword"
                                                                   class="myinput icon-input repassword"
                                                                   autocomplete="off" placeholder="Re-password"
                                                                   required/>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12 no-padding" style="margin-top: 15px;">
                                                        <div class="g-recaptcha"
                                                             data-sitekey="6LdXR5wUAAAAAPa-kl_jFsiYJDAelSj7wo-P56q8"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12 no-padding">
                                                        <div class="form-group">
                                                            <p style="padding-left: 10px; padding-top: 15px;">
                                                                <input type="checkbox" id="sing-term" value="1"/>
                                                                <label for="sing-term">By clicking Sign Up, you agree to
                                                                    our <a href="#" data-target="#termModal"
                                                                           type="button" data-toggle="modal">Terms, Data
                                                                        Policy and Cookies Policy.</a></label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 no-padding">
                                                        <div class="form-group">
                                                            <button type="submit" name="button" class="mybutton">Sign
                                                                up
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/if}
                    </div>
                </div>
            </div>
            {if !isset($ishome)}
                <form action="{base_url('search/')}" method="GET" id="advanced_search_form">
                    <div class="bottom-menu">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-7 xs-no-padding advanced-pag">
                                    <div class="search-menu">


                                        <select name="search_type" class="selectpicker show-menu-arrow main_search_type"
                                                data-selected-text-format="count > 0" title="Search Type">
                                            <option value="1" {if $search_type eq 1} selected="selected" {/if}>Event
                                            </option>
                                            <option value="2" {if $search_type eq 2} selected="selected" {/if} disabled>
                                                Tender (Coming Soon)
                                            </option>
                                            <option value="3" {if $search_type eq 3} selected="selected" {/if}>Product
                                            </option>
                                            <option value="4" {if $search_type eq 4} selected="selected" {/if} disabled>
                                                Equipment (Coming Soon)
                                            </option>
                                            <option value="5" {if $search_type eq 5} selected="selected" {/if}>Company
                                            </option>
                                        </select>


                                        <select name="event_type" class="selectpicker show-menu-arrow main_event_type"
                                                data-selected-text-format="count > 0" title="Event Type">
                                            <option value="0">Event Type</option>
                                            {if $event_types}{foreach from=$event_types item=event_type}
                                                <option value="{$event_type->id}" {if $event_type_con eq $event_type->id} selected="selected" {/if}>{$event_type->name}</option>
                                            {/foreach}{/if}
                                        </select>

                                        <select name="group_id[]" class="selectpicker show-menu-arrow main_status_type"
                                                multiple data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Status">
                                            {if $groups}{foreach $groups as $key => $value}{if $value->id neq 6}
                                                <option value="{$value->id}" {if in_array($value->id, $search_status)} selected="selected" {/if}>{$value->name}</option>
                                            {/if}{/foreach}{/if}
                                        </select>

                                        <select name="standart[]" style="display: none"
                                                class="selectpicker show-menu-arrow main_standart-type" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Standard">
                                            {if $standarts}{foreach $standarts as $key => $value}
                                                <option value="{$value->id}" {if in_array($value->id, $search_standart)} selected="selected" {/if}>{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>

                                        <select name="event_continent[]"
                                                class="selectpicker show-menu-arrow main_event_continent" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Continent">
                                            {if $continents}{foreach from=$continents item=continent}
                                                <option value="{$continent->code}" {if in_array($continent->code, $event_continent)} selected="selected" {/if}>{$continent->name}</option>
                                            {/foreach}{/if}
                                        </select>

                                        <div class="show-menu-arrow country-inner-event btn-group bootstrap-select show-tick main_event_country"></div>

                                        <div class="btn-group bootstrap-select show-tick show-menu-arrow data-event">
                                            <button type="button"
                                                    class="btn dropdown-toggle bs-placeholder btn-default">
                                                <span class="filter-option pull-left">Date</span>
                                                <span class="bs-caret"><span class="caret"></span></span>
                                            </button>
                                            <div class="dropdown-menu open" role="combobox">
                                                <ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
                                                    <div class="input-daterange input-group" id="ev_start">
                                                        <label>Select Date From...</label>
                                                        <input type="text" class="input-sm mylos form-control"
                                                               name="start" value="{$event_start}"/>
                                                    </div>
                                                    <div class="input-daterange input-group" id="ev_end">
                                                        <label>Select Date To...</label>
                                                        <input type="text" class="input-sm mylos form-control"
                                                               name="end" value="{$event_end}"/>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </ul>
                                            </div>
                                        </div>

                                        <select name="pr_type[]" class="selectpicker show-menu-arrow main_product_type"
                                                multiple data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Product Type">
                                            {if $product_types}{foreach from=$product_types item=product_type}
                                                <option value="{$product_type->id}" {if in_array($product_type->id, $pr_type)} selected="selected" {/if}>{$product_type->name}</option>
                                            {/foreach}{/if}
                                        </select>

                                        <select name="user_id[]" class="selectpicker show-menu-arrow main_company_name"
                                                multiple data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Company Name">
                                            {if $companies}{foreach from=$companies item=company}
                                                <option value="{$company->id}" {if in_array($company->id, $company_id)} selected="selected" {/if}>{$company->company_name}</option>
                                            {/foreach}{/if}
                                        </select>

                                        <div class="btn-group bootstrap-select show-tick show-menu-arrow advanced-serach-icon pull-right">
                                            <button type="button"
                                                    class="btn dropdown-toggle bs-placeholder btn-default">
                                                <span class="filter-option pull-left">Advanced Search</span>
                                                <span class="bs-caret"><span class="caret"></span></span>
                                            </button>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-5 xs-no-padding search-pag">
                                    <div class="search">
                                        <div class="nav-search">
                                            <input type="text" name="title" value="{$keyword}" class="search-input"
                                                   placeholder="Type here ...">
                                            <button type="submit" class="search-button" name="button">
                                                <span>Search</span></button>
                                        </div>
                                    </div>

                                    <div class="mobile-advsearch-outer">
                                        <div class="tab-content mobile-adv-search">
                                            <div role="tabpanel" class="tab-pane active" id="product">
                                                <input type="hidden" name="search_type" value="{$search_type}">

                                                <select name="pr_type[]"
                                                        class="selectpicker show-menu-arrow main_product_type" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Product Type">
                                                    {if $product_types}{foreach from=$product_types item=product_type}
                                                        <option value="{$product_type->id}" {if in_array($product_type->id, $pr_type)} selected="selected" {/if}>{$product_type->name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                                <select name="user_id[]"
                                                        class="selectpicker show-menu-arrow main_company_name" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Company Name">
                                                    {if $companies}{foreach from=$companies item=company}
                                                        <option value="{$company->id}" {if in_array($company->id, $company_id)} selected="selected" {/if}>{$company->company_name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                                <select name="continent[]"
                                                        class="selectpicker show-menu-arrow main_company_continent"
                                                        multiple data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Continent">
                                                    {if $continents}{foreach from=$continents item=continent}
                                                        <option value="{$continent->code}" {if in_array($continent->code, $search_continent)} selected="selected" {/if}>{$continent->name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                                <select name="content_type[]"
                                                        class="selectpicker show-menu-arrow main_content_type" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Content Type">
                                                    <option value="0" {if in_array(0, $content_types)} selected="selected" {/if}>
                                                        Monocomponent
                                                    </option>
                                                    <option value="1" {if in_array(1, $content_types)} selected="selected" {/if}>
                                                        Policomponent
                                                    </option>
                                                </select>
                                                <select name="group_id[]"
                                                        class="selectpicker show-menu-arrow main_status_type" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Status">
                                                    {if $groups}{foreach $groups as $key => $value}{if $value->id neq 6}
                                                        <option value="{$value->id}" {if in_array($value->id, $search_status)} selected="selected" {/if}>{$value->name}</option>
                                                    {/if}{/foreach}{/if}
                                                </select>
                                                <select name="standart[]"
                                                        class="selectpicker show-menu-arrow main_standart-type" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Standard">
                                                    {if $standarts}{foreach $standarts as $key => $value}
                                                        <option value="{$value->id}" {if in_array($value->id, $search_standart)} selected="selected" {/if}>{$value->name}</option>
                                                    {/foreach}{/if}
                                                </select>
                                                <select name="atc_classifiction[]"
                                                        class="selectpicker show-menu-arrow main_atc_classifiction"
                                                        multiple data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0"
                                                        title="ATC Classification">
                                                    {if $parent_atc} {foreach $parent_atc as $key => $parent}
                                                        <optgroup label="{$parent->atc_code} - {$parent->meaning}"
                                                                  data-collapsible-optgroup="true"
                                                                  data-load-collapse-optgroup="true">
                                                            {if $list_atc[$parent->id]}{foreach $list_atc[$parent->id] as $child}
                                                                <option value="{$child->atc_code}" {if in_array($child->atc_code, $atc_classifiction)} selected="selected" {/if}>{$child->atc_code}
                                                                    - {$child->meaning}</option>
                                                            {/foreach}{/if}
                                                        </optgroup>
                                                    {/foreach}{/if}
                                                </select>
                                            </div>
                                        </div>
                                        <button type="button" class="adv-search-button btn btn-default"><i
                                                    class="fa fa-plus"></i>Advanced search
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-menu advanced-menu" style="display:none">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search-menu">
                                        <select name="continent[]"
                                                class="selectpicker show-menu-arrow main_company_continent" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Continent">
                                            {if $continents}{foreach from=$continents item=continent}
                                                <option value="{$continent->code}" {if in_array($continent->code, $search_continent)} selected="selected" {/if}>{$continent->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                        <div class="country-inner btn-group bootstrap-select show-tick show-menu-arrow"></div>
                                        <select name="content_type[]"
                                                class="selectpicker show-menu-arrow main_content_type" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Content Type">
                                            <option value="0" {if in_array(0, $content_types)} selected="selected" {/if}>
                                                Monocomponent
                                            </option>
                                            <option value="1" {if in_array(1, $content_types)} selected="selected" {/if}>
                                                Policomponent
                                            </option>
                                        </select>
                                        <select name="group_id[]" class="selectpicker show-menu-arrow main_status_type"
                                                multiple data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Status">
                                            {if $groups}{foreach $groups as $key => $value}{if $value->id neq 6}
                                                <option value="{$value->id}" {if in_array($value->id, $search_status)} selected="selected" {/if}>{$value->name}</option>
                                            {/if}{/foreach}{/if}
                                        </select>
                                        <select name="standart[]"
                                                class="selectpicker show-menu-arrow main_standart-type" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Standard">
                                            {if $standarts}{foreach $standarts as $key => $value}
                                                <option value="{$value->id}" {if in_array($value->id, $search_standart)} selected="selected" {/if}>{$value->name}</option>
                                            {/foreach}{/if}
                                        </select>
                                        <select name="atc_classifiction[]"
                                                class="selectpicker show-menu-arrow main_atc_classifiction" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="ATC Classification">
                                            {if $parent_atc} {foreach $parent_atc as $key => $parent}
                                                <optgroup label="{$parent->atc_code} - {$parent->meaning}"
                                                          data-collapsible-optgroup="true"
                                                          data-load-collapse-optgroup="false">
                                                    {if $list_atc[$parent->id]}{foreach $list_atc[$parent->id] as $child}
                                                        <option value="{$child->atc_code}" {if in_array($child->atc_code, $atc_classifiction)} selected="selected" {/if}>{$child->atc_code}
                                                            - {$child->meaning}</option>
                                                    {/foreach}{/if}
                                                </optgroup>
                                            {/foreach}{/if}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            {/if}
            <input type="hidden" name="dial_code" value="0" class="dial-codes"/>
</header>
<div class="clearfix"></div>

<div class="modal fade bs-more-modal-lg" tabindex="-1" role="dialog" id="moreInfo" aria-labelledby="moreInfo"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span class="md-close"></span></button>
                <h4 class="modal-title" id="myModalLabel">More Information</h4>
            </div>
            <div class="modal-body inner-modal-product" style="min-height:500px;"></div>
            <div class="modal-footer">
                <a type="button" href="#" class="btn btn-success product_url">Get Product <i
                            class="fa fa-arrow-right"></i> </a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{if is_loggedin neq false}
    <div id="datamodal" class="modal fade" role="dialog" style="z-index:999999999999999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title data-title"></h4>
                </div>
                <div class="modal-body data-body"
                     style="min-height: 500px;max-height:500px;overflow-y:auto;padding:0px;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="all_modals full_width">
        <!-- Modal -->
        <div class="modal fade" id="forgetPasswordAuth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: none;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">
                                <img src="{base_url('templates/default/assets/images/icons/close_n.png')}"/>
                            </span></button>
                    </div>
                        <form class="forgetPassword" action="{base_url()}/authentication/forget/" method="post">
                            <div class="modal-body">
                                <h3>FORGOT YOUR PASSWORD?</h3>
                                <p id="forgot_password_messge"></p>
                                <div class="mod_center_inp">
                                    <label for="">Email</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <div class="full_width">
                                    <a href="#">Сменить способ получения кода</a>
                                    <a href="#">Отправить код повторно</a>
                                </div><!-- /.full_width -->
                            </div>
                            <div class="like_btn_n full_width">
                                <button type="submit" class="btn btn-info send_n" style="padding-top: 8px !important;">Send</button>
                                <button type="button" class="btn btn-default back_n" data-dismiss="modal" style="padding-top: 8px !important;">Close</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>

    </div><!-- /.all_modals -->

    {*<div id="forgetPasswordAuth" class="modal fade" role="dialog" style="z-index:999999999999999;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="forgetPassword" action="{base_url()}/authentication/forget/" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">FORGET PASSWORD</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Send</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>*}
{/if}
<script type="text/javascript">
    {if isset($token)}
    const tokenz = '{$token}';
    {literal}
    const socketz = io('https://makromedicine.com:8880/', {
        rejectUnauthorized: false,
        secure: true,
        query: 'token=' + tokenz
    });
    socketz.on('message_count', function (data) {
        $('.simple_counter').text(data);
    });
    {/literal}
    {/if}
</script>