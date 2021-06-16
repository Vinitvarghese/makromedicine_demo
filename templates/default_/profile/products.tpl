{extends file=$layout}
{block name=content}
<div class="clearfix"></div>
<div class="wrap margin-top-100 col-md-12">
    <div class="container">
        <div class="row">
            <div class="clearfix"></div>
            <div class="col-md-12" id="profile">
                <div class="col-md-12 no-padding" >
                    <form class="userSettings" action="{base_url()}/profile/save" enctype="multipart/form-data" method="post">
                        <div class="col-md-3 no-padding profile-left">
                            <div class="left-sidebar" id="my-affix">
                                <div class="round-image">
                                    <img src="{$user_images}" alt="{$UserData->company_name}">
                                </div>
                                <div class="followers">
                                    <h4>FOLLOWERS: <a href="#" data-user-id="{$UserData->id}" class="my_followers"><span>{$user_followers}</span></a> </h4>
                                    <h4>FOLLOWING: <a href="#" data-user-id="{$UserData->id}" class="my_following"><span>{$user_following}</span></a> </h4>
                                </div>
                                <div class="profile-menu">
                                    <ul>
                                        <li> <a href="{site_url_multi('/')}profile/"> <img src="{base_url('templates/default/assets/img/sys/user.svg')}" alt="">PROFILE VIEW</a> </li>
                                        <li> <a href="{site_url_multi('/')}profile/settings/"> <img src="{base_url('templates/default/assets/img/sys/settings.svg')}" alt="">SETTINGS</a> </li>
                                        <li> <a href="{site_url_multi('/')}profile/accounts/"> <img src="{base_url('templates/default/assets/img/sys/accounts.svg')}" alt="">ACCOUNT SETTINGS</a> </li>
                                        <li> <a href="{site_url_multi('/')}profile/interests/"> <img src="{base_url('templates/default/assets/img/sys/lover.svg')}" alt="">YOUR INTEREST</a> </li>
                                        <li> <a href="{site_url_multi('/')}profile/products/"> <img src="{base_url('templates/default/assets/img/sys/product.svg')}" alt="">PRODUCTS</a> </li>
                                        <li> <a href="{base_url('/')}authentication/logout"> <img src="{base_url('templates/default/assets/img/sys/logout.svg')}" alt="">LOG OUT</a> </li>
                                    </ul>
                                </div>
                                {if  $user['group_id'] eq 2 ||  $user['group_id'] eq 3 ||  $user['group_id'] eq 4}
                                <div class="left-button-area">
                                    <button type="button" name="button" class="confirm-btn">CONFIRM YOU ACCOUNT</button>
                                </div>
                                {/if}
                            </div>
                        </div>
                            <div class="col-md-9 profile-right no-padding-right">
                                <div class="right-content" style="padding:0px;">
                                    <div class="col-md-12 no-padding right-content-inner" style="padding:0px;">

                                    </div>
                                    <div class="clearfix"> </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <script type="text/javascript">
        toastr.warning('Your account is not confirm !');
    </script>
{/block}
