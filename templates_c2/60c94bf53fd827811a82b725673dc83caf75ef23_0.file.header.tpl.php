<?php
/* Smarty version 3.1.30, created on 2020-10-29 15:24:54
  from "/home/makromed/public_html/demo/templates/default/_partial/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f9aa686731848_13457895',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '60c94bf53fd827811a82b725673dc83caf75ef23' => 
    array (
      0 => '/home/makromed/public_html/demo/templates/default/_partial/header.tpl',
      1 => 1603970679,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f9aa686731848_13457895 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
    <meta charset="<?php echo $_smarty_tpl->tpl_vars['meta_charset']->value;?>
">
    <meta http-equiv="Content-Type" content="<?php echo $_smarty_tpl->tpl_vars['meta_content_type']->value;?>
">
    <meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['meta_keyword']->value;?>
"/>
    <meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['meta_description']->value;?>
">
    <meta name="robots" content="<?php echo $_smarty_tpl->tpl_vars['meta_robots']->value;?>
"/>
    <meta name="DC.title" content="<?php echo $_smarty_tpl->tpl_vars['meta_title']->value;?>
"/>
    <meta property="fb:app_id" content="<?php echo $_smarty_tpl->tpl_vars['meta_facebook_app_id']->value;?>
"/>
    <meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['meta_facebook_url']->value;?>
"/>
    <meta property="og:type" content="<?php echo $_smarty_tpl->tpl_vars['meta_facebook_type']->value;?>
"/>
    <meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['meta_title']->value;?>
"/>
    <meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['meta_description']->value;?>
"/>
    <meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['current_img']->value;?>
"/>
    <meta property="og:image:width" content="<?php echo $_smarty_tpl->tpl_vars['meta_facebook_width']->value;?>
"/>
    <meta property="og:image:height" content="<?php echo $_smarty_tpl->tpl_vars['meta_facebook_height']->value;?>
"/>
    <meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['meta_facebook_site_name']->value;?>
"/>
    <meta name="twitter:card" content="<?php echo $_smarty_tpl->tpl_vars['meta_twitter_card']->value;?>
"/>
    <meta name="twitter:site" content="<?php echo $_smarty_tpl->tpl_vars['meta_twitter_site']->value;?>
"/>
    <meta name="twitter:creator" content="<?php echo $_smarty_tpl->tpl_vars['meta_twitter_creator']->value;?>
"/>
    <meta name="googlebot" content="<?php echo $_smarty_tpl->tpl_vars['meta_googlebot']->value;?>
"/>
    <meta name="msnbot" content="<?php echo $_smarty_tpl->tpl_vars['meta_msnbot']->value;?>
"/>
    <meta name="dmozbot" content="<?php echo $_smarty_tpl->tpl_vars['meta_dmozbot']->value;?>
"/>
    <meta name="revisit-after" content="<?php echo $_smarty_tpl->tpl_vars['meta_revisit_after']->value;?>
"/>
    <meta name="copyright" content="Makromedicine.com"/>
    <meta name="google-signin-scope" content="<?php echo $_smarty_tpl->tpl_vars['meta_google_signin_scope']->value;?>
">
    <meta name="google-signin-client_id" content="<?php echo $_smarty_tpl->tpl_vars['meta_google_signin_client_id']->value;?>
">
    <meta name="viewport" content="<?php echo $_smarty_tpl->tpl_vars['meta_viewport']->value;?>
"/>
    <meta name="yandex-verification" content="48ee9eab27f4d2f5"/>
    <!-- STYLESEET -->
    <link rel="image_src" href="<?php echo $_smarty_tpl->tpl_vars['current_img']->value;?>
"/>
    <!--   <link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['link_canonical']->value;?>
"/> -->
    <link rel="shortcut icon" type="image/png" href="<?php echo $_smarty_tpl->tpl_vars['link_shortcut_icon']->value;?>
"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['link_shortcut_icon']->value;?>
">

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/slick.css');?>
" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />

    <?php if (isset($_smarty_tpl->tpl_vars['new_page']->value) && $_smarty_tpl->tpl_vars['new_page']->value == 1) {?>
        <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/custom.css');?>
" media="all">
    <?php }?>
    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/main.css?v=');
echo time();?>
" media="all">

    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets//emoji/emojionearea.css?v=');
echo time();?>
" media="all">
    <?php if (!isset($_GET['demo'])) {?>
        <?php if (isset($_smarty_tpl->tpl_vars['new_page']->value) && $_smarty_tpl->tpl_vars['new_page']->value == 1) {?>
            <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/style_new.css');?>
" media="all">
        <?php } else { ?>
        <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/style.css?v=');
echo uniqid();?>
" media="all">
        <?php }?>
        <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/audio-player/dist/css/green-audio-player.css?v=');
echo uniqid();?>
" media="all">
    <?php } else { ?>
        <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/style-demo.css?v=');
echo uniqid();?>
"
              media="all">
    <?php }?>
    <link rel="stylesheet" href="<?php echo base_url('templates/default/assets/css/responsive.css?v=20092019');?>
" media="all">

    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.dev.js"><?php echo '</script'; ?>
>

    <?php echo $_smarty_tpl->tpl_vars['css']->value;?>


    

        <!-- Yandex.Metrika counter -->
        <?php echo '<script'; ?>
 type="text/javascript">
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
        <?php echo '</script'; ?>
>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/53617480" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>
        <!-- /Yandex.Metrika counter -->

    

    <!-- JAVASCRIPT 1 -->
    <?php echo '<script'; ?>
>
        ci_custom_home_url = "<?php echo base_url();?>
";
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 charset="utf-8" type="text/javascript"
            src="<?php echo base_url('templates/default/assets/js/plugins.js?v=8');?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 charset="utf-8" type="text/javascript"
            src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 charset="utf-8" type="text/javascript"
            src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 charset="utf-8" type="text/javascript" src="https://apis.google.com/js/platform.js?onload=onLoad" async
            defer><?php echo '</script'; ?>
>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 src="<?php echo base_url('templates/default/assets//emoji/emojionearea.js?v=');
echo time();?>
"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript"> var site_url = "<?php echo base_url();?>
"; <?php echo '</script'; ?>
>
    <?php echo $_smarty_tpl->tpl_vars['js']->value;?>

    <?php echo '<script'; ?>
>
        <?php if (isset($_smarty_tpl->tpl_vars['UserData']->value->country_code) && $_smarty_tpl->tpl_vars['UserData']->value->country_code != '') {?>

        $('.dial-codes').val('<?php echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;?>
');
        $('.dial-code').val('<?php echo $_smarty_tpl->tpl_vars['UserData']->value->country_code;?>
');

        <?php } else { ?>

        
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

        

        <?php }?>

        

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
    <?php echo '</script'; ?>
>
    <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value == false) {?>
        <?php echo '<script'; ?>
>
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
                            
                        });
                }
            }
        <?php echo '</script'; ?>
>
    <?php } else { ?>
        <?php echo '<script'; ?>
>
            function testAPI(response) {
                if (response.status === 'connected') {
                    FB.logout(function (response) {});
                }
            }
        <?php echo '</script'; ?>
>
    <?php }?>


    
        <!--
        <?php echo '<script'; ?>
 src="https://www.googletagmanager.com/gtag/js?id=UA-77518171-4"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript">
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', 'UA-77518171-4');
        <?php echo '</script'; ?>
>-->
        <?php echo '<script'; ?>
 type="text/javascript">window.$crisp = [];
            window.CRISP_WEBSITE_ID = "e0515cb9-356e-4ac5-a67f-79b638480a01";
            (function () {
                d = document;
                s = d.createElement("script");
                s.src = "https://client.crisp.chat/l.js";
                s.async = 1;
                d.getElementsByTagName("head")[0].appendChild(s);
            })();<?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 async defer type="text/javascript"
                src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5814eeb8a5c788a2"><?php echo '</script'; ?>
>
    
    <?php echo '<script'; ?>
 src="https://www.google.com/recaptcha/api.js" async defer><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
 async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8703899176773088",
            enable_page_level_ads: true
        });
    <?php echo '</script'; ?>
>
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
                <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value == false) {?>

                <div class="col-md-3 col-xs-12">
                    <?php } else { ?>

                    <div class="col-md-3 col-xs-12">
                        <?php }?>

                        <div class="logo">
                            <a href="<?php echo site_url_multi('/');?>
"><img
                                        src="<?php echo base_url('templates/default/assets/img/logo/logo-makromedicine.png');?>
"
                                        alt=""></a>
                        </div>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value == false) {?>
                        <div class="col-md-7 col-xs-12">
                            <?php if ($_smarty_tpl->tpl_vars['menu_items']->value) {?>
                                <div class="topnav" id="myTopnav">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu_items']->value, 'menu_item', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['menu_item']->value) {
?>
                                        <a href="<?php echo site_url_multi('/');
echo $_smarty_tpl->tpl_vars['menu_item']->value->slug;?>
"
                                           class="active"><?php echo $_smarty_tpl->tpl_vars['menu_item']->value->name;?>
</a>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


                                    <a href="javascript:void(0);" class="icon" onclick="hamburger()">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </div>
                            <?php }?>

                        </div>
                    <?php } else { ?>
                        <div class="col-md-5 col-xs-12" style="padding: 0;">
                            <?php if ($_smarty_tpl->tpl_vars['menu_items']->value) {?>
                                <div class="topnav" id="myTopnav">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu_items']->value, 'menu_item', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['menu_item']->value) {
if ($_smarty_tpl->tpl_vars['key']->value <= 5) {?>
                                        <a href="<?php echo site_url_multi('/');
echo $_smarty_tpl->tpl_vars['menu_item']->value->slug;?>
"
                                           class="active <?php if ($_smarty_tpl->tpl_vars['key']->value == 1) {?> has-submenu <?php }?>"><?php echo $_smarty_tpl->tpl_vars['menu_item']->value->name;?>
</a>
                                    <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    <a href="javascript:void(0);" class="icon" onclick="hamburger()">
                                        <i class="fa fa-bars"></i>
                                    </a>


                                    <a href="#" data-toggle="dropdown" class="hidden-xs"> <i class="fa fa-bars"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['menu_items']->value, 'menu_item', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['menu_item']->value) {
if ($_smarty_tpl->tpl_vars['key']->value > 5) {?>
                                            <li><a href="<?php echo site_url_multi('/');
echo $_smarty_tpl->tpl_vars['menu_item']->value->slug;?>
"
                                                   class="active"><?php echo $_smarty_tpl->tpl_vars['menu_item']->value->name;?>
</a></li>
                                        <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                    </ul>

                                </div>
                            <?php }?>

                        </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value != false) {?>
                        <div class="col-md-1 col-xs-4 no-padding">
                            <div class="menu-hamburger pull-right">
                                <ul class="dropdown">

                                    <li class="logged-menu notify-list">
                                        <?php if ($_smarty_tpl->tpl_vars['check_notify']->value) {?>
                                            <div class="simple_counter"><?php echo count((array)$_smarty_tpl->tpl_vars['check_notify']->value);?>
</div>
                                        <?php }?>
                                        <a class="notify_href" href="#" data-toggle="dropdown">
                                            <img src="<?php echo base_url('templates/default/assets/img/sys/notification.svg');?>
"
                                                 style="width: 25px;" alt="">
                                        </a>
                                        <ul class="dropdown-menu">
                                            <?php if ($_smarty_tpl->tpl_vars['get_notify']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['get_notify']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                <li data-target="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" data-sender="<?php echo $_smarty_tpl->tpl_vars['value']->value->sender;?>
"
                                                    data-status="<?php echo $_smarty_tpl->tpl_vars['value']->value->status;?>
" data-type="<?php echo $_smarty_tpl->tpl_vars['value']->value->type;?>
"
                                                    <?php if ($_smarty_tpl->tpl_vars['value']->value->status == 1) {?>class="actives"<?php }?>>
                                                    <a href="<?php echo site_url_multi('/notify/');
echo $_smarty_tpl->tpl_vars['value']->value->id;?>
">
                                                        <?php if ($_smarty_tpl->tpl_vars['value']->value->sender == 0) {?>
                                                            <i class="fa fa-star"></i>
                                                        <?php } else { ?>
                                                            <i class="fa fa-star-o"></i>
                                                        <?php }?>
                                                        <?php echo $_smarty_tpl->tpl_vars['value']->value->title;?>

                                                    </a>
                                                </li>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                            <?php } else { ?>
                                                <span style="color: #333;font-family: 'GothamBook', Arial, sans-serif;font-size: 11px;text-align: center;padding: 10px;display: block;">No notifications</span>
                                            <?php }?>
                                        </ul>
                                    </li>
                                    <li class="logged-menu message-list">
                                        <?php if ($_smarty_tpl->tpl_vars['check_msg']->value > 0) {?>
                                            <div class="simple_counter"><?php echo $_smarty_tpl->tpl_vars['check_msg']->value;?>
</div>
                                        <?php }?>
                                        <a href="<?php echo base_url('messages/index');?>
"> <img
                                                    src="<?php echo base_url('templates/default/assets/img/sys/email.svg');?>
"
                                                    style="width: 25px;" alt=""> </a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value == false) {?>
                    <div class="col-md-2 col-xs-12 sign-up-responsive">
                        <?php } else { ?>
                        <div class="col-md-3 col-xs-8">
                            <?php }?> <?php if ($_smarty_tpl->tpl_vars['is_loggedin']->value == false) {?>
                                <!--  <div class="language">
                       <select class="selectpicker lang_top select_top">
                          <?php if ($_smarty_tpl->tpl_vars['languages']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                          <option style="background-image:url(<?php echo base_url('templates/default/assets/img/country/lang');?>
/<?php echo $_smarty_tpl->tpl_vars['value']->value->slug;?>
.png);" data-slug="<?php echo $_smarty_tpl->tpl_vars['value']->value->slug;?>
" <?php if ($_smarty_tpl->tpl_vars['current_lang_id']->value == $_smarty_tpl->tpl_vars['value']->value->id) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->slug;?>
</option>
                          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                       </select>
                    </div> -->
                                <button class="mybutton" id="signUpToggle">Sign Up</button>
                                <button class="mybutton" id="signInToggle">Sign In</button>
                            <?php } else { ?>
                                
                                <?php if (is_object($_smarty_tpl->tpl_vars['user']->value)) {?>
                                    <?php $_smarty_tpl->_assignInScope('user_arr', get_object_vars($_smarty_tpl->tpl_vars['user']->value));
?>
                                    <div class="profile-thump">
                                    <div class="left-profile-thump">
                                        <div>
                                            <button type="button" class="btn btn-default dropdown-toggle btn-profile"
                                                    data-toggle="dropdown">
                                                <!-- <?php if ($_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 2 || $_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 3 || $_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 4) {?>
                                }

                                                    <p><?php echo mb_substr($_smarty_tpl->tpl_vars['user_arr']->value['company_name'],0,15,'UTF-8');?>
</p>
                                                <?php } else { ?>
                                                    <p><?php echo $_smarty_tpl->tpl_vars['user_arr']->value['fullname'];?>
</p>
                                                <?php }?> -->
                                                <p><?php echo $_smarty_tpl->tpl_vars['user_arr']->value['fullname'];?>
</p>
                                                <!-- <?php echo get_group_name($_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id']);?>
 -->
                                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->position)) {
echo $_smarty_tpl->tpl_vars['UserData']->value->position_name;
}?>
                                                <span class="caret btn-caret"></span>
                                            </button>
                                            <ul class="dropdown-menu profile-dropdown" role="menu">
                                                <li><a href="<?php echo site_url_multi('/');?>
profile/">Profile view</a></li>
                                                <li><a href="<?php echo site_url_multi('/');?>
profile/settings/">Settings</a></li>
                                                <li><a href="<?php echo site_url_multi('/');?>
profile/accounts/">Account
                                                        Settings</a></li> 
                                                <li><a href="#" onclick="$('#forgetPasswordAuth').modal();">Forgot Password</a>
                                                </li>
                                                <?php if (($_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 2 || $_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 3 || $_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 4) && strlen($_smarty_tpl->tpl_vars['user_arr']->value['company_name']) > 2) {?>
                                                    <li class="divider"></li>
                                                    <li><span class="company-name-dropdown"><?php echo $_smarty_tpl->tpl_vars['user_arr']->value['company_name'];?>
</span></li>
                                                    <li><a href="<?php echo site_url_multi('/');?>
profile/products/">Products</a></li>
                                                    <li><a href="<?php echo site_url_multi('/');?>
profile/interests/">Interests</a></li>
                                                    <li class="divider"></li>
                                                <?php }?>
                                                <li><a href="<?php echo base_url('/');?>
authentication/logout/"
                                                       onclick="signOut();">Logout</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="right-profile-thump">
                                        <a href="<?php echo site_url_multi('/');?>
profile">
                                            <img src="<?php echo $_smarty_tpl->tpl_vars['user_images']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
">
                                        </a>
                                    </div>
                                </div>
                                <?php } else { ?>
                                    <div class="profile-thump">
                                        <div class="left-profile-thump">
                                            <div>
                                                <button type="button" class="btn btn-default dropdown-toggle btn-profile"
                                                        data-toggle="dropdown">
                                                    <!-- <?php if ($_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 2 || $_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 3 || $_smarty_tpl->tpl_vars['user_arr']->value['user_groups_id'] == 4) {?>

                                                    <p><?php echo mb_substr($_smarty_tpl->tpl_vars['user_arr']->value['company_name'],0,15,'UTF-8');?>
</p>
                                                <?php } else { ?>
                                                    <p><?php echo $_smarty_tpl->tpl_vars['user_arr']->value['fullname'];?>
</p>
                                                <?php }?> -->
                                                <p><?php echo $_smarty_tpl->tpl_vars['user']->value['fullname'];?>
</p>
                                                <!-- <?php echo get_group_name($_smarty_tpl->tpl_vars['user']->value['user_groups_id']);?>
 -->
                                                <?php if (!empty($_smarty_tpl->tpl_vars['UserData']->value->position)) {
echo $_smarty_tpl->tpl_vars['UserData']->value->position_name;
}?>
                                                    <span class="caret btn-caret"></span>
                                                </button>
                                                <ul class="dropdown-menu profile-dropdown" role="menu">
                                                    <li><a href="<?php echo site_url_multi('/');?>
profile/">Profile view</a></li>
                                                    <li><a href="<?php echo site_url_multi('/');?>
profile/settings/">Settings</a></li>
                                                    <li><a href="<?php echo site_url_multi('/');?>
profile/accounts/">Account
                                                            Settings</a></li>
                                                    
                                                    </li>
                                                    <li><a href="#" onclick="$('#forgetPasswordAuth').modal();">Forgot Password</a>
                                                    <?php if (($_smarty_tpl->tpl_vars['user']->value['group_id'] == 2 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 3 || $_smarty_tpl->tpl_vars['user']->value['group_id'] == 4) && strlen($_smarty_tpl->tpl_vars['user']->value['company_name']) > 2) {?>
                                                        <li class="divider"></li>
                                                        <li><span class="company-name-dropdown" href="#"><?php echo $_smarty_tpl->tpl_vars['user']->value['company_name'];?>
</span></li>
                                                        <li><a href="<?php echo site_url_multi('/');?>
profile/products/">Products</a></li>
                                                        <li><a href="<?php echo site_url_multi('/');?>
profile/interests/">Interests</a></li>
                                                        <li class="divider"></li>
                                                    <?php }?>
                                                    <li><a href="<?php echo base_url('/');?>
authentication/logout/"
                                                           onclick="signOut();">Logout</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="right-profile-thump">
                                            <a href="<?php echo site_url_multi('/');?>
profile">
                                                <img src="<?php echo $_smarty_tpl->tpl_vars['user_images']->value;?>
" alt="<?php echo $_smarty_tpl->tpl_vars['UserData']->value->company_name;?>
">
                                            </a>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php }?>

                        </div>

                        <?php if (($_smarty_tpl->tpl_vars['is_loggedin']->value == false)) {?>
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
                                                <form id="validateForm" action="<?php echo base_url();?>
/authentication/login/"
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
                                        <?php if (isset($_smarty_tpl->tpl_vars['banner_popup']->value)) {?>
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['banner_popup']->value->slug;?>
" target="_blank">
                                                <img src="<?php echo (base_url('uploads/'));
echo $_smarty_tpl->tpl_vars['banner_popup']->value->images;?>
" alt=""
                                                     style="width: 100%;height: 390px;object-fit: cover;">
                                            </a>
                                        <?php } else { ?>
                                            <iframe width="404" height="390"
                                                    src="https://www.youtube.com/embed/6sT604EHm0o?rel=0"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen style="width: 100%"></iframe>
                                        <?php }?>
                                    </div>
                                    <div class="tab-content loginbox-main">
                                        <i class="fa fa-times visible-xs" aria-hidden="true"
                                           onclick="document.getElementById('signUpBox').style.display='none';document.getElementById('s-overlay').style.display='none';$('#signUpBox').removeClass('in-middle')"></i>
                                        <div id="register" class="tab-pane fade in active">
                                            <div class="form">
                                                <h3 class="hidden">Sign Up</h3>
                                                <form id="validateRegister"
                                                      action="<?php echo base_url();?>
/authentication/register/" method="post">
                                                    <div class="col-md-6 no-padding-left">
                                                        <div class="form-group">
                                                            <input type="text" name="fristname" id="fristname"
                                                                   class="myinput icon-input fristname onlyalphabet"
                                                                   placeholder="First name" autocomplete="off" pattern='[A-Za-z\\s]*'
                                                                   required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 no-padding">
                                                        <div class="form-group">
                                                            <input type="text" name="lastname" id="lastname"
                                                                   class="myinput icon-input lastname onlyalphabet"
                                                                   placeholder="Last name" autocomplete="off" pattern='[A-Za-z\\s]*' required/>
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
                                                                <input type="checkbox" id="sign_term" class="sign_term" name="sign_term"  value="1"/>
                                                                <label for="sign_term">By clicking Sign Up, you agree to
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
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php if (!isset($_smarty_tpl->tpl_vars['ishome']->value)) {?>
                <form action="<?php echo base_url('search/');?>
" method="GET" id="advanced_search_form">
                    <div class="bottom-menu">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9 xs-no-padding advanced-pag">
                                    <div class="search-menu">


                                        <select name="search_type" class="selectpicker show-menu-arrow main_search_type"
                                                data-selected-text-format="count > 0" title="Search Type">
                                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 1) {?> selected="selected" <?php }?>>Event
                                            </option>
                                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 2) {?> selected="selected" <?php }?> disabled>
                                                Tender (Coming Soon)
                                            </option>
                                            <option value="3" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 3) {?> selected="selected" <?php }?>>Product
                                            </option>
                                            <option value="4" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 4) {?> selected="selected" <?php }?> disabled>
                                                Equipment (Coming Soon)
                                            </option>
                                            <option value="5" <?php if ($_smarty_tpl->tpl_vars['search_type']->value == 5) {?> selected="selected" <?php }?>>Company
                                            </option>
                                        </select>


                                        <select name="event_type" class="selectpicker show-menu-arrow main_event_type"
                                                data-selected-text-format="count > 0" title="Event Type">
                                            <option value="0">Event Type</option>
                                            <?php if ($_smarty_tpl->tpl_vars['event_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['event_types']->value, 'event_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['event_type']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['event_type']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['event_type_con']->value == $_smarty_tpl->tpl_vars['event_type']->value->id) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['event_type']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>

                                        <select name="group_id[]" class="selectpicker show-menu-arrow main_status_type"
                                                multiple data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Status">
                                            <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
if ($_smarty_tpl->tpl_vars['value']->value->id != 6) {?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_status']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                            <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>

                                        <select name="standart[]" style="display: none"
                                                class="selectpicker show-menu-arrow main_standart-type" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Standard">
                                            <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_standart']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>

                                        <select name="event_continent[]"
                                                class="selectpicker show-menu-arrow main_event_continent" multiple
                                                data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Continent">
                                            <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['continent']->value->code;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['event_continent']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
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
                                                               name="start" value="<?php echo $_smarty_tpl->tpl_vars['event_start']->value;?>
"/>
                                                    </div>
                                                    <div class="input-daterange input-group" id="ev_end">
                                                        <label>Select Date To...</label>
                                                        <input type="text" class="input-sm mylos form-control"
                                                               name="end" value="<?php echo $_smarty_tpl->tpl_vars['event_end']->value;?>
"/>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </ul>
                                            </div>
                                        </div>

                                        <select name="pr_type[]" class="selectpicker show-menu-arrow main_product_type"
                                                multiple data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Product Type">
                                            <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['pr_type']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>

                                        <select name="user_id[]" class="selectpicker show-menu-arrow main_company_name"
                                                multiple data-live-search="true" data-actions-box="true"
                                                data-selected-text-format="count > 0" title="Company Name">
                                            <?php if ($_smarty_tpl->tpl_vars['companies']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['companies']->value, 'company');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['company']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['company']->value->id,$_smarty_tpl->tpl_vars['company_id']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                        </select>
                                        <?php if (!isset($_smarty_tpl->tpl_vars['search_page']->value)) {?>
                                            <div class="btn-group bootstrap-select show-tick show-menu-arrow advanced-serach-icon pull-right">
                                                <a href="<?php echo base_url();?>
search/?search_type=3&event_type="
                                                   class="btn dropdown-toggle bs-placeholder btn-default">
                                                    <span class="filter-option pull-left">Advanced Search</span>
                                                    <span class="bs-caret"><span class="caret"></span></span>
                                                </a>
                                            </div>
                                        <?php }?>


                                    </div>
                                </div>


                                <div class="col-md-3 xs-no-padding search-pag">
                                    <div class="search">
                                        <div class="row">
                                            <input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['keyword']->value;?>
" class="search-input col-md-9"
                                                   placeholder="Type here ...">
                                            <button type="submit" class="search-button col-md-3" name="button">
                                                <i class="search_ico"></i>
                                                <span>Search</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mobile-advsearch-outer">
                                        <div class="tab-content mobile-adv-search">
                                            <div role="tabpanel" class="tab-pane active" id="product">
                                                <input type="hidden" name="search_type" value="<?php echo $_smarty_tpl->tpl_vars['search_type']->value;?>
">

                                                <select name="pr_type[]"
                                                        class="selectpicker show-menu-arrow main_product_type" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Product Type">
                                                    <?php if ($_smarty_tpl->tpl_vars['product_types']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_types']->value, 'product_type');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_type']->value) {
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['product_type']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['product_type']->value->id,$_smarty_tpl->tpl_vars['pr_type']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['product_type']->value->name;?>
</option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                </select>
                                                <select name="user_id[]"
                                                        class="selectpicker show-menu-arrow main_company_name" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Company Name">
                                                    <?php if ($_smarty_tpl->tpl_vars['companies']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['companies']->value, 'company');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['company']->value) {
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['company']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['company']->value->id,$_smarty_tpl->tpl_vars['company_id']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['company']->value->company_name;?>
</option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                </select>
                                                <select name="continent[]"
                                                        class="selectpicker show-menu-arrow main_company_continent"
                                                        multiple data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Continent">
                                                    <?php if ($_smarty_tpl->tpl_vars['continents']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['continents']->value, 'continent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['continent']->value) {
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['continent']->value->code;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['continent']->value->code,$_smarty_tpl->tpl_vars['search_continent']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['continent']->value->name;?>
</option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                </select>
                                                <select name="content_type[]"
                                                        class="selectpicker show-menu-arrow main_content_type" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Content Type">
                                                    <option value="0" <?php if (in_array(0,$_smarty_tpl->tpl_vars['content_types']->value)) {?> selected="selected" <?php }?>>
                                                        Monocomponent
                                                    </option>
                                                    <option value="1" <?php if (in_array(1,$_smarty_tpl->tpl_vars['content_types']->value)) {?> selected="selected" <?php }?>>
                                                        Policomponent
                                                    </option>
                                                </select>
                                                <select name="group_id[]"
                                                        class="selectpicker show-menu-arrow main_status_type" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Status">
                                                    <?php if ($_smarty_tpl->tpl_vars['groups']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
if ($_smarty_tpl->tpl_vars['value']->value->id != 6) {?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_status']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                                    <?php }
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                </select>
                                                <select name="standart[]"
                                                        class="selectpicker show-menu-arrow main_standart-type" multiple
                                                        data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0" title="Standard">
                                                    <?php if ($_smarty_tpl->tpl_vars['standarts']->value) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['standarts']->value, 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                                        <option value="<?php echo $_smarty_tpl->tpl_vars['value']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['value']->value->id,$_smarty_tpl->tpl_vars['search_standart']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value->name;?>
</option>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                </select>
                                                <select name="atc_classifiction[]"
                                                        class="selectpicker show-menu-arrow main_atc_classifiction"
                                                        multiple data-live-search="true" data-actions-box="true"
                                                        data-selected-text-format="count > 0"
                                                        title="ATC Classification">
                                                    <?php if ($_smarty_tpl->tpl_vars['parent_atc']->value) {?> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['parent_atc']->value, 'parent', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['parent']->value) {
?>
                                                        <optgroup label="<?php echo $_smarty_tpl->tpl_vars['parent']->value->atc_code;?>
 - <?php echo $_smarty_tpl->tpl_vars['parent']->value->meaning;?>
"
                                                                  data-collapsible-optgroup="true"
                                                                  data-load-collapse-optgroup="true">
                                                            <?php if ($_smarty_tpl->tpl_vars['list_atc']->value[$_smarty_tpl->tpl_vars['parent']->value->id]) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_atc']->value[$_smarty_tpl->tpl_vars['parent']->value->id], 'child');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
?>
                                                                <option value="<?php echo $_smarty_tpl->tpl_vars['child']->value->atc_code;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['child']->value->atc_code,$_smarty_tpl->tpl_vars['atc_classifiction']->value)) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['child']->value->atc_code;?>

                                                                    - <?php echo $_smarty_tpl->tpl_vars['child']->value->meaning;?>
</option>
                                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
                                                        </optgroup>
                                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}?>
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

                </form>
            <?php }?>
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

<?php if ('is_loggedin' != false) {?>
    <div id="datamodal" class="modal fade" role="dialog" >
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
                                <img src="<?php echo base_url('templates/default/assets/images/icons/close_n.png');?>
"/>
                            </span></button>
                    </div>
                        <form class="forgetPassword" action="<?php echo base_url();?>
/authentication/forget/" method="post">
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

    
<?php }
echo '<script'; ?>
 type="text/javascript">
    <?php if (isset($_smarty_tpl->tpl_vars['token']->value)) {?>
    const tokenz = '<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
';
    
    const socketz = io('https://makromedicine.com:8880/', {
        rejectUnauthorized: false,
        secure: true,
        query: 'token=' + tokenz
    });
    socketz.on('message_count', function (data) {
        $('.simple_counter').text(data);
    });
    
    <?php }
echo '</script'; ?>
><?php }
}
